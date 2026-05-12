<?php

class update {

    function __construct() {
		include('phpWebHacks.php');
		include('parse.php');
        $this->_timeMB = '18:10';
        $this->_timeMT = '17:14';
        $this->_timeMN = '16:12';

        $this->_timeMB_end = '19:00';
        $this->_timeMT_end = '18:00';
        $this->_timeMN_end = '17:00';

        $this->simple_cache = new Simple_cache();
    }

    function update() {

        global $_db;
//die('hainh');
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
 
        // MIEN BAC 
        if ($area == 0) {
            $date = date('Y-m-d');
            $row = $this->read_xml_home($area, $date, 1);
     
            if ($row){
                $_db->close();
                die('Da quay xong.');
            }

            $rows = $this->getAll(1);
          
            if ($rows) {
                $total = count($rows);
                $last_row = $rows[$total - 1];

                if (!isset($_SESSION['created']))
                    $_SESSION['created'] = $last_row->created;
                elseif ($last_row->created <= $_SESSION['created']) {
                    return true;
                }

                $_SESSION['created'] = $last_row->created;

                if ($last_row->magiai == 1) {
                    $rows[$total]->magiai = 2;
                    $rows[$total]->giai = '+++++';
                } elseif ($last_row->magiai == 2) {
                    $rows[$total]->magiai = $last_row->magiai;
                    if ($last_row->thutu == 2)
                        $rows[$total]->magiai = 3;
                    $rows[$total]->giai = '+++++';
                } elseif ($last_row->magiai == 3) {
                    $rows[$total]->magiai = $last_row->magiai;
                    $rows[$total]->giai = '+++++';
                    if ($last_row->thutu == 6) {
                        $rows[$total]->magiai = 4;
                        $rows[$total]->giai = '++++';
                    }
                } elseif ($last_row->magiai == 4) {
                    $rows[$total]->magiai = $last_row->magiai;
                    if ($last_row->thutu == 4)
                        $rows[$total]->magiai = 5;
                    $rows[$total]->giai = '++++';
                } elseif ($last_row->magiai == 5) {
                    $rows[$total]->magiai = $last_row->magiai;
                    $rows[$total]->giai = '++++';
                    if ($last_row->thutu == 6) {
                        $rows[$total]->magiai = 6;
                        $rows[$total]->giai = '+++';
                    }
                } elseif ($last_row->magiai == 6) {
                    $rows[$total]->magiai = $last_row->magiai;
                    $rows[$total]->giai = '+++';
                    if ($last_row->thutu == 3) {
                        $rows[$total]->magiai = 7;
                        $rows[$total]->giai = '++';
                    }
                } elseif ($last_row->magiai == 7) {
                    $rows[$total]->magiai = $last_row->magiai;
                    $rows[$total]->giai = '++';
                    if ($last_row->thutu == 4) {
                        $rows[$total]->magiai = 9;
                        $rows[$total]->giai = '+++++';
                    }
                }

                $result = array();
                $code = 'MB';
                $result[$code]['lid'] = 1;
                $result[$code]['name'] = 'Miền Bắc';
                $result[$code]['alias'] = 'xo-so-mien-bac';

                $result[$code]['area'] = $area;
                $result[$code]['code'] = $code;
                $data = array();
                $data_b = array();
                $arr_loto = array();
                $data[0] = '*****';
                $data_b[0] = '**';
                $data[1] = '*****';
                $data_b[1] = '**';
                $data[2] = '*****-*****';
                $data_b[2] = '**,**';
                $data[3] = '*****-*****-*****-*****-*****-*****';
                $data_b[3] = '**,**,**,**,**,**';
                $data[4] = '****-****-****-****';
                $data_b[4] = '**,**,**,**';
                $data[5] = '****-****-****-****-****-****';
                $data_b[5] = '**,**,**,**,**,**';
                $data[6] = '***-***-***';
                $data_b[6] = '**,**,**';
                $data[7] = '**-**-**-**';
                $data_b[7] = '**,**,**,**';
                $data[8] = '';
                $data_b[8] = '';
                $state = 0;
                foreach ($rows as $value) {
                    if ($value->magiai == 9 && strpos($value->giai, "+") === false) {
                        $state = 1;
                        $value->magiai = 0;
                    }

                    $tengiai = $value->magiai;
                    $so = $value->giai;

                    $sub = substr($so, -2, 2);
                    $arr_loto[] = $sub;

                    $data_b[$tengiai] = preg_replace('/\*\*/', $sub, $data_b[$tengiai], 1);
                    $tmp = explode('-', $data[$tengiai]);
                    $data[$tengiai] = preg_replace('/' . str_repeat('\*', strlen($tmp[0])) . '/', $so, $data[$tengiai], 1);
                }

                ksort($data);
                ksort($data_b);
                $result[$code]['data'] = $data;
                $result[$code]['data_b'] = $data_b;
                $result[$code]['extra'] = $this->getExtra($arr_loto);
                $result[$code]['status'] = 0;

//                var_dump($result);

                $_tmp = array();
                $_tmp['area'] = $area;
                $_tmp['data'] = $result;
                $this->update_xml($area, $date, $_tmp, 0);
                $this->saveLog($area . ' - update xstt');

                if ($state == 1)
                    $this->update_result($result, $date);

                return true;
            }
        }elseif ($area == 1 || $area == 2) {
       // MIEN TRUNG HOAC MIEN NAM
	   
	   
	   
            $date = date('Y-m-d');
            $row = $this->read_xml_home($area, $date, 1);
			//var_dump($row); die;
			//die('fsdfhsdfhsdk');
            if ($row){
                $_db->close();
                die('Da quay xong.');
            }

            if (!$this->simple_cache->is_cached('location')) {
                $query = 'SELECT id,name,alias,code,lich,id_tinh,area FROM xs_location ORDER BY ordering ASC';
                $_db->setQuery($query);
                $result = $_db->loadObjectList();
                $location = array();
                foreach ($result as $value) {
                    if ($value->area != 'MB') {
                        $value->id_tinh = str_replace(',', '', $value->id_tinh);
                        if ($value->area == 'MT')
                            $value->area = 1;
                        elseif ($value->area == 'MN')
                            $value->area = 2;
                        for ($i = 1; $i <= 7; $i++) {
                            if (strpos($value->lich, strval($i)) !== false)
                                $location[$value->area][$i][] = $value;
                        }
                    }
                }

                // store in cache
                $this->simple_cache->cache_item('location', $location);
            } else {
                $location = $this->simple_cache->get_item('location');
            }
            $today = strval(date('w') +1);
				//$today = 2;
			
            
            $location_today = $location[$area][$today];

            $result = array();
            $check_finished = false;
            $states = array();
			//var_dump($location_today); die;
            foreach ($location_today as $value) {
				
                $rows = $this->getAll($value->id);
				
                if ($rows) {
                    $total = count($rows);
                    $last_row = $rows[$total - 1];

                    if ($last_row->magiai == 8) {
                        $rows[$total]->magiai = 7;
                        $rows[$total]->giai = '+++';
                    } elseif ($last_row->magiai == 7) {
                        $rows[$total]->magiai = 6;
                        $rows[$total]->giai = '++++';
                    } elseif ($last_row->magiai == 6) {
                        $rows[$total]->magiai = $last_row->magiai;
                        $rows[$total]->giai = '++++';
                        if ($last_row->thutu == 3)
                            $rows[$total]->magiai = 5;
                    } elseif ($last_row->magiai == 5) {
                        $rows[$total]->magiai = 4;
                        $rows[$total]->giai = '+++++';
                    } elseif ($last_row->magiai == 4) {
                        $rows[$total]->magiai = $last_row->magiai;
                        $rows[$total]->giai = '+++++';
                        if ($last_row->thutu == 7)
                            $rows[$total]->magiai = 3;
                    } elseif ($last_row->magiai == 3) {
                        $rows[$total]->magiai = $last_row->magiai;
                        $rows[$total]->giai = '+++++';
                        if ($last_row->thutu == 2)
                            $rows[$total]->magiai = 2;
                    } elseif ($last_row->magiai == 2) {
                        $rows[$total]->magiai = 1;
                        $rows[$total]->giai = '+++++';
                    } elseif ($last_row->magiai == 1) {
                        $rows[$total]->magiai = 0;
                        $rows[$total]->giai = '++++++';
                    }
	
                    $code = $value->code;
                    $result[$code]['lid'] = $value->id;
                    $result[$code]['name'] = $value->name;
                    $result[$code]['alias'] = $value->alias;

                    $result[$code]['area'] = $area;
                    $result[$code]['code'] = $code;
                    $data = array();
                    $data_b = array();
                    $arr_loto = array();
                    $data[0] = '******';
                    $data_b[0] = '**';
                    $data[1] = '*****';
                    $data_b[1] = '**';
                    $data[2] = '*****';
                    $data_b[2] = '**';
                    $data[3] = '*****-*****';
                    $data_b[3] = '**,**';
                    $data[4] = '*****-*****-*****-*****-*****-*****-*****';
                    $data_b[4] = '**,**,**,**,**,**,**';
                    $data[5] = '****';
                    $data_b[5] = '**';
                    $data[6] = '****-****-****';
                    $data_b[6] = '**,**,**';
                    $data[7] = '***';
                    $data_b[7] = '**';
                    $data[8] = '**';
                    $data_b[8] = '**';
                    $states[$code] = 0;
					//var_dump($rows); die;
                    foreach ($rows as $value) {
						
                        if ($value->magiai == 0 && strpos($value->giai, "++++++") === false){
							$states[$code] = 1;
						}
                            

                        $tengiai = $value->magiai;
                        $so = $value->giai;

                        $sub = substr($so, -2, 2);
                        $arr_loto[] = $sub;

                        $data_b[$tengiai] = preg_replace('/\*\*/', $sub, $data_b[$tengiai], 1);
                        $tmp = explode('-', $data[$tengiai]);
                        $data[$tengiai] = preg_replace('/' . str_repeat('\*', strlen($tmp[0])) . '/', $so, $data[$tengiai], 1);
                    }
					
//var_dump($data[$tengiai]); die;
                    ksort($data);
                    ksort($data_b);
                    $result[$code]['data'] = $data;
                    $result[$code]['data_b'] = $data_b;
                    $result[$code]['extra'] = $this->getExtra($arr_loto);
                    $result[$code]['status'] = 0;
//var_dump($_SESSION['created' . $value->id].'<br>');  
//var_dump($last_row->created); die; 
                    if (!isset($_SESSION['created' . $value->id])){
						//die('1');
						$_SESSION['created' . $value->id] = $last_row->created;
					}                        
                    elseif ($last_row->created < $_SESSION['created' . $value->id]) {
						//die('2');
                        continue;
                    }

                    $check_finished = true;

                    $_SESSION['created' . $value->id] = $last_row->created;
                }
				
            }
		//var_dump($check_finished); die; 
            
				if ($check_finished == true) {
					$_tmp = array();
					$_tmp['area'] = $area;
					$_tmp['data'] = $result;
					$this->update_xml($area, $date, $_tmp, 0);
					$this->saveLog($area . ' - update xstt');

					$state = 1;
					foreach ($states as $v) {						
						if ($v == 0) {
							$state = 0;
							break;
						}
					}					
					if ($state == 1)
						$this->update_result($result, $date);
				}
			
            return true;
        } else {
            $_db->close();
            $time = date('H:i');
            echo $time.' <=> ';
            die('Ko phai gio quay.');
        }
    }
	
    function update_result($result, $date) {
        global $_db;	
		
//var_dump($result);die;
        foreach ($result as $v) {
			if($v['lid'] == 1){
				$urlget = "https://data.minhngoc.net/O0O/0/xstt/js_m2.js?_=1583314028805";
				$content = $this->curl_page2($urlget);
				$v['khtt'] = '';
				if(preg_match('/lv\s*:\s*"([^"]*)"/is', $content, $matches)){
					$v['khtt'] = trim($matches[1]);
					file_put_contents("/home/xoso/public_html/xstt/khtt.txt", trim($matches[1]));
				}
			}
			
            $_db->setQuery('INSERT IGNORE INTO xs_result SET
                            lid=' . $v['lid'] . '
							,khtt=\'' . trim($v['khtt']) . '\'
                            ,date=\'' . $date . '\'
                            ,extension=\'' . json_encode($v['extra']) . '\'                            
                            ,a0=\'' . $v['data'][0] . '\'
                            ,a1=\'' . $v['data'][1] . '\'
                            ,a2=\'' . $v['data'][2] . '\'
                            ,a3=\'' . $v['data'][3] . '\'
                            ,a4=\'' . $v['data'][4] . '\'
                            ,a5=\'' . $v['data'][5] . '\'
                            ,a6=\'' . $v['data'][6] . '\'
                            ,a7=\'' . $v['data'][7] . '\'
                            ,a8=\'' . $v['data'][8] . '\'
                            ,b0=\'' . $v['data_b'][0] . '\'
                            ,b1=\'' . $v['data_b'][1] . '\'
                            ,b2=\'' . $v['data_b'][2] . '\'
                            ,b3=\'' . $v['data_b'][3] . '\'
                            ,b4=\'' . $v['data_b'][4] . '\'
                            ,b5=\'' . $v['data_b'][5] . '\'
                            ,b6=\'' . $v['data_b'][6] . '\'
                            ,b7=\'' . $v['data_b'][7] . '\'
                            ,b8=\'' . $v['data_b'][8] . '\'
                        ');
			
            $_db->query();
        }
    }

    function read_xml_home($area, $date, $state) {
        $file = 'mb.txt';
        if ($area == 1)
            $file = 'mt.txt';
        elseif ($area == 2)
            $file = 'mn.txt';
//var_dump($area); die;
//        $file = 'http://data.xoso.com/xstt/' . $file; //213
//        $file = 'http://www.xoso.com/xstt/' . $file;//114
        $file = '../xstt/' . $file; //114
        $data = $this->curl_page2($file);
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

    function get_file_name($area = NULL) {
        $file = 'mb.txt';
        if ($area == 1)
            $file = 'mt.txt';
        elseif ($area == 2)
            $file = 'mn.txt';

        $file = '../xstt/' . $file;
        if (!file_exists($file)) {
            $fl = fopen($file, 'w');
            fclose($fl);
        }
        return $file;
    }

    function update_xml($area, $date, $cache, $state) {
        if ($area == 0) {
            $filename = '../xstt/xsmb.php';
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
//                    $count_str = 0;
//                    foreach ($arr as $v1) {
//                        if ($v1 != '**' && $v1 != '++') {
//                            $count_str = $count_str + 1;
//                        }
//                    }
//                    $tmp['count_b'] = $count_str;

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

                unset($cache, $state, $f, $data, $file);
            }
        } else {
            $this->saveLog('The file ' . $file . ' is not writable');
        }
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

    function getAll($matinh) {
        global $_db;

        $result = null;
        if ($matinh == 1)
            $query = 'SELECT matinh,magiai,thutu,giai,created FROM xs_live ORDER BY created ASC,magiai ASC,thutu ASC';
        else
            $query = 'SELECT matinh,magiai,thutu,giai,created FROM xs_live WHERE matinh=' . $matinh . ' ORDER BY created ASC,magiai DESC,thutu ASC';
        
		$_db->setQuery($query);
        $result = $_db->loadObjectList();
        return $result;
    }

    function saveLog($str) {
        echo '<p>' . $str . '</p>';
        $f = fopen('log/update_' . date('Y-m-d') . '.txt', 'a');
        if ($f) {
            $time = date('[d/m/Y H:i:s] - ');
            fwrite($f, $time . $str . "\n");
            fclose($f);
        }
    }
	function curl_page3($url, $curl_header = 0, $cookie = '') {
        $referer = 'https://www.google.com/';
        $useragent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36';
        $timeout = 20;
        $connecttimeout = 5;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, $curl_header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);

        if ($cookie != '')
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);

        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connecttimeout);
        $html_content = curl_exec($ch);
        curl_close($ch);

        return $html_content;
    }
	function curl_page2($link, $curl_header = 0, $cookie = '') {
		$ran_get = rand(0,1);
		if($ran_get == 0){			
        $browser = new phpWebHacks();
		$arr_post = array();
		$arr_post['sourcelink'] = $link;
		$arr_post['User-Agent'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36';
		$response	=	$browser->post('http://servercrawl.com',$arr_post);
		$response = trim(preg_replace('/startmyIP.*?endmyIP:\s*<hr\s*\/>\s*/ism','', $response));
		unset($browser);
		}else{			
			$response = $this->curl_page3($link);
		}
		//$response = 'kqxs.mn={run:1,tinh:"7,8,9",ntime:1757408250,delay:20000,kq:{7:{lv:"K36-T09",8:"72",7:"125",6:["9681","3525","8784"],5:"6835",4:["09930","64424","31398","66538","17339","30770","75424"],3:["05032","49852"],2:"58587",1:"53792",0:"198926"},8:{lv:"9B",8:"49",7:"336",6:["3348","5878","6122"],5:"6298",4:["55942","92260","40504","99546","23540","09745","90962"],3:["59970","34857"],2:"46101",1:"17322",0:"637713"},9:{lv:"T9-K2",8:"95",7:"758",6:["1357","2135","3554"],5:"7421",4:["37704","69421","56252","90656","72086","88642","42680"],3:["97698","17569"],2:"85461",1:"38586",0:"098958"}}};';
		$response = preg_replace('/(\w+)+:/ism', '"$1":', $response);
		$response = preg_replace('/^[^=]+=/is', '', $response);
		$response = str_replace('kqxs.mn=', '', $response);
		$response = str_replace('kqxs.mt=', '', $response);
		$response = str_replace('kqxs.mb=', '', $response);
		$response = str_replace(';', '', $response);
		return $response;
    }
}
