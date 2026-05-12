<?php
$current = time();
$time_areamb = date('H\hi', strtotime($timermb));
$time = date('H:i');

$time_endmb = '15:00';
$time_endmb18 = '18:15';
$l_areamb = 'Truyền thống';

$title = 'MIỀN BẮC';
$title2 = 'Miền Bắc';

$countermb = strtotime(date($timermb)) - $current;

$time12h = strtotime(date('Y-m-d 15:00:00'));
$count12h = $current - $time12h;

$today = date('d/m/Y', time());
?>
<div id="xstt-block-mb">
	<div class="box-result">
		<?php if ($countermb > 0 && $count12h > 0) { ?>
		<div class="box-information">
			<p class="red">
				<strong>Đang chờ đến giờ xổ số <?php echo $title2 ?></strong>
			</p>
			<p>Lịch quay số mở thưởng ngày <?php echo $today ?></p>
			<div id="xsttclockmb"></div>
			<p><strong class="red">Kính chúc quý khách may mắn phát tài!</strong></p>
		</div>
		<?php } ?>
	</div>
</div>
<?php //if(date('YmdHi') < date('Ymd1745') OR date('YmdHi') >= date('Ymd1815')) { ?>
<div id="kqxs-block-mb"></div>
<?php //} ?>
<?php
$days = array('0' => 'Chủ nhật',
		'1' => 'Thứ 2',
		'2' => 'Thứ 3',
		'3' => 'Thứ 4',
		'4' => 'Thứ 5',
		'5' => 'Thứ 6',
		'6' => 'Thứ 7');

if ($time > $time_endmb18) {
$date = date('d/m/Y', strtotime('-1 day'));
$date_ve_do = date('d-m-Y', strtotime('-1 day'));
$datew = date('w', strtotime('-1 day'));

?>
<div id="kqxs-mb" style="display:none">
	<table class="tbl-tt">
		<tr>
			<td class="bg-gray border-right">Giải đặc biệt</td>
			<td class="bg-gray border-right giaidb"></td>
		</tr>
		<tr>
			<td class="border-right">Giải nhất</td>
			<td class="border-right giai1 font70014"></td>
		</tr>
		<tr>
		<td class="bg-gray border-right">Giải nhì</td>
			<td class="bg-gray border-right giai2 font70014"></td>
		</tr>
		<tr>
			<td class="border-right">Giải ba</td>
			<td class="border-right giai3 font70014"></td>
		</tr>
		<tr>
			<td class="bg-gray border-right">Giải tư</td>
			<td class="bg-gray border-right giai4 font70014"></td>
		</tr>
		<tr>
			<td class="border-right">Giải năm</td>
			<td class="border-right giai5 font70014"></td>
		</tr>
		<tr>
			<td class="bg-gray border-right">Giải sáu</td>
			<td class="bg-gray border-right giai6 font70014"></td>
		</tr>
		<tr>
			<td class="border-right">Giải bảy</td>
			<td class="border-right giai7 font70014"></td>
			<td></td>
		</tr>
	</table>
</div>
<?php } ?>

<script type="text/javascript">
	/*<![CDATA[*/
	var countermb = <?php echo $countermb?>;
    var count12hmn=<?php echo $count12h?>;
	var timerCheckmb = setInterval("checkUpdatemb();", 3000);

	function checkUpdatemb(check=0) {
		console.log(check);

			if (countermb <= 0) {
				$.ajax({
							type: "GET",
							timeout: 3000,
							url: "<?php echo $uri_root . 'xstt_1/' . $areamb . '?t=' . $timermb; ?>",
							success: function(a) {
									if (a != 1) {
						var htmlmb = $.parseHTML(a);
						$(htmlmb).find('.td-sub').remove();
						var htmlmb2 = $.parseHTML(htmlmb[8].innerHTML);
						var tablekqxsmb = (htmlmb2[3].outerHTML);
						$("#kqxs-block-mb").html(tablekqxsmb);
						//$('#kqxs-block-mb table').css('height', '850px');
						$('.box-result').html('');
													$('#kqxs-block-mb tr').each(function() {
								$(this).find('td').eq(0).css('background', '#d60000');
							});
										// $("#kqxs-block-mb").html(a)
									}
							}
				});
			} else {
				if (check == 1) {
					$.ajax({
								type: "GET",
								timeout: 3000,
								url: "<?php echo $uri_root . 'xstt_2/' . $areamb . '?t=' . $timermb; ?>",
								success: function(a) {
										if (a != 1) {
							var htmlmb = $.parseHTML(a);
							$(htmlmb).find('.td-sub').remove();
							var htmlmb2 = $.parseHTML(htmlmb[8].innerHTML);
							var tablekqxsmb = (htmlmb2[3].outerHTML);
							$("#kqxs-block-mb").html(tablekqxsmb);
							$('#kqxs-block-mb table').css('height', '620px');
							//$('#kqxs-block-mb tr').find('td').eq(0).css('background', '#d60000');
							$('#kqxs-block-mb tr').each(function() {
								$(this).find('td').eq(0).css('background', '#d60000');
							});
											// $("#kqxs-block-mb").html(a)
										}
								}
					});
				} else {
					$.ajax({
							type: "GET",
							timeout: 3000,
							url: "<?php echo $uri_root . 'xstt_1/' . $areamb . '?t=' . $timermb; ?>",
							success: function(a) {
									if (a != 1) {
						var htmlmb = $.parseHTML(a);
						$(htmlmb).find('.td-sub').remove();
						var htmlmb2 = $.parseHTML(htmlmb[8].innerHTML);
						var tablekqxsmb = (htmlmb2[3].outerHTML);
						$("#kqxs-block-mb").html(tablekqxsmb);
						//$('#kqxs-block-mb table').css('height', '850px');
						$('.box-result').html('');
													$('#kqxs-block-mb tr').each(function() {
								$(this).find('td').eq(0).css('background', '#d60000');
							});
									}
							}
				});
				}
			}
	};

	$(document).ready(function(a) {
		$('.locarea-mb').css('background', '#d60000');
			if (countermb > 0) {
				if (count12hmn > 0) {
					clearInterval(timerCheckmb);
					var timerCheckmb1 = setInterval("checkUpdatemb(1);", 3000);
				}

				$('#xsttclockmb').FlipClock(countermb, {
					countdown: true,
					callbacks: {
							stop: function() {
									countermb = 0;
									timerCheck = setInterval("checkUpdatemb();", 3000)
							}
					}
				});
			}

			if (countermb > 0 && count12hmn > 0) {
				checkUpdatemb(1);
			} else {
				checkUpdatemb();
			}
			
		<?php
			if ($time < $time_endmb) { ?>
					$.ajax({
							type: "GET",
							timeout: 3000,
							url: "<?php echo $uri_root . 'xstt_1/' . $areamb . '?t=' . $timermb; ?>",
							success: function(a) {
									if (a != 1) {
						var htmlmb = $.parseHTML(a);
						$(htmlmb).find('.td-sub').remove();
						var htmlmb2 = $.parseHTML(htmlmb[8].innerHTML);
						var tablekqxsmb = (htmlmb2[3].outerHTML);
						$("#kqxs-block-mb").html(tablekqxsmb);
													$('#kqxs-block-mb tr').each(function() {
								$(this).find('td').eq(0).css('background', '#d60000');
							});
						// $('#kqxs-block-mb table').css('height', '600px');
										// $("#kqxs-block-mb").html(a)
									}
							}
					});
			<?php } ?>
	});
	/*]]>*/
</script>
