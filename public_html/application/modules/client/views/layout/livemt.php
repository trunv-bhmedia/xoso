
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Xem kết quả xổ số trực miền bắc quốc nhanh nhất, chính xác nhất tại xoso.com cập nhật liên tục từng giải trong suốt quá trình mở thưởng." />
<meta name="keywords" content="trực tiếp kết quả xổ số miền bắc, kết quả xổ số trực tiếp miền bắc, xổ số trực tiếp miền bắc, xo so truc tiep mien bac bắc, truc tiep ket qua xo so mien bac" />
<title>Xem trực tiếp kết quả xổ số miền bắc</title>
<meta property="og:image" content="https://www.xoso.com/public/client/images/logo.png" />
<meta http-equiv="refresh" content="900" />
<link rel="canonical" href="" /><link rel="alternate" media="handheld" href="" />
<link type="image/x-icon" href="https://www.xoso.com/public/client/images/favicon.ico" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="https://www.xoso.com/min/g=css1411" />
<script type="text/javascript" src="https://www.xoso.com/public/client/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="https://www.xoso.com/public/client/js/jquery-blink.js"></script>
<script type="text/javascript" src="https://www.xoso.com/public/client/js/flipclock.min.js"></script>
<script type="text/javascript" src="https://www.xoso.com/public/client/js/clock.js"></script>
 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"> -->
<link type="text/css" rel="stylesheet" href="https://www.xoso.com/public/client/css/livexoso.css?t=<?php echo strtotime('now'); ?>" />
<style>
	#xstt-block-mt table td:not(:first-child) {
		width: calc((100% - 100px) / 2);
	}

	#banner1{
		position: fixed;
		right: 0;
		z-index: 9999999;
		top: -40px;
	}
	#banner1 img {
		height: 240px;
	}

	#banner2 {
		position: fixed;
		bottom: 0;
		left: 91px;
	}
	div#banner2 img {
		height: 150px;
	}
#giftop{
	position: fixed;
  top: 14px;
  left: 717px;
  display: none;
}
#gifbottom{
	position: fixed;
	top: -7px;
	right: 250px;
}
/*.font70014 {
	font-size: 70px !important;
	line-height: 90px !important;
}*/
.border-right {
	display: table-cell !important;
}
.box-information p {
	font-size: 20px;
}
.ngaythang p {
	font-size: 14px;
	font-weight: bold;
}
</style>
</head>
<body>
	<div id="header"></div>
	<div id="wrapper">
		<div class="content-wrap">
			<div class="content">
				<div class="main clearfix">
				<div class="headerMN">
					<?php
						$days = array(
							'0' => 'Chủ nhật',
							'1' => 'Thứ 2',
							'2' => 'Thứ 3',
							'3' => 'Thứ 4',
							'4' => 'Thứ 5',
							'5' => 'Thứ 6',
							'6' => 'Thứ 7'
						);
						$strtotime_date = strtotime('now');
						$strtotime_date_yesterday = $strtotime_date - 86400;
						$current = time();
						$time12h = strtotime(date('Y-m-d 15:00:00'));
						$count12h = $current - $time12h;

						if($count12h <= 0){
							$thu = $days[date('w', $strtotime_date_yesterday)];
							$ngay = date('d/m/Y', $strtotime_date_yesterday);
						}else{
							$thu = $days[date('w', $strtotime_date)];
							$ngay = date('d/m/Y', $strtotime_date);
						}
						?>
					<div class="ngaythang"><p><?php echo $thu; ?></p><p><?php echo $ngay; ?></p></div>
					<?php if($count12h <= 0) { ?>
						<div class="locarea locarea-mn" style="<?php echo count($location_lastday[$areamt]) == 2 ? 'width: 45%' : 'width: 35%'?>">
						<?php
							$stylemn = count($location_lastday[$areamn]) == 2 ? 'width: 50%' : 'width: 33.33%';
							foreach ($location_lastday[$areamn] as $k => $v){
								echo '<div class="locitem locitem-mn" style="'.$stylemn.'">
										<p class="locname">'.$v->name.'</p>
										<p class="codename">('.$v->code.')</p>
										</div>';
							}
							?>
						</div>
						<div class="locarea locarea-mt" style="width:95%">
						<?php
							$stylemt = count($location_lastday[$areamt]) == 2 ? 'width: 50%' : 'width: 33.33%';
							foreach ($location_lastday[$areamt] as $k => $v){
							echo '<div class="locitem locitem-mt" style="'.$stylemt.'">
									<p class="locname">'.$v->name.'</p>
									<p class="codename">('.$v->code.')</p>
									</div>';
							}
							?>
						</div>
						<div class="locarea locarea-mb">
						<?php
							foreach ($location_lastday[$areamb] as $k => $v){
							echo '<div class="locitem locitem-mb">
									<p class="locname">'.$v->name.'</p>
									<p class="codename">('.$v->code.')</p>
									</div>';
							}
							?>
						</div>
					<?php } else { ?>
						<div class="locarea locarea-mn" style="<?php echo count($location_today[$areamt]) == 2 ? 'width: 45%' : 'width: 35%'?>">
						<?php
							$stylemn = count($location_today[$areamn]) == 2 ? 'width: 50%' : 'width: 33.33%';
							foreach ($location_today[$areamn] as $k => $v){
								echo '<div class="locitem locitem-mn" style="'.$stylemn.'">
										<p class="locname">'.$v->name.'</p>
										<p class="codename">('.$v->code.')</p>
										</div>';
							}
							?>
						</div>
						<div class="locarea locarea-mt" style="width: 95%">
						<?php
							$stylemt = count($location_today[$areamt]) == 2 ? 'width: 50%' : 'width: 33.33%';
							foreach ($location_today[$areamt] as $k => $v){
							echo '<div class="locitem locitem-mt" style="'.$stylemt.'">
									<p class="locname">'.$v->name.'</p>
									<p class="codename">('.$v->code.')</p>
									</div>';
							}
							?>
						</div>
						<div class="locarea locarea-mb">
						<?php
							foreach ($location_today[$areamb] as $k => $v){
							echo '<div class="locitem locitem-mb">
									<p class="locname">'.$v->name.'</p>
									<p class="codename">('.$v->code.')</p>
									</div>';
							}
							?>
						</div>
					<?php } ?>
				</div>
				<?php if($count12h <= 0) { ?>
					<div id="giai-mt" style="width: 100% !important">
						<?php $this->load->view($tmplmt); ?>
					</div>
				<?php } else { ?>
					<div id="giai-mt" style="width: 100% !important">
					<?php $this->load->view($tmplmt); ?>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div id="banner1">
		<img src="/public/client/css/images/mayman.gif" alt="">
	</div>
	<div id="banner2">
		<img src="/public/client/css/images/thantai.gif" >
	</div>
		<div id="giftop">
		<img src="/public/client/images/banner_top.gif"  alt="">
	</div>
	<div id="gifbottom">
		<img src="/public/client/images/banner_bottom.gif" alt="">
	</div>
</body>
</html>
