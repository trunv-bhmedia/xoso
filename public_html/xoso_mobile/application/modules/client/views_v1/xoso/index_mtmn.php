<?php
if ($alias == $url_mientrung) {
    $l_area = 'MIỀN TRUNG';
} else {
    $l_area = 'MIỀN NAM';
}
echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ ' . $l_area . '</h1>';
?>
<ul class="xs-menu">
    <?php
    if ($alias == $url_mientrung) {
        foreach ($location_menu['MT'] as $value) {
            echo '<li><a href="' . $uri_root . $value->alias . '.html"><span>Kết quả xổ số ' . $value->name . '</span></a></li>';
        }
    } else {
        foreach ($location_menu['MN'] as $value) {
            echo '<li><a href="' . $uri_root . $value->alias . '.html"><span>Kết quả xổ số ' . $value->name . '</span></a></li>';
        }
    }
    ?>
</ul>