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
    //var uid='<?php //echo isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : '' ?>';
    var year = '<?php echo date('Y') ?>';        
    var staticdir='<?php echo $uri_root ?>';
</script>
<script type='text/javascript' src='<?php echo js_link('swfobject.js') ?>'></script>
<script type='text/javascript' src='<?php echo js_link('chot.js') ?>'></script>
<script type='text/javascript'>
    var ngaychot='<?php echo $date_chot ?>';
    var chotlock=0;
    var lastchotid=0;
    var lastchotupdate=0;
    var chotlist_intv=30000;
    var chotlist_timeout=15000;
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
<h1 style="position: absolute; text-indent: -99999px">Chốt số lotto</h1>
<div class="page-title-xs"><strong>Chốt số ngày <?php echo date('d/m/Y', strtotime($date_chot)) ?></strong></div>
<form name='chotform' id='chotform' onsubmit='chotso(); return false'>
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
    $('.chotinput').keypress(function(){unlockchotform();});
    unlockchotform();
</script>
<div class="clear"></div>