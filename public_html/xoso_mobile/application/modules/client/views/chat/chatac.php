<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo $_meta['description'] ?>" />
        <meta name="keywords" content="<?php echo $_meta['keywords'] ?>" />
        <title><?php echo $_meta['title'] ?></title>
		<?php
$url = $_SERVER["SCRIPT_URI"];
$url = str_replace('m.xoso.com', 'www.xoso.com', $url);
$url = str_replace('http://xoso.com', 'http://www.xoso.com', $url);
$url = preg_replace('/\.html.*$/is', '.html', $url);
$link_uri = $_SERVER["SCRIPT_URI"];

if(strpos($link_uri, 'dang-ky.html') === false){
	echo "<link rel=\"canonical\" href=\"".$url."\" />";
}  
echo "<link rel=\"alternate\" media=\"handheld\" href=\"".$url."\" />";
?>
        <meta property="og:image" content="<?php echo img_link('logo.png') ?>" />
        <link type="image/x-icon" href="<?php echo img_link('favicon.ico') ?>" rel="shortcut icon" />
        <meta name="google-site-verification" content="_MdXAARqGNM7C1GRrfqgrQg59dJuCGxL_3E4tJf_se0" />
        <link type="text/css" href="<?php echo css_link('chat.css') ?>" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo js_link('jquery-1.7.2.js') ?>"></script>
        <script type='text/javascript'>
            function pagemove(holderclass,pplist,next)
            {
                $('span.'+holderclass).each(function(index,object){
                    var total=$(object).find('a').length;
                    var lastvisible=parseInt($(object).find('a:visible:last').html())-1;
                    var firstvisible=parseInt($(object).find('a:visible:first').html())-1;
                    if(next&&lastvisible<total-1 || !next&&firstvisible>0)
                    $(object).find('a').each(function(i,obj)
                    {
                        if(next)
                            var toshow=i>lastvisible && i<=lastvisible+pplist;
                        else
                            var toshow=i<firstvisible && i>=firstvisible-pplist;
                        if(toshow)
                            $(obj).show();
                        else
                            $(obj).hide();
                    });
                });
            }
            var selectedids=[];
            function idfilterinit()
            {
                $("span.chatid").hover(function(e){
                    $(this).addClass('nick_hover');
                },
                function(){
                    $(this).removeClass('nick_hover');
                });
                $("span.chatid").click(function(e){
                    var thisid=$(this).attr('rel');
                    if(!inArray(thisid,selectedids))
                    {
                        $('span.chatid[rel='+thisid+']').addClass('nick_selected');
                        selectedids.push(thisid);
                    }
                    else
                    {
                        selectedids.splice(selectedids.indexOf(thisid),1);
                        $('span.chatid[rel='+thisid+']').removeClass('nick_selected');			
                    }
                    if(selectedids.length>0)
                    {
                        var tools='<a class=tool_button href="?y=<?php echo $year ?>&m=<?php echo $month ?>&d=<?php echo $day ?>&room=1&uf='+selectedids.join(',')+'" title="Xem tin nhắn của thành viên đã chọn">Lọc theo thành viên</a>';		
                        $('.toolbar').html(tools);
                    }
                    else
                        $('.toolbar').html('');
                });
            }
            var selectedmsgs=[];
            function msgselectinit()
            {
                $("div.chatmsgline").click(function(e){
                    var thisid=$(this).attr('id').replace("chatmsg_","");
                    if(!inArray(thisid,selectedmsgs))
                    {
                        $(this).addClass('msg_selected');
                        selectedmsgs.push(thisid);
                    }
                    else
                    {
                        selectedmsgs.splice(selectedmsgs.indexOf(thisid),1);
                        $(this).removeClass('msg_selected');
                    }
                    if(selectedmsgs.length>0)
                    {			
                        $('.admintoolbar').html('<a class=tool_button href="#" onclick="unselectmsgs(); return false">Unselect</a> <a class=tool_button href="#" onclick="deletemsgs(); return false">Delete</a>');
                    }
                    else
                        $('.admintoolbar').html('');
                }).dblclick(function(){msgselectall()});
            }
            function msgselectall()
            {
                selectedmsgs=[];
                $("div.chatmsgline").removeClass('msg_selected');
                $("div.chatmsgline").each(
                function()
                {
                    var thisid=$(this).attr('id').replace("chatmsg_","");
                    $(this).addClass('msg_selected');
                    selectedmsgs.push(thisid);
                    $(this).addClass('msg_selected');
                }
            );
                if(selectedmsgs.length>0)
                    $('.admintoolbar').html('<a class=tool_button href="#" onclick="unselectmsgs(); return false">Unselect</a> <a class=tool_button href="#" onclick="deletemsgs(); return false">Delete</a>');
                else
                    $('.admintoolbar').html('');
            }
            function unselectmsgs()
            {
                selectedmsgs=[];
                $('div.msg_selected').removeClass('msg_selected');
                $('.admintoolbar').html('');
            }
            function banuser()
            {
                if(selectedmsgs.length)
                {
                    $.ajax({url:"<?php echo $uri_root ?>chat-luu-tru.html?ban="+selectedids.join(','),
                        success:function(html)
                        {
                            if(html)
                            {		
                                var banned=eval('('+html+')');
                                if(banned.length)
                                {
                                    $('#button_ban').html('Unban');
                                    for(i in banned)
                                    {
                                        $('.chatid[rel='+i+']').addClass('banned');
                                    }
                                }
                            }
                        }
                    });
                }
            }
            function deletemsgs()
            {
                if(selectedmsgs.length)
                {
                    $('div.msg_selected').addClass('deleting');
                    $.ajax({url:"<?php echo $uri_root ?>chat-luu-tru.html?delete="+selectedmsgs.join(','),
                        success:function(html)
                        {
                            if(html=='ok')
                            {				
                                $('div.deleting').remove();
                                unselectmsgs();
                                $('.admintoolbar').html('');
                            }
                        }
                    });
                }
            }
            function inArray(needle, haystack) {
                var length = haystack.length;
                for(var i = 0; i < length; i++) {
                    if(haystack[i] == needle) return true;
                }
                return false;
            }
            $(document).ready(function(){idfilterinit()});
        </script>
        <style type="text/css">
            html,body{width:100%; margin:0; padding:0}
            *{font-family:arial; font-size:12px}
            a{text-decoration:none}
            #chatcontent{margin:7px 0; border-bottom:#C7C7C7 1px solid}
            .yearlist:link,.yearlist:visited,.yearlist:hover,.yearlist:active{display:inline-block; margin:2px; font-size:14px; text-decoration:none; color:#003FA6}
            .yearlist:hover,.yearlist:active{color:#FF6600}
            .year_active:link,.year_active:visited,.year_active:hover,.year_active:active{font-weight:bold; color:#7400D2}

            .monthlist:link,.monthlist:visited,.monthlist:hover,.monthlist:active{display:inline-block; margin:2px; font-size:14px; text-decoration:none; color:#003FA6}
            .monthlist:hover,.monthlist:active{color:#FF6600}
            .month_active:link,.month_active:visited,.month_active:hover,.month_active:active{font-weight:bold; color:#7400D2}

            .daylist:link,.daylist:visited,.daylist:hover,.daylist:active{display:inline-block; margin:2px; font-size:14px; text-decoration:none; color:#003FA6}
            .daylist:hover,.daylist:active{color:#FF6600}
            .day_active:link,.day_active:visited,.day_active:hover,.day_active:active{font-weight:bold; color:#7400D2}

            .msgtime{font-style:italic; color:#585858; font-size:11px}

            .paging:link,.paging:hover,.paging:active,.paging:visited{display:inline-block; font-size:12px; font-family:arial; padding:2px 4px; margin:3px; text-decoration:none;color:#737373; border:#DADADA 1px solid; background:#EEEEEE}
            .paging:active,.paging:hover{color:#3E3E3E; border:#CDCDCD 1px solid; background:#FCFCFC}
            .paging_on:link,.paging_on:visited,.paging_on:hover,.paging_on:active{color:#3E3E3E; border:#FF8B22 1px solid; background:#FFE4CC}
            .toolbar{display:inline-block}
            .chatmsgline{margin-bottom:1px}
            .nick_hover{background:#E0E3E4; border-radius:2px; -moz-border-radius:2px; -webkit-border-radius:2px}
            .chatmsgline .nick_selected{color:white; background:#666B73; border-radius:2px; -moz-border-radius:2px; -webkit-border-radius:2px}
            .msg_selected{background:#E9D5F0}
            .chatmsgline .banned{color:#838383; text-decoration:line-through}
            .chatmsg a:hover{color:#FF6600}
        </style>
    </head>
    <body>
        <div style='padding:5px; background:#f0f0f0; border-bottom:#cc3366 2px solid; font-size:14px; color:#3A3A3A'>
            <form action='' style='margin:0 0 5px 0'>
                <input type=hidden name=room value='1' />
                <input type=hidden name=uf value='' />Ngày 
                <select name=d>
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        $selected = '';
                        if ($i == $day)
                            $selected = ' selected="selected"';
                        echo "<option value='" . $i . "'" . $selected . ">" . $i . "</option>";
                    }
                    ?>
                </select> tháng 
                <select name=m>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        $selected = '';
                        if ($i == $month)
                            $selected = ' selected="selected"';
                        echo "<option value='" . $i . "'" . $selected . ">" . $i . "</option>";
                    }
                    ?>
                </select> năm 
                <select name=y>
                    <?php
                    for ($i = date('Y') - 2; $i <= date('Y'); $i++) {
                        $selected = '';
                        if ($i == $year)
                            $selected = ' selected="selected"';
                        echo "<option value='" . $i . "'" . $selected . ">" . $i . "</option>";
                    }
                    ?>
                </select> 
                <input type=submit value=' Xem ' />
            </form>
        </div>
        <?php if ($msgs) { ?>
            <?php if ($userids != '') { ?>
                <a class=tool_button style='margin:3px' href='?y=<?php echo $year ?>&m=<?php echo $month ?>&d=<?php echo $day ?>&room=1' title='Xem tin nhắn của tất cả thành viên'>Bỏ lọc thành viên</a>
            <?php } ?>
            <div style='margin-top:5px'>
                <a href='#' class=paging onclick='pagemove("pagingholder",5); return false'><<</a>
                <span  class='pagingholder' style='display:inline-block'>
                    <?php
                    for ($i = 1; $i <= $total_page; $i++) {
                        $class = '';
                        if ($i == $page)
                            $class = ' paging_on';
                        $style = '';
                        if ($total_page > 3 && $i <= $total_page - 3)
                            $style = " style='display:none'";
                        $uf = '';
                        if ($userids != '')
                            $uf = '&amp;uf=' . $userids;
                        echo "<a class='paging" . $class . "'" . $style . " href='?p=" . $i . "&amp;y=" . $year . "&amp;m=" . $month . "&amp;d=" . $day . "&amp;room=1" . $uf . "'>" . $i . "</a>";
                    }
                    ?>
                </span>
                <a href='#' class=paging onclick='pagemove("pagingholder",5,1); return false'>>></a> 
                <span class='toolbar'></span> 
                <span class='admintoolbar'></span>
            </div>
            <div id='chatcontent'>
                <?php
                $emoticons = array(
                    array(";;)", "5.gif", "mắt chớp chớp"),
                    array("&gt;:D&lt;", "6.gif", "ôm"),
                    array(":-/", "7.gif", "khó hiểu"),
                    array(":x", "8.gif", "kết rồi đấy"),
                    array(':"&gt;', "9.gif", "xấu hổ"),
                    array(":-*", "11.gif", "hôn"),
                    array("=((", "12.gif", "vỡ tim"),
                    array("B-)", "16.gif", "sành điệu"),
                    array("#:-S", "18.gif", "mệt quá"),
                    array("&gt;:)", "19.gif", "quỷ sứ"),
                    array(":((", "20.gif", "khóc nức nở"),
                    array(":))", "21.gif", "cười to"),
                    array("=))", "24.gif", "cười lăn lộn"),
                    array(":-c", "101.gif", "gọi điện"),
                    array("~X(", "102.gif", "vò đầu"),
                    array(":-h", "103.gif", "tạm biệt"),
                    array(":-t", "104.gif", "nhanh lên"),
                    array("8-&gt;", "105.gif", "mơ mộng"),
                    array("I-)", "28.gif", "ngủ rồi"),
                    array("8-|", "29.gif", "chịu thôi"),
                    array("(-(", "33.gif", "bó tay"),
                    array("8-}", "35.gif", "ngây dại"),
                    array("(:|", "37.gif", "ngáp"),
                    array("=P~", "38.gif", "nhỏ dãi"),
                    array("#-o", "40.gif", "ôi trời"),
                    array("=D&gt;", "41.gif", "hoan hô"),
                    array(":-SS", "42.gif", "ặc ặc"),
                    array("@-)", "43.gif", "thôi miên"),
                    array(":^o", "44.gif", "điêu"),
                    array(":-w", "45.gif", "đang chờ đây"),
                    array(":-&lt;", "46.gif", "thờ dài"),
                    array("&gt;:P", "47.gif", "ọe"),
                    array("X_X", "109.gif", "không dám nhìn"),
                    array(":!!", "110.gif", "muộn rồi"),
                    array(":m/", "111.gif", "phang mạnh vào"),
                    array(":-q", "112.gif", "không được"),
                    array(":-bd", "113.gif", "đồng ý 2 tay"),
                    array("^#(^", "114.gif", "không phải iem"),
                    array(":-??", "106.gif", "chẳng biết"),
                    array("%-(", "107.gif", "bịt tai"),
                    array(":@)", "49.gif", "lợn"),
                    array("3:-O", "50.gif", "bò"),
                    array(":(|)", "51.gif", "khỉ"),
                    array("~:&gt;", "52.gif", "gà"),
                    array("@};-", "53.gif", "hoa hồng"),
                    array("~O)", "57.gif", "cà fê"),
                    array("*-:)", "58.gif", "sáng kiến"),
                    array("8-X", "59.gif", "đầu lâu"),
                    array("(-O&lt;", "63.gif", "cầu trời phật"),
                    array("$-)", "64.gif", "nhìn thấy tiền"),
                    array(':-"', "65.gif", "huýt sáo"),
                    array("b-(", "66.gif", "đấm vào mặt"),
                    array(":)&gt;-", "67.gif", "chiến thắng"),
                    array("(-X", "68.gif", "không được đâu"),
                    array("\\:D/", "69.gif", "hí hửng"),
                    array("&gt;:/", "70.gif", "mang đây"),
                    array(";))", "71.gif", "cười khúc khích"),
                    array("^:)^", "77.gif", "xin lạy"),
                    array(":-j", "78.gif", "vô tư đi"),
                    array(":-$", "32.gif", "bí mật"),
                    array("(*)", "79.gif", "sao"),
                    array(":)", "1.gif", "cười mỉm"),
                    array(":(", "2.gif", "buồn chán"),
                    array(";)", "3.gif", "đá lông nheo"),
                    array(":D", "4.gif", "cười nhăn răng"),
                    array(":P", "10.gif", "lẽ lưỡi"),
                    array(":-O", "13.gif", "ngạc nhiên"),
                    array("X(", "14.gif", "tức giận"),
                    array(":&gt;", "15.gif", "tự tin"),
                    array(":-S", "17.gif", "lo lắng"),
                    array(":|", "22.gif", "nghiêm túc đấy"),
                    array(":-?", "39.gif", "suy nghĩ"),
                );

                foreach ($msgs as $item) {
                    $userid = ' id2';
                    if (isset($_SESSION['user']['id']) && $item->userid == $_SESSION['user']['id'])
                        $userid = ' id1';
                    $sms = preg_replace('/(\d{2,}(?=[^\w]|$))/i', '<span class=hlnum>$1</span>', $item->sms);

                    foreach ($emoticons as $value) {
                        $sms = str_replace($value[0], '<img class="emoticon" src="' . base_url() . 'public/client/images/emoticons/' . $value[1] . '" alt="(' . $value[2] . ')" title="' . $value[2] . '" />', $sms);
                    }
                    ?>
                    <div id='chatmsg_<?php echo $item->id ?>' class=chatmsgline><span title='Bấm vào' class='chatid<?php echo $userid ?>' rel='<?php echo $item->userid ?>'><?php echo $item->fullname ?></span><span class=msgtime>(<?php echo date('H:i:s', $item->created) ?>)</span> <span class=chatmsg><?php echo $sms ?></span></div>
                    <?php
                }
                ?>
            </div>
            <div style='margin-top:5px'>
                <a href='#' class=paging onclick='pagemove("pagingholder",5); return false'><<</a>
                <span  class='pagingholder' style='display:inline-block'>
                    <?php
                    for ($i = 1; $i <= $total_page; $i++) {
                        $class = '';
                        if ($i == $page)
                            $class = ' paging_on';
                        $style = '';
                        if ($total_page > 3 && $i <= $total_page - 3)
                            $style = " style='display:none'";
                        $uf = '';
                        if ($userids != '')
                            $uf = '&amp;uf=' . $userids;
                        echo "<a class='paging" . $class . "'" . $style . " href='?p=" . $i . "&amp;y=" . $year . "&amp;m=" . $month . "&amp;d=" . $day . "&amp;room=1" . $uf . "'>" . $i . "</a>";
                    }
                    ?>
                </span>
                <a href='#' class=paging onclick='pagemove("pagingholder",5,1); return false'>>></a> 
                <span class='toolbar'></span> 
                <span class='admintoolbar'></span>
            </div>
            <?php
            if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
                echo '<script type="text/javascript">msgselectinit();</script>';
            }
        } else {
            ?>
            <div style='; margin:5px; color:#696969'>Không có nội dung chat trong ngày <?php echo $day . '/' . $month . '/' . $year ?></div>
        <?php } ?>
        <div style='padding:10px; color:#515151'>&copy; 2014 <a href='/' style='text-decoration:none; color:#515151' title='XO SO KET QUA XO SO'>xoso.com</a></div>
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