<?php
$current = time();
$time_areamn = date('H\hi', strtotime($timermn));
$time = date('H:i');
$time_endmn = '15:00';
$l_areamn = 'Miền Nam';
$title = 'MIỀN NAM';
$title2 = 'Miền Nam';
//echo $timermn;
$counter = strtotime(date($timermn)) - $current;

$time12h = strtotime(date('Y-m-d 15:00:00'));
$count12h = $current - $time12h;

$today = date('d/m/Y', time());
?>
<div id="xstt-block-mb">
    <div class="box-result">
        <?php if ($counter > 0 && $count12h >= 0) { ?>
        <div class="box-information">
            <p class="red">
                <strong>Đang chờ đến giờ xổ số <?php echo $title2 ?></strong>
            </p>
            <p>
                Lịch quay số mở thưởng ngày <?php echo $today ?><br />
                <span class="red">
                    <?php
                    foreach ($location_today[$areamn] as $k => $v)
                        echo($k == 0 ? '' : ' - ') . $v->name;
                    ?>
                </span>
            </p>
            <div id="xsttclockmn"></div>
            <p><strong class="red">Kính chúc quý khách may mắn phát tài!</strong></p>
        </div>
        <?php } ?>
    </div>
</div>
<?php //if(date('YmdHi') < date('Ymd1545') OR date('YmdHi') >= date('Ymd1615')) { ?>
<div id="xstt-block-mn"></div>
<?php //} ?>
<script type="text/javascript">
    /*<![CDATA[*/
    var countermn=<?php echo $counter?>;
    var count12hmn=<?php echo $count12h?>;
    var timerCheckmn=setInterval("checkUpdatemn();",3000);
    function checkUpdatemn(check=0){
        if(countermn<=0){
            $.ajax({
                type:"GET",
                timeout:3000,
                url:"<?php echo $uri_root . 'xstt_1/' . $areamn . '?t=' . $timermn; ?>",
                success:function(e){
                    if(e!=1){
                        var htmlmn = $.parseHTML(e);
                        htmlmn2 = $.parseHTML(htmlmn[2].innerHTML);
                        $("#xstt-block-mn").html(htmlmn2[3].outerHTML);
                        $('#xstt-block-mn table').css('height', '850px');
                        $('.box-result').html('');
                    }
                }
            });
        } else {
            if (check == 1) {
                $.ajax({
                    type:"GET",
                    timeout:3000,
                    url:"<?php echo $uri_root . 'xstt_2/' . $areamn . '?t=' . $timermn; ?>",
                    success:function(e){
                        if(e!=1){
                            var htmlmn = $.parseHTML(e);
                            htmlmn2 = $.parseHTML(htmlmn[2].innerHTML);
                            $("#xstt-block-mn").html(htmlmn2[3].outerHTML);
                            $("#xstt-block-mn tr").eq(0).show();
                            //$("#xstt-block-mn tr").eq(1).show();
                            $('#xstt-block-mn table').css('height', '600px');
                            $("#xstt-block-mn tr").eq(0).find('strong').eq(0).css('color', 'yellow');
                            $("#xstt-block-mn tr").eq(0).find('strong').css('font-size', '30px');

                            var date = $("#xstt-block-mn tr").eq(1).find('td').eq(0).html();
                            $("#xstt-block-mn tr").eq(0).find('strong').eq(0).append('<p style="font-size:17px">'+date+'</p>');
                        }
                    }
                });
            } else {
                $.ajax({
                    type:"GET",
                    timeout:3000,
                    url:"<?php echo $uri_root . 'xstt_1/' . $areamn . '?t=' . $timermn; ?>",
                    success:function(e){
                        if(e!=1){
                            var htmlmn = $.parseHTML(e);
                            htmlmn2 = $.parseHTML(htmlmn[2].innerHTML);
                            $("#xstt-block-mn").html(htmlmn2[3].outerHTML);
                            $('#xstt-block-mn table').css('height', '850px');
                            $('.box-result').html('');
                        }
                    }
                });
            }
        }
    };

    $(document).ready(function(a) {
        if (countermn > 0){
            if (count12hmn > 0) {
                clearInterval(timerCheckmn);
                var timerCheckmn1 = setInterval("checkUpdatemn(1);", 3000);
            }

            $('#xsttclockmn').FlipClock(countermn, {
                countdown: true,
                callbacks: {
                    stop: function() {
                        countermn = 0;
                        timerCheckmn = setInterval("checkUpdatemn();", 3000)
                    }
                }
            });
        }

        if (countermn > 0 && count12hmn > 0) {
            checkUpdatemn(1);
        } else {
            checkUpdatemn();
        }
    });
    /*]]>*/
</script>
