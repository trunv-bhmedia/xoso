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
        <link href="<?php echo css_link('stylesbh.css?v=2.5') ?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo js_link('jquery-1.7.2.js') ?>"></script>
        <script type="text/javascript" src="<?php echo js_link('ddsmoothmenu.js') ?>"></script>
        <script type="text/javascript" src="<?php echo js_link('jquery.selectbox-0.2.js') ?>"></script>
        <script type="text/javascript" src="<?php echo js_link('common.js') ?>"></script>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-31260907-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
        <meta name="google-site-verification" content="_MdXAARqGNM7C1GRrfqgrQg59dJuCGxL_3E4tJf_se0" />
        <script type="text/javascript">
            var uri_root='<?php echo $uri_root ?>';
            var googletag=googletag||{};googletag.cmd=googletag.cmd||[];(function(){var gads=document.createElement('script');gads.async=true;gads.type='text/javascript';var useSSL='https:'==document.location.protocol;gads.src=(useSSL?'https:':'http:')+'//www.googletagservices.com/tag/js/gpt.js';var node=document.getElementsByTagName('script')[0];node.parentNode.insertBefore(gads,node)})();
            googletag.cmd.push(function() {
                googletag.defineSlot('/35883025/xs_top', [970, 90], 'div-gpt-ad-1378288615889-0').addService(googletag.pubads());
                googletag.defineSlot('/35883025/xs_b1', [336, 280], 'div-gpt-ad-1378288615889-1').addService(googletag.pubads());
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
                                    <?php
                                    foreach ($items as $value) {
                                        echo '<li><a href="' . $uri_root . 'demo/index.html#demo' . $value->id . '">' . $value->title . '</a></li>';
                                    }
                                    ?>
                                    <li><a href="<?php echo $uri_root ?>tao-ma-nhung/ket-qua-xo-so.html">Tạo mã code mới</a></li>
                                </ul>
                            </div>
                            <?php if (isset($doitac) && count($doitac)) { ?>
                                <div class="title-red title">
                                    <div class="title-right"><span class="icon">Các Website</span></div>
                                </div>
                                <div class="doitac_block">
                                    <?php
                                    foreach ($doitac as $value) {
                                        echo '<div class="item">
                                                <div class="img"><span class="helper"></span><a href="' . $value->link . '"><img src="' . site_url($value->image) . '" /></a></div>
                                                <div class="name"><a href="' . $value->link . '">' . $value->title . '</a></div>
                                            </div>';
                                    }
                                    ?>
                                </div>
                            <?php } ?>
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