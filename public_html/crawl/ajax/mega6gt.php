<?php
function get_data() {

    $href = new href();
    $defalutExecution = ini_get('max_execution_time');
    @set_time_limit(60 * 30);
        //$objcontent = get_content('http://vietlott.vn/vi/trung-thuong/ket-qua-trung-thuong/645');
        $objcontent = file_get_contents('http://vietlott.vn/vi/trung-thuong/ket-qua-trung-thuong/645');
		//var_dump($objcontent->header); die;
        //if($objcontent->header == 200){
            $html = loadHtmlString($objcontent);            
			$main_content = $html->find('div[class=chitietketqua_table]',0);
            $tienUocTinh = $main_content->find('div[class=so_tien]',0);
			$tienUocTinh = trim($tienUocTinh->find('h3',0)->innertext);
            $arrUoc=array('ngay'=>'Giá trị đến thời điểm hiện tại: '.date('d/m/Y'),'money'=>$tienUocTinh);
            $objUoc= json_encode($arrUoc);
            if(is_object($main_content)){
                file_put_contents('/home/xoso/public_html/feed/mega6gt.html', $objUoc);
            }  
        //}        
    @set_time_limit($defalutExecution);    
    die;
}


?>
