<link rel="stylesheet" href="/public/client/assets/jquery-ui-1.12.1.custom/jquery-ui.min.css">
<script src="/public/client/assets/js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/public/client/assets/font-awesome-4.7.0/css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="/public/client/assets/css/style.css" />
<script src="/public/client/assets/js/function.js"></script>

<script>

    function dovetheongay(type) {
        $(".main-vietlot-home .box-loading").show();
        var datedove = $("#datepicker-soi-cau").val();
        var numberSoDo = $("#add-click-appInputM6").attr('data-sub');

//        var a1 = [];
        var dsSoDo = new Array();
        var j = 0;
        for (var i = 1; i <= numberSoDo; i++) {
            j = i - 1;
            dsSoDo[j] = new Array();
            $('#form-ul-ss-' + i + ' input[name^="number_soi"]').each(function () {
                dsSoDo[j].push($(this).val());
            });
        }
        $.ajax({
            url: "/crawl/index.php?task=mega6dongay",
            method: "post",
            data: {
                datedove: datedove,
                dsSoDo: dsSoDo,
                type: type
            },
            success: function (result) {
//                console.log(result);return false;
                $(".main-vietlot-home .box-loading").hide();
                $("#loading").hide();
                if (result !== "") {
                    $("#dotheongay").html(result);
                }
            },
            error: function (e) {
                $("#loading").hide();
                console.log(e.message);
            }
        });
    }
    function dovetheothang(type) {
        $(".main-vietlot-home .box-loading").show();
        var datedovethang = $("#datepickerthang").val();
        var datedovenam = $("#datepickernam").val();
        $.ajax({
            url: "/crawl/index.php?task=mega6thang",
            method: "post",
            data: {
                datedovethang: datedovethang,
                datedovenam: datedovenam,
                type: type
            },
            success: function (result) {
                $(".main-vietlot-home .box-loading").hide();
                $("#loading").hide();
                if (result !== "") {
                    $("#month-result-box").html(result);
                }
            },
            error: function (e) {
                $("#loading").hide();
                console.log(e.message);
            }
        });
    }
    function prevNextResultGameMega645(object, type) {
        $(".main-vietlot-home .box-loading").show();
        $.ajax({
            url: "/crawl/index.php?task=mega6new",
            method: "post",
            data: {gameId: $(object).data("gameid"), drawId: $(object).data("drawid"), dayPrize: $(object).data("dayprize"), type: type},
            success: function (result) {
                $(".main-vietlot-home .box-loading").hide();
                $("#loading").hide();
                if (result !== "") {
                    $("#result-games").html(result);
                }
            },
            error: function (e) {
                $("#loading").hide();
                console.log(e.message);
            }
        });
    }

    function prevNextResultGameMax4D(object, type) {
        $(".main-vietlot-home .box-loading").show();
        $.ajax({
            url: "/crawl/index.php?task=max4d",
            method: "post",
            data: {gameId: $(object).data("gameid-max4d"), drawId: $(object).data("drawid-max4d"), dayPrize: $(object).data("dayprize-max4d"), type: type},
            success: function (result) {
                $(".main-vietlot-home .box-loading").hide();
                $("#loading").hide();
                if (result !== "") {
                    $("#result-games-max4d").html(result);
                }
            },
            error: function (e) {
                $("#loading").hide();
                console.log(e.message);
            }
        });
    }
 function cbvAppenInputM6() {
//    alert('gg');return false;
        var inputcurent = $('#add-click-appInputM6').attr('data-sub');
        var newInput = ++inputcurent;
        var optionInput = (newInput - 1) * 6;
        $('#add-click-appInputM6').attr("data-sub", newInput);
        var htmlAppen = "<ul class='form-ul-ss' id='form-ul-ss-" + newInput + "' data-dslist='" + newInput + "'>";
        for (var i = 1; i <= 6; i++) {
            ++optionInput;
            htmlAppen += "<li class='input tel'><input onkeyup='cbvGetChangePower(" + optionInput + ", this.value)'  name='number_soi[" + optionInput + "]' class='number-xsmt number-xsmt-0 index-" + optionInput + "' placeholder='--' maxlength='2' autocomplete='off' type='tel' id='number" + optionInput + "' data-id='" + optionInput + "'> </li>";
        }
        htmlAppen += "</ul>";

        $(".mod-chon-ngay-mt .groups-ul").append(htmlAppen);
    }

</script>        
<div class="main-vietlot-page-m6 main-vietlot-page-m6-2">
    <section class="module mod-luot-quay-tiep">
        <?php $arrUocTinh = json_decode($vietlottmega6gt); ?>
        <h2 class="jackpost-x-h1"><?php echo $arrUocTinh->ngay ?></h2>
        <h3 class="jackpost-x-h2 loading-h2"><?php echo $arrUocTinh->money ?></h3>
    </section>
    <section class="module mod-giai-da-quay" id="result-games">
        <div class="jackpost-xx mega645-box" >
            <h1 class="jackpost-xx-h2">KẾT QUẢ TRÚNG THƯỞNG<br>MEGA 6/45<small>Ngày quay thưởng <?php echo date('d/m/Y', strtotime($vietlottmega1->date)); ?></small></h1>
            <div class="jackpost-xx-content" >
                <div class="jackpost-xx-content-top">
                    <ul>
                        <?php $data_mega_content = json_decode($vietlottmega1->content); ?>
                        <li><?php echo $data_mega_content->content->db[0]; ?></li>
                        <li><?php echo $data_mega_content->content->db[1]; ?></li>
                        <li><?php echo $data_mega_content->content->db[2]; ?></li>
                        <li><?php echo $data_mega_content->content->db[3]; ?></li>
                        <li><?php echo $data_mega_content->content->db[4]; ?></li>
                        <li><?php echo $data_mega_content->content->db[5]; ?></li>                                   
                    </ul>
                    <div class="button-slide">                                
                        <a class="mega-result-btn" href="javascript:void(0)" onclick=" return prevNextResultGameMega645(this, 1)" data-gameid="3" data-drawid="<?php echo $vietlottmega1->drawId - 1; ?>" data-dayprize="<?php echo date('n/j/Y', $vietlottmega1->dateint); ?> 12:00:00 AM">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="mega-result-btn" href="javascript:void(0)" onclick=" return prevNextResultGameMega645(this, 0)" data-gameid="3" data-drawid="<?php echo $vietlottmega1->drawId + 1; ?>" data-dayprize="<?php echo date('n/j/Y', $vietlottmega1->dateint); ?> 12:00:00 AM">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="jackpost-xx-content-mid">
                    <div class="box_so xsmt-new-table">
                        <div class="box_so_left">
                            <table class="tablesxs" width="100%" cellspacing="1" cellpadding="0" border="0">
                                <tbody>
                                    <tr class="web_bg_title_tinh">
                                        <td colspan="4" class="web_XS_1 chugiai"><h2 class="h2-matran">Giá trị Jackpot</h2></td>
                                    </tr>
                                    <tr>
                                        <td class="jack-sxs" colspan="4"><?php echo $data_mega_content->content->nd->jp->gt; ?> đồng</td>
                                    </tr>
                                    <tr>
                                        <th>Giải thưởng</th>
                                        <th>Trùng khớp</th>                                    
                                        <th>Số lượng giải</th>
                                        <th>Giá trị giải (đồng)</th>
                                    </tr>

                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Jackpot</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><br><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><br><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->jp->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->jp->gt; ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải nhất</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><br><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><br><i class="fa fa-circle" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->g1->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->g1->gt; ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải nhì</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><br><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->g2->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->g2->gt; ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải ba</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><br><i class="fa fa-circle" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->g3->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->g3->gt; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="module mod-ketqua-matran">
        <div class="box_kqxs margin-top-box xsmt-new-table" id="matran">
            <div id="kqxs_matran">
                <div class="result-header">
                    <h2 class="heder-matran">
                        <span>kết quả xổ số Ma Trận</span>    </h2>

                </div>
                <div class="box_so xsmt-new-table">
                    <div class="box_so_left">
                        <table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#f8f8f8">
                            <tbody>
                                <tr>
                                    <th>Ngày mở thưởng</th>
                                    <th>Bộ số chiến thắng</th>
                                    <th>Giá trị Jackpot</th>
                                </tr>
                                <?php
                                for ($i = 0; $i < 5; $i++) {
                                    $item_mega = $vietlottmega5[$i];
                                    $data_mega_content_item = json_decode($item_mega->content);
                                    ?>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai"><?php echo date('d/m/Y', strtotime($item_mega->date)); ?></td>
                                        <td class="web_XS_2 chukq">
                                            <span><?php echo $data_mega_content_item->content->db[0]; ?></span><span><?php echo $data_mega_content_item->content->db[1]; ?></span><span><?php echo $data_mega_content_item->content->db[2]; ?></span><span><?php echo $data_mega_content_item->content->db[3]; ?></span><span><?php echo $data_mega_content_item->content->db[4]; ?></span><span><?php echo $data_mega_content_item->content->db[5]; ?></span>
                                        </td>
                                        <td><?php echo $data_mega_content_item->content->nd->jp->gt; ?> VNĐ</td>
                                    </tr>
                                <?php } ?>                                        
                            </tbody>
                        </table>                               
                    </div>

                </div>
                <!--<div class="boxseo bogoc2">-->
                <!-- <a href="#" class="send-sms" data-telno="9911" data-message="MEGA">
                    Nhận kết quả xổ số Ma trận sớm nhất, soạn :<span class="red"> MEGA</span> gửi <span class="red">9911</span>
                </a>-->
                <!--    Chờ kết quả :<span class="red"> XSMB CHO</span> gửi <span class="red">9389</span>-->
                <!--    <br> Số đẹp hôm nay :<span class="red"> CAU</span> gửi <span class="red">9389</span>-->
                <!--</div>-->        
            </div>
        </div>
    </section>

    <section class="module mod-thongke-tansuat-nhieunhat">
        <div class="contexnt-sas" style="
             ">
            <h3 class="title-green">Thống kê tần suất xuất hiện các cặp số xuất hiện nhiều nhất (30 ngày)</h3>                    
            <div class="tables-ss">
                <?php
                $solanxuathien;
                $count = 5;
                if (count($solanxuathien) < 4) {
                    $count = count($solanxuathien);
                }
                $n = 0;
                foreach ($solanxuathien as $key => $item_slxh) {
                    if ($n == 5)
                        break;
                    ?>    
                    <div class="adwx-title ">  
                        <?php
                        sort($item_slxh);

                        for ($j = 0; $j < count($item_slxh); $j++) {
                            ?>
                            <span><?php echo $item_slxh[$j]; ?></span>
                            <?php
                        }
                        ?>
                        <strong> <?php echo $key; ?> lần</strong>
                    </div>
                    <?php
                    $n++;
                }
                ?>
                <div class="clear-fix"></div>
                <div class="see-more-box text-center" style="display: none">
                    <a class="btn-do-ve see-more-link">Xem thêm</a>
                </div>

            </div>  
            <h3 class="title-green m-t-20">Thống kê tần suất xuất hiện các cặp số từ 01 đến 45 (30 ngày)</h3>
            <div class="tables-ss">
                <table class="awefdd">
                    <tbody>
                        <?php
                        for ($k = 1; $k <= 15; $k++) {
                            $keyfull = $k;
                            if ($keyfull < 10)
                                $keyfull = '0' . $keyfull;
                            ?>
                            <tr>
                                <td class="adwx-title"><span><?php echo $keyfull; ?></span><strong> <?php echo ($fullsolanxuathien[$keyfull]) ? $fullsolanxuathien[$keyfull] : 0; ?> lần</strong></td>
                                <td class="adwx-title"><span><?php echo $keyfull + 15; ?></span><strong> <?php echo ($fullsolanxuathien[$keyfull + 15]) ? $fullsolanxuathien[$keyfull + 15] : 0; ?> lần</strong></td>
                                <td class="adwx-title"><span><?php echo $keyfull + 30; ?></span><strong> <?php echo ($fullsolanxuathien[$keyfull + 30]) ? $fullsolanxuathien[$keyfull + 30] : 0; ?> lần</strong></td>
                            </tr>
                        <?php } ?>
<!--                        <tr class="see-more-tr">
<td colspan="3"><a class="btn-do-ve see-more-link" style="display: none">Xem thêm</a></td>
</tr>-->

                    </tbody></table>

            </div>  
        </div>
    </section>

    <section class="module mod-chon-ngay-mt">
        <div class="form-soi-cau groups-selects-nes">                    
            <div class="groups-selects groups-selects-dss">
                <label class="width-100 find-form-tlt">Chọn ngày mở thưởng</label>
                <div class="pt-50 pt-m-50 pt-date-ds pt-date-ds-xsmt">
                    <input name="data[lotteDate]" id="datepicker-soi-cau" class="picker datepicker-xsmt" placeholder="Chọn ngày" data-direction="false" required="required" type="tel" value="<?php echo date('d-m-Y'); ?>" readonly="readonly" ><button type="button" class="Zebra_DatePicker_Icon Zebra_DatePicker_Icon_Inside">Pick a date</button>    
                    <script>
                        $(function () {
                            $("#datepicker-soi-cau").datepicker();
                            $(".Zebra_DatePicker_Icon").click(function () {
                                $("#datepicker-soi-cau").datepicker('show');
                            });
                            $("#ui-datepicker-div").addClass("cbv-choose-date-m645");
                        });
                    </script>							
                </div>
            </div>
            <div class="groups-ul">
                <label class="find-form-tlt width-100">Nhập số dò</label>
                <ul class="form-ul-ss" id="form-ul-ss-1" data-dslist="1">
                    <?php
                    for ($i = 1; $i <= 6; $i++) {
                        printf('<li class="input tel">
                        <input onkeyup="cbvGetChange(%s, this.value)"  name="number_soi[%s]" class="number-xsmt number-xsmt-0 index-%s" placeholder="--" maxlength="2" autocomplete="off" type="tel" id="number%s" data-id="%s"> 
                    </li>', $i, $i, $i, $i, $i);
                    }
                    ?>
                </ul>
            </div>
            <p class="main-them-so-do-mega6">
                <a class="add-more-number-mega6" id="add-click-appInputM6" data-sub="1" data-number_id="1" href="javascript:void(0)" onclick="cbvAppenInputM6();">Thêm số dò</a>
            </p>
            <div class="main-cbv-submit">
                <button type="submit" class="btn-do-ve" onclick="dovetheongay()">Dò vé</button>
                <button type="button" class="btn-xoa">Xóa</button>
            </div>
            <div class="validate-error" id="validate-error"></div>                    
        </div>
    </section>
    <section class="module mod-ketqua-matran cbv-ket-qua" id="dotheongay">                
    </section>
    <section class="module mod-text-gioi-thieu">
        <div class="content-more more-x">
            <div class="box-bottom-head">
                <h2 class="title-head-more"><span>Kết quả xổ số tự chọn Vietlott Mega 6/45</span></h2>
                <ul class="list-vl">
                    <li><a href="/tin-xo-so/co-cau-chuong-trinh-xo-so-tu-chon-mega-6-45.html">Cơ cấu chương trình xổ số tự chọn Mega 6/45</a></li>
                    <li><a href="/tin-xo-so/co-cau-giai-thuong-xo-so-mega-6-45---vietlott.html">Cơ cấu giải thưởng xổ số mega 6/45</a></li>
                    <li><a href="/tin-xo-so/cach-choi-vietlott---xo-so-dien-toan-tu-chon-jackpot-mega-6-45.html">Hướng dẫn cách chơi xổ số điện toán tự chọn Mega 6/45</a></li>
                </ul>
            </div>
            <br>
            <div class="box box-html" style="padding: 0 10px; line-height: 1.5; font-size: 14px">
                <p><a href="http://xoso.com/vietlott/mega6.html" title="Kết quả xổ số Mega 6/45"><strong><span style="color:#0000FF">Kết quả xổ số Mega 6/45</span></strong></a> – Xổ số Mega 6/45 được quay số mở thưởng trực tiếp tại trung tâm quay số mở thưởng xổ số tự chọn Vietlott có trụ sở tại tầng 19, tòa nhà VTC (số 23 Lạc Trung, Hai Bà Trưng, Hà Nội) vào lúc 18h10p và kết thúc vào 18h30p các ngày thứ 4, thứ 6 và chủ nhật hàng tuần.</p>

                <p>Mega 6/45 là kết quả bởi sự hợp tác của công ty Vietlott và Tập đoàn Berjaya (Malaysia) và chính thức đi vào hoạt động là ngày 18/7/2016.</p>

                <p>Jackpot Mega 6/45 có giá trị tối thiểu là 12 tỷ đồng và được cộng đồn tích lũy cho tới khi có người trúng thưởng.</p>

                <p>Để theo dõi và dò vé số Vietlott Mega 6/45 nhanh chóng và chínhh xác nhất hãy truy cập ngay vào <a href="http://xoso.com/" title="KQXS"><span style="color:#0000FF"><strong>KQXS</strong></span></a> để có được thông tin hàng ngay.</p>

                <p>Xoso.com cung cấp <span style="color:#FF0000"><strong>kết quả xổ số Mega 6/45 – KQXS Mega 6/45 – XS Mega 6/45 – SX Mega 6/45 – XS 6/45</strong></span> trực tiếp trên máy tính và smartphone một cách nhanh nhất và chuẩn nhất trên khắp mọi miền đất nước.</p>

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
        <div class="more-link show-more">Xem thêm</div>  
    </section>

    <section class="module mod-lich-su-giai">
        <div class="form-soi-cau form-soi-cau-mt">                    
            <div class="groups-selects">
                <label class="label-soi-mt" style="border-top: 0px;">Lịch sử dãy số chiến thắng</label>
                <div class="box-select">
                    <div class="in-form-50">
                        <select name="month" id="datepickerthang">
                            <?php
                            $monthCurent = date('m');
                            for ($i = 1; $i <= 12; $i++) {
                                $datavl = ($i < 10) ? '0' . $i : $i;
                                if ($i == $monthCurent) {
                                    printf('<option value="%s" selected="true">Tháng %s</option>', $datavl, $i);
                                } else {
                                    printf('<option value="%s">Tháng %s</option>', $datavl, $i);
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="in-form-50">
                        <select name="year" id="datepickernam">
                            <?php
                            $yearCurent = date('Y');
                            for ($i = 2016; $i <= $yearCurent; $i++) {
                                if ($i == $yearCurent) {
                                    printf('<option value="%s" selected="true">%s</option>', $i, $i);
                                } else {
                                    printf('<option value="%s">%s</option>', $i, $i);
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-do-ve" onclick="dovetheothang()">Kết quả</button>
            <!--</form>-->
            <div class="clear-fix"></div>

            <!-- //////////////////////////////////////// -->
            <div class="mod-ketqua-matran inputThongtin" id="month-result-box">                            
                <div class="clear-fix"></div>
            </div>
        </div>
    </section>
</div>        