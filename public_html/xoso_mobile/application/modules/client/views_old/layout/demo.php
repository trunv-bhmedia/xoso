<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo(isset($_meta['description']) ? $_meta['description'] : ''); ?>" />
        <meta name="keywords" content="<?php echo(isset($_meta['keywords']) ? $_meta['keywords'] : ''); ?>" />
        <title><?php echo(isset($_meta['title']) ? $_meta['title'] : ''); ?></title>
        <link type="image/x-icon" href="<?php echo img_link('favicon.ico'); ?>" rel="shortcut icon" />
        <link href="<?php echo css_link('style.css') ?>" rel="stylesheet" type="text/css" />        
        <link href="<?php echo css_link('ddsmoothmenu.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo css_link('jquery.selectbox.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo css_link('stylesbh.css') ?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo js_link('jquery-1.7.2.js') ?>"></script>
        <script type="text/javascript" src="<?php echo js_link('ddsmoothmenu.js') ?>"></script>
        <script type="text/javascript" src="<?php echo js_link('jquery.selectbox-0.2.js') ?>"></script>
        <script type="text/javascript" src="<?php echo js_link('common.js') ?>"></script>
        <script type="text/javascript">var uri_root = '<?php echo $uri_root ?>';</script>
        <script type='text/javascript'>
            var googletag = googletag || {};
            googletag.cmd = googletag.cmd || [];
            (function() {
                var gads = document.createElement('script');
                gads.async = true;
                gads.type = 'text/javascript';
                var useSSL = 'https:' == document.location.protocol;
                gads.src = (useSSL ? 'https:' : 'http:') + 
                    '//www.googletagservices.com/tag/js/gpt.js';
                var node = document.getElementsByTagName('script')[0];
                node.parentNode.insertBefore(gads, node);
            })();
        </script>

        <script type='text/javascript'>
            googletag.cmd.push(function() {
                googletag.defineSlot('/35883025/xs_top', [970, 90], 'div-gpt-ad-1378288615889-0').addService(googletag.pubads());
                googletag.pubads().enableSingleRequest();
                googletag.enableServices();
            });
        </script>
    </head>
    <body>
        <div id="wrapper">
            <?php $this->load->view($layout_header) ?>
            <div class="content-wrap">
                <div class="content">
                    <div class="main clearfix">
                        <div class="col-left">
                            <div class="mod-module">
                                <div class="title-red title">
                                    <div class="title-right"><span class="icon">TẠO MÃ NHÚNG KẾT QUẢ</span></div>
                                </div>
                                <ul class="category-provide">
                                    <li><a href="<?php echo $uri_root ?>demo/index.html">Demo 01 - 500px</a></li>
                                    <li><a href="<?php echo $uri_root ?>demo/demo-02.html">Demo 02 - 200px</a></li>
                                    <li><a href="<?php echo $uri_root ?>demo/demo-03.html">Demo 03 - 50%</a></li>
                                    <li><a href="<?php echo $uri_root ?>demo/demo-04.html">Demo 04 - 100%</a></li>
                                    <li><a href="<?php echo $uri_root ?>demo/demo-05.html">Demo 05 - 155px</a></li>
                                    <li><a href="<?php echo $uri_root ?>demo/demo-06.html">Demo 06 - 250px</a></li>
                                    <li><a href="<?php echo $uri_root ?>tao-ma-nhung/ket-qua-xo-so.html">Tạo mã code mới</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-main">
                            <?php $this->load->view($tmpl) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view($layout_footer) ?>
        </div>
    </body>
</html>