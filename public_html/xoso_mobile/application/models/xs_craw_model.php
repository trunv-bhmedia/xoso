<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_craw_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_craw');
        $this->_table = $_table;
    }

    function crawLink($date) {
//        error_reporting(E_ALL);

        $limit = (isset($_GET['limit']) ? $_GET['limit'] : date('Y-m-d'));

        $opts = array('http' => array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);

        while ($date <= $limit) {
            echo '<div class="header">Crawling::date [' . $date . ' / ' . $limit . ']</div>';
            echo '<div class="content">';
            #Lấy dữ liệu của ngày $dateMin
            $date = date('d-m-Y', strtotime("$date"));
            #Tạo link lấy dữ liệu : http://ketquaxoso.24h.com.vn/ngay-15-02-2012.html
            $link = 'http://ketquaxoso.24h.com.vn/ngay-' . $date . '.html';

            $html = file_get_html($link, false, $context);

            $this->parseData($link, $html, $date, true);
            $html->clear();
            unset($html);

            #Chuyển qua ngày kế tiếp
            $date = date('Y-m-d', strtotime("$date +1 day"));
            echo '</div>';
            flush();
            ob_flush();
        }
    }

    function parseData($link, &$html, $date, $store = true) {
        $error = '';
        $updateContent = isset($_GET['data']) ? $_GET['data'] : true;

        #center div div[id=content]
        $content = $html->find('#content', 0);
        if ($content == false) {
            echo 'craw::Dữ liệu không hợp lệ ', $date;
            $html->clear();
            unset($html);
            $this->setError($date);
            return;
        }

        #Kiểm tra xem có bảng kết quả.
        $validate = $content->find('table tr td table tr td[class="name_tbl_ketquaxs"]');

        #Kiểm tra sự hợp lệ của dữ liệu
        if ($validate == false) {
            echo 'craw::Dữ liệu không hợp lệ ', $date;
            $html->clear();
            unset($html);
            $this->setError($date);
            return;
        }

        $tableList = $content->find('table[style="margin-top:6px;"] table');

        #Duyệt qua các bảng chứa dữ liệu các giải xs
        if ($tableList) {
            #Định dạng ngày lấy dữ liệu để lưu vào database : 2012-10-20
            $date = date('Y-m-d', strtotime("$date"));

            #Lưu dữ liệu html
            if ($store) {
                $data = array(
                    "date" => $date,
                    "link" => $link,
//                    "data" => trim($html),
                    "state" => 0
                );
                $this->db->where('date', $date);
                $this->db->from('xs_craw');
                if ($this->db->count_all_results() == 0) {
                    $this->db->insert('xs_craw', $data);
                } else {
                    $this->db->update('xs_craw', $data, array('date' => $date));
                }
            }

            $datew = strval(date('w', strtotime($date)) + 1);
            $lid_arr = array();
            foreach ($this->data['xs_location_menu'] as $value) {
                if (strpos($value->lich, strval($datew)) !== false)
                    $lid_arr[] = $value->id;
            }

            foreach ($tableList as $table) {
                #Nếu có chế độ lấy dữ liệu
                if ($updateContent) {
                    // Kiểm tra xem có phải bảng kết quả | Quảng cáo
                    $validate = $table->find('tr td[class="name_tbl_ketquaxs"]');

                    if ($validate) {
                        $this->getData($table, $date, $lid_arr);
                    } else {
                        $error = 'craw::Bảng dữ liệu kết quả không hợp lệ';
                    }
                }
            }
        } else {
            $error = 'craw::Không tìm thấy TableList.';
        }

        echo "Update done !...", '<br/>';

        $html->clear();
        unset($html);
    }

    function setError($date) {
        $date = date('d-m-Y', strtotime("$date"));
        #Tạo link lấy dữ liệu : http://ketquaxoso.24h.com.vn/ngay-15-02-2012.html
        $link = 'http://ketquaxoso.24h.com.vn/ngay-' . $date . '.html';
        $date = date('Y-m-d', strtotime("$date"));

        $data = array(
            "date" => $date,
            "link" => $link,
            "state" => 1
        );
        $this->db->where('date', $date);
        $this->db->from('xs_craw');
        if ($this->db->count_all_results() == 0) {
            $this->db->insert('xs_craw', $data);
        } else {
            $this->db->update('xs_craw', $data, array('date' => $date));
        }
    }

    function getData($data, $date, $lid_arr) {
        $error = '';

        // Kiểm tra điều kiện $data
        if (count($data->children) < 2) {
            $error = 'getData::Dữ liệu không hợp lệ.';
            return;
        }
        $content = $data->children(0); //tr 1
        $name = trim($content->children(0)->plaintext); //td 1: Tền giải
        $extension = $content->children(1); //td 2: Bảng soi cầu
        $extension = $extension->children(0); //table extension: soi cầu, rowList

        $this->db->where("name", $name);
        $xs_location = $this->db->select('id,code')->from('xs_location')->get()->row();
        $lid = $xs_location->id;
        $area = $xs_location->code;
//            echo $this->db->last_query();
//        echo 'Mở thưởng hôm nay: ' . $name . '<br/>';

        if (empty($lid)) {
            $error = 'getData::Không thể lấy nid giải ' . $name;
            continue;
        }

        $statitic = array();
        // Soi cầu            
        if (count($extension->children) == 11) {
            for ($count = 1; $count < count($extension->children); $count++) {
                $row = str_replace('&nbsp;', "", $extension->children($count)->children(1)->plaintext);
                $statitic[] = $row;
            }
        } else {
            $error = 'Lỗi: Không thể bóc tách được dữ liệu soi cầu.';
        }

        $result = array();
        $resultExt = array();

        // Kết quả            
        if (count($data->children) > 9) {
            for ($count = 1; $count < count($data->children) - 1; $count++) {
                $row = trim($data->children($count)->children(1)->plaintext);
                $result[] = $row;
                $items = explode('-', $row);
                $suffix = array();
                #Duyệt qua các số kết quả
                foreach ($items as $item) {
                    $suffix[] = substr($item, -2);
                }
                $resultExt[] = implode(',', $suffix);
            }
        } else {
            $error = 'Lỗi: Không thể bóc tách được dữ liệu kết quả.';
        }

        #Lưu dữ liệu
        if (count($result) > 0) {
            if (in_array($lid, $lid_arr)) {
                $data = array(
                    "extension" => json_encode($statitic),
                    "lid" => $lid,
                    "date" => $date
                );
                foreach ($result as $i => $item) {
                    $data["a" . $i] = $item;
                }
                foreach ($resultExt as $i => $item) {
                    $data["b" . $i] = $item;
                }
                $this->db->where('date', $date);
                $this->db->where('lid', $lid);
                $this->db->from('xs_result');
                if ($this->db->count_all_results() == 0) {
                    $this->db->insert('xs_result', $data);
                    echo 'Mở thưởng hôm nay: ' . $name . ' - Insert<br/>';
                } else {
                    $this->db->update('xs_result', $data, array('date' => $date, 'lid' => $lid));
                    echo 'Mở thưởng hôm nay: ' . $name . ' - Update<br/>';
                }
//            $this->db->where('id', $lid);
//            $alias = $this->db->select('alias')->from('xs_location')->get()->row()->alias;
                //delete cache
//            if ($area == 'MB')
//                $this->simple_cache->delete_item('xoso_data_' . $this->data['url_mienbac']);
//            elseif ($area == 'MT')
//                $this->simple_cache->delete_item('xoso_data_' . $this->data['url_mientrung']);
//            else
//                $this->simple_cache->delete_item('xoso_data_' . $this->data['url_miennam']);

                $this->simple_cache->delete_item('home_data');
//            $this->simple_cache->delete_item('xoso_data_' . $alias);
//            $th_cache = getAliasByDate();
//            $this->simple_cache->delete_item('xoso_data_' . $alias . '_' . $th_cache);
//            $date_cache = date('d-m-Y');
//            $this->simple_cache->delete_item('xoso_data_' . $alias . '_' . $date_cache);
            }
        }
    }

    function getXSMB($date = null) {
        $limit = date('Y-m-d');
        while ($date <= $limit) {
            echo '<div class="header">Crawling::date [' . $date . ' / ' . $limit . ']</div>';
            echo '<div class="content">';
            #Lấy dữ liệu của ngày $dateMin
            $this->crawXSMB($date);
            #Chuyển qua ngày kế tiếp
            $date = date('Y-m-d', strtotime("$date +1 day"));
            echo '</div>';
            flush();
            ob_flush();
        }
    }

    function crawXSMB($date) {
        $urls = array(
            'DT123' => 'http://ketqua.net/xo-so-dien-toan-123.php',
            'DT6x36' => 'http://ketqua.net/xo-so-dien-toan-6x36.php',
            'TT' => 'http://ketqua.net/xo-so-than-tai.php'
        );

        $param = '?ngay=' . date('d/m/Y', strtotime($date));
        foreach ($urls as $ku => $url) {
            $url .= $param;
            $html = file_get_html($url);
            $content = @$html->find('div#ketqua', 0);
            echo $content;
            $tmp = array();
            foreach ($content->find('td.db') as $v) {
                $tmp[] = $v->text();
            }

            if ($this->checkExisted($ku, $date) == false) {
                $data = array(
                    "date" => $date,
                    "url" => $url,
                    "data" => json_encode($tmp),
                    "created_time" => date('Y-m-d H:i:s'),
                    "type" => $ku
                );
                if ($content) {
                    $data["status"] = 1;
                } else {
                    $data["status"] = 0;
                }
                print_r($obj);
                if ($tmp) {
                    $this->db->insert('xs_northern', $data);
                    echo "<p style=\"color:red\">$date - $ku: them moi thanh cong!</p>";
                    echo '<div>----------------------------------------------------</div>';
                } else {
                    echo "<p>$date - $ku: khong tim thay!</p>";
                    echo '<div>----------------------------------------------------</div>';
                }
            } else {
                echo "<p style=\"color:red\">$date - $ku: da ton tai!</p>";
                echo '<div>----------------------------------------------------</div>';
            }
            $html->clear();
            unset($html);
        }
        $this->simple_cache->delete_item('home_data');
    }

    function checkExisted($type = null, $date = null) {
        $this->db->where("status", 1);
        $this->db->where("date", $date);
        $this->db->where("type", $type);
        $id = $this->db->select('id')->from('xs_northern')->get()->row()->id;
        if ($id) {
            return true;
        } else {
            return false;
        }
    }

}