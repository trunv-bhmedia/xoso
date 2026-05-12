<link rel="stylesheet" href="/public/client/assets/jquery-ui-1.12.1.custom/jquery-ui.min.css">
<link rel="stylesheet" href="/public/client/assets/font-awesome-4.7.0/css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="/public/client/assets/css/style.css" />
<script src="/public/client/assets/js/jquery-ui.min.js"></script>
<script src="/public/client/assets/js/function.js"></script>
<?php

function rebuild_date($format, $time = 0) {
    if (!$time)
        $time = time();

    $lang = array();
    $lang['sun'] = 'CN';
    $lang['mon'] = 'T2';
    $lang['tue'] = 'T3';
    $lang['wed'] = 'T4';
    $lang['thu'] = 'T5';
    $lang['fri'] = 'T6';
    $lang['sat'] = 'T7';
    $lang['sunday'] = 'Chủ nhật';
    $lang['monday'] = 'Thứ hai';
    $lang['tuesday'] = 'Thứ ba';
    $lang['wednesday'] = 'Thứ tư';
    $lang['thursday'] = 'Thứ năm';
    $lang['friday'] = 'Thứ sáu';
    $lang['saturday'] = 'Thứ bảy';
    $lang['january'] = 'Tháng Một';
    $lang['february'] = 'Tháng Hai';
    $lang['march'] = 'Tháng Ba';
    $lang['april'] = 'Tháng Tư';
    $lang['may'] = 'Tháng Năm';
    $lang['june'] = 'Tháng Sáu';
    $lang['july'] = 'Tháng Bảy';
    $lang['august'] = 'Tháng Tám';
    $lang['september'] = 'Tháng Chín';
    $lang['october'] = 'Tháng Mười';
    $lang['november'] = 'Tháng M. một';
    $lang['december'] = 'Tháng M. hai';
    $lang['jan'] = 'T01';
    $lang['feb'] = 'T02';
    $lang['mar'] = 'T03';
    $lang['apr'] = 'T04';
    $lang['may2'] = 'T05';
    $lang['jun'] = 'T06';
    $lang['jul'] = 'T07';
    $lang['aug'] = 'T08';
    $lang['sep'] = 'T09';
    $lang['oct'] = 'T10';
    $lang['nov'] = 'T11';
    $lang['dec'] = 'T12';

    $format = str_replace("r", "D, d M Y H:i:s O", $format);
    $format = str_replace(array("D", "M"), array("[D]", "[M]"), $format);
    $return = date($format, $time);

    $replaces = array(
        '/\[Sun\](\W|$)/' => $lang['sun'] . "$1",
        '/\[Mon\](\W|$)/' => $lang['mon'] . "$1",
        '/\[Tue\](\W|$)/' => $lang['tue'] . "$1",
        '/\[Wed\](\W|$)/' => $lang['wed'] . "$1",
        '/\[Thu\](\W|$)/' => $lang['thu'] . "$1",
        '/\[Fri\](\W|$)/' => $lang['fri'] . "$1",
        '/\[Sat\](\W|$)/' => $lang['sat'] . "$1",
        '/\[Jan\](\W|$)/' => $lang['jan'] . "$1",
        '/\[Feb\](\W|$)/' => $lang['feb'] . "$1",
        '/\[Mar\](\W|$)/' => $lang['mar'] . "$1",
        '/\[Apr\](\W|$)/' => $lang['apr'] . "$1",
        '/\[May\](\W|$)/' => $lang['may2'] . "$1",
        '/\[Jun\](\W|$)/' => $lang['jun'] . "$1",
        '/\[Jul\](\W|$)/' => $lang['jul'] . "$1",
        '/\[Aug\](\W|$)/' => $lang['aug'] . "$1",
        '/\[Sep\](\W|$)/' => $lang['sep'] . "$1",
        '/\[Oct\](\W|$)/' => $lang['oct'] . "$1",
        '/\[Nov\](\W|$)/' => $lang['nov'] . "$1",
        '/\[Dec\](\W|$)/' => $lang['dec'] . "$1",
        '/Sunday(\W|$)/' => $lang['sunday'] . "$1",
        '/Monday(\W|$)/' => $lang['monday'] . "$1",
        '/Tuesday(\W|$)/' => $lang['tuesday'] . "$1",
        '/Wednesday(\W|$)/' => $lang['wednesday'] . "$1",
        '/Thursday(\W|$)/' => $lang['thursday'] . "$1",
        '/Friday(\W|$)/' => $lang['friday'] . "$1",
        '/Saturday(\W|$)/' => $lang['saturday'] . "$1",
        '/January(\W|$)/' => $lang['january'] . "$1",
        '/February(\W|$)/' => $lang['february'] . "$1",
        '/March(\W|$)/' => $lang['march'] . "$1",
        '/April(\W|$)/' => $lang['april'] . "$1",
        '/May(\W|$)/' => $lang['may'] . "$1",
        '/June(\W|$)/' => $lang['june'] . "$1",
        '/July(\W|$)/' => $lang['july'] . "$1",
        '/August(\W|$)/' => $lang['august'] . "$1",
        '/September(\W|$)/' => $lang['september'] . "$1",
        '/October(\W|$)/' => $lang['october'] . "$1",
        '/November(\W|$)/' => $lang['november'] . "$1",
        '/December(\W|$)/' => $lang['december'] . "$1");

    return preg_replace(array_keys($replaces), array_values($replaces), $return);
}
?>
<div class="main-vietlot-page-m6 main-vietlot-page-max4">
    <h1 class="title-page-max4">KẾT QUẢ TRÚNG THƯỞNG<p class="mini-title">XỔ SỐ VIETLOTT MAX 4D</p></h1>
    <section class="module mod-max4d-curent" id="resultbyday">
        <div class="box_kqxs box_cc">
            <?php
            for ($i = 0; $i < 3; $i++) {
                $item = $vietlottmax4d[$i];
                $data_max_content = json_decode($item->content);
                ?>
                <div id="kqxs_max4d">
                    <div class="result-header">
                        <h2>
                            <span>Xổ số MAX 4D <?php echo rebuild_date('l', strtotime($item->date)); ?> ngày <?php echo date('d/m/Y', strtotime($item->date)) ?></span>                    
                        </h2>
                        <div class="div-toolbar" style="display: none;">
                            <a href="javascript:void(0)" class="printResult" onclick="window.print()"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                    <div class="box_so">
                        <div class="box_so_left">
                            <table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#dedede">
                                <tbody>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải nhất</td>
                                        <td colspan="12" class="web_XS_2 chukq">
                                            <span class="do">
                                                <span class="do"><?php echo $data_max_content->content->nd->g1->kq; ?></span>                </span>
                                        </td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải nhì</td>
                                        <?php $giainhi = explode('-', $data_max_content->content->nd->g2->kq); ?>
                                        <td colspan="6" class="web_XS_2 chukq"><?php echo trim($giainhi[0]); ?></td>
                                        <td colspan="6" class="web_XS_2 chukq"><?php echo trim($giainhi[1]); ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải ba</td>
                                        <?php $giaiba = explode('-', $data_max_content->content->nd->g3->kq); ?>
                                        <td colspan="4" class="web_XS_2 chukq"><?php echo trim($giaiba[0]); ?></td>
                                        <td colspan="4" class="web_XS_2 chukq"><?php echo trim($giaiba[1]); ?></td>
                                        <td colspan="4" class="web_XS_2 chukq"><?php echo trim($giaiba[2]); ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải khuyến khích 1</td>
                                        <td colspan="12" class="web_XS_2 chukq"><?php echo trim($data_max_content->content->nd->kk1->kq); ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải khuyến khích 2</td>
                                        <td colspan="12" class="web_XS_2 chukq"><?php echo trim($data_max_content->content->nd->kk2->kq); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if ($i == 0) { ?>
                    <table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#dedede" class="cbv-tbl2">
                        <tbody>
                            <tr class="web_bg_title_tinh">
                                <td colspan="3" class="web_XS_1 chugiai bg_do">Cơ cấu Giải thưởng</td>
                            </tr>
                            <tr class="table_lmt_title">
                                <td>Giải thưởng</td>
                                <td>Kết quả</td>
                                <td>Giá trị giải thưởng (VNĐ)</td>
                            </tr>
                            <tr>
                                <td>Giải nhất</td>
                                <td>Trùng số trúng giải Nhất theo đúng thứ tự các chữ số</td>
                                <td>15.000.000</td>
                            </tr>
                            <tr>
                                <td>Giải nhì</td>
                                <td>Trùng bất kỳ 1 trong 2 số trúng giải Nhì theo đúng thứ tự của các chữ số</td>
                                <td>6.500.000</td>
                            </tr>
                            <tr>
                                <td>Giải ba</td>
                                <td>Trùng bất kỳ 1 trong 3 số trúng giải Ba theo đúng thứ tự của các chữ số</td>
                                <td>3.000.000</td>
                            </tr>
                            <tr>
                                <td>Giải Khuyến khích 1</td>
                                <td>3 chữ số cuối của số tham gia dự thưởng trùng 3 chữ số cuối của số trúng giải Nhất theo đúng thứ tự của các chữ số</td>
                                <td>1.000.000</td>
                            </tr>
                            <tr>
                                <td>Giải Khuyến khích 2</td>
                                <td>2 chữ số cuối của số tham gia dự thưởng trùng 2 chữ số cuối của số trúng giải Nhất theo đúng thứ tự của các chữ số</td>
                                <td>100.000</td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
            <?php } ?>                        
        </div>
    </section>
    <script type="text/javascript">
        function dovetheongay4d(type) {
            $(".main-vietlot-home .box-loading").show();
            var datedove = $("#DateResultLotteDate").val();
            var number_soi = $("input[name='number4d_soi[]']").map(function () {
                return $(this).val();
            }).get();
            // var number_soi = $("#number4d_soi").val();                   
            //alert(number_soi); 
            $.ajax({
                url: "/crawl/index.php?task=max4ddongay",
                method: "post",
                data: {
                    datedove: datedove,
                    number_soi: number_soi,
                    type: type
                },
                success: function (result) {
                    $(".main-vietlot-home .box-loading").hide();
                    $("#loading").hide();
                    if (result !== "") {
                        $("#result_by_day").html(result);
                    }
                },
                error: function (e) {
                    $("#loading").hide();
                    console.log(e.message);
                }
            });
        }
    </script>
    <section class="module mod-dove-max4d">
        <div class="form-soi-cau">
            <h3 class="text-do-ve"><i class="fa fa-compass"></i> Dò vé số</h3>
            <p id="pick_date" class="cbv-margin-input">
                <input name="data[DateResult][lotteDate]" class="picker datepicker-xsmt" placeholder="Chọn ngày" data-direction="false" data-change="http://xosovietnam.vn/homes/getRegionByDate" required="required" type="text" value="<?php echo date('d-m-Y'); ?>" id="DateResultLotteDate" readonly="readonly" ><button type="button" class="Zebra_DatePicker_Icon Zebra_DatePicker_Icon_Inside" >Pick a date</button>
                <script>
                    $(function () {
                        $("#DateResultLotteDate").datepicker();
                        $(".Zebra_DatePicker_Icon").click(function () {
                            $("#DateResultLotteDate").datepicker('show');
                        });
                        $("#ui-datepicker-div").addClass("cbv-choose-date-m4d");
                    });
                </script>
            </p>
            <p class="input tel cbv-margin-input" id="cbv-appen-input">
                <input name="number4d_soi[]" id="number4d_soi[]" class="date-chooser datepicker number4d" placeholder="Nhập số ..." maxlength="4" autocomplete="off" type="tel" value="" required="required">
            </p> 
            <p class="item-cbv-clear">
                <a class="add-more-number" id="add-click-appInput" data-sub='1' data-number_id="1" href="javascript:void(0)"  onClick = "cbvAppenInput();">Thêm số dò</a>    
            </p>
            <p id="chose_button" class="pt-100 pt-m-100 pt-btn-ds submit-button-box pt-btn-ds-2 search-button-4d">
                <button type="submit" class="search-button" id="btnCheck" onclick="dovetheongay4d()">Xem Kết Quả</button>
            </p>
        </div>
        <div id="result_by_day"></div>
    </section>
    <script type="text/javascript">
        function dovebyday4d(dateString) {
            $(".main-vietlot-home .box-loading").show();

            $.ajax({
                url: "/crawl/index.php?task=max4ddongay2",
                method: "post",
                data: {
                    datedove: dateString
                },
                success: function (result) {
                    $(".main-vietlot-home .box-loading").hide();
                    $("#loading").hide();
                    if (result !== "") {
                        $("#resultbyday").html(result);
                    }
                    $("html, body").animate({scrollTop: 0}, "slow");
                    return false;
                },
                error: function (e) {
                    $("#loading").hide();
                    console.log(e.message);

                }
            });
        }
    </script>
    <section class="module mod-loc-ngay-thang">
        <header class="result-header">
            <h2><a href="#" title="kết quả xố số miền bắc">Kết quả xổ số ngày</a></h2>
        </header>
        <div id="datepickerCbvCustom"></div>
        <script type="text/javascript">
            $(function () {
                $("#datepickerCbvCustom").datepicker({
                    onSelect: function (date) {
                        var daySelect = $(this).datepicker("getDate");
                        var dateString = $.datepicker.formatDate("yy-mm-dd", daySelect);
                        dovebyday4d(dateString);
                    }
                });
            });
        </script>
    </section>
    <div class="box-bottom-head">
        <ul class="list-vl">
            <li><a href="/tin-xo-so/co-cau-chuong-trinh-xo-so-tu-chon-max-4d.html">Cơ cấu chương trình xổ số tự chọn MAX 4D - Vietlott</a></li>
            <li><a href="/tin-xo-so/co-cau-giai-thuong-xo-so-max-4d---vietlott.html">Cơ cấu giải thưởng xổ số MAX 4D - Vietlott</a></li>
            <li><a href="/tin-xo-so/huong-dan-cach-choi-xo-so-dien-toan-tu-chon-max-4d---vietlott.html">Hướng dẫn cách chơi xổ số điện toán tự chọn MAX 4D - Vietlott</a></li>
        </ul>
    </div><br>
    <div class="box box-html" style="padding: 0 10px; line-height: 1.5; font-size: 14px">

        <p><a href="http://xoso.com/vietlott/max4d.html" title="KQXS Max4D"><span style="color:#0000FF"><strong>KQXS Max4D</strong></span></a> – kết quả xổ số điện toán tự chọn số Max4D Vietlott hôm nay được quay số mở thưởng trực tiếp tại trung tâm quay số mở thưởng xổ số tự chọn Vietlott có trụ sở tại tầng 19, tòa nhà VTC (số 23 Lạc Trung, Hai Bà Trưng, Hà Nội) vào lúc 18h10p và kết thúc vào 18h30p các ngày thứ 3, thứ 5 và thứ 7 hàng tuần.</p>

        <p>Max 4D là trò chơi xổ số tự chọn có xác xuất trúng thưởng cao nhất hiện nay, đây là một trong những sản phẩm mới của Vietlott được phát hành từ ngày 18/11/2016 thu hút đông đảo người chơi. Theo ghi nhận thì Max4D đã có người trúng tới 750 triệu đồng.</p>

        <p>Để theo dõi kết quả xổ số Max4D nhanh chóng và chính xác nhất hãy truy cập ngay vào <a href="http://xoso.com/" title="KQXS"><span style="color:#0000FF"><strong>KQXS</strong></span></a> để có được thông tin hàng ngay.</p>

        <p>Xoso.com cung cấp kết quả xổ số Max4D – KQXS Max4D – XS Max4D – SX Max4D – XS 4D trực tiếp trên máy tính và smartphone một cách nhanh nhất và chuẩn nhất trên khắp mọi miền đất nước.</p>

        <p><strong>CÔNG TY TNHH MTV XỔ SỐ ĐIỆN TOÁN VIỆT NAM (VIETLOTT):</strong></p>

        <p><strong>Trụ sở chính:</strong></p>

        <p>Công ty Xổ Số Điện Toán Việt Nam</p>

        <p>Địa chỉ: Tầng 15, Tòa nhà CornerStone, 16 Phan Chu Trinh, Quận Hoàn Kiếm, Hà Nội (Xem bản đồ)</p>

        <p>Tel: 04.62.686.818 Fax: 04.62.686.800</p>

        <p><strong>Chi nhánh Hồ Chí Minh:</strong></p>

        <p>Địa chỉ: Số 93-95, Hàm Nghi, Quận 1, Tp. Hồ Chí Minh (Xem bản đồ)</p>

        <p>Tel: 08.38.212.629</p>

        <p><strong>Chi nhánh Cần Thơ:</strong></p>

        <p>Địa chỉ: 62 Lý Tự Trọng, phường An Cư, quận Ninh Kiều, thành phố Cần Thơ (Xem bản đồ)</p>

        <p>Tel: 0710.6 252 245</p>

        <p><strong>Chi nhánh Bà Rịa - Vũng Tàu:</strong></p>

        <p>Địa chỉ: Số 4 Trần Hưng Đạo, Phường 3, thành phố Vũng Tàu, tỉnh Bà Rịa - Vũng Tàu.</p>

        <p><strong>Chi nhánh Khánh Hòa:</strong></p>

        <p>Địa chỉ: Tầng 2, tòa nhà LienVietPostBank, số 69-71 Thống Nhất, thành phố Nha Trang, tỉnh Khánh Hòa.</p>

        <p><strong>Chi nhánh Hải Phòng:</strong></p>

        <p>Địa chỉ: Số 255/16D, Khu dân cư Trung Hành 5, phường Đằng Lâm, quận Hải An, thành phố Hải Phòng.</p>


    </div>
</div>
