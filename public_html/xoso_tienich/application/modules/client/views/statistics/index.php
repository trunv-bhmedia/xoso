<script type="text/javascript" src="<?php echo js_link('jquery.selectbox-0.2.js') ?>"></script>
<?php
$lname = '';
$statistics_alias = '';
?>
<div class="page-title-xs"><strong>Thống kê quan trọng</strong></div>
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
                                $selected = ' selected=""';
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
            <div class="t-cen"><a class="read-more" href="javascript:;" onclick="doSubmit('thong-ke-quan-trong');"><span>Xem kết quả</span></a></div>
        </form>
    </div>
</div>
<div class="page-title t-cen"><h1>Thống kê quan trọng Xổ số <?php echo $lname ?></h1></div>
<div class="title-tk"><strong>Thống kê các bộ số được đánh giá cao nhất</strong></div>
<table class="tbl-ds">
    <tr>
        <td class="t-cen bg-gray">Cặp số</td>
        <td class="t-cen bg-gray">Ngày về gần nhất</td>
        <td class="t-cen bg-gray">Số lần xuất hiện </td>
        <td class="last t-cen bg-gray">Số lần chưa về</td>
    </tr>
    <?php foreach ($items['high'] as $k => $v) { ?>
        <tr>
            <td class="t-cen"><strong><?php echo $v['number']; ?></strong></td>
            <td class="t-cen"><?php echo date('d/m/Y', strtotime($v['date'])); ?></td>
            <td class="t-cen"><?php echo $v['count']; ?></td>
            <td class="last t-cen"><?php echo $v['not_count']; ?></td>
        </tr>
    <?php } ?>
</table>
<div class="title-tk"><strong>Thống kê các bộ số ưu tiên khác thấp hơn</strong></div>
<table class="tbl-ds">
    <tr>
        <td class="t-cen bg-gray">Căp số</td>
        <td class="t-cen bg-gray">Ngày về gần nhất</td>
        <td class="t-cen bg-gray">Số lần xuất hiện </td>
        <td class="last t-cen bg-gray">Số lần chưa về</td>
    </tr>
    <?php foreach ($items['priority'] as $k => $v) { ?>
        <tr>
            <td class="t-cen"><strong><?php echo $v['number']; ?></strong></td>
            <td class="t-cen"><?php echo date('d/m/Y', strtotime($v['date'])); ?></td>
            <td class="t-cen"><?php echo $v['count']; ?></td>
            <td class="last t-cen"><?php echo $v['not_count']; ?></td>
        </tr>
    <?php } ?>
</table>
<div class="title-tk"><strong>Thống kê các bộ số có thể ra lô rơi</strong></div>
<table class="tbl-ds">
    <tr>
        <td class="t-cen bg-gray">Cặp số</td>
        <td class="t-cen bg-gray">Ngày về gần nhất</td>
        <td class="t-cen bg-gray">Số lần xuất hiện </td>
        <td class="last t-cen bg-gray">Số lần chưa về</td>
    </tr>
    <?php foreach ($items['plots_fall'] as $k => $v) { ?>
        <tr>
            <td class="t-cen"><strong><?php echo $v['number']; ?></strong></td>
            <td class="t-cen"><?php echo date('d/m/Y', strtotime($v['date'])); ?></td>
            <td class="t-cen"><?php echo $v['count']; ?></td>
            <td class="last t-cen"><?php echo $v['not_count']; ?></td>
        </tr>
    <?php } ?>
</table>
<div class="title-tk"><strong>Thống kê các bộ số nên thận trọng hôm nay</strong></div>
<table class="tbl-ds">
    <tr>
        <td class="t-cen bg-gray">Cặp số</td>
        <td class="t-cen bg-gray">Ngày về gần nhất</td>
        <td class="t-cen bg-gray">Số lần xuất hiện </td>
        <td class="last t-cen bg-gray">Số lần chưa về</td>
    </tr>
    <?php foreach ($items['cautious'] as $k => $v) { ?>
        <tr>
            <td class="t-cen"><strong><?php echo $v['number']; ?></strong></td>
            <td class="t-cen"><?php echo date('d/m/Y', strtotime($v['date'])); ?></td>
            <td class="t-cen"><?php echo $v['count']; ?></td>
            <td class="last t-cen"><?php echo $v['not_count']; ?></td>
        </tr>
    <?php } ?>
</table>
<?php
$statistics_content = str_replace('[TINH]', '<a href="' . $statistics_alias . '.html">' . $lname . '</a>', $statistics_content);
echo '<br/><div class="msg-block">' . $statistics_content . '</div>';
?>
<br/>
<script type="text/javascript">$(function(){$("#select_num").selectbox();$("#select_mien").selectbox()});</script>