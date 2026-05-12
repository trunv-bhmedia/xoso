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
    $loto_tinh .= '<td colspan="2" class="bg-gray border-right t-cen"><strong>' . $value->name . '</strong></td>';
    $loto_title .= '<td class="border-right t-cen"><span>Đầu</span></td><td class="border-right t-cen"><span>Đuôi</span></td>';
    $extra = json_decode($value->extension);
    foreach ($extra as $k => $v) {
        $class = '';
        if ($k % 2 == 0)
            $class = 'bg-gray ';
        $loto_arr[$k] .= '<td class="' . $class . 'border-right t-cen"><span class="red">' . $k . '</span></td><td class="' . $class . 'border-right t-cen">' . $v . '</td>';
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
    $loto_tinh .= '<td colspan="2" class="bg-gray border-right t-cen"><strong>' . $value->name . '</strong></td>';
    $loto_title .= '<td class="border-right t-cen"><span>Đầu</span></td><td class="border-right t-cen"><span>Đuôi</span></td>';
    $extra = json_decode($value->extension);
    foreach ($extra as $k => $v) {
        $class = '';
        if ($k % 2 == 0)
            $class = 'bg-gray ';
        $loto_arr[$k] .= '<td class="' . $class . 'border-right t-cen"><span class="red">' . $k . '</span></td><td class="' . $class . 'border-right t-cen">' . $v . '</td>';
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

<?php //if($_REQUEST["debug"] == 1){?>

<script>
    function countDownTime(className, enddate) {
        // Set the date we're counting down to
        var countDownDate = new Date(enddate).getTime();
        //var nowsv = <?php echo (time() * 1000); ?>;
        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get todays date and time
            var now = new Date().getTime();
            //nowsv = nowsv + 1000;	
            // Find the distance between now an the count down date
            //var distance = countDownDate - nowsv;
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (days < 10)
                days = '0' + days;
            if (hours < 10)
                hours = '0' + hours;
            if (minutes < 10)
                minutes = '0' + minutes;
            if (seconds < 10)
                seconds = '0' + seconds;
            document.getElementById(className).innerHTML = '<li><span class="box-number">' + days + '</span><span>Ngày</span></li><li><span class="box-number">' + hours + '</span><span>Giờ</span></li><li><span class="box-number">' + minutes + '</span><span>Phút</span></li><li><span class="box-number">' + seconds + '</span><span>Giây</span></li>';


        }, 1000);
    }

</script>
<script>
    $(document).ready(function () {
        $('.main-vietlot-home .nav-tabs li').click(function () {
            $('.main-vietlot-home .nav-tabs li').removeClass('active');
            $(this).addClass('active');
            var itemActive = $(this).data('itemtab');
//            $('.main-vietlot-home').addClass('active');
            for (var i = 1; i <= 3; i++) {
                $('.main-vietlot-home').removeClass('active' + i);
            }
            $('.main-vietlot-home').addClass('active' + itemActive);

        });
    });
    function prevNextResultGameMega645(object, type) {
        $(".main-vietlot-home .box-loading").show();
        $.ajax({
            url: "/crawl/index.php?task=mega6",
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

//    cbv loading power
    function prevNextResultGamePower655(object, type) {
        $(".main-vietlot-home .box-loading").show();
        $.ajax({
            url: "/crawl/index.php?task=power6",
            method: "post",
            data: {gameId: $(object).data("gameid"), drawId: $(object).data("drawid"), dayPrize: $(object).data("dayprize"), type: type},
            success: function (result) {
//                alert(result);
                $(".main-vietlot-home .box-loading").hide();
                $("#loading").hide();
                if (result !== "") {
                    $("#result-games-655").html(result);
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


</script>

<div class="main-vietlot-home active1">
    <div class="game-result">
        <header class="head-vl">
            <h2 class="vl-title6"><a class="vltext-title" href="/vietlott/mega6.html">Xổ số vietlott</a></h2>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active tab-click1" data-itemtab="1"><span>Mega 6/45</span></li>
                <li role="presentation" class="tab-click2" data-itemtab="2"><span>Max 4D</span></li>
                <li role="presentation" class="tab-click3" data-itemtab="3"><span>Power 6/55</span></li>
            </ul>
        </header>
        <div class="tab-games">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane cbvHidden" id="mega-6-45">
                    <div class="jackpot-win tab_menu_mega645">
                        <p class="logo-pending-result">								
                            <img src="http://www.xoso.com/public/client/images/xstc-lg-vn.png" alt="xổ số vietlott 6/45">
                        </p>
                        <!-- /.Jackpot winner-->
                        <div class="countdown-box">
                            <div class="countdown">
                                <ul id="mega-6-45-countdowntimer">

                                </ul>
                            </div>
                        </div>
                        <!-- /.Countdown -->
                        <script>
                            countDownTime('mega-6-45-countdowntimer', '<?php echo $nexttimemega; ?>');
                        </script>
                    </div>
                    <!-- /.Jackpot winner-->


                    <div id="result_livestreaming">
                        <div class="lotto-result">
                            <h4>Kết quả trúng thưởng Mega 6/45</h4>
                            <div id="result-games">
                                <div class="box-result-detail">
                                    <p class="time-result">Kỳ quay thưởng #000<?php echo $vietlottmega->drawId; ?> | Ngày quay thưởng <?php echo date('d/m/Y', $vietlottmega->dateint); ?></p>
                                    <p class="time-result">Truyền Hình Trực Tiếp Trên Kênh Truyền Hình VTC7 - TodayTV Từ 18h00 – 18h30 Thứ 4 – Thứ 6 – Chủ Nhật</p>
                                    <div class="box-loading"><img class="loading-box-vietlott" src="http://www.xoso.com/public/client/images/loading-circle.gif" alt="loading-xo-so-vietlott"></div>
                                    <ul class="result-number">
                                        <li class="arrow-result">
                                            <a href="javascript:void(0)" onclick=" return prevNextResultGameMega645(this, 0)" data-gameid="3" data-drawid="<?php echo $vietlottmega->drawId - 1; ?>" data-dayprize="<?php echo date('n/j/Y', $vietlottmega->dateint); ?> 12:00:00 AM">
                                                <i class="icon-arrow-left my-file-vietlott"></i>
                                            </a>
                                        </li>
                                        <?php $data_mega_content = json_decode($vietlottmega->content); ?>
                                        <li><?php echo $data_mega_content->content->db[0]; ?></li>
                                        <li><?php echo $data_mega_content->content->db[1]; ?></li>
                                        <li><?php echo $data_mega_content->content->db[2]; ?></li>
                                        <li><?php echo $data_mega_content->content->db[3]; ?></li>
                                        <li><?php echo $data_mega_content->content->db[4]; ?></li>
                                        <li><?php echo $data_mega_content->content->db[5]; ?></li>
                                        <li class="arrow-result">
                                            <a href="javascript:void(0)" onclick=" return prevNextResultGameMega645(this, 1)" data-gameid="3" data-drawid="<?php echo $vietlottmega->drawId + 1; ?>" data-dayprize="<?php echo date('n/j/Y', $vietlottmega->dateint); ?> 12:00:00 AM">
                                                <i class="icon-arrow-right my-file-vietlott"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <p class="time-result" style="margin-top: 10px; font-weight: bold; text-align: center; font-size: 20px;"><?php echo $data_mega_content->content->nd->jp->gt; ?></p>
                                    <p class="time-result" style="margin-top: 10px;">Các con số dự thưởng phải trùng với số kết quả nhưng không cần theo đúng thứ tự</p>
                                </div>
                            </div>
                            <div class="more">
                                <a class="btn btn-link" href="http://www.xoso.com/vietlott/mega6.html">Xem kết quả chi tiết &gt;&gt;</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane cbvHidden" id="max-4d">
                    <div class="jackpot-win">
                        <p class="logo-pending-result">
                            <img src="http://www.xoso.com/public/client/images/logo-max4d-result-vn.png" alt="xổ số vietlott 4D">
                        </p>
                        <!-- /.Jackpot winner-->
                        <div class="countdown-box">
                            <div class="countdown">
                                <ul id="max-4d-countdowntimer">

                                </ul>
                            </div>
                        </div>
                        <!-- /.Countdown -->
                        <script>
                            countDownTime('max-4d-countdowntimer', '<?php echo $nexttimemax; ?>');
                        </script>
                    </div>
                    <div id="result_max4d_livestreaming">
                        <div class="lotto-result">
                            <h4>Kết quả trúng thưởng Max 4D</h4>
                            <div id="result-games-max4d">
                                <div class="box-result-detail">
                                    <span class="arrow-result">
                                        <a href="javascript:void(0)" onclick="return prevNextResultGameMax4D(this, 0)" data-gameid-max4d="2" data-drawid-max4d="<?php echo $vietlottmax->drawId - 1; ?>" data-dayprize-max4d="<?php echo date('n/j/Y', $vietlottmax->dateint); ?> 12:00:00 AM">
                                            <i class="icon-arrow-left my-file-vietlott"></i>
                                        </a>
                                    </span>
                                    <p class="time-result">Kỳ quay thưởng #000<?php echo $vietlottmax->drawId; ?> | Ngày quay thưởng <?php echo date('d/m/Y', $vietlottmax->dateint); ?></p>
                                    <p class="time-result">Các con số dự thưởng phải trùng với số kết quả theo đúng thứ tự</p>
                                    <div class="box-loading"><img class="loading-box-vietlott" src="http://www.xoso.com/public/client/images/loading-circle.gif" alt="loading-xo-so-vietlott"></div>
                                    <?php $data_max_content = json_decode($vietlottmax->content); ?>
                                    <ul class="result-max4d">
                                        <li>
                                            <div class="box-result-max4d">
                                                <span class="name-result-max4d">Giải Nhất</span>
                                                <ul class="num-result-max4d">
                                                    <li><?php echo $data_max_content->content->db->g1[0]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g1[1]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g1[2]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g1[3]; ?></li>                                                      
                                                    <li class="divide"></li>
                                                </ul>
                                            </div>
                                            <div class="box-result-max4d">
                                                <span class="name-result-max4d">Giải Nhì</span>
                                                <ul class="num-result-max4d">
                                                    <li><?php echo $data_max_content->content->db->g2->s1[0]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g2->s1[1]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g2->s1[2]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g2->s1[3]; ?></li>
                                                </ul>
                                                <ul class="num-result-max4d">
                                                    <li><?php echo $data_max_content->content->db->g2->s2[0]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g2->s2[1]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g2->s2[2]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g2->s2[3]; ?></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="box-result-max4d">
                                                <span class="name-result-max4d">Giải Ba</span>
                                                <ul class="num-result-max4d">
                                                    <li><?php echo $data_max_content->content->db->g3->s1[0]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g3->s1[1]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g3->s1[2]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g3->s1[3]; ?></li>
                                                </ul>
                                                <ul class="num-result-max4d">
                                                    <li><?php echo $data_max_content->content->db->g3->s2[0]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g3->s2[1]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g3->s2[2]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g3->s2[3]; ?></li>
                                                </ul>
                                                <ul class="num-result-max4d">
                                                    <li><?php echo $data_max_content->content->db->g3->s3[0]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g3->s3[1]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g3->s3[2]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->g3->s3[3]; ?></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="box-result-max4d">
                                                <span class="name-result-max4d">Giải Khuyến Khích 1</span>
                                                <ul class="num-result-max4d">
                                                    <li><?php echo $data_max_content->content->db->kk1[0]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->kk1[1]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->kk1[2]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->kk1[3]; ?></li>  
                                                </ul>
                                            </div>
                                            <div class="box-result-max4d">
                                                <span class="name-result-max4d">Giải Khuyến Khích 2</span>
                                                <ul class="num-result-max4d">
                                                    <li><?php echo $data_max_content->content->db->kk2[0]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->kk2[1]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->kk2[2]; ?></li>
                                                    <li><?php echo $data_max_content->content->db->kk2[3]; ?></li> 
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                    <span class="arrow-result arrow-right">
                                        <a href="javascript:void(0)" onclick="return prevNextResultGameMax4D(this, 1)" data-gameid-max4d="2" data-drawid-max4d="<?php echo $vietlottmax->drawId + 1; ?>" data-dayprize-max4d="<?php echo date('n/j/Y', $vietlottmax->dateint); ?> 12:00:00 AM">
                                            <i class="icon-arrow-right my-file-vietlott"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="more">
                                <a class="btn btn-link" href="http://www.xoso.com/vietlott/max4d.html">Xem kết quả chi tiết &gt;&gt;</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane cbvHidden" id="mega-6-55">
                    <div class="jackpot-win tab_menu_mega645">
                        <p class="logo-pending-result">								
                            <img src="http://www.xoso.com/public/client/images/xstc-lg-vn-655.jpg" alt="xổ số vietlott 6/55">
                        </p>
                        <!-- /.Jackpot winner-->
                        <div class="countdown-box">
                            <div class="countdown">
                                <ul id="max-655-countdowntimer">

                                </ul>
                            </div>
                        </div>
                        <!-- /.Countdown -->
                        <script>
                            countDownTime('max-655-countdowntimer', '<?php echo $nexttimemax; ?>');
                        </script>
                    </div>
                    <!-- /.Jackpot winner-->


                    <div id="result_livestreaming">
                        <div class="lotto-result">
                            <h4>Kết quả trúng thưởng Power 6/55</h4>
                            <div id="result-games-655">
                                <div class="box-result-detail">
                                    <p class="time-result">Kỳ quay thưởng #000<?php echo $vietlottpower->drawId; ?> | Ngày quay thưởng <?php echo date('d/m/Y', $vietlottpower->dateint); ?></p>
                                    <p class="time-result">Truyền Hình Trực Tiếp Trên Kênh Truyền Hình VTC7 - TodayTV 18h00 – 18h30 Thứ 3 – Thứ 5 – Thứ 7</p>
                                    <div class="box-loading"><img class="loading-box-vietlott" src="http://www.xoso.com/public/client/images/loading-circle.gif" alt="loading-xo-so-vietlott"></div>
                                    <ul class="result-number">
                                        <li class="arrow-result">
                                            <a href="javascript:void(0)" onclick=" return prevNextResultGamePower655(this, 0)" data-gameid="3" data-drawid="<?php echo $vietlottpower->drawId - 1; ?>" data-dayprize="<?php echo date('n/j/Y', $vietlottpower->dateint); ?> 12:00:00 AM">
                                                <i class="icon-arrow-left my-file-vietlott"></i>
                                            </a>
                                        </li>
                                        <?php $data_power_content = json_decode($vietlottpower->content); ?>
                                        <li><?php echo $data_power_content->content->db[0]; ?></li>
                                        <li><?php echo $data_power_content->content->db[1]; ?></li>
                                        <li><?php echo $data_power_content->content->db[2]; ?></li>
                                        <li><?php echo $data_power_content->content->db[3]; ?></li>
                                        <li><?php echo $data_power_content->content->db[4]; ?></li>
                                        <li><?php echo $data_power_content->content->db[5]; ?></li>
                                        <li class="number-Special"><?php echo $data_power_content->content->db[6]; ?></li>
                                        <li class="arrow-result">
                                            <a href="javascript:void(0)" onclick=" return prevNextResultGamePower655(this, 1)" data-gameid="3" data-drawid="<?php echo $vietlottpower->drawId + 1; ?>" data-dayprize="<?php echo date('n/j/Y', $vietlottpower->dateint); ?> 12:00:00 AM">
                                                <i class="icon-arrow-right my-file-vietlott"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <p class="time-result" style="margin-top: 10px; font-weight: bold; text-align: center; font-size: 20px;"><?php echo $data_power_content->content->nd->jp->gt; ?></p>
                                    <p class="time-result" style="margin-top: 10px;">Các con số dự thưởng phải trùng với số kết quả nhưng không cần theo đúng thứ tự</p>
                                </div>
                            </div>
                            <div class="more">
                                <a class="btn btn-link" href="http://www.xoso.com/vietlott/xo-so-power-6-55-vietlott.html">Xem kết quả chi tiết &gt;&gt;</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php //}  ?>
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
    <script type='text/javascript'>googletag.cmd.push(function () {
            googletag.display("div-gpt-ad-1378288615889-1")
        });</script>
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

<script type="text/javascript">function loadTKHome() {
        var a = $("#tinh-home").val();
        $("#load-tk-home").html('<div style="padding:10px;text-align:center"><img src="<?php echo img_link('icon-xs/007.gif'); ?>" width="145" height="15" alt="" /></div>');
        $.ajax({type: "GET", url: "<?php echo $uri_root ?>loadtkhome/" + a, success: function (b) {
                $("#load-tk-home").html(b);
            }})
    }
    $(document).ready(function (a) {
        loadTKHome()
    });</script>
<?php $this->load->view($layout_sms); ?>