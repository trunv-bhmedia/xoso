<script type="text/javascript" src="<?php echo js_link('jquery.selectbox-0.2.js') ?>"></script>
<link href="<?php echo css_link('jquery.datepick.css') ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo js_link('jquery.datepick.js') ?>"></script>
<?php
$lname = '';
$statistics_alias = '';
foreach ($xs_location_menu as $value) {
    if ($lid == $value->alias) {
        $lname = $value->name;
        $statistics_alias = $value->alias;
        break;
    }
}
$title = 'Dò vé số';
if ($sos != '')
    $title = 'Kết quả dò vé số ' . $sos . ' cho xổ số ' . $lname . ', ngày ' . date('d/m/Y', strtotime($fromdate));
?>
<h1 style="position: absolute; text-indent: -99999px"><?php echo $title ?></h1>
<div class="page-title-xs"><strong>Dò vé số</strong></div>
<script type="text/javascript">
    function loadtinh(){var d=$("#f_rangeStart").val();if(d==""){alert('Vui lòng nhập ngày mở thưởng trên tờ vé !');document.form_doveso.ngay.focus();return false}$.ajax({type:"GET",url:"<?php echo $uri_root ?>loadtinh/<?php echo $lid ?>/"+d,success:function(data){$("#boxCity").html(data);$("#select_mien").selectbox()}})}$(document).ready(function(e){loadtinh()});function doveso(){if($("#so").val()==""){alert('Nhập đủ dãy số dự thưởng trên tờ vé của bạn! (6 số hoặc 5 số không bao gồm ký tự)');document.form_doveso.so.focus();return false}else if($("#so").val().length<5){alert('Nhập đủ dãy số dự thưởng trên tờ vé của bạn! (6 số hoặc 5 số không bao gồm ký tự)');document.form_doveso.so.focus();return false}else if($("#f_rangeStart").val()==""){alert('Vui lòng nhập ngày mở thưởng trên tờ vé !');document.form_doveso.ngay.focus();return false}else document.form_doveso.submit()}
</script>
<div class="select-provice rate-lo t-cen clearfix">
    <div class="marginauto">
        <form id="form_doveso" name="form_doveso" method="get" action="">
            <div class="rows left clearfix">
                <div class="clearfix rows datefrom">
                    <span class="span-input">
                        <input type="text" id="f_rangeStart" name="ngay" value="<?php echo $fromdate ?>" />
                    </span>
                </div>
            </div>
            <div class="rows right clearfix">
                <div class="clearfix rows datefrom">
                    <div style="display:inline-block" id="boxCity"></div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="rows seque clearfix">
                Vé số <span class="span-input space"><input class="txt-input" style="width:220px" type="text" id="so" name="so" value="<?php echo $sos ?>" placeholder="(vd: 45435,43223,65443);" /></span>
            </div>
            <div class="t-cen"><a class="read-more" href="javascript:;" onclick="return doveso();"><span>Dò kết quả</span></a></div>
            <div class="clear"></div>
        </form>
    </div>
</div>
<?php
if ($sos != '') {
    $arr_so = explode(',', $sos);
    $date_ve_do = $fromdate;
    $fromdate = date('d/m/Y', strtotime($fromdate));
    ?>
    <div class="page-title t-cen"><strong>Kết quả dò vé số xổ số <?php echo $lname ?>, ngày <?php echo $fromdate ?></strong></div>
    <div class="t-cen box-dvs">
        <p>Bạn đã truy vấn dò kết quả vé số <strong>Xổ Số <?php echo $lname ?></strong></p>
    </div>
    <?php
    foreach ($arr_so as $so) {
        $so = trim($so);
        ?>
        <div class="line-red">&nbsp;</div>
        <div class="t-cen box-dvs">
            <p>Loại vé <strong><?php echo strlen($so) ?> chữ số</strong>, mở thưởng ngày <strong><?php echo $fromdate ?></strong></p>
            <p>Dãy số của bạn là: <strong class="red"><?php echo $so ?></strong></p>									
        </div>
        <?php
        if ($items) {
            $class = '';
            $giaithuong = array(
                200000000
                , 20000000
                , 5000000
                , 2000000
                , 400000
                , 200000
                , 100000
                , 40000
                , 40000
            );
            $url = '';
            switch ($items->area) {
                case 'MB':
                    $l_area = 'Truyền thống';
                    $class = ' kqmienbac';
                    $url = $url_mienbac;
                    break;
                case 'MT':
                    $l_area = 'Miền Trung';
                    $class = ' kqmiennam';
                    $url = $url_mientrung;
                    if (strlen($items->a0) == 5)
                        $giaithuong = array(
                            250000000
                            , 40000000
                            , 10000000
                            , 5000000
                            , 2500000
                            , 1000000
                            , 500000
                            , 250000
                            , 100000
                            , 0
                            , 500000
                        );
                    else
                        $giaithuong = array(
                            1500000000
                            , 40000000
                            , 10000000
                            , 5000000
                            , 2500000
                            , 1000000
                            , 500000
                            , 250000
                            , 100000
                            , 100000000
                            , 7000000
                        );
                    break;
                case 'MN':
                    $l_area = 'Miền Nam';
                    $class = ' kqmiennam';
                    $url = $url_miennam;
                    $giaithuong = array(
                        1500000000
                        , 30000000
                        , 20000000
                        , 10000000
                        , 3000000
                        , 1000000
                        , 400000
                        , 200000
                        , 100000
                        , 100000000
                        , 6000000
                    );
                    break;
            }

            if ($result[$so] === '' || $result[$so] === NULL) {
                ?>
                <div class="t-cen box-dvs">
                    <div class="imgs"><img src="<?php echo img_link('sime.png'); ?>" width="121" height="95" alt="" /></div>
                    <div class="gray-text">
                        <p><strong>Rất tiếc vé của bạn không trúng giải!</strong></p>
                        <p>Chúc bạn may mắn lần sau! :)</p>
                    </div>
                </div>
            <?php } elseif ($result[$so] == 999) { ?>
                <div class="t-cen box-dvs">
                    <p>Xổ Số <?php echo $lname ?> ngày <strong><?php echo $fromdate ?></strong> không phát hành loại vé <strong><?php echo strlen($so) ?></strong> chữ số, vui lòng nhập đúng thông tin truy vấn!</p>
                </div>
                <?php
            } else {
                $giai = array();
                $trigia = 0;
                $arr_result = explode(',', $result[$so]);
                foreach ($arr_result as $rs) {
                    if ($rs === '')
                        continue;

                    $trigia = $trigia + $giaithuong[$rs];
                    switch ($rs) {
                        case 0:
                            $giai[] = 'giải Đặc Biệt';
                            break;
                        case 1:
                            $giai[] = 'giải Nhất';
                            break;
                        case 2:
                            $giai[] = 'giải Nhì';
                            break;
                        case 3:
                            $giai[] = 'giải Ba';
                            break;
                        case 4:
                            $giai[] = 'giải Tư';
                            break;
                        case 5:
                            $giai[] = 'giải Năm';
                            break;
                        case 6:
                            $giai[] = 'giải Sáu';
                            break;
                        case 7:
                            $giai[] = 'giải Bảy';
                            break;
                        case 8:
                            $giai[] = 'giải Tám';
                            if ($items->area == 'MB')
                                $giai[] = 'giải Khuyến Khích';
                            break;
                        case 9:
                            $giai[] = 'giải Đặt Biệt Phụ';
                            break;
                        case 10:
                            $giai[] = 'giải Khuyến Khích';
                            break;
                    }
                }
                ?>
                <div class="t-cen box-dvs">
                    <div class="imgs"><img src="<?php echo img_link('sime1.png'); ?>" width="120" height="115" alt="" /></div>
                    <div class="gray-text">
                        <p>
                            <strong>Chúc mừng bạn!</strong> <br  />
                            Vé số của bạn đã trúng <?php echo implode(' & ', $giai); ?>!<br />
                            Tổng giá trị giải thưởng là <strong><?php echo number_format($trigia, 0, '.', ',') ?> đ</strong>
                        </p>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="t-cen box-dvs">
                <p>Kết quả xổ số <?php echo $lname ?> mở thưởng ngày <?php echo $fromdate ?> hiện chưa có trên hệ thống.</p>
            </div>
        <?php } ?>
    <?php } ?>
    <div class="line-red">&nbsp;</div>
    <?php
    if ($items) {
        $title_share = 'Xổ Số ' . $lname . ' - ' . $items->dateOfWeek . ' ngày ' . $items->date;

        $date_ve_do = str_replace('/', '-', $items->date);
        $alias_date = $statistics_alias . '/' . $date_ve_do;
        $curPageURL = urlencode($uri_root . $alias_date . '.html');
        $url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . urlencode($title_share);
        $url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
        $url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
        $url_email = 'mailto:?subject=' . formatMail($title_share) . '&amp;body=' . $curPageURL;
        ?>
        <div class="tit-xs clearfix">
            <strong class="title-xs">KẾT QUẢ XỔ SỐ <?php echo mb_strtoupper($l_area, 'UTF-8') ?></strong>
            <div class="menuRight">
                <a href="<?php echo $uri_root . $url ?>.html"><img src="<?php echo img_link('date.png'); ?>" width="15" height="16" alt="" /></a>
            </div>
        </div>
        <div class="box-result">
            <table class="tbl-xs<?php echo $class ?>">
                <tr>
                    <td class="t-left border-right" colspan="2">
                        <a href="<?php echo $uri_root . $alias_date ?>.html"><strong>Xổ Số <?php echo $lname ?> - <?php echo $items->dateOfWeek ?> ngày <?php echo $items->date ?></strong></a>
                    </td>
                    <td class="t-right">Giải thưởng(đ)</td>
                </tr>
                <tr>
                    <td class="bg-gray border-right" width="1%" nowrap>Giải đặc biệt</td>
                    <td class="bg-gray border-right giaidb">
                        <?php
                        echo '<strong class="red font18 span-space">' . ($items->a0 == '' ? "*****" : $items->a0) . '</strong>';
                        ?>
                    </td>
                    <td class="bg-gray t-right"><strong><?php echo number_format($giaithuong[0], 0, '.', ',') ?></strong></td>
                </tr>
                <tr>
                    <td class="border-right">Giải nhất</td>
                    <td class="border-right giai1">
                        <?php
                        echo '<strong class="span-space">' . ($items->a1 == '' ? "*****" : $items->a1) . '</strong>';
                        ?>
                    </td>
                    <td class="t-right"><?php echo number_format($giaithuong[1], 0, '.', ',') ?></td>
                </tr>
                <tr>
                    <td class="bg-gray border-right">Giải nhì</td>
                    <td class="bg-gray border-right giai2">
                        <?php
                        echo str_replace('-', ' - ', $items->a2);
                        ?>
                    </td>
                    <td class="t-right bg-gray"><?php echo number_format($giaithuong[2], 0, '.', ',') ?></td>
                </tr>
                <tr>
                    <td class="border-right">Giải ba</td>
                    <td class="border-right giai3">
                        <?php
                        echo str_replace('-', ' - ', $items->a3);
                        ?>
                    </td>
                    <td class="t-right"><?php echo number_format($giaithuong[3], 0, '.', ',') ?></td>
                </tr>
                <tr>
                    <td class="bg-gray border-right">Giải tư</td>
                    <td class="bg-gray border-right giai4">
                        <?php
                        echo str_replace('-', ' - ', $items->a4);
                        ?>
                    </td>
                    <td class="t-right bg-gray "><?php echo number_format($giaithuong[4], 0, '.', ',') ?></td>
                </tr>
                <tr>
                    <td class="border-right">Giải năm</td>
                    <td class="border-right giai5">
                        <?php
                        echo str_replace('-', ' - ', $items->a5);
                        ?>
                    </td>
                    <td class="t-right"><?php echo number_format($giaithuong[5], 0, '.', ',') ?></td>
                </tr>
                <tr>
                    <td class="bg-gray border-right">Giải sáu</td>
                    <td class="bg-gray border-right giai6">
                        <?php
                        echo str_replace('-', ' - ', $items->a6);
                        ?>
                    </td>
                    <td class="t-right bg-gray"><?php echo number_format($giaithuong[6], 0, '.', ',') ?></td>
                </tr>
                <tr>
                    <td class="border-right">Giải bảy</td>
                    <td class="border-right giai7">
                        <?php
                        echo str_replace('-', ' - ', $items->a7);
                        ?>
                    </td>
                    <td class="t-right"><?php echo number_format($giaithuong[7], 0, '.', ',') ?></td>
                </tr>
                <?php
                if ($items->area != 'MB') {
                    if (strlen($items->a0) == 5) {
                        ?>
                        <tr>
                            <td class="bg-gray border-right">Giải tám</td>
                            <td class="bg-gray border-right giai8">
                                <?php echo $items->a8 ?>
                            </td>
                            <td class="bg-gray t-right"><?php echo number_format($giaithuong[8], 0, '.', ',') ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border-right">Giải khuyến khích (vé có 2 số cuối trùng với 2 số cuối của giải Đặc Biệt - <strong class="red"><?php echo substr($items->a0, 3, 2) ?></strong>)</td>
                            <td class="t-right"><?php echo number_format($giaithuong[10], 0, '.', ',') ?></td>
                        </tr>
                        <?php
                    } else {
                        ?>
                        <tr>
                            <td class="bg-gray border-right">Giải tám</td>
                            <td class="bg-gray border-right giai8">
                                <?php echo $items->a8 ?>
                            </td>
                            <td class="bg-gray t-right"><?php echo number_format($giaithuong[8], 0, '.', ',') ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border-right">Giải Đặt Biệt Phụ (sai chữ số đầu, trúng 5 chữ số cuối so với giải Đặc Biệt)</td>
                            <td class="t-right"><?php echo number_format($giaithuong[9], 0, '.', ',') ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="bg-gray border-right">Giải Khuyến Khích (trúng chữ số đầu tiên và sai 1 trong 5 chữ số còn lại)</td>
                            <td class="bg-gray t-right"><?php echo number_format($giaithuong[10], 0, '.', ',') ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="2" class="bg-gray border-right">Giải khuyến khích (vé có 2 số cuối trùng với 2 số cuối của giải Đặc Biệt - <strong class="red"><?php echo substr($items->a0, 3, 2) ?></strong>)</td>
                        <td class="bg-gray t-right"><?php echo number_format($giaithuong[8], 0, '.', ',') ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="line-red">&nbsp;</div>
        <div class="view-result clearfix">
            <div class="right share-right">
                <div class="share-like left">
                    <a rel="nofollow" href="<?php echo $url_google ?>" title="Google" target="_blank" class="share-g">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email">&nbsp;</a>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<br/>
<div class="msg-block">Bạn mua vé số, bạn không biết cách so sánh vé số, bạn chưa hiểu được giá trị các giải mà bạn có thể trúng số. Bạn chỉ cần nhập dãy số trên vé số của bạn vào ô “Vé số” và chọn ngày mở thưởng của tỉnh thành mà bạn tham gia, hệ thống sẽ tự động cập nhật, thống kê và đưa ra cho bạn biết được, bạn đã có trúng vé số hay không? trúng giải nào và tổng số tiền mà bạn đạt được (Nếu trúng).</div>
<br/>
<script type="text/javascript">$(function(){$("#select_mien").selectbox()});$("#f_rangeStart").datepick({dateFormat:'dd-mm-yyyy',maxDate:+0,onSelect:function(){loadtinh()}});</script>