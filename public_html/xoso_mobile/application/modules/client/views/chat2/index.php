<link type="text/css" href="<?php echo css_link('chat.css') ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo js_link('jquery-ui-1.8.23.custom.min.js') ?>"></script>
<link type="text/css" href="<?php echo css_link('jquery-ui-1.8.23.custom.css') ?>" rel="stylesheet" />
<script type='text/javascript' src='<?php echo js_link('clock.js') ?>'></script>
<script type='text/javascript'>
    var year = '<?php echo date('Y') ?>';
    var month = '<?php echo date('m') ?>';
    var day = '<?php echo date('d') ?>';
    var hours = '<?php echo date('H') ?>';
    var minutes = '<?php echo date('i') ?>';
    var seconds = '<?php echo date('s') ?>';
    var ngay = '';
    var date = new Date(year, month - 1, day, hours, minutes, seconds);
    var weekday = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
    clock();
    setTimeout('timesync(1800000)', 1800000);
</script>
<script type='text/javascript' src='<?php echo js_link('xoso.js') ?>'></script>
<script type="text/javascript">
    //var uid='<?php //echo isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''  ?>';
    var year = '<?php echo date('Y') ?>';
    var staticdir = '<?php echo $uri_root ?>';
</script>
<script type='text/javascript' src='<?php echo js_link('swfobject.js') ?>'></script>    
<style type="text/css">
    .closebutton:link,.closebutton:visited,.closebutton:hover,.closebutton:active{position:absolute;top:3px;right:3px;z-index:3;display:inline-block;width:15px;height:15px;background:url('<?php echo $uri_root ?>public/client/images/close.png') no-repeat scroll 0 -16px transparent;overflow:hidden}
    .closebutton:hover{background-position:0 -32px}
    input[type="text"]{padding:2px;height:15px;line-height:15px;font-family:arial,sans-serif}
    input[type="submit"]{cursor:pointer;font-family:arial,sans-serif}
    .msg {
        background: none repeat scroll 0 0 #f8ffea;
        border: 1px solid #b4eb41;
        color: #434600;
        display: inline-block;
        margin: 5px 0;
        padding: 5px;
    }
    .deletebutton:link, .deletebutton:visited, .deletebutton:hover, .deletebutton:active {
        background: url("<?php echo $uri_root ?>public/client/images/delete.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
        display: inline-block;
        height: 20px;
        overflow: hidden;
        position: absolute;
        right: -5px;
        top: -5px;
        width: 20px;
        z-index: 3;
    }

    .bet{float:left; border:#cdcdcd 1px solid; background:#f2f2f2; margin:5px; padding:2px 4px; font-size:12px; font-weight:bold; color:#333; position:relative; z-index:0; cursor:default}
    .bet_hover{border-color:#FF9E46}
    .betnum{font-size:18px; font-weight:bold; color:#bc1c18;line-height:22px}
    .bet_value{font-size:12px; font-weight:bold; color:#7101AD}
    .hilight{background:#FFE3AA}
    .selected{background:#d5d5d5; border-color:#cdcdcd}
    .trung{background:#fded93}
    .trung .nhay{position:absolute; top:-5px; right:-3px; z-index:2; background:red; color:white; padding:0 3px 0 3px; font-size:12px}
    .tool{position:absolute; top:-5px; right:-3px; z-index:3}
    #lichsu{width:560px;height:550px; overflow:auto}
    .lichsu{margin:5px 25px 5px 5px; border-collapse:collapse;width:530px}
    .lichsu th,.lichsu td{border:#cdcdcd 1px solid; text-align:center; font-size:13px;padding:5px}
    .lichsu th{background:#d5d5d5; color:#333; font-size:12px}
    .lichsu_lastrow td{background:#E6E6E6; font-weight:bold}

    .tbl_dangtheo{ margin:5px 30px 5px 5px; border-collapse:collapse}
    .tbl_dangtheo th,.tbl_dangtheo td{text-align:center; font-size:13px; font-weight:bold; border:#A8BEDF 1px solid}
    .tbl_dangtheo th{background:#CADDF9; color:#12499C; font-size:12px}
    .tbl_dangtheo .num{font-size:16px; color:#AA0088}
    .tbl_dangtheo .diemhoa{color:#008000}

    .pos{color:#00A000}
    .neg{color:#EE0000}

    .betnum_ls:link{text-decoration:none; color:#710196 !important; font-size:13px; font-weight:bold}
    .betnum_ls:visited{text-decoration:none; color:#710196 !important; font-size:13px; font-weight:bold}
    .betnum_ls:active{text-decoration:none; color:#FFA722 !important; font-size:13px; font-weight:bold}
    .betnum_ls:hover{text-decoration:none; color:#E67800 !important; font-size:13px; font-weight:bold}
</style>
<script type='text/javascript' src='<?php echo js_link('bet.js') ?>'></script>
<script type='text/javascript'>
    var betlimit = 2000;
    //var curruser='<?php //echo isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : ''  ?>';
    var editrestrict = true;
    var ngaybet = '<?php echo $date_loto ?>';
    var balance = 0;
    var balancedate = '';
    var diem = 0;
    var diemthang = 0;
    var tt = 0;
    var nextday = '<?php echo $nextday_loto ?>';
    loadImg("<?php echo img_link('delete.png') ?>");
    loadImg("<?php echo img_link('loading5.gif') ?>");
    loadImg("<?php echo img_link('loading6.gif') ?>");
</script>


<div class="mod-module">
    
<div class="topbox" style="margin-top:0;font-size:11px">
    <div class="contentbox_header" style='background: url("<?php echo $uri_root ?>public/client/images/box_top_bg.gif") repeat-x scroll 0 0 rgba(0, 0, 0, 0);height:38px;line-height:38px;margin:0 1px;position:relative'>
        <span class=coins>&nbsp;</span> <span style='text-shadow:1px 1px #bfbfbf; color:#ab1714;position:absolute; bottom:0; left:30px; display:inline-block; font-weight:bold'>Bảng xếp hạng theo tuần</span>
    </div>
    <div id="lototop_result" style='border-top:1px solid #ddd;height:240px; overflow:auto; *position:relative'>
        <table class=toptbl cellspacing=1 cellpadding=3>
            <?php
            if ($loto_top_tuan) {
                foreach ($loto_top_tuan as $i => $item) {
                    ?>
                    <tr rel='<?php echo $item['userid'] ?>'>
                        <td class=ord><?php echo $i + 1 ?></td>
                        <td class=name rel='<?php echo $item['fullname'] ?>'>
                            <div style="width:80px;font-weight:400"><?php echo $item['fullname'] ?></div>
                        </td>
                        <td class=balance><?php echo number_format($item['taikhoan'], 0, '.', '.') ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>

<div class="topbox" style="font-size:11px">
    <div class="contentbox_header lototop_thang_header" style='background: url("<?php echo $uri_root ?>public/client/images/box_top_bg.gif") repeat-x scroll 0 0 rgba(0, 0, 0, 0);height:38px;line-height:38px;margin:0 1px;position:relative'>
        <span class=coins>&nbsp;</span> <a href="javascript:;" id="lototop_thang_title" style='text-shadow:1px 1px #bfbfbf; color:#ab1714;position:absolute; bottom:0; left:30px; display:inline-block; font-weight:bold'>Bảng xếp hạng theo tháng</a>
    </div>
    <div id="lototop_thang_result" style='border-top:1px solid #ddd;height:0; overflow:auto; *position:relative'>
        <table class=toptbl cellspacing=1 cellpadding=3>
            <?php
            if ($loto_top_thang) {
                foreach ($loto_top_thang as $i => $item) {
                    ?>
                    <tr rel='<?php echo $item['userid'] ?>'>
                        <td class=ord><?php echo $i + 1 ?></td>
                        <td class=name rel='<?php echo $item['fullname'] ?>'>
                            <div style="width:80px;font-weight:400"><?php echo $item['fullname'] ?></div>
                        </td>
                        <td class=balance><?php echo number_format($item['taikhoan'], 0, '.', '.') ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
<script type="text/javascript">
    function lototop_thangpopup(){
            $('#lototop_thang_result').animate({'height':240});
        clearTimeout(window.notiPopdownTimeout);
    }
    function lototop_thangdown(){
        $('#lototop_thang_result').animate({'height':0});
    }
    $('#lototop_thang_title').click(function(){
        if($(this).hasClass('lototop_thang_active')){		
            $(this).removeClass('lototop_thang_active');
            lototop_thangdown();
        }else{
            $('.lototop_thang_active').removeClass('lototop_thang_active');
            $(this).addClass('lototop_thang_active');
            lototop_thangpopup();
        }
    });
</script>

<div class="topbox" style="font-size:11px">
    <div class="topdaigia_header" style='background: url("<?php echo $uri_root ?>public/client/images/box_top_bg.gif") repeat-x scroll 0 0 rgba(0, 0, 0, 0);height:38px;line-height:38px;margin:0 1px;position:relative'>
        <span class=coins>&nbsp;</span> <a href="javascript:;" id="topdaigia" style='cursor:pointer;text-shadow:1px 1px #bfbfbf; color:#ab1714;position:absolute; bottom:0; left:30px; display:inline-block; font-weight:bold'>Top Đại gia Lotto online</a><span id='toplisthelp' class='tip' style='position:absolute; right:8px; top:8px' rel='Top đại gia Lotto online là danh sách 50 người có tài khoản lotto cao nhất'><span class='questiontip'>&nbsp;</span></span>
    </div>
    <div id="topdaigia_result" style='border-top:1px solid #ddd;height:0; overflow:auto; *position:relative'>
        <table class=toptbl cellspacing=1 cellpadding=3>
            <?php
            if ($topdaigia) {
                foreach ($topdaigia as $i => $item) {
                    ?>
                    <tr rel='<?php echo $item['id'] ?>'>
                        <td class=ord><?php echo $i + 1 ?></td>
                        <td class=name rel='<?php echo $item['fullname'] ?>'>
                            <div style="width:80px;font-weight:400"><?php echo $item['fullname'] ?></div>
                        </td>
                        <td class=balance><?php echo number_format($item['taikhoan'], 0, '.', '.') ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
    <script type="text/javascript">
        function topdaigiapopup(){
            $('#topdaigia_result').animate({'height':240});
            clearTimeout(window.notiPopdownTimeout);
        }
        function topdaigiadown(){
            $('#topdaigia_result').animate({'height':0});
        }
        $('#topdaigia').click(function(){
            if($(this).hasClass('topdaigia_active')){		
                $(this).removeClass('topdaigia_active');
                topdaigiadown();
            }else{
                $('.topdaigia_active').removeClass('topdaigia_active');
                $(this).addClass('topdaigia_active');
                topdaigiapopup();
            }
        });
    </script>
</div>
<script type='text/javascript'>hovertip('#toplisthelp', 1)</script>
<style type="text/css">
    .coins{position:absolute; bottom:0; left:4px; width:23px; height:30px; background:url(<?php echo $uri_root ?>public/client/images/coins.png) no-repeat; overflow:hidden; display:inline-block; *background-image:none; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo $uri_root ?>public/client/images/coins.png, sizingMethod=scale)}
    .topbox{margin:5px 0; text-align:left; border:#ddd 1px solid}
    .toptbl{background:white; border-spacing:1px}
    .toptbl .ord{width:20px; background:#EAEAEA}
    .toptbl .name{background:#f0f0c3}
    .toptbl .name div{color:#069; font-weight:bold; width:215px; overflow:hidden}
    .toptbl .name_hover{background:#DEDFA7; cursor:pointer;border-radius:0;-moz-border-radius:0px;-webkit-border-radius:0px}
    .toptbl .balance{background:#ffef93; color:#008000; font-weight:bold}
    .toptbl .balance_hover{background:#EFDC77}
    .toptbl td{padding:4px}
    .lototop_thang_header a:hover,.topdaigia_header a:hover{left:32px !important}
</style>
<script type="text/javascript">
    $('.toptbl tr').hover(function(){
        $(this).find('.name').addClass('name_hover');
        $(this).find('.balance').addClass('balance_hover');
    },
    function(){
        $(this).find('.name').removeClass('name_hover');
        $(this).find('.balance').removeClass('balance_hover');
    });

    $('.toptbl td.name').click(function(){
        var receiver=$(this).parent().attr('rel');
        receiverName=$(this).find('div').html();
        ppchatInit(receiver,receiverName,0,1);
    });
    hovertip('.toptbl td.name');
</script>

</div>


<h1 style="position: absolute; text-indent: -99999px">Dự đoán kết quả Xổ Số</h1>
<div class="page-title-xs"><strong>Dự đoán kết quả Xổ Số</strong></div>
<div style="margin:5px">
<div style='margin:0 0 5px; font-size:14px; color:#013FA5'>Bạn thích cặp số nào hôm nay?</div>
<form id=betform name=betform action='' onsubmit='return betformsubmit()' style='font-size:13px; font-weight:bold; color:#353535; padding:3px; margin-bottom:5px'>
    <input type=hidden size=8 id=ngay name=ngay style='font-size:12px; color:#8B2001' value='<?php echo date('d/m/Y', strtotime($date_loto)) ?>' />
    <table style="border-spacing:2px;width:285px">
        <tr>
            <td>Cặp số: </td>
            <td colspan="2"><input type=text size=10 name=range style='font-size:15px; font-weight:bold; color:#bc1c18;width:154px' title='Có thể nhập nhiều cặp số, cách nhau bằng dấu phẩy' /></td>
        </tr>
        <tr>
            <td>Số điểm: </td>
            <td><input type=text size=6 name=bet style='font-size:15px; font-weight:bold; color:#62018B' /></td>
            <td><input type=submit name='betsubmit' value='   Ghi   ' style='font-size:15px; font-weight:bold; color:#01468B;background-color: #b8100d;background-image: linear-gradient(to bottom, #b8100d, #960501);border: #980804 1px solid;color: #f1f4f8;font-weight:bold; font-size:12px;font-family:arial,sans-serif;height:23px;padding:0 10px;border-radius: 3px;-moz-border-radius: 3px;-webkit-border-radius: 3px' /></td>
        </tr>
    </table>
</form>
<div id="loadbettb"></div>
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function(){
            $(".hello").html('Xin chào:<br/><strong>'+curruser+'</strong>');
            if(uid!=''){
                $("#loadbettb").html('<div style="border-top:1px solid #e1e1e1;padding-top:2px;margin-top:5px;font-size:13px; color:#333; font-weight:bold; text-align:center; margin-bottom:5px">Tài khoản hiện có: <span id="taikhoanloto">0</span> k</div>'
                +'<div id="betarea" style="border:#cdcdcd 1px solid; display:none">'
                    +'<div>'
                        +'<a name="betplace"></a>'
                        +'<div style="display:none;font-size:13px;font-weight:bold;line-height:25px">'
                            +'Điểm:&nbsp;<span id="tongdiem" style="padding:3px; background:#616A89; color:white">--</span>'
                            +'Chi:&nbsp;<span id="tongchi" style="padding:3px; background:#616A89; color:white">--</span>'
                            +'Nhận:&nbsp;<span id="tongnhan" style="padding:3px; background:#0052CC; color:white">--</span>'
                            +'Lãi-lỗ:&nbsp;<span id="thangthua" style="padding:3px; background:#616A89; color:white">--</span>'
                        +'</div>'
                        +'<div style="clear:both"></div>'
                    +'</div>'
                    +'<div id="betcontainer"></div>'	
                    +'<div style="clear:both"></div>'
                +'</div>');
                betupdate(1);
                $("#taikhoanloto").html(taikhoan);
            }
        },1000); 
    });
</script>
</div>
<div style='clear:both'></div>

<style type="text/css">
    #notipanel{position:fixed; *position:absolute; z-index:1100; bottom:0; right:10px; background:#fff; width:240px; overflow:hidden; border:#ce5b75 1px solid; border-bottom:none; box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3); -webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);	-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3)}
    #notipanel_head{height:23px; background:#ce5b75; color:white; font-weight:bold; overflow:hidden}
    #noticontentholder{max-height:200px; overflow:auto}
    .popbutton{display:inline-block; width:16px; height:10px; background:url('<?php echo $uri_root ?>public/client/images/up2.png') no-repeat scroll 0 0 transparent; cursor:pointer; *cursor:hand; overflow:hidden}
    .popbuttondown{background-image:url('<?php echo $uri_root ?>public/client/images/down2.png')}
    .pop_button_hover{background-position:0 -10px}
    .noti_icon{display:inline-block; padding:2px 5px; border:#ce5b75 1px solid; margin:2px 2px 0 2px; cursor:pointer; *cursor:hand; position:relative}
    .noti_icon_hover{border:#ce5b75 1px solid; background:#ce5b75}
    .noti_icon_active{border:#ce5b75 1px solid; background:#ce5b75; border:#ce5b75 1px solid; border-bottom:none}
    .noti_line{padding:3px; color:#525252; font-size:11px; font-family:tahoma,arial; border-bottom:#EBEFFC 1px solid}
    .noti_line div{font-size:11px; font-family:tahoma,arial}
    .noti_line_new{background:#FFF2C6}
    .noti_line_hover{background:#FFFFFF; color:#404040}
    .noticontent{display:none}
    .notinumber{background:red; color:white; font-family:verdana; font-size:10px; font-weight:bold; position:absolute; z-index:50; bottom:10px; left:16px; display:inline-block; padding:1px 2px}

    .floatnotify{position:fixed; *position:absolute; z-index:2000; bottom:100px; right:50px; background:#C6DFFF; color:#0F3D75; padding:8px; opacity:.8; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=80)"; filter:alpha(opacity=80); -moz-opacity:.8}
</style>
<div id='notipanel' style='display:none'>
    <div id='notipanel_head'>
        <div style='float:left'>
            <span rel='info' class='noti_icon info_sw' style="display:none"><img src='<?php echo $uri_root ?>public/client/images/information_balloon.png' /></span>
            <span rel='friend' class='noti_icon friend_sw' style="display:none"><img src='<?php echo $uri_root ?>public/client/images/friend.png' /></span>
            <span rel='msg' class='noti_icon chat_sw' style="width:222px"><img src='<?php echo $uri_root ?>public/client/images/msg.png' /></span>
        </div>
        <!--<div class='popbutton' style='float:right; margin:6px 4px 0 0'>&nbsp;</div>-->
    </div>
    <div id='noticontentslider' style='height:0'>
        <div id='noticontentholder'>
            <div id='info_noticontent' class='noticontent'></div>
            <div id='friend_noticontent' class='noticontent'></div>
            <div id='msg_noticontent' class='noticontent'><div id='chatlistholder'></div></div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    function floatnotify(content) {
        var bottom = 100 + Math.floor(Math.random() * 150);
        var right = 20;
        var noti = $('<div class="floatnotify" style="bottom:' + bottom + 'px; right:' + right + 'px"></div>');
        noti.append(content);
        setTimeout(function () {
            noti.fadeOut('slow', function () {
                $(this).remove()
            })
        }, 5000);
        notimove(noti, 100);
        $('body').append(noti);
    }
    function notimove(noti, distant) {
        var currheight = parseInt(noti.css('bottom'));
        noti.css('bottom', (currheight + 1) + 'px');
        distant = distant - 1;
        if (distant > 0)
            setTimeout(function () {
                notimove(noti, distant)
            }, 70);

    }
    function rednumClear(group) {
        $('.noti_icon[rel=' + group + ']').find('.notinumber').remove();
    }
    function notify(noti, group, pop) {
        if (!group)
            group = 'info';
        if ($('#notipanel').css('display') == 'none') {
            $('#notipanel').css('height', "1px");
            $('#notipanel').css('display', 'block');
        }
        var line = $('<div class="noti_line noti_line_new"></div>');
        line.append($(noti));
        line.hover(function () {
            $(this).addClass('noti_line_hover')
        }, function () {
            $(this).removeClass('noti_line_hover')
        });
        line.click(function () {
            rednumClear(group);
            $(this).removeClass('noti_line_new')
        });
        $('#' + group + '_noticontent').prepend(line);
        if (pop) {
            $('.noticontent').hide();
            $('#' + group + '_noticontent').show();
            $('.noti_icon_active').removeClass('noti_icon_active');
            $('.noti_icon[rel=' + group + ']').addClass('noti_icon_active');
            notipopup();
            window.notiPopdownTimeout = setTimeout(function () {
                notipopdown();
                $('.noti_icon[rel=' + group + ']').removeClass('noti_icon_active')
            }, 5000);
        } else {
            var notinumber = $('.noti_icon[rel=' + group + ']').find('.notinumber');
            if (notinumber.length) {
                var currnum = $('.noti_icon.' + group + '_sw').find('.notinumber').html();
                currnum = currnum * 1 + 1;
                notinumber.html(currnum);
            } else {
                var notinumber = $("<span class=notinumber>1</span>");
                $('.noti_icon.' + group + '_sw').append(notinumber);
            }
        }
    }
    function notipopup() {
        $('#noticontentslider').animate({'height': $('#noticontentholder').height()});
        clearTimeout(window.notiPopdownTimeout);
    }
    function notipopdown() {
        $('#noticontentslider').animate({'height': 0});
    }
    $('.noti_icon').click(function () {
        if ($(this).hasClass('noti_icon_active')) {
            $(this).removeClass('noti_icon_active');
            notipopdown();
        } else {
            $('.noticontent').hide();
            $('#' + $(this).attr('rel') + '_noticontent').show();
            $('.noti_icon_active').removeClass('noti_icon_active');
            $(this).addClass('noti_icon_active');
            rednumClear($(this).attr('rel'));
            notipopup();
        }
    });
</script>
<style type="text/css">
    div.a_noiquy a:link,div.a_noiquy a:visited,div.a_noiquy a:hover,div.a_noiquy a:active {text-decoration: none;color: #b10e0d}
    div.a_noiquy a:visited {color: #884270}
    div.a_noiquy a:active,div.a_noiquy a:hover {color: #ff8022}
    .conver{padding:4px}
    .conver .remotename{color:#ac3b56; font-weight:bold; font-size:12px}
    .conver .msgcontent{color:#333; font-size:11px; padding:3px 0; font-family:tahoma}
    .conver .msgtime{color:#838383; font-size:11px; font-family:tahoma}
    .conver_hover{background:#EFEDE7; cursor:pointer}
    .repmark{display:inline-block; width:10px; height:10px; overflow:hidden; background:url('<?php echo $uri_root ?>public/client/images/icons.png') scroll no-repeat -139px -41px}
</style>
<script type='text/javascript'>
    var convercount = 0;
    function getchatlist(start, limit) {
        $('#chatlistholder').append('<div class="loading" style="text-align:center"><img src="<?php echo $uri_root ?>public/client/images/loading7.gif" /></div>');
        $.ajax({url: '<?php echo $uri_root ?>chat_chatlist?getchatlist&uid=' + uid + '&start=' + start + '&limit=' + limit,
            success: function (re) {
                $('#chatlistholder').find('.loading').remove();
                if (re.length) {
                    var data = eval('(' + re + ')');
                    showchatlist(data);
                }
            },
            timeout: 20000,
            error: function () {
                $('#chatlistholder').find('.loading').remove()
            }
        });
    }
    function showchatlist(data) {
        for (i in data) {
            convercount++;
            var msg = data[i];
            var msgblock = '<div class="conver" rel="' + msg.remoteid + '">';
            msgblock += '<div class="remotename" rel="' + msg.remoteid + '">' + msg.remotename + '</div>';
            msgblock += '<div class="msgcontent">' + (msg.out ? '<span class="repmark"></span> ' : '') + msg.msg + '</div>';
            msgblock += '<div class="msgtime">' + timeshow(msg.time) + '</div>';
            msgblock += '</div>';
            msgblock = $(msgblock);
            msgblock.hover(function () {
                $(this).addClass('conver_hover')
            }, function () {
                $(this).removeClass('conver_hover')
            });
            msgblock.click(function ()
            {
                var remoteid = $(this).attr('rel');
                var remotename = $(this).find('.remotename').html();
                ppchatInit(remoteid, remotename, 0, 1);
            });
            $('#chatlistholder').append(msgblock);
        }
        if (!$('#chatlistloadmorebutton').length) {
            $('#chatlistholder').after('<div style="padding:5px; text-align:right"><a href="#" id="chatlistloadmorebutton">Xem thêm</a></div>');
            $('#chatlistloadmorebutton').click(function () {
                if (!$('#chatlistholder').find('.loading').length)
                    getchatlist(convercount, 20);
                return false;
            });
        }
    }
</script>
<script type='text/javascript'>$(document).ready(function () {
            setTimeout(function () {
                if (uid != '') {
                    getchatlist(0, 15)
                }
            }, 1000)
        });</script>

<script type='text/javascript' src='<?php echo js_link('chat.js') ?>'></script>
<script type='text/javascript'>
    var operamini = 0;
    var getmsgIntv = 20000;
    var loggedin = 0;
    $(document).ready(function () {
        setTimeout(function () {
            if (uid != '') {
                getmsgIntv = 3000;
                loggedin = 1;
            }
        }, 3000)
    });
    var getmsgTimeout = 15000;
    var orig_title = document.title;
    var new_title = '';
    var window_focus = true;
    var msgmaxlength = 800;
    var playchatsound = getCookie('soundsw') == '0' ? 0 : 1;
    var chat_standalone = 0;
    $(document).ready(function () {
        $(window).focus(function () {
            window_focus = true;
        })
                .blur(function () {
                    window_focus = false;
                });
    });
</script>
<h1 style="position: absolute; text-indent: -99999px">Dự đoán Xổ Số</h1>
<div class="page-title-xs"><strong>Giao lưu - Thảo luận</strong></div>
<div style='padding:4px 0; color:#333333; font-weight:bold' class="a_noiquy">Chào mừng bạn đến với phòng chat, xin vui lòng đọc kỹ <a href='javascript:;' onclick='togglerules();
            return false' style='font-weight:bold'>nội quy</a> trước khi tham gia thảo luận.</div>
<style type="text/css">#chatrules *{padding:1px 0}.chatmsgline{line-height:15px}</style>
<div id='chatrules' style='background:#EEEEEE; border:#E2E2E2 1px solid; padding:7px; border-radius:5px; margin:5px 0; display:none'>
    <div style='font-weight:bold'>Nội quy phòng chat</div>
    <div>Phòng chat là để giao lưu, kết bạn, thảo luận về xổ số và các lĩnh vực khác trên tinh thần vui vẻ, hòa đồng, giúp đỡ lẫn nhau và không vụ lợi. Những quy định sau cần phải được nghiêm túc thực hiện:</div>
    <div>- Không sử dụng ngôn từ phản cảm, thô tục, xúc phạm hoặc có ý phân biệt vùng miền.</div>
    <div>- Không gửi tin nhắn với nội dung lặp lại, tin nhắn không có nội dung hoặc gửi liên tục nội dung dài.</div>
    <div>- Không quảng cáo, mời chào các thành viên nhắn tin, gọi điện để lấy số...</div>
    <div>- Không đặt tên phản cảm, giả mạo Ban quản trị hoặc cố tình đặt tên trùng với tên thành viên khác.</div>
    <div>Xoso.com mong nhận được sự hợp tác của các bạn nhằm xây dựng một sân chơi lành mạnh và tạo niềm vui cho tất cả thành viên.</div>
    <div class="a_blue"><a href='javascript:;' onclick='togglerules();
                return false'>Tôi đã đọc và nhất trí với quy định trên.</a></div>
</div>
<script type="text/javascript">
    function togglerules() {
        if ($('#chatrules').is(':visible'))
            $('#chatrules').hide('fast');
        else
            $('#chatrules').show('fast');
    }
</script>
<div id='chatcontent' style='overflow:auto; position:relative; height:345px; border:#C3C3C3 1px solid; border-radius:4px'></div>
<div id='view_resize_handler' class='v_resize_handler' title='Bấm rồi kéo để thay đổi'>ˉˉˉˉˉˉˉˉ</div>
<div id='chatnotiarea' style='position:relative; height:1px; top:-4px'></div>
<form name=f style='margin:0'>
    <div>
        <div style='margin-left:5px; float:left' id='emoticonbar'></div>
        <div style='float:left; padding-top:3px; padding-left:10px'>
            <input name='soundsw' id='soundsw' type=checkbox checked onchange='var thisset = this.checked ? 1 : 0;
                        setCookie("soundsw", thisset, 9999);
                        playchatsound = thisset' /><label for='soundsw' style='font-size:11px; color:#494949' title='Bật âm thanh khi có tin nhắn mới'>Âm thanh</label>
        </div>
        <div style='float:right; margin-right:10px; font-size:11px; color:#3C3C3C'><a class=msgtool href='<?php echo $uri_root ?>chat-luu-tru.html' title='Xem lại nội dung chat theo thời gian'>Lưu trữ</a> <a class=msgtool href='<?php echo $uri_root ?>chat-full-screen.html' title='Mở rộng cửa sổ chat'>Full screen</a></div>	<div class='clear'></div>	
    </div>
</form>
<div id='editor_holder' style='position:relative; border:#C3C3C3 1px solid; margin-top:1px; border-radius:4px'><iframe id='chat_editor' class='chat_editor' frameborder=0></iframe>
    <a class='tool_button chat_send_button' style='margin-left:3px; padding:6px 7px; position:absolute; right:3px; top:3px' href='#'>&nbsp;&nbsp;Gửi&nbsp;&nbsp;</a><div class='clear'></div></div>
<div id='edit_resize_handler' class='v_resize_handler' title='Bấm rồi kéo để thay đổi'>ˉˉˉˉˉˉˉˉ</div>
<script type="text/javascript">
    down_h = 0;
    down_y = 0;
    resize_dragging = 0;
    $('.v_resize_handler').hover(function () {
        $(this).addClass('v_resize_handler_hover')
    }, function () {
        $(this).removeClass('v_resize_handler_hover')
    });
    $('.v_resize_handler').mousedown(function (e) {
        down_y = e.pageY;
        $(document).disableSelection();
        $(this).addClass('v_resize_handler_down');
        $('body').css('cursor', 'n-resize');
    });
    $('#view_resize_handler').mousedown(function () {
        down_h = $('#chatcontent').height();
        resize_dragging = 'view';
    });
    $('#edit_resize_handler').mousedown(function () {
        down_h = $('#chat_editor').height();
        $('#editor_holder').prepend('<div id="dragmask" style="width:100%; height:100%; position:absolute; background:none"></div>');
        resize_dragging = 'edit';
    });
    $(document).mouseup(function () {
        if (resize_dragging) {
            $(document).enableSelection();
            $('.v_resize_handler_down').removeClass('v_resize_handler_down');
            $('body').css('cursor', 'auto');
            if (resize_dragging == 'edit')
                $('#dragmask').remove();
            resize_dragging = 0;
        }
    });
    $(document).mousemove(function (e) {
        if (resize_dragging == 'view') {
            var newheight = down_h + e.pageY - down_y;
            if (newheight > 100)
                $('#chatcontent').css('height', newheight);
        }
        if (resize_dragging == 'edit') {
            var newheight = down_h + e.pageY - down_y;
            if (newheight > 35)
                $('#chat_editor').css('height', newheight);
        }
    });
    ////////////
    initEditor('chat_editor', 'chatcontent');
    emoticonBar('emoticonbar', 'chat_editor');
    $(document).ready(function () {
        getmsg(1)
    });
</script>
<div class=clear></div>

<br/>
<div class="contentbox">
    <div class=contentbox_header>
        <div style='color:#b43939;font-size:14px'>
            <div style="float:left;color:#b43939;font-size:14px;padding:0">Lô chơi nhiều</div>
            <div style="float:right" class="a_green">
                <span style='display:inline-block; position:relative;margin-top:10px'>
                    <input type=text id='trenddayselect' size=10 style='font-size:12px;color:#6ab400;background:#f0f0f0;padding:0;border:none;position:relative;z-index:98' />
                    <a id='trendayselect_guide' href='#' style='line-height:normal;background:#f0f0f0;position:absolute;top:0;left:0;z-index:99'>Chọn ngày&nbsp;&nbsp;</a>
                </span>
            </div>
        </div>
    </div>
</div>
<div id='oldtrendplace'></div>
<div id='trendplace'>
    <div id='trend_<?php echo $date_chot ?>'>
        <div class=contentbox>
            <div class=contentbox_header>
                <div style='color:#b43939;font-size:14px'>Lotto được chơi nhiều ngày <?php echo date('d/m/Y', strtotime($date_chot)) ?></div>
            </div>
            <div class=contentbox_body>
                <div>
                    <div class='trendholder'>
                        <?php
                        if ($trendday) {
                            $dem = 0;
                            $fontsize = 27;
                            $tmp = 0;
                            foreach ($trendday as $so => $nguoichoi) {
                                $dem++;
                                if($dem>20)
                                    break;

                                if ($dem == 1) {
                                    $tmp = $nguoichoi;
                                } else {
                                    if ($nguoichoi < $tmp && $fontsize > 12) {
                                        $fontsize = $fontsize - 3;
                                    }
                                    $tmp = $nguoichoi;
                                }
                                echo "<a class='trend_number' href='javascript:;' style='font-family:arial; font-size:" . $fontsize . "px' title='" . $nguoichoi . " người chơi'>" . $so . "</a>";
                            }
                        }
                        ?>
                    </div>
                </div>
                <div style='clear:both'></div>
            </div>
        </div>
    </div>
</div>
<?php if ($hour >= 18) { ?>
    <script type="text/javascript">loadtrend("<?php echo date('Y-m-d') ?>", "#oldtrendplace", 1);</script>
<?php } ?>
<script type="text/javascript">
    $('.trenddaysw').click(function () {
        $('.trenddaysw').removeClass('a_active');
        $(this).addClass('a_active');
        $('#trenddayselect').val('');
        $('#trendayselect_guide').show();
        loadtrend($(this).attr('rel'), "#oldtrendplace", 1);
        return false;
    });
    $('#trendayselect_guide').click(function () {
        $(this).hide();
        $('#trenddayselect').focus();
        return false
    });
    $('#trenddayselect').change(function () {
        if ($(this).val() == '')
        {
            $('#trendayselect_guide').show();
        }
        else
        {
            $('.trenddaysw').removeClass('a_active');
            loadtrend(sqldate($(this).val()), "#oldtrendplace", 1);
        }
    });
    if ($.datepicker) {
        $('#trenddayselect').datepicker({
            monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd/mm/yy',
            showAnim: '',
            minDate: new Date(<?php echo $minDate ?>),
            maxDate: new Date(<?php echo $maxDate ?>),
            onClose: function (text) {
                if (text == '')
                    $('#trendayselect_guide').show()
            }
        });
    }
    else {
        $('#trenddayselect').blur(function () {
            if ($(this).val() == '')
            {
                $('#trendayselect_guide').show();
            }
        });
    }
    trendLoadInterval = 60000;
    setTimeout(function () {
        loadtrend('<?php echo $date_chot ?>')
    }, 60000);
</script>
<style type="text/css">
    .contentbox{margin:7px 0;border:#ddd 1px solid;text-align:left}
    .contentbox_header {
        background: url("<?php echo $uri_root ?>public/client/images/box_top_bg.gif") repeat-x scroll 0 0 rgba(0, 0, 0, 0);
        height: 38px;
        line-height:38px;
        margin:0 1px;            
    }
    .contentbox_header div{font-weight:bold;color:#606060;font-size:12px;text-shadow:1px 1px #fff;position:relative;padding-left:5px}
    .contentbox_body{border-top:#ddd 1px solid;padding:5px}

    .trendholder{text-align:left}
    .trend_number:link, .trend_number:visited,.trend_number:hover,.trend_number:active{line-height:normal;display:inline-block; position:relative; color:#b43939; text-decoration:none; margin:0 8px 0 0}
    .trend_number:hover,.trend_number:active{color:#DF5900}
    .trend_old:link,.trend_old:visited,.trend_old:hover,.trend_old:active{color:#6C6C6C}
    .trend_old:hover,.trend_old:active{color:#DF5900}
    .trend_number:link span,.trend_number:visited span,.trend_number:hover span,.trend_number:active span{display:inline-block; width:12px; height:12px; overflow:hidden; position:absolute; right:-5px; top:-2px; text-align:center; font-size:11px; font-family:tahoma,arial; color:white; background:url('<?php echo $uri_root ?>public/client/images/rounddotbg.png'); background-repeat:no-repeat}
</style>    

<br/>
<script type='text/javascript' src='<?php echo js_link('chot.js') ?>'></script>
<script type='text/javascript'>
    var ngaychot = '<?php echo $date_chot ?>';
    var chotlock = 0;
    var lastchotid = 0;
    var lastchotupdate = 0;
    var chotlist_intv = 30000;
    var chotlist_timeout = 15000;
</script>
<div id='chotshowarea'>
    <div class="contentbox" style="margin:0">
        <div class=contentbox_header>
            <div style='color:#b43939;font-size:14px'>
                <div style="float:left;color:#b43939;font-size:14px;padding:0">Xem lại chốt số</div>
                <div style="float:right" class="a_green">
                    <span style='display:inline-block; position:relative;margin-top:10px'>
                        <input type=text id='chotdayselect' size=10 style='font-size:12px;color:#6ab400;background:#f0f0f0;padding:0;border:none;position:relative;z-index:98' />
                        <a id='chotdayselect_guide' href='#' style='line-height:normal;background:#f0f0f0;position:absolute;top:1px;left:0;z-index:99'>Chọn ngày&nbsp;&nbsp;&nbsp;</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div style="clear:both"></div>
    <div id='oldchotholder'></div>
</div>
<?php if ($hour >= 18) { ?>
    <script type="text/javascript">showchotlist("<?php echo date('Y-m-d') ?>");</script>
<?php } ?>
<script type="text/javascript">showchotlist("<?php echo $date_chot ?>");</script>
<div style='font-size:11px; text-align:left; padding:0 5px'>Trỏ chuột vào tên thành viên để xem tỷ lệ chốt trúng của thành viên đó (tỷ lệ trúng cao có màu nền đậm)</div>
<script type="text/javascript">
    $('.chotdaysw').click(function () {
        $('.chotdaysw').removeClass('a_active');
        $(this).addClass('a_active');
        $('#chotdayselect').val('');
        $('#chotdayselect_guide').show();
        showchotlist($(this).attr('rel'), 'oldchotholder');
        return false;
    });
    $('#chotdayselect_guide').click(function () {
        $(this).hide();
        $('#chotdayselect').focus();
        return false
    });
    $('#chotdayselect').change(function () {
        if ($(this).val() == '')
        {
            $('#chotdayselect_guide').show();
        }
        else
        {
            $('.chotdaysw').removeClass('a_active');
            showchotlist(sqldate($(this).val()), 'oldchotholder');
        }
    });
    if ($.datepicker) {
        $('#chotdayselect').datepicker({
            monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd/mm/yy',
            showAnim: '',
            minDate: new Date(<?php echo $minDate ?>),
            maxDate: new Date(<?php echo $maxDate ?>),
            onClose: function (text) {
                if (text == '')
                    $('#chotdayselect_guide').show()
            }
        });
    }
    else {
        $('#chotdayselect').blur(function () {
            if ($(this).val() == '')
            {
                $('#chotdayselect_guide').show();
            }
        });
    }
</script>
<style type="text/css">
    .col-content {
        font-family: arial,sans-serif;
        font-size: 12px;
    }
    .a_blue a:link,.a_blue a:visited,.a_blue a:hover,.a_blue a:active,
    .noticontent a:link,.noticontent a:visited,.noticontent a:hover,.noticontent a:active {text-decoration: none;color: #b10e0d}
    .a_blue a:visited,.noticontent a:visited {color: #884270}
    .a_blue a:active,.a_blue a:hover,.noticontent a:active,.noticontent a:hover {color: #ff8022}
    .a_green a:link,.a_green a:visited,.a_green a:hover,.a_green a:active{text-decoration: none;color: #6ab400}
    .a_green a:visited {color: #6ab400}
    .a_green a:active,.a_green a:hover {color: #ff8022}
    input#chot_submit{cursor:pointer}
    .col-content input[type="text"] {
        font-family: arial,sans-serif;
        height: 15px;
        line-height: 15px;
        padding: 2px;
    }
    .tip_hover{color:#555;background:#ffef93;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;text-decoration:none}
    .tipcontent{position:absolute;z-index:1003;display:inline-block;background:#ffef93;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;max-width:400px;*width:400px}
    .tipcontent_inner{display:inline-block;font-size:12px;font-weight:normal;text-align:left;color:#555;padding:3px 5px 5px 5px}
    .tiparrow{position:absolute;z-index:1002;display:inline-block;margin:0;padding:0;width:9px;height:9px;overflow:hidden;background:url('<?php echo $uri_root ?>public/client/images/arrow_down.png') center center no-repeat;*background-image:none;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo $uri_root ?>public/client/images/arrow_down.png,sizingMethod=scale)}
    .questiontip,.questiontip2 {
        background: url("<?php echo $uri_root ?>public/client/images/question.png") no-repeat scroll center center rgba(0, 0, 0, 0);
        display: inline-block;
        height: 20px;
        margin:0;
        overflow: hidden;
        width: 20px;
    }
    .questiontip2{background: url("<?php echo $uri_root ?>public/client/images/question2.png") no-repeat scroll center center rgba(0, 0, 0, 0);height:32px;width: 32px}
    .tip {
        cursor: pointer;
        display: inline-block;
    }
    .msg{display:inline-block;background:#f8ffea;border:#b4eb41 1px solid;color:#434600;padding:5px;margin:5px 0}
    .msgerr{display:inline-block;background:#fff2ea;border:#fa8e74 1px solid;color:#d91c00;padding:5px;margin:5px 0}
    .closebutton:link,.closebutton:visited,.closebutton:hover,.closebutton:active{position:absolute;top:3px;right:3px;z-index:3;display:inline-block;width:15px;height:15px;background:url('<?php echo $uri_root ?>public/client/images/close.png') no-repeat scroll 0 -16px transparent;overflow:hidden}
    .closebutton:hover{background-position:0 -32px}

    table#chottbl{border-spacing:1px;width:auto}
    #chottbl th,#chottbl td{color:#393939;padding:4px}
    #chottbl .chotinput{font-weight:bold; color:#333333;font-family:arial,sans-serif;padding:2px}
    #chottbl th{background:#E9E9E9}
    #chottbl td{background:#F2F2F2}

    .chotlisttbl{margin:5px 0px; text-align:left; border:#d0d0d0 1px solid; max-height:330px; overflow:hidden}
    .chotlisttbl .chotlisthead{text-shadow:1px 1px #a65957;background:url('<?php echo $uri_root ?>public/client/images/chot-today.jpg') scroll repeat-x 0 0; font-weight:bold; color:#fff; padding:5px;height:22px;line-height:22px;font-size:14px}
    .chotlisttbl .headhilight{background:#33B6E8}
    .chotlisttbl_old{border:#d0d0d0 1px solid}
    .chotlisttbl_old .chotlisthead{text-shadow:1px 1px #71935d;background:url('<?php echo $uri_root ?>public/client/images/chot-oldday.jpg') scroll repeat-x 0 0; font-weight:bold; color:#333; padding:5px;height:22px;line-height:22px;font-size:14px}
    .chotlistarea{padding:2px; max-height:300px; *height:300px; *position:relative; overflow:auto}

    .chotline{position:relative; background:#F6F6F6; margin-top:1px; padding:3px; font-weight:bold; color:#333333; border-bottom:#DFDFDF 1px solid}
    .chotline_hover{background:#DFDFDF}
    .chothight{background:#f0f0c3; border-bottom:#DFDFB5 1px solid}
    .chothight.chotline_hover{background:#DFDFB5}
    .chotline_new{background:#E7FDE1}
    .chotline_update{background:#FFF1C4}
    .chotline.trunglo{border-left:#23E800 3px solid}
    .chotline.trungde{border-left:#FF4415 3px solid}
    .chotline_deleting{background:#FFE3DD}
    .chotline_lo{margin-left:3px; color:#045CFF}
    .chotline_lodau{margin-left:3px; color:#045CFF}
    .chotline_lodit{margin-left:3px; color:#045CFF}
    .chotline_lobt{margin-left:3px; color:#E47301}

    .chotline_de{margin-left:3px; color:#7E15FF}
    .chotline_dedau{margin-left:3px; color:#7E15FF}
    .chotline_dedit{margin-left:3px; color:#7E15FF}
    .chotline_debt{margin-left:3px; color:#FF0000}
    .chotname{font-weight:700; color:#802a00; padding:2px}
    .chotcount{font-weight:700}
    .tip_hover{color:#555}
    .chotname .tipcontent{color:#E4CEFF; font-size:11px; font-weight:bold}
    .chottime{color:#393939; font-size:11px; font-weight:normal; font-style:italic}
    .votes{display:inline-block; margin:0 5px; font-size:11px; font-weight:bold}
    .clnhay{color:#008000; font-weight:normal; font-family:tahoma,arial; font-size:11px}
    .cdnhay{color:red; font-weight:normal; font-family:tahoma,arial; font-size:11px}
    .tk-home .content-2 .module span{margin:0 8px}
</style>

<br/>
<div style='text-align:center;font-size:12px;font-weight:700;color:#393939;padding:5px 0'>Bạn đã nghiên cứu xong chưa? Hãy chốt số để chia sẻ với mọi người:</div>
<div style="text-align:center"><a href='javascript:;' onclick='chotsw(this);
        return false' style='background-color: #b8100d;background-image: linear-gradient(to bottom, #b8100d, #960501);border: #980804 1px solid;color: #f1f4f8;display:inline-block; font-weight:bold; font-size:12px;height:32px;line-height:32px;padding:0 30px;border-radius: 3px;-moz-border-radius: 3px;-webkit-border-radius: 3px;'>Bấm để chốt số ngày <span id='ngaychotshow'><?php echo date('d/m/Y', strtotime($date_chot)) ?></span> <span class='updownarr'>▼</span></a></div>
<form name='chotform' id='chotform' style='margin:0 auto;width:340px;display:none' onsubmit='chotso();
        return false'>
    <div id='chotmsgplace' style='position:absolute'></div>
    <div id='chotstatus' style='padding-top:5px; color:#008000; font-size:11px'></div>
    <table id='chottbl' border=0 cellspacing=1 cellpadding=4 style='background:white; border:#C5C5C5 1px solid'>
        <tr>
            <th></th>
            <th>Cặp số</th>
            <th>Đầu</th>
            <th>Đuôi</th>
            <th>Bạch thủ</th>
        </tr>
        <tr class='chotlo'>
            <td style='font-weight:bold; color:#045CFF'>Lô:</td>
            <td><input type=text class='chotinput' name='chotlo' size=9 value='' /></td>
            <td><input type=text class='chotinput' name='chotlodau' size=2 value='' /></td>
            <td><input type=text class='chotinput' name='chotlodit' size=2 value='' /></td>
            <td align=center><input type=text class='chotinput' name='chotlobt' size=2 value='' style='width:30px' /></td>
        </tr>
        <tr class='chotde'>
            <td style='font-weight:bold; color:#7E15FF'>ĐB:</td>
            <td><input type=text class='chotinput' name='chotde' size=9 value='' /></td>
            <td><input type=text class='chotinput' name='chotdedau' size=2 value='' /></td>
            <td><input type=text class='chotinput' name='chotdedit' size=2 value='' /></td>
            <td align=center><input type=text class='chotinput' name='chotdebt' size=2 value='' style='width:30px' /></td>
        </tr>
        <tr>
            <td colspan="5">
                <div style="text-align:center;position:relative">
                    <input type=submit id='chot_submit' name='chot_submit' value=' Chốt số ' style='background-color: #b8100d;background-image: linear-gradient(to bottom, #b8100d, #960501);border: #980804 1px solid;color: #f1f4f8;font-weight:bold; font-size:12px;font-family:arial,sans-serif;height:32px;padding:0 20px;border-radius: 3px;-moz-border-radius: 3px;-webkit-border-radius: 3px;' />
                </div>
                <div>
                    <b>Bạn có thể nhập:</b><br/>- Tối thiểu: 1 số<br/> - Tối đa:<br/>+ Lô: 10 con<br/>+ Lô đầu: 3 số<br/>+ Lô đuôi: 3 số<br/>+ ĐB: 20 con<br/>+ ĐB đầu: 6 số<br/>+ ĐB đuôi: 6 số <br/>+ Bạch thủ: 1 con mà bạn cho là đẹp nhất.<br/>Các số nhập cách nhau bằng dấu phẩy.<br/> Ví dụ: 12,23,56.<br/> <i>Bạn chỉ được sửa các con số mình chốt trước 18h00.</i>
                </div>
            </td>
        </tr>
    </table>
</form>
<script type='text/javascript'>
    $('.chotinput').keypress(function () {
        unlockchotform();
    });
    unlockchotform();
</script>
<br/>