<?php
function get_data() {

    $href = new href();
    $defalutExecution = ini_get('max_execution_time');
    @set_time_limit(60 * 30);
        $objcontent = file_get_contents('http://vietlott.vn/vi/trung-thuong/ket-qua-trung-thuong/655');
		
       // if($objcontent->header == 200){
            $html = loadHtmlString($objcontent);
            $main_content = $html->find('div[class=chitietketqua_table]',0);
			$tienUocTinh1 = $main_content->find('div[class=so_tien]',0);
			$tienUocTinh1 = trim($tienUocTinh1->find('h3',0)->innertext);
			
			$tienUocTinh2 = $main_content->find('div[class=so_tien]',1);
			$tienUocTinh2 = trim($tienUocTinh2->find('h3',0)->innertext);

            $arrUoc=array('jax1'=>$tienUocTinh1,'jax2'=>$tienUocTinh2);
            $objUoc= json_encode($arrUoc);
            if(is_object($main_content)){
                file_put_contents('/home/xoso/public_html/feed/power6gt.html', $objUoc);
//                file_put_contents('D:\wamp\www\0_CI_BH\1_xoso.comOnline170717/feed/power6gt.html', $main_content->innertext);
            }  
        //}        
    @set_time_limit($defalutExecution);    
    die;
}


?>
