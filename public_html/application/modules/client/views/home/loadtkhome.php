<div class="content-1">
    <div class="tk-home-left">
        <div class="module">
            <h3>Cầu loto có biên độ 6 lần quay</h3>
            <div>
                <?php
                if ($cau_loto5) {
                    foreach ($cau_loto5['result'] as $k => $value) {
                        echo '<span>' . $k . '</span>';
                    }
                }
                ?>
            </div>
        </div>        
    </div>
    <div class="tk-home-right">
        <div class="module">
            <h3>Cầu loto có biên độ 7 lần quay</h3>
            <div>
                <?php
                if ($cau_loto6) {
                    foreach ($cau_loto6['result'] as $k => $value) {
                        echo '<span>' . $k . '</span>';
                    }
                }
                ?>
            </div>
        </div>        
    </div>
    <?php if ($cau_bt) { ?>
        <div class="clear"></div>
        <div class="tk-home-left">     
            <div class="module">
                <h3>Cầu 2 nháy đẹp nhất ngày <?php echo date('d/m/Y') ?></h3>
                <div>
                    <?php
                    if ($cau_2nhay) {
                        foreach ($cau_2nhay as $value) {
                            echo '<span>' . $value . '</span>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="tk-home-right">        
            <div class="module">
                <h3>Cầu bạch thủ Miền Bắc</h3>
                <div>
                    <?php
                    foreach ($cau_bt['result'] as $k => $value) {
                        echo '<span>' . $k . '</span>';
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="clear"></div>
    <div>(*) Cầu đẹp nhất là do hệ thống tự động tính toán theo một số tiêu chí...</div>
</div>
<div class="content-2">
    <h3>Thống kê nhanh cho xổ số <?php echo $lname ?> đến ngày <?php echo date('d/m/Y') ?></h3>
    <div class="module">
        <h3>Loto lâu chưa ra (loto gan):</h3>
        <div>
            <?php
            foreach ($itemsImportant['cautious'] as $k => $v) {
                echo '<span><strong>' . $v['number'] . '</strong>' . $v['not_count'] . ' ngày</span>';
            }
            ?>
        </div>
    </div>
    <div class="module">
        <h3>Loto ra nhiều trong tháng qua:</h3>
        <div>
            <?php
            foreach ($items_30['nhieu_nhat'] as $k => $v) {
                echo '<span><strong>' . $v['number'] . '</strong>' . $v['count'] . ' lần</span>';
            }
            ?>
        </div>
    </div>
</div>
<div class="content-3">
    <h3>Thống kê nhanh cho xổ số <?php echo $lname ?></h3>
    <div>
        Thống kê dưới đây được tính đến trước giờ kết quả ngày <?php echo date('d/m/Y') ?>
        <h3>12 bộ số xuất hiện nhiều nhất trong 40 ngày qua:</h3>
        <div class="module">
            <?php
            $i = 0;
            foreach ($itemsImportant['nhieu_nhat'] as $k => $v) {
                if ($i >= 12)
                    break;
                if ($i == 6)
                    echo '<br/>';
                echo '<strong>' . $v['number'] . '</strong> (' . $v['count'] . ' lần);&nbsp;&nbsp;';
                $i++;
            }
            ?>
        </div>
        <h3>12 bộ số xuất hiện ít nhất trong 40 ngày qua:</h3>
        <div class="module">
            <?php
            $i = 0;
            foreach ($itemsImportant['it_nhat'] as $k => $v) {
                if ($i == 6)
                    echo '<br/>';
                echo '<strong>' . $v['number'] . '</strong> (' . $v['count'] . ' lần);&nbsp;&nbsp;';
                $i++;
            }
            ?>
        </div>
        <h3>Những bộ số ra liên tiếp (lô rơi):</h3>
        <div class="module">
            <?php
            $i = 0;
            foreach ($itemsImportant['bo_lien_tiep'] as $k => $v) {
                if ($i == 3 || $i == 6 || $i == 9 || $i == 12)
                    echo '<br/>';
                echo '<strong>' . $v['number'] . '</strong> (' . $v['bo_lien_tiep'] . ' ngày về liên tiếp);&nbsp;&nbsp;';
                $i++;
            }
            ?>
        </div>
        <?php if ($itemsImportant['cautious']) { ?>
            <h3>Những bộ số không ra từ 10 ngày trở lên (lô khan):</h3>
            <div class="module">
                <?php
                $i = 0;
                foreach ($itemsImportant['cautious'] as $k => $v) {
                    if ($v['not_count'] < 10)
                        break;
                    if ($i == 6 || $i == 12 || $i == 18 || $i == 24)
                        echo '<br/>';
                    echo '<strong>' . $v['number'] . '</strong> (' . $v['not_count'] . ' lần);&nbsp;&nbsp;';
                    $i++;
                }
                ?>
            </div>
        <?php } ?>
        <h3>Thống kê đầu số xuất hiện trong 40 ngày qua:</h3>
        <div class="module">
            <?php
            foreach ($items['dau'] as $k => $v) {
                if ($k == 5)
                    echo '<br/>';
                echo 'Đầu <strong>' . $k . '</strong> (' . $v . ' lần);&nbsp;&nbsp;';
            }
            ?>
        </div>
        <h3>Thống kê đít số xuất hiện trong 40 ngày qua:</h3>
        <div class="module">
            <?php
            foreach ($items['duoi'] as $k => $v) {
                if ($k == 5)
                    echo '<br/>';
                echo 'Đít <strong>' . $k . '</strong> (' . $v . ' lần);&nbsp;&nbsp;';
            }
            ?>
        </div>
    </div>
</div>