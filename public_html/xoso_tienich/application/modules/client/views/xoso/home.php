<?php echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ</h1>'; ?>
<div class="page-title-xs"><strong>Xổ số hôm nay <?php echo date('d/m/Y', time()) ?></strong></div>
<div class="home-block">
    <ul class="xs-menu">
        <li><h2><a href="<?php echo $uri_root . $url_mienbac ?>.html"><span>Miền Bắc</span></a></h2></li>
        <li><h2><a href="<?php echo $uri_root . $url_miennam ?>.html"><span>Miền Nam</span></a></h2></li>
        <?php
        foreach ($location_today['MN'] as $value) {
            echo '<li class="sub-menu-xstoday"><h3><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></h3></li>';
        }
        ?>
        <li><h2><a href="<?php echo $uri_root . $url_mientrung ?>.html"><span>Miền Trung</span></a></h2></li>
        <?php
        foreach ($location_today['MT'] as $value) {
            echo '<li class="sub-menu-xstoday"><h3><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></h3></li>';
        }
        ?>
    </ul>
</div>