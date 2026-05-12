<link rel="stylesheet" href="/public/client/assets/jquery-ui-1.12.1.custom/jquery-ui.min.css">
<script src="/public/client/assets/js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/public/client/assets/font-awesome-4.7.0/css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="/public/client/assets/css/style.css" />
<script src="/public/client/assets/js/function.js"></script>
<script>
//    $(function () {
//        $("#datepicker-soi-cau").datepicker();
//    });
</script>
<script>
    function dovetheongayPower(type) {
        $(".main-vietlot-home .box-loading").show();
        var datedove = $("#datepicker-soi-cau").val();
        var numberSoDo = $("#add-click-appInputM6").attr('data-sub');
        var dsSoDo = new Array();
        var j = 0;
        for (var i = 1; i <= numberSoDo; i++) {
            j = i - 1;
            dsSoDo[j] = new Array();
            $('#form-ul-ss-' + i + ' input[name^="number_soi"]').each(function () {
                dsSoDo[j].push($(this).val());
            });
        }
//        console.log(dsSoDo);
        $.ajax({
            url: "/crawl/index.php?task=power6dongay",
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
    function dovetheothangPower(type) {
        $(".main-vietlot-home .box-loading").show();
        var datedovethang = $("#datepickerthang").val();
        var datedovenam = $("#datepickernam").val();
        $.ajax({
            url: "/crawl/index.php?task=power6thang",
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
    function prevNextResultGamePower655(object, type) {
        $(".main-vietlot-home .box-loading").show();
        $.ajax({
            url: "/crawl/index.php?task=power6new",
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
<div class="main-vietlot-page-m6 main-vietlot-page-m6-2 main-vietlot-page-pow6">
    <section class="module mod-luot-quay-tiep">
        <?php $arrUocTinh = json_decode($vietlottpower6gt); ?>
        <div class="row-title-power">
            <b class="label-box">Jackpot Power 6/55 ước tính, lần quay thưởng tiếp theo</b>
        </div>
        <div class="row-jackpot row">
            <div class="col-sm-3 col-xs-3 col-label-box">
                <b class="label-box">Jackpot 1:</b>
            </div>
            <div class="col-sm-9 col-xs-9 col-value-box">
                <span class="size-jackpot-1"><?php echo $arrUocTinh->jax1; ?></span>
            </div>
        </div>
        <div class="row-jackpot row">
            <div class="col-sm-3 col-xs-3 col-label-box">
                <b class="label-box">Jackpot 2:</b>
            </div>
            <div class="col-sm-9 col-xs-9 col-value-box">
                <span class="size-jackpot-2"><?php echo $arrUocTinh->jax2; ?></span>
            </div>
        </div>
    </section>
    <section class="module mod-giai-da-quay" id="result-games">
        <div class="jackpost-xx mega645-box" >
            <h1 class="jackpost-xx-h2">KẾT QUẢ TRÚNG THƯỞNG<br>POWER 6/55<small>Ngày quay thưởng <?php echo date('d/m/Y', strtotime($vietlottpower1->date)); ?></small></h1>
            <div class="jackpost-xx-content" >
                <div class="jackpost-xx-content-top">
                    <ul>
                        <?php $data_mega_content = json_decode($vietlottpower1->content); ?>
                        <li><?php echo $data_mega_content->content->db[0]; ?></li>
                        <li><?php echo $data_mega_content->content->db[1]; ?></li>
                        <li><?php echo $data_mega_content->content->db[2]; ?></li>
                        <li><?php echo $data_mega_content->content->db[3]; ?></li>
                        <li><?php echo $data_mega_content->content->db[4]; ?></li>
                        <li><?php echo $data_mega_content->content->db[5]; ?></li>
                        <li class="number-Special"><?php echo $data_mega_content->content->db[6]; ?></li>
                    </ul>
                    <div class="button-slide">                                
                        <a class="mega-result-btn" href="javascript:void(0)" onclick=" return prevNextResultGamePower655(this, 1)" data-gameid="3" data-drawid="<?php echo $vietlottpower1->drawId - 1; ?>" data-dayprize="<?php echo date('n/j/Y', $vietlottpower1->dateint); ?> 12:00:00 AM">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="mega-result-btn" href="javascript:void(0)" onclick=" return prevNextResultGamePower655(this, 0)" data-gameid="3" data-drawid="<?php echo $vietlottpower1->drawId + 1; ?>" data-dayprize="<?php echo date('n/j/Y', $vietlottpower1->dateint); ?> 12:00:00 AM">
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
                                        <td colspan="4" class="web_XS_1 chugiai"><h2 class="h2-matran">Giá trị Jackpot 1</h2></td>
                                    </tr>
                                    <tr>
                                        <td class="jack-sxs" colspan="4" style="font-size: 16px !important;"><?php echo $data_mega_content->content->nd->jp->gt; ?> đồng</td>
                                    </tr>
                                    <tr>
                                        <th>Giải thưởng</th>
                                        <th>Trùng khớp</th>                                    
                                        <th>Số lượng giải</th>
                                        <th>Giá trị giải (đồng)</th>
                                    </tr>

                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Jackpot 1</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->jp->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->jp->gt; ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Jackpot 2</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle cbv-not-pow" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->jp2->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->jp2->gt; ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải nhất</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->g1->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->g1->gt; ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải nhì</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->g2->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->g2->gt; ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải ba</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i></td>
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
                        <span>kết quả xổ số Power</span>    
                    </h2>
                </div>
                <div class="box_so xsmt-new-table">
                    <div class="box_so_left">
                        <table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#f8f8f8">
                            <tbody>
                                <tr>
                                    <th>Ngày mở thưởng</th>
                                    <th>Bộ số chiến thắng</th>
                                    <th>Giá trị Jackpot</th>
                                    <!--<th>Giá trị Jackpot 2</th>-->
                                </tr>
                                <?php
                                for ($i = 0; $i < 5; $i++) {
                                    $item_mega = $vietlottmega5[$i];
                                    $data_mega_content_item = json_decode($item_mega->content);
                                    ?>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai"><?php echo date('d/m/Y', strtotime($item_mega->date)); ?></td>
                                        <td class="web_XS_2 chukq">
                                            <span><?php echo $data_mega_content_item->content->db[0]; ?></span><span><?php echo $data_mega_content_item->content->db[1]; ?></span><span><?php echo $data_mega_content_item->content->db[2]; ?></span><span><?php echo $data_mega_content_item->content->db[3]; ?></span><span><?php echo $data_mega_content_item->content->db[4]; ?></span><span><?php echo $data_mega_content_item->content->db[5]; ?></span><span class="intext-speal"><?php echo $data_mega_content_item->content->db[6]; ?></span>
                                        </td>
                                        <td><?php echo $data_mega_content_item->content->nd->jp->gt; ?><p class="jackpost-2"><?php echo $data_mega_content_item->content->nd->jp2->gt; ?></p></td>
                                    </tr>
                                <?php } ?>                                        
                            </tbody>
                        </table>                               
                    </div>

                </div>
                <!--                <div class="boxseo bogoc2">
                                     <a href="#" class="send-sms" data-telno="9911" data-message="MEGA">
                                        Nhận kết quả xổ số Ma trận sớm nhất, soạn :<span class="red"> MEGA</span> gửi <span class="red">9911</span>
                                    </a>
                                        Chờ kết quả :<span class="red"> XSMB CHO</span> gửi <span class="red">9389</span>
                                        <br> Số đẹp hôm nay :<span class="red"> CAU</span> gửi <span class="red">9389</span>
                                </div>        -->
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
            <h3 class="title-green m-t-20">Thống kê tần suất xuất hiện các cặp số từ 01 đến 55 (30 ngày)</h3>
            <div class="tables-ss">
                <table class="awefdd">
                    <tbody>
                        <?php
                        for ($k = 1; $k <= 18; $k++) {
                            $keyfull = ($k < 10) ? '0' . $k : $k;
                            ?>
                            <tr>
                                <td class="adwx-title"><span><?php echo $keyfull; ?></span><strong> <?php echo ($fullsolanxuathien[$keyfull]) ? $fullsolanxuathien[$keyfull] : 0; ?> lần</strong></td>
                                <td class="adwx-title"><span><?php echo $keyfull + 18; ?></span><strong> <?php echo ($fullsolanxuathien[$keyfull + 18]) ? $fullsolanxuathien[$keyfull + 18] : 0; ?> lần</strong></td>
                                <td class="adwx-title"><span><?php echo $keyfull + 36; ?></span><strong> <?php echo ($fullsolanxuathien[$keyfull + 36]) ? $fullsolanxuathien[$keyfull + 36] : 0; ?> lần</strong></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="adwx-title"></td>
                            <td class="adwx-title"><span>55</span><strong> <?php echo ($fullsolanxuathien[55]) ? $fullsolanxuathien[55] : 0; ?> lần</strong></td>
                            <td class="adwx-title"></td>
                        </tr>
                        <tr class="see-more-tr">
                            <td colspan="3"><a class="btn-do-ve see-more-link" style="display: none">Xem thêm</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>  
        </div>
    </section>
    <section class="module mod-chon-ngay-mt">
        <div class="form-soi-cau groups-selects-nes">                    
            <div class="groups-selects groups-selects-dss">
                <label class="width-100 find-form-tlt">Chọn ngày mở thưởng</label>
                <div class="pt-50 pt-m-50 pt-date-ds pt-date-ds-xsmt">
                    <input name="data[lotteDate]" id="datepicker-soi-cau" class="picker datepicker-xsmt" placeholder="Chọn ngày" data-direction="false" required="required" type="text" value="<?php echo date("d-m-Y") ?>" readonly="readonly" ><button type="button" class="Zebra_DatePicker_Icon Zebra_DatePicker_Icon_Inside">Pick a date</button>    
                    <script>
                        $(function () {
                            $("#datepicker-soi-cau").datepicker();
                            $(".Zebra_DatePicker_Icon").click(function () {
                                $("#datepicker-soi-cau").datepicker('show');
                            });
                            $("#ui-datepicker-div").addClass("cbv-choose-date-m4d");
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
                        <input onkeyup="cbvGetChangePower(%s, this.value)"  name="number_soi[%s]" class="number-xsmt number-xsmt-0 index-%s" placeholder="--" maxlength="2" autocomplete="off" type="tel" id="number%s" data-id="%s"> 
                    </li>', $i, $i, $i, $i, $i);
                    }
                    ?>

                </ul>
            </div>
            <p class="main-them-so-do-mega6">
                <a class="add-more-number-mega6" id="add-click-appInputM6" data-sub="1" data-number_id="1" href="javascript:void(0)" onclick="cbvAppenInputM6();">Thêm số dò</a>
            </p>
            <div class="main-cbv-submit">
                <button type="submit" class="btn-do-ve" onclick="dovetheongayPower()">Dò vé</button>
                <button type="button" class="btn-xoa">Xóa</button>
            </div>
            <div class="validate-error" id="validate-error"></div>                    
        </div>
    </section>
    <section class="module mod-ketqua-matran cbv-ket-qua" id="dotheongay">                
    </section>
    <section class="module mod-lich-su-giai">
        <div class="form-soi-cau form-soi-cau-mt">                    
            <div class="groups-selects">
                <label class="label-soi-mt" style="border-top: 0px;">Lịch sử dãy số chiến thắng</label>
                <div class="box-select">
                    <div class="in-form-50">
                        <select name="month" id="datepickerthang">
                            <?php
                            $monthCurent = date("m");
                            for ($i = 1; $i < 13; $i++) {
                                $newI = ($i < 10) ? '0' . $i : $i;
                                $select = ($i == $monthCurent) ? 'selected' : '';
                                printf('<option value="%s" %s>Tháng %s</option>', $newI, $select, $newI);
                            }
                            ?>
                        </select>
                    </div>
                    <div class="in-form-50">
                        <select name="year" id="datepickernam">
                            <?php
                            $yearCurent = date("Y");
                            for ($i = 2017; $i <= $yearCurent; $i++) {
                                $select = ($i == $yearCurent) ? 'selected' : '';
                                printf('<option value="%s" %s>Năm %s</option>', $i, $select, $i);
                            }
                            ?>           
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-do-ve" onclick="dovetheothangPower()">Kết quả</button>
            <!--</form>-->
            <div class="clear-fix"></div>

            <!-- //////////////////////////////////////// -->
            <div class="mod-ketqua-matran inputThongtin" id="month-result-box">                            
                <div class="clear-fix"></div>
            </div>
        </div>
    </section>
    <section style="padding: 20px; text-align: justify; font-size: 14px;line-height: 1.5">
        <p>
            1. Tham gia dự thưởng một bộ số:<br>
            Người tham gia dự thưởng lựa chọn 6 số trong tập hợp các số từ  01 đến 55 để tạo thành một bộ số tham gia dự thưởng.
        </p><br>
        <p>

            2. Tham gia dự thưởng nhiều bộ số:<br>

            i) Người tham gia dự thưởng lựa chọn 5 số (bao 5) trong tập hợp các số từ 01 đến 55. Số thứ 6 sẽ do hệ thống phần mềm chọn trong tập hợp 50 số còn lại tạo thành 50 bộ số tham gia dự thưởng. So sánh bộ số tham gia dự thưởng với kết quả quay số mở thưởng để xác định giải thưởng<br>

            ii) Người tham gia dự thưởng lựa chọn từ 7 số (bao7) đến 15 số (bao 15) và 18 số (bao 18) trong tập hợp các số từ 01 đến 55. Sau đó, hệ thống phần mềm sẽ giúp người chơi tạo ra tất cả các kết hợp 6 số trong các số mà người chơi đã chọn để tạo thành các bộ số tham gia dự thưởng. So sánh bộ số tham gia dự thưởng vơi kết quả quay số mở thưởng để xác định giải thưởng<br>
        </p><br>
        <p>

            3. Tham gia dự thưởng nhiều kỳ<br>

            Người tham gia dự thưởng chọn kỳ quay số mở thưởng và được quyền tham gia dự thưởng tối đa 6 kỳ quay số mở thưởng liên tiếp.<br>


            Trong từng đợt phát hành có 5 hạng giải thưởng và quay số mở thưởng 01 lần trong mỗi kỳ quay số mở thưởng để lựa chọn ra bộ số trúng thưởng gồm 6 số trong các số từ 01 đến 55.<br>
            Ngoài ra, một số đặc biệt sẽ được quay chọn từ 49 quả bóng còn lại trong lồng cầu sau khi đã chọn 6 quả bóng trước đó để xác định bộ số trúng thưởng cho giải Jackpot 2.
        </p><br>

    </section>
</div>        