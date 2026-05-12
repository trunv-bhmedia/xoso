<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_result_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_result');
        $this->_table = $_table;

//        $timer = $this->getTimer();
        $this->_timeMB = '18:05'; //$timer['MB'];
        $this->_timeMT = '17:14'; //$timer['MT'];
        $this->_timeMN = '16:12'; //$timer['MN'];

        $this->_timeMB_end = '18:45';
        $this->_timeMT_end = '17:45';
        $this->_timeMN_end = '16:45';
    }

    function craw() {
//        error_reporting(-1);

        $area = 9;
        $time = date('H:i');
        if ($time >= $this->_timeMN && $time < $this->_timeMN_end) {
            $area = 2;
        } elseif ($time >= $this->_timeMT && $time < $this->_timeMT_end) {
            $area = 1;
        } elseif ($time >= $this->_timeMB && $time < $this->_timeMB_end) {
            $area = 0;
        }

        if (isset($_GET['a']))
            $area = (int) $_GET['a'];

        if ($area < 9) {
            $date = date('Y-m-d');
            $row = $this->read_xml($area, $date, 1);
            if (!$row) {
//                if (!isset($_GET['a'])) {
//                    $this->saveLog($area . ' - Begin a cron...');
//                }
                $result = null;
                if (isset($_GET['a'])) {
                    if (isset($_GET['mn']))
                        $result = $this->get_xstt_minhngoc($area, 0);
                    elseif (isset($_GET['vs']))
                        $result = $this->get_ketquaveso(0);
                    else
                        $result = $this->get_xstt($area);
                    var_dump($result);
                    die;
                }

                $this->saveLog($area . ' - get minhngoc ...');
                $result = $this->get_xstt_minhngoc($area, 0);
                $check_mn = true;
                if (!$result && $area == 0) {
                    $this->saveLog($area . ' - get ketquaveso ...');
                    $result = $this->get_ketquaveso(0);
                    $check_mn = false;
                } elseif (!$result) {
                    $this->saveLog($area . ' - get xstt ...');
                    $result = $this->get_xstt($area);
                    $check_mn = false;
                }
                if ($result) {
                    $state = 1;
                    foreach ($result as $v) {
                        if ($v['status'] == 0) {
                            $state = 0;
                            break;
                        }
                    }

                    $_tmp = array();
                    $_tmp['area'] = $area;
                    $_tmp['data'] = $result;
                    $this->update_xml($area, $date, $_tmp, $state);
                    if ($state == 1 && $check_mn == true) {
                        $this->update_result($result, $area, $date);
                        $this->saveLog($area . ' - Quay xong.');
                        unset($area, $time, $date, $row, $result, $state, $v, $_tmp, $check_mn);
                        die;
                    }
//                    $this->saveLog($area . ' - End a cron...');
                    unset($area, $time, $date, $row, $result, $state, $v, $_tmp, $check_mn);
//                    var_dump((get_defined_vars()));
                } else {
                    $this->saveLog($area . ' - Ko lay dc du lieu!');
                }
            } else {
                die('Da quay xong.');
            }
        } else {
            die('Ko phai gio quay.');
        }
    }

    function sendsms($area) {
        $date = date('Y-m-d');
        if (isset($_GET['date']))
            die('1');
        $row = $this->read_xml_home($area, $date, 1);
        if ($row) {
            if (!isset($_SESSION['daquayxong' . $area])) {
                $_SESSION['daquayxong' . $area] = 1;
                foreach ($row->cache->data as $v1) {
                    $this->sendSMS_KQXS($v1->code, $v1->data);
                    $this->sendSMS_TTXS($v1->code, $v1->data);
                    $this->sendSMS_XM($area);
                }
            }
        } else {
            die('0');
        }
    }

    function read_xml($area, $date, $state) {
        $file = $this->get_file_name($area);
        $data = file_get_contents($file);
        $data = json_decode($data);

        if ($state == 1 || $state == 0) {
            if ($data) {
                if ($data->date == $date && $data->area == $area && $data->state == $state) {
                    return $data;
                }
            }
        } else {
            if ($data) {
                if ($data->date == $date && $data->area == $area) {
                    return $data;
                }
            }
        }

        return NULL;
    }

    function get_file_name($area = NULL) {
        $file = 'mb.txt';
        if ($area == 1)
            $file = 'mt.txt';
        elseif ($area == 2)
            $file = 'mn.txt';

        $file = 'xstt/' . $file;
        if (!file_exists($file)) {
            $fl = fopen($file, 'w');
            fclose($fl);
        }
        return $file;
    }

    function read_xml_home($area, $date, $state) {
        $file = 'mb.txt';
        if ($area == 1)
            $file = 'mt.txt';
        elseif ($area == 2)
            $file = 'mn.txt';

//        $file = 'http://data.xoso.com/xstt/' . $file; //213
//        $file = 'http://www.xoso.com/xstt/' . $file;//114
        $file = 'xstt/' . $file; //114
        $data = file_get_contents($file);
        $data = json_decode($data);

        if ($state == 1 || $state == 0) {
            if ($data) {
                if ($data->date == $date && $data->area == $area && $data->state == $state) {
                    return $data;
                }
            }
        } else {
            if ($data) {
                if ($data->date == $date && $data->area == $area) {
                    return $data;
                }
            }
        }

        return null;
    }

    function update_xml($area, $date, $cache, $state) {
        if ($area == 0) {
            $filename = 'xstt/xsmb.php';
            if (!file_exists($filename)) {
                $fl = fopen($filename, 'w');
                fclose($fl);
            }
            if (is_writable($filename)) {
                if (!$f = fopen($filename, 'w')) {
                    $this->saveLog('Cannot open file (' . $filename . ')');
                } else {
                    $tmp['data'] = $cache['data']['MB']['data'];
                    $tmp['extra'] = $cache['data']['MB']['extra'];
                    $tmp['status'] = $cache['data']['MB']['status'];
                    $tmp['sec'] = md5(date('d'));

                    $str = '';
                    foreach ($cache['data']['MB']['data_b'] as $k1 => $v1) {
                        if ($v1 != '') {
                            if ($str == '') {
                                $str = $v1;
                            } else {
                                $str .= ',' . $v1;
                            }
                        }
                    }
                    $arr = explode(',', $str);
                    sort($arr);
                    $tmp['data_b'] = $arr;
                    $count_str = 0;
                    foreach ($arr as $v1) {
                        if ($v1 != '**' && $v1 != '++') {
                            $count_str = $count_str + 1;
                        }
                    }
                    $tmp['count_b'] = $count_str;

                    if (isset($cache['data']['MB']['dtthantai4']))
                        $tmp['dtthantai4'] = $cache['data']['MB']['dtthantai4'];
                    if (isset($cache['data']['MB']['dt123']))
                        $tmp['dt123'] = $cache['data']['MB']['dt123'];
                    if (isset($cache['data']['MB']['dt6x36']))
                        $tmp['dt6x36'] = $cache['data']['MB']['dt6x36'];

                    $str = 'MB(' . json_encode($tmp) . ')';

                    if (fwrite($f, $str) === FALSE) {
                        $this->saveLog('Cannot write to file (' . $filename . ')');
                    } else {
//                        $this->saveLog('Success, wrote to file (' . $filename . ')');
                        fclose($f);
                    }

                    unset($tmp, $str, $k1, $v1, $arr, $filename);
                }
            } else {
                $this->saveLog('The file ' . $filename . ' is not writable');
            }
        }

        $file = $this->get_file_name($area);
        if (is_writable($file)) {
            if (!$f = fopen($file, 'w')) {
                $this->saveLog('Cannot open file (' . $file . ')');
            } else {
                $data = new stdClass();
                $data->area = $area;
                $data->date = $date;
                $data->cache = $cache;
                $data->state = $state;

                $data = json_encode($data);

                if (fwrite($f, $data) === FALSE) {
                    $this->saveLog('Cannot write to file (' . $file . ')');
                } else {
//                    $this->saveLog('Success, wrote to file (' . $file . ')');
                    fclose($f);
                }

                unset($area, $date, $cache, $state, $f, $data, $file);
            }
        } else {
            $this->saveLog('The file ' . $file . ' is not writable');
        }
    }

    function saveLog($str) {
        echo '<p>' . $str . '</p>';
        $f = fopen('xstt/log_' . date('Y-m-d') . '.txt', 'a');
        if ($f) {
            $time = date('[d/m/Y H:i:s] - ');
            fwrite($f, $time . $str . "\n");
            fclose($f);
        }
    }

    function get_ketquaveso($area = 0) {
        $link = array(
            'http://ketquaveso.com/ttkq/mien-bac.html?t=',
//            'http://ketquaveso.com/ttkq/mien-trung.html?t=',
//            'http://ketquaveso.com/ttkq/mien-nam.html?t='
        );

        $url = $link[$area] . time();

        $result = array();
        $opts = array('http' => array('header' => 'User-Agent:User-Agent:Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0', 'timeout' => 30));
        $context = stream_context_create($opts);
        $html = file_get_html($url, false, $context);

//        ob_start();
//        $str = ob_get_contents();
//        ob_end_clean();
//        $html = str_get_html($str);

        if (!$html) {
            $this->saveLog('ketquaveso - HTML empty!');
            return null;
        }

//        if ($area == 0)
        $xs_title = $html->find('ul[class=gr-yellow]');
//        else
//            $xs_title = $html->find('ul[class=gr-yellow] li');

        if (!isset($xs_title[0])) {
            $this->saveLog('ul[class=gr-yellow] Not Found!');
            return null;
        }

        $date = '';
        $pattern = '/'
                . '([0-9]{2})'            // 2 digits
                . '-'      // /
                . '([0-9]{2})'            // 2 digits
                . '-'      // /
                . '([0-9]{4})'            // 4 digits
                . '/';
        if (preg_match($pattern, trim($xs_title[0]->text()), $regs))
            $date = $regs[1] . '-' . $regs[2] . '-' . $regs[3];

        if ($date != date('d-m-Y')) {
            $this->saveLog($date . ' khac hom nay - ' . date('d-m-Y'));
            return null;
        }

        $result = array();
        $arr_loc = array();
        $data_list = array();
        $datab_list = array();
        $arr_loto_list = array();
        $status_list = array();
//        if ($area > 0) {
//            $check_loc = true;
//            $area_str = '';
//            if ($area == 1)
//                $area_str = 'MT';
//            elseif ($area == 2)
//                $area_str = 'MN';
//
//            $code_today = array();
//            $location = array();
//            foreach ($this->data['location_today'][$area_str] as $value) {
//                $code_today[] = $value->code;
//                $location[$value->code] = $value;
//            }
//
//            foreach ($xs_title as $i => $value) {
//                if ($i == 0)
//                    continue;
//                $xs_loc = $value->find('span[class=s12]');
//                if (isset($xs_loc[0])) {
//                    $tmp = explode(':', $xs_loc[0]->text());
//                    if (isset($tmp[1])) {
//                        $code = trim($tmp[1]);
//                        if ($code == 'BT')
//                            $code = 'BTR';
//                        elseif ($code == 'QNG')
//                            $code = 'QNI';
//                        elseif ($code == 'DL')
//                            $code = 'LD';
//                        if (in_array($code, $code_today))
//                            $arr_loc[] = $code;
//                        else
//                            $check_loc = false;
//                    } else {
//                        $check_loc = false;
//                    }
//                } else {
//                    $check_loc = false;
//                }
//            }
//
////            $arr_loc = $code_today; //test
//            if ($check_loc == false)
//                return null;
//        } else {
        $arr_loc[0] = 'MB';
//        }
//        if ($area == 0)
        $xs_block = $html->find('ul[class=list-kqmb] li[class=pad5]');
//        else
//            $xs_block = $html->find('ul[class=list-col] li[class=pad5]');

        if (empty($xs_block)) {
            $this->saveLog('ul[class=list-kqmb] li[class=pad5] Not Found!');
            return null;
        }

        foreach ($xs_block as $giai => $item) {
            $arr_so = $item->find('div span');
            foreach ($arr_so as $pos => $value) {
                $so = trim($value->text());
//                if ($area == 0)
                $pos = 0;

                if (!isset($status_list[$arr_loc[$pos]]))
                    $status_list[$arr_loc[$pos]] = 0;
                switch ($giai) {
                    case 0:
                        if ($area == 0 && $so != '')
                            $status_list[$arr_loc[$pos]] = 1;

                        if ($so == '') {
//                            if ($area == 0)
                            $so = '*****';
//                            else
//                                $so = '**';
                        }

                        $k = $giai;
//                        if ($area > 0)
//                            $k = 8;
                        $data_list[$arr_loc[$pos]][$k] = $so;

                        $sub = substr($so, -2, 2);
                        $arr_loto_list[$arr_loc[$pos]][] = $sub;
                        $datab_list[$arr_loc[$pos]][$k] = $sub;
                        break;
                    case 1:
                        if ($so == '') {
//                            if ($area == 0)
                            $so = '*****';
//                            else
//                                $so = '***';
                        }

                        $k = $giai;
//                        if ($area > 0)
//                            $k = 7;
                        $data_list[$arr_loc[$pos]][$k] = $so;

                        $sub = substr($so, -2, 2);
                        $arr_loto_list[$arr_loc[$pos]][] = $sub;
                        $datab_list[$arr_loc[$pos]][$k] = $sub;
                        break;
                    case 2:
                        if ($so == '') {
//                            if ($area == 0)
                            $so = '*****';
//                            else
//                                $so = '****';
                        }

                        $k = $giai;
//                        if ($area > 0) {
//                            $k = 6;
//                            $pos = $pos % count($arr_loc);
//                        }
                        if (!isset($data_list[$arr_loc[$pos]][$k]))
                            $data_list[$arr_loc[$pos]][$k] = $so;
                        else
                            $data_list[$arr_loc[$pos]][$k] .= '-' . $so;

                        $sub = substr($so, -2, 2);
                        $arr_loto_list[$arr_loc[$pos]][] = $sub;

                        if (!isset($datab_list[$arr_loc[$pos]][$k]))
                            $datab_list[$arr_loc[$pos]][$k] = $sub;
                        else
                            $datab_list[$arr_loc[$pos]][$k] .= ',' . $sub;
                        break;
                    case 3:
                        if ($so == '') {
//                            if ($area == 0)
                            $so = '*****';
//                            else
//                                $so = '****';
                        }

                        $k = $giai;
//                        if ($area > 0) {
//                            $k = 5;
//                            $data_list[$arr_loc[$pos]][$k] = $so;
//
//                            $sub = substr($so, -2, 2);
//                            $arr_loto_list[$arr_loc[$pos]][] = $sub;
//                            $datab_list[$arr_loc[$pos]][$k] = $sub;
//                        } else {
                        if (!isset($data_list[$arr_loc[$pos]][$k]))
                            $data_list[$arr_loc[$pos]][$k] = $so;
                        else
                            $data_list[$arr_loc[$pos]][$k] .= '-' . $so;

                        $sub = substr($so, -2, 2);
                        $arr_loto_list[$arr_loc[$pos]][] = $sub;

                        if (!isset($datab_list[$arr_loc[$pos]][$k]))
                            $datab_list[$arr_loc[$pos]][$k] = $sub;
                        else
                            $datab_list[$arr_loc[$pos]][$k] .= ',' . $sub;
//                        }
                        break;
                    case 4:
                        if ($so == '') {
//                            if ($area == 0)
                            $so = '****';
//                            else
//                                $so = '*****';
                        }

                        $k = $giai;
//                        if ($area > 0) {
//                            $pos = $pos % count($arr_loc);
//                        }
                        if (!isset($data_list[$arr_loc[$pos]][$k]))
                            $data_list[$arr_loc[$pos]][$k] = $so;
                        else
                            $data_list[$arr_loc[$pos]][$k] .= '-' . $so;

                        $sub = substr($so, -2, 2);
                        $arr_loto_list[$arr_loc[$pos]][] = $sub;

                        if (!isset($datab_list[$arr_loc[$pos]][$k]))
                            $datab_list[$arr_loc[$pos]][$k] = $sub;
                        else
                            $datab_list[$arr_loc[$pos]][$k] .= ',' . $sub;
                        break;
                    case 5:
                        if ($so == '') {
//                            if ($area == 0)
                            $so = '****';
//                            else
//                                $so = '*****';
                        }

                        $k = $giai;
//                        if ($area > 0) {
//                            $k = 3;
//                            $pos = $pos % count($arr_loc);
//                        }
                        if (!isset($data_list[$arr_loc[$pos]][$k]))
                            $data_list[$arr_loc[$pos]][$k] = $so;
                        else
                            $data_list[$arr_loc[$pos]][$k] .= '-' . $so;

                        $sub = substr($so, -2, 2);
                        $arr_loto_list[$arr_loc[$pos]][] = $sub;

                        if (!isset($datab_list[$arr_loc[$pos]][$k]))
                            $datab_list[$arr_loc[$pos]][$k] = $sub;
                        else
                            $datab_list[$arr_loc[$pos]][$k] .= ',' . $sub;
                        break;
                    case 6:
                        if ($so == '') {
//                            if ($area == 0)
                            $so = '***';
//                            else
//                                $so = '*****';
                        }

                        $k = $giai;
//                        if ($area > 0) {
//                            $k = 2;
//                            $data_list[$arr_loc[$pos]][$k] = $so;
//
//                            $sub = substr($so, -2, 2);
//                            $arr_loto_list[$arr_loc[$pos]][] = $sub;
//                            $datab_list[$arr_loc[$pos]][$k] = $sub;
//                        } else {
                        if (!isset($data_list[$arr_loc[$pos]][$k]))
                            $data_list[$arr_loc[$pos]][$k] = $so;
                        else
                            $data_list[$arr_loc[$pos]][$k] .= '-' . $so;

                        $sub = substr($so, -2, 2);
                        $arr_loto_list[$arr_loc[$pos]][] = $sub;

                        if (!isset($datab_list[$arr_loc[$pos]][$k]))
                            $datab_list[$arr_loc[$pos]][$k] = $sub;
                        else
                            $datab_list[$arr_loc[$pos]][$k] .= ',' . $sub;
//                        }
                        break;
                    case 7:
                        if ($so == '') {
//                            if ($area == 0)
                            $so = '**';
//                            else
//                                $so = '*****';
                        }

                        $k = $giai;
//                        if ($area > 0) {
//                            $k = 1;
//                            $data_list[$arr_loc[$pos]][$k] = $so;
//
//                            $sub = substr($so, -2, 2);
//                            $arr_loto_list[$arr_loc[$pos]][] = $sub;
//                            $datab_list[$arr_loc[$pos]][$k] = $sub;
//                        } else {
                        if (!isset($data_list[$arr_loc[$pos]][$k]))
                            $data_list[$arr_loc[$pos]][$k] = $so;
                        else
                            $data_list[$arr_loc[$pos]][$k] .= '-' . $so;

                        $sub = substr($so, -2, 2);
                        $arr_loto_list[$arr_loc[$pos]][] = $sub;

                        if (!isset($datab_list[$arr_loc[$pos]][$k]))
                            $datab_list[$arr_loc[$pos]][$k] = $sub;
                        else
                            $datab_list[$arr_loc[$pos]][$k] .= ',' . $sub;
//                        }
                        break;
//                    case 8:
//                        if ($area > 0) {
//                            if ($so != '')
//                                $status_list[$arr_loc[$pos]] = 1;
//
//                            if ($so == '')
//                                $so = '******';
//
//                            $data_list[$arr_loc[$pos]][0] = $so;
//
//                            $sub = substr($so, -2, 2);
//                            $arr_loto_list[$arr_loc[$pos]][] = $sub;
//                            $datab_list[$arr_loc[$pos]][0] = $sub;
//                        }
//                        break;

                    default:
                        break;
                }
            }
        }
//        if ($area == 0) {
        $code = 'MB';
        $result[$code]['lid'] = 1;
        $result[$code]['area'] = $area;
        $result[$code]['code'] = $code;
        $result[$code]['name'] = 'Miền Bắc';
        $result[$code]['alias'] = 'xo-so-mien-bac';

        $data_list[$code][8] = '';
        $datab_list[$code][8] = '';

        ksort($data_list[$code]);
        ksort($datab_list[$code]);

        $result[$code]['data'] = $data_list[$code];
        $result[$code]['data_b'] = $datab_list[$code];
        $result[$code]['extra'] = $this->getExtra($arr_loto_list[$code]);
        $result[$code]['status'] = $status_list[$code];
//        } else {
//            foreach ($arr_loc as $code) {
//                $result[$code]['lid'] = $location[$code]->id;
//                $result[$code]['area'] = $area;
//                $result[$code]['code'] = $code;
//                $result[$code]['name'] = $location[$code]->name;
//                $result[$code]['alias'] = $location[$code]->alias;
//
//                ksort($data_list[$code]);
//                ksort($datab_list[$code]);
//
//                $result[$code]['data'] = $data_list[$code];
//                $result[$code]['data_b'] = $datab_list[$code];
//                $result[$code]['extra'] = $this->getExtra($arr_loto_list[$code]);
//                $result[$code]['status'] = $status_list[$code];
//            }
//        }

        $html->clear();
        unset($html);

        unset($arr_loc, $area, $link, $url, $data_list, $datab_list, $arr_loto_list, $status_list);
        unset($xs_title, $xs_block, $giai, $item, $arr_so, $http_response_header);
        unset($opts, $context, $date, $pattern, $regs, $pos, $value, $so, $k, $sub, $code);
//        var_dump((get_defined_vars()));
//        var_dump($result);
//        die;

        return $result;
    }

    function getExtra($arr_loto) {
        $result = array();

        $result[0] = '';
        $result[1] = '';
        $result[2] = '';
        $result[3] = '';
        $result[4] = '';
        $result[5] = '';
        $result[6] = '';
        $result[7] = '';
        $result[8] = '';
        $result[9] = '';

        //lay loto duoi
        $total = count($arr_loto);
        for ($j = 0; $j < $total; $j++) {
            $dau = substr($arr_loto[$j], 0, 1);
            $duoi = substr($arr_loto[$j], 1, 1);
            if ($dau == '0') {
                if ($result[0] == '')
                    $result[0] = $duoi;
                else
                    $result[0] .= ',' . $duoi;
            }elseif ($dau == '1') {
                if ($result[1] == '')
                    $result[1] = $duoi;
                else
                    $result[1] .= ',' . $duoi;
            }elseif ($dau == '2') {
                if ($result[2] == '')
                    $result[2] = $duoi;
                else
                    $result[2] .= ',' . $duoi;
            }elseif ($dau == '3') {
                if ($result[3] == '')
                    $result[3] = $duoi;
                else
                    $result[3] .= ',' . $duoi;
            }elseif ($dau == '4') {
                if ($result[4] == '')
                    $result[4] = $duoi;
                else
                    $result[4] .= ',' . $duoi;
            }elseif ($dau == '5') {
                if ($result[5] == '')
                    $result[5] = $duoi;
                else
                    $result[5] .= ',' . $duoi;
            }elseif ($dau == '6') {
                if ($result[6] == '')
                    $result[6] = $duoi;
                else
                    $result[6] .= ',' . $duoi;
            }elseif ($dau == '7') {
                if ($result[7] == '')
                    $result[7] = $duoi;
                else
                    $result[7] .= ',' . $duoi;
            }elseif ($dau == '8') {
                if ($result[8] == '')
                    $result[8] = $duoi;
                else
                    $result[8] .= ',' . $duoi;
            }elseif ($dau == '9') {
                if ($result[9] == '')
                    $result[9] = $duoi;
                else
                    $result[9] .= ',' . $duoi;
            }
        }

        return $result;
    }

    function get_xstt($area = 2) {
        $link = array(
            site_url() . 'xoso_mobile/ttttmb.php',
            site_url() . 'xoso_mobile/ttttmt.php',
            site_url() . 'xoso_mobile/ttttmn.php'
        );

        $result = array();
        $xml = simplexml_load_file($link[$area], 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($area > 0) {
            foreach (get_object_vars($xml) as $code => $item) {
                $data = array();
                $data_b = array();
                $result[$code]['area'] = $area;
                $result[$code]['code'] = $code;
                $result[$code]['status'] = 0;

//                $arr = explode(',', 'AG,BD,BDI,BL,BP,BTH,BTR,CM,CT,DLK,DN,DNG,DNO,DT,GL,HCM,HG,KG,KH,KT,LA,LD,MB,NT,PY,QB,QNI,QNM,QT,ST,TG,TN,TTH,TV,VL,VT');
//                foreach ($arr as $code) {
                if (!$this->simple_cache->is_cached('location-' . $code)) {
                    $_list = $this->db->select('id,name,alias')->from('xs_location')
                                    ->where('status', 1)
                                    ->where('code', $code)
                                    ->get()->row();
//                echo $this->db->last_query();
                    // store in cache
                    $this->simple_cache->cache_item('location-' . $code, $_list);
                } else {
                    $_list = $this->simple_cache->get_item('location-' . $code);
                }
//                }

                if ($_list) {
                    $result[$code]['lid'] = $_list->id;
                    $result[$code]['name'] = $_list->name;
                    $result[$code]['alias'] = $_list->alias;
                } else {
                    $this->saveLog('Location ' . $tinh . ' Not Found!');
                    return null;
                }
                foreach (get_object_vars($item) as $k => $v) {
                    $v = trim($v);
                    if (isset($titleList[$k])) {
                        $k = $titleList[$k];
                    } else if (preg_match('/dau(\d)/ism', $k, $matche)) {
                        $k = $matche[1];
                        $result[$code]['extra'][$k] = $v;
                    } else if (preg_match('/giai([\w]+)/ism', $k, $matche)) {
                        if ($matche[1] != 'dacbiet') {
                            if ($k == 'giaidacbietsauso' || $k == 'giaidacbiet')
                                $v = '******';
                            elseif ($k == 'giainhat' || $k == 'giainhi')
                                $v = '*****';
                            elseif ($k == 'giaiba')
                                $v = str_replace('?', '*****', $v);
                            elseif ($k == 'giaitu')
                                $v = str_replace('?', '*****', $v);
                            elseif ($k == 'giainam')
                                $v = '****';
                            elseif ($k == 'giaisau')
                                $v = str_replace('?', '****', $v);
                            elseif ($k == 'giaibay')
                                $v = '***';
                            elseif ($k == 'giaitam')
                                $v = '**';

                            $data[] = $v;
                            $arr_v = explode('-', $v);
                            if ($arr_v) {
                                $arr_data_b = array();
                                foreach ($arr_v as $value) {
                                    $arr_data_b[] = substr($value, -2, 2);
                                }
                                $data_b[] = implode(',', $arr_data_b);
                            }
                        }
                    } else if (preg_match('/status/ism', $k, $matche)) {
                        if ($v == 'quayxong')
                            $result[$code]['status'] = 1;
                    }
                }

                if (!isset($data[8]))
                    $data[8] = '';
                if (!isset($data_b[8]))
                    $data_b[8] = '';

                $result[$code]['data'] = $data;
                $result[$code]['data_b'] = $data_b;
            }
        } else {
            $code = 'MB';
            $result[$code]['area'] = $area;
            $result[$code]['code'] = $code;
            $result[$code]['status'] = 0;
            $result[$code]['lid'] = 1;
            $result[$code]['name'] = 'Miền Bắc';
            $result[$code]['alias'] = 'xo-so-mien-bac';
            $data = array();
            $data_b = array();
            foreach (get_object_vars($xml) as $k => $v) {
                if (strpos($k, '@') === 0) {
                    continue;
                }
                $k = trim($k);
                $v = trim($v);
                if (isset($titleList[$k])) {
                    $k = $titleList[$k];
                } else if (preg_match('/dau(\d)/ism', $k, $matche)) {
                    $k = $matche[1];
                    $result[$code]['extra'][$k] = $v;
                } else if (preg_match('/giai([\w]+)/ism', $k, $matche)) {
                    if ($v == '.?.')
                        $v = '*****';
                    elseif ($v == '?-?')
                        $v = '*****-*****';
                    elseif ($k == 'giaiba')
                        $v = str_replace('?', '*****', $v);
                    elseif ($k == 'giaitu' || $k == 'giainam')
                        $v = str_replace('?', '****', $v);
                    elseif ($k == 'giaisau')
                        $v = str_replace('?', '***', $v);
                    elseif ($k == 'giaibay')
                        $v = str_replace('?', '**', $v);

                    $data[] = $v;
                    $arr_v = explode('-', $v);
                    if ($arr_v) {
                        $arr_data_b = array();
                        foreach ($arr_v as $value) {
                            $arr_data_b[] = substr($value, -2, 2);
                        }
                        $data_b[] = implode(',', $arr_data_b);
                    }
                } else if (preg_match('/status/ism', $k, $matche)) {
                    if ($v == 'quayxong')
                        $result[$code]['status'] = 1;
                }
            }

            if (!isset($data[8]))
                $data[8] = '';
            if (!isset($data_b[8]))
                $data_b[8] = '';

            $result[$code]['data'] = $data;
            $result[$code]['data_b'] = $data_b;
        }
        return $result;
    }

    function get_xstt_minhngoc($area = 2, $sendSMS = 0) {
        $link = array(
            'http://www.minhngoc.net.vn/xstt/MB/MB.php?visit=0',
            'http://www.minhngoc.net.vn/xstt/MT/MT.php?visit=0',
            'http://www.minhngoc.net.vn/xstt/MN/MN.php?visit=0'
        );

        $result = array();
        $ctx = stream_context_create(array('http' => array('timeout' => 30)));
        $html = file_get_contents($link[$area], false, $ctx);

        if ($html) {
            $rs_array = explode(';', $html);
        } else {
            $this->saveLog('minhngoc - HTML empty!');
            return null;
        }

        if ($rs_array[0] != 'runtt=1') {
            $this->saveLog('"runtt=1" Not Found!');
            return null;
        }

        $rs_array[1] = str_replace('"', '', $rs_array[1]);
        list($var, $arr_tinh) = explode('=', $rs_array[1]);
//        $arr_tinh='46,47,48,49,50,51,1,3,2,27,26,9,7,8,28,29,10,12,11,30,31,15,14,13,32,34,33,17,18,16,35,36,21,20,19,38,37,23,24,22,39';
        $arr_tinh = explode(',', $arr_tinh);
        foreach ($arr_tinh as $tinh) {
            if ($area > 0) {
                if (!$this->simple_cache->is_cached('location' . $tinh)) {
                    $_list = $this->db->select('id,name,code,alias')->from('xs_location')
                                    ->where('status', 1)
                                    ->like('id_tinh', ',' . $tinh . ',')
                                    ->get()->row();
//            echo $this->db->last_query();
                    if (!$_list) {
                        $this->saveLog('Location ' . $tinh . ' Not Found!');
                        return null;
                    }
                    // store in cache
                    $this->simple_cache->cache_item('location' . $tinh, $_list);
                } else {
                    $_list = $this->simple_cache->get_item('location' . $tinh);
                }
                $code = $_list->code;
                $result[$code]['lid'] = $_list->id;
                $result[$code]['name'] = $_list->name;
                $result[$code]['alias'] = $_list->alias;
            } else {
                $code = 'MB';
                $result[$code]['lid'] = 1;
                $result[$code]['name'] = 'Miền Bắc';
                $result[$code]['alias'] = 'xo-so-mien-bac';
            }

            $result[$code]['area'] = $area;
            $result[$code]['code'] = $code;
            $data = array();
            $data_b = array();
            $arr_loto = array();
            $data[8] = '';
            $data_b[8] = '';
            foreach ($rs_array as $value) {
                list($tengiai, $so) = explode('=', $value);
                $tengiai = trim($tengiai);
                $so = trim(str_replace('"', '', $so));
                if ($tengiai == 'kqxs["T' . $tinh . '_G8"]') {
                    $sub = substr($so, -2, 2);
                    $arr_loto[] = $sub;
                    $data_b[8] = $sub;
                    $data[8] = $so;
//                    } elseif (preg_match('/^kqxs\["T' . $tinh . '_G7/ism', $tengiai)) {
                } elseif (strpos($tengiai, 'kqxs["T' . $tinh . '_G7') !== false) {
                    $sub = substr($so, -2, 2);
                    $arr_loto[] = $sub;

                    if (!isset($data_b[7]))
                        $data_b[7] = $sub;
                    else
                        $data_b[7] .= ',' . $sub;

                    if (!isset($data[7]))
                        $data[7] = $so;
                    else
                        $data[7] .= '-' . $so;
//                    }elseif (preg_match('/^kqxs\["T' . $tinh . '_G6/ism', $tengiai)) {
                } elseif (strpos($tengiai, 'kqxs["T' . $tinh . '_G6') !== false) {
                    $sub = substr($so, -2, 2);
                    $arr_loto[] = $sub;

                    if (!isset($data_b[6]))
                        $data_b[6] = $sub;
                    else
                        $data_b[6] .= ',' . $sub;

                    if (!isset($data[6]))
                        $data[6] = $so;
                    else
                        $data[6] .= '-' . $so;
//                    }elseif (preg_match('/^kqxs\["T' . $tinh . '_G5/ism', $tengiai)) {
                } elseif (strpos($tengiai, 'kqxs["T' . $tinh . '_G5') !== false) {
                    $sub = substr($so, -2, 2);
                    $arr_loto[] = $sub;

                    if (!isset($data_b[5]))
                        $data_b[5] = $sub;
                    else
                        $data_b[5] .= ',' . $sub;

                    if (!isset($data[5]))
                        $data[5] = $so;
                    else
                        $data[5] .= '-' . $so;
//                    }elseif (preg_match('/^kqxs\["T' . $tinh . '_G4/ism', $tengiai)) {
                } elseif (strpos($tengiai, 'kqxs["T' . $tinh . '_G4') !== false) {
                    $sub = substr($so, -2, 2);
                    $arr_loto[] = $sub;

                    if (!isset($data_b[4]))
                        $data_b[4] = $sub;
                    else
                        $data_b[4] .= ',' . $sub;

                    if (!isset($data[4]))
                        $data[4] = $so;
                    else
                        $data[4] .= '-' . $so;
//                    }elseif (preg_match('/^kqxs\["T' . $tinh . '_G3/ism', $tengiai)) {
                } elseif (strpos($tengiai, 'kqxs["T' . $tinh . '_G3') !== false) {
                    $sub = substr($so, -2, 2);
                    $arr_loto[] = $sub;

                    if (!isset($data_b[3]))
                        $data_b[3] = $sub;
                    else
                        $data_b[3] .= ',' . $sub;

                    if (!isset($data[3]))
                        $data[3] = $so;
                    else
                        $data[3] .= '-' . $so;
//                    }elseif (preg_match('/^kqxs\["T' . $tinh . '_G2/ism', $tengiai)) {
                } elseif (strpos($tengiai, 'kqxs["T' . $tinh . '_G2') !== false) {
                    $sub = substr($so, -2, 2);
                    $arr_loto[] = $sub;

                    if (!isset($data_b[2]))
                        $data_b[2] = $sub;
                    else
                        $data_b[2] .= ',' . $sub;

                    if (!isset($data[2]))
                        $data[2] = $so;
                    else
                        $data[2] .= '-' . $so;
                }elseif ($tengiai == 'kqxs["T' . $tinh . '_G1"]') {
                    $sub = substr($so, -2, 2);
                    $arr_loto[] = $sub;
                    $data_b[1] = $sub;
                    $data[1] = $so;
                } elseif ($tengiai == 'kqxs["T' . $tinh . '_Gdb"]') {
                    $sub = substr($so, -2, 2);
                    $arr_loto[] = $sub;
                    $data_b[0] = $sub;
                    $data[0] = $so;
                }
                if ($area == 0) {
                    if ($tengiai == 'kqxs["Tdttt4_G1"]')
                        $result[$code]['dtthantai4'] = $so;
                    elseif ($tengiai == 'kqxs["Tdt123_G1"]')
                        $result[$code]['dt123'][0] = $so;
                    elseif ($tengiai == 'kqxs["Tdt123_G2"]')
                        $result[$code]['dt123'][1] = $so;
                    elseif ($tengiai == 'kqxs["Tdt123_G3"]')
                        $result[$code]['dt123'][2] = $so;
                    elseif ($tengiai == 'kqxs["Tdt6x36_G1"]')
                        $result[$code]['dt6x36'][0] = $so;
                    elseif ($tengiai == 'kqxs["Tdt6x36_G2"]')
                        $result[$code]['dt6x36'][1] = $so;
                    elseif ($tengiai == 'kqxs["Tdt6x36_G3"]')
                        $result[$code]['dt6x36'][2] = $so;
                    elseif ($tengiai == 'kqxs["Tdt6x36_G4"]')
                        $result[$code]['dt6x36'][3] = $so;
                    elseif ($tengiai == 'kqxs["Tdt6x36_G5"]')
                        $result[$code]['dt6x36'][4] = $so;
                    elseif ($tengiai == 'kqxs["Tdt6x36_G6"]')
                        $result[$code]['dt6x36'][5] = $so;
                }
            }

            ksort($data);
            ksort($data_b);
            $result[$code]['data'] = $data;
            $result[$code]['data_b'] = $data_b;
            $result[$code]['extra'] = $this->getExtra($arr_loto);

            $status = 0;
            if (strpos($data[0], '*') === false && strpos($data[0], '+') === false)
                $status = 1;

//                if ($sendSMS == 1) {
//                    if ($status == 1) {
//                        //gui tin nhan den cac so dien thoai dang ky nhan KQXS 30 ngay
////                        $this->sendSMS_KQXS($code, $result[$code]['data']);
//                        $this->sendSMS_KQXS_($code, $result[$code]['data']);
//                        //gui tin nhan tung giai den cac so dien thoai dang ky TTTT
////                        $this->sendSMS_TTXS($code, $result[$code]['data']);
//                        $this->sendSMS_TTXS_($code, $result[$code]['data']);
//                    } else {
//                        //gui tin nhan tung giai den cac so dien thoai dang ky TTTT
////                        $this->sendSMS_TTXS($code, $result[$code]['data']);
//                        $this->sendSMS_TTXS_($code, $result[$code]['data']);
//                    }
//                }

            $result[$code]['status'] = $status;
        }

//        $this->saveLog('Location today: ' . json_encode($arr_tinh));

        unset($ctx, $area, $sendSMS, $link, $http_response_header, $html, $rs_array, $arr_tinh, $var, $tinh, $_list, $code, $data, $data_b, $arr_loto, $value, $so, $tengiai, $sub, $status);
//        var_dump((get_defined_vars()));
//        var_dump($result);
//        die;
        return $result;
    }

    function SendMT($mtseq, $moid, $moseq, $src, $dest, $cmdcode, $msgbody, $msgtype, $msgtitle, $mttotalseg, $mtseqref, $cpid, $reqtime, $procresult, $opid, $username, $password) {
//         $WSDL = 'http://123.30.172.183:92/SendMT.asmx?wsdl';
        $WSDL = 'http://103.24.244.227:8081/SendMT.asmx?wsdl';
        $client = new nusoap_client($WSDL, true);
        $client->soap_defencoding = 'UTF-8';
        $status = $client->call('SendMT', array(
            'mtseq' => $mtseq,
            'moid' => $moid,
            'moseq' => $moseq,
            'src' => $dest, // ngược lại với receiveMO
            'dest' => $src,
            'cmdcode' => $cmdcode,
            'msgbody' => $msgbody,
            'msgtype' => $msgtype,
            'msgtitle' => $msgtitle,
            'mttotalseg' => $mttotalseg,
            'mtseqref' => $mtseqref,
            'cpid' => $cpid,
            'reqtime' => $reqtime,
            'procersult' => $procresult,
            'opid' => $opid,
            'username' => $username,
            'password' => $password
                )
        );
        return $status;
    }

    function SendMT_($dienThoai, $sendfrom, $keyword, $outcontent, $flag, $SeqNo, $Total) {
        $client = new nusoap_client('http://112.78.7.141:1500/MVASCONTENT/MTSend.asmx?WSDL', true);
        $err = $client->getError();

        if ($err) {
//        echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
            exit;
        } else {
//        echo '<h2>Successfully connected</h2>';
        }

        $client->soap_defencoding = 'UTF-8';
        $type = '0';
        $secu = 'xT12#@'; //secretcode là xT12#@

        $param = array(
            'Destination' => $dienThoai, //so dien thoai
            'SendFrom' => $sendfrom, //dau so 8x17
            'KeywordName' => $keyword, //ma dich vu
            'OutContent' => $outcontent, //noi dung tin nhan
            'ChargingFlag' => $flag, //tinh tien =1, ko tinh =0
            'MOSeqNo' => $SeqNo, //ma tin nhan
            'TotalMessage' => $Total, //tong MT
            'ContentType' => $type, //text =0
            'SecretCode' => $secu, //ma so bi mat VNPAY cung cap
        );
        $result = $client->call('SendMT', $param);
//        echo '<pre>';
//        var_dump($client->debug_str);
//    $result['SendMTResult']   thành công =0; thất bại =-1
        return $result;
    }

    function getOpID($src) {
        $opid = 'VMS8x88'; //mobile

        if (strlen($src) == 11) {
            $tmp = substr($src, 0, 4);
            if ($tmp == '8490' || $tmp == '8493')
                $opid = 'VMS8x88'; //mobile
            elseif ($tmp == '8491' || $tmp == '8494')
                $opid = 'GPC8x88'; //vina
            elseif ($tmp == '8496' || $tmp == '8497' || $tmp == '8498')
                $opid = 'VTL8x88'; //viettel
        } elseif (strlen($src) == 12) {
            $tmp = substr($src, 0, 5);
            if ($tmp == '84120' || $tmp == '84121' || $tmp == '84122' || $tmp == '84126' || $tmp == '84128')
                $opid = 'VMS8x88'; //mobile
            elseif ($tmp == '84123' || $tmp == '84124' || $tmp == '84125' || $tmp == '84127' || $tmp == '84129')
                $opid = 'GPC8x88'; //vina
            elseif ($tmp == '84162' || $tmp == '84163' || $tmp == '84164' || $tmp == '84165' || $tmp == '84166' || $tmp == '84167' || $tmp == '84168' || $tmp == '84169')
                $opid = 'VTL8x88'; //viettel
        }
        return $opid;
    }

    function sendSMS_KQXS($code, $data) {
        $content = $code . ' ' . date('d/m', time()) . ":\n";
        $content .= 'DB:' . $data[0] . "\n";
        $content .= '1:' . $data[1] . "\n";
        $content .= '2:' . $data[2] . "\n";
        $content .= '3:' . $data[3] . "\n";
        $content .= '4:' . $data[4] . "\n";
        $content .= '5:' . $data[5] . "\n";
        $content .= '6:' . $data[6] . "\n";
        $content .= '7:' . $data[7] . "\n";

        if ($code != 'MB') {
            $content .= '8:' . $data[8] . "\n";
        }

        $time = strtotime(date('d-m-Y', time()) . ' 00:00:00');
        $query = 'SELECT id,mobile,dau_so_nhan_tin,day30
                    FROM xs_sms
                    WHERE day30>0 AND day30<999 AND dau_so_nhan_tin=\'8788\' AND item_id=\'KQ' . $code . '\' AND time<' . $time
        ;

        $rs = $this->db->query($query)->result();

        $procresult = '0';

        $msgtype = 'text';
        $msgtitle = 'Welcome xoso.com';
        $mttotalseg = '1';  //1 tin nhắn trả về cho 1 MO yêu cầu - ko trả nhiều nên mặc định là 1
        $mtseqref = '1'; // tăng theo thứ tự  1 2 3 4 5 theo tổng số MT trả về - ko trả nhiều nên mặc định là 1

        $cpid = '337';
        $username = 'hts';
        $password = 'xzK0cdGNtp';

        $moid = '337';
        $moseq = '337';
        $cmdcode = 'BHX';
        $dest = '8088';
        $opid = 'VMS8x88';
        $this->load->model('xs_mtseq_model');

        foreach ($rs as $value) {
            $msgbody = $content;
            $reqtime = date('YmdHis');
            $src = $value->mobile;
            $dest = $value->dau_so_nhan_tin;
            $opid = $this->getOpID($src);

            $data = array('mobile' => $src);
            $this->xs_mtseq_model->insert($data);
            $mtseq = $this->db->insert_id();

            if (strlen($msgbody) > 160) {
                if (preg_match('/(^.{1,160})\n(.*)/ism', $msgbody, $match)) {
                    $msgbody = $match[1];
                    $status = $this->SendMT($mtseq, $moid, $moseq, $src, $dest, $cmdcode, $msgbody, $msgtype, $msgtitle, $mttotalseg, $mtseqref, $cpid, $reqtime, $procresult, $opid, $username, $password);
//                    if (isset($status['SendMTResult']) && $status['SendMTResult'] == '202') {
                    $msgbody = $match[2];

                    $data = array('mobile' => $src);
                    $this->xs_mtseq_model->insert($data);
                    $mtseq = $this->db->insert_id();

                    $status = $this->SendMT($mtseq, $moid, $moseq, $src, $dest, $cmdcode, $msgbody, $msgtype, $msgtitle, $mttotalseg, $mtseqref, $cpid, $reqtime, $procresult, $opid, $username, $password);
//                    }
                }
            } else {
                $status = $this->SendMT($mtseq, $moid, $moseq, $src, $dest, $cmdcode, $msgbody, $msgtype, $msgtitle, $mttotalseg, $mtseqref, $cpid, $reqtime, $procresult, $opid, $username, $password);
            }

//            if (isset($status['SendMTResult']) && $status['SendMTResult'] == '202') {
            $data = array('time' => time(), 'day30' => $value->day30 - 1);
            $this->xs_sms_model->update($value->id, $data);
//            }
        }
    }

    function sendSMS_XM($area) {
        if ($area == 0)
            return;

        $code = 'MT';
        $serviceCode = 'XMT';
        if ($area == 2) {
            $code = 'MN';
            $serviceCode = 'XMN';
        }

        $content = '';
        $data = file_get_contents('http://xoso.com:81/client/getcontent?serviceCode=' . $serviceCode . '&Type=2');
        $data = json_decode($data);
        if ($data->List) {
            foreach ($data->List as $val) {
                $content .= $val->Content . '.';
            }
        }

        $time = strtotime(date('d-m-Y', time()) . ' 00:00:00');
        $query = 'SELECT id,mobile,dau_so_nhan_tin,day30
                    FROM xs_sms
                    WHERE day30>0 AND day30<999 AND (dau_so_nhan_tin=\'8717\' OR dau_so_nhan_tin=\'8517\') AND item_id=\'KQ_' . $code . '\' AND time<' . $time
        ;

        $rs = $this->db->query($query)->result();
        if (!$rs)
            return;

        $query = 'SELECT Seqno FROM xs_mo_receiver ORDER BY id DESC';
        $Seqno = $this->db->query($query)->row()->Seqno;

        $KeywordName = 'KQ';
        $procresult = '0';

        foreach ($rs as $value) {
            $response = $content;
            $Destination = $value->mobile;
            $SendFrom = $value->dau_so_nhan_tin;

            if (strlen($response) > 160) {
                if (preg_match('/(^.{1,160})\n(.*)/ism', $response, $match)) {
                    $total = count($match);

                    for ($ii = 1; $ii <= $total; $ii++) {
                        if (!isset($match[$ii]))
                            break;

                        if ($ii == 1) {
                            $response = $match[$ii]; //nội dung trả về
                            $this->SendMT_($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, $total);
                        } else {
                            $response = $match[$ii];

                            if (trim($response) != '') {
                                SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, 0, $total);
                                $this->SendMT_($Destination, $SendFrom, $KeywordName, $response, $procresult, 0, $total);
                            }
                        }
                    }
                }
            } else {
                $this->SendMT_($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
            }

            $data = array('time' => time(), 'day30' => $value->day30 - 1);
            $this->xs_sms_model->update($value->id, $data);
        }
    }

    function sendSMS_KQXS_($code, $data) {
        $content = $code . ' ' . date('d/m', time()) . ":\n";
        $content .= 'DB:' . $data[0] . "\n";
        $content .= '1:' . $data[1] . "\n";
        $content .= '2:' . $data[2] . "\n";
        $content .= '3:' . $data[3] . "\n";
        $content .= '4:' . $data[4] . "\n";
        $content .= '5:' . $data[5] . "\n";
        $content .= '6:' . $data[6] . "\n";
        $content .= '7:' . $data[7] . "\n";

        if ($code != 'MB') {
            $content .= '8:' . $data[8] . "\n";
        }

        $time = strtotime(date('d-m-Y', time()) . ' 00:00:00');
        $query = 'SELECT id,mobile,dau_so_nhan_tin,day30
                    FROM xs_sms
                    WHERE day30>0 AND day30<999 AND (dau_so_nhan_tin=\'8717\' OR dau_so_nhan_tin=\'8517\') AND item_id=\'KQ_' . $code . '\' AND time<' . $time
        ;

        $rs = $this->db->query($query)->result();
        if (!$rs)
            return;

        $query = 'SELECT Seqno FROM xs_mo_receiver ORDER BY id DESC';
        $Seqno = $this->db->query($query)->row()->Seqno;

        $KeywordName = 'KQ';
        $procresult = '0';

        foreach ($rs as $value) {
            $response = $content;
            $Destination = $value->mobile;
            $SendFrom = $value->dau_so_nhan_tin;

            if (strlen($response) > 160) {
                if (preg_match('/(^.{1,160})\n(.*)/ism', $response, $match)) {
                    $response = $match[1];
                    $status = $this->SendMT_($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 2);
//                    if (isset($status['SendMTResult']) && $status['SendMTResult'] == '202') {
                    $response = $match[2];
                    $status = $this->SendMT_($Destination, $SendFrom, $KeywordName, $response, $procresult, 0, 2);
//                    }
                }
            } else {
                $status = $this->SendMT_($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
            }

//            if (isset($status['SendMTResult']) && $status['SendMTResult'] == '202') {
            $data = array('time' => time(), 'day30' => $value->day30 - 1);
            $this->xs_sms_model->update($value->id, $data);
//            }
        }
    }

    function sendSMS_TTXS($code, $data) {
        $item_id = 'TT';
        if ($code != 'MB') {
            $item_id = 'TT' . $code;
        }
        $query = 'SELECT id,mobile,dau_so_nhan_tin,a_all
                    FROM xs_sms
                    WHERE day30=999 AND status=0 AND dau_so_nhan_tin=\'8588\' AND item_id=\'' . $item_id . '\''
        ;

        $rs = $this->db->query($query)->result();

        $procresult = '0';

        $msgtype = 'text';
        $msgtitle = 'Welcome xoso.com';
        $mttotalseg = '1';  //1 tin nhắn trả về cho 1 MO yêu cầu - ko trả nhiều nên mặc định là 1
        $mtseqref = '1'; // tăng theo thứ tự  1 2 3 4 5 theo tổng số MT trả về - ko trả nhiều nên mặc định là 1

        $cpid = '337';
        $username = 'hts';
        $password = 'xzK0cdGNtp';

        $moid = '337';
        $moseq = '337';
        $cmdcode = 'BHX';
        $dest = '8088';
        $opid = 'VMS8x88';
        $this->load->model('xs_mtseq_model');

        foreach ($rs as $value) {
            $content = '';
            $a_all = '';
            $check_finished = false;

            if ($code == 'MB') {
                if (strpos($value->a_all, '0,') === false && $data[0] != '' && !preg_match('/[\*\+]+/ism', $data[0], $matchs)) {
                    $content .= 'DB:' . $data[0] . "\n";
                    $check_finished = true;
                }
                if (strpos($value->a_all, '1,') === false && $data[1] != '' && !preg_match('/[\*\+]+/ism', $data[1], $matchs)) {
                    $content .= '1:' . $data[1] . "\n";
                    $a_all .='1,';
                }
                if (strpos($value->a_all, '23,') === false
                        && $data[2] != ''
                        && $data[3] != ''
                        && !preg_match('/[\*\+]+/ism', $data[2], $matchs)
                        && !preg_match('/[\*\+]+/ism', $data[3], $matchs)
                ) {
                    $content .= '2:' . $data[2] . "\n";
                    $content .= '3:' . $data[3] . "\n";
                    $a_all .='23,';
                }
                if (strpos($value->a_all, '45,') === false
                        && $data[4] != ''
                        && $data[5] != ''
                        && !preg_match('/[\*\+]+/ism', $data[4], $matchs)
                        && !preg_match('/[\*\+]+/ism', $data[5], $matchs)
                ) {
                    $content .= '4:' . $data[4] . "\n";
                    $content .= '5:' . $data[5] . "\n";
                    $a_all .='45,';
                }
                if (strpos($value->a_all, '67,') === false
                        && $data[6] != ''
                        && $data[7] != ''
                        && !preg_match('/[\*\+]+/ism', $data[6], $matchs)
                        && !preg_match('/[\*\+]+/ism', $data[7], $matchs)
                ) {
                    $content .= '6:' . $data[6] . "\n";
                    $content .= '7:' . $data[7] . "\n";
                    $a_all .='67,';
                }
            } else {
                if (strpos($value->a_all, '8,') === false && $data[8] != '' && !preg_match('/[\*\+]+/ism', $data[8], $matchs)) {
                    $content .= '8:' . $data[8] . "\n";
                    $a_all .='8,';
                }
                if (strpos($value->a_all, '765,') === false
                        && $data[5] != ''
                        && $data[6] != ''
                        && $data[7] != ''
                        && !preg_match('/[\*\+]+/ism', $data[5], $matchs)
                        && !preg_match('/[\*\+]+/ism', $data[6], $matchs)
                        && !preg_match('/[\*\+]+/ism', $data[7], $matchs)
                ) {
                    $content .= '7:' . $data[7] . "\n";
                    $content .= '6:' . $data[6] . "\n";
                    $content .= '5:' . $data[5] . "\n";
                    $a_all .='765,';
                }
                if (strpos($value->a_all, '4,') === false && $data[4] != '' && !preg_match('/[\*\+]+/ism', $data[4], $matchs)) {
                    $content .= '4:' . $data[4] . "\n";
                    $a_all .='4,';
                }
                if (strpos($value->a_all, '321,') === false
                        && $data[1] != ''
                        && $data[2] != ''
                        && $data[3] != ''
                        && !preg_match('/[\*\+]+/ism', $data[1], $matchs)
                        && !preg_match('/[\*\+]+/ism', $data[2], $matchs)
                        && !preg_match('/[\*\+]+/ism', $data[3], $matchs)
                ) {
                    $content .= '3:' . $data[3] . "\n";
                    $content .= '2:' . $data[2] . "\n";
                    $content .= '1:' . $data[1] . "\n";
                    $a_all .='321,';
                }
                if (strpos($value->a_all, '0,') === false && $data[0] != '' && !preg_match('/[\*\+]+/ism', $data[0], $matchs)) {
                    $content .= 'DB:' . $data[0] . "\n";
                    $check_finished = true;
                }
            }

            if ($content != '') {
                $content = $code . ' ' . date('d/m', time()) . ":\n" . $content;

                $msgbody = 'KQ: '.$content;
                $reqtime = date('YmdHis');
                $src = $value->mobile;
                $dest = $value->dau_so_nhan_tin;
                $opid = $this->getOpID($src);

                $data = array('mobile' => $src);
                $this->xs_mtseq_model->insert($data);
                $mtseq = $this->db->insert_id();

                if (strlen($msgbody) > 160) {
                    if (preg_match('/(^.{1,160})\n(.*)/ism', $msgbody, $match)) {
                        $msgbody = $match[1];
                        $status = $this->SendMT($mtseq, $moid, $moseq, $src, $dest, $cmdcode, $msgbody, $msgtype, $msgtitle, $mttotalseg, $mtseqref, $cpid, $reqtime, $procresult, $opid, $username, $password);
//                        if (isset($status['SendMTResult']) && $status['SendMTResult'] == '202') {
                        $msgbody = $match[2];

                        $data = array('mobile' => $src);
                        $this->xs_mtseq_model->insert($data);
                        $mtseq = $this->db->insert_id();

                        $status = $this->SendMT($mtseq, $moid, $moseq, $src, $dest, $cmdcode, $msgbody, $msgtype, $msgtitle, $mttotalseg, $mtseqref, $cpid, $reqtime, $procresult, $opid, $username, $password);
//                        }
                    }
                } else {
                    $status = $this->SendMT($mtseq, $moid, $moseq, $src, $dest, $cmdcode, $msgbody, $msgtype, $msgtitle, $mttotalseg, $mtseqref, $cpid, $reqtime, $procresult, $opid, $username, $password);
                }

//                if (isset($status['SendMTResult']) && $status['SendMTResult'] == '202') {
                if ($check_finished) {
                    $data_xs_sms = array('status' => 1);
                    $this->xs_sms_model->update($value->id, $data_xs_sms);
                } else {
                    $data_xs_sms = array('a_all' => $a_all . $value->a_all);
                    $this->xs_sms_model->update($value->id, $data_xs_sms);
                }
//                }
            }
        }
    }

    function sendSMS_TTXS_($code, $data) {
        $item_id = 'TT_' . $code;

        $query = 'SELECT id,mobile,dau_so_nhan_tin,a_all
                    FROM xs_sms
                    WHERE day30=999 AND status=0 AND dau_so_nhan_tin=\'8517\' AND item_id=\'' . $item_id . '\''
        ;

        $rs = $this->db->query($query)->result();
        if (!$rs)
            return;

        $query = 'SELECT Seqno FROM xs_mo_receiver ORDER BY id DESC';
        $Seqno = $this->db->query($query)->row()->Seqno;

        $KeywordName = 'TT';
        $procresult = '0';

        foreach ($rs as $value) {
            $content = '';
            $a_all = '';
            $check_finished = false;

            if ($code == 'MB') {
                if (strpos($value->a_all, '0,') === false
                        && $data[0] != ''
                        && strpos($data[0], '*') === false && strpos($data[0], '+') === false
                ) {
                    $content .= 'DB:' . $data[0] . "\n";
                    $check_finished = true;
                }
                if (strpos($value->a_all, '1,') === false
                        && $data[1] != ''
                        && strpos($data[1], '*') === false && strpos($data[1], '+') === false
                ) {
                    $content .= '1:' . $data[1] . "\n";
                    $a_all .='1,';
                }
                if (strpos($value->a_all, '23,') === false
                        && $data[2] != ''
                        && $data[3] != ''
                        && strpos($data[2], '*') === false && strpos($data[2], '+') === false
                        && strpos($data[3], '*') === false && strpos($data[3], '+') === false
                ) {
                    $content .= '2:' . $data[2] . "\n";
                    $content .= '3:' . $data[3] . "\n";
                    $a_all .='23,';
                }
                if (strpos($value->a_all, '45,') === false
                        && $data[4] != ''
                        && $data[5] != ''
                        && strpos($data[4], '*') === false && strpos($data[4], '+') === false
                        && strpos($data[5], '*') === false && strpos($data[5], '+') === false
                ) {
                    $content .= '4:' . $data[4] . "\n";
                    $content .= '5:' . $data[5] . "\n";
                    $a_all .='45,';
                }
                if (strpos($value->a_all, '67,') === false
                        && $data[6] != ''
                        && $data[7] != ''
                        && strpos($data[6], '*') === false && strpos($data[6], '+') === false
                        && strpos($data[7], '*') === false && strpos($data[7], '+') === false
                ) {
                    $content .= '6:' . $data[6] . "\n";
                    $content .= '7:' . $data[7] . "\n";
                    $a_all .='67,';
                }
            } else {
                if (strpos($value->a_all, '8,') === false
                        && $data[8] != ''
                        && strpos($data[8], '*') === false && strpos($data[8], '+') === false
                ) {
                    $content .= '8:' . $data[8] . "\n";
                    $a_all .='8,';
                }
                if (strpos($value->a_all, '765,') === false
                        && $data[5] != ''
                        && $data[6] != ''
                        && $data[7] != ''
                        && strpos($data[5], '*') === false && strpos($data[5], '+') === false
                        && strpos($data[6], '*') === false && strpos($data[6], '+') === false
                        && strpos($data[7], '*') === false && strpos($data[7], '+') === false
                ) {
                    $content .= '7:' . $data[7] . "\n";
                    $content .= '6:' . $data[6] . "\n";
                    $content .= '5:' . $data[5] . "\n";
                    $a_all .='765,';
                }
                if (strpos($value->a_all, '4,') === false
                        && $data[4] != ''
                        && strpos($data[4], '*') === false && strpos($data[4], '+') === false
                ) {
                    $content .= '4:' . $data[4] . "\n";
                    $a_all .='4,';
                }
                if (strpos($value->a_all, '321,') === false
                        && $data[1] != ''
                        && $data[2] != ''
                        && $data[3] != ''
                        && strpos($data[1], '*') === false && strpos($data[1], '+') === false
                        && strpos($data[2], '*') === false && strpos($data[2], '+') === false
                        && strpos($data[3], '*') === false && strpos($data[3], '+') === false
                ) {
                    $content .= '3:' . $data[3] . "\n";
                    $content .= '2:' . $data[2] . "\n";
                    $content .= '1:' . $data[1] . "\n";
                    $a_all .='321,';
                }
                if (strpos($value->a_all, '0,') === false
                        && $data[0] != ''
                        && strpos($data[0], '*') === false && strpos($data[0], '+') === false
                ) {
                    $content .= 'DB:' . $data[0] . "\n";
                    $check_finished = true;
                }
            }

            if ($content != '') {
                $content = $code . ' ' . date('d/m', time()) . ":\n" . $content;

                $response = $content;
                $Destination = $value->mobile;
                $SendFrom = $value->dau_so_nhan_tin;

                if (strlen($response) > 160) {
                    if (preg_match('/(^.{1,160})\n(.*)/ism', $response, $match)) {
                        $response = $match[1];
                        $status = $this->SendMT_($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 2);
//                        if (isset($status['SendMTResult']) && $status['SendMTResult'] == '202') {
                        $response = $match[2];
                        $status = $this->SendMT_($Destination, $SendFrom, $KeywordName, $response, $procresult, 0, 2);
//                        }
                    }
                } else {
                    $status = $this->SendMT_($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
                }

//                if (isset($status['SendMTResult']) && $status['SendMTResult'] == '202') {
                if ($check_finished) {
                    $this->xs_sms_model->update($value->id, array('status' => 1));
                } else {
                    $this->xs_sms_model->update($value->id, array('a_all' => $a_all . $value->a_all));
                }
//                }
            }
        }
    }

    function saveresult($area) {
        $date = date('Y-m-d');
        if (isset($_GET['date']))
            $date = $_GET['date'];
//        $date = '2014-08-14'; //test
        $row = $this->read_xml_home($area, $date, 1);
        if ($row) {
            foreach ($row->cache->data as $v) {
                $lid = $v->lid;

                $rs_id = $this->db->select('id')->from('xs_result')
                                ->where('date', $date)
                                ->where('lid', $lid)
                                ->get()->row()->id;
//                echo $this->db->last_query();

                $data = array(
                    'extension' => json_encode($v->extra),
                    'a0' => $v->data[0],
                    'a1' => $v->data[1],
                    'a2' => $v->data[2],
                    'a3' => $v->data[3],
                    'a4' => $v->data[4],
                    'a5' => $v->data[5],
                    'a6' => $v->data[6],
                    'a7' => $v->data[7],
                    'a8' => $v->data[8],
                    'b0' => $v->data_b[0],
                    'b1' => $v->data_b[1],
                    'b2' => $v->data_b[2],
                    'b3' => $v->data_b[3],
                    'b4' => $v->data_b[4],
                    'b5' => $v->data_b[5],
                    'b6' => $v->data_b[6],
                    'b7' => $v->data_b[7],
                    'b8' => $v->data_b[8],
                );
                if ($rs_id) {
                    $this->update($rs_id, $data);
                } else {
                    $data['lid'] = $lid;
                    $data['date'] = $date;
                    $this->insert($data);
                }

                if ($area == 0) {
                    if (isset($v->dtthantai4) && $v->dtthantai4 != '') {
                        $id = $this->db->select('id')->from('xs_northern')
                                        ->where('status', 1)
                                        ->where('date', $date)
                                        ->where('type', 'TT')
                                        ->get()->row()->id;
                        if (!$id) {
                            $tmp = array();
                            $tmp[] = $v->dtthantai4;
                            $data = array(
                                'date' => $date,
                                'data' => json_encode($tmp),
                                'created_time' => date('Y-m-d H:i:s'),
                                'type' => 'TT',
                                'status' => 1
                            );
                            $this->db->insert('xs_northern', $data);
                        }
                    }
                    if (isset($v->dt123) && count($v->dt123) > 0) {
                        $id = $this->db->select('id')->from('xs_northern')
                                        ->where('status', 1)
                                        ->where('date', $date)
                                        ->where('type', 'DT123')
                                        ->get()->row()->id;
                        if (!$id) {
                            $data = array(
                                'date' => $date,
                                'data' => json_encode($v->dt123),
                                'created_time' => date('Y-m-d H:i:s'),
                                'type' => 'DT123',
                                'status' => 1
                            );
                            $this->db->insert('xs_northern', $data);
                        }
                    }
                    if (isset($v->dt6x36) && count($v->dt6x36) > 0) {
                        $id = $this->db->select('id')->from('xs_northern')
                                        ->where('status', 1)
                                        ->where('date', $date)
                                        ->where('type', 'DT6x36')
                                        ->get()->row()->id;
                        if (!$id) {
                            $data = array(
                                'date' => $date,
                                'data' => json_encode($v->dt6x36),
                                'created_time' => date('Y-m-d H:i:s'),
                                'type' => 'DT6x36',
                                'status' => 1
                            );
                            $this->db->insert('xs_northern', $data);
                        }
                    }
                }
            }
        } else {
            die('0');
        }
    }

    function update_result($result, $area, $date) {
//            $th_cache = getAliasByDate();
//            $date_cache = date('d-m-Y', strtotime($date));
//            $today = date('d-m-Y', time());
        foreach ($result as $v) {
            $lid = $v['lid'];

            $rs_id = $this->db->select('id')->from('xs_result')
                            ->where('date', $date)
                            ->where('lid', $lid)
                            ->get()->row()->id;
//                echo $this->db->last_query();

            $data = array(
                'extension' => json_encode($v['extra']),
                'a0' => $v['data'][0],
                'a1' => $v['data'][1],
                'a2' => $v['data'][2],
                'a3' => $v['data'][3],
                'a4' => $v['data'][4],
                'a5' => $v['data'][5],
                'a6' => $v['data'][6],
                'a7' => $v['data'][7],
                'a8' => $v['data'][8],
                'b0' => $v['data_b'][0],
                'b1' => $v['data_b'][1],
                'b2' => $v['data_b'][2],
                'b3' => $v['data_b'][3],
                'b4' => $v['data_b'][4],
                'b5' => $v['data_b'][5],
                'b6' => $v['data_b'][6],
                'b7' => $v['data_b'][7],
                'b8' => $v['data_b'][8],
            );
            if ($rs_id) {
                $this->update($rs_id, $data);
            } else {
                $data['lid'] = $lid;
                $data['date'] = $date;
                $this->insert($data);
            }

            if ($area == 0) {
                if (isset($v['dtthantai4']) && $v['dtthantai4'] != '') {
                    $id = $this->db->select('id')->from('xs_northern')
                                    ->where('status', 1)
                                    ->where('date', $date)
                                    ->where('type', 'TT')
                                    ->get()->row()->id;
                    if (!$id) {
                        $tmp = array();
                        $tmp[] = $v['dtthantai4'];
                        $data = array(
                            'date' => $date,
                            'data' => json_encode($tmp),
                            'created_time' => date('Y-m-d H:i:s'),
                            'type' => 'TT',
                            'status' => 1
                        );
                        $this->db->insert('xs_northern', $data);
                    }
                }
                if (isset($v['dt123']) && count($v['dt123']) > 0) {
                    $id = $this->db->select('id')->from('xs_northern')
                                    ->where('status', 1)
                                    ->where('date', $date)
                                    ->where('type', 'DT123')
                                    ->get()->row()->id;
                    if (!$id) {
                        $data = array(
                            'date' => $date,
                            'data' => json_encode($v['dt123']),
                            'created_time' => date('Y-m-d H:i:s'),
                            'type' => 'DT123',
                            'status' => 1
                        );
                        $this->db->insert('xs_northern', $data);
                    }
                }
                if (isset($v['dt6x36']) && count($v['dt6x36']) > 0) {
                    $id = $this->db->select('id')->from('xs_northern')
                                    ->where('status', 1)
                                    ->where('date', $date)
                                    ->where('type', 'DT6x36')
                                    ->get()->row()->id;
                    if (!$id) {
                        $data = array(
                            'date' => $date,
                            'data' => json_encode($v['dt6x36']),
                            'created_time' => date('Y-m-d H:i:s'),
                            'type' => 'DT6x36',
                            'status' => 1
                        );
                        $this->db->insert('xs_northern', $data);
                    }
                }
            }

//                //xoa cache tren 114
//                $this->simple_cache->delete_item('home_data');
//                $this->simple_cache->delete_item('demo_date_' . $lid . '_' . $today);
//
//                $this->simple_cache->cache_dir = FCPATH . 'xoso_mobile/application/';
//                $this->simple_cache->delete_item('home_data');
//                //xoa cache tren 213
//                $get->get('http://s213.xoso.com/client/live/cCache/' . $lid . '/' . $today);
//                $this->db->where('id', $lid);
//                $alias = $this->db->select('alias')->from('xs_location')->get()->row()->alias;
            //delete cache
//                if ($area == 0)
//                    $this->simple_cache->delete_item('xoso_data_' . $this->data['url_mienbac']);
//                elseif ($area == 1)
//                    $this->simple_cache->delete_item('xoso_data_' . $this->data['url_mientrung']);
//                else
//                    $this->simple_cache->delete_item('xoso_data_' . $this->data['url_miennam']);
//                $this->simple_cache->delete_item('xoso_data_' . $alias);
//                $this->simple_cache->delete_item('xoso_data_' . $alias . '_' . $th_cache);
//                $this->simple_cache->delete_item('xoso_data_' . $alias . '_' . $date_cache);
        }
        $this->load->helper('phpwebhacks_helper');
        $get = new phpWebHacks();
        $get->get('http://s213.xoso.com/client/live/sendsms?UUbQpHAK=1&area=' . $area);
    }

    function getItems($alias = null) {
        if ($alias == '') {
            return;
        }

        // Lấy kết quả 8 lần mở thưởng gần nhất
        $url_mientrung = $this->data['url_mientrung'];
        $url_miennam = $this->data['url_miennam'];
        if ($alias == $url_mientrung || $alias == $url_miennam) {
            if ($alias == $url_mientrung)
                $this->db->where('l.area', 'MT');
            else
                $this->db->where('l.area', 'MN');
        }else {
            $this->db->where('l.alias', $alias);
        }
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->limit(8, 0)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        foreach ($data as $i => $item) {
            if ($item->area == 'MT' || $item->area == 'MN') {
                $d = $this->getDateOfWeekKT($item->date);
                $cd = $item->code;
                $numday = '';
                if ($cd == 'HCM' && $d == 'T2') {
                    $numday = 5;
                    $numday2 = 2;
                } elseif ($cd == 'HCM' && $d != 'T2') {
                    $numday = 2;
                    $numday2 = 5;
                } elseif ($cd == 'DNG' && $d == 'T4') {
                    $numday = 3;
                    $numday2 = 4;
                } elseif ($cd == 'DNG' && $d == 'T7') {
                    $numday = 4;
                    $numday2 = 3;
                } else {
                    $numday = $numday2 = 7;
                }

                $data[$i]->linkday1 = date('d-m-Y', strtotime("{$item->date} -$numday2 day"));
                if ($item->date <= date('Y-m-d', strtotime("{$item->date} +$numday day"))) {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                } else {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                }
            }

            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime($item->date));
            $data[$i]->area_name = $areaList[$item->area];
        }

        return $data;
    }

    function getLastItems() {
        // Lấy kết quả lần mở thưởng gần nhất
        $date = date('Y-m-d', strtotime('-1 day'));
//        $date = '2013-07-08';
        $this->db->where('r.date', $date);
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('l.ordering', 'ASC')
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        $items = null;
        foreach ($data as $i => $item) {
            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime($item->date));
            $data[$i]->area_name = $areaList[$item->area];

            $items[$item->area][] = $data[$i];
        }

        return $items;
    }

    function getItemsMTMN($alias, $date = '') {
        if ($alias == '') {
            return;
        }

        // Lấy kết quả 8 lần mở thưởng gần nhất
        $url_mientrung = $this->data['url_mientrung'];
//        $url_miennam = $this->data['url_miennam'];
        if ($alias == $url_mientrung)
            $this->db->where('l.area', 'MT');
        else
            $this->db->where('l.area', 'MN');
        // Lấy kết quả lần mở thưởng gần nhất
        if ($date != '') {
            $date_to = date('Y-m-d', strtotime($date));
//            if ((!isset($_SESSION['user']) || $_SESSION['user']['gender'] == 0) && $date_to < '2008-01-07')
//                $date_to = '2008-01-07';
            $this->db->where('r.date <=', $date_to);
        }

        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->limit(28)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        $items = null;
        foreach ($data as $i => $item) {
            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime($item->date));
            $data[$i]->area_name = $areaList[$item->area];

            $items[$data[$i]->date][] = $data[$i];
        }

        return $items;
    }

    function getItemsFilterTH($alias = null, $th = null, $date = '') {
        if ($alias == '' || $th == '') {
            return;
        }

        $day = 9;
        switch ($th) {
            case 'thu-hai':
                $day = 0;
                break;
            case 'thu-ba':
                $day = 1;
                break;
            case 'thu-tu':
                $day = 2;
                break;
            case 'thu-nam':
                $day = 3;
                break;
            case 'thu-sau':
                $day = 4;
                break;
            case 'thu-bay':
                $day = 5;
                break;
            case 'chu-nhat':
                $day = 6;
                break;

            default:
                break;
        }

        if ($day == 9)
            return;

        // Lấy kết quả 8 lần mở thưởng gần nhất        
        $this->db->where('WEEKDAY(r.date)', $day);
        $url_mientrung = $this->data['url_mientrung'];
        $url_miennam = $this->data['url_miennam'];
        if ($alias == $url_mientrung || $alias == $url_miennam) {
            if ($alias == $url_mientrung)
                $this->db->where('l.area', 'MT');
            else
                $this->db->where('l.area', 'MN');
        }else {
            return;
        }

        if ($date != '') {
            $date_to = date('Y-m-d', strtotime($date));
//            if ((!isset($_SESSION['user']) || $_SESSION['user']['gender'] == 0) && $date_to < '2008-01-07')
//                $date_to = '2008-01-07';
            $this->db->where('r.date <=', $date_to);
        }

        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->limit(28)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        $items = null;
        foreach ($data as $i => $item) {
            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime($item->date));
            $data[$i]->area_name = $areaList[$item->area];

            $items[$data[$i]->date][] = $data[$i];
        }

        return $items;
    }

    function getItemsFilterDate($alias = null, $date = null) {
        if ($alias == '' || $date == '') {
            return;
        }

        $date = date('Y-m-d', strtotime($date));

//        if ((!isset($_SESSION['user']) || $_SESSION['user']['gender'] == 0) && $date < '2008-01-01')
//            $date = '2008-01-08';

        // Lấy kết quả 8 lần mở thưởng gần nhất
//        $this->db->where('r.date', $date);
        $this->db->where('r.date <=', $date);
        $url_mientrung = $this->data['url_mientrung'];
        $url_miennam = $this->data['url_miennam'];
        if ($alias == $url_mientrung || $alias == $url_miennam) {
            if ($alias == $url_mientrung)
                $this->db->where('l.area', 'MT');
            else
                $this->db->where('l.area', 'MN');
        }else {
            $this->db->where('l.alias', $alias);
        }
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->limit(8, 0)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        foreach ($data as $i => $item) {
            if ($item->area == 'MT' || $item->area == 'MN') {
                $d = $this->getDateOfWeekKT($item->date);
                $cd = $item->code;
                $numday = '';
                if ($cd == 'HCM' && $d == 'T2') {
                    $numday = 5;
                    $numday2 = 2;
                } elseif ($cd == 'HCM' && $d != 'T2') {
                    $numday = 2;
                    $numday2 = 5;
                } elseif ($cd == 'DNG' && $d == 'T4') {
                    $numday = 3;
                    $numday2 = 4;
                } elseif ($cd == 'DNG' && $d == 'T7') {
                    $numday = 4;
                    $numday2 = 3;
                } else {
                    $numday = $numday2 = 7;
                }

                $data[$i]->linkday1 = date('d-m-Y', strtotime("{$item->date} -$numday2 day"));
                if ($item->date <= date('Y-m-d', strtotime("{$item->date} +$numday day"))) {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                } else {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                }
            }

            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime($item->date));
            $data[$i]->area_name = $areaList[$item->area];
        }

        return $data;
    }

    function getItemsHome($date = null) {
        if ($date != '') {
            $date = date('Y-m-d', strtotime($date));
        } else {
            $date = date('Y-m-d');
        }

//        if ((!isset($_SESSION['user']) || $_SESSION['user']['gender'] == 0) && $date < '2008-01-01')
//            $date = '2008-01-01';

        $this->db->where('r.date <=', $date);
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('r.id', 'DESC')
//                ->order_by('l.ordering', 'ASC')
                ->limit(8, 0)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        foreach ($data as $i => $item) {
            if ($item->area == 'MT' || $item->area == 'MN') {
                $d = $this->getDateOfWeekKT($item->date);
                $cd = $item->code;
                $numday = '';
                if ($cd == 'HCM' && $d == 'T2') {
                    $numday = 5;
                    $numday2 = 2;
                } elseif ($cd == 'HCM' && $d != 'T2') {
                    $numday = 2;
                    $numday2 = 5;
                } elseif ($cd == 'DNG' && $d == 'T4') {
                    $numday = 3;
                    $numday2 = 4;
                } elseif ($cd == 'DNG' && $d == 'T7') {
                    $numday = 4;
                    $numday2 = 3;
                } else {
                    $numday = $numday2 = 7;
                }

                $data[$i]->linkday1 = date('d-m-Y', strtotime("{$item->date} -$numday2 day"));
                if ($item->date <= date('Y-m-d', strtotime("{$item->date} +$numday day"))) {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                } else {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                }
            }

            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime($item->date));
            $data[$i]->area_name = $areaList[$item->area];
        }

        return $data;
    }

    function Doveso($lid = 0, $date = null) {
        if ($lid == '' || $date == '') {
            return;
        }

        $date = date('Y-m-d', strtotime($date));

        // Lấy kết quả 8 lần mở thưởng gần nhất
//        $this->db->where('r.date', $date);
        $this->db->where('r.date', $date);
        $this->db->where('l.alias', $lid);
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->get()
                ->row();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        $data->dateOfWeek = $this->getDateOfWeek($data->date);
        $data->date = date('d/m/Y', strtotime($data->date));
        $data->area_name = $areaList[$data->area];

        return $data;
    }

    function loadKQXS($alias = null, $date = null) {
        if ($alias == '' || $date == '') {
            return;
        }

        if ($alias == 'mb') {
            $this->db->where('r.lid', 1);
            $this->db->where('r.date <', $date);
        } else {
            $this->db->where('r.id <', $date);
        }

        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->limit(5, 0)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        foreach ($data as $i => $item) {
            if ($item->area == 'MT' || $item->area == 'MN') {
                $d = $this->getDateOfWeekKT($item->date);
                $cd = $item->code;
                $numday = '';
                if ($cd == 'HCM' && $d == 'T2') {
                    $numday = 5;
                    $numday2 = 2;
                } elseif ($cd == 'HCM' && $d != 'T2') {
                    $numday = 2;
                    $numday2 = 5;
                } elseif ($cd == 'DNG' && $d == 'T4') {
                    $numday = 3;
                    $numday2 = 4;
                } elseif ($cd == 'DNG' && $d == 'T7') {
                    $numday = 4;
                    $numday2 = 3;
                } else {
                    $numday = $numday2 = 7;
                }

                $data[$i]->linkday1 = date('d-m-Y', strtotime("{$item->date} -$numday2 day"));
                if ($item->date <= date('Y-m-d', strtotime("{$item->date} +$numday day"))) {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                } else {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                }
            }

            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime($item->date));
            $data[$i]->area_name = $areaList[$item->area];
        }
        return $data;
    }

    function getDateOfWeek($date = null) {
        $date = empty($date) ? date('Y-m-d') : $date;
        $date = date('D', strtotime($date));
        $list = array(
            'Mon' => 'Thứ 2',
            'Tue' => 'Thứ 3',
            'Wed' => 'Thứ 4',
            'Thu' => 'Thứ 5',
            'Fri' => 'Thứ 6',
            'Sat' => 'Thứ 7',
            'Sun' => 'Chủ nhật',
        );
        return $list[$date];
    }

    function getDateOfWeekKT($date = null) {
        $date = empty($date) ? $this->getDate() : $date;
        $date = date('D', strtotime($date));
        $list = array(
            'Mon' => 'T2',
            'Tue' => 'T3',
            'Wed' => 'T4',
            'Thu' => 'T5',
            'Fri' => 'T6',
            'Sat' => 'T7',
            'Sun' => 'CN',
        );
        return $list[$date];
    }

    function getTimer($area = '') {
        if ($area != '') {
            $this->db->where('status', 1);
            $this->db->where('area', $area);
            $time = $this->db->select('time')->from('xs_location')->get()->row()->time;
            return $time;
        }

        $this->db->where('status', 1);
        $data = $this->db->select('time,area')
                ->from('xs_location')
                ->order_by('ordering', 'ASC')
                ->group_by('area')
                ->get()
                ->result();
        $items = array();
        foreach ($data as $value) {
            $items[$value->area] = $value->time;
        }
        return $items;
    }

    function getResultLoto($area) {
        switch ($area) {
            case 'MB':
                $area = 0;
                $time_end = '18:00';
                break;
            case 'MT':
                $area = 1;
                $time_end = '17:00';
                break;
            case 'MN':
                $area = 2;
                $time_end = '16:00';
                break;
        }
        $time = date('H:i');
        if ($time < $time_end)
            $date = date('Y-m-d', strtotime('-1 day'));
        else
            $date = date('Y-m-d');
        $result = $this->read_xml_home($area, $date, -1);
        return $result;
    }

    function getResultLotoYesterday($area)
    {
        switch ($area) {
            case 'MB':
                $area = 0;
                $time_end = '18:00';
                break;
            case 'MT':
                $area = 1;
                $time_end = '17:00';
                break;
            case 'MN':
                $area = 2;
                $time_end = '16:00';
                break;
        }
  
        $date = date('Y-m-d', strtotime('-1 day'));
        $result = $this->read_xml_home($area, $date, -1);
        
        return $result;
    }

    //Thong ke quan trong
    function getitemsImportant($lid, $time_turn) {
        $mang_so = array(
            '00', '01', '02', '03', '04', '05', '06', '07', '08', '09',
            '10', '11', '12', '13', '14', '15', '16', '17', '18', '19',
            '20', '21', '22', '23', '24', '25', '26', '27', '28', '29',
            '30', '31', '32', '33', '34', '35', '36', '37', '38', '39',
            '40', '41', '42', '43', '44', '45', '46', '47', '48', '49',
            '50', '51', '52', '53', '54', '55', '56', '57', '58', '59',
            '60', '61', '62', '63', '64', '65', '66', '67', '68', '69',
            '70', '71', '72', '73', '74', '75', '76', '77', '78', '79',
            '80', '81', '82', '83', '84', '85', '86', '87', '88', '89',
            '90', '91', '92', '93', '94', '95', '96', '97', '98', '99'
        );

        $query = 'SELECT CONCAT_WS(\',\',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`,`date`
                    FROM `xs_result`
                    WHERE `lid`=' . Quote($lid)
                . ' ORDER BY `date` DESC'
                . ' LIMIT 0,' . $time_turn
        ;

        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();

        $result = array();
        if ($list) {
            foreach ($mang_so as $v) {
                $count = 0;
                $tmp = array();
                $tmp['date'] = '';
                foreach ($list as $v1) {
                    $arr = explode(',', $v1->data);
                    foreach ($arr as $v2) {
                        if ($v == $v2) {
                            $count++;
                            if ($tmp['date'] == '') {
                                $tmp['date'] = $v1->date;
                            }
                        }
                    }
                }//Ket thuc duyet qua cac ket qua

                if ($tmp['date'] != '') {
                    $query = 'SELECT COUNT(id) AS total
                        FROM `xs_result`
                        WHERE `lid`=' . Quote($lid) . ' AND `date`>' . Quote($tmp['date'])
                    ;
                    $tmp['not_count'] = $this->db->query($query)->row()->total;
                    $tmp['count'] = $count;
                    $tmp['number'] = $v;

                    if ($tmp['count'] >= 10 && $tmp['not_count'] >= 0 && $tmp['not_count'] <= 3) {
                        $result['high'][] = $tmp;
                    }

                    if ($tmp['count'] >= 10 && $tmp['not_count'] >= 4 && $tmp['not_count'] <= 10) {
                        $result['priority'][] = $tmp;
                    }

                    //plots fall
                    if ($tmp['count'] >= 10 && $tmp['not_count'] == 0) {
                        $result['plots_fall'][] = $tmp;
                    }

                    //cautious
                    if ($tmp['count'] >= 1 && $tmp['not_count'] >= 10) {
                        $result['cautious'][] = $tmp;
                    }
                }
            }
        }
        if ($result['high']) {
            $result['high'] = $this->sortByOneKey($result['high'], 'count', false);
            $result['high'] = array_splice($result['high'], 0, 5);
        }

        if ($result['priority']) {
            $result['priority'] = $this->sortByOneKey($result['priority'], 'count', false);
            $result['priority'] = array_slice($result['priority'], 0, 5);
        }

        if ($result['plots_fall']) {
            $result['plots_fall'] = $this->sortByOneKey($result['plots_fall'], 'count', false);
            $result['plots_fall'] = array_slice($result['plots_fall'], 0, 10);
        }

        if ($result['cautious']) {
            $result['cautious'] = $this->sortByOneKey($result['cautious'], 'not_count', false);
            $result['cautious'] = array_slice($result['cautious'], 0, 10);
        }

        return $result;
    }

    function sortByOneKey(array $array, $key, $asc = true) {
        $result = array();
        $values = array();
        foreach ($array as $id => $value) {
            $values[$id] = isset($value[$key]) ? $value[$key] : '';
        }

        if ($asc) {
            asort($values);
        } else {
            arsort($values);
        }

        foreach ($values as $key => $value) {
            $result[$key] = $array[$key];
        }

        return $result;
    }

    //Thong ke tong hop
    function getItemsSynthesis($fromdate, $todate, $lid, $type) {
        // Khởi tạo biến
        $result = array();
        // Ngày lấy dữ liệu
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));

        $mang_so = array();

        switch ($type) {
//            case 't1' ://Tong chan
//                //
//                $mang_so = array(
//                    '00', '02', '04', '06', '08',
//                    '11', '13', '15', '17', '19',
//                    '20', '22', '24', '26', '28',
//                    '31', '33', '35', '37', '39',
//                    '40', '42', '44', '46', '48',
//                    '51', '53', '55', '57', '59',
//                    '60', '62', '64', '66', '68',
//                    '71', '73', '75', '77', '79',
//                    '80', '82', '84', '86', '88',
//                    '91', '93', '95', '97', '99'
//                );
//                break; //
//            case 't2' ://Tong le
//                $mang_so = array(
//                    '01', '03', '05', '07', '09',
//                    '10', '12', '14', '16', '18',
//                    '21', '23', '25', '27', '29',
//                    '30', '32', '34', '36', '38',
//                    '41', '43', '45', '47', '49',
//                    '50', '52', '54', '56', '58',
//                    '61', '63', '65', '67', '69',
//                    '70', '72', '74', '76', '78',
//                    '81', '83', '85', '87', '89',
//                    '90', '92', '94', '96', '98'
//                );
//                break;
            case 't3' ://Bo le le
                $mang_so = array(
                    '11', '13', '15', '17', '19',
                    '31', '33', '35', '37', '39',
                    '51', '53', '55', '57', '59',
                    '71', '73', '75', '77', '79',
                    '91', '93', '95', '97', '99'
                );
                break;
            case 't4' ://Bo chan le
                $mang_so = array(
                    '01', '03', '05', '07', '09',
                    '21', '23', '25', '27', '29',
                    '41', '43', '45', '47', '49',
                    '61', '63', '65', '67', '69',
                    '81', '83', '85', '87', '89'
                );
                break;
            case 't5' ://Bo le chan
                $mang_so = array(
                    '10', '12', '14', '16', '18',
                    '30', '32', '34', '36', '38',
                    '50', '52', '54', '56', '58',
                    '70', '72', '74', '76', '78',
                    '90', '92', '94', '96', '98'
                );
                break;
            case 't6' ://Bo chan chan
                $mang_so = array(
                    '00', '02', '04', '06', '08',
                    '20', '22', '24', '26', '28',
                    '40', '42', '44', '46', '48',
                    '60', '62', '64', '66', '68',
                    '80', '82', '84', '86', '88'
                );
                break;
            case 't7' ://Bo kep
                $mang_so = array(
                    '00', '11', '22', '33', '44',
                    '55', '66', '77', '88', '99'
                );
                break;
            case 't8' ://Bo sat kep
                $mang_so = array(
                    '01', '10', '12', '21', '23',
                    '32', '34', '43', '45', '54',
                    '56', '65', '67', '76', '78',
                    '87', '89', '98'
                );
                break;
//            case ('t9' || 't10') ://Bo sat kep
//                /*   $mang_so = array(
//                  '00','01','02','03','04','05','06','07','08','09',
//                  '10','11','12','13','14','15','16','17','18','19',
//                  '20','21','22','23','24','25','26','27','28','29',
//                  '30','31','32','33','34','35','36','37','38','39',
//                  '40','41','42','43','44','45','46','47','48','49',
//                  '50','51','52','53','54','55','56','57','58','59',
//                  '60','61','62','63','64','65','66','67','68','69',
//                  '70','71','72','73','74','75','76','77','78','79',
//                  '80','81','82','83','84','85','86','87','88','89',
//                  '90','91','92','93','94','95','96','97','98','99'
//                  ); */
//                $str = '';
//                for ($i = 0; $i < 100; $i++) {
//                    if ($i < 10)
//                        $str .= ',' . '0' . $i;
//                    else
//                        $str .= ',' . $i;
//                }
//                $str = substr($str, 1);
//                $mang_so = explode(',', $str);
//                break;
        }//End switch

        if ($mang_so) {
            $result['total_count'] = 0;
            $result['total_notcount'] = 0;
            foreach ($mang_so as $v) {
                // Build query
                $query = 'SELECT CONCAT_WS(\',\',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`,`date`
                    FROM `xs_result`
                    WHERE `lid`=' . Quote($lid)
                        . ' AND CONCAT_WS(\',\',b0,b1,b2,b3,b4,b5,b6,b7,b8) LIKE \'%' . $v . '%\''
                        . ' AND `date`>=' . Quote($from_date)
                        . ' AND `date`<=' . Quote($to_date)
                        . ' ORDER BY `date` DESC';

                $list = $this->db->query($query)->result();
//                echo $this->db->last_query();

                if (count($list) <= 0)
                    continue;

                $count = 0;
                foreach ($list as $v1) {
                    $arr = explode(',', $v1->data);
                    foreach ($arr as $v2) {
                        if ($v == $v2) {
                            $count++;
                        }
                    }
                }

                $tmp = array();
                $tmp['date'] = $list[0]->date;

                $query = 'SELECT COUNT(id) AS total
                    FROM `xs_result`
                    WHERE `lid`=' . Quote($lid) . ' AND `date`>' . Quote($tmp['date'])
                ;
                $tmp['not_count'] = $this->db->query($query)->row()->total;
                $tmp['count'] = $count;
                $tmp['number'] = $v;


                $result['value'][] = $tmp;
                $result['total_count'] = $result['total_count'] + $count;
                $result['total_notcount'] = $result['total_notcount'] + $tmp['not_count'];
            }//Duyet qua cac phan tu
        }

        //Truong hop thong ke 15 so ve nhieu nhat
//        if ($type == 't9') {
//            foreach ($result as $k => $v) {
//                for ($i = $k + 1; $i <= 100; $i++) {
//                    if ($result[$i]['count'] > $result[$k]['count']) {
//                        $tmp = $result[$k];
//                        $result[$k] = $result[$i];
//                        $result[$i] = $tmp;
//                    }//Ke thuc sap xep ket qua tang dan
//                    elseif (($result[$i]['count'] == $result[$k]['count']) && ($result[$i]['number'] < $result[$k]['number'])) {
//                        $tmp = $result[$k];
//                        $result[$k] = $result[$i];
//                        $result[$i] = $tmp;
//                    }//Ket thuc sap xep so theo thu tu tang dan
//                }
//            }
//            //Lay ra 15 so dau tien
//            $result = array_slice($result, 0, 15);
//        } elseif ($type == 't10') {//Truong hop sap xep so lan ve it nhat
//            foreach ($result as $k => $v) {
//                for ($i = $k + 1; $i <= 99; $i++) {
//                    if ($result[$i]['count'] < $result[$k]['count']) {
//                        $tmp = $result[$k];
//                        $result[$k] = $result[$i];
//                        $result[$i] = $tmp;
//                    }//Ket thuc sap xep so ket qua giam dan
//                    elseif (($result[$i]['count'] == $result[$k]['count']) && ($result[$i]['number'] > $result[$k]['number'])) {
//                        $tmp = $result[$k];
//                        $result[$k] = $result[$i];
//                        $result[$i] = $tmp;
//                    }//Ket thuc sap xep theo so tang dan
//                }
//            }
//            //Lay ra 15 ket qua dau tien
//            $result = array_slice($result, 0, 15);
//        }
        return $result;
    }

    //Thong ke lo to tinh
    function getItemsLoto($fromdate, $todate, $number, $lid) {
        // Ngày lấy dữ liệu
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));

        $result = array();
        if ($number == '')
            return $result;

        $arr_number = explode(',', $number);
        foreach ($arr_number as $value) {
            $value = trim($value);
            if ($value <= 0)
                continue;

            $query = 'SELECT CONCAT_WS(\',\',a0,a1,a2,a3,a4,a5,a6,a7,a8) AS `data`,`date`
                    FROM `xs_result`
                    WHERE `lid`=' . Quote($lid)
                    . ' AND CONCAT_WS(\'-\',a0,a1,a2,a3,a4,a5,a6,a7,a8,b9) LIKE \'%' . $value . '-%\''
                    . ' AND `date`>=' . Quote($from_date)
                    . ' AND `date`<=' . Quote($to_date)
                    . ' ORDER BY `date` DESC LIMIT ' . (round(500 / count($arr_number)));

            $list = $this->db->query($query)->result();
//            echo $this->db->last_query();
//            if (count($list) <= 0)
//                continue;

            $count = 0;
            $result[$value][$count]->date = '';
            $result[$value][$count]->giai = '';
            $result[$value][$count]->data = '';
            if ($list) {
                foreach ($list as $v1) {
                    $arr = explode(',', $v1->data);
                    foreach ($arr as $k => $v2) {
                        if (strpos($v2 . '-', $value . '-') !== false) {
                            $result[$value][$count]->date = $v1->date;
                            $result[$value][$count]->giai = $k;
                            $result[$value][$count]->data = $v2;
                            $count++;
                        }
                    }
                }
            }
        }

        return $result;
    }

    //Thong ke lo gan
    function getItemsNumberLiver($fromdate, $todate, $number, $lid, $amplitude, $type) {
        // Ngày lấy dữ liệu
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));
        $mang_so = explode(',', $number);

        $data = array();
        foreach ($mang_so as $v) {
            $v = trim($v);

            if ($type == 1) {
                $where = ' AND CONCAT_WS(\'-\',a0,a1,a2,a3,a4,a5,a6,a7,a8,b9) LIKE \'%' . $v . '-%\'';
            } elseif ($type == 2) {
                if ($lid == 1) {
                    $where = ' AND CONCAT_WS(\',\',a0,b7,b9) LIKE \'%' . $v . ',%\'';
                } else {
                    $where = ' AND CONCAT_WS(\',\',a0,b8,b9) LIKE \'%' . $v . ',%\'';
                }
            } else {
                $where = ' AND CONCAT_WS(\',\',a0,b9) LIKE \'%' . $v . ',%\'';
            }

            $query = 'SELECT `date`
                    FROM `xs_result`
                    WHERE `lid`=' . Quote($lid)
                    . $where
                    . ' AND `date`>=' . Quote($from_date)
                    . ' AND `date`<=' . Quote($to_date)
                    . ' ORDER BY `date` DESC';

            $data[$v] = $this->db->query($query)->result();
//            echo $this->db->last_query();
        }

        $result = array();
        foreach ($data as $key => $value) {
            if (!$value[0]->date) {
                $result[$key] = null;
                continue;
            }

            $khoangcach = 0;
            $result[$key]->end_date = $value[0]->date;
            foreach ($value as $i => $item) {
                if (isset($value[$i + 1])) {
                    $tmp = strtotime($item->date) - strtotime($value[$i + 1]->date);
                    if ($tmp > $khoangcach) {
                        $khoangcach = $tmp;
                        $result[$key]->from_date = $value[$i + 1]->date;
                        $result[$key]->to_date = $item->date;
                    }
                }
            }
        }

        foreach ($result as $key => $value) {
            if (!$value->end_date)
                continue;

            $query = 'SELECT COUNT(id) AS total
                    FROM `xs_result`
                    WHERE `lid`=' . Quote($lid)
                    . ' AND `date`>' . Quote($value->from_date)
                    . ' AND `date`<' . Quote($value->to_date)
            ;

            $total = $this->db->query($query)->row()->total;

            if ($total == 0 || $total < $amplitude) {
                $result[$key] = null;
                continue;
            }

            $result[$key]->total = $total;

            $query = 'SELECT id,date
                    FROM `xs_result`
                    WHERE `lid`=' . Quote($lid)
                    . ' AND `date`>=' . Quote($value->end_date)
                    . ' ORDER BY date DESC'
            ;

            $rs = $this->db->query($query)->result();

            $result[$key]->end_total = 1;
            if ($rs) {
                if (count($rs) > 1) {
                    $result[$key]->end_total = count($rs) - 1;
                }
                $result[$key]->final_date = $rs[0]->date;
            }
        }

        return $result;
    }

    //Thong ke cap so tu 00-99
    function getItemsChuKy($fromdate, $todate, $lid) {
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));

        // Build query
        $query = 'SELECT date,CONCAT_WS(\', \',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data
                    FROM xs_result
                    WHERE lid=' . Quote($lid)
                . ' AND date>=' . Quote($from_date)
                . ' AND date<=' . Quote($to_date)
                . ' ORDER BY date ASC LIMIT 500';

        $list = $this->db->query($query)->result();

        $result = array();
        $count = array();
        foreach ($list as $item) {
            // ngày mở thưởng
            $date = $item->date;
            // cắt ký tự - ở cuối dòng
            $tmp = rtrim($item->data, ',');
            // tách riêng các số
            $arr = explode(',', $tmp);
            // duyệt qua danh sách các số
            foreach ($arr as $v) {
                if (trim($v) == '') {
                    continue;
                }
                $v = intval($v);
                // kiểm tra xem đã có trong mảng kết quả
                if (isset($result[$date][$v])) {
                    // thiết đặt dữ liệu cho cặp số ở ngày mở thưởng
                    $result[$date][$v] = $result[$date][$v] + 1;
                } else {
                    $result[$date][$v] = 1;
                }

                if (isset($count[$v])) {
                    $count[$v] = $count[$v] + 1;
                } else {
                    $count[$v] = 1;
                }
            }
        }

        return array($result, $count);
    }

    function getItemsTwo($time_turn, $lid, $type) {
        $result = array();

        $str = '';
        for ($i = 0; $i < 100; $i++) {
            if ($i < 10)
                $str .= ',' . '0' . $i;
            else
                $str .= ',' . $i;
        }
        $str = substr($str, 1);
        $mang_so = explode(',', $str);

        if ($type == 0)
            $query = 'SELECT CONCAT_WS(\', \',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`,`date`
                            FROM `xs_result`
                            WHERE `lid`=' . Quote($lid)
                    . ' ORDER BY `date` DESC'
                    . ' LIMIT 0,' . $time_turn
            ;
        else
            $query = 'SELECT b0 AS `data`,`date`
                            FROM `xs_result`
                            WHERE `lid`=' . Quote($lid)
                    . ' ORDER BY `date` DESC'
                    . ' LIMIT 0,' . $time_turn
            ;

        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();

        if ($list) {
            $result['total'] = 0;
            $result['phantram_count'] = 0;
            foreach ($mang_so as $v) {
                $count = 0;
                $tmp = array();
                $tmp['date'] = '';
                foreach ($list as $v1) {
                    $arr = explode(',', $v1->data);
                    foreach ($arr as $v2) {
                        if ($v == $v2) {
                            $count++;
                            if ($tmp['date'] == '') {
                                $tmp['date'] = $v1->date;
                            }
                        }
                    }
                }

                if ($tmp['date'] != '') {
                    $tmp['count'] = $count;
                    $tmp['number'] = $v;

                    $result['value'][] = $tmp;
                    $result['total'] = $result['total'] + $count;

                    if ($count > $result['phantram_count'])
                        $result['phantram_count'] = $count;
                }
            }//Duyet qua cac phan tu
        }

        return $result;
    }

    //Lay thong ke theo tuan
    function getItemsWeek($fromdate, $todate, $lid, $type) {
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));
        // Build query
        if ($type > 0)
            $query = 'SELECT date,RIGHT(a0,2) AS data
                    FROM xs_result
                    WHERE lid=' . Quote($lid)
                    . ' AND date>=' . Quote($from_date)
                    . ' AND date<=' . Quote($to_date)
                    . ' ORDER BY date ASC LIMIT 500';
        else
            $query = 'SELECT date,a0 AS data
                    FROM xs_result
                    WHERE lid=' . Quote($lid)
                    . ' AND date>=' . Quote($from_date)
                    . ' AND date<=' . Quote($to_date)
                    . ' ORDER BY date ASC LIMIT 500';

        $list = $this->db->query($query)->result();

        $result = array();
        // Tổng hợp lại dữ liệu theo cấu trúc có thể hiển thị ra
        foreach ($list as $item) {
            $a = $this->getWeek($item->date);    // Tuần trong năm
            $b = date('w', strtotime($item->date)); // Ngày trong tuần
            $item->extra = date('d/m/Y', strtotime($item->date));
            if ($b == 0) {
                $b = 8;
            } else {
                $b++;
            }
            $result[$a][$b] = $item;
        }

        return $result;
    }

    // Tính ngày trong tuần
    // Tuần bắt đầu từ thứ 2-CN
    // Helper function cho Week
    function getWeek($date) {
        $week = date('W', strtotime($date));
        $week = intval($week) + 1;

        if ($week > 53) {
            $week = 1;
        }

        return $week;
    }

    /**
     * @function: Thống kê giải đặc biệt theo tháng 
     */
    function getItemsMonth($fromdate, $todate, $lid) {
        // Ngày lấy dữ liệu
        $fm = 1;
        $tm = 12;
        $from_date = $fromdate . '-' . $fm . '-01';
        $to_date = $todate . '-' . $tm . '-31';
		
        // Build query
        $query = 'SELECT r.date,CONCAT_WS(\', \',a0) AS data
                    FROM xs_result AS r
                    LEFT JOIN xs_location AS l ON l.id=r.lid
                    WHERE r.lid=' . Quote($lid)
                . ' AND r.date>=' . Quote($from_date)
                . ' AND r.date<=' . Quote($to_date)
                . ' ORDER BY r.date ASC';

	//echo $query;die;

				
        $list = $this->db->query($query)->result();

        return $list;
    }

    function StatisticsAtMost($limit, $alias) {
        if ($alias != '')
            $this->db->where('alias', $alias);
        else
            $this->db->order_by('ordering', 'ASC');
        $lid = $this->db->select('id')->from('xs_location')->get()->row()->id;
//        echo $this->db->last_query();

        $mang_so = array(
            '00', '01', '02', '03', '04', '05', '06', '07', '08', '09',
            '10', '11', '12', '13', '14', '15', '16', '17', '18', '19',
            '20', '21', '22', '23', '24', '25', '26', '27', '28', '29',
            '30', '31', '32', '33', '34', '35', '36', '37', '38', '39',
            '40', '41', '42', '43', '44', '45', '46', '47', '48', '49',
            '50', '51', '52', '53', '54', '55', '56', '57', '58', '59',
            '60', '61', '62', '63', '64', '65', '66', '67', '68', '69',
            '70', '71', '72', '73', '74', '75', '76', '77', '78', '79',
            '80', '81', '82', '83', '84', '85', '86', '87', '88', '89',
            '90', '91', '92', '93', '94', '95', '96', '97', '98', '99'
        );

        // Build query
        $query = 'SELECT CONCAT_WS(\',\',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`
                    FROM `xs_result`
                    WHERE `lid`=' . Quote($lid)
                . ' ORDER BY `date` DESC'
                . ' LIMIT 0,' . $limit
        ;

        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();
        // Build query
        $query = 'SELECT CONCAT_WS(\',\',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`
                    FROM `xs_result`
                    WHERE `lid`=' . Quote($lid)
                . ' ORDER BY `date` DESC'
                . ' LIMIT 1,' . $limit
        ;

        $list_last = $this->db->query($query)->result();
//        echo $this->db->last_query();

        $result = array();
        foreach ($mang_so as $v) {
            $count = 0;
            foreach ($list as $v1) {
                $arr = explode(',', $v1->data);
                foreach ($arr as $v2) {
                    if ($v == $v2) {
                        $count++;
                    }
                }
//                $pos = strpos($v1->data, $v);
//                if ($pos === false) {
//                    
//                } else {
//                    $count++;
//                }
            }//Ket thuc duyet qua cac ket qua


            $count_last = 0;
            foreach ($list_last as $v1) {
                $arr = explode(',', $v1->data);
                foreach ($arr as $v2) {
                    if ($v == $v2) {
                        $count_last++;
                    }
                }
//                $pos = strpos($v1->data, $v);
//                if ($pos === false) {
//                    
//                } else {
//                    $count_last++;
//                }
            }//Ket thuc duyet qua cac ket qua

            $tmp = array();
            $tmp['count'] = $count;
            $tmp['count_last'] = $count_last;
            $tmp['number'] = $v;
            $result[] = $tmp;
        }
        if ($result) {
            $result = $this->sortByOneKey($result, 'count', false);
            $result = array_splice($result, 0, 20);
        }

        return $result;
    }

    /**
     * @function: Thống kê đầu đuôi
     */
    function getItemsFirstLast($time_turn, $lid) {
        // Build query
        $query = 'SELECT CONCAT_WS(\',\',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data,b0 AS dacbiet
                    FROM xs_result
                    WHERE lid=' . Quote($lid)
                . ' ORDER BY date DESC'
                . ' LIMIT 0,' . $time_turn
        ;

        $list = $this->db->query($query)->result();

        $dau_so = array(
            '0' => 0,
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9
        );

        $result = array();
        $result['total_loto_dau'] = 0;
        $result['total_loto_duoi'] = 0;
        $result['total_dacbiet_dau'] = 0;
        $result['total_dacbiet_duoi'] = 0;

        $result['phantram_loto_dau'] = 0;
        $result['phantram_loto_duoi'] = 0;
        $result['phantram_dacbiet_dau'] = 0;
        $result['phantram_dacbiet_duoi'] = 0;
        foreach ($dau_so as $k => $v) {
            $result['dau'][$k] = 0;
            $result['duoi'][$k] = 0;
            $result['dau_dacbiet'][$k] = 0;
            $result['duoi_dacbiet'][$k] = 0;

            //Lap tat ca cac ket qua theo thoi gian chon
            foreach ($list as $item) {
                $arr = explode(',', $item->data);

                //Lap cac ket qua trong 1 ngay              
                foreach ($arr as $r) {
                    if ($r != '') {
                        //Tach dau va duoi
                        $num = str_split($r, 1);
                        $dau = $num[0];
                        $duoi = $num[1];

                        //Dem so lan xuat hien cua cac dau so                  
                        if ($dau != '' && $dau == $dau_so[$k]) {
                            $result['dau'][$k]++;
                            $result['total_loto_dau']++;
                            if ($result['dau'][$k] > $result['phantram_loto_dau'])
                                $result['phantram_loto_dau'] = $result['dau'][$k];
                        }

                        //Dem so lan xuat hien cua duoi so
                        if ($duoi != '' && $duoi == $dau_so[$k]) {
                            $result['duoi'][$k]++;
                            $result['total_loto_duoi']++;
                            if ($result['duoi'][$k] > $result['phantram_loto_duoi'])
                                $result['phantram_loto_duoi'] = $result['duoi'][$k];
                        }
                    }
                }//loop result

                $num = str_split($item->dacbiet, 1);
                $dau = $num[0];
                $duoi = $num[1];
                //Dem so lan xuat hien cua cac dau so                  
                if ($dau != '' && $dau == $dau_so[$k]) {
                    $result['dau_dacbiet'][$k]++;
                    $result['total_dacbiet_dau']++;
                    if ($result['dau_dacbiet'][$k] > $result['phantram_dacbiet_dau'])
                        $result['phantram_dacbiet_dau'] = $result['dau_dacbiet'][$k];
                }

                //Dem so lan xuat hien cua duoi so
                if ($duoi != '' && $duoi == $dau_so[$k]) {
                    $result['duoi_dacbiet'][$k]++;
                    $result['total_dacbiet_duoi']++;
                    if ($result['duoi_dacbiet'][$k] > $result['phantram_dacbiet_duoi'])
                        $result['phantram_dacbiet_duoi'] = $result['duoi_dacbiet'][$k];
                }
            }//end loop all items
        }//end loop all au

        return $result;
    }

    /**
     * Thống kê theo tổng từ 0-9
     */
    function getItemsSum($time_turn, $lid, $type) {
        $result = array();
        $mang_so = array();

        switch ($type) {
            case 't1' ://Tong 0
                //
                $mang_so = array(
                    '00', '19', '28', '37', '46',
                    '55', '54', '73', '82', '91'
                );
                break; //
            case 't2' ://Tong 1
                $mang_so = array(
                    '01', '10', '29', '38', '47',
                    '56', '65', '74', '83', '92'
                );
                break;
            case 't3' ://Tong 2
                $mang_so = array(
                    '02', '11', '20', '39', '48',
                    '57', '66', '75', '84', '93'
                );
                break;
            case 't4' ://Tong 3
                $mang_so = array(
                    '03', '12', '21', '30', '49',
                    '58', '67', '76', '85', '94'
                );
                break;
            case 't5' ://Tong 4
                $mang_so = array(
                    '04', '13', '22', '31', '40',
                    '59', '68', '77', '86', '95'
                );
                break;
            case 't6' ://Tong 5
                $mang_so = array(
                    '05', '14', '23', '32', '41',
                    '50', '69', '78', '87', '96'
                );
                break;
            case 't7' ://Tong 6
                $mang_so = array(
                    '06', '15', '24', '33', '42',
                    '51', '60', '79', '88', '97'
                );
                break;
            case 't8' ://Tong 7
                $mang_so = array(
                    '07', '16', '25', '34', '43',
                    '52', '61', '70', '89', '98'
                );
                break;
            case 't9' ://Tong 8
                $mang_so = array(
                    '08', '17', '26', '35', '44',
                    '53', '62', '71', '80', '99'
                );
                break;
            case 't10' ://Tong 9
                $mang_so = array(
                    '09', '18', '27', '36', '45',
                    '54', '63', '72', '81', '90'
                );
                break;
        }//End switch

        $query = 'SELECT CONCAT_WS(\',\',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`,`date`
                            FROM `xs_result`
                            WHERE `lid`=' . Quote($lid)
                . ' ORDER BY `date` DESC'
                . ' LIMIT 0,' . $time_turn
        ;

        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();

        if ($list) {
            $result['total'] = 0;
            $result['phantram_count'] = 0;
            foreach ($mang_so as $v) {
                $count = 0;
                $tmp = array();
                $tmp['date'] = '';
                foreach ($list as $v1) {
                    $arr = explode(',', $v1->data);
                    foreach ($arr as $v2) {
                        if ($v == $v2) {
                            $count++;
                            if ($tmp['date'] == '') {
                                $tmp['date'] = $v1->date;
                            }
                        }
                    }
                }

                $tmp['count'] = $count;
                $tmp['number'] = $v;

                $result['value'][] = $tmp;
                $result['total'] = $result['total'] + $count;

                if ($count > $result['phantram_count'])
                    $result['phantram_count'] = $count;
//                }
            }//Duyet qua cac phan tu
        }

        return $result;
    }

    function getItemsSumEvenOdd($time_turn, $lid, $type) {
        if ($type == 0)
            $mang_so = array(
                '00', '02', '04', '06', '08',
                '11', '13', '15', '17', '19',
                '20', '22', '24', '26', '28',
                '31', '33', '35', '37', '39',
                '40', '42', '44', '46', '48',
                '51', '53', '55', '57', '59',
                '60', '62', '64', '66', '68',
                '71', '73', '75', '77', '79',
                '80', '82', '84', '86', '88',
                '91', '93', '95', '97', '99'
            );
        else
            $mang_so = array(
                '01', '03', '05', '07', '09',
                '10', '12', '14', '16', '18',
                '21', '23', '25', '27', '29',
                '30', '32', '34', '36', '38',
                '41', '43', '45', '47', '49',
                '50', '52', '54', '56', '58',
                '61', '63', '65', '67', '69',
                '70', '72', '74', '76', '78',
                '81', '83', '85', '87', '89',
                '90', '92', '94', '96', '98'
            );

        $query = 'SELECT CONCAT_WS(\',\',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`,`date`
                    FROM `xs_result`
                    WHERE `lid`=' . Quote($lid)
                . ' ORDER BY `date` DESC'
                . ' LIMIT 0,' . $time_turn
        ;

        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();

        $result = array();
        if ($list) {
            $result['total_count'] = 0;
            $result['total_notcount'] = 0;
            $result['phantram_count'] = 0;
            $result['phantram_notcount'] = 0;
            foreach ($mang_so as $v) {
                $count = 0;
                $tmp = array();
                $tmp['date'] = '';
                foreach ($list as $v1) {
                    $arr = explode(',', $v1->data);
                    foreach ($arr as $v2) {
                        if ($v == $v2) {
                            $count++;
                            if ($tmp['date'] == '') {
                                $tmp['date'] = $v1->date;
                            }
                        }
                    }
                }

                if ($tmp['date'] != '') {
                    $query = 'SELECT COUNT(id) AS total
                        FROM `xs_result`
                        WHERE `lid`=' . Quote($lid) . ' AND `date`>' . Quote($tmp['date'])
                    ;
                    $tmp['not_count'] = $this->db->query($query)->row()->total;
                    $tmp['count'] = $count;
                    $tmp['number'] = $v;


                    $result['value'][] = $tmp;

                    $result['total_count'] = $result['total_count'] + $count;
                    $result['total_notcount'] = $result['total_notcount'] + $tmp['not_count'];

                    if ($count > $result['phantram_count'])
                        $result['phantram_count'] = $count;
                    if ($tmp['not_count'] > $result['phantram_notcount'])
                        $result['phantram_notcount'] = $tmp['not_count'];
                }
            }//Duyet qua cac phan tu
        }

        return $result;
    }

    function getItemsDauDuoi($fromdate, $todate, $lid, $type) {
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));
        // Build query
        $query = 'SELECT CONCAT_WS(\',\',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data,date
                    FROM xs_result
                    WHERE lid=' . Quote($lid)
                . ' AND date>=' . Quote($from_date)
                . ' AND date<=' . Quote($to_date)
                . ' ORDER BY date DESC LIMIT 500'
        ;

        $list = $this->db->query($query)->result();

        $dau_so = array(
            '0' => 0,
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9
        );

        $result = array();
        foreach ($dau_so as $k => $v) {
            $result['total'][$k] = 0;
            //Lap tat ca cac ket qua theo thoi gian chon
            foreach ($list as $item) {
                $arr = explode(',', $item->data);

                $result['value'][$item->date][$k] = 0;
                //Lap cac ket qua trong 1 ngay                
                foreach ($arr as $r) {
                    if ($r != '') {
                        //Tach dau va duoi
                        $num = str_split($r, 1);
                        if ($type == 0) {
                            $dau = $num[0];
                            //Dem so lan xuat hien cua cac dau so                  
                            if ($dau != '' && $dau == $dau_so[$k]) {
                                $result['value'][$item->date][$k]++;
                                $result['total'][$k]++;
                            }
                        } else {
                            $duoi = $num[1];
                            //Dem so lan xuat hien cua duoi so
                            if ($duoi != '' && $duoi == $dau_so[$k]) {
                                $result['value'][$item->date][$k]++;
                                $result['total'][$k]++;
                            }
                        }
                    }
                }//loop result
            }//end loop all items
        }//end loop all au
        return $result;
    }

    function getItemsLotoSum($fromdate, $todate, $lid) {
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));
        // Build query
        $query = 'SELECT CONCAT_WS(\',\',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data,date
                    FROM xs_result
                    WHERE lid=' . Quote($lid)
                . ' AND date>=' . Quote($from_date)
                . ' AND date<=' . Quote($to_date)
                . ' ORDER BY date DESC LIMIT 500'
        ;

        $list = $this->db->query($query)->result();

        $dau_so = array(
            '0' => 0,
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9
        );

        $result = array();
        foreach ($dau_so as $k => $v) {
            $result['total'][$k] = 0;
            //Lap tat ca cac ket qua theo thoi gian chon
            foreach ($list as $item) {
                $arr = explode(',', $item->data);

                $result['value'][$item->date][$k]->total = 0;
                $result['value'][$item->date][$k]->so = '';
                //Lap cac ket qua trong 1 ngay                
                foreach ($arr as $r) {
                    if ($r != '') {
                        //Tach dau va duoi
                        $num = str_split($r, 1);
                        $dau = $num[0];
                        $duoi = $num[1];
                        $sum = $dau + $duoi;
                        if ($sum < 10)
                            $sum = '0' . $sum;
                        $num = str_split($sum, 1);
                        $duoi = $num[1];

                        //Dem so lan xuat hien cua duoi so
                        if ($duoi != '' && $duoi == $dau_so[$k]) {
                            $result['value'][$item->date][$k]->total++;
                            if ($result['value'][$item->date][$k]->so == '')
                                $result['value'][$item->date][$k]->so = $r;
                            else
                                $result['value'][$item->date][$k]->so.=',' . $r;
                            $result['total'][$k]++;
                        }
                    }
                }//loop result
            }//end loop all items
        }//end loop all au
        return $result;
    }

    function InVeDo($date, $lid) {
        $date = date('Y-m-d', strtotime($date));

        $this->db->where('r.date <=', $date);

        if ($lid == 1)
            $this->db->where('l.area', 'MB');
        elseif ($lid == 2)
            $this->db->where('l.area', 'MT');
        else
            $this->db->where('l.area', 'MN');

        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.area, l.time')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->limit(4)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        $items = null;
        foreach ($data as $i => $item) {
            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime($item->date));
            $data[$i]->area_name = $areaList[$item->area];

            if ($lid != 1)
                $items[$data[$i]->date][] = $data[$i];
        }

        if ($lid == 1)
            return $data;
        else
            return $items;
    }

    function getDemoDate($lid) {
        $this->db->where('lid', $lid);
        $data = $this->db->select('date')
                ->from('xs_result')
                ->order_by('date', 'DESC')
                ->limit(30, 0)
                ->get()
                ->result();
//        echo $this->db->last_query();
        return $data;
    }

    function getDemoItem($lid, $date) {
        $this->db->where('r.lid', $lid);
        $this->db->where('r.date', $date);
        $data = $this->db->select('r.*, l.area, l.alias')->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->get()
                ->row();
        return $data;
    }

}