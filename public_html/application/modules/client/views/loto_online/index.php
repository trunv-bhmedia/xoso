<link href="<?php echo css_link('jquery-ui-1.8.23.custom.css') ?>" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='<?php echo js_link('jquery-ui-1.8.23.custom.min.js') ?>'></script>
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
<script type='text/javascript'>
    //var uid='<?php //echo isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : '' ?>';
    var year = '<?php echo date('Y') ?>';
    var staticdir='<?php echo $uri_root ?>';
</script>
<div class="contentcontainer">
    <div id='loonlinenote' style='color:#414042; margin:5px 0'>Lotto Online tại Xoso.com là trò chơi miễn phí và <b>không cần nạp tiền</b>, nghĩa là bạn không cần phải có tiền trước trong tài khoản mà có thể ghi ngay tối đa 2000 điểm cho mỗi cặp số. Số tiền trong tài khoản của bạn không có giá trị rút thành tiền thật. <br>Người chơi có số điểm trong top 50 sẽ được vinh danh trên bảng vàng tại trang chủ. </div>
    <script type='text/javascript'>closable('#loonlinenote')</script>
    <?php if (!isset($_SESSION["user"])) { ?>
        <div class=msg>Hãy <a href='<?php echo $uri_root ?>dang-nhap.html'>đăng nhập</a> để sử dụng chức năng ghi và quản lý lôtô. <a href='<?php echo $uri_root ?>dang-nhap.html'>Đăng ký tại đây</a> nếu bạn chưa có tài khoản.</div>
        <br/>
    <?php } ?>
    <style type="text/css">
        .contentcontainer{font-family:arial,sans-serif}
        #ngay{padding:2px}
        input[type="text"]{padding:2px;height:15px;line-height:15px;font-family:arial,sans-serif}
        input[type="submit"]{cursor:pointer;font-family:arial,sans-serif}
        .contentcontainer a:link,.contentcontainer a:visited{color: #0051ca}
        .contentcontainer a:hover,.contentcontainer a:active{color: #ff8022}
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
        #lichsu{width:560px;height:560px;overflow:auto}
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
        var betlimit=2000;
        var curruser='<?php echo isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : '' ?>';
        var editrestrict=true;
        var ngaybet='<?php echo $date ?>';
        var balance=0;
        var balancedate='';
        var diem=0;
        var diemthang=0;
        var tt=0;
        var nextday='<?php echo $nextday ?>';
        loadImg("<?php echo img_link('delete.png') ?>");
        loadImg("<?php echo img_link('loading5.gif') ?>");
        loadImg("<?php echo img_link('loading6.gif') ?>");
    </script>
    <form id=betform name=betform action='' onsubmit='return betformsubmit()' style='font-size:13px; font-weight:bold; color:#353535; padding:3px; margin-bottom:5px'>
        <span style='font-size:12px'>Ngày: <input type=text size=8 id=ngay name=ngay style='font-size:12px; color:#8B2001' value='<?php echo date('d/m/Y', strtotime($date)) ?>' onchange='ngaychange(this.value)' /></span>
        Cặp số: <input type=text size=10 name=range style='font-size:15px; font-weight:bold; color:#bc1c18' title='Có thể nhập nhiều cặp số, cách nhau bằng dấu phẩy' />
        Số điểm: <input type=text size=2 name=bet style='font-size:15px; font-weight:bold; color:#62018B' />
        <input type=submit name='betsubmit' value='   Ghi   ' style='font-size:15px; font-weight:bold; color:#01468B;background-color: #b8100d;background-image: linear-gradient(to bottom, #b8100d, #960501);border: #980804 1px solid;color: #f1f4f8;font-weight:bold; font-size:12px;font-family:arial,sans-serif;height:23px;padding:0 10px;border-radius: 3px;-moz-border-radius: 3px;-webkit-border-radius: 3px' />
    </form>
    <?php if (isset($_SESSION["user"])) { ?>
        <div style='font-size:13px; color:#333; font-weight:bold; text-align:right; margin-bottom:5px'>Tài khoản hiện có: <span id="taikhoanloto">0</span> k</div><script type="text/javascript">$(document).ready(function() {$("#taikhoanloto").html(taikhoan)});</script>
        <div id='betarea' style='border:#cdcdcd 1px solid; display:none'>
            <div style='background:#f2f2f2; padding:5px'>
                <a name="betplace"></a> 
                <div style='float:left; font-weight:bold'>Ghi lô ngày <b id='ngaydisplay'><?php echo date('d/m/Y', strtotime($date)) ?></b></div>
                <div style='float:right; font-size:13px; font-weight:bold'>
                    Điểm:&nbsp;<span id='tongdiem' style='padding:3px; background:#616A89; color:white'>--</span>
                    Chi:&nbsp;<span id='tongchi' style='padding:3px; background:#616A89; color:white'>--</span>
                    Nhận:&nbsp;<span id='tongnhan' style='padding:3px; background:#0052CC; color:white'>--</span>
                    Lãi-lỗ:&nbsp;<span id='thangthua' style='padding:3px; background:#616A89; color:white'>--</span>
                </div>
                <div style='clear:both'></div>
            </div>
            <div id='betcontainer' style='padding:5px; position:relative'></div>	
            <div style='clear:both'></div>
        </div>
    <?php } ?>
    <div><a href='#' onclick='msgsw("aboutloonline"); return false'>(*) Cách tính thưởng Loto:</a></div>
    <div id='aboutloonline' style='display:none; margin:5px 0'>
        <span style='display:inline-block; color:#414141; padding:5px; background:#F8F8F8; border:#DADADA 1px solid'>
            <div>- Bạn phải chi 23k cho 1 điểm lô được ghi.</div>
            <div>- Bạn nhận được 80k cho mỗi điểm đã ghi nếu trúng 1 nháy, và nhận được n lần 80k nếu trúng n nháy.</div>
        </span>
    </div>
    <script type='text/javascript'>picker('ngay');edit_allow_check();</script>
    <?php if (isset($_SESSION["user"])) { ?>
        <div style='margin-top:10px; border:#cdcdcd 1px solid; float:left'>
            <div style='background:#f2f2f2; padding:5px; font-weight:bold'>Thống kê quá trình chơi</div>
            <div id='lichsu'></div>
            <a href="javascript:;" id="more_lichsu" style="text-align:right;padding:5px;display:block">Xem thêm</a>
        </div>
        <script type='text/javascript'>	
            $('#more_lichsu').click(function(){
                loadbetls(ngayls);
            });	
        </script>
        <script type='text/javascript'>betupdate(1);var ngayls=ngaybet;loadbetls(ngayls);</script>
    <?php } ?>
    <div style='clear:both'></div>
</div>