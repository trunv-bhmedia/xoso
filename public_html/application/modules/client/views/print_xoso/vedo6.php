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
        if ($lid == 2) {
            $title = 'Miền Trung';
        } else {
            $title = 'Miền Nam';
        }
        foreach ($items as $value) {
            $items = $value;
            $item = $items[0];
            break;
        }
        ob_start();
        ?>
        <table class="zebra" style="width:235px;">
            <thead>
                <tr>
                    <td colspan="<?php echo count($items) + 1 ?>" align="center">
                        <div style="font-size:14px; display:block; padding-top:3px;"><b>xoso.com</b></div>
                        <div style="font-size:12px;text-align:center">Kết Quả Xổ Số <?php echo $title ?> - <span><b><?php echo $item->date ?></b></span></div>
                    </td>
                </tr>
                <tr align="center" style="font-size:10px;line-height:18px;">
                    <td width="30px" rowspan="2"><?php echo $item->dateOfWeek ?></td>
                    <?php
                    $str_code = '';
                    $a8 = '';
                    $a7 = '';
                    $a6 = '';
                    $a5 = '';
                    $a4 = '';
                    $a3 = '';
                    $a2 = '';
                    $a1 = '';
                    $a0 = '';
                    $total = 0;
                    foreach ($items as $item) {
                        $total++;
                        if ($item->name == 'Tp. Hồ Chí Minh')
                            $item->name = 'TP. HCM';
                        if (count($items) == 4)
                            $item->name = str_replace(array('Bình', 'Hậu'), array('B.', 'H.'), $item->name);
                        echo '<td><b>' . $item->name . '</b></td>';
                        $str_code = $str_code . '<td>' . $item->code . '</td>';
                        $a8 = $a8 . '<td class="giai_tam">' . $item->a8 . '</td>';
                        $a7 = $a7 . '<td class="giai_bay">' . $item->a7 . '</td>';
                        $a6 = $a6 . '<td class="giai_sau">' . str_replace('-', '<br/>', $item->a6) . '</td>';
                        $a5 = $a5 . '<td class="giai_nam">' . $item->a5 . '</td>';
                        $a4 = $a4 . '<td class="giai_tu">' . str_replace('-', '<br/>', $item->a4) . '</td>';
                        $a3 = $a3 . '<td class="giai_ba">' . str_replace('-', '<br/>', $item->a3) . '</td>';
                        $a2 = $a2 . '<td class="giai_nhi">' . $item->a2 . '</td>';
                        $a1 = $a1 . '<td class="giai_nhat">' . $item->a1 . '</td>';
                        $a0 = $a0 . '<td class="giai_dac_biet">' . $item->a0 . '</td>';
                    }
                    ?>
                </tr>
                <tr align="center" style="font-size:12px;line-height:10px;">
                    <?php echo $str_code ?>
                </tr>
            </thead>
            <tbody>
                <tr align="center">
                    <td class="ten_giai_tam">Giải 8</td>
                    <?php echo $a8 ?>
                </tr>
                <tr align="center">
                    <td class="ten_giai_bay">Giải 7</td>
                    <?php echo $a7 ?>
                </tr>
                <tr align="center">
                    <td class="ten_giai_sau">Giải 6</td>
                    <?php echo $a6 ?>
                </tr>
                <tr align="center">
                    <td class="ten_giai_nam">Giải 5</td>
                    <?php echo $a5 ?>
                </tr>
                <tr align="center">
                    <td class="ten_giai_tu">Giải 4</td>
                    <?php echo $a4 ?>
                </tr>
                <tr align="center">
                    <td class="ten_giai_ba">Giải 3</td>
                    <?php echo $a3 ?>
                </tr>
                <tr align="center">
                    <td class="ten_giai_nhi">Giải 2</td>
                    <?php echo $a2 ?>
                </tr>
                <tr align="center">
                    <td class="ten_giai_nhat">Giải 1</td>
                    <?php echo $a1 ?>
                </tr>
                <tr align="center">
                    <td class="ten_giai_dac_biet">ĐB</td>
                    <?php echo $a0 ?>
                </tr>
            </tbody>
        </table>
        <p style="text-align:center;font-style:italic; margin:0; border:1px solid; font-weight: bold; font-family:'Times New Roman', Times, serif;">xoso.com</p>
        <?php
        $str = ob_get_contents();
        ob_end_clean();

        if ($total == 4) {
            ?>
            <style type="text/css">
                .giai_dac_biet {
                    font-size:14px !important;
                    line-height: 125% !important;
                }
                .giai_tam {
                    font-size:25px !important;
                    line-height: 110% !important;
                }
                .giai_bay {
                    font-size:16px !important;
                    line-height: 125% !important;
                }
                .giai_sau {
                    font-size:16px !important;
                    line-height: 125% !important;
                }
                .giai_nam {
                    font-size:16px !important;
                    line-height: 125% !important;
                }
                .giai_tu {
                    font-size:16px !important;
                    line-height: 125% !important;	
                }
                .giai_ba {
                    font-size:16px !important;
                    line-height: 125% !important;	
                }
                .giai_nhi {
                    font-size:16px !important;
                    line-height: 125% !important;	
                }
                .giai_nhat {
                    font-size:16px !important;
                    line-height: 125% !important;	
                }
            </style>
            <?php
        }
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