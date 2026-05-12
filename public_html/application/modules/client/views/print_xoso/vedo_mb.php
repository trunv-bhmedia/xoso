<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo(isset($_meta['description']) ? $_meta['description'] : ''); ?>" />
        <meta name="keywords" content="<?php echo(isset($_meta['keywords']) ? $_meta['keywords'] : ''); ?>" />
        <title><?php echo(isset($_meta['title']) ? $_meta['title'] : ''); ?></title>
        <link type="image/x-icon" href="<?php echo img_link('favicon.ico'); ?>" rel="shortcut icon" />
        <link href="<?php echo $type == 2 ? css_link('vedo.css') : css_link('vedo4.css') ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
        if (isset($items[0])) {
            $item = $items[0];

            ob_start();
            ?>
            <div class="box_kqxs_mienbac">
                <div class="boxtop">
                    <div class="title">KẾT QUẢ XỔ SỐ KIẾN THIẾT MIỀN BẮC</div>
                    <div class="loaive">Loại vé: 10.000 đ</div>
                    <div class="kyhieu">Ký hiệu: XSMB</div>
                    <div class="ngay"><span style="font-weight:700;text-align:left;float:left;<?php echo $type == 2 ? 'font-size:35px' : 'font-size:25px' ?>">xoso.com</span> Mở thưởng <strong><?php echo $item->dateOfWeek ?></strong> ngày: <span class="txtngay"> <?php echo $item->date ?></span></div>
                </div>
                <div class="box_kqxs">
                    <table border="0" cellpadding="0" cellspacing="0" class="bkqmienbac" width="100%">
                        <tr>
                            <td class="leftcl"  valign="top">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td class="giaidb">
                                            Giải <br />
                                            Đặc Biệt
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="giai1">Giải nhất</td>
                                    </tr>
                                    <tr>
                                        <td class="giai2">Giải nhì</td>
                                    </tr>
                                    <tr>
                                        <td class="giai3">Giải ba</td>
                                    </tr>
                                    <tr>
                                        <td class="giai4">Giải tư</td>
                                    </tr>
                                    <tr>
                                        <td class="giai5">Giải năm</td>
                                    </tr>
                                    <tr>
                                        <td class="giai6">Giải sáu</td>
                                    </tr>
                                    <tr>
                                        <td class="giai7">Giải bảy</td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td valign="top" width="100%">
                                            <table cellpadding="0" cellspacing="0" class="rightcl" width="100%">
                                                <tr>
                                                    <td class="giaidb"><div><?php echo $item->a0 ?></div></td>
                                                </tr>
                                                <tr>
                                                    <td class="giai1"><div><?php echo $item->a1 ?></div></td>
                                                </tr>
                                                <tr>
                                                    <td class="giai2"><div><?php echo str_replace('-', '</div><div>', $item->a2) ?></div></td>
                                                </tr>
                                                <tr>
                                                    <td class="giai3"><div><?php echo str_replace('-', '</div><div>', $item->a3) ?></div></td>
                                                </tr>
                                                <tr>
                                                    <td class="giai4"><div><?php echo str_replace('-', '</div><div>', $item->a4) ?></div></td>
                                                </tr>
                                                <tr>
                                                    <td class="giai5"><div><?php echo str_replace('-', '</div><div>', $item->a5) ?></div></td>
                                                </tr>
                                                <tr>
                                                    <td class="giai6"><div><?php echo str_replace('-', '</div><div>', $item->a6) ?></div></td>
                                                </tr>
                                                <tr>
                                                    <td class="giai7"><div><?php echo str_replace('-', '</div><div>', $item->a7) ?></div></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="bottom1">Kết quả niêm yết lúc <?php echo date('H\hi', strtotime($item->time)) ?>' cùng ngày tại CT XSKT Thủ Đô</div>
                </div>
                <div class="bottom">xoso.com</div>
            </div>
            <?php
            $str = ob_get_contents();
            ob_end_clean();
            if ($type == 2) {
                ?>
                <table border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <td><?php echo $str ?></td>
                    </tr>
                </table>
                <?php
            } else {
                ?>
                <table  border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center" valign="middle" style="width:360px; overflow:hidden"><?php echo $str ?></td>
                        <td style="width:21px; min-width:21px;" align="left" valign="top" ><div style="width:10px; height:21px; border-right:1px #333 solid"></div></td>
                        <td align="center" valign="middle" style="width:360px; overflow:hidden"><?php echo $str ?></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" ><div style="width:21px; height:12px; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                        <td height="25" align="left" valign="top"><div style="width:11px; height:11px; border-right:1px #333 solid; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                        <td height="1" align="right" valign="top" ><div style="width:21px; height:12px; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" style="width:360px; overflow:hidden"><?php echo $str ?></td>
                        <td width="1" align="left" valign="bottom"><div style="width:10px; height:21px; border-right:1px #333 solid"></div></td>
                        <td align="center" valign="middle" style="width:360px; overflow:hidden"><?php echo $str ?></td>
                    </tr>
                </table>
                <?php
            }
            ?>
            <script type="text/javascript">
                window.print();
            </script>
            <?php
        } else {
            echo '<div class="title">Dữ liệu không có!</div>';
        }
        ?>
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-31260907-1', 'xoso.com');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
        </script>
    </body>
</html>