<div style='padding:5px 0 15px 0'>
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
    <div id='notipanel' style='display:block'>
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
        function floatnotify(content){
            var bottom=100+Math.floor(Math.random()*150);
            var right=20;
            var noti=$('<div class="floatnotify" style="bottom:'+bottom+'px; right:'+right+'px"></div>');
            noti.append(content);
            setTimeout(function(){noti.fadeOut('slow',function(){$(this).remove()})},5000);
            notimove(noti,100);
            $('body').append(noti);	
        }
        function notimove(noti,distant){
            var currheight=parseInt(noti.css('bottom'));
            noti.css('bottom',(currheight+1)+'px');
            distant=distant-1;
            if(distant>0)
                setTimeout(function(){notimove(noti,distant)},70);

        }
        function rednumClear(group){
            $('.noti_icon[rel='+group+']').find('.notinumber').remove();
        }
        function notify(noti,group,pop){
            if(!group)
                group='info';
            if($('#notipanel').css('display')=='none'){
                $('#notipanel').css('height',"1px");
                $('#notipanel').css('display','block');
            }	
            var line=$('<div class="noti_line noti_line_new"></div>');
            line.append($(noti));
            line.hover(function(){$(this).addClass('noti_line_hover')}, function(){$(this).removeClass('noti_line_hover')});
            line.click(function(){rednumClear(group); $(this).removeClass('noti_line_new')});
            $('#'+group+'_noticontent').prepend(line);	
            if(pop){
                $('.noticontent').hide();
                $('#'+group+'_noticontent').show();
                $('.noti_icon_active').removeClass('noti_icon_active');
                $('.noti_icon[rel='+group+']').addClass('noti_icon_active');
                notipopup();
                window.notiPopdownTimeout=setTimeout(function(){notipopdown();$('.noti_icon[rel='+group+']').removeClass('noti_icon_active')},5000);
            }else{
                var notinumber = $('.noti_icon[rel='+group+']').find('.notinumber');
                if(notinumber.length){
                    var currnum=$('.noti_icon.'+group+'_sw').find('.notinumber').html();
                    currnum=currnum*1+1;
                    notinumber.html(currnum);
                }else{
                    var notinumber=$("<span class=notinumber>1</span>");
                    $('.noti_icon.'+group+'_sw').append(notinumber);
                }	
            }	
        }
        function notipopup(){
            $('#noticontentslider').animate({'height':$('#noticontentholder').height()});
            clearTimeout(window.notiPopdownTimeout);
        }
        function notipopdown(){
            $('#noticontentslider').animate({'height':0});
        }
        $('.noti_icon').click(function(){
            if($(this).hasClass('noti_icon_active')){		
                $(this).removeClass('noti_icon_active');
                notipopdown();
            }else{
                $('.noticontent').hide();
                $('#'+$(this).attr('rel')+'_noticontent').show();
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
        var convercount=0;
        function getchatlist(start,limit){
            $('#chatlistholder').append('<div class="loading" style="text-align:center"><img src="<?php echo $uri_root ?>public/client/images/loading7.gif" /></div>');
            $.ajax({url:'<?php echo $uri_root ?>chat_chatlist?getchatlist&uid='+uid+'&start='+start+'&limit='+limit,
                success:function(re){
                    $('#chatlistholder').find('.loading').remove();
                    if(re.length){				
                        var data=eval('('+re+')');
                        showchatlist(data);				
                    }
                },
                timeout:20000,
                error:function(){$('#chatlistholder').find('.loading').remove()}
            });
        }
        function showchatlist(data){	
            for(i in data){
                convercount++;
                var msg=data[i];
                var msgblock='<div class="conver" rel="'+msg.remoteid+'">';
                msgblock+='<div class="remotename" rel="'+msg.remoteid+'">'+msg.remotename+'</div>';
                msgblock+='<div class="msgcontent">'+(msg.out?'<span class="repmark"></span> ':'')+msg.msg+'</div>';
                msgblock+='<div class="msgtime">'+timeshow(msg.time)+'</div>';
                msgblock+='</div>';	
                msgblock=$(msgblock);
                msgblock.hover(function(){$(this).addClass('conver_hover')},function(){$(this).removeClass('conver_hover')});		msgblock.click(function()
                {
                    var remoteid=$(this).attr('rel');		
                    var remotename=$(this).find('.remotename').html();
                    ppchatInit(remoteid,remotename,0,1);
                });
                $('#chatlistholder').append(msgblock);
            }
            if(!$('#chatlistloadmorebutton').length){
                $('#chatlistholder').after('<div style="padding:5px; text-align:right"><a href="#" id="chatlistloadmorebutton">Xem thêm</a></div>');
                $('#chatlistloadmorebutton').click(function(){
                    if(!$('#chatlistholder').find('.loading').length)
                        getchatlist(convercount,20);
                    return false;
                });
            }
        }
    </script>
    <script type='text/javascript'>$(document).ready(function(){setTimeout(function(){if(uid!=''){getchatlist(0,15)}},1000)});</script>

    <script type='text/javascript' src='<?php echo js_link('chat.js') ?>'></script>
    <script type='text/javascript'>
    var operamini=0;
    var getmsgIntv=20000;
    var loggedin=0;
    $(document).ready(function(){setTimeout(function(){if(uid!=''){getmsgIntv=3000;loggedin=1;}},3000)});
    var getmsgTimeout=15000;
    var orig_title=document.title;
    var new_title='';
    var window_focus=true;
    var msgmaxlength=800;
    var playchatsound=getCookie('soundsw')=='0'?0:1;
    var chat_standalone=0;
    $(document).ready(function(){
        $(window).focus(function() {
            window_focus = true;
        })
        .blur(function() {
            window_focus = false;
        });
    });
    </script>
    <div class="tk_block"><h3>Giao lưu - Thảo luận</h3></div>    
    <div style='padding:4px 0; color:#333333; font-weight:bold' class="a_noiquy">Chào mừng bạn đến với phòng chat, xin vui lòng đọc kỹ <a href='javascript:;' onclick='togglerules(); return false' style='font-weight:bold'>nội quy</a> trước khi tham gia thảo luận.</div>
    <style type="text/css">#chatrules *{padding:1px 0}</style>
    <div id='chatrules' style='background:#EEEEEE; border:#E2E2E2 1px solid; padding:7px; border-radius:5px; margin:5px 0; display:none'>
        <div style='font-weight:bold'>Nội quy phòng chat</div>
        <div>Phòng chat là để giao lưu, kết bạn, thảo luận về xổ số và các lĩnh vực khác trên tinh thần vui vẻ, hòa đồng, giúp đỡ lẫn nhau và không vụ lợi. Những quy định sau cần phải được nghiêm túc thực hiện:</div>
        <div>- Không sử dụng ngôn từ phản cảm, thô tục, xúc phạm hoặc có ý phân biệt vùng miền.</div>
        <div>- Không gửi tin nhắn với nội dung lặp lại, tin nhắn không có nội dung hoặc gửi liên tục nội dung dài.</div>
        <div>- Không quảng cáo, mời chào các thành viên nhắn tin, gọi điện để lấy số...</div>
        <div>- Không đặt tên phản cảm, giả mạo Ban quản trị hoặc cố tình đặt tên trùng với tên thành viên khác.</div>
        <div>Xoso.com mong nhận được sự hợp tác của các bạn nhằm xây dựng một sân chơi lành mạnh và tạo niềm vui cho tất cả thành viên.</div>
        <div class="a_blue"><a href='javascript:;' onclick='togglerules(); return false'>Tôi đã đọc và nhất trí với quy định trên.</a></div>
    </div>
    <script type="text/javascript">
        function togglerules(){
            if($('#chatrules').is(':visible'))
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
                <input name='soundsw' id='soundsw' type=checkbox checked onchange='var thisset=this.checked?1:0; setCookie("soundsw",thisset,9999); playchatsound=thisset' /><label for='soundsw' style='font-size:11px; color:#494949' title='Bật âm thanh khi có tin nhắn mới'>Âm thanh</label>
            </div>
            <div style='float:right; margin-right:10px; font-size:11px; color:#3C3C3C'><a class=msgtool href='<?php echo $uri_root ?>chat-luu-tru.html' title='Xem lại nội dung chat theo thời gian'>Lưu trữ</a> <a class=msgtool href='<?php echo $uri_root ?>chat-full-screen.html' title='Mở rộng cửa sổ chat'>Full screen</a></div>	<div class='clear'></div>	
        </div>
    </form>
    <div id='editor_holder' style='position:relative; border:#C3C3C3 1px solid; margin-top:1px; border-radius:4px'><iframe id='chat_editor' class='chat_editor' frameborder=0></iframe>
        <a class='tool_button chat_send_button' style='margin-left:3px; padding:6px 7px; position:absolute; right:3px; top:3px' href='#'>&nbsp;&nbsp;Gửi&nbsp;&nbsp;</a><div class='clear'></div></div>
    <div id='edit_resize_handler' class='v_resize_handler' title='Bấm rồi kéo để thay đổi'>ˉˉˉˉˉˉˉˉ</div>
    <script type="text/javascript">
        down_h=0;
        down_y=0;
        resize_dragging=0;
        $('.v_resize_handler').hover(function(){$(this).addClass('v_resize_handler_hover')},function(){$(this).removeClass('v_resize_handler_hover')});
        $('.v_resize_handler').mousedown(function(e){	
            down_y=e.pageY;	
            $(document).disableSelection();
            $(this).addClass('v_resize_handler_down');
            $('body').css('cursor','n-resize');
        });
        $('#view_resize_handler').mousedown(function(){
            down_h=$('#chatcontent').height();
            resize_dragging='view';
        });
        $('#edit_resize_handler').mousedown(function(){
            down_h=$('#chat_editor').height();
            $('#editor_holder').prepend('<div id="dragmask" style="width:100%; height:100%; position:absolute; background:none"></div>');
            resize_dragging='edit';
        });
        $(document).mouseup(function(){
            if(resize_dragging){
                $(document).enableSelection();
                $('.v_resize_handler_down').removeClass('v_resize_handler_down');
                $('body').css('cursor','auto');
                if(resize_dragging=='edit')
                    $('#dragmask').remove();
                resize_dragging=0;		
            }
        });
        $(document).mousemove(function(e){
            if(resize_dragging=='view'){
                var newheight=down_h+e.pageY-down_y;
                if(newheight>100)
                    $('#chatcontent').css('height',newheight);
            }
            if(resize_dragging=='edit'){
                var newheight=down_h+e.pageY-down_y;
                if(newheight>35)
                    $('#chat_editor').css('height',newheight);
            }
        });
        ////////////
        initEditor('chat_editor','chatcontent');
        emoticonBar('emoticonbar','chat_editor');
        $(document).ready(function(){getmsg(1)});
    </script>
    <div class=clear></div>
</div>

<div class="block_sms"><?php echo $text_sms->content ?></div>
<div class="box-tt clearfix">
    <strong class="strong-tt">Trực tiếp kết quả Xổ Số Miền Bắc<br />
        Nhận kết quả nhanh siêu tốc</strong>
    <div class="box-editor"><strong class="red">BHX TT MB</strong> gửi <strong class="red">8588</strong></div>
</div>
<?php
$days = array('0' => 'Chủ nhật', '1' => 'Thứ 2', '2' => 'Thứ 3', '3' => 'Thứ 4', '4' => 'Thứ 5', '5' => 'Thứ 6', '6' => 'Thứ 7');
if (isset($checktoday['MB']) && $checktoday['MB'] == 1)
    $v = $xoso['MB'][$today][0];
else
    $v = $xoso['MB'][$yesterday][0];

$date = date('d/m/Y', strtotime($v->date));
$datew = $days[date('w', strtotime($v->date))];
$v->extra = json_decode($v->extension);
?>
<div class="block_db block_xsmb">
    <div class="block_db_title clearfix">
        <h2>XỔ SỐ MIỀN BẮC - <?php echo $date ?></h2>
        <a class="right" href="<?php echo $uri_root . $v->alias ?>.html">Xem kết quả chi tiết</a>
    </div>
    <div class="block_db_content">
        <div class="title_db">Giải đặc biệt</div>
        <div class="giaidacbiet"><?php echo $v->a0 ?></div>
    </div>
    <div class="block_db_footer">
        <a class="left" href="<?php echo $uri_root . $v->alias ?>.html">Xem kết quả chi tiết</a>
        <span class="left">&nbsp;</span>
        <a href="javascript:" onclick="showPopup('#loto-xsmb')">Loto</a>
        <a href="javascript:" onclick="showPopup('#xsdt-block')">Xổ Số Điện Toán</a>
    </div>
</div>
<div id="xsdt-block" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1"><strong class="txt-red"><h2>Xổ Số Điện Toán</h2></strong></div>
        <?php
        $DT6x36_time = strtotime($xsdt['DT6x36']->date);
        $DT123_time = strtotime($xsdt['DT123']->date);
        $TT_time = strtotime($xsdt['TT']->date);
        ?>
        <table class="tbl-result">
            <tr>
                <td class="bg-gray first">
                    <strong class="left">Kết quả xổ số điện toán 6x36</strong>
                    <span class="right">Mở thưởng <?php echo $days[date('w', $DT6x36_time)] ?> ngày <?php echo(date('d/m/Y', $DT6x36_time)); ?></span>
                </td>
            </tr>
            <tr>
                <td class="td-sub">
                    <table>
                        <tr>
                            <?php foreach (json_decode($xsdt['DT6x36']->data)as $value) { ?>
                                <td class="red font24 t-cen"><strong><?php echo $value ?></strong></td>
                            <?php } ?>
                            <td class="t-right"><a class="read-more" href="<?php echo $uri_root ?>xo-so-dien-toan/6X36/<?php echo(date('d-m-Y', $DT6x36_time)); ?>.html"><span>Xem thêm</span></a></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="bg-gray first">
                    <strong class="left">Kết quả xổ số điện toán 1*2*3</strong>
                    <span class="right">Mở thưởng <?php echo $days[date('w', $DT123_time)] ?> ngày <?php echo(date('d/m/Y', $DT123_time)); ?></span>
                </td>
            </tr>
            <tr>
                <td class="td-sub">
                    <table class="tbl-sub">
                        <tr>
                            <?php foreach (json_decode($xsdt['DT123']->data)as $value) { ?>
                                <td class="red font24 t-cen"><strong><?php echo $value ?></strong></td>
                            <?php } ?>
                            <td class="t-right"><a class="read-more" href="<?php echo $uri_root ?>xo-so-dien-toan/1*2*3/<?php echo(date('d-m-Y', $DT123_time)); ?>.html"><span>Xem thêm</span></a></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="bg-gray first">
                    <strong class="left">Kết quả xổ số Thần tài</strong>
                    <span class="right">Mở thưởng <?php echo $days[date('w', $TT_time)] ?> ngày <?php echo(date('d/m/Y', $TT_time)); ?></span>
                </td>
            </tr>
            <tr>
                <td class="td-sub">
                    <table class="tbl-sub">
                        <tr>
                            <?php foreach (json_decode($xsdt['TT']->data)as $value) { ?>
                                <td class="red font24 t-cen"><strong><?php echo $value ?></strong></td>
                            <?php } ?>
                            <td class="t-right"><a class="read-more" href="<?php echo $uri_root ?>xo-so-dien-toan/than-tai/<?php echo(date('d-m-Y', $TT_time)); ?>.html"><span>Xem thêm</span></a></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<div id="loto-xsmb" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1"><strong class="txt-red">Loto Miền Bắc - <?php echo $datew ?> ngày <?php echo $date ?></strong></div>
        <table class="tbl-tt">
            <tr>
                <td class="bg-gray border-right t-cen"><strong>Đầu</strong></td>
                <td class="bg-gray border-right t-cen"><strong>Đuôi</strong></td>
                <td class="bg-gray border-right t-cen"><strong>Đầu</strong></td>
                <td class="bg-gray t-cen"><strong>Đuôi</strong></td>
            </tr>
            <tr>
                <td class="border-right t-cen"><span class="red">0</span></td>
                <td class="border-right t-cen"><?php echo $v->extra[0] ?></td>
                <td class="border-right t-cen"><span class="red">5</span></td>
                <td class="t-cen"><?php echo $v->extra[5] ?></td>
            </tr>
            <tr>
                <td class="bg-gray border-right t-cen"><span class="red">1</span></td>
                <td class="bg-gray border-right t-cen"><?php echo $v->extra[1] ?></td>
                <td class="bg-gray border-right t-cen"><span class="red">6</span></td>
                <td class="bg-gray t-cen"><?php echo $v->extra[6] ?></td>
            </tr>
            <tr>
                <td class="border-right t-cen"><span class="red">2</span></td>
                <td class="border-right t-cen"><?php echo $v->extra[2] ?></td>
                <td class="border-right t-cen"><span class="red">7</span></td>
                <td class="t-cen"><?php echo $v->extra[7] ?></td>
            </tr>
            <tr>
                <td class="bg-gray border-right t-cen"><span class="red">3</span></td>
                <td class="bg-gray border-right t-cen"><?php echo $v->extra[3] ?></td>
                <td class="bg-gray border-right t-cen"><span class="red">8</span></td>
                <td class="bg-gray t-cen"><?php echo $v->extra[8] ?></td>
            </tr>
            <tr>
                <td class="border-right t-cen"><span class="red">4</span></td>
                <td class="border-right t-cen"><?php echo $v->extra[4] ?></td>
                <td class="border-right t-cen"><span class="red">9</span></td>
                <td class="t-cen"><?php echo $v->extra[9] ?></td>
            </tr>
        </table>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<?php
$xsmn = array();
$loto_tinh = '';
$loto_title = '';
$loto_arr = array();

if (isset($checktoday['MN']) && $checktoday['MN'] == 1) {
    $v = $xoso['MN'][$today][0];
    $obj = $xoso['MN'][$today];
} else {
    $v = $xoso['MN'][$yesterday][0];
    $obj = $xoso['MN'][$yesterday];
}

$date = date('d/m/Y', strtotime($v->date));
$datew = $days[date('w', strtotime($v->date))];

foreach ($obj as $value) {
    $xsmn[$value->alias]->name = $value->name;
    $xsmn[$value->alias]->data = $value->a0;
    $loto_tinh.='<td colspan="2" class="bg-gray border-right t-cen"><strong>' . $value->name . '</strong></td>';
    $loto_title.='<td class="border-right t-cen"><span>Đầu</span></td><td class="border-right t-cen"><span>Đuôi</span></td>';
    $extra = json_decode($value->extension);
    foreach ($extra as $k => $v) {
        $class = '';
        if ($k % 2 == 0)
            $class = 'bg-gray ';
        $loto_arr[$k].='<td class="' . $class . 'border-right t-cen"><span class="red">' . $k . '</span></td><td class="' . $class . 'border-right t-cen">' . $v . '</td>';
    }
}
?>
<div class="block_db block_xsmn">
    <div class="block_db_title clearfix">
        <h2>XỔ SỐ MIỀN NAM - <?php echo $date ?></h2>
        <a class="right" href="<?php echo $uri_root ?>xoso-mien-nam.html">Xem kết quả chi tiết</a>
    </div>
    <div class="block_db_content">
        <ul class="list-tinh">
            <?php
            foreach ($xsmn as $alias => $value) {
                $width = 'w188';
                if (count($xsmn) == 2)
                    $width = 'w282';elseif (count($xsmn) == 4)
                    $width = 'w141';
                ?>
                <li class="<?php echo $width ?>">
                    <div>
                        <a href="<?php echo $uri_root . $alias ?>.html"><?php echo $value->name ?></a>
                        <div class="title_db">Giải đặc biệt</div>
                        <div class="giaidacbiet"><?php echo $value->data ?></div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="block_db_footer">
        <a class="left" href="<?php echo $uri_root ?>xoso-mien-nam.html">Xem kết quả chi tiết</a>
        <span class="left">&nbsp;</span>
        <a href="javascript:" onclick="showPopup('#loto-xsmn')">Loto</a>
        <a href="javascript:" onclick="showPopup('#xsmn-block')">Mở thưởng hôm nay</a>
    </div>
</div>
<div id="xsmn-block" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1">
            <div class="title-right clearfix">
                <strong class="left txt-red">KẾT QUẢ XỔ SỐ MIỀN NAM</strong>
                <span class="right txt-red">Mở thưởng hôm nay lúc <strong><?php echo date('h:i A', strtotime($location_menu['MN'][0]->time)) ?></strong></span>
            </div>
        </div>
        <div class="box-gray spacenone">
            <ul class="list-pro">
                <?php
                foreach ($location_today['MN'] as $value) {
                    echo '<li><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></li>';
                }
                ?>
            </ul>
            <ul class="list-editor">
                <?php
                foreach ($location_today['MN'] as $value) {
                    echo '<li>Để nhận kết quả xổ số <strong>' . $value->name . '</strong> sớm nhất, soạn tin <span>KQ ' . $value->code . '</span> gửi <span>8017</span></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<div id="loto-xsmn" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1"><strong class="txt-red">Loto Miền Nam - <?php echo $datew ?> ngày <?php echo $date ?></strong></div>
        <table class="tbl-tt">
            <tr><?php echo $loto_tinh ?></tr>
            <tr><?php echo $loto_title ?></tr>
            <tr><?php echo $loto_arr[0] ?></tr>
            <tr><?php echo $loto_arr[1] ?></tr>
            <tr><?php echo $loto_arr[2] ?></tr>
            <tr><?php echo $loto_arr[3] ?></tr>
            <tr><?php echo $loto_arr[4] ?></tr>
            <tr><?php echo $loto_arr[5] ?></tr>
            <tr><?php echo $loto_arr[6] ?></tr>
            <tr><?php echo $loto_arr[7] ?></tr>
            <tr><?php echo $loto_arr[8] ?></tr>
            <tr><?php echo $loto_arr[9] ?></tr>
        </table>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<?php
$xsmt = array();
$loto_tinh = '';
$loto_title = '';
$loto_arr = array();

if (isset($checktoday['MT']) && $checktoday['MT'] == 1) {
    $v = $xoso['MT'][$today][0];
    $obj = $xoso['MT'][$today];
} else {
    $v = $xoso['MT'][$yesterday][0];
    $obj = $xoso['MT'][$yesterday];
}

$date = date('d/m/Y', strtotime($v->date));
$datew = $days[date('w', strtotime($v->date))];

foreach ($obj as $value) {
    $xsmt[$value->alias]->name = $value->name;
    $xsmt[$value->alias]->data = $value->a0;
    $loto_tinh.='<td colspan="2" class="bg-gray border-right t-cen"><strong>' . $value->name . '</strong></td>';
    $loto_title.='<td class="border-right t-cen"><span>Đầu</span></td><td class="border-right t-cen"><span>Đuôi</span></td>';
    $extra = json_decode($value->extension);
    foreach ($extra as $k => $v) {
        $class = '';
        if ($k % 2 == 0)
            $class = 'bg-gray ';
        $loto_arr[$k].='<td class="' . $class . 'border-right t-cen"><span class="red">' . $k . '</span></td><td class="' . $class . 'border-right t-cen">' . $v . '</td>';
    }
}
?>
<div class="block_db block_xsmt">
    <div class="block_db_title clearfix">
        <h2>XỔ SỐ MIỀN TRUNG - <?php echo $date ?></h2>
        <a class="right" href="<?php echo $uri_root ?>xoso-mien-trung.html">Xem kết quả chi tiết</a>
    </div>
    <div class="block_db_content">
        <ul class="list-tinh">
            <?php
            foreach ($xsmt as $alias => $value) {
                $width = 'w188';
                if (count($xsmt) == 2)
                    $width = 'w282';elseif (count($xsmt) == 4)
                    $width = 'w141';
                ?>
                <li class="<?php echo $width ?>">
                    <div>
                        <a href="<?php echo $uri_root . $alias ?>.html"><?php echo $value->name ?></a>
                        <div class="title_db">Giải đặc biệt</div>
                        <div class="giaidacbiet"><?php echo $value->data ?></div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="block_db_footer">
        <a class="left" href="<?php echo $uri_root ?>xoso-mien-trung.html">Xem kết quả chi tiết</a>
        <span class="left">&nbsp;</span>
        <a href="javascript:" onclick="showPopup('#loto-xsmt')">Loto</a>
        <a href="javascript:" onclick="showPopup('#xsmt-block')">Mở thưởng hôm nay</a>
    </div>
</div>
<div id="xsmt-block" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1">
            <div class="title-right clearfix">
                <strong class="left txt-red">KẾT QUẢ XỔ SỐ MIỀN TRUNG</strong>
                <span class="right txt-red">Mở thưởng hôm nay lúc <strong><?php echo date('h:i A', strtotime($location_menu['MT'][0]->time)) ?></strong></span>
            </div>
        </div>
        <div class="box-gray spacenone">
            <ul class="list-pro">
                <?php
                foreach ($location_today['MT'] as $value) {
                    echo '<li><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></li>';
                }
                ?>
            </ul>
            <ul class="list-editor">
                <?php
                foreach ($location_today['MT'] as $value) {
                    echo '<li>Để nhận kết quả xổ số <strong>' . $value->name . '</strong> sớm nhất, soạn tin <span>KQ ' . $value->code . '</span> gửi <span>8017</span></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<div id="loto-xsmt" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1"><strong class="txt-red">Loto Miền Trung - <?php echo $datew ?> ngày <?php echo $date ?></strong></div>
        <table class="tbl-tt">
            <tr><?php echo $loto_tinh ?></tr>
            <tr><?php echo $loto_title ?></tr>
            <tr><?php echo $loto_arr[0] ?></tr>
            <tr><?php echo $loto_arr[1] ?></tr>
            <tr><?php echo $loto_arr[2] ?></tr>
            <tr><?php echo $loto_arr[3] ?></tr>
            <tr><?php echo $loto_arr[4] ?></tr>
            <tr><?php echo $loto_arr[5] ?></tr>
            <tr><?php echo $loto_arr[6] ?></tr>
            <tr><?php echo $loto_arr[7] ?></tr>
            <tr><?php echo $loto_arr[8] ?></tr>
            <tr><?php echo $loto_arr[9] ?></tr>
        </table>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<br/>
<div id='div-gpt-ad-1378288615889-1' style='width:336px' class="mainmenu">
    <script type='text/javascript'>googletag.cmd.push(function(){googletag.display("div-gpt-ad-1378288615889-1")});</script>
</div>
<br/>

<div class="tk-home">
    <div class="tk-title">
        <h3>Thống kê nhanh các tỉnh quay thưởng hôm nay</h3>
        <div class="styled-select">
            <select name="tinh-home" id="tinh-home" onchange="loadTKHome();">
                <option value="1">Miền Bắc</option>
                <?php foreach ($location_today['MT'] as $value) { ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                <?php } ?>
                <?php foreach ($location_today['MN'] as $value) { ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div id="load-tk-home"></div>
</div>
<script type="text/javascript">function loadTKHome() {var a = $("#tinh-home").val();$("#load-tk-home").html('<div style="padding:10px;text-align:center"><img src="<?php echo img_link('icon-xs/007.gif'); ?>" width="145" height="15" alt="" /></div>');$.ajax({type: "GET",url: "<?php echo $uri_root ?>loadtkhome/" + a,success: function(b) {$("#load-tk-home").html(b);}})}$(document).ready(function(a) {loadTKHome()});</script>
<?php $this->load->view($layout_sms); ?>