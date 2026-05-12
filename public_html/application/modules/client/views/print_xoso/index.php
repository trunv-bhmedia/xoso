<h1 style="position: absolute; text-indent: -99999px">IN VÉ DÒ - (IN BẢNG KẾT QUẢ XỔ SỐ)</h1>
<div class="title title-red">
    <div class="title-right">In Vé Dò KQXS</div>
</div>
<div class="box-result">								
    <div class="select-provice select-provice-num clearfix">
        <form id="form_search" method="get" target="_blank" action="<?php echo $uri_root ?>ve-do.html">
            <div class="rows clearfix">
                <div class="left left-space">
                    <label>Miền</label>
                    <select name="l" id="select_mien" tabindex="1">
                        <option value="1"<?php echo (isset($_GET['l'])&&$_GET['l']==1 ? ' selected=""': '')?>>Miền Bắc</option>
                        <option value="2"<?php echo (isset($_GET['l'])&&$_GET['l']==2 ? ' selected=""': '')?>>Miền Trung</option>
                        <option value="3"<?php echo (isset($_GET['l'])&&$_GET['l']==3 ? ' selected=""': '')?>>Miền Nam</option>
                    </select>
                </div>
                <div class="left numberbox">
                    <label>Ngày</label>
                    <span class="span-input">
                        <input class="txt-input txt-inputor" style="width:100px" type="text" id="date" name="d" value="<?php echo (isset($_GET['d']) ? $_GET['d']: date('d-m-Y'))?>" />
                    </span>
                </div>
            </div>
            <div class="rows clearfix t-cen">
                <span class="span-lookup"><input type="radio" value="1" name="t" checked="" /> In 4 bảng/A4</span>
                <span class="span-lookup"><input type="radio" value="3" name="t"<?php echo (isset($_GET['t'])&&$_GET['t']==3 ? ' checked=""': '')?> /> In 6 bảng/A4</span>
                <span class="span-lookup"><input type="radio" value="2" name="t"<?php echo (isset($_GET['t'])&&$_GET['t']==2 ? ' checked=""': '')?> /> In 1 bảng/A4</span>
                <input type="radio" value="4" name="t"<?php echo (isset($_GET['t'])&&$_GET['t']==4 ? ' checked=""': '')?> /> In giải và Loto
            </div>
            <div class="rows clearfix t-cen">
                <a class="read-more" href="javascript:;" onclick="document.getElementById('form_search').submit();"><span>In vé dò</span></a>
            </div>	
        </form>
    </div>    
</div>
<div class="line-red">&nbsp;</div>
<br/>
<div class="banner">
    <?php
    $arr_banner_middle = array();
    foreach ($banner as $v) {
        if ($v->position == 'middle' && ($v->page == 'all' || $v->page == $c_module)) {
            $arr_banner_middle[] = '<div><a target="_blank" href="' . $v->url . '" title="' . view_title($v->name) . '"><img src="' . site_url($v->image) . '" width="566" alt="' . view_title($v->name) . '" /></a></div>';
        }
    }
    echo $arr_banner_middle[array_rand($arr_banner_middle)];
    ?>
</div>
<div class="msg-block">
    XOSO.COM mang lại cho người dùng kết quả tường thuật trực tiếp từ trường quay trên cả 3 miền, nhanh nhất, còn có 1 tính năng cũng rất quan trọng là In Vé Dò, mong muốn mang lại cho các Đại lý vé số In Vé Dò một cách đơn giản, hiệu quả, nhanh nhất, thuận tiện nhất kết quả xổ số hàng ngày, hoặc in một ngày bất kỳ với nhiều mẫu in khác nhau. Chỉ cần 1 cú click là bạn có được dữ liệu chính xác nhất.
</div>
<script type="text/javascript">
    $(function(){$("#select_mien").selectbox()});
    $("#date").datepick({dateFormat: 'dd-mm-yyyy', maxDate: +0});
</script>
<style type="text/css">
    .tieude {
        color: #000000;
        font-size: 14px;
        font-family: Helvetica,Arial,sans-serif;
        border: 0px solid;
        padding: 10px;
        background:#CCC;
        border-bottom-left-radius:3ex;/*các trình duyệt khác*/
        border-bottom-right-radius:3ex;/*các trình duyệt khác*/
        border-top-left-radius:3ex;/*các trình duyệt khác*/
        border-top-right-radius:3ex;/*các trình duyệt khác*/
        -webkit-border-radius-bottomleft:3ex;/*Safari & google chrome*/
        -webkit-border-radius-bottomright:3ex;/*Safari & google chrome*/
        -webkit-border-radius-topleft:3ex;/*Safari & google chrome*/
        -webkit-border-radius-topright:3ex;/*Safari & google chrome*/
        -moz-border-radius-bottomleft:3ex;/*Firefox*/
        -moz-border-radius-bottomright:3ex;/*Firefox*/
        -moz-border-radius-topleft:3ex;/*Firefox*/
        -moz-border-radius-topright:3ex;/*Firefox*/
    }
    .noidung_a {
        text-align: center;
        color: #339966;
        font-size: 20px;
        font-family: Helvetica,Arial,sans-serif;
        font-weight: bold;
        text-decoration: underline;
        line-height:30px;
        display:block;
    }
    .noidung_b {
        text-align: left;
        color: #ff0000;
        font-size: 19px;
        font-family: Helvetica,Arial,sans-serif;
        text-decoration: underline;
        font-weight: bold;
        line-height:30px;
        padding:5px 0;
    }
    .clr {
        clear: both;
    }
</style>
<div class="msg-block">
    <p>&nbsp;</p>
    <span class="noidung_a">Hướng dẫn thiết lập máy in và trang in vé dò</span>
    <center>
        (Chỉ làm 1 lần đầu tiên, sau đó máy tính của bạn tự lưu thiết lập này)
    </center>
    <p class="noidung_b">I/ Thiết Lập Trang A4 cho máy in:</p>
    <p>***&nbsp;Để in KQXS trước tiên bạn phải có 1 máy in đã cài đặt và thiết lập khổ giấy <strong>A4</strong>.</p>
    <p>- Vào <strong>start &gt;&gt;&gt; Devices and Printers</strong> &gt;&gt;&gt; kích chuột phải vào máy in cần thiết lập trang <strong>A4</strong> chọn printer properties (hoặc properties đối với windows XP).</p>
    <p>- Tab <strong>General</strong> chọn <strong>Preferences...</strong> chọn tab <strong>Paper/Quality</strong> tại mục <strong>Paper Options</strong> chọn <strong>size is: A4</strong> xuống dưới chọn <strong>Apply &gt;&gt;&gt; OK.</strong></p>
    <p>&nbsp;</p><p>- Tab <strong>Advanced</strong> chọn <strong>Printing Defaults...</strong>chọn tab <strong>Paper/Quality</strong> tại mục <strong>Paper Options</strong> chọn <strong>size is: A4</strong> xuống dưới chọn <strong>Apply &gt;&gt;&gt; OK.</strong></p>
    <p class="noidung_b">II/ Thiết lập trang In Vé Dò:</p>
    <p>-Trên trang bạn thấy dưới mỗi bảng KQXS&nbsp;đều&nbsp;có nút <strong>In vé dò</strong> bạn click vào đó, Hộp thoại <strong>Print</strong> hiện lên, lần đầu này bạn nhấn <strong>Cancel.</strong></p>
    <p style="text-align:center;color:#03d70d; font-size:18px; font-family: Helvetica,Arial,sans-serif;padding:10px 0 5px">----Đối với trình duyệt Internet Explorer----</p><p>Vào <strong>File</strong>&gt;&gt;&gt; <strong>Page Setup... </strong>Chọn khổ giấy <strong>A4</strong>, chọn canh lề các bên = <strong>0</strong> (nhiều máy in không cho canh lề = 0 thì bạn chọn thông số nhỏ nhất) Các thông số khung <strong>Headers and Footers</strong> thiết lập <strong>Empty</strong>&gt;&gt;&gt; <strong>Click OK</strong> &gt; đóng. Vào <strong>File</strong>&gt;&gt;&gt;<strong>Print Preview... </strong>&gt; Xem lại thử trang in có hợp lý chưa.&nbsp;Nếu tất cả ok in test thử 1 tờ.</p>
    <p style="text-align:center;color:#03d70d; font-size:18px; font-family: Helvetica,Arial,sans-serif;padding:10px 0 5px">----Đối với trình duyệt Mozilla Firefox----</p>
    <p>Vào <strong>Tập tin</strong> &gt;&gt;&gt; <strong>Thiết lập trang... </strong> &gt;&gt;&gt; Chọn tab <strong>Lề&amp;Đầu trang/Cuối trang</strong> chọn canh lề các bên = <strong>0</strong> (nhiều máy in không cho canh lề = 0 thì bạn chọn thông số nhỏ nhất) &gt;&gt;&gt; Các thông số khung<strong> Đầu trang/Cuối trang </strong>thiết lập<strong>Trống</strong>&nbsp;&gt;&gt;&gt; <strong>Click OK</strong> &gt; đóng. Vào <strong>Tập tin</strong> &gt;&gt;&gt; <strong>Xem trước khi In</strong> &gt; Xem lại thử trang in có hợp lý chưa.&nbsp;Nếu tất cả ok in test thử 1 tờ.</p>
    <p style="text-align:center;color:#03d70d; font-size:18px; font-family: Helvetica,Arial,sans-serif;padding:10px 0 5px">----Đối với trình duyệt Google Chrome----</p><p>Khi Click&nbsp;&nbsp;<strong>In vé dò</strong> hộp thoại <strong>In</strong> của Google Chrome hiện ra bạn chọn <strong>Lề &gt;&gt;&gt; tối thiểu</strong>, bỏ chọn ở <strong>đầu trang và chân trang</strong>.</p><p><p>&nbsp;</p><p>Thế là xong, máy tính của&nbsp;bạn đã lưu lại&nbsp;thiết lập, từ giờ về sau muốn in bảng KQXS&nbsp;bạn chỉ cần Click&nbsp;&nbsp;<strong>In vé dò</strong> và <strong>Enter</strong> <em>(Nếu in Kết Quả Trực Tiếp thì vào xem trực tiếp đến giải cuối cùng Click&nbsp;&nbsp;</em><em></em><strong>In vé dò </strong><em>và <strong>Enter</strong>).</em></p>
    <p>-Muốn in nhanh KQXS của 1 ngày bất kỳ: <strong>Từ menu&nbsp;chính </strong> &gt; click vào <strong><a href="<?php echo $uri_root ?>in-ve-do.html" target="_blank">In vé dò</a></strong> &gt; chọn <strong>Miền</strong> &gt; Chọn <strong>ngày</strong> &gt; Click <strong>In Vé Dò</strong>&nbsp;&gt; <strong>Enter</strong> là có ngay KQXS của ngày đó.</p>
</div>