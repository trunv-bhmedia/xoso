<?php
if ($alias == $url_mientrung) {
    $l_area = 'MIỀN TRUNG';
} else {
    $l_area = 'MIỀN NAM';
}
echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ ' . $l_area . '</h1>';
?>
<div class="page-title-xs"><strong>XỔ SỐ <?php echo $l_area ?></strong></div>
<div class="location-block">
    <ul class="xs-menu">
        <?php
        if ($alias == $url_mientrung) {
            echo '<li><h3><a href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html"><span><strong>Trực Tiếp Xổ Số Miền Trung</strong></span></a></h3></li>';
            foreach ($location_menu['MT'] as $value) {
                echo '<li><h3><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></h3></li>';
            }
        } else {
            echo '<li><h3><a href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html"><span><strong>Trực Tiếp Xổ Số Miền Nam</strong></span></a></h3></li>';
            foreach ($location_menu['MN'] as $value) {
                echo '<li><h3><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></h3></li>';
            }
        }
        ?>
    </ul>
</div>