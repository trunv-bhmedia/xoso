<div class="col-left">
    <div class="mod-module">
        <div class="title-red title">
            <div class="title-right"><span class="icon">TƯỜNG THUẬT TRỰC TIẾP</span></div>
        </div>
        <ul class="category-provide">                                    
            <li><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html" title="Trực tiếp xổ số Miền Bắc"><span>Trực tiếp xổ số Miền Bắc</span></a></li>
            <?php
            foreach ($location_today['MT'] as $value) {
                echo '<li><a href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html" title="Trực tiếp xổ số ' . $value->name . ' - Xổ số Miền Trung"><span>Trực tiếp xổ số ' . $value->name . '</span></a></li>';
            }
            foreach ($location_today['MN'] as $value) {
                echo '<li><a href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html" title="Trực tiếp xổ số ' . $value->name . ' - Xổ số Miền Nam"><span>Trực tiếp xổ số ' . $value->name . '</span></a></li>';
            }
            ?>
        </ul>
        <div class="title-red title">
            <div class="title-right"><span class="icon">Quay thưởng hôm qua</span></div>
        </div>
        <ul class="category-provide">
            <li><a href="<?php echo $uri_root . $url_mienbac ?>.html" title="Kết quả xổ số Miền Bắc"><span>Kết quả xổ số Miền Bắc</span></a></li>
            <?php
            foreach ($location_lastday['MT'] as $value) {
                echo '<li><a href="' . $uri_root . $value->alias . '.html" title="Kết quả xổ số ' . $value->name . ' - Xổ số Miền Trung"><span>Kết quả xổ số ' . $value->name . '</span></a></li>';
            }
            foreach ($location_lastday['MN'] as $value) {
                echo '<li><a href="' . $uri_root . $value->alias . '.html" title="Kết quả xổ số ' . $value->name . ' - Xổ số Miền Nam"><span>Kết quả xổ số ' . $value->name . '</span></a></li>';
            }
            ?>
        </ul>
        <div class="title-red title">
            <div class="title-right"><span class="icon">Tiện ích</span></div>
        </div>
        <ul class="category-provide">
            <li><a href="<?php echo $uri_root ?>tao-ma-nhung/ket-qua-xo-so.html"><span>Chèn KQXS vào website của bạn</span></a></li>
            <li><a href="<?php echo $uri_root ?>demo/index.html"><span>Demo tạo mã nhúng KQXS</span></a></li>
            <li><a href="<?php echo $uri_root ?>lich-mo-thuong-xo-so.html"><span>Lịch mở thưởng</span></a></li>
            <li><a href="<?php echo $uri_root ?>giai-dap-giac-mo.html"><span>Giấc mơ con số</span></a></li>
            <li><a href="<?php echo $uri_root ?>cung-quay-xo-so.html"><span>Cùng quay Xổ Số</span></a></li>
        </ul>
        <div class="title title-yelow"><div class="title-right"><span class="icon"><a href="<?php echo $uri_root . $url_mienbac ?>.html">XỔ SỐ MIỀN BẮC</a></span></div></div>
        <ul class="category-provide">
            <li><a href="<?php echo $uri_root . $url_mienbac ?>.html" title="Kết quả xổ số Miền Bắc">Kết quả xổ số Miền Bắc</a></li>
        </ul>
        <div class="title title-yelow"><div class="title-right"><span class="icon"><a href="<?php echo $uri_root . $url_mientrung ?>.html">XỔ SỐ MIỀN TRUNG</a></span></div></div>
        <ul class="category-provide">
            <?php
            foreach ($location_menu['MT'] as $value) {
                echo '<li><a href="' . $uri_root . $value->alias . '.html" title="Kết quả xổ số ' . $value->name . ' - Xổ số Miền Trung"><span>Kết quả xổ số ' . $value->name . '</span></a></li>';
            }
            ?>
        </ul>
        <div class="title title-yelow"><div class="title-right"><span class="icon"><a href="<?php echo $uri_root . $url_miennam ?>.html">XỔ SỐ MIỀN NAM</a></span></div></div>
        <ul class="category-provide">
            <?php
            foreach ($location_menu['MN'] as $value) {
                echo '<li><a href="' . $uri_root . $value->alias . '.html" title="Kết quả xổ số ' . $value->name . ' - Xổ số Miền Nam"><span>Kết quả xổ số ' . $value->name . '</span></a></li>';
            }
            ?>
        </ul>

    </div>
    <div class="mod-module">
        <div class="mod-banner-left">
            <?php
            foreach ($banner as $v) {
                if ($v->position == 'left' && ($v->page == 'all' || $v->page == $c_module)) {
                    ?>
                    <div><a target="_blank" href="<?php echo $v->url; ?>" title="<?php echo view_title($v->name); ?>"><img src="<?php echo site_url($v->image); ?>" width="211" alt="<?php echo view_title($v->name); ?>" /></a></div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>