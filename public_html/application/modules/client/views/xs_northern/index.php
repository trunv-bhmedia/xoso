<h1 style="position: absolute; text-indent: -99999px">XỔ SỐ ĐIỆN TOÁN</h1>
<div class="box-tt clearfix">
    <strong class="strong-tt">
        Trực tiếp kết quả Xổ Số Miền Bắc<br />
        Nhận kết quả nhanh siêu tốc
    </strong>
    <div class="box-editor">Soạn <strong class="red">TT MB</strong> gửi <strong class="red">8517</strong></div>
</div>

<div class="title title-red">
    <div class="title-right clearfix">
        <strong class="left xsmb">XỔ SỐ ĐIỆN TOÁN</strong>
        <div class="box-date-provide right">
            <input type="text" id="xsdt_date" value="<?php echo $date ?>" />
            <script type="text/javascript">$("#xsdt_date").datepick({dateFormat: 'dd-mm-yyyy',maxDate: +0,onSelect: function() {var day=$("#xsdt_date").val();document.location='<?php echo $uri_root . $alias ?>/'+day+'.html';}});</script>
        </div>
    </div>
</div>
<div class="box-result">
    <?php
    $days = array(
        '0' => 'Chủ nhật',
        '1' => 'Thứ 2',
        '2' => 'Thứ 3',
        '3' => 'Thứ 4',
        '4' => 'Thứ 5',
        '5' => 'Thứ 6',
        '6' => 'Thứ 7'
    );
    foreach ($rows as $k => $xsdt):
        $DT_time = strtotime($k);
        ?>
        <div class="bg-yelow1"><strong class="txt-red"><h2><?php echo $days[date('w', $DT_time)] ?> ngày <?php echo(date('d/m/Y', $DT_time)); ?></h2></strong></div>
        <table class="tbl-result">
            <?php if (isset($xsdt['DT6x36'])) { ?>
                <tr>
                    <td class="bg-gray first">
                        <strong class="left">Kết quả xổ số điện toán 6x36</strong>
                        <span class="right">Mở thưởng <?php echo $days[date('w', $DT_time)] ?> ngày <?php echo(date('d/m/Y', $DT_time)); ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="td-sub">
                        <table>
                            <tr>
                                <?php foreach (json_decode($xsdt['DT6x36']->data) as $value) { ?>
                                    <td class="red font24 t-cen"><strong><?php echo $value ?></strong></td>
                                <?php } ?>
                                <td class="t-right"><a target="_blank" href="<?php echo $uri_root ?>xo-so-dien-toan/6X36/<?php echo (date('d-m-Y', $DT_time)); ?>.html" class="read-more read-more1"><span>Xem thêm</span></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php } ?>
            <?php if (isset($xsdt['DT123'])) { ?>
                <tr>
                    <td class="bg-gray first">
                        <strong class="left">Kết quả xổ số điện toán 1*2*3</strong>
                        <span class="right">Mở thưởng <?php echo $days[date('w', $DT_time)] ?> ngày <?php echo(date('d/m/Y', $DT_time)); ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="td-sub">
                        <table class="tbl-sub">
                            <tr>
                                <?php foreach (json_decode($xsdt['DT123']->data) as $value) { ?>
                                    <td class="red font24 t-cen"><strong><?php echo $value ?></strong></td>
                                <?php } ?>
                                <td class="t-right"><a target="_blank" href="<?php echo $uri_root ?>xo-so-dien-toan/1*2*3/<?php echo (date('d-m-Y', $DT_time)); ?>.html" class="read-more read-more1"><span>Xem thêm</span></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php } ?>
            <?php if (isset($xsdt['TT'])) { ?>
                <tr>
                    <td class="bg-gray first">
                        <strong class="left">Kết quả xổ số điện toán Thần tài</strong>
                        <span class="right">Mở thưởng <?php echo $days[date('w', $DT_time)] ?> ngày <?php echo(date('d/m/Y', $DT_time)); ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="td-sub">
                        <table class="tbl-sub">
                            <tr>
                                <?php foreach (json_decode($xsdt['TT']->data) as $value) { ?>
                                    <td class="red font24 t-cen"><strong><?php echo $value ?></strong></td>
                                <?php } ?>
                                <td class="t-right"><a target="_blank" href="<?php echo $uri_root ?>xo-so-dien-toan/than-tai/<?php echo (date('d-m-Y', $DT_time)); ?>.html" class="read-more read-more1"><span>Xem thêm</span></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php endforeach; ?>
</div>
<div class="line-red mb10">&nbsp;</div>
<div class="box-view-more clearfix">
    <strong class="red txt-traform left">XỔ SỐ ĐIỆN TOÁN</strong>
    <div class="box-date left">
        <div class="box-datein">
            <input type="text" id="xsdt_dateb" value="<?php echo $date ?>" class="txt-date" />
            <script type="text/javascript">$("#xsdt_dateb").datepick({dateFormat: 'dd-mm-yyyy',maxDate: +0,onSelect: function() {var day=$("#xsdt_dateb").val();document.location='<?php echo $uri_root . $alias ?>/'+day+'.html';}});</script>
        </div>
    </div>
</div>