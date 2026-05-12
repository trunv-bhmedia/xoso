<?php echo '<h1 style="position: absolute; text-indent: -99999px">Mã Tỉnh / Thành Phố</h1>'; ?>
<div class="page-title-xs"><strong>Mã Tỉnh / Thành Phố</strong></div>
<div class="home-block matinh_block">
    <div class="title-provide">MIỀN BẮC</div>
    <ul class="category-provide list-provide">
        <li class="clearfix"><span class="span-bna">MB</span><a href="<?php echo $uri_root . $url_mienbac ?>.html">Xổ số Miền Bắc</a></li>
    </ul>
    <div class="title-provide">MIỀN TRUNG</div>
    <ul class="category-provide list-provide">
        <?php
        foreach ($location_menu['MT'] as $value) {
            echo '<li class="clearfix"><span class="span-bna">' . $value->code . '</span><a href="' . $uri_root . $value->alias . '.html">Xổ số ' . $value->name . '</a></li>';
        }
        ?>
    </ul>
    <div class="title-provide">MIỀN NAM</div>
    <ul class="category-provide list-provide">
        <?php
        foreach ($location_menu['MN'] as $value) {
            echo '<li class="clearfix"><span class="span-bna">' . $value->code . '</span><a href="' . $uri_root . $value->alias . '.html">Xổ số ' . $value->name . '</a></li>';
        }
        ?>
    </ul>
</div>