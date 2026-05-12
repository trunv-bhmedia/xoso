<div class="header-wrap">
    <div class="header">
        <?php echo $c_module == 'home' ? '<h1 style="position: absolute; text-indent: -99999px">Xổ số</h1>' : '' ?>
        <a href="<?php echo $uri_root ?>" class="logo"><img src="<?php echo img_link('logo.png'); ?>" width="591" height="103" alt="" /></a>
    </div>
    <div class="mainmenu-wrapp">
        <div class="mainmenu clearfix">
            <div class="main-menu-left">&nbsp;</div>
            <div class="main-menu" id="smoothmenu">
                <ul id="nav">
                    <li class="first nav-home"><a href="<?php echo $uri_root ?>" title="Trang chủ xổ số"><span>&nbsp;</span></a></li>
                    <li<?php echo $c_module == 'xoso' && $c_func == 'tructiep' ? ' class="active"' : '' ?>>
                        <a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so.html"><span><span class="arrow">Trực tiếp</span></span></a>
                        <ul class="submenu-border sub-menu" style="display:none">
                            <div class="top-menu-popup">
                                <li><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html"><span>Trực tiếp Miền Bắc</span></a></li>
                                <li><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html"><span>Trực tiếp Miền Trung</span></a></li>
                                <li><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html"><span>Trực tiếp Miền Nam</span></a></li>
                                <li><a href="<?php echo $uri_root ?>lich-mo-thuong-xo-so.html"><span>Lịch mở thưởng</span></a></li>
                            </div>
                        </ul>
                    </li>
                    <li<?php echo (($c_module == 'xoso' && $c_func != 'tructiep') || $c_module == 'xs_northern') ? ' class="active"' : '' ?>>
                        <a href="<?php echo $uri_root ?>ket-qua.html"><span><span class="arrow">Kết quả xổ số</span></span></a>
                        <ul class="submenu-border sub-menu" style="display:none">
                            <div class="top-menu-popup">
                                <li><a href="<?php echo $uri_root . $url_mienbac ?>.html"><span>Kết quả Miền Bắc</span></a></li>                                            
                                <li><a href="<?php echo $uri_root . $url_miennam ?>.html"><span>Kết quả Miền Nam</span></a></li>
                                <li><a href="<?php echo $uri_root . $url_mientrung ?>.html"><span>Kết quả Miền Trung</span></a></li>
                                <li><a href="javascript:;"><span>Kết quả theo tỉnh</span></a>
                                    <ul class="submenu-border" id="menukqxstinh">
                                        <div class="top-menu-popup">
                                            <li class="root"><a href="<?php echo $uri_root . $url_mienbac ?>.html" title="Kết quả xổ số Miền Bắc"><span><strong>Kết quả xổ số Miền Bắc</strong></span></a></li>
                                            <li class="root"><a href="<?php echo $uri_root . $url_miennam ?>.html" title="Kết quả xổ số Miền Nam - Xem KQXS các tỉnh Miền Nam theo ngày"><span><strong>Kết quả xổ số Miền Nam</strong></span></a></li>
                                            <?php
                                            foreach ($location_menu['MN'] as $value) {
                                                echo '<li><a href="' . $uri_root . $value->alias . '.html" title="Kết quả xổ số ' . $value->name . ' - Xổ số Miền Nam"><span>Kết quả xổ số ' . $value->name . '</span></a></li>';
                                            }
                                            ?>
                                            <li class="root"><a href="<?php echo $uri_root . $url_mientrung ?>.html" title="Kết quả xổ số Miền Trung - Xem KQXS các tỉnh Miền Trung theo ngày"><span><strong>Kết quả xổ số Miền Trung</strong></span></a></li>
                                            <?php
                                            foreach ($location_menu['MT'] as $value) {
                                                echo '<li><a href="' . $uri_root . $value->alias . '.html" title="Kết quả xổ số ' . $value->name . ' - Xổ số Miền Trung"><span>Kết quả xổ số ' . $value->name . '</span></a></li>';
                                            }
                                            ?>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="<?php echo $uri_root ?>xo-so-dien-toan.html"><span>Kết quả điện toán</span></a></li>
                            </div>
                        </ul>
                    </li>
                    <li<?php echo $c_module == 'statistics' && $c_func != 'doveso' ? ' class="active"' : '' ?>>
                        <a href="<?php echo $uri_root ?>thong-ke-quan-trong.html"><span><span class="arrow">Thống kê</span></span></a>
                        <ul class="submenu-border sub-menu" style="display:none">
                            <div class="top-menu-popup">
                                <li><a href="javascript:;"><span>Thống kê cơ bản</span></a>
                                    <ul class="submenu-border sub-menu">
                                        <div class="top-menu-popup">
                                            <li><a href="<?php echo $uri_root ?>thongke-dau-duoi-0-9.html"><span>Thống kê đầu, đuôi</span></a></li>
                                            <li><a href="<?php echo $uri_root ?>thong-ke-tong-chan.html"><span>Thống kê theo tổng chẵn</span></a></li>
                                            <li><a href="<?php echo $uri_root ?>thong-ke-tong-le.html"><span>Thống kê theo tổng lẻ</span></a></li>
                                            <li><a href="<?php echo $uri_root ?>thong-ke-theo-tong-0-9.html"><span>Thống kê theo tổng 2 số cuối</span></a></li>
                                            <li><a href="<?php echo $uri_root ?>thong-ke-cap-so-tu-00-99.html"><span>Thống kê 00 - 99</span></a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="javascript:;"><span>Thống kê Loto</span></a>
                                    <ul class="submenu-border sub-menu">
                                        <div class="top-menu-popup">
                                            <li><a href="<?php echo $uri_root ?>thong-ke-quan-trong.html"><span>Thống kê quan trọng</span></a></li>
                                            <li><a href="<?php echo $uri_root ?>thong-ke-theo-bo-so.html"><span>Thống kê theo bộ số</span></a></li>
                                            <li><a href="<?php echo $uri_root ?>thong-ke-lo-to-tinh.html"><span>Thống kê Loto nhanh</span></a></li>
                                            <li><a href="<?php echo $uri_root ?>thong-ke-lo-gan.html"><span>Thống kê Loto gan</span></a></li>
                                            <li><a href="<?php echo $uri_root ?>thong-ke-lo-to-theo-dau-duoi.html"><span>Thống kê Loto theo đầu / đuôi</span></a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="javascript:;"><span>Thống kê đặc biệt</span></a>
                                    <ul class="submenu-border sub-menu">
                                        <div class="top-menu-popup">
                                            <li><a href="<?php echo $uri_root ?>thong-ke-lo-to-theo-tong.html"><span>Thống kê theo tổng</span></a></li>
                                            <li><a href="<?php echo $uri_root ?>thong-ke-theo-chu-ky.html"><span>Thống kê theo chu kỳ</span></a></li>
                                            <li><a href="<?php echo $uri_root ?>thong-ke-giai-dac-biet-theo-tuan.html"><span>Thống kê giải đặc biệt theo tuần</span></a></li>
                                            <li><a href="<?php echo $uri_root ?>thong-ke-giai-dac-biet-theo-thang.html"><span>Thống kê giải đặc biệt theo tháng</span></a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="javascript:;"><span>Thống kê Cầu</span></a>
                                    <ul class="submenu-border sub-menu">
                                        <div class="top-menu-popup">
                                            <li><a href="<?php echo $uri_root ?>thongke-cau-xo-so.html"><span>Thống kê Cầu Loto</span></a></li>
                                            <li><a href="<?php echo $uri_root ?>thongke-cau-bach-thu-mien-bac.html"><span>Thống kê Cầu bạch thủ</span></a></li>
                                        </div>
                                    </ul>
                                </li>
                            </div>
                        </ul>
                    </li>
                    <li<?php echo $c_module == 'statistics' && $c_func == 'doveso' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root ?>do-ve-so.html">Dò vé số</a></li>
                    <li<?php echo $c_module == 'demo' && $c_func == 'tao_ma_nhung' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root ?>tao-ma-nhung/ket-qua-xo-so.html">Chèn KQXS</a></li>
                    <li<?php echo $c_module == 'news' && ($c_func == 'index' || $c_func == 'detail') ? ' class="active"' : '' ?>><a href="<?php echo $uri_root ?>tin-xo-so.html">Tin tức</a>
                        <ul class="submenu-border sub-menu" style="display:none">
                            <div class="top-menu-popup">
                                <?php
                                foreach ($news_category as $value) {
                                    echo '<li><a href="' . $uri_root . 'tin-xo-so/danh-muc-' . $value->name_link . '.html"><span>' . $value->name . '</span></a></li>';
                                }
                                ?>
                            </div>
                        </ul>
                    </li>
                    <li class="last"><a target="_blank" href="http://forum.xoso.com"><span>Diễn đàn</span></a></li>                    
                    <li class="right<?php echo $c_module == 'news' && ($c_func == 'help' || $c_func == 'helpdetail') ? ' active' : '' ?>"><a href="<?php echo $uri_root ?>tro-giup.html">Trợ giúp</a>
                        <ul class="submenu-border sub-menu" style="display:none">
                            <div class="top-menu-popup">
                                <?php
                                foreach ($help_category as $value) {
                                    echo '<li><a href="' . $uri_root . 'tro-giup/danh-muc-' . $value->name_link . '.html"><span>' . $value->name . '</span></a></li>';
                                }
                                ?>
                            </div>
                        </ul>
                    </li>
                    <li<?php echo $c_module == 'html' && $c_func == 'gioithieu' ? ' class="active right"' : ' class="right"' ?>><a href="<?php echo $uri_root ?>gioi-thieu.html">Giới thiệu</a></li>
                </ul>
            </div>
            <div class="main-menu-right">&nbsp;</div>
        </div>
    </div>
    <div id='div-gpt-ad-1378288615889-0' style='width:970px;text-align:center' class="mainmenu">
        <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1378288615889-0'); });
        </script>
    </div>
</div>