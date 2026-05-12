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
<div class="select-provice t-cen rate-lo clearfix">
    <form id="form_search" method="post" action="">
        <div class="rows clearfix">
            <div class="rows-provide1">
                <label class="floatnone label-title">Tỉnh / Thành phố</label>
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
        <div class="rows">
            <label class="label-title">Tra cứu</label>
            <span class="span-lookup"><input type="radio" value="0" name="type"<?php if ($type == 0) echo ' checked="checked"' ?> /> Loto theo đầu </span>
            <input type="radio" value="1" name="type"<?php if ($type == 1) echo ' checked="checked"' ?> /> Loto theo đuôi
        </div>
        <div class="datefrom rows clearfix">
            <label class="label-title">Từ</label>
            <span class="span-input"><input type="text" id="f_rangeStart" name="fromdate" value="<?php echo $fromdate ?>" /></span>
            <label class="to">Đến</label>
            <span class="span-input"><input type="text" id="f_rangeEnd" name="todate" value="<?php echo $todate ?>" /></span>
        </div>
        <div class="rows seque clearfix">
            <label class="label-title">&nbsp;</label>
            <a class="read-more" href="javascript:;" onclick="submitForm('thong-ke-lo-to-theo-dau-duoi');"><span>Xem thống kê</span></a>
        </div>
    </form>
</div>
<div class="page-title t-cen">
    <strong><h1>Thống kê lô tô theo đầu đuôi Xổ số <?php echo $lname ?></h1></strong>
</div>
<?php
if ($items):
    $fromdate = date('d/m/Y', strtotime($fromdate));
    $todate = date('d/m/Y', strtotime($todate));
    ?>
    <div class="title-tk"><strong>Thống kê loto theo <span class="red"><?php echo $title ?></span> từ ngày <?php echo $fromdate ?> đến ngày <?php echo $todate ?></strong></div>
    <table class="tbl-ds">
        <tr>
            <td width="105" class="t-cen">Ngày </td>
            <td class="t-cen"><span class="t-gray"><?php echo $label ?></span><br /> 0</td>
            <td class="t-cen"><span class="t-gray"><?php echo $label ?></span><br /> 1</td>
            <td class="t-cen"><span class="t-gray"><?php echo $label ?></span><br /> 2</td>
            <td class="t-cen"><span class="t-gray"><?php echo $label ?></span><br /> 3</td>
            <td class="t-cen"><span class="t-gray"><?php echo $label ?></span><br /> 4</td>
            <td class="t-cen"><span class="t-gray"><?php echo $label ?></span><br /> 5</td>
            <td class="t-cen"><span class="t-gray"><?php echo $label ?></span><br /> 6</td>
            <td class="t-cen"><span class="t-gray"><?php echo $label ?></span><br /> 7</td>
            <td class="t-cen"><span class="t-gray"><?php echo $label ?></span><br /> 8</td>
            <td class="t-cen last"><span class="t-gray"><?php echo $label ?></span><br />9</td>
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
            <td width="105" class="t-cen bg-yelow red">Tổng số lần về</td>
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