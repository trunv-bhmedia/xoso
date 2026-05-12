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
<div id="kqxs-block-mb"></div>
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
	var countermb = <?php echo $countermb ?> ;
	var timerCheckmb = setInterval("checkUpdatemb();", 3000);

	function checkUpdatemb() {
		console.log('111');
			 if (countermb <= 0) {
				//if (1) {
				//alert('hainh');
				var url = "<?php echo $uri_root . 'xstt/xsmb.php'; ?>";
				console.log(url);
				$.ajax({
					type: "GET",
					timeout: 3000,
					dataType: "jsonp",
					jsonpCallback: "MB",
					cache: true,
					url: "<?php echo $uri_root . 'xstt/xsmb.php'; ?>",
					success: function(H) {

						if (H.sec == "<?php echo md5(date('d')) ?>") {
						//if (1) {
							//alert(H.data[0]);
							$("#xstt-block-mb").html("");
							$("#kqxs-block-mb").html("");
							$("#kqxs-mb").show();
							var I = true;
							if (H.status == 0) {
								//I = false
							}
							var F = ["\\+\\+\\+\\+", "\\+\\+\\+", "\\+\\+", "\\+"];
							var A = ['<img src="<?php echo img_link("count_1.gif") ?>" width="13" alt="" height="13" /><img src="<?php echo img_link("count_2.gif") ?>" width="13" alt="" height="13" /><img src="<?php echo img_link("count_3.gif") ?>" width="13" alt="" height="13" /><img src="<?php echo img_link("count_4.gif") ?>" width="13" alt="" height="13" />',
									'<img src="<?php echo img_link("count_1.gif") ?>" width="13" alt="" height="13" /><img src="<?php echo img_link("count_2.gif") ?>" width="13" alt="" height="13" /><img src="<?php echo img_link("count_3.gif") ?>" width="13" alt="" height="13" />',
									'<img src="<?php echo img_link("count_1.gif") ?>" width="13" alt="" height="13" /><img src="<?php echo img_link("count_2.gif") ?>" width="13" alt="" height="13" />',
									'<img src="<?php echo img_link("count_1.gif") ?>" width="13" alt="" height="13" />'
							];
							var J = H.data[0].replace(/\*\*\*\*\*/g, '<img src="<?php echo img_link("icon-xs/loading.gif") ?>" width="40" alt="" height="10" />');
							var x = H.data[1].replace(/\*\*\*\*\*/g, '<img src="<?php echo img_link("icon-xs/loading.gif") ?>" width="40" alt="" height="10" />');
							var y = H.data[2].replace(/-/g, '</strong><strong class="span-space">');
							var y = y.replace(/\*\*\*\*\*/g, '<img src="<?php echo img_link("icon-xs/loading.gif") ?>" width="40" alt="" height="10" />');
							var z = H.data[3].replace(/-/g, '</strong><strong class="span-space">');
							var z = z.replace(/\*\*\*\*\*/g, '<img src="<?php echo img_link("icon-xs/loading.gif") ?>" width="40" alt="" height="10" />');
							var B = H.data[4].replace(/-/g, '</strong><strong class="span-space">');
							var B = B.replace(/\*\*\*\*/g, '<img src="<?php echo img_link("icon-xs/loading.gif") ?>" width="40" alt="" height="10" />');
							var C = H.data[5].replace(/-/g, '</strong><strong class="span-space">');
							var C = C.replace(/\*\*\*\*/g, '<img src="<?php echo img_link("icon-xs/loading.gif") ?>" width="40" alt="" height="10" />');
							var D = H.data[6].replace(/-/g, '</strong><strong class="span-space">');
							var D = D.replace(/\*\*\*/g, '<img src="<?php echo img_link("icon-xs/loading.gif") ?>" width="40" alt="" height="10" />');
							var E = H.data[7].replace(/-/g, '</strong><strong class="span-space">');
							var E = E.replace(/\*\*/g, '<img src="<?php echo img_link("icon-xs/loading.gif") ?>" width="40" alt="" height="10" />');

							$.each(F, function(d, e) {
								var f = new RegExp(e, "g");
								J = J.replace(f, A[d]);
								x = x.replace(f, A[d]);
								y = y.replace(f, A[d]);
								z = z.replace(f, A[d]);
								B = B.replace(f, A[d]);
								C = C.replace(f, A[d]);
								D = D.replace(f, A[d]);
								E = E.replace(f, A[d])
							});

							$("#kqxs-mb td.giaidb").html('<strong class="red font18 span-space">' + J + "</strong>");
							$("#kqxs-mb td.giai1").html('<strong class="span-space">' + x + "</strong>");
							$("#kqxs-mb td.giai2").html('<strong class="span-space">' + y + "</strong>");
							$("#kqxs-mb td.giai3").html('<strong class="span-space">' + z + "</strong>");
							$("#kqxs-mb td.giai4").html('<strong class="span-space">' + B + "</strong>");
							$("#kqxs-mb td.giai5").html('<strong class="span-space">' + C + "</strong>");
							$("#kqxs-mb td.giai6").html('<strong class="span-space">' + D + "</strong>");
							$("#kqxs-mb td.giai7").html('<strong class="span-space">' + E + "</strong>");

							if (I == true) {
								clearInterval(timerCheckmb)
							}
						}
					}
				});
			}
	};

	$(document).ready(function(a) {
			if (countermb > 0) $('#xsttclockmb').FlipClock(countermb, {
					countdown: true,
					callbacks: {
							stop: function() {
									countermb = 0;
									timerCheck = setInterval("checkUpdatemb();", 3000)
							}
					}
			});
			checkUpdatemb();
		<?php
			if ($time < $time_endmb) { ?>
					$.ajax({
							type: "GET",
							timeout: 3000,
							url: "<?php echo $uri_root . 'xstt/' . $areamb . '?t=' . $timermb; ?>",
							success: function(a) {
									if (a != 1) {
						var htmlmb = $.parseHTML(a);
						$(htmlmb).find('.td-sub').remove();
						var htmlmb2 = $.parseHTML(htmlmb[8].innerHTML);
						var tablekqxsmb = (htmlmb2[3].outerHTML);
						$("#kqxs-block-mb").html(tablekqxsmb);
										// $("#kqxs-block-mb").html(a)
									}
							}
					});
			<?php } ?>
	});
	/*]]>*/
</script>
