<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo $_meta['description'] ?>" />
        <meta name="keywords" content="<?php echo $_meta['keywords'] ?>" />
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title><?php echo $_meta['title'] ?></title>
        <?php echo $_meta['page']; ?>
        <link type="image/x-icon" href="<?php echo img_link('favicon.ico'); ?>" rel="shortcut icon" />
        <link type="text/css" rel="stylesheet" href="<?php echo $uri_root ?>min/g=css1411" />
        <script type="text/javascript" src="<?php echo $uri_root ?>min/g=js1411"></script>
        <script type="text/javascript">var uri_root = '<?php echo $uri_root ?>';</script>
        <meta name="apple-touch-fullscreen" content="YES" />
        <script type='text/javascript'>
            var googletag = googletag || {};
            googletag.cmd = googletag.cmd || [];
            (function () {
                var gads = document.createElement('script');
                gads.async = true;
                gads.type = 'text/javascript';
                var useSSL = 'https:' == document.location.protocol;
                gads.src = (useSSL ? 'https:' : 'http:') + '//www.googletagservices.com/tag/js/gpt.js';
                var node = document.getElementsByTagName('script')[0];
                node.parentNode.insertBefore(gads, node)
            })();
            googletag.cmd.push(function () {
                googletag.defineSlot('/35883025/xsm_b', [300, 250], 'div-gpt-ad-1388469943220-0').addService(googletag.pubads());
                googletag.defineSlot('/35883025/xsm_top', [320, 100], 'div-gpt-ad-1388469943220-1').addService(googletag.pubads());
                googletag.defineSlot('/35883025/xsm_b2', [336, 280], 'div-gpt-ad-1388469943220-2').addService(googletag.pubads());
                googletag.pubads().enableSingleRequest();
                googletag.enableServices();
            });
        </script>
        <script type="text/javascript">var uid = '';
            var curruser = '';
            var user = '';
            var taikhoan = '';
            function loadst() {
                $.ajax({url: uri_root + "client/user/loadst", cache: false, success: function (c) {
                        var objuser = jQuery.parseJSON(c);
                        uid = objuser.id;
                        curruser = objuser.username;
                        user = objuser.fullname;
                        taikhoan = objuser.taikhoan;
                        $(".hello").html('Xin chào:<br/><strong>' + curruser + '</strong>');
                        $("#taikhoanloto").html(taikhoan);
                        $("#userbox").html(objuser.strlogin);
                    }});
            }
            loadst();</script>
        <?php
        $url = $_SERVER["SCRIPT_URI"];
        $url = str_replace('m.xoso.com', 'www.xoso.com', $url);
        $url = str_replace('http://xoso.com', 'http://www.xoso.com', $url);
        $url = preg_replace('/\.html.*$/is', '.html', $url);
        $link_uri = $_SERVER["SCRIPT_URI"];
        if (strpos($link_uri, 'dang-ky.html') === false) {
            echo "<link rel=\"canonical\" href=\"" . $url . "\" />";
        }
        echo "<link rel=\"alternate\" media=\"handheld\" href=\"" . $url . "\" />";
        ?> 

        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-1447277143699738",
                enable_page_level_ads: true
            });
        </script>

    </head>
    <body>
        <div id="wrapper">
            <?php echo $c_module == 'home' ? '<h1 style="position: absolute; text-indent: -99999px">' . $_meta['title'] . '</h1>' : '' ?>
            <div class="header clearfix">
                <div class="header_inner">
                    <h3><a href="http://m.xoso.com" style="color: #fff">XOSO.COM</a></h3>
                    <div class="header-home"><a href="<?php echo $uri_root ?>">&nbsp;</a></div>
                    <div class="header-menu"><a href="javascript:;" id="showmenu" onclick="xsmobile.rightmenu();
                            return false;">Danh mục </a></div>
                </div>
<!--                <div class="header-loto" style="background:#d77813;height:40px">
                    <table>
                        <tr id="user_tr">
                            <td style="border-right:1px solid #be6b12">
                                <div style="text-align:center">
                                    <a href="<?php // echo $uri_root ?>dang-nhap.html"><strong>Đăng nhập</strong></a> / 
                                    <a href="<?php // echo $uri_root ?>dang-ky.html"><strong>Đăng ký</strong></a>
                                </div>
                            </td>
                            <td style="border-left:1px solid #e78319"><div style="text-align:center"><a href="<?php echo $uri_root ?>giao-luu-thao-luan-chot-so-lotto.html"><strong>Chơi Loto Online!</strong></a></div></td>
                        </tr>
                    </table>
                </div>-->
                <script type="text/javascript">
                    $(document).ready(function () {
                        setTimeout(function () {
                            if (uid != '') {
                                $("#user_tr").html('<td style="border-right:1px solid #be6b12"><div style="text-align:center"><strong>Xin chào: ' + curruser + '</strong>'
                                        + ' TK: <strong style="color:#6407b5">' + taikhoan + ' k</strong></div>'
                                        + '</td><td style="border-left:1px solid #e78319"><div style="text-align:center"><a href="<?php echo $uri_root ?>giao-luu-thao-luan-chot-so-lotto.html"><strong>Chơi Loto Online!</strong></a></div></td>'
                                        );
                            }
                        }, 1000);
                    });
                </script>
            </div>
            <!--<div class="banner_top"><a href="http://xoso.com" rel="nofolow"><img id="banner_top" src="<?php // echo img_link('xoso_logo_3.gif'); ?>" width="320" /></a></div>-->

            <div id='div-gpt-ad-1388469943220-1'>
                <script type='text/javascript'>
                    googletag.cmd.push(function () {
                        googletag.display('div-gpt-ad-1388469943220-1');
                    });
                </script>
            </div>
            <script type="text/javascript" src="http://xoso.gsspcln.jp/sdk/t/17667.js"></script>

            <div class="content">    
                <?php
//$tttt_mb = true;
//$tttt_mt = true;
//$tttt_mn = true;
                if ($tttt_mb || $tttt_mt || $tttt_mn) {
                    echo '<script type="text/javascript" src="' . js_link('jquery-blink.js') . '"></script>';
                    if ($tttt_mb) {
                        echo '<div class="tttt_link"><a class="tttt_blink" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">Tường thuật trực tiếp Xổ Số Miền Bắc</a></div>';
                    } elseif ($tttt_mt) {
                        echo '<div class="tttt_link"><a class="tttt_blink" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html">Tường thuật trực tiếp Xổ Số Miền Trung</a></div>';
                    } else {
                        echo '<div class="tttt_link"><a class="tttt_blink" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html">Tường thuật trực tiếp Xổ Số Miền Nam</a></div>';
                    }
                    echo "<script type=\"text/javascript\">$(document).ready(function() { $('.tttt_blink').blink({delay:100});});</script>";
                }
                $this->load->view($tmpl);
                ?>
            </div>

            <div id='div-gpt-ad-1388469943220-0' style='width:300px;'>
                <script type='text/javascript'>
                    googletag.cmd.push(function () {
                        googletag.display('div-gpt-ad-1388469943220-0');
                    });
                </script>
            </div>
            <script type="text/javascript" src="http://xoso.gsspcln.jp/sdk/t/17668.js"></script>

            <div class="gadgets"><h2 class="thong-ke" id="thong-ke">Thống kê</h2></div>
            <ul class="xs-menu">
                <li><h3><a class="tklanxh" href="<?php echo $uri_root ?>thongke-dau-duoi-0-9.html"><span>Thống kê số lần xuất hiện</span></a></h3></li>
                <li><h3><a class="tkdauduoi" href="<?php echo $uri_root ?>thong-ke-lo-to-theo-dau-duoi.html"><span>Thống kê đầu đuôi</span></a></h3></li>
                <li><h3><a class="tk0099" href="<?php echo $uri_root ?>thong-ke-cap-so-tu-00-99.html"><span>Thống kê 00 - 99</span></a></h3></li>
                <li><h3><a class="thongke" href="<?php echo $uri_root ?>thong-ke-quan-trong.html"><span>Thống kê quan trọng</span></a></h3></li>
                <li><h3><a class="logan" href="<?php echo $uri_root ?>thong-ke-lo-gan.html"><span>Thống kê Loto gan</span></a></h3></li>
            </ul>
            <div class="gadgets"><h2>Sớ đầu đuôi</h2></div>
            <ul class="xs-menu">
                <li><h3><a href="<?php echo $uri_root ?>so-dau-duoi/mien-nam.html"><span>Sớ Miền Nam</span></a></h3></li>
                <li><h3><a href="<?php echo $uri_root ?>so-dau-duoi/mien-bac.html"><span>Sớ Miền Bắc</span></a></h3></li>                        
                <li><h3><a href="<?php echo $uri_root ?>so-dau-duoi/mien-trung.html"><span>Sớ Miền Trung</span></a></h3></li>
            </ul>
            <div class="gadgets"><h2>Tiện ích</h2></div>
            <ul class="xs-menu">
                <li><h3><a class="ketqua" href="<?php echo $uri_root ?>ket-qua.html"><span>Kết quả</span></a></h3></li>
                <li><h3><a class="tttt" href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so.html"><span>Tường thuật trực tiếp</span></a></h3></li>
                <li><h3><a class="dove" href="<?php echo $uri_root ?>do-ve-so.html"><span>Dò Vé</span></a></h3></li>
                <li><h3><a class="quayxs" href="<?php echo $uri_root ?>quay-so-may-man.html"><span>Quay số may mắn</span></a></h3></li>
                <li><h3><a href="http://www.xoso.com/in-ve-do.html?ck=1"><span>In vé dò</span></a></h3></li>
            </ul>
            <div class="gadgets"><h2>Cài đặt Xổ Số</h2></div>
            <div class="caidatxs">
                <div>- Hiển thị ưu tiên Kết quả xổ số Miền Bắc » <a href="<?php echo $uri_root ?>?ck=1" rel="nofollow">Bấm đây để xem</a></div>
                <div>- Hiển thị ưu tiên Kết quả xổ số Miền Nam » <a href="<?php echo $uri_root ?>?ck=2" rel="nofollow">Bấm đây để xem</a></div>
                <div>- Hiển thị ưu tiên Kết quả xổ số Miền Trung » <a href="<?php echo $uri_root ?>?ck=3" rel="nofollow">Bấm đây để xem</a></div>
            </div>
            <div class="gadgets mb10"><h2>Tải ứng dụng Xổ Số</h2></div>
            <div class="t-cen mb10">
                <a target="_blank" href="https://itunes.apple.com/vn/app/xo-so/id505057507?mt=8"><img width="130" src="<?php echo img_link('apple_en.png') ?>" /></a>
                &nbsp;<a target="_blank" href="https://play.google.com/store/apps/details?id=com.bhmedia.xosocom"><img width="130" src="<?php echo img_link('android_en.png') ?>" /></a>
            </div>
            <div class="mb10 clearfix"></div>

            <div id='div-gpt-ad-1388469943220-2' style='width:100%;margin:7px auto;overflow:hidden;max-width: 320px'>
                <script type='text/javascript'>
                    googletag.cmd.push(function () {
                        googletag.display('div-gpt-ad-1388469943220-2');
                    });
                </script>
            </div>

            <div class="mb10 clearfix"></div>
            <div id="rightmenu" style="display: none;">
                <div class="element">
                    <h3><a  href="/xo-so-dien-toan.html">Kết quả điện toán</a></h3>
                    <ul>
                        <li><a href="/vietlott/xo-so-power-6-55-vietlott.html"><span>Power 6/55</span></a></li>
                        <li><a href="/vietlott/mega6.html"><span>Mega 6/45</span></a></li>
                        <li><a href="/vietlott/max4d.html"><span>Max 4D</span></a></li>
                    </ul>
                </div>
                <div class="element">
                    <h3><a<?php echo $c_module == 'tructiep' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so.html">Trực tiếp</a></h3>
                    <a class="close-bt" onclick="xsmobile.rightmenu();
                            return false;" href="javascript:;">Đóng</a>
                    <ul>
                        <li><a<?php echo $c_module == 'tructiep' && $area == 'MB' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html"><span>Trực tiếp Miền Bắc</span></a></li>
                        <li><a<?php echo $c_module == 'tructiep' && $area == 'MT' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html"><span>Trực tiếp Miền Trung</span></a></li>
                        <li><a<?php echo $c_module == 'tructiep' && $area == 'MN' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html"><span>Trực tiếp Miền Nam</span></a></li>
                    </ul>
                </div>
                <div class="element">
                    <h3><a<?php echo $c_module == 'xoso' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>ket-qua.html">Kết quả</a></h3>
                    <ul>
                        <li><a<?php echo $c_module == 'xoso' && $alias == 'xo-so-mien-bac' ? ' class="active"' : '' ?> href="<?php echo $uri_root . $url_mienbac ?>.html">Kết quả Miền Bắc</a></li>
                        <li><a<?php echo $c_module == 'xoso' && $alias == 'xoso-mien-nam' ? ' class="active"' : '' ?> href="<?php echo $uri_root . $url_miennam ?>.html">Kết quả Miền Nam</a></li>
                        <li><a<?php echo $c_module == 'xoso' && $alias == 'xoso-mien-trung' ? ' class="active"' : '' ?> href="<?php echo $uri_root . $url_mientrung ?>.html">Kết quả Miền Trung</a></li>
                    </ul>
                </div>
                <div class="element">
                    <h3><a<?php echo $c_module == 'statistics' && $c_func != 'doveso' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>thong-ke-quan-trong.html">Thống kê</a></h3>
                    <ul>
                        <li><a<?php echo $c_module == 'statistics' && $c_func == 'first_last' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>thongke-dau-duoi-0-9.html"><span>Thống kê số lần xuất hiện</span></a></li>
                        <li><a<?php echo $c_module == 'statistics' && $c_func == 'dau_duoi' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>thong-ke-lo-to-theo-dau-duoi.html"><span>Thống kê đầu đuôi</span></a></li>
                        <li><a<?php echo $c_module == 'statistics' && $c_func == 'two' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>thong-ke-cap-so-tu-00-99.html"><span>Thống kê 00 - 99</span></a></li>
                        <li><a<?php echo $c_module == 'statistics' && $c_func == 'index' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>thong-ke-quan-trong.html"><span>Thống kê quan trọng</span></a></li>
                        <li><a<?php echo $c_module == 'statistics' && $c_func == 'gan' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>thong-ke-lo-gan.html"><span>Thống kê Loto gan</span></a></li>
                    </ul>
                </div>
                <div class="element">
                    <h3><a<?php echo $c_module == 'sodauduoi' && $alias == 'xoso-mien-nam' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>so-dau-duoi/mien-nam.html">Sớ đầu đuôi</a></h3>
                    <ul>
                        <li><a<?php echo $c_module == 'sodauduoi' && $alias == 'xoso-mien-nam' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>so-dau-duoi/mien-nam.html">Sớ Miền Nam</a></li>
                        <li><a<?php echo $c_module == 'sodauduoi' && $alias == 'xo-so-mien-bac' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>so-dau-duoi/mien-bac.html">Sớ Miền Bắc</a></li>                        
                        <li><a<?php echo $c_module == 'sodauduoi' && $alias == 'xoso-mien-trung' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>so-dau-duoi/mien-trung.html">Sớ Miền Trung</a></li>
                    </ul>
                </div>
                <div class="element">
                    <h3><a<?php echo $c_module == 'statistics' && $c_func == 'doveso' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>do-ve-so.html">Dò vé</a></h3>
                </div>
                <div class="element rightmenu-bdtop">
                    <h3><a<?php echo $c_module == 'quayxs' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>quay-so-may-man.html">Quay số may mắn</a></h3>
                </div>
                <div class="element rightmenu-bdtop">
                    <h3><a<?php echo $c_module == 'xs_dreams' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>giai-dap-giac-mo.html">Giải đáp giấc mơ</a></h3>
                </div>
            </div>
            <div class="footer">
                <div>&copy; 2014 Xoso.com</div>
                <div><a href="<?php echo $uri_root ?>">Mobile version</a> - <a href="http://www.xoso.com/<?php echo $uri_string ?>?ck=1">Desktop version</a></div>
                <div class="footer-home"><a href="<?php echo $uri_root ?>">Trang chủ</a></div>
                <div class="footer-top"><a href="#wrapper">Top</a></div>                
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                var width = $(window).width();
                $("#banner_top").attr('width', width);
                var height = $("#banner_top").height();
                if (60 + height > 210)
                    height = 170;
                $("#wrapper").css('padding-top', 60 + height);
            });
        </script>

        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle" style="display:none" data-ad-client="ca-pub-1447277143699738" data-reactive-ad-format="1"  data-ad-channel="6729070649"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-31260907-1', 'xoso.com');
            ga('require', 'displayfeatures');
            ga('send', 'pageview');
        </script>
    </body>
</html>