<script type="text/javascript" src="<?php echo js_link('jquery.selectbox-0.2.js') ?>"></script>
<?php
$lname = '';
$statistics_alias = '';
$msg = 'Thống kê tổng hai số cuối tổng từ 00 đến 99, giúp người chơi có những con số cụ thể về một cặp loto hoặc số đề (2 số cuối giải đặc biệt) của tỉnh thành mở thưởng trong khoảng thời gian mà bạn muốn xem, cặp số xuất hiện nhiều nhất, bạn có thể chọn số lần quay, chọn 2 số cuối các giải hoặc chỉ riêng giải đặc biệt. Chúc bạn may mắn.';
?>
<div class="page-title-xs"><strong>Thống kê cặp số từ 00-99</strong></div>
<div class="select-provice t-cen rate-lo clearfix">
    <div class="marginauto">
        <form id="form_search" method="post" action="">
            <div class="rows left clearfix" style="margin-top:2px">
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
            <div class="rows right seque rows-provide2 clearfix">
                Số lần <select id="select_num" name="time_turn" tabindex="1">
                    <option value="10"<?php echo $time_turn == 10 ? ' selected="selected"' : '' ?>>10</option>
                    <option value="20"<?php echo $time_turn == 20 ? ' selected="selected"' : '' ?>>20</option>
                    <option value="30"<?php echo $time_turn == 30 ? ' selected="selected"' : '' ?>>30</option>                    
                    <option value="50"<?php echo $time_turn == 50 ? ' selected="selected"' : '' ?>>50</option>
                    <option value="100"<?php echo $time_turn == 100 ? ' selected="selected"' : '' ?>>100</option>
                    <option value="365"<?php echo $time_turn == 365 ? ' selected="selected"' : '' ?>>365</option>
                </select>
            </div>
            <div class="clear"></div>
            <div class="rows">
                <span class="span-lookup"><input type="radio" value="0" name="type"<?php if ($type == 0) echo ' checked="checked"' ?> /> tất cả các giải</span>
                <input type="radio" value="1" name="type"<?php if ($type == 1) echo ' checked="checked"' ?> /> giải đặc biệt
            </div>
            <div class="t-cen"><a class="read-more" href="javascript:;" onclick="doSubmit('thong-ke-cap-so-tu-00-99');"><span>Xem kết quả</span></a></div>
        </form>
    </div>
</div>
<div class="page-title t-cen"><h1>Thống kê cặp số từ 00-99 Xổ số <?php echo $lname ?></h1></div>
<?php if ($items) { ?>
    <div class="title-tk"><strong><?php echo 'Các số xuất hiện trong ' . $time_turn . ' lần quay'; ?></strong></div>
    <table class="tbl-ds">
        <tr>
            <td class="t-cen bg-gray" width="1%" nowrap>Cặp số</td>
            <td class="last bg-gray">Lần xuất hiện</td>
        </tr>
        <?php
        foreach ($items['value'] as $k => $v):
            $phantram = '0.00';
            $phantram_w = 0;
            if ($v['count'] > 0) {
                $phantram = round(($v['count'] / $items['total']) * 100, 2);
                $phantram = number_format($phantram, 2, '.', '');

                $phantram_w = round(($v['count'] / $items['phantram_count']) * 100, 2);
                $phantram_w = number_format($phantram_w, 2, '.', '');
            }
//                echo (date('d/m/Y', strtotime($v['date'])));
            ?>
            <tr>
                <td class="t-cen"><strong><?php echo $v['number']; ?></strong></td>
                <td class="last">
                    <div class="run"><div class="runing" style="width: <?php echo $phantram_w . '%'; ?>"></div>&nbsp;</div><?php echo $phantram . '% (' . $v['count'] . ')'; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php } ?>
<br/>
<div class="msg-block"><?php echo $msg ?></div>
<br/>
<?php
$statistics_content = str_replace('[TINH]', '<a href="' . $statistics_alias . '.html">' . $lname . '</a>', $statistics_content);
echo '<br/><div class="msg-block">' . $statistics_content . '</div>';
?>
<script type="text/javascript">$(function(){$("#select_num").selectbox();$("#select_mien").selectbox()});</script>