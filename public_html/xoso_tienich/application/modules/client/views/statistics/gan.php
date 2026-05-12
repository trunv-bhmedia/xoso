<script type="text/javascript" src="<?php echo js_link('jquery.selectbox-0.2.js') ?>"></script>
<link href="<?php echo css_link('jquery.datepick.css') ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo js_link('jquery.datepick.js') ?>"></script>
<?php
$lname = '';
$statistics_alias = '';
?>
<div class="page-title-xs"><strong>Thống kê Loto gan</strong></div>
<div class="select-provice t-cen rate-lo clearfix">
    <div class="marginauto">
        <form id="form_search" method="post" action="">
            <div class="rows left clearfix">
                <div class="rows-provide1">
                    <select name="lid" id="select_mien" tabindex="1">
                        <?php
                        foreach ($xs_location_menu as $value) {
                            $selected = '';
                            if ($lid == $value->id) {
                                $selected = ' selected="selected"';
                                $lname = $value->name;
                                $statistics_alias = $value->alias;
                            }
                            echo '<option' . $selected . ' value="' . $value->alias . '">' . $value->name . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="rows right rows-provide2 clearfix">
                <span class="span-input"><input type="text" name="number" id="number" value="<?php echo $number ?>" class="txt-input" placeholder="dãy số: 12,34,45" style="width:100px" /></span>
            </div>
            <div class="clear"></div>
            <div class="datefrom rows clearfix">
                <span class="span-input"><input type="text" id="f_rangeStart" name="fromdate" value="<?php echo $fromdate ?>" /></span> Đến <span class="span-input"><input type="text" id="f_rangeEnd" name="todate" value="<?php echo $todate ?>" /></span>
            </div>
            <div class="rows">
                <span class="span-lookup"><input type="radio" value="1" name="type"<?php if ($type == 1) echo ' checked="checked"' ?> /> Theo Lô</span>
                <span class="span-lookup"><input type="radio" value="2" name="type"<?php if ($type == 2) echo ' checked="checked"' ?> /> Đầu Đuôi</span>
                <input type="radio" value="3" name="type"<?php if ($type == 3) echo ' checked="checked"' ?> /> Đặc Biệt
            </div>
            <div class="rows clearfix">
                Biên độ gan <span class="span-input space"><input type="text" name="amplitude" class="txt-input" value="<?php echo $amplitude ?>" style="width:20px" /></span>
                <a class="read-more" href="javascript:;" onclick="submitForm('thong-ke-lo-gan');"><span>Xem kết quả</span></a>
            </div>
        </form>
    </div>
</div>
<div class="page-title t-cen"><h1>Thống kê gan cực đại Xổ số <?php echo $lname ?></h1></div>
<?php
if (count($items)) {
    $fromdate = date('d/m/Y', strtotime($fromdate));
    $todate = date('d/m/Y', strtotime($todate));

    $str_type = 'Theo Lô';
    if ($type == 2)
        $str_type = 'Đầu Đuôi';
    elseif ($type == 3)
        $str_type = 'Đặc Biệt';

    foreach ($items as $key => $value) {
        ?>
        <div class="title-tk"><strong>Thống kê Gan cực đại dãy số <?php echo $key ?></strong></div>
        <?php
        if (!$value) {
            echo '<table class="tbl-ds"><tr><td>Không xuất hiện !</td></tr></table>';
        } else {
            $url_from_date = $uri_root . $statistics_alias . '/' . date('d-m-Y', strtotime($value->from_date)) . '.html';
            $url_to_date = $uri_root . $statistics_alias . '/' . date('d-m-Y', strtotime($value->to_date)) . '.html';
            $url_end_date = $uri_root . $statistics_alias . '/' . date('d-m-Y', strtotime($value->end_date)) . '.html';
            $url_final_date = $uri_root . $statistics_alias . '/' . date('d-m-Y', strtotime($value->final_date)) . '.html';
            $value->from_date = date('d/m/Y', strtotime($value->from_date));
            $value->to_date = date('d/m/Y', strtotime($value->to_date));
            $value->end_date = date('d/m/Y', strtotime($value->end_date));
            $value->final_date = date('d/m/Y', strtotime($value->final_date));
            ?>
            <table class="tbl-ds">
                <tr>
                    <td width="105">Gan cực đại </td>
                    <td class="last"><?php echo $value->total ?> lần quay không xuất hiện</td>
                </tr>
                <tr>
                    <td colspan="2" class="last">
                        Từ ngày <a class="red" href="<?php echo $url_from_date ?>" title="Kết quả sổ xố <?php echo $lname ?> ngày <?php echo $value->from_date ?>" target="_blank"><span class="red"><?php echo $value->from_date ?></span></a>&nbsp;
                        Đến ngày <a class="red" href="<?php echo $url_to_date ?>" title="Kết quả sổ xố <?php echo $lname ?> ngày <?php echo $value->to_date ?>" target="_blank"><span class="red"><?php echo $value->to_date ?></span></a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="last">
                        <?php if ($value->end_total > 1) { ?>
                            Số <?php echo $key ?> xuất hiện ngày cuối <a href="<?php echo $url_end_date ?>" title="Kết quả sổ xố <?php echo $lname ?> ngày <?php echo $value->end_date ?>" target="_blank"><span class="red"><?php echo $value->end_date ?></span></a> đến <a href="<?php echo $url_final_date ?>" title="Kết quả sổ xố <?php echo $lname ?> ngày <?php echo $value->final_date ?>" target="_blank"><span class="red"><?php echo $value->final_date ?></span></a> là <?php echo $value->end_total ?> lần quay.
                        <?php } else { ?>
                            Số <?php echo $key ?> xuất hiện ngày cuối <a href="<?php echo $url_end_date ?>" title="Kết quả sổ xố <?php echo $lname ?> ngày <?php echo $value->end_date ?>" target="_blank"><span class="red"><?php echo $value->end_date ?></span></a>
                        <?php } ?>
                    </td>
                </tr>
            </table>
            <?php
        }
    }
}
?>
<br/>
<div class="msg-block">Thống kê lô gan: Giúp bạn có thể tìm được các bộ số với các biên độ gan khác nhau trong 1 khoảng thời gian mà bạn chon lựa. Ngoài ra hệ thống còn tổng hợp dữ liệu biên độ gan max từ 00 đến 99 để bạn có thể tham khảo, logan trên xoso.com được tra cứu theo dãy số, tất cả các giải, theo đầu, đuôi, theo giải đặc biệt.</div>
<br/>
<?php
$statistics_content = str_replace('[TINH]', '<a href="' . $statistics_alias . '.html">' . $lname . '</a>', $statistics_content);
echo '<br/><div class="msg-block">' . $statistics_content . '</div>';
?>
<script type="text/javascript">$(function(){$("#select_mien").selectbox()});$("#f_rangeStart").datepick({dateFormat:'dd-mm-yyyy',maxDate:+0});$("#f_rangeEnd").datepick({dateFormat:'dd-mm-yyyy',maxDate:+0});</script>