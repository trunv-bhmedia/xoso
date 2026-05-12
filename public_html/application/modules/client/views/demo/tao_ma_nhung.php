<script type="text/javascript" src="<?php echo js_link('jscolor/jscolor.js') ?>"></script>
<script type="text/javascript" src="<?php echo js_link('manhung.js') ?>"></script>
<h1 style="position: absolute; text-indent: -99999px">Chèn Kết quả Xổ Số vào Website, Blog của bạn</h1>
<div class="widget">
    <div class="title title-red">
        <div class="title-right">
            <strong>Chèn Kết quả Xổ Số vào Website, Blog của bạn</strong>
        </div>
    </div>
    <div class="box-notes">
        <p>Chọn tỉnh mặc định, hiệu chỉnh và lấy bảng KQXS phù hợp với khoản trống trên website của bạn. Ngoài ra bạn cũng có thể tùy biến lại code đễ có được kết quả vừa ý nhất! Xem thêm demo tham khảo <a href="<?php echo $uri_root ?>demo/index.html" class="red" target="_blank">Bấm đây!!!</a> </p>
        <div class="frm-w">
            <div class="rows clearfix">
                <label>KQXS Tỉnh</label>
                <div class="inut-box">
                    <select name="tinhx" id="box_kqxs_tinhx" onchange="javascript:getnew_code();">
                        <?php
                        foreach ($xs_location_menu as $value) {
                            echo '<option' . $selected . ' value="' . $value->alias . '">' . $value->name . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="rows clearfix">
                <label>Màu nền</label>
                <div class="inut-box"># <input class="color" name="title_bg" type="text" id="color_title_bg" value="9C0303" size="9" maxlength="6" /></div>
            </div>
            <div class="rows clearfix">
                <label>Màu tiêu đề</label>
                <div class="inut-box"># <input class="color" name="title_cl" type="text" id="color_title_cl" value="FFFFFF" size="9" maxlength="6" /></div>
            </div>
            <div class="rows clearfix">
                <label>Màu giải ĐB</label>
                <div class="inut-box"># <input class="color" name="db_cl" type="text" id="color_db_cl" value="A80804" size="9" maxlength="6" /></div>
            </div>
            <div class="rows clearfix">
                <label>Chiều rộng</label>
                <div class="inut-box"><input class="txt-text" name="crong" type="text" id="color_crong" value="500px" size="9" maxlength="7" onchange="javascript:getnew_code();"/> (90%,200px...)</div>
            </div>
            <div class="rows clearfix">
                <label>Font size</label>
                <div class="inut-box">
                    <select name="csize" id="color_size" onchange="javascript:getnew_code();">
                        <?php
                        for ($i = 8; $i <= 30; $i++) {
                            if ($i == 12)
                                echo '<option value="' . $i . '" selected="">' . $i . '</option>';
                            else
                                echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="rows clearfix">
                <label>Trực Tiếp Xổ Số</label>
                <div class="inut-box"><input class="txt-text" style="width:auto" name="tt" type="checkbox" id="color_tt" value="1" onchange="javascript:getnew_code();"/></div>
            </div>
        </div>
        <link href="<?php echo css_link('demo.css') ?>" rel="stylesheet" type="text/css" />
        <ul class="list-editor">
            <li><strong>Mã nhúng:</strong> Copy đoạn mã bên dưới chèn vào nơi bạn muốn bảng kết quả xổ số hiển thị trên website của bạn  </li>
        </ul>
        <div class="border">
            <textarea name="manhung" id="manhung" onclick="this.select();"></textarea>
        </div>
    </div>
    <ul class="list-editor">
        <li><strong>Xem trước:</strong></li>
    </ul>
    <div id="xemtruoc" class="border">
        <div id="box_kqxs"><a href="<?php echo $uri_root ?>ket-qua.html">Kết quả Xổ Số</a> từ <a href="<?php echo $uri_root ?>">XOSO.COM</a></div>        
    </div>
    <script type="text/javascript">$(document).ready(function(e) {getnew_code();});</script> 
</div>
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
<?php $this->load->view($layout_sms) ?>