<div class="tk_block">
    <h3>Thống kê xổ số hôm nay</h3>
    <div class="tk_menu">
        <div class="tabs-provide">
            <ul>
                <li<?php echo $area == 'MB' ? ' class="active"' : ''; ?>><a href="<?php echo $uri_root ?>thong-ke-xo-so-hom-nay/mien-bac.html">MIỀN BẮC</a></li>
                <li<?php echo $area == 'MT' ? ' class="active"' : ''; ?>><a href="<?php echo $uri_root ?>thong-ke-xo-so-hom-nay/mien-trung.html">MIỀN TRUNG</a></li>
                <li<?php echo $area == 'MN' ? ' class="active"' : ''; ?>><a href="<?php echo $uri_root ?>thong-ke-xo-so-hom-nay/mien-nam.html">MIỀN NAM</a></li>
            </ul>
        </div>
    </div>
    <div class="box-date-provide">
        <input name="kqxs_date" type="text" id="kqxs_date" value="<?php echo str_replace('/', '-', $date) ?>" />
        <script type="text/javascript">/*<![CDATA[*/$("#kqxs_date").datepick({dateFormat:"dd-mm-yyyy",maxDate:+0,onSelect:function(){var a=$("#kqxs_date").val();document.location="<?php echo $uri_root ?>thong-ke-xo-so-hom-nay/<?php echo $alias ?>/"+a+".html"}});/*]]>*/</script>
    </div>
    <?php if ($area != 'MB') { ?>
        <div class="tk_title">
            <?php
            $lname = '';
            $statistics_alias = '';
            $str = '';
            foreach ($location_today[$area] as $k => $v) {
                if ($v->alias == $alias) {
                    $str = ' Xổ số <a href="' . $v->alias . '.html">' . $v->name . '</a>';
                    $v->name = '<strong>' . $v->name . '</strong>';
                }
                echo($k == 0 ? '' : ' | ') . '<a href="' . $uri_root . 'thong-ke-xo-so-hom-nay/' . $v->alias . '.html">' . $v->name . '</a>';
            }
            ?>
        </div>
    <?php } ?>
    <div class="box-result">
        <?php if ($items_30['nhieu_nhat']) { ?>
            <div class="title-tk">Thống kê các bộ số về nhiều trong 30 lần quay<?php echo $str ?></div>
            <table class="tbl-ds">
                <tr>
                    <td width="50" class="t-cen">Cặp số</td>
                    <td class="t-cen">Ngày về gần nhất</td>
                    <td class="t-cen">Số lần xuất hiện </td>
                    <td class="last t-cen">Số lần chưa về</td>
                </tr>
                <?php
                $dem = 0;
                foreach ($items_30['nhieu_nhat'] as $k => $v) {
                    $dem++;
                    if ($dem > 15)
                        break;
                    ?>
                    <tr>
                        <td width="50" class="t-cen"><strong><?php echo $v['number']; ?></strong></td>
                        <td class="t-cen"><?php echo date('d/m/Y', strtotime($v['date'])); ?></td>
                        <td class="t-cen"><?php echo $v['count']; ?></td>
                        <td class="last t-cen"><?php echo $v['not_count']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
        <?php if ($items_30['cautious']) { ?>
            <div class="title-tk">Thống kê các bộ số lâu về trong 30 lần quay<?php echo $str ?></div>
            <table class="tbl-ds">
                <tr>
                    <td width="50" class="t-cen">Cặp số</td>
                    <td class="t-cen">Ngày về gần nhất</td>
                    <td class="t-cen">Số lần xuất hiện</td>
                    <td class="last t-cen">Số lần chưa về</td>
                </tr>
                <?php
                $dem = 0;
                foreach ($items_30['cautious'] as $k => $v) {
                    $dem++;
                    if ($dem > 15)
                        break;
                    ?>
                    <tr>
                        <td width="50" class="t-cen"><strong><?php echo $v['number']; ?></strong></td>
                        <td class="t-cen"><?php echo date('d/m/Y', strtotime($v['date'])); ?></td>
                        <td class="t-cen"><?php echo $v['count']; ?></td>
                        <td class="last t-cen"><?php echo $v['not_count']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </div>
    <?php echo '<br/><div class="msg-block">' . $description . '</div>' ?>
    <br/>
    <?php $this->load->view($layout_sms);?>
</div>