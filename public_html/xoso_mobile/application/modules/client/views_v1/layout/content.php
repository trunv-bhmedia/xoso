<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo(isset($_meta['description']) ? $_meta['description'] : ''); ?>" />
        <meta name="keywords" content="<?php echo(isset($_meta['keywords']) ? $_meta['keywords'] : ''); ?>" />
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title><?php echo(isset($_meta['title']) ? $_meta['title'] : ''); ?></title>
        <link type="image/x-icon" href="<?php echo img_link('favicon.ico'); ?>" rel="shortcut icon" />
        <link href="<?php echo css_link('style.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo css_link('stylesbh.css') ?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo js_link('jquery-1.7.2.js') ?>"></script>
        <script type="text/javascript" src="<?php echo js_link('common.js') ?>"></script>
        <script type="text/javascript">var uri_root='<?php echo $uri_root ?>';</script>
    </head>
    <body>
        <div id="wrapper">
            <?php echo $c_module == 'home' ? '<h1 style="position: absolute; text-indent: -99999px">Xổ số</h1>' : '' ?>
            <div class="adver"><img src="<?php echo img_link('banner.gif'); ?>" width="500" height="136" alt="" /></div>
            <div class="header clearfix">                
                <div class="menu" id="smoothmenu">
                    <ul id="nav" class="clearfix">
                        <li class="first nav-home"><a href="<?php echo $uri_root ?>" title="Trang chủ xổ số"><span>&nbsp;</span></a></li>
                        <li<?php echo $c_module == 'xoso' && $c_func == 'tructiep' ? ' class="parent arrow"' : ' class="arrow"' ?>>
                            <a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so.html" class="active">Trực tiếp</a>
                            <ul class="sub-menu" style="display:none">
                                <li><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html"><span>Trực tiếp Miền Bắc</span></a></li>
                                <li><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html"><span>Trực tiếp Miền Trung</span></a></li>
                                <li><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html"><span>Trực tiếp Miền Nam</span></a></li>
                            </ul>
                        </li>
                        <li class="arrow">
                            <a href="<?php echo $uri_root ?>ket-qua.html" class="active">Kết quả</a>
                            <ul class="sub-menu" style="display:none">
                                <li><a href="<?php echo $uri_root . $url_mienbac ?>.html">Kết quả Miền Bắc</a></li>
                                <li><a href="<?php echo $uri_root . $url_miennam ?>.html">Kết quả Miền Nam</a></li>
                                <li><a href="<?php echo $uri_root . $url_mientrung ?>.html">Kết quả Miền Trung</a></li>
                            </ul>
                        </li>
                        <li class="arrow">
                            <a href="<?php echo $uri_root ?>thong-ke-quan-trong.html" class="active">Thống kê</a>
                            <ul class="sub-menu" style="display:none">
                                <li><a href="<?php echo $uri_root ?>thongke-dau-duoi-0-9.html"><span>Thống kê số lần xuất hiện</span></a></li>
                                <li><a href="<?php echo $uri_root ?>thong-ke-lo-to-theo-dau-duoi.html"><span>Thống kê đầu đuôi</span></a></li>
                                <li><a href="<?php echo $uri_root ?>thong-ke-cap-so-tu-00-99.html"><span>Thống kê 00 - 99</span></a></li>
                                <li><a href="<?php echo $uri_root ?>thong-ke-quan-trong.html"><span>Thống kê quan trọng</span></a></li>
                                <li><a href="<?php echo $uri_root ?>thong-ke-lo-gan.html"><span>Thống kê Loto gan</span></a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo $uri_root ?>do-ve-so.html" class="active">Dò vé</a></li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <?php $this->load->view($tmpl) ?>
            </div>	
            <div class="footer">
                <a href="http://www.xoso.com">Xem ket qua xo so</a> phiên bản đầy đủ
                <address>&copy; 2012 Xoso.com Mobile version</address>
            </div>
        </div>
    </body>
</html>