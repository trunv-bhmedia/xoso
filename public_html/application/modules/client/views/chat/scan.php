<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Phân tích chu kỳ lô tô</title>
        <script type="text/javascript" src="<?php echo js_link('jquery-1.7.2.js') ?>"></script>
        <script type="text/javascript" src="<?php echo js_link('jquery-ui-1.8.23.custom.min.js') ?>"></script>
        <link type="text/css" href="<?php echo css_link('jquery-ui-1.8.23.custom.css') ?>" rel="stylesheet" />
        <script type="text/javascript">/*<![CDATA[*/var uri_root="<?php echo $uri_root ?>";/*]]>*/</script>
        <script type='text/javascript' src='<?php echo js_link('xoso.js') ?>'></script>
		<?php
$url = $_SERVER["SCRIPT_URI"];
$url = str_replace('m.xoso.com', 'www.xoso.com', $url);
$url2 = str_replace('www.xoso.com', 'm.xoso.com', $url);
$url2 = str_replace('http://xoso.com', 'http://m.xoso.com', $url2);
$url = str_replace('http://xoso.com', 'http://www.xoso.com', $url);
$url = preg_replace('/\.html.*$/is', '.html', $url);
echo "<link rel=\"canonical\" href=\"".$url."\" />";
echo "<link rel=\"alternate\" media=\"handheld\" href=\"".$url2."\" />";  
?> 
        <script type="text/javascript">
            var uid='<?php echo isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : '' ?>';
            var year = '<?php echo date('Y') ?>';        
            var staticdir='<?php echo $uri_root ?>';
        </script>
        <style type="text/css">
            html,body{margin:0;padding:0;height:100%}
            *{font-family:arial,sans-serif;font-size:12px}
            a:link,a:visited,a:hover,a:active{text-decoration:none;color:#0051ca}
            a:visited{color:#884270}
            a:active,a:hover{color:#ff8022}
            .button{font-size:12px;background-color:#157ee8;color:white;font-weight:bold;font-family:arial;border:#157ee8 1px solid;padding:2px;cursor:pointer;cursor:hand;border-radius;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px}
            .button:hover{background-color:#4b9def;border:#4b9def 1px solid}
            .scale{float:left;background:#f2f5f7;border-right:#cfdae2 1px solid;color:#6a8ba4;font-size:11px;text-align:right;overflow:hidden}
            .bar{background:#58b3fc;color:#1d1d1d;margin-top:10px;height:21px}
            .barmax{background:#ef7e3a}
            .bar b{color:#481500}
            .barlink:link{text-decoration:none;color:#001d48}
            .barlink:visited{text-decoration:none;color:#001d48}
            .barlink:active{text-decoration:none;color:#a45600}
            .barlink:hover{text-decoration:underline;color:#a45600}
            <?php if ($mode == 1) { ?>
                .scale{height:100%; width:58px; *width:59px}
            <?php } else { ?>
                .scale{height:100%; width:22px; *width:23px}
            <?php } ?>
            .bar_inner{position:absolute; width:552px; padding:3px}
        </style>
    </head>
    <body>
        <form action='<?php echo $uri_root ?>chat_scan?num=<?php echo $num ?>&amp;from=<?php echo $from ?>&amp;to=<?php echo $to ?>' method=post>
            Cặp số: <input class=input name=num value='<?php echo $num ?>' size=2 style='font-weight:bold' />
            Từ <input class=input type=text name=from id=from value='<?php echo date('d/m/Y', strtotime($from)) ?>' size=10 />
            đến <input class=input type=text name=to id=to value='<?php echo date('d/m/Y', strtotime($to)) ?>' size=10 />
            Min: <input class=input type=text name=min value='<?php echo $min ?>' size=2 title='Số ngày gan nhỏ nhất' />
            Mode:
            <select name="mode">
                <option value='0'<?php echo $mode == 0 ? ' selected' : '' ?>>Lô</option>
                <option value='1'<?php echo $mode == 1 ? ' selected' : '' ?>>Đề</option>
            </select>
            <input type=submit value='Thống kê' class=button />
        </form>
        <script type="text/javascript">
            picker("from");
            picker("to");
        </script>
        <?php
        if ($max_khoangcach > 0) {
            $max_rong = $max_khoangcach;
            if ($mode == 1)
                $max_rong = ceil($max_khoangcach / 20);

            $chieurong = 23;
            if ($mode == 1)
                $chieurong = 58;
            ?>
            <div style='position:relative; margin-top:10px; width:<?php echo $max_rong * $chieurong ?>px; height:<?php echo count($result) * 31 + 23 ?>px; border:#CFDAE2 1px solid; border-right:none; background:#F2F5F7; overflow:hidden'>
                <?php
                for ($i = 1; $i <= $max_rong; $i++) {
                    $j = $i;
                    if ($mode == 1)
                        $j = $i * 20;
                    echo '<div class=scale>' . $j . '</div>';
                }
                ?>
                <div style='position:absolute; top:0; left:0'>
                    <div style='height:8px; overflow:hidden'>&nbsp;</div>
                    <?php
                    foreach ($result as $value) {
                        if ($mode == 1)
                            $width = ceil($value->khoangcach / 20 * $chieurong);
                        else
                            $width = $value->khoangcach * $chieurong;
                        $class = '';
                        if ($value->khoangcach == $max_khoangcach)
                            $class = ' barmax';
                        echo "<div class='bar" . $class . "' style='width:" . $width . "px'><div class='bar_inner'><b>" . $value->khoangcach . "</b> ngày (từ <a class=barlink href='" . $uri_root . "xo-so-mien-bac/" . $value->from_date . ".html' target='_blank'>" . date('d/m/Y', strtotime($value->from_date)) . "</a> đến <a class=barlink href='" . $uri_root . "xo-so-mien-bac/" . $value->to_date . ".html' target='_blank'>" . date('d/m/Y', strtotime($value->to_date)) . "</a>)</div>&nbsp;</div>";
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
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