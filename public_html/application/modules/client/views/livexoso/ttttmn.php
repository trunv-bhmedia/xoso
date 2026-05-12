<?php
$current = time();
$time_areamn = date('H\hi', strtotime($timermn));
$time = date('H:i');
$time_endmn = '16:00';
$l_areamn = 'Miền Nam';
$title = 'MIỀN NAM';
$title2 = 'Miền Nam';
//echo $timermn;
$counter = strtotime(date($timermn)) - $current;

$time12h = strtotime(date('Y-m-d 12:00:00'));
$count12h = $current - $time12h;

$today = date('d/m/Y', time());
?>
<div id="xstt-block-mn">
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
<script type="text/javascript">
    /*<![CDATA[*/
    var countermn=<?php echo $counter?>;
    var count12hmn=<?php echo $count12h?>;
    var timerCheckmn=setInterval("checkUpdatemn();",3000);
    function checkUpdatemn(){
        if(countermn<=0){
            $.ajax({
                type:"GET",
                timeout:3000,
                url:"<?php echo $uri_root . 'xstt/' . $areamn . '?t=' . $timermn; ?>",
                success:function(e){
                    if(e!=1){
                        var htmlmn = $.parseHTML(e);
                        htmlmn2 = $.parseHTML(htmlmn[2].innerHTML);
                        $("#xstt-block-mn").html(htmlmn2[3].outerHTML);
                    }
                }
            });
        }
        else if(count12hmn<=0){
            $.ajax({
                type:"GET",
                timeout:3000,
                url:"<?php echo $uri_root . 'xstt/' . $areamn . '?t=' . $timermn; ?>",
                success:function(e){
                    if(e!=1){
                        var htmlmn = $.parseHTML(e);
                        htmlmn2 = $.parseHTML(htmlmn[2].innerHTML);
                        $("#xstt-block-mn").html(htmlmn2[3].outerHTML);
                    }
                }
            });
        }
    };

    $(document).ready(function(a) {
        if (countermn > 0) $('#xsttclockmn').FlipClock(countermn, {
            countdown: true,
            callbacks: {
                stop: function() {
                    countermn = 0;
                    timerCheckmn = setInterval("checkUpdatemn();", 3000)
                }
            }
        });
        checkUpdatemn();
    });
    /*]]>*/
</script>
