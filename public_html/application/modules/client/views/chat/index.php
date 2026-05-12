<?php
$v = $items;
$v->extra = json_decode($v->extension);
$v->data[0] = $v->a0;
$v->data[1] = $v->a1;
$v->data[2] = $v->a2;
$v->data[3] = $v->a3;
$v->data[4] = $v->a4;
$v->data[5] = $v->a5;
$v->data[6] = $v->a6;
$v->data[7] = $v->a7;

echo '<div class="title-top"><h2 style="padding:10px 0 0;font-size:18px;text-align:center;line-height:30px;text-transform:uppercase">KẾT QUẢ XỔ SỐ MIỀN BẮC NGÀY ' . str_replace('-', '/', $v->date) . '</h2><div class="tabs-note clearfix"><a class="span-tttt" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">Tường thuật trực tiếp >></a><a class="span-tkxs" href="' . $uri_root . 'thong-ke-quan-trong.html">Thống kê xổ số</a></div></div>';
?>
<div class="title title-red">
    <div class="title-right clearfix"><strong class="left xsmb">XỔ SỐ TRUYỀN THỐNG - <?php echo $v->date ?></strong>
        <div class="box-date-provide right">
            <input name="kqxs_date_<?php echo $k ?>" type="text" id="kqxs_date_<?php echo $k ?>" value="<?php echo str_replace('/', '-', $v->date) ?>" />
            <script type="text/javascript">/*<![CDATA[*/$("#kqxs_date_<?php echo $k ?>").datepick({dateFormat:"dd-mm-yyyy",maxDate:+0,onSelect:function(){var a=$("#kqxs_date_<?php echo $k ?>").val();document.location="<?php echo $uri_root . $v->alias ?>/"+a+".html"}});/*]]>*/</script>
        </div>
    </div>
</div>
<div class="box-result">
    <table class="tbl-tt tbl-main-tt">
        <tr>
            <td colspan="2" class="bg-yelow1"><a href="http://www.xoso.com/xo-so-mien-bac.html"><strong class="txt-red"><h2>Xổ Số <?php echo $v->name; ?> - <?php echo $v->dateOfWeek ?> ngày <?php echo $v->date ?></h2></strong></a></td>
            <td class="td-sub" rowspan="8">
                <table class="tbl-dd">
                    <tr>
                        <th class="first bg-yelow1">Đầu</th>
                        <th class="last bg-yelow1">Đuôi</th>
                    </tr>
                    <?php foreach ($v->extra as $k1 => $v1): ?>
                        <tr>
                            <td class="first"><?php echo $k1 ?></td>
                            <td class="<?php echo($k1 == 9 ? 'last' : ''); ?>"><?php echo $v1; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td class="bg-gray border-right">Giải đặc biệt</td>
            <td class="bg-gray border-right giaidb">
                <?php echo '<strong class="red font18 span-space">' . $v->data[0] . '</strong>'; ?>
            </td>
        </tr>
        <tr>
            <td class="border-right">Giải nhất</td>
            <td class="border-right giai1">
                <?php echo '<strong class="span-space">' . $v->data[1] . '</strong>'; ?>
            </td>
        </tr>
        <tr>
            <td class="bg-gray border-right">Giải nhì</td>
            <td class="bg-gray border-right giai2">
                <?php
                $str = str_replace('-', '</strong><strong class="span-space">', $v->data[2]);
                echo '<strong class="span-space">' . $str . '</strong>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="border-right">Giải ba</td>
            <td class="border-right giai3">
                <?php
                $str = str_replace('-', '</strong><strong class="span-space">', $v->data[3]);
                echo '<strong class="span-space">' . $str . '</strong>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="bg-gray border-right">Giải tư</td>
            <td class="bg-gray border-right giai4">
                <?php
                $str = str_replace('-', '</strong><strong class="span-space">', $v->data[4]);
                echo '<strong class="span-space">' . $str . '</strong>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="border-right">Giải năm</td>
            <td class="border-right giai5">
                <?php
                $str = str_replace('-', '</strong><strong class="span-space">', $v->data[5]);
                echo '<strong class="span-space">' . $str . '</strong>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="bg-gray border-right">Giải sáu</td>
            <td class="bg-gray border-right giai6">
                <?php
                $str = str_replace('-', '</strong><strong class="span-space">', $v->data[6]);
                echo '<strong class="span-space">' . $str . '</strong>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="border-right">Giải bảy</td>
            <td class="border-right giai7">
                <?php
                $str = str_replace('-', '</strong><strong class="span-space">', $v->data[7]);
                echo '<strong class="span-space">' . $str . '</strong>';
                ?>
            </td>
            <td></td>
        </tr>
    </table>
</div>
<div class="line-red">&nbsp;</div>
<ul class="list-editor space1">
    <li>Để nhận kết quả xổ số <strong>Miền Bắc</strong> sớm nhất, soạn tin <span>KQ MB</span> gửi <span>8017</span></li>
</ul>

<h1 style="color:#af0e0a">Dự đoán kết quả xổ số</h1>
<style type="text/css">
    input[type="text"]{padding:2px;height:15px;line-height:15px;font-family:arial,sans-serif}
    input[type="submit"]{cursor:pointer;font-family:arial,sans-serif}
    .msg {
        background: none repeat scroll 0 0 #f8ffea;
        border: 1px solid #b4eb41;
        color: #434600;
        display: inline-block;
        margin: 5px 0;
        padding: 5px;
    }
    .deletebutton:link, .deletebutton:visited, .deletebutton:hover, .deletebutton:active {
        background: url("<?php echo $uri_root ?>public/client/images/delete.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
        display: inline-block;
        height: 20px;
        overflow: hidden;
        position: absolute;
        right: -5px;
        top: -5px;
        width: 20px;
        z-index: 3;
    }

    .bet{float:left; border:#cdcdcd 1px solid; background:#f2f2f2; margin:5px; padding:2px 4px; font-size:12px; font-weight:bold; color:#333; position:relative; z-index:0; cursor:default}
    .bet_hover{border-color:#FF9E46}
    .betnum{font-size:18px; font-weight:bold; color:#bc1c18;line-height:22px}
    .bet_value{font-size:12px; font-weight:bold; color:#7101AD}
    .hilight{background:#FFE3AA}
    .selected{background:#d5d5d5; border-color:#cdcdcd}
    .trung{background:#fded93}
    .trung .nhay{position:absolute; top:-5px; right:-3px; z-index:2; background:red; color:white; padding:0 3px 0 3px; font-size:12px}
    .tool{position:absolute; top:-5px; right:-3px; z-index:3}
    #lichsu{width:560px;height:550px; overflow:auto}
    .lichsu{margin:5px 25px 5px 5px; border-collapse:collapse;width:530px}
    .lichsu th,.lichsu td{border:#cdcdcd 1px solid; text-align:center; font-size:13px;padding:5px}
    .lichsu th{background:#d5d5d5; color:#333; font-size:12px}
    .lichsu_lastrow td{background:#E6E6E6; font-weight:bold}

    .tbl_dangtheo{ margin:5px 30px 5px 5px; border-collapse:collapse}
    .tbl_dangtheo th,.tbl_dangtheo td{text-align:center; font-size:13px; font-weight:bold; border:#A8BEDF 1px solid}
    .tbl_dangtheo th{background:#CADDF9; color:#12499C; font-size:12px}
    .tbl_dangtheo .num{font-size:16px; color:#AA0088}
    .tbl_dangtheo .diemhoa{color:#008000}

    .pos{color:#00A000}
    .neg{color:#EE0000}

    .betnum_ls:link{text-decoration:none; color:#710196 !important; font-size:13px; font-weight:bold}
    .betnum_ls:visited{text-decoration:none; color:#710196 !important; font-size:13px; font-weight:bold}
    .betnum_ls:active{text-decoration:none; color:#FFA722 !important; font-size:13px; font-weight:bold}
    .betnum_ls:hover{text-decoration:none; color:#E67800 !important; font-size:13px; font-weight:bold}
</style>
<script type='text/javascript' src='<?php echo js_link('bet.js') ?>'></script>
<script type='text/javascript'>
    var betlimit=2000;
    //var curruser='<?php //echo isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : '' ?>';
    var editrestrict=true;
    var ngaybet='<?php echo $date_loto ?>';
    var balance=0;
    var balancedate='';
    var diem=0;
    var diemthang=0;
    var tt=0;
    var nextday='<?php echo $nextday_loto ?>';
    loadImg("<?php echo img_link('delete.png') ?>");
    loadImg("<?php echo img_link('loading5.gif') ?>");
    loadImg("<?php echo img_link('loading6.gif') ?>");
</script>
<div style="padding:0 5px 5px">
<div style='margin:5px 0; font-size:16px; color:#013FA5'>Bạn thích cặp số nào hôm nay?</div>
<form id=betform name=betform action='' onsubmit='return betformsubmit()' style='font-size:13px; font-weight:bold; color:#353535; padding:3px; margin-bottom:5px'>
    <input type=hidden size=8 id=ngay name=ngay style='font-size:12px; color:#8B2001' value='<?php echo date('d/m/Y', strtotime($date_loto)) ?>' />
    Cặp số: <input type=text size=10 name=range style='font-size:15px; font-weight:bold; color:#bc1c18' title='Có thể nhập nhiều cặp số, cách nhau bằng dấu phẩy' />
    Số điểm: <input type=text size=2 name=bet style='font-size:15px; font-weight:bold; color:#62018B' />
    <input type=submit name='betsubmit' value='   Ghi   ' style='font-size:15px; font-weight:bold; color:#01468B;background-color: #b8100d;background-image: linear-gradient(to bottom, #b8100d, #960501);border: #980804 1px solid;color: #f1f4f8;font-weight:bold; font-size:12px;font-family:arial,sans-serif;height:23px;padding:0 10px;border-radius: 3px;-moz-border-radius: 3px;-webkit-border-radius: 3px' />
</form>
<div style='font-family:tahoma,arial; font-size:11px; color:#9D9D9D'>Bạn không cần phải nạp tiền vào tài khoản để ghi lotto <a id='loonlinenotetogger' href='#' onclick='' style='font-size:11px'>[Tìm hiểu thêm]</a></div>
<div id='loonlinenote' style='color:#414042; margin:5px 0; padding:5px; background:#eee; border-radius:5px; display:none'>Lotto Online tại Xoso.com là trò chơi miễn phí và <b>không cần nạp tiền</b>, nghĩa là bạn không cần phải có tiền trước trong tài khoản mà có thể ghi ngay tối đa 2000 điểm cho mỗi cặp số. Nếu thắng thì bạn sẽ nhận được điểm trong tài khoản, nếu thua tài khoản của bạn sẽ bị âm. Điểm trong tài khoản của bạn không có giá trị rút thành tiền thật. Bạn cũng không phải trả tiền khi tài khoản bị âm.<br>Người chơi có số điểm trong top 50 sẽ được vinh danh trên bảng vàng tại trang chủ. </div>
<script>
$('#loonlinenotetogger').click(function(){$('#loonlinenote').show(); return false});
closable('#loonlinenote');
</script>
<div id="loadbettb"></div>
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function(){
            if(uid!=''){
                $("#loadbettb").html('<div style="font-size:13px; color:#333; font-weight:bold; text-align:right; margin-bottom:5px">Tài khoản hiện có: <span id="taikhoanloto">0</span> k</div>'
                +'<div id="betarea" style="border:#cdcdcd 1px solid; display:none">'
                    +'<div style="background:#f2f2f2; padding:5px">'
                        +'<a name="betplace"></a>'
                        +'<div style="float:left; font-weight:bold">Ghi lô ngày <b id="ngaydisplay"><?php echo date("d/m/Y", strtotime($date_loto)) ?></b></div>'
                        +'<div style="float:right; font-size:13px; font-weight:bold">'
                            +'Điểm:&nbsp;<span id="tongdiem" style="padding:3px; background:#616A89; color:white">--</span>'
                            +'Chi:&nbsp;<span id="tongchi" style="padding:3px; background:#616A89; color:white">--</span>'
                            +'Nhận:&nbsp;<span id="tongnhan" style="padding:3px; background:#0052CC; color:white">--</span>'
                            +'Lãi-lỗ:&nbsp;<span id="thangthua" style="padding:3px; background:#616A89; color:white">--</span>'
                        +'</div>'
                        +'<div style="clear:both"></div>'
                    +'</div>'
                    +'<div id="betcontainer" style="padding:5px; position:relative"></div>'
                    +'<div style="clear:both"></div>'
                +'</div>');
                betupdate(1);
                $("#taikhoanloto").html(taikhoan);
            }
        },1000);
    });
</script>
</div>
<div style='clear:both'></div>

<?php
$cautious = '';
foreach ($itemsImportant['cautious'] as $k => $v) {
    if ($v['not_count'] <= 15)
        break;
    $cautious .= "<li class=maxganhilight>Cặp lô <b style='color:#8E00CC; font-size:14px'>" . $v['number'] . "</b> đã <b style='color:#003ECC'>" . $v['not_count'] . "</b> ngày chưa ra, cực đại là <b style='color:#FF0000'>" . $arr_gancucdai[$v['number']]->khoangcach . "</b> ngày (từ " . date('d/m/Y', strtotime($arr_gancucdai[$v['number']]->from_date)) . " đến " . date('d/m/Y', strtotime($arr_gancucdai[$v['number']]->to_date)) . ") <a href='javascript:;' onclick='gandlg(\"" . $v['number'] . "\",0,\"" . date('Y-m-d', strtotime($arr_gancucdai[$v['number']]->from_date . ' -1 days')) . "\",\"" . $date_end . "\"); return false' style='font-style:italic'>[Chi tiết]</a></li>";
}
?>
<div class="a_blue">
    <?php if ($cautious != '') { ?>
        <div style='padding:5px'>
            <div style='margin:5px'><b><u>Đáng chú ý:</u></b></div>
            <ul style='margin:0; padding-left:15px'><?php echo $cautious ?></ul>
            <div style='margin:5px 3px; font-size:11px; color:#8B8B8B'>(Kết quả thống kê dựa trên dữ liệu từ năm 2002 đến nay)</div>
        </div>
    <?php } ?>

    <?php if ($arr_caplon) { ?>
        <div colspan=2 style='padding:5px'>
            <div style='margin:5px 0 10px 0; color:#3C3C3C; font-weight:bold'>Các cặp lô tô lộn cùng gan nhiều nhất:</div>
            <?php
            $max = 0;
            $number_top = 0;
            $background = 0;
            $lon_top = 0;
            $lon_background = 0;
            foreach ($arr_caplon as $dem => $value) {
                if ($dem == 0) {
                    $max = $value->not_count;
                    $number_top = -14;
                    $background = 0;
                } else {
                    if($max == $value->not_count){
                        $number_top = -14;
                        $background = 0;
                    }else{
                        $background = round((100/$max)*($max - $value->not_count));
                        $number_top = $background - 14;
                    }
                }
                
                if($max == $value->lon_not_count){
                    $lon_top = -14;
                    $lon_background = 0;
                }else{
                    $lon_background = round((100/$max)*($max - $value->lon_not_count));
                    $lon_top = $lon_background - 14;
                }
                
                if($value->not_count == $value->lon_not_count){
                    $lon_top = $number_top;
                    $lon_background = $background;
                }
                ?>
                <table border=0 cellspacing=2 cellpadding=0>
                    <tr>
                        <td class=s style='background:url(<?php echo $uri_root ?>public/client/images/bg2.gif) repeat-x scroll 0 <?php echo $background ?>px transparent'>
                            <div class=gandiv style='top:<?php echo $number_top ?>px'><?php echo $value->not_count ?> ng</div>
                    <center><?php echo $value->number ?></center>
                    </td>
                    <td class=s style='background:url(<?php echo $uri_root ?>public/client/images/bg1.gif) repeat-x scroll 0 <?php echo $lon_background ?>px transparent'>
                        <div class=gandiv style='top:<?php echo $lon_top ?>px'><?php echo $value->lon_not_count ?> ng</div>
                    <center><?php echo $value->lon ?></center>
                    </td>
                    </tr>
                </table>
                <?php
            }
            ?>
        </div>
    <?php } ?>
</div>
<style type="text/css">
    div.a_blue a:link,div.a_blue a:visited,div.a_blue a:hover,div.a_blue a:active {text-decoration: none;color: #069}
    div.a_blue a:visited {color: #884270}
    div.a_blue a:active,div.a_blue a:hover {color: #ff8022}
    div.a_blue table{
        position:relative; 
        float:left; 
        margin:10px 5px 0 0;
        width: auto;
        border-spacing:2px;
    }
    .ganlistitem{padding:3px 0 0 10px; color:#5901A9; font-size:15px}.slvlistitem{padding:3px 0 0 10px; color:#694501; font-size:15px}
    .s{width:34px; color:#ffffff; vertical-align:bottom; padding-bottom:1px; height:100px}
    .s center{font-size:15px; font-weight:bold}
    .gandiv{position:absolute; width:34px; font-size:12px; font-weight:normal; color:#0044C1; text-align:center}
    .maxganhilight{margin:3px 5px; font-size:13px; color:#4B3F72}
    .maxganhilight b{font-size:13px}
</style>
<div class="clear"></div>

