<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tttt extends CI_Controller {

   // protected $_data = array();
	
	protected $_data = array();
    protected $_link = array();
	
    function __construct() {
        parent::__construct();
        $this->load->model(array('location_model', 'iphone_device_token_model', 'iphone_dv_register_receive_ms_model'));
    }

    public function index() {
        $this->load->view("layout/error404", $this->data);
    }

    public function statistic() {
	
        $idLocation = $this->input->get('idLocation');
        $count = $this->input->get('count');
        if (!$count)
            $count = 10;
        if (!$idLocation)
            $idLocation = 'mb';

        $idLocation = strtoupper($idLocation);
        //echo $idLocation.$count;

        $this->load->model('mobile_statistics_model');
        $location = $this->location_model->get_by(array('code' => $idLocation));
        $result = array();
        if ($location) {
            $data = $this->mobile_statistics_model->order_by('update_date', 'DESC')->get_by(array('lid' => $location->id, 'num_statistics' => $count));
            if ($data) {
                $result = json_decode($data->result);
            }
        }

        $this->_data['result'] = $result;
        $this->_data['days'] = $count;
        $this->_data['location'] = $location;
        $this->_data['tmpl'] = 'client/iphone/statistic';
        $this->load->view('client/iphone/content', $this->_data);
    }

    function register() {
        $device_token = $this->input->get('deviceToken');
        $area = $this->input->get('Area');
        $status = $this->input->get('status');
        $area = strtoupper($area);

        $id_device = NULL;
        if ($device_token != '' && ($area != '' && ($area == 'MB' || $area == 'MN' || $area == 'MT'))) {
            $data = array(
                'device_token' => $device_token,
                'time_create' => date('Y-m-d H:i:s'),
                'status' => 1
            );

            $row = $this->iphone_device_token_model->get_by(array('device_token' => $device_token));

            if ($row) {
                $id_device = $row->id;
            } else {
                if ($id_device = $this->iphone_device_token_model->insert($data)) {
                    echo('Insert device token success!');
                }
            }

            $row2 = $this->iphone_dv_register_receive_ms_model->get_by(array('id_device_token' => $id_device, 'area_receive' => $area));

            if ($id_device) {
                $data = array(
                    'id_device_token' => $id_device,
                    'area_receive' => $area,
                    'time' => date('Y-m-d H:i:s'),
                    'date_receive' => date('Y-m-d'),
                    'status' => 1
                );

                $row = $this->iphone_dv_register_receive_ms_model->get_by(array('area_receive' => $area, 'id_device_token' => $id_device));

                if (!$row) {
                    if ($this->iphone_dv_register_receive_ms_model->insert($data)) {
                        die('Success!');
                    }
                } else {
                    $data = array(
                        'status' => $status
                    );
                    if ($row2 & isset($status)) {
                        $id = $row2->id;
                        //	echo $id;
                        $this->iphone_dv_register_receive_ms_model->update($id, $data);
                        $str = ($status == 0) ? " huy mien " . $area . " thanh cong " : "dang ky mien " . $area . " thanh cong";
                        die($str);
                    }
                    //echo $id_device;
                    //$this->iphone_dv_register_receive_ms_model->update_many();
                    die('Your register content has existed!');
                }
            }
        } else {
            die('Device token and Area are required!');
        }
    }

    function push() {
        $root_dir = dirname($_SERVER['SCRIPT_FILENAME']) . '/';
        $rows = $this->iphone_device_token_model->get_all();
        foreach ($rows as $k => $v) {
            $deviceToken = $v->device_token; //'d9146b0f0f1313761725c10d9184f64a2e0e19436165f161212d7f8a60e929d7';
            //die($root_dir);
            //die($root_dir);
            // Put your device token here (without spaces):
            //$deviceToken = 'd9146b0f0f1313761725c10d9184f64a2e0e19436165f161212d7f8a60e929d7';
            // Put your private key's passphrase here:
            $passphrase = 'son09798';
            //$passphrase	=	'';
            // Put your alert message here:
            $message = 'Ket qua giai dac biet XSMB: 45644!';

            ////////////////////////////////////////////////////////////////////////////////

            $ctx = stream_context_create();
            //stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck_developer.pem');
            stream_context_set_option($ctx, 'ssl', 'local_cert', $root_dir . "data/ssl/" . 'ck_developer.pem');
            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

            // Open a connection to the APNS server
            $fp = stream_socket_client(
                    'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

            if (!$fp)
                exit("Failed to connect: $err $errstr" . PHP_EOL);

            echo 'Connected to APNS' . PHP_EOL;

            // Create the payload body
            $body['aps'] = array(
                'alert' => $message,
                'sound' => 'default'
            );

            // Encode the payload as JSON
            $payload = json_encode($body);

            // Build the binary notification
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));

            if (!$result)
                echo 'Message not delivered' . PHP_EOL;
            else
                echo 'Message successfully delivered' . PHP_EOL;

            // Close the connection to the server
            fclose($fp);
        }
    }

    public function now() {
        $getDate = (isset($_GET['date']) ? trim($_GET['date']) : '');
        $date = $getDate;
        $date = date('Y-m-d', strtotime(str_replace('/', '-', "$date")));
        $date_now = date('Y-m-d');

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        if ($getDate == '') {
            $date = date('Y-m-d', strtotime('-1 day'));
            foreach ($areaList as $ka => $va) {
                // Truy vấn dữ liệu bản kết quả xổ số
                $this->db->where("r.date", $date_now);
                $this->db->where("l.area", $ka);
                $this->db->where("r.id=(SELECT id FROM xs_result WHERE lid=l.id AND date='" . $date_now . "')");
                $this->db->where('l.status', 1);
                $list = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                        ->from('xs_result AS r')
                        ->join('xs_location AS l', 'r.lid = l.id', 'left')
                        ->order_by('r.date', 'DESC')
                        ->order_by('l.ordering', 'ASC')
                        ->get()
                        ->result();
//            echo $this->db->last_query();
//            die;

                if (!$list) {
                    // Truy vấn dữ liệu bản kết quả xổ số
                    $this->db->where("r.date", $date);
                    $this->db->where("l.area", $ka);
                    $this->db->where("r.id=(SELECT id FROM xs_result WHERE lid=l.id AND date='" . $date . "')");
                    $this->db->where('l.status', 1);
                    $list = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                            ->from('xs_result AS r')
                            ->join('xs_location AS l', 'r.lid = l.id', 'left')
                            ->order_by('r.date', 'DESC')
                            ->order_by('l.ordering', 'ASC')
                            ->get()
                            ->result();
                }

                foreach ($list as $k => $item) {
                    if ($ka == $item->area) {
                        $item->date = date('d/m/Y', strtotime("{$item->date}"));
                        $item->area_name = $areaList[$item->area];
                        $item->strday = $item->date;
                        $arr[$ka][] = $item;
                    }
                }//endforeach
            }//end foreach
        } else {
            foreach ($areaList as $ka => $va) {
                // Truy vấn dữ liệu bản kết quả xổ số
                $this->db->where("r.date", $date);
                $this->db->where("l.area", $ka);
                $this->db->where("r.id=(SELECT id FROM xs_result WHERE lid=l.id AND date='" . $date . "')");
                $this->db->where('l.status', 1);
                $list = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                        ->from('xs_result AS r')
                        ->join('xs_location AS l', 'r.lid = l.id', 'left')
                        ->order_by('r.date', 'DESC')
                        ->order_by('l.ordering', 'ASC')
                        ->get()
                        ->result();

                if (!$list) {
                    // Truy vấn dữ liệu bản kết quả xổ số
                    $this->db->where("l.area", $ka);
                    $this->db->where("r.id=(SELECT id FROM xs_result WHERE lid=l.id and (date=(SELECT date FROM xs_result ORDER BY date DESC LIMIT 1)) ORDER BY date DESC LIMIT 1)");
                    $this->db->where('l.status', 1);
                    $list = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                            ->from('xs_result AS r')
                            ->join('xs_location AS l', 'r.lid = l.id', 'left')
                            ->order_by('r.date', 'DESC')
                            ->order_by('l.ordering', 'ASC')
                            ->get()
                            ->result();
                }

                foreach ($list as $k => $item) {
                    if ($ka == $item->area) {
                        $item->date = date('d/m/Y', strtotime("{$item->date}"));
                        $item->area_name = $areaList[$item->area];
                        $item->strday = $item->date;
                        $arr[$ka][] = $item;
                    }
                }//endforeach
            }//end foreach
        }

        $this->_data['items'] = $arr;
        $this->load->view('client/iphone/now', $this->_data);
    }

    function result() {
//        $start_date = (isset($_GET['startDate']) ? trim($_GET['startDate']) : date('d-m-Y'));
        $end_date = (isset($_GET['endDate']) ? trim($_GET['endDate']) : date('d-m-Y'));
        $location = (isset($_GET['idLocation']) ? trim($_GET['idLocation']) : 'MB');
        $location = strtoupper($location);

        $this->_data['start_date'] = $start_date;
        $this->_data['end_date'] = $end_date;

//        $start_date = date('Y-m-d', strtotime(str_replace('/', '-', "$start_date")));
        $end_date = date('Y-m-d', strtotime(str_replace('/', '-', "$end_date")));

        // Truy vấn dữ liệu bản kết quả xổ số
//        $this->db->where("r.date >=", $start_date);
        $this->db->where("r.date <=", $end_date);
//        $this->db->where("l.code", $location);
//        $this->db->where('l.status', 1);
//        $list = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
//                ->from('xs_result AS r')
//                ->join('xs_location AS l', 'r.lid = l.id', 'left')
//                ->order_by('r.date', 'DESC')
//                ->order_by('l.ordering', 'ASC')
//                ->get()
//                ->result();
//        if (!$list) {
            $this->db->where("l.code", $location);
            $this->db->where('l.status', 1);
            $list = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                    ->from('xs_result AS r')
                    ->join('xs_location AS l', 'r.lid = l.id', 'left')
                    ->order_by('r.date', 'DESC')
                    ->order_by('l.ordering', 'ASC')
                    ->limit(10, 0)
                    ->get()
                    ->result();
//        }

        $this->_data['items'] = $list;
        $this->load->view('client/iphone/result', $this->_data);
    }

}