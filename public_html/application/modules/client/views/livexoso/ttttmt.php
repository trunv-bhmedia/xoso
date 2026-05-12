<?php
$current = time();
$time_areamt = date('H\hi', strtotime($timermt));
$time = date('H:i');
$time_endmt = '17:00';
$l_areamt = 'Miền Trung';
$title = 'MIỀN TRUNG';
$title2 = 'Miền Trung';
$counter = strtotime(date($timermt)) - $current;
$time12h = strtotime(date('Y-m-d 12:00:00'));
$count12h = $current - $time12h;
$today = date('d/m/Y', time());
?>
<div id="xstt-block-mt">
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
foreach ($location_today[$areamt] as $k => $v)
echo($k == 0 ? '' : ' - ') . $v->name;
?>
</span>
</p>
<div id="xsttclockmt"></div>
<p><strong class="red">Kính chúc quý khách may mắn phát tài!</strong></p>
</div>
<?php } ?>
</div>
</div>
<script type="text/javascript">
/*<![CDATA[*/
var countermt=<?php echo $counter ?>;
var count12hmt=<?php echo $count12h?>;
var timerCheckmt=setInterval("checkUpdatemt();",3000);
function checkUpdatemt(){
    if(countermt<=0){
        $.ajax({
            type:"GET",
            timeout:3000,
            url:"<?php echo $uri_root . 'xstt/' . $areamt . '?t=' . $timermt; ?>",
            success:function(e){
                if(e!=1){
					var htmlmt = $.parseHTML(e);					
					htmlmt2 = $.parseHTML(htmlmt[2].innerHTML);
					$("#xstt-block-mt").html(htmlmt2[3].outerHTML);                   
                }
            }
        }); 
    }else if(count12hmt<=0){ 
        $.ajax({
            type:"GET",
            timeout:3000,
            url:"<?php echo $uri_root . 'xstt/' . $areamt . '?t=' . $timermt; ?>",
            success:function(e){
                if(e!=1){
					var htmlmt = $.parseHTML(e);					
					htmlmt2 = $.parseHTML(htmlmt[2].innerHTML);
					$("#xstt-block-mt").html(htmlmt2[3].outerHTML);                   
                }
            }
        });
    }
};
$(document).ready(function(a) {
    if (countermt > 0) $('#xsttclockmt').FlipClock(countermt, {
        countdown: true,
        callbacks: {
            stop: function() {
                countermt = 0;
                timerCheckmt = setInterval("checkUpdatemt();", 3000)
            }
        }
    });
    checkUpdatemt();
});
/*]]>*/
</script>