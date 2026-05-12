<div class="tkvip_block">
    <h3>Thống kê VIP xổ số 3 miền ngày <?php echo str_replace('-', '/', $date) ?></h3>
    <div class="box-date-provide">
        <input name="kqxs_date" type="text" id="kqxs_date" value="<?php echo str_replace('/', '-', $date) ?>" />
        <script type="text/javascript">/*<![CDATA[*/$("#kqxs_date").datepick({dateFormat:"dd-mm-yyyy",maxDate:+0,onSelect:function(){var a=$("#kqxs_date").val();document.location="<?php echo $uri_root ?>thong-ke-vip-xo-so-3-mien-ngay-"+a+".html"}});/*]]>*/</script>
    </div>
    <div class="box-result">
        <div class="title-tkvip">Thống kê VIP xổ số Miền Bắc</div>
        <div class="tkvip_content">
            <?php if (isset($vip[1])) { ?>
                <table>
                    <tr><td width="130"><strong>Đặc biệt :</strong></td><td><?php echo $vip[1]->dac_biet ?></td></tr>
                    <tr><td><strong>Cầu loto VIP :</strong></td><td><?php echo $vip[1]->cau_loto ?></td></tr>
                    <tr><td><strong>Loto Xiên :</strong></td><td><?php echo $vip[1]->lo_xien ?></td></tr>
                    <tr><td><strong>Loto về nhiều :</strong></td><td><?php echo $vip[1]->ve_nhieu ?></td></tr>
                    <tr><td><strong>Loto lâu không về :</strong></td><td><?php echo $vip[1]->lau_ve ?></td></tr>
                </table>
            <?php } else { ?>
                <em>Đang được cập nhật!</em>
            <?php } ?>
        </div>
        <br/>
        <h3>Thống kê VIP Miền Trung</h3>
        <?php foreach ($location_today['MT'] as $i => $value) { ?>
            <div class="title-tkvip">Thống kê VIP xổ số <?php echo $value->name ?></div>
            <div class="tkvip_content">
                <?php if (isset($vip[$value->id])) { ?>
                    <table>
                        <tr><td width="130"><strong>Đặc biệt :</strong></td><td><?php echo $vip[$value->id]->dac_biet ?></td></tr>
                        <tr><td><strong>Cầu loto VIP :</strong></td><td><?php echo $vip[$value->id]->cau_loto ?></td></tr>
                        <tr><td><strong>Loto Xiên :</strong></td><td><?php echo $vip[$value->id]->lo_xien ?></td></tr>
                        <tr><td><strong>Loto về nhiều :</strong></td><td><?php echo $vip[$value->id]->ve_nhieu ?></td></tr>
                        <tr><td><strong>Loto lâu không về :</strong></td><td><?php echo $vip[$value->id]->lau_ve ?></td></tr>
                    </table>
                <?php } else { ?>
                    <em>Đang được cập nhật!</em>
                <?php } ?>
            </div>
        <?php } ?>
        <br/>
        <h3>Thống kê VIP Miền Nam</h3>
        <?php foreach ($location_today['MN'] as $i => $value) { ?>
            <div class="title-tkvip">Thống kê VIP xổ số <?php echo $value->name ?></div>
            <div class="tkvip_content">
                <?php if (isset($vip[$value->id])) { ?>
                    <table>
                        <tr><td width="130"><strong>Đặc biệt :</strong></td><td><?php echo $vip[$value->id]->dac_biet ?></td></tr>
                        <tr><td><strong>Cầu loto VIP :</strong></td><td><?php echo $vip[$value->id]->cau_loto ?></td></tr>
                        <tr><td><strong>Loto Xiên :</strong></td><td><?php echo $vip[$value->id]->lo_xien ?></td></tr>
                        <tr><td><strong>Loto về nhiều :</strong></td><td><?php echo $vip[$value->id]->ve_nhieu ?></td></tr>
                        <tr><td><strong>Loto lâu không về :</strong></td><td><?php echo $vip[$value->id]->lau_ve ?></td></tr>
                    </table>
                <?php } else { ?>
                    <em>Đang được cập nhật!</em>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <br/>
    <div class="tkvip_more">
        <h3>Xem thống kê của 5 ngày trước</h3>
        <ul>
            <li><img width="6" height="6" alt="icon ve so" src="<?php echo img_link('bullet-red.png') ?>" />&nbsp;&nbsp;<a href="<?php echo $uri_root ?>thong-ke-vip-xo-so-3-mien-ngay-<?php echo date('d-m-Y', strtotime($date . ' -1 day')) ?>.html">Thống kê VIP của ngày <?php echo date('d/m/Y', strtotime($date . ' -1 day')) ?></a></li>
            <li><img width="6" height="6" alt="icon ve so" src="<?php echo img_link('bullet-red.png') ?>" />&nbsp;&nbsp;<a href="<?php echo $uri_root ?>thong-ke-vip-xo-so-3-mien-ngay-<?php echo date('d-m-Y', strtotime($date . ' -2 day')) ?>.html">Thống kê VIP của ngày <?php echo date('d/m/Y', strtotime($date . ' -2 day')) ?></a></li>
            <li><img width="6" height="6" alt="icon ve so" src="<?php echo img_link('bullet-red.png') ?>" />&nbsp;&nbsp;<a href="<?php echo $uri_root ?>thong-ke-vip-xo-so-3-mien-ngay-<?php echo date('d-m-Y', strtotime($date . ' -3 day')) ?>.html">Thống kê VIP của ngày <?php echo date('d/m/Y', strtotime($date . ' -3 day')) ?></a></li>
            <li><img width="6" height="6" alt="icon ve so" src="<?php echo img_link('bullet-red.png') ?>" />&nbsp;&nbsp;<a href="<?php echo $uri_root ?>thong-ke-vip-xo-so-3-mien-ngay-<?php echo date('d-m-Y', strtotime($date . ' -4 day')) ?>.html">Thống kê VIP của ngày <?php echo date('d/m/Y', strtotime($date . ' -4 day')) ?></a></li>
            <li><img width="6" height="6" alt="icon ve so" src="<?php echo img_link('bullet-red.png') ?>" />&nbsp;&nbsp;<a href="<?php echo $uri_root ?>thong-ke-vip-xo-so-3-mien-ngay-<?php echo date('d-m-Y', strtotime($date . ' -5 day')) ?>.html">Thống kê VIP của ngày <?php echo date('d/m/Y', strtotime($date . ' -5 day')) ?></a></li>
        </ul>
    </div>
    <br/>
    <?php $this->load->view($layout_sms);?>
</div>