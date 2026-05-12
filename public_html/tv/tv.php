<?php
    function get_cat()
	{
	 	$db = new MyDBO();
//	    $sql = "SELECT * FROM `tv_link_new` where bhid != 0 order by time_update LIMIT 17;";
	    $sql = "SELECT * FROM `tv_link_new` where id = 1 AND bhid != 0";
	    $rows = $db->get_rows($sql);
	    return $rows;
	}

	function get_data (){
		$db = new MyDBO();
		$href	=	new href();	
		echo date('Y-m-d H:i:s');
		echo '<hr/>';
		$arr_c = get_cat();
		$url = 'http://www.vtvplus.vn/index.php?option=com_vtv&task=user.login';
		$data = "username=bn@baihat.com&password=xemtv2014&save=1";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
	   	curl_setopt($ch, CURLOPT_POST, 1);
	  	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	  	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:16.0) Gecko/20100101 Firefox/16.0');
	  	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		if (count($arr_c)){			
			for ($i=0; $i<count($arr_c);$i++){
					
				$item = $arr_c[$i];
				$link = $item->link;
				$link = str_replace('&amp;','&',$link);
				echo $link.'<br>';
				curl_setopt($ch, CURLOPT_URL, $link);
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:16.0) Gecko/20100101 Firefox/16.0');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$content = curl_exec($ch);
				
				$reg_link = '/(http:\/\/cdn\.vtvplus\.vn\/medianet\/_definst_\/[^",]*)/ism';
				
				if (preg_match_all($reg_link,$content,$matches_link)){
					$sql_delete = "DELETE FROM `tv_links` WHERE `channel_id` = $item->bhid AND `title` = '$item->title'"; 
					$db->run_query($sql_delete);
					for ($i=0; $i<count($matches_link[1]);$i++){
						$sql_insert = "INSERT INTO `tv_links` SET 
											`vtvid` = ".Quote(trim($item->vtvid)).",
											`link` = ".Quote(trim($matches_link[1][$i])).",
											`title` = ".Quote(trim($item->title)).",
											`status` = 1,
											`channel_id` = ".Quote(trim($item->bhid));
						echo "Link $item->title: ".$matches_link[1][$i].'<br>';
						$db->run_query($sql_insert);
					}
				}
				echo '<hr>';
			$sql_update = "UPDATE  `tv_link_new` SET  
							`time_update` =  ".trim(strtotime('now'))." 
							WHERE  `id` =".$item->id;
			
			$db->run_query($sql_update);	 
			}
			curl_close($ch);
		}
		
	}
?>
