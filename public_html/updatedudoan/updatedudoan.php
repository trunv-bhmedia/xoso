<?php
	function get_data (){
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
                $db = new MyDBO();
		$today = date('w') + 1;
						
		$datetoday = date('d-m-Y');
                $location = getlocation($today);
                $href = new href();
                for($i = 0; $i < count($location); $i++){
                    $item = $location[$i];
                    
                    $lid = $item->id;
                    $date = date('Y-m-d');
                    $title = "Dự đoán xổ số ".$item->name." ngày ".$datetoday;
                    $title_link = $href->take_file_name($title);
					$title_link = str_replace('.','',$title_link);
                    $short_desc = '';
                    $content = "<strong>Dự đoán xổ số ".$item->name." ngày ".$datetoday."</strong><br></p>
                                <p>*Dự đoán đầu đuôi đặc biệt xổ số ".$item->name.":   </p>
                                <p>+)Đầu không về ".rand(1, 9)."-".rand(1, 9).",về ".rand(1, 9)."-".rand(1, 9)." </p>
                                <p>+)Đuôi không về ".rand(1, 9)."-".rand(1, 9).",về ".rand(1, 9)."-".rand(1, 9)." </p>
                                <p>*Dự đoán lô tô xổ số ".$item->name.":    </p>
                                <p>+)Bạch thủ:".rand(10, 99)." </p>
                                <p>+)Cặp 2 số: ".rand(11, 99)."-".rand(11, 99)."<br></p>                           
                                <p><strong style='font-size: 15px;'>Cặp số xác suất trúng cao soạn tin <font style='color: red;'>BHX MM ".$item->code."</font> <font style='color: blue;'>gửi</font> <font style='color: red;'>8588</font></strong><br></p>";
                    $created_date = date('Y-m-d H-i-s');
                    $meta_keywords = "Dự đoán xổ số ".$item->name." ngày ".$datetoday;
                    $meta_description = "xoso.com Dự đoán xổ số ".$item->name." ngày ".$datetoday;
                    $tags = "xo so ".strtolower($href->clean_text($item->name)).", ket qua xo so, xo so ba mien, xskt, truc tiep xo so, du doan ket qua, thong ke, bach thu";
                    $active = "yes";
                    
                    $sql_insert = "INSERT INTO `xs_dudoan` SET
                                        `lid` = ".Quote(trim($lid)).",
                                        `date` = ".Quote(trim($date)).",
                                        `title` = ".Quote(trim($title)).",
                                        `title_link` = ".Quote(trim($title_link)).",
                                        `content` = ".Quote(trim($content)).",
                                        `created_date` = ".Quote(trim($created_date)).",
                                        `meta_keywords` = ".Quote(trim($meta_keywords)).",
                                        `meta_description` = ".Quote(trim($meta_description)).",
                                        `tags` = ".Quote(trim($tags)).",
                                        `active` = ".Quote(trim($active)); 
                    										
                    $db->run_query($sql_insert);
                }
                
                echo "Update ngay: ".$datetoday;		
		
	}
	function getlocation($today){
		$db = new MyDBO();
		$select_u = "SELECT id, name, code FROM `xs_location` WHERE `lich` LIKE '%".trim($today)."%'";
                
		$rows = $db->get_rows($select_u);
		return $rows;		
	}	
	function Quote( $text )
	{
		$search=array("\\","\0","\n","\r","\x1a","'",'"');
        $replace=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
        $text = str_replace($search,$replace,$text);
       	$text = "'".$text."'";
		return $text;
	}
	
?>
