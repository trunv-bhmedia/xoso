<?php 
if($result):
$max = $result->max;
$min = $result->min;
?>
<div class="content">
	<div class="statis">
		<p class="txt-blue">Thống kê loto <?php echo $location->name;?> trong <?php echo $days;?> ngày </p>
		<div class="number">
			10 <span>Bộ số về</span> NHIỀU NHẤT
		</div>
		<div class="box clearfix">
			<div class="box-yelow mr10 left">
				<?php foreach($max as $k => $v):?>
				<?php if($k <= 4):?>
					<p <?php echo ($k==4 ? 'class="last"' : '');?>><?php echo $v[0]?>:(<?php echo $v[1];?> lần)</p>
				<?php endif;?>
				<?php endforeach;?>
			</div>
			<div class="box-yelow left">
				<?php foreach($max as $k => $v):?>
				<?php if($k >= 5):?>
					<p <?php echo ($k==4 ? 'class="last"' : '');?>><?php echo $v[0]?>:(<?php echo $v[1];?> lần)</p>
				<?php endif;?>
				<?php endforeach;?>
			</div>
		</div>
		<div class="number">
			10 <span>Bộ số về</span> ít NHẤT
		</div>
		<div class="box clearfix">	
			<div class="box-blue left mr10">
				<?php foreach($min as $k => $v):?>
				<?php if($k <= 4):?>
					<p <?php echo ($k==4 ? 'class="last"' : '');?>><?php echo $v[0]?>:(<?php echo $v[1];?> lần)</p>
				<?php endif;?>
				<?php endforeach;?>
			</div>
			<div class="box-blue left">
				<?php foreach($min as $k => $v):?>
				<?php if($k >= 5):?>
					<p <?php echo ($k==4 ? 'class="last"' : '');?>><?php echo $v[0]?>:(<?php echo $v[1];?> lần)</p>
				<?php endif;?>
				<?php endforeach;?>
			</div>
		</div>
	</div>
</div>
<?php else:?>
<div class="content">
	<b>Không tìm thấy kết quả!</b>
</div>
<?php endif;?>