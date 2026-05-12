<?php

function get_cat($datedove) {
    $db = new MyDBO();
    $sql = "SELECT * FROM `vietlott_data` WHERE type = 2 AND date like '$datedove%' LIMIT 1";
    //var_dump($sql); die;
    $rows = $db->get_rows($sql);

    return $rows;
}

function get_data($datedove) {    
    $array_number = $number_soi;
//    var_dump($number_soi); die;
    
    $href = new href();    
    $arr_cat = get_cat($datedove);   
    
   //var_dump($arr_cat); die;
    $defalutExecution = ini_get('max_execution_time');
    @set_time_limit(60 * 30);
    //var_dump($arr_cat[0]); die;
    if (count($arr_cat)) { 
       
        ?>    
                <div class="box_kqxs box_cc">
                    <?php			
			for($i=0; $i<1; $i++) { 
			$item = $arr_cat[$i];
			$data_max_content = json_decode($item->content); 			
			?>
                    <div id="kqxs_max4d">
                        <div class="result-header">
                            <h2>
                                <span>Xổ số MAX 4D <?php echo rebuild_date('l', strtotime($item->date));?> ngày <?php echo date('d/m/Y', strtotime($item->date))?></span>                    
                            </h2>
                            <div class="div-toolbar" style="display: none;">
                                <a href="javascript:void(0)" class="printResult" onclick="window.print()"><i class="fa fa-print"></i></a>
                            </div>
                        </div>
                        <div class="box_so">
                            <div class="box_so_left">
                                <table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#dedede">
                                    <tbody>
                                        <tr class="web_bg_Trang">
                                            <td class="web_XS_1 chugiai">Giải nhất</td>
                                            <td colspan="12" class="web_XS_2 chukq">
                                                <span class="do">
                                                    <span class="do"><?php echo $data_max_content->content->nd->g1->kq; ?></span>                </span>
                                            </td>
                                        </tr>
                                        <tr class="web_bg_Trang">
                                            <td class="web_XS_1 chugiai">Giải nhì</td>
                                            <?php $giainhi = explode('-', $data_max_content->content->nd->g2->kq); ?>
                                            <td colspan="6" class="web_XS_2 chukq"><?php echo trim($giainhi[0]); ?></td>
                                            <td colspan="6" class="web_XS_2 chukq"><?php echo trim($giainhi[1]); ?></td>
                                        </tr>
                                        <tr class="web_bg_Trang">
                                            <td class="web_XS_1 chugiai">Giải ba</td>
                                            <?php $giaiba = explode('-', $data_max_content->content->nd->g3->kq); ?>
                                            <td colspan="4" class="web_XS_2 chukq"><?php echo trim($giaiba[0]); ?></td>
                                            <td colspan="4" class="web_XS_2 chukq"><?php echo trim($giaiba[1]); ?></td>
                                            <td colspan="4" class="web_XS_2 chukq"><?php echo trim($giaiba[2]); ?></td>
                                        </tr>
                                        <tr class="web_bg_Trang">
                                            <td class="web_XS_1 chugiai">Giải khuyến khích 1</td>
                                            <td colspan="12" class="web_XS_2 chukq"><?php echo trim($data_max_content->content->nd->kk1->kq); ?></td>
                                        </tr>
                                        <tr class="web_bg_Trang">
                                            <td class="web_XS_1 chugiai">Giải khuyến khích 2</td>
                                            <td colspan="12" class="web_XS_2 chukq"><?php echo trim($data_max_content->content->nd->kk2->kq); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php if($i==0){?>
                    <table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#dedede" class="cbv-tbl2">
                        <tbody>
                            <tr class="web_bg_title_tinh">
                                <td colspan="3" class="web_XS_1 chugiai bg_do">Cơ cấu Giải thưởng</td>
                            </tr>
                            <tr class="table_lmt_title">
                                <td>Giải thưởng</td>
                                <td>Kết quả</td>
                                <td>Giá trị giải thưởng (VNĐ)</td>
                            </tr>
                            <tr>
                                <td>Giải nhất</td>
                                <td>Trùng số trúng giải Nhất theo đúng thứ tự các chữ số</td>
                                <td>15.000.000</td>
                            </tr>
                            <tr>
                                <td>Giải nhì</td>
                                <td>Trùng bất kỳ 1 trong 2 số trúng giải Nhì theo đúng thứ tự của các chữ số</td>
                                <td>6.500.000</td>
                            </tr>
                            <tr>
                                <td>Giải ba</td>
                                <td>Trùng bất kỳ 1 trong 3 số trúng giải Ba theo đúng thứ tự của các chữ số</td>
                                <td>3.000.000</td>
                            </tr>
                            <tr>
                                <td>Giải Khuyến khích 1</td>
                                <td>3 chữ số cuối của số tham gia dự thưởng trùng 3 chữ số cuối của số trúng giải Nhất theo đúng thứ tự của các chữ số</td>
                                <td>1.000.000</td>
                            </tr>
                            <tr>
                                <td>Giải Khuyến khích 2</td>
                                <td>2 chữ số cuối của số tham gia dự thưởng trùng 2 chữ số cuối của số trúng giải Nhất theo đúng thứ tự của các chữ số</td>
                                <td>100.000</td>
                            </tr>
                        </tbody>
                    </table>
                    <?php }?>
                    <?php } ?>                        
                </div>				
    <?php	
    }
    @set_time_limit($defalutExecution);    
    die;
}
function rebuild_date( $format, $time = 0 )
{
    if ( ! $time ) $time = time();

	$lang = array();
	$lang['sun'] = 'CN';
	$lang['mon'] = 'T2';
	$lang['tue'] = 'T3';
	$lang['wed'] = 'T4';
	$lang['thu'] = 'T5';
	$lang['fri'] = 'T6';
	$lang['sat'] = 'T7';
	$lang['sunday'] = 'Chủ nhật';
	$lang['monday'] = 'Thứ hai';
	$lang['tuesday'] = 'Thứ ba';
	$lang['wednesday'] = 'Thứ tư';
	$lang['thursday'] = 'Thứ năm';
	$lang['friday'] = 'Thứ sáu';
	$lang['saturday'] = 'Thứ bảy';
	$lang['january'] = 'Tháng Một';
	$lang['february'] = 'Tháng Hai';
	$lang['march'] = 'Tháng Ba';
	$lang['april'] = 'Tháng Tư';
	$lang['may'] = 'Tháng Năm';
	$lang['june'] = 'Tháng Sáu';
	$lang['july'] = 'Tháng Bảy';
	$lang['august'] = 'Tháng Tám';
	$lang['september'] = 'Tháng Chín';
	$lang['october'] = 'Tháng Mười';
	$lang['november'] = 'Tháng M. một';
	$lang['december'] = 'Tháng M. hai';
	$lang['jan'] = 'T01';
	$lang['feb'] = 'T02';
	$lang['mar'] = 'T03';
	$lang['apr'] = 'T04';
	$lang['may2'] = 'T05';
	$lang['jun'] = 'T06';
	$lang['jul'] = 'T07';
	$lang['aug'] = 'T08';
	$lang['sep'] = 'T09';
	$lang['oct'] = 'T10';
	$lang['nov'] = 'T11';
	$lang['dec'] = 'T12';

    $format = str_replace( "r", "D, d M Y H:i:s O", $format );
    $format = str_replace( array( "D", "M" ), array( "[D]", "[M]" ), $format );
    $return = date( $format, $time );

    $replaces = array(
        '/\[Sun\](\W|$)/' => $lang['sun'] . "$1",
        '/\[Mon\](\W|$)/' => $lang['mon'] . "$1",
        '/\[Tue\](\W|$)/' => $lang['tue'] . "$1",
        '/\[Wed\](\W|$)/' => $lang['wed'] . "$1",
        '/\[Thu\](\W|$)/' => $lang['thu'] . "$1",
        '/\[Fri\](\W|$)/' => $lang['fri'] . "$1",
        '/\[Sat\](\W|$)/' => $lang['sat'] . "$1",
        '/\[Jan\](\W|$)/' => $lang['jan'] . "$1",
        '/\[Feb\](\W|$)/' => $lang['feb'] . "$1",
        '/\[Mar\](\W|$)/' => $lang['mar'] . "$1",
        '/\[Apr\](\W|$)/' => $lang['apr'] . "$1",
        '/\[May\](\W|$)/' => $lang['may2'] . "$1",
        '/\[Jun\](\W|$)/' => $lang['jun'] . "$1",
        '/\[Jul\](\W|$)/' => $lang['jul'] . "$1",
        '/\[Aug\](\W|$)/' => $lang['aug'] . "$1",
        '/\[Sep\](\W|$)/' => $lang['sep'] . "$1",
        '/\[Oct\](\W|$)/' => $lang['oct'] . "$1",
        '/\[Nov\](\W|$)/' => $lang['nov'] . "$1",
        '/\[Dec\](\W|$)/' => $lang['dec'] . "$1",
        '/Sunday(\W|$)/' => $lang['sunday'] . "$1",
        '/Monday(\W|$)/' => $lang['monday'] . "$1",
        '/Tuesday(\W|$)/' => $lang['tuesday'] . "$1",
        '/Wednesday(\W|$)/' => $lang['wednesday'] . "$1",
        '/Thursday(\W|$)/' => $lang['thursday'] . "$1",
        '/Friday(\W|$)/' => $lang['friday'] . "$1",
        '/Saturday(\W|$)/' => $lang['saturday'] . "$1",
        '/January(\W|$)/' => $lang['january'] . "$1",
        '/February(\W|$)/' => $lang['february'] . "$1",
        '/March(\W|$)/' => $lang['march'] . "$1",
        '/April(\W|$)/' => $lang['april'] . "$1",
        '/May(\W|$)/' => $lang['may'] . "$1",
        '/June(\W|$)/' => $lang['june'] . "$1",
        '/July(\W|$)/' => $lang['july'] . "$1",
        '/August(\W|$)/' => $lang['august'] . "$1",
        '/September(\W|$)/' => $lang['september'] . "$1",
        '/October(\W|$)/' => $lang['october'] . "$1",
        '/November(\W|$)/' => $lang['november'] . "$1",
        '/December(\W|$)/' => $lang['december'] . "$1" );

    return preg_replace( array_keys( $replaces ), array_values( $replaces ), $return );
}

?>
