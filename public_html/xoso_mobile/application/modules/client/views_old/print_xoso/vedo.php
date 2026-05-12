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
            if ($lid == 2) {
                $title = 'Miền Trung';
                $class = 'bkqmientrung';
            } else {
                $title = 'Miền Nam';
                $class = 'bkqmiennam';
            }
            $item = $items[0];

            ob_start();
            ?>
            <div class="box_kqxs">
                <table align="center" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tr>
                        <td class="title">KẾT QUẢ XỔ SỐ <?php echo $title ?> - <?php echo $item->date ?></td>
                    </tr>
                    <tr>
                        <td class="topsms"><B><I>www.xoso.com </I></B></td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <div class="<?php echo $class ?>" >
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="80" valign="top">
                                            <table cellpadding="0" cellspacing="0" class="leftcl" width="100%">
                                                <tr>
                                                    <td class="thu"><?php echo $item->dateOfWeek ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ngay"><?php echo $item->date ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="giai8">Giải 8</td>
                                                </tr>
                                                <tr>
                                                    <td class="giai7">Giải 7</td>
                                                </tr>
                                                <tr>
                                                    <td class="giai6">Giải 6</td>
                                                </tr>
                                                <tr>
                                                    <td class="giai5">Giải 5</td>
                                                </tr>
                                                <tr>
                                                    <td class="giai4">Giải 4</td>
                                                </tr>
                                                <tr>
                                                    <td class="giai3">Giải 3</td>
                                                </tr>
                                                <tr>
                                                    <td class="giai2">Giải 2</td>
                                                </tr>
                                                <tr>
                                                    <td class="giai1">Giải 1</td>
                                                </tr>
                                                <tr>
                                                    <td class="giaidb"><strong>ĐB</strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td valign="top">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <?php
                                                    $cols = count($items);
                                                    $phantram = round(100 / $cols, 2);
                                                    foreach ($items as $item) {
                                                        ?>
                                                        <td valign="top" width="<?php echo $phantram ?>%">
                                                            <table cellpadding="0" cellspacing="0" class="rightcl" width="100%">
                                                                <tr>
                                                                    <td class="tinh">
                                                                        <?php
                                                                        if ($item->code == 'HCM')
                                                                            echo 'TP. HCM';
                                                                        else
                                                                            echo $item->name;
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="matinh"><?php echo $item->code ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="giai8"><div><?php echo $item->a8 ?></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="giai7"><div><?php echo $item->a7 ?></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="giai6"><div><?php echo str_replace('-', '</div><div>', $item->a6) ?></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="giai5"><div><?php echo $item->a5 ?></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="giai4"><div><?php echo str_replace('-', '</div><div>', $item->a4) ?></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="giai3"><div><?php echo str_replace('-', '</div><div>', $item->a3) ?></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="giai2"><div><?php echo $item->a2 ?></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="giai1"><div><?php echo $item->a1 ?></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="giaidb"><div><?php echo $item->a0 ?></div></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bottom" style="text-align: center" valign="top"><span class="vdbottom">wWw.XOSO.Com</span></td>
                    </tr>
                </table>
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
    </body>
</html>