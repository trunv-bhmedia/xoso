<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo(isset($_meta['description']) ? $_meta['description'] : ''); ?>" />
        <meta name="keywords" content="<?php echo(isset($_meta['keywords']) ? $_meta['keywords'] : ''); ?>" />
        <title><?php echo(isset($_meta['title']) ? $_meta['title'] : ''); ?></title>
        <link type="image/x-icon" href="<?php echo img_link('favicon.ico'); ?>" rel="shortcut icon" />
        <link href="<?php echo css_link('vedo6.css') ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
        $item = $items[0];
        ob_start();
        ?>
        <table class="zebra" style="width:235px;">
            <thead>
                <tr>
                    <td colspan="2" align="center">
                        <div style="font-size:14px; display:block; padding-top:3px;">
                            <b>xoso.com</b>
                        </div>
                        <div style="font-size:12px;text-align:center">Kết Quả Xổ Số Ngày:  <span><b><?php echo $item->date ?></b></span></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:8px; line-height: 150%"><span style="font-size:12px; line-height: 150%"><b>KẾT QUẢ XỔ SỐ KIẾN THIẾT MIỀN BẮC</b></span>  <br/> (Áp dụng chung cho khu vực MIỀN BẮC)</td>
                </tr>
                <tr align="center" style="font-size:10px;line-height:18px;">
                    <td width="30px" rowspan="2"><?php echo $item->dateOfWeek ?></td>
                    <td><b>Xổ số Miền Bắc - Xổ số Thủ Đô</b></td>
                </tr>
            </thead>
            <tbody>
                <tr align="center">
                    <td class="ten_giai_dac_biet ten_mien_bac_giai_dac_biet">ĐB</td>
                    <td class="giai_dac_biet mien_bac_giai_dac_biet"><?php echo $item->a0 ?></td>
                </tr>
                <tr align="center">
                    <td class="ten_giai_nhat ten_mien_bac_giai_nhat">G.Nhất</td>
                    <td class="giai_nhat mien_bac_giai_nhat"><?php echo $item->a1 ?></td>
                </tr>
                <tr align="center">
                    <td class="ten_giai_nhi ten_mien_bac_giai_nhi">G.Nhì</td>
                    <td class="giai_nhi mien_bac_giai_nhi"><?php echo str_replace('-', ' - ', $item->a2) ?></td>
                </tr>
                <tr align="center">
                    <td class="ten_giai_ba ten_mien_bac_giai_ba">G.Ba</td>
                    <td class="giai_ba mien_bac_giai_ba">
                        <?php
                        $tmp = explode('-', $item->a3);
                        foreach ($tmp as $i => $value) {
                            if ($i == 0)
                                echo $value;
                            elseif ($i == 3)
                                echo '<br/>' . $value;
                            else
                                echo ' - ' . $value;
                        }
                        ?>
                    </td>
                </tr>
                <tr align="center">
                    <td class="ten_giai_tu ten_mien_bac_giai_tu">G.Tư</td>
                    <td class="giai_tu mien_bac_giai_tu"><?php echo str_replace('-', ' - ', $item->a4) ?></td>
                </tr>
                <tr align="center">
                    <td class="ten_giai_nam ten_mien_bac_giai_nam">G.Năm</td>
                    <td class="giai_nam mien_bac_giai_nam">
                        <?php
                        $tmp = explode('-', $item->a5);
                        foreach ($tmp as $i => $value) {
                            if ($i == 0)
                                echo $value;
                            elseif ($i == 3)
                                echo '<br/>' . $value;
                            else
                                echo ' - ' . $value;
                        }
                        ?>
                    </td>
                </tr>
                <tr align="center">
                    <td class="ten_giai_sau ten_mien_bac_giai_sau">G.Sáu</td>
                    <td class="giai_sau mien_bac_giai_sau"><?php echo str_replace('-', ' - ', $item->a6) ?></td>
                </tr>
                <tr align="center">
                    <td class="ten_giai_bay ten_mien_bac_giai_bay">G.Bảy</td>
                    <td class="giai_bay giai_cuoi mien_bac_giai_bay"><?php echo str_replace('-', ' - ', $item->a7) ?></td>
                </tr>
            </tbody>
        </table>
        <p style="text-align:center;font-style:italic; margin:0; border:1px solid; font-weight: bold; font-family:'Times New Roman', Times, serif;">xoso.com </p>
        <?php
        $str = ob_get_contents();
        ob_end_clean();
        ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><?php echo $str ?></td>

                <td width="25" valign="top" align="left">
                    <div style="width:10px; height:25px; border-right:1px #333 solid"></div>
                </td>
                <td><?php echo $str ?></td>
                <td width="25" valign="top" align="left">
                    <div style="width:10px; height:25px; border-right:1px #333 solid"></div>
                </td>
                <td><?php echo $str ?></td>
            </tr>

            <tr>
                <td valign="top" align="left"><div style="width:25px; height:15px; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                <td valign="top" height="30" align="left"><div style="width:11px; height:15px; border-right:1px #333 solid; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                <td valign="top" height="1" align="right"><div style="width:25px; height:15px; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                <td valign="top" height="30" align="left"><div style="width:11px; height:15px; border-right:1px #333 solid; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                <td valign="top" height="1" align="right"><div style="width:25px; height:15px; border-bottom:1px #333 solid; overflow:hidden"></div></td>
            </tr>

            <tr>
                <td><?php echo $str ?></td>
                <td width="25" valign="top" align="left">
                    <div style="width:10px; height:25px; border-right:1px #333 solid"></div>
                </td>
                <td><?php echo $str ?></td>
                <td width="25" valign="top" align="left">
                    <div style="width:10px; height:25px; border-right:1px #333 solid"></div>
                </td>
                <td><?php echo $str ?></td>
            </tr>
        </table>

        <script type="text/javascript">
            window.onload = function(){window.print();}
        </script>
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