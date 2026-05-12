<?php
if (isset($checktoday['MB']) && $checktoday['MB'] == 1)
    $v = $xoso['MB'][$today][0];
else
    $v = $xoso['MB'][$yesterday][0];

$strtotime_date = strtotime($v->date);

ob_start();
?>
<div class="block_db block_xsmb">
    <div class="block_db_title clearfix">
        <div class="date_block">
            <div class="day"><?php echo date('d', $strtotime_date) ?></div>
            <div class="month-year"><?php echo date('m/Y', $strtotime_date) ?></div>
        </div>
        <h2><a href="http://m.xoso.com/xo-so-mien-bac.html">XỔ SỐ MIỀN BẮC</a></h2>
    </div>
    <div class="block_db_content">
        <table>
            <tr>
                <td class="title_db"><div>Giải ĐB</div></td>
                <td class="giaidacbiet" width="1%" nowrap><div><?php echo $v->a0 ?></div></td>
                <td class="arrow-right" nowrap><div><a href="<?php echo $uri_root . $v->alias ?>.html">Chi tiết</a></div></td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="title-top"><div class="tabs-note clearfix"><a class="span-tttt" href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">Trực tiếp xổ số miền Bắc</a> >></div></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php
$kqmb = ob_get_contents();
ob_end_clean();

$xsmn = array();

if (isset($checktoday['MN']) && $checktoday['MN'] == 1) {
    $v = $xoso['MN'][$today][0];
    $obj = $xoso['MN'][$today];
} else {
    $v = $xoso['MN'][$yesterday][0];
    $obj = $xoso['MN'][$yesterday];
}

foreach ($obj as $value) {
    $xsmn[$value->alias]->name = $value->name;
    $xsmn[$value->alias]->data = $value->a0;
}
$strtotime_date = strtotime($v->date);

ob_start();
?>
<div class="block_db block_xsmn">
    <div class="block_db_title clearfix">
        <div class="date_block">
            <div class="day"><?php echo date('d', $strtotime_date) ?></div>
            <div class="month-year"><?php echo date('m/Y', $strtotime_date) ?></div>
        </div>
        <h2><a href="http://m.xoso.com/xoso-mien-nam.html">XỔ SỐ MIỀN NAM</a></h2>
    </div>
    <div class="block_db_content">
        <table>
            <tr class="bg-gray">
                <td class="title_db">&nbsp;</td>
                <td class="giaidacbiet" width="1%" nowrap><span>Giải đặc biệt</span></td>
                <td class="arrow-right" nowrap>&nbsp;</td>
            </tr>
            <?php foreach ($xsmn as $alias => $value) { ?>
                <tr>
                    <td class="title_db"><div><a href="<?php echo $uri_root . $alias ?>.html"><?php echo $value->name ?></a></div></td>
                    <td class="giaidacbiet" width="1%" nowrap><div><?php echo $value->data ?></div></td>
                    <td class="arrow-right" nowrap><div><a href="<?php echo $uri_root . $alias ?>.html">Chi tiết</a></div></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3">
                    <div class="title-top"><div class="tabs-note clearfix"><a class="span-tttt" href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html">Trực tiếp xổ số miền Nam</a> >></div></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php
$kqmn = ob_get_contents();
ob_end_clean();

$xsmt = array();

if (isset($checktoday['MT']) && $checktoday['MT'] == 1) {
    $v = $xoso['MT'][$today][0];
    $obj = $xoso['MT'][$today];
} else {
    $v = $xoso['MT'][$yesterday][0];
    $obj = $xoso['MT'][$yesterday];
}

foreach ($obj as $value) {
    $xsmt[$value->alias]->name = $value->name;
    $xsmt[$value->alias]->data = $value->a0;
}
$strtotime_date = strtotime($v->date);

ob_start();
?>
<div class="block_db block_xsmt">
    <div class="block_db_title clearfix">
        <div class="date_block">
            <div class="day"><?php echo date('d', $strtotime_date) ?></div>
            <div class="month-year"><?php echo date('m/Y', $strtotime_date) ?></div>
        </div>
        <h2><a href="http://m.xoso.com/xoso-mien-trung.html">XỔ SỐ MIỀN TRUNG</a></h2>
    </div>
    <div class="block_db_content">
        <table>
            <tr class="bg-gray">
                <td class="title_db">&nbsp;</td>
                <td class="giaidacbiet" width="1%" nowrap><span>Giải đặc biệt</span></td>
                <td class="arrow-right" nowrap>&nbsp;</td>
            </tr>
            <?php foreach ($xsmt as $alias => $value) { ?>
                <tr>
                    <td class="title_db"><div><a href="<?php echo $uri_root . $alias ?>.html"><?php echo $value->name ?></a></div></td>
                    <td class="giaidacbiet" width="1%" nowrap><div><?php echo $value->data ?></div></td>
                    <td class="arrow-right" nowrap><div><a href="<?php echo $uri_root . $alias ?>.html">Chi tiết</a></div></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3">
                    <div class="title-top"><div class="tabs-note clearfix"><a class="span-tttt" href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html">Trực tiếp xổ số miền Trung</a> >></div></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<script>
    function countDownTime(className, enddate) {
        // Set the date we're counting down to
        var countDownDate = new Date(enddate).getTime();
        //var nowsv = 1486975458000;
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
    countDownTime('mega-6-45-countdowntimer', '<?php echo $nexttimemega; ?>');
    countDownTime('max-4d-countdowntimer', '<?php echo $nexttimemax; ?>');

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
    function choiThuVietlott645() {
        alert('mega 645');
    }
    function choiThuVietlott4d() {
        alert('4d');
    }
    function CbvShowListChoiThu() {
        $("#module-choi-thu-xoso").slideToggle();
    }
    function cbvChangeBaoSo() {
//        $(".chonSoMega645 li").removeClass('active');
        cbvChangeChonSoVL();
    }
    function resetChoiThuVL() {
        $(".chonSoMega645 li").removeClass('active');
        $('#cbvSelectNumberDefault option').prop('selected', function () {
            return this.defaultSelected;
        });
        $('#thong-bao-choi-thu').html('');
    }
    function SubmitChoiThuVL() {
        var baoSo = $("#cbvSelectBaoSo").val();
        var arrSelected = [];
        $(".chonSoMega645 li.active").each(function (index) {
            arrSelected.push($(this).text());
        });
        if (arrSelected.length == baoSo) {
            $('#thong-bao-choi-thu').html('');
            alert('yes');
        } else {
            $('#thong-bao-choi-thu').html('Không đủ điều kiện tự chọn '+baoSo+' số');
        }
        console.log(arrSelected);
    }
    function cbvLoadQtxsMega645Xhnn(styleSLnumber, baoSo) {
        $.ajax({
            url: "/crawl/index.php?task=mega6newSelecBoSo",
            method: "GET",
            data: {typeNumber: styleSLnumber, baoSo: baoSo},
            success: function (result) {
                if (result !== "") {
                    var jsoncv = $.parseJSON(result);
                    for (var i = 0; i < jsoncv.length; i++) {
                        $(".chonSoMega645 li.item" + parseInt(jsoncv[i])).addClass('active');
                    }
                }
            },
            error: function (e) {
                console.log(e.message);
            }
        });
    }
    function cbvChangeChonSoVL() {
        var baoSo = $("#cbvSelectBaoSo").val();
        var selectRandomSo = parseInt($("#cbvSelectNumberDefault").val());
        $(".chonSoMega645 li").removeClass('active');
        $('#thong-bao-choi-thu').html('');
        var arrUsed = [];
        if (selectRandomSo === 1) {
            for (var i = 1; i <= baoSo; i++) {
                var xRandom = Math.floor((Math.random() * 45) + 1);
                while ($.inArray(xRandom, arrUsed) > -1)
                {
                    xRandom = Math.floor((Math.random() * 45) + 1);

                }
                arrUsed.push(xRandom);
                $(".chonSoMega645 li.item" + xRandom).addClass('active');

            }
//            console.log(arrUsed);
        } else if (selectRandomSo != 0) {
            cbvLoadQtxsMega645Xhnn(selectRandomSo, baoSo);
        }
    }





</script>
<div class="main-vietlot-home active1">
    <div class="game-result">
        <header class="head-vl">
            <div class="left-title"><b class="date-n"><?php echo date('d', $vietlottmega->dateint); ?></b><?php echo date('m/Y', $vietlottmega->dateint); ?></div>
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
                                <ul id="mega-6-45-countdowntimer" class="style colorDefinition size_lg"></ul>
                            </div>
                        </div>
                        <!-- /.Countdown -->
                    </div>
                    <!-- /.Jackpot winner-->


                    <div id="result_livestreaming">
                        <div class="lotto-result">
                            <h4>Kết quả trúng thưởng Mega 6/45</h4>
                            <div id="result-games">
                                <div class="box-result-detail">
                                    <p class="time-result">Kỳ quay thưởng #000<?php echo $vietlottmega->drawId; ?> | Ngày quay thưởng <?php echo date('d/m/Y', $vietlottmega->dateint); ?></p>
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
                                    <p class="time-result" style="margin-top: 10px; font-weight: bold; text-align: center; font-size: 22px; color: #ffffff !important"><?php echo $data_mega_content->content->nd->jp->gt; ?></p>
                                    <p class="time-result" style="margin-top: 10px;">Các con số dự thưởng phải trùng với số kết quả nhưng không cần theo đúng thứ tự</p>
                                </div>
                            </div>
                            <div class="more">
                                <a class="btn btn-link" href="/vietlott/mega6.html">
                                    Xem kết quả chi tiết &gt;&gt;
                                </a>
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
                                <ul id="max-4d-countdowntimer" class="style colorDefinition size_lg"></ul>
                            </div>
                        </div>
                        <!-- /.Countdown -->
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
                                    <?php $data_max_content = json_decode($vietlottmax->content); ?>
                                    <ul class="result-max4d">
                                        <li>
                                            <span class="name-result-max4d">Giải Nhất</span>
                                            <ul class="num-result-max4d">
                                                <li><?php echo $data_max_content->content->db->g1[0]; ?></li>
                                                <li><?php echo $data_max_content->content->db->g1[1]; ?></li>
                                                <li><?php echo $data_max_content->content->db->g1[2]; ?></li>
                                                <li><?php echo $data_max_content->content->db->g1[3]; ?></li>  
                                            </ul>
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
                                        </li>
                                        <li>
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
                                        </li>
                                        <li>
                                            <span class="name-result-max4d">Giải Khuyến Khích</span>
                                            <ul class="num-result-max4d">
                                                <li><?php echo $data_max_content->content->db->kk1[0]; ?></li>
                                                <li><?php echo $data_max_content->content->db->kk1[1]; ?></li>
                                                <li><?php echo $data_max_content->content->db->kk1[2]; ?></li>
                                                <li><?php echo $data_max_content->content->db->kk1[3]; ?></li>  
                                            </ul>
                                            <ul class="num-result-max4d">
                                                <li><?php echo $data_max_content->content->db->kk2[0]; ?></li>
                                                <li><?php echo $data_max_content->content->db->kk2[1]; ?></li>
                                                <li><?php echo $data_max_content->content->db->kk2[2]; ?></li>
                                                <li><?php echo $data_max_content->content->db->kk2[3]; ?></li>
                                            </ul>
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
                                <a class="btn btn-link" href="/vietlott/max4d.html">Xem kết quả chi tiết &gt;&gt;</a>
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
                                    <p class="time-result" style="margin-top: 10px; font-weight: bold; text-align: center; font-size: 18px;"><?php echo $data_power_content->content->nd->jp->gt; ?></p>
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
<div style="display: none">
<div class="page-title-xs cbv-box-showQT">
    <strong>Quay thử xổ số Vietlott</strong>
    <a class="arrow-right" href="javascript:void(0)" onclick="CbvShowListChoiThu();">&nbsp;</a>
</div>
<div class="home-block" id="module-choi-thu-xoso">
    <ul class="xs-menu">
        <li><a href="javascript:void(0)" onclick="choiThuVietlott645()">Chơi thử vietlott Mega 6/45</a></li>
        <li><a href="javascript:void(0)" onclick="choiThuVietlott4d()">Chơi thử vietlott Max 4D</a></li>
    </ul>
</div>
<div class="selec-box-quaythu">
    <div class="item-select">
        <select name="bao-so-qt" id="cbvSelectBaoSo" class="selectOptionChoiVL selectBaoSoVL" onchange="cbvChangeBaoSo()">
            <option value="6">Tự chọn 6 số</option>
            <option value="5">Bao 5</option>
            <?php
            for ($i = 7; $i <= 18; $i++) {
                printf('<option value="%s">Bao %s</option>', $i, $i);
            }
            ?>
        </select>
    </div>
    <div class="item-select">
        <select name="hinh-thuc-choi" id="cbvSelectNumberDefault" class="selectOptionChoiVL" onchange="cbvChangeChonSoVL()">
            <option value="0">Chọn nhanh</option>
            <option value="1">Bộ số ngẫu nhiên</option>
            <option value="2">Bộ số ra nhiều nhất</option>
            <option value="3">Nhiều nhất 30 ngày</option>
            <option value="4">Nhiều nhất 7 ngày</option>
        </select>
    </div>
<!--    <select name="ky-so-qt" id="cbvSelectKyQuay" class="selectOptionChoiVL selectKyQuayVL">
    <?php
//        for ($i = 0; $i <= 6; $i++) {
//            printf('<option value="%s">%s Kỳ</option>', $i, $i);
//        }
    ?>
    </select>-->
</div>
<aside id="mainConentChoiThuVietlott">

    <ul class="chonSoMega645">
        <?php
        for ($i = 1; $i <= 45; $i++) {
            $show = ($i < 10) ? '0' . $i : $i;
            printf('<li class="item%s"><span>%s</span></li>', $i, $show);
        }
        ?>
    </ul>
</aside>
<div class="cbv-boxghg">
<div id="thong-bao-choi-thu" class="cbv-waring-qtxs"></div>
<div class="box-button-sub-VL">
    <button class="cbv-btn cbv-btn-reset" name="chonlai" onclick="resetChoiThuVL()">Chọn lại</button>
    <button class="cbv-btn" name="chonlai" onclick="SubmitChoiThuVL()">Xem vé</button>
</div>
</div>
    </div>
<?php
$kqmt = ob_get_contents();
ob_end_clean();

//$tttt_mb = true;
//$tttt_mt = true;
//$tttt_mn = true;
//if ($tttt_mb || $tttt_mt || $tttt_mn) {
//    echo '<script type="text/javascript" src="' . js_link('jquery-blink.js') . '"></script>';
//    if ($tttt_mb) {
//        echo '<div class="tttt_link"><a class="tttt_blink" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">Đang tường thuật trực tiếp Xổ Số Miền Bắc</a></div>';
//    } elseif ($tttt_mt) {
//        echo '<div class="tttt_link"><a class="tttt_blink" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html">Đang tường thuật trực tiếp Xổ Số Miền Trung</a></div>';
//    } else {
//        echo '<div class="tttt_link"><a class="tttt_blink" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html">Đang tường thuật trực tiếp Xổ Số Miền Nam</a></div>';
//    }
//    echo "<script type=\"text/javascript\">$(document).ready(function() { $('.tttt_blink').blink({delay:100});});</script>";
//}

if ($_SESSION['ck'] == 1 || $_SESSION['ck'] == 9)
    echo $kqmb . $kqmn . $kqmt;
elseif ($_SESSION['ck'] == 2)
    echo $kqmn . $kqmb . $kqmt;
elseif ($_SESSION['ck'] == 3)
    echo $kqmt . $kqmb . $kqmn;
?>

<div class="page-title-xs">
    <strong>Xổ số hôm nay <?php echo date('d/m/Y', time()) ?></strong>
    <a class="arrow-right" href="javascript:;" onclick="showPopup('#xshomnay');">&nbsp;</a>
</div>
<div class="home-block" id="xshomnay" style="display:none">
    <ul class="xs-menu">
        <li><h2><a href="<?php echo $uri_root . $url_mienbac ?>.html"><span>Miền Bắc</span></a></h2></li>
        <li><h2><a href="<?php echo $uri_root . $url_miennam ?>.html"><span>Miền Nam</span></a></h2></li>
        <?php
        foreach ($location_today['MN'] as $value) {
            echo '<li class="sub-menu-xstoday"><h3><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></h3></li>';
        }
        ?>
        <li><h2><a href="<?php echo $uri_root . $url_mientrung ?>.html"><span>Miền Trung</span></a></h2></li>
        <?php
        foreach ($location_today['MT'] as $value) {
            echo '<li class="sub-menu-xstoday"><h3><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></h3></li>';
        }
        ?>
    </ul>
</div>