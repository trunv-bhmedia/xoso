<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo $_meta['description'] ?>" />
        <meta name="keywords" content="<?php echo $_meta['keywords'] ?>" />
        <title><?php echo $_meta['title'] ?></title>
        <meta property="og:image" content="<?php echo img_link('logo.png') ?>" />
        <link type="image/x-icon" href="<?php echo img_link('favicon.ico') ?>" rel="shortcut icon" />
        <meta name="google-site-verification" content="_MdXAARqGNM7C1GRrfqgrQg59dJuCGxL_3E4tJf_se0" />
        <link type="text/css" href="<?php echo css_link('chat.css') ?>" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo js_link('jquery-1.7.2.js') ?>"></script>
        <script type="text/javascript" src="<?php echo js_link('jquery-ui-1.8.23.custom.min.js') ?>"></script>
        <link type="text/css" href="<?php echo css_link('jquery-ui-1.8.23.custom.css') ?>" rel="stylesheet" />
        <script type="text/javascript">/*<![CDATA[*/var uri_root="<?php echo $uri_root ?>";/*]]>*/</script>
        <script type='text/javascript' src='<?php echo js_link('clock.js') ?>'></script>
        <script type='text/javascript'>
            var year = '<?php echo date('Y') ?>';
            var month = '<?php echo date('m') ?>';
            var day = '<?php echo date('d') ?>';
            var hours = '<?php echo date('H') ?>';
            var minutes = '<?php echo date('i') ?>';
            var seconds = '<?php echo date('s') ?>';
            var ngay='';
            var date = new Date(year,month-1,day,hours,minutes,seconds);
            var weekday=['Chủ Nhật','Thứ Hai','Thứ Ba','Thứ Tư','Thứ Năm','Thứ Sáu','Thứ Bảy'];
            clock();
            setTimeout('timesync(1800000)',1800000);
        </script>
        <script type='text/javascript' src='<?php echo js_link('xoso.js') ?>'></script>
        <script type="text/javascript">
            var uid='<?php echo isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : '' ?>';
            var year = '<?php echo date('Y') ?>';        
            var staticdir='<?php echo $uri_root ?>';
        </script>
        <script type='text/javascript' src='<?php echo js_link('swfobject.js') ?>'></script>
        <script type='text/javascript' src='<?php echo js_link('chat.js') ?>'></script>
        <script type='text/javascript'>
            var operamini=0;
<?php if (!isset($_SESSION["user"])) { ?>
        var user='';
        var getmsgIntv=20000;
        var loggedin=0;
<?php } else { ?>
        var user='<?php echo $_SESSION["user"]['fullname'] ?>';
        var getmsgIntv=3000;
        var loggedin=1;
<?php } ?>
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
        <script type="text/javascript">
            function updatelayerheight(){
                var chatbarheight=$('#chatbar').height();
                var topbarheight=$('#topbar').height();
                $('#chatcontent').css({'height':$(window).height()-chatbarheight-topbarheight,'bottom':chatbarheight});
                $('.layercontent').css({'height':$(window).height()-topbarheight});
            }
            function rednumClear(group){
                $('.'+group+'_sw').find('.rednum').remove();
            }
            function notify(noti,group){
                if(!group)
                    group='info';
                var line=$('<div class="noti_line noti_line_new"></div>');
                line.append($(noti));
                line.hover(function(){$(this).addClass('noti_line_hover')}, function(){$(this).removeClass('noti_line_hover')});
                line.click(function(){rednumClear(group); $(this).removeClass('noti_line_new')});
                $('.layer.'+group+'_layer > .layercontent').prepend(line);	
                var notinumber = $('.bar_sw.'+group+'_sw').find('.rednum');
                if(notinumber.length){
                    var currnum=$('.bar_sw.'+group+'_sw').find('.rednum').html();
                    currnum=currnum*1+1;
                    notinumber.html(currnum);
                }else{
                    var notinumber=$("<span class=rednum>1</span>");
                    $('.bar_sw.'+group+'_sw').append(notinumber);
                }	
            }
        </script>
        <style type="text/css">
            * {
                font-family: arial,sans-serif;
                font-size: 12px;
            }
            a:link,a:visited,a:hover,a:active {text-decoration: none;color: #069}
            a:visited {color: #884270}
            a:active,a:hover {color: #ff8022}
            #topbar{position:fixed; top:0; left:0; width:100%; z-index:300; height:32px; background:url('<?php echo $uri_root ?>public/client/images/mobilebarbg.png') repeat-x; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);}
            #sw_holder{position:fixed; top:0; right:0; height:32px; width:120px; background:url('<?php echo $uri_root ?>public/client/images/mobilebarbg.png') repeat-x; z-index:301}
            .layercontent{position:fixed; top:32px; left:0; overflow:auto; width:100%}
            .bar_sw{display:inline-block; width:23px; height:23px; margin:5px 6px 0 6px; position:relative;  background:url('<?php echo $uri_root ?>public/client/images/mobile.png') scroll no-repeat transparent; cursor:pointer}
            .menu_sw{background-position: -39px -10px}
            .menu_sw.active{background-position: -10px -10px}

            .info_sw{background-position: -94px -8px}
            .info_sw.active{background-position: -68px -8px}

            .msg_sw{background-position: -151px -8px}
            .msg_sw.active{background-position: -122px -8px}

            .friend_sw{background-position: -211px -9px}
            .friend_sw.active{background-position: -181px -9px}

            .rednum{display:inline-block;background:red; border-radius:3px; color:white; padding:1px 2px; position:absolute; bottom:12px; left:14px; font-size:10px; font-weight:bold; z-index:400}
            #chat_handler_holder{position:fixed; top:6px; left:40px; right:0; height:23px; overflow:hidden; z-index:301}

            .noti_line{padding:3px; color:#525252; font-size:11px; font-family:tahoma,arial; border-bottom:#EBEFFC 1px solid}
            .noti_line div{font-size:11px; font-family:tahoma,arial}
            .noti_line_new{background:#FFF2C6}
            .noti_line_hover{background:#FFFFFF; color:#404040}
            .settingmenubutton:link,.settingmenubutton:visited,.settingmenubutton:hover,.settingmenubutton:active{display:block; margin:4px}
        </style>
    </head>
    <body>
        <div id='topbar'>
            <span class='bar_sw menu_sw' rel='menu'></span>
            <div id='chat_handler_holder'></div>
            <div id='sw_holder' style="width:85px">
                <span class='bar_sw friend_sw' rel='friend'></span>
                <span class='bar_sw msg_sw' rel='msg'></span>
                <span class='bar_sw info_sw' rel='info' style="display:none"></span>
            </div>
        </div>
        <div class='layer chatroom'>
            <div id='chatcontent' class='chatcontent' style='margin:0; position:fixed; left:0; z-index:100; width:100%; overflow:auto'></div>
            <div id='chatbar' style='position:fixed; left:0; bottom:0; width:100%; background:white; z-index:200'>
                <div style='border-top:#E1E1E1 1px solid; padding:4px'>
                    <form name=f style='margin:0'>
                        <div>
                            <div style='float:left' id='emoticonbar'></div>
                            <div style='float:left; padding-top:3px; padding-left:10px'>
                                <input name='soundsw' id='soundsw' type=checkbox checked onchange='var thisset=this.checked?1:0; setCookie("soundsw",thisset,9999); playchatsound=thisset' /><label for='soundsw' style='font-size:11px; color:#494949' title='Bật âm thanh khi có tin nhắn mới'>Âm thanh</label>
                            </div>
                            <div style='float:left; padding-top:7px; padding-left:10px'><a href='<?php echo $uri_root ?>chat-luu-tru.html'>Lưu trữ</a></div>
                            <div class='clear'></div>
                        </div>	
                    </form>
                    <div id='editor_holder' style='position:relative; border:#C3C3C3 1px solid; margin-top:1px'><iframe id='chat_editor' class='chat_editor' frameborder=0></iframe><a class='tool_button chat_send_button' style='margin-left:3px; padding:6px 7px; position:absolute; right:3px; top:3px' href='#'>&nbsp;&nbsp;Gửi&nbsp;&nbsp;</a><div class='clear'></div></div>
                </div>
            </div>
        </div>
        <div class='layer friend_layer' style='display:none'><div class='layercontent'>
                <div style='padding:4px'>
                    <span id="searcharea">
                        <div id='search_caption'>Nhập tên thành viên cần tìm</div>
                        <input type=text autocomplete=off name='sq' id='sq' style='margin:0 20px 0 2px; width:230px; height:22px; border:none; background:none' />
                        <div style='width:16px; height:16px; background:url(<?php echo $uri_root ?>public/client/images/search.png); overflow:hidden; position:absolute; top:3px; right:2px; cursor:pointer; *cursor:hand' onclick='ajaxsearch($("#sq").val(),1)' title='Tìm thành viên'>&nbsp;</div>
                    </span>
                    <style type="text/css">
                        #searcharea{display:inline-block; position:relative; margin:3px; 0; border:#c5c5c5 1px solid; z-index:98;}
                        #search_caption{position:absolute; bottom:4px; left:5px; font-size:11px; color:#818181}
                        #searchres_holder{position:absolute; z-index:1003; top:22px; left:-1px; border:#c5c5c5 1px solid; width:252px; max-height:320px; *height:320; *position:relative; overflow:auto; background:white; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                                          -webkit-box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);  
                                          -moz-box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); }
                        .searchres{background:#fff; border-bottom:#ebebeb 1px solid; padding:3px; overflow:hidden; cursor:pointer; cursor:hand}
                        .searchres .name{color:#802a00; font-weight:bold; display:inline-block; margin-left:2px}
                        .searchres .email{color:#5F5F5F}
                        .searchres_hover{background:#b8100d}
                        .searchres_hover .name{color:#FFFFFF; font-weight:bold}
                        .searchres_hover .email{color:#CFCFCF}
                        .online{display:inline-block; overflow:hidden; width:11px; height:11px; background:url(<?php echo $uri_root ?>public/client/images/online.png) no-repeat; *background-image:none; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=images/online.png, sizingMethod=scale)}
                        .offline{display:inline-block; overflow:hidden; width:11px; height:11px; background-image:url(<?php echo $uri_root ?>public/client/images/offline.png); *background-image:none; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=images/offline.png, sizingMethod=scale)}
                    </style>
                    <script type="text/javascript">
                        var search_xhr=0;
                        var currsq='';
                        function ajaxsearch(q,force){
                            if(q.length>0&&(q!=currsq || force)){
                                currsq=q;
                                if(search_xhr!=0)
                                    search_xhr.abort();
                                search_xhr=$.ajax({url:"<?php echo $uri_root ?>chat_ajaxsearch?q="+q,
                                    success:function(html){
                                        $('#searchres_holder').remove();
                                        if(html.length>0){
                                            var data=eval('('+html+')');
                                            var searchres_holder=$('<div id="searchres_holder"></div>');
                                            for(i in data){
                                                var res=data[i];
                                                var useronline=$('#useronlinearea > .useronline[rel='+res.uid+']').length>0;
                                                var re=$('<div class="searchres '+(i==0?' searchres_hover':'')+'" rel="'+res.uid+'"><span class="'+(useronline?'online':'offline')+'">&nbsp;</span><span class="name">'+res.name+'</span><br><div class="email">'+res.email+'</div></div>');
                                                re.hover(function(){$('.searchres_hover').removeClass('searchres_hover'); $(this).addClass('searchres_hover')}, function(){});
                                                re.click(function(){
                                                    var remoteId=$(this).attr('rel');
                                                    var remoteName=$(this).find('.name').first().html();
                                                    ppchatInit(remoteId,remoteName,0,1);
                                                });
                                                searchres_holder.append(re);
                                            }					
                                            $('#searcharea').append(searchres_holder);
                                            $('html').click(function(){searchres_holder.hide()});					
                                            //searchres_holder.click(function(event){
                                            //event.stopPropagation();
                                            //});
                                        }
                                    }
                                });
                            }
                        }
                        $('#search_caption').click(function(){$(this).hide();$('#sq').focus()});
                        $('#sq').focus(function(){$('#search_caption').hide(); $('#searchres_holder').show();});
                        $('#sq').blur(function(){if(!$(this).val())$('#search_caption').show()});
                        $('#sq').click(function(event){
                            event.stopPropagation();
                        });
                        $('#sq').keyup(function(e){
                            switch(e.keyCode){
                                case 38: { 
                                        var prev=$('.searchres_hover').prev();
                                        if(prev.html())
                                        {
                                            $('.searchres_hover').removeClass('searchres_hover');
                                            prev.addClass('searchres_hover');
                                        }
                                        return false;
                                        break;
                                    }
                                case 40: { 
                                        var next=$('.searchres_hover').next();
                                        if(next.html())
                                        {
                                            $('.searchres_hover').removeClass('searchres_hover');
                                            next.addClass('searchres_hover');
                                        }
                                        return false;
                                        break;
                                    }
                                case 27: { 
                                        $('#searchres_holder').hide();
                                        return false;
                                        break;
                                    }
                                case 13: { 
                                        var remoteId=$('.searchres_hover').attr('rel');
                                        var remoteName=$('.searchres_hover').find('.name').first().html();
                                        ppchatInit(remoteId,remoteName,0,1);
                                        $('#searchres_holder').hide();
                                        return false;
                                        break;
                                    }
                                default: {
                                        if(window.usersearchTimeoutId)
                                            clearTimeout(window.usersearchTimeoutId);
                                        window.usersearchTimeoutId=setTimeout(function(){ajaxsearch($('#sq').val())},200);
                                        break;
                                    }
                            }
                        });
                    </script>
                    <style type="text/css">
                        #useronlinearea{display:none}
                        .useronline{display:inline-block; margin:1px; margin-right:3px; color:#3A3C45; font-weight:bold; font-size:12px; font-family:arial; cursor:pointer; *cursor:hand; padding:2px; position:relative}
                        .useronline .statusicon{display:inline-block; overflow:hidden; width:11px; height:11px; background:url(<?php echo $uri_root ?>public/client/images/online.png) no-repeat; *background-image:none; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo $uri_root ?>public/client/images/online.png, sizingMethod=scale)}
                        .ol_new .statusicon{background-image:url(<?php echo $uri_root ?>public/client/images/status_red.png); *background-image:none; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo $uri_root ?>public/client/images/status_red.png, sizingMethod=scale)}
                        .useroffline .statusicon{background-image:url(<?php echo $uri_root ?>public/client/images/offline.png); *background-image:none; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo $uri_root ?>public/client/images/offline.png, sizingMethod=scale)}
                        .chatid_hover{color:#555; background:#ffef93; border-radius:2px; -moz-border-radius:2px; -webkit-border-radius:2px}
                        .banned{color:#838383; text-decoration:line-through}
                    </style>
                    <div style='font-weight:bold; color:#333; margin-bottom:5px'>Thành viên online (<span id='memberonlinecount' style='color:#008000'></span>): <a href='#' id='onlineshowtogger' class='msgtool'>[Hiện]</a></div>
                    <div id='useronlinearea'></div>
                    <div id='guestonlinearea' style="display:none"></div>
                    <div style='margin-top:10px' id='newuserarea'></div>

                    <script type='text/javascript'>
                        $('#onlineshowtogger').click(function(){
                            if($('#useronlinearea').is(':visible')){
                                $('#useronlinearea').hide('fast');
                                $(this).html('[Hiện]');
                            }else{
                                renderonlinelist(1);
                                $('#useronlinearea').show('fast');
                                $(this).html('[Ẩn]');
                            }
                            return false;
                        });
                        var onlinestatdata;
                        onlinestatupdate(1);
                        function onlinestatupdate(init){
                            $.ajax({url:"<?php echo $uri_root ?>chat_onlinestatdata?"+new Date().getTime(),
                                timeout:10000,
                                success: function(html){
                                    if(html.length){
                                        onlinestatdata=eval('('+html+')');
                                        onlinestatshow(init);
                                    }
                                    setTimeout('onlinestatupdate()',5000);
                                },
                                error:function(){setTimeout('onlinestatupdate()',5000);}
                            });
                        }
                        function onlinestatshow(init){		
                            $('#memberonlinecount').html(onlinestatdata.total);		
                            if(onlinestatdata.guest){
                                $('#guestonlinearea').html("<div style='font-weight:bold; color:#5D5D5D; margin-top:7px'>Khách: "+onlinestatdata.guest+"</div>");
                            }	
                            var newuser=onlinestatdata.newuser;
                            if(newuser){
                                if($('#newuserarea > div > .useronline').attr('rel')!=newuser.uid){
                                    $('#newuserarea').html("<div style='font-weight:bold; color:#9F00D5; text-align:center'>Chào mừng thành viên mới: </div><div style='text-align:center; padding-top:5px'><span id='last_reg_user' class='useronline' rel='"+newuser.uid+"'><span class='onlinename' style='font-size:14px'>"+newuser.name+"</span></span></div>");
                                    userhoverinit('#last_reg_user');
                                }
                            }
                            if($('#useronlinearea').is(':visible')){
                                renderonlinelist(init);
                            }	
                            friendstatus(init);
                        }
                        function renderonlinelist(init){
                            $('#useronlinearea > .useronline').addClass('updating');
                            var onlines=onlinestatdata.onlines;
                            if(onlines.length){
                                for(i in onlines){
                                    online=onlines[i];
                                    var thisonline=$('#useronlinearea > .useronline[rel='+online.uid+']');
                                    if(thisonline.length){
                                        thisonline.removeClass('updating');
                                        if(online.banned && !thisonline.find('.onlinename').hasClass('banned'))
                                            thisonline.find('.onlinename').addClass('banned');
                                        if(!online.banned && thisonline.find('.onlinename').hasClass('banned'))
                                            thisonline.find('.onlinename').removeClass('banned');
                                    }else{
                                        var newonlineuser=$('<span class="useronline'+(init?'':' ol_new')+'" rel="'+online.uid+'"><span class="statusicon">&nbsp;</span> <span class="onlinename'+(online.banned?' banned':'')+'">'+online.name+'</span></span>');
                                        userhoverinit(newonlineuser);
                                        $('#useronlinearea').append(newonlineuser);
                                    }
                                }
                                setTimeout(function(){$('.ol_new').removeClass('ol_new')},3000);
                            }
                            $('#useronlinearea > .updating').each(function(i,obj){			
                                $(obj).addClass('useroffline');
                                setTimeout(function(){$(obj).remove()},3000);
                            });	
                        }
                        function inOnlines(uid, onlines) {
                            for(var i in onlines) {
                                var online=onlines[i];
                                if(uid==online.uid) return true;
                            }
                            return false;
                        }
                        function friendstatus(){
                            if($('#friends_area > .useronline').length){
                                $('#friends_area > .useronline').each(function(i,obj){
                                    var thisid=$(obj).attr('rel');
                                    var thisname=$(obj).find('.onlinename').html()
                                    var beingoffline=$(obj).hasClass('useroffline');
                                    if(inOnlines(thisid,onlinestatdata.onlines)){
                                        if(beingoffline){
                                            $(obj).removeClass('useroffline');
                                            if(window.friendlistloaded&&typeof(floatnotify)!='undefined')
                                                floatnotify($('<div><b>'+thisname+'</b> vừa online</div>'));
                                        }
                                    }else if(!beingoffline){
                                        $(obj).addClass('useroffline');
                                        if(window.friendlistloaded&&typeof(floatnotify)!='undefined')
                                            floatnotify($('<div><b>'+thisname+'</b> đã thoát ra</div>'));
                                    }
                                });	
                                var totalfriend=$('#friends_area > .useronline').length;
                                var offlinecount=$('#friends_area > .useroffline').length;
                                $('#friendcount').html((totalfriend-offlinecount)+'/'+totalfriend);
                                window.friendlistloaded=1;
                            }
                        }
                        function userhoverinit(items){
                            window.timeoutId=window.timeoutId||[];
                            $(items).hover(function(e){
                                var thisuid=$(this).attr('rel');
                                $(this).addClass('chatid_hover');
                                var handler=$(this);
                                window.timeoutId['userInfoPop']=setTimeout(function(){userinfopop(handler,thisuid)},500);
                            },
                            function(){
                                $(this).removeClass('chatid_hover');
                                clearTimeout(window.timeoutId['userInfoPop']);
                                hideuserinfopop(this);
                            })
                            .click(function(){
                                var receiver=$(this).attr('rel');
                                receiverName=$(this).find('.onlinename').html();
                                ppchatInit(receiver,receiverName,0,1);
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class='layer msg_layer' style='display:none'>
            <div class='layercontent'>
                <div id='chatlistholder'></div>
                <style type="text/css">
                    .conver{padding:4px}
                    .conver .remotename{color:#ac3b56; font-weight:bold; font-size:12px}
                    .conver .msgcontent{color:#333; font-size:11px; padding:3px 0; font-family:tahoma}
                    .conver .msgtime{color:#838383; font-size:11px; font-family:tahoma}
                    .conver_hover{background:#EFEDE7; cursor:pointer}
                    .repmark{display:inline-block; width:10px; height:10px; overflow:hidden; background:url('<?php echo $uri_root ?>public/client/images/icons.png') scroll no-repeat -139px -41px}
                </style>
                <script type="text/javascript">
                    var convercount=0;
                    function getchatlist(start,limit){
                        $('#chatlistholder').append('<div class="loading" style="text-align:center"><img src="<?php echo $uri_root ?>public/client/images/loading7.gif"></div>');
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
                            $('#chatlistloadmorebutton').click(function()
                            {
                                if(!$('#chatlistholder').find('.loading').length)
                                    getchatlist(convercount,20);
                                return false;
                            });
                        }
                    }
                </script>
            </div>
        </div>
        <?php if (isset($_SESSION["user"])) { ?>
            <script type='text/javascript'>$(document).ready(function(){getchatlist(0,15)});</script>
        <?php } ?>

        <div class='layer info_layer' style='display:none'>
            <div class='layercontent'></div>            
        </div>
        <div class='layer menu_layer' style='display:none'>
            <div class='layercontent'>
                <a href='<?php echo $uri_root ?>' class='a_button_light settingmenubutton'>Trở về trang chủ</a>
                <a href='<?php echo $uri_root ?>dang-nhap.html' class='a_button_light settingmenubutton'>Đăng nhập</a>
            </div>
        </div>
        <script type="text/javascript">
            $('.bar_sw').click(function(){
                var thislayer=$(this).attr('rel');
                if($(this).hasClass('active')){
                    $(this).removeClass('active');	
                    $('.layer').hide();
                    $('.layer.chatroom').show();
                    scrollcontent('chatcontent',1);
                } else {
                    $('.bar_sw').removeClass('active');
                    $(this).addClass('active');
                    $('.layer').hide();
                    $('.layer.'+thislayer+'_layer').show();
                    rednumClear(thislayer);
                }
                updatelayerheight();
                return false;
            });

            initEditor('chat_editor','chatcontent');
            emoticonBar('emoticonbar','chat_editor');
            $(document).ready(function(){getmsg(1)});

            $(window).resize(function(){updatelayerheight()});
            updatelayerheight();
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