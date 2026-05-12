<script type="text/javascript" src="<?php echo js_link('jquery.selectbox-0.2.js') ?>"></script>
<link href="<?php echo css_link('jquery.datepick.css') ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo js_link('jquery.datepick.js') ?>"></script>
<?php
$lname = '';
$statistics_alias = '';
$label = '';
if ($type == 0) {
    $title = 'đầu';
    $label = 'Đầu';
} else {
    $title = 'đuôi';
    $label = 'Đuôi';
}
?>
<div class="page-title-xs"><strong>Thống kê đầu đuôi</strong></div>
<div class="select-provice t-cen rate-lo clearfix">
    <form id="form_search" method="post" action="">
        <div class="rows clearfix">
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
        <div class="rows">
            <span class="span-lookup"><input type="radio" value="0" name="type"<?php if ($type == 0) echo ' checked="checked"' ?> /> Loto theo đầu </span>
            <input type="radio" value="1" name="type"<?php if ($type == 1) echo ' checked="checked"' ?> /> Loto theo đuôi
        </div>
        <div class="datefrom rows clearfix">
            <span class="span-input"><input type="text" id="f_rangeStart" name="fromdate" value="<?php echo $fromdate ?>" /></span> Đến <span class="span-input"><input type="text" id="f_rangeEnd" name="todate" value="<?php echo $todate ?>" /></span>
        </div>
        <div class="rows seque clearfix">
            <a class="read-more" href="javascript:;" onclick="submitForm('thong-ke-lo-to-theo-dau-duoi');"><span>Xem kết quả</span></a>
        </div>
    </form>
</div>
<div class="page-title t-cen"><h1>Thống kê lô tô theo đầu đuôi Xổ số <?php echo $lname ?></h1></div>
<?php
if ($items):
    $fromdate = date('d/m/Y', strtotime($fromdate));
    $todate = date('d/m/Y', strtotime($todate));
    ?>
    <div class="title-tk"><strong>Thống kê loto theo <span class="red"><?php echo $title ?></span></strong></div>
    <table class="tbl-ds lotofl">
        <tr>
            <td class="t-cen bg-gray">Ngày</td>
            <td class="t-cen bg-gray"><strong>0</strong></td>
            <td class="t-cen bg-gray"><strong>1</strong></td>
            <td class="t-cen bg-gray"><strong>2</strong></td>
            <td class="t-cen bg-gray"><strong>3</strong></td>
            <td class="t-cen bg-gray"><strong>4</strong></td>
            <td class="t-cen bg-gray"><strong>5</strong></td>
            <td class="t-cen bg-gray"><strong>6</strong></td>
            <td class="t-cen bg-gray"><strong>7</strong></td>
            <td class="t-cen bg-gray"><strong>8</strong></td>
            <td class="t-cen last bg-gray"><strong>9</strong></td>
        </tr>
        <?php foreach ($items['value'] as $key => $value) { ?>
            <tr>
                <td width="105" class="t-cen">
                    <?php echo date('d/m/Y', strtotime($key)) ?>
                </td>
                <?php
                foreach ($value as $k => $v) {
                    if ($k == 9)
                        echo '<td class="t-cen last">' . $v . '</td>';
                    else
                        echo '<td class="t-cen">' . $v . '</td>';
                }
                ?>
            </tr>
        <?php } ?>
        <tr>
            <td class="t-cen bg-yelow red">Tổng số</td>
            <?php
            foreach ($items['total'] as $k => $value) {
                if ($k == 9)
                    echo '<td class="last bg-yelow red t-cen"><strong>' . $value . '</strong></td>';
                else
                    echo '<td class="bg-yelow red t-cen"><strong>' . $value . '</strong></td>';
            }
            ?>
        </tr>
    </table>
<?php endif; ?>
<?php
$statistics_content = str_replace('[TINH]', '<a href="' . $statistics_alias . '.html">' . $lname . '</a>', $statistics_content);
echo '<br/><div class="msg-block">' . $statistics_content . '</div>';
?>
<script type="text/javascript">$(function(){$("#select_mien").selectbox()});$("#f_rangeStart").datepick({dateFormat:'dd-mm-yyyy',maxDate:+0});$("#f_rangeEnd").datepick({dateFormat:'dd-mm-yyyy',maxDate:+0});</script>