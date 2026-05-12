<?php
function get_data() {

    $href = new href();
    $defalutExecution = ini_get('max_execution_time');
    @set_time_limit(60 * 30);
        $objcontent = get_content('http://xosovietnam.vn/xo-so-mega-645.html');
        if($objcontent->header == 200){
            $html = loadHtmlString($objcontent->content);
            
            $main_content = $html->find('div[class=jackpost-x]',0);
            //var_dump($main_content->innertext); die;
            if(is_object($main_content)){
                file_put_contents('D:/wamp/www/xoso/feed/mega6gt.html', $main_content->innertext);
            }  
        }        
    @set_time_limit($defalutExecution);    
    die;
}


?>
