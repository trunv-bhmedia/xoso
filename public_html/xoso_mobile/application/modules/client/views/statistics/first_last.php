<script type="text/javascript" src="<?php echo js_link('jquery.selectbox-0.2.js') ?>"></script>
<?php
$lname = '';
$statistics_alias = '';
?>
<div class="page-title-xs"><strong>Thống kê số lần xuất hiện</strong></div>
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
            <div class="t-cen"><a class="read-more" href="javascript:;" onclick="doSubmit('thongke-dau-duoi-0-9');"><span>Xem kết quả</span></a></div>
        </form>
    </div>
</div>
<div class="page-title t-cen"><h1>Thống kê đầu đuôi 0-9 Xổ số <?php echo $lname ?></h1></div>
<?php if ($items): ?>
    <div class="title-tk"><strong>Đầu số xuất hiện trong <?php echo $time_turn ?> lần quay</strong></div>
    <table class="tbl-ds">
        <tr>
            <td class="t-cen bg-gray" width="1%" nowrap>Đặc biệt</td>
            <td class="last bg-gray">Lần xuất hiện</td>
        </tr>
        <?php
        foreach ($items['dau'] as $k => $v):
            $phantram_dacbiet = '0.00';
            $phantram_db_w = 0;
            if ($items['dau_dacbiet'][$k] > 0) {
                $phantram_dacbiet = round(($items['dau_dacbiet'][$k] / $items['total_dacbiet_dau']) * 100, 2);
                $phantram_dacbiet = number_format($phantram_dacbiet, 2, '.', '');

                $phantram_db_w = round(($items['dau_dacbiet'][$k] / $items['phantram_dacbiet_dau']) * 100, 2);
                $phantram_db_w = number_format($phantram_db_w, 2, '.', '');
            }
            ?>
            <tr>
                <td class="t-cen"><strong><?php echo $k ?></strong></td>
                <td class="last"><div class="run"><div class="runing" style="width: <?php echo $phantram_db_w . '%'; ?>"></div>&nbsp;</div><?php echo $phantram_dacbiet . '% (' . $items['dau_dacbiet'][$k] . ')'; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td class="t-cen bg-gray">Loto</td>
            <td class="last bg-gray">Lần xuất hiện</td>
        </tr>
        <?php
        foreach ($items['dau'] as $k => $v):
            $phantram = '0.00';
            $phantram_w = 0;
            if ($v > 0) {
                $phantram = round(($v / $items['total_loto_dau']) * 100, 2);
                $phantram = number_format($phantram, 2, '.', '');

                $phantram_w = round(($v / $items['phantram_loto_dau']) * 100, 2);
                $phantram_w = number_format($phantram_w, 2, '.', '');
            }
            ?>
            <tr>
                <td class="t-cen"><strong><?php echo $k ?></strong></td>
                <td class="last"><div class="run"><div class="runing" style="width: <?php echo $phantram_w . '%'; ?>"></div>&nbsp;</div><?php echo $phantram . '% (' . $v . ')'; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="title-tk"><strong>Đuôi số xuất hiện trong <?php echo $time_turn ?> lần quay</strong></div>
    <table class="tbl-ds">
        <tr>
            <td class="t-cen bg-gray" width="1%" nowrap>Đặc biệt</td>
            <td class="last bg-gray">Lần xuất hiện</td>
        </tr>
        <?php
        foreach ($items['duoi'] as $k => $v):
            $phantram_dacbiet = '0.00';
            $phantram_db_w = 0;
            if ($items['duoi_dacbiet'][$k] > 0) {
                $phantram_dacbiet = round(($items['duoi_dacbiet'][$k] / $items['total_dacbiet_duoi']) * 100, 2);
                $phantram_dacbiet = number_format($phantram_dacbiet, 2, '.', '');

                $phantram_db_w = round(($items['duoi_dacbiet'][$k] / $items['phantram_dacbiet_duoi']) * 100, 2);
                $phantram_db_w = number_format($phantram_db_w, 2, '.', '');
            }
            ?>
            <tr>
                <td class="t-cen"><strong><?php echo $k ?></strong></td>
                <td class="last"><div class="run"><div class="runing" style="width: <?php echo $phantram_db_w . '%'; ?>"></div>&nbsp;</div><?php echo $phantram_dacbiet . '% (' . $items['duoi_dacbiet'][$k] . ')'; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td class="t-cen bg-gray">Loto</td>
            <td class="last bg-gray">Lần xuất hiện</td>
        </tr>
        <?php
        foreach ($items['duoi'] as $k => $v):
            $phantram = '0.00';
            $phantram_w = 0;
            if ($v > 0) {
                $phantram = round(($v / $items['total_loto_duoi']) * 100, 2);
                $phantram = number_format($phantram, 2, '.', '');

                $phantram_w = round(($v / $items['phantram_loto_duoi']) * 100, 2);
                $phantram_w = number_format($phantram_w, 2, '.', '');
            }
            ?>
            <tr>
                <td class="t-cen"><strong><?php echo $k ?></strong></td>
                <td class="last"><div class="run"><div class="runing" style="width: <?php echo $phantram_w . '%'; ?>"></div>&nbsp;</div><?php echo $phantram . '% (' . $v . ')'; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<?php
$statistics_content = str_replace('[TINH]', '<a href="' . $statistics_alias . '.html">' . $lname . '</a>', $statistics_content);
echo '<br/><div class="msg-block">' . $statistics_content . '</div>';
?>
<br/>
<script type="text/javascript">$(function(){$("#select_mien").selectbox();$("#select_num").selectbox()});</script>