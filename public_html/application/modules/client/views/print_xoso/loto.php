<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo(isset($_meta['description']) ? $_meta['description'] : ''); ?>" />
        <meta name="keywords" content="<?php echo(isset($_meta['keywords']) ? $_meta['keywords'] : ''); ?>" />
        <title><?php echo(isset($_meta['title']) ? $_meta['title'] : ''); ?></title>
        <link type="image/x-icon" href="<?php echo img_link('favicon.ico'); ?>" rel="shortcut icon" />
        <link href="<?php echo css_link('loto.css') ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
        if ($items) {
            if ($lid == 2) {
                $title = 'Miền Trung';
                $class = 'bkqmientrung';
            } else {
                $title = 'Miền Nam';
                $class = 'bkqmiennam';
            }
            foreach ($items as $value) {
                $items = $value;
                $item = $items[0];
                break;
            }
            ob_start();
            ?>
            <div class="box_kqxs">
                <table align="center" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tr>
                        <td class="title">KẾT QUẢ XỔ SỐ <?php echo $title ?> - <?php echo $item->date ?></td>
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
                                                    $title_loto = '';
                                                    $i = 0;
                                                    $extra = array();
                                                    foreach ($items as $i => $item) {
                                                        $class_loto = '';

                                                        if ($i + 1 != $cols)
                                                            $class_loto = ' border-right ';
                                                        else
                                                            $class_loto = ' last';

                                                        $title_loto .= '<th class="t-cen' . $class_loto . '" colspan="6"><span>' . $item->name . '</span></th>';

                                                        $item->extra = json_decode($item->extension);
                                                        for ($j = 0; $j <= 9; $j++)
                                                            $extra[$i + 1][$j] = $item->extra[$j];
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
                        <td>
                            <div class="title_loto">Xem kết quả Loto <?php echo $item->dateOfWeek ?> ngày <?php echo $item->date ?></div>
                            <table class="tbl-xs">
                                <tr>
                                    <?php echo $title_loto ?>
                                </tr>
                                <tr>
                                    <?php
                                    for ($i = 0; $i < $cols; $i++) {
                                        $class = '';
                                        if ($i + 1 != $cols)
                                            $class = ' border-right';
                                        ?>
                                        <td class="bg-gray t-cen border-right" width="18"><strong>Số</strong></td>
                                        <td class="t-cen border-right" colspan="2">Đơn vị</td>
                                        <td class="bg-gray t-cen border-right" width="18"><strong>Số</strong></td>
                                        <td class="t-cen<?php echo $class ?>" colspan="2">Đơn vị</td>
                                    <?php } ?>
                                </tr>
                                <?php for ($i = 0; $i < 5; $i++) { ?>
                                    <tr>
                                        <?php
                                        for ($j = 1; $j <= $cols; $j++) {
                                            $class = '';
                                            if ($j != $cols)
                                                $class = ' border-right';
                                            ?>
                                            <td class="bg-gray t-cen border-right" width="18"><strong><strong class="red"><?php echo $i ?></strong></strong></td>
                                            <td class="t-cen border-right" colspan="2"><?php echo $extra[$j][$i] ?></td>
                                            <td class="bg-gray t-cen border-right" width="18"><strong><strong class="red"><?php echo $i+5 ?></strong></strong></td>
                                            <td class="t-cen<?php echo $class ?>" colspan="2"><?php echo $extra[$j][$i+5] ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="bottom" style="text-align: center" valign="top"><span class="vdbottom">xoso.com</span></td>
                    </tr>
                </table>
            </div>
            <?php
            $str = ob_get_contents();
            ob_end_clean();
            ?>
            <table border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                    <td><?php echo $str ?></td>
                </tr>
            </table>
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