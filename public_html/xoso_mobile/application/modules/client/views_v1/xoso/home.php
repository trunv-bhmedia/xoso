<?php echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ</h1>'; ?>
<ul class="xs-menu">
    <li><a href="<?php echo $uri_root . $url_mienbac ?>.html">Kết quả Miền Bắc</a></li>
    <li><a href="<?php echo $uri_root . $url_miennam ?>.html">Kết quả Miền Nam</a></li>
    <?php
    foreach ($location_today['MN'] as $value) {
        echo '<li class="sub-menu-xstoday"><a href="' . $uri_root . $value->alias . '.html"><span>Kết quả xổ số ' . $value->name . '</span></a></li>';
    }
    ?>
    <li><a href="<?php echo $uri_root . $url_mientrung ?>.html">Kết quả Miền Trung</a></li>
    <?php
    foreach ($location_today['MT'] as $value) {
        echo '<li class="sub-menu-xstoday"><a href="' . $uri_root . $value->alias . '.html"><span>Kết quả xổ số ' . $value->name . '</span></a></li>';
    }
    ?>
</ul>