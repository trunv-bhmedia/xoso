<?php
header("Content-type: text/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";

$arr	=	array(
	'0'	=>	array('MB','Miền Bắc'),
	'1'	=>	array('MT','Miền Trung'),
	'2'	=>	array('MN','Miền Nam')
);
if($param):
$param	=	json_decode($param);
$mang	=	array(
	array('a0','Giải Đặc Biệt'),
	array('a1','Giải Nhất'),
	array('a2','Giải Nhì'),
	array('a3','Giải Ba'),
	array('a4','Giải Tư'),
	array('a5','Giải Năm'),
	array('a6','Giải Sáu'),
	array('a7','Giải Bảy')
	
);



//print_r($param);
$cache	=	$param->cache;
$area	=	$arr[$param->code];

if($param->code > 0)
{
	$mang[] = array('a8','Giải Tám');
}
$date = date("d-m-Y"); 
?>
<chanel>
<area codeLocal="<?php echo $area[0];?>" nameLocal="<?php echo $area[1];?>">
<?php foreach($cache as $k => $v):?>
	<result  idlocal="<?php echo $v->code;?>" namelocal="<?php echo $v->name;?>" status="<?php echo $v->status;?>">
		<XoSo data="<?php echo $date;?>">
			<?php foreach($mang as $km => $vm):?>
			<item rankName="<?php echo $km;?>" value="<?php echo $v->data[$km];?>" rankNumber="<?php echo $vm[1];?>"/>
			<?php endforeach;?>
		</XoSo>
		<?php 
		$lo = $v->extra;
		?>
		<Lo>
			<?php foreach($lo as $kl => $vl):?>
			<itemLo name="<?php echo $kl;?>" valueLo="<?php echo $vl;?>"/>
			<?php endforeach;?>
		</Lo>
	</result>

<?php endforeach;?>
</area>
</chanel>
<?php else:?>
<chanel>

</chanel>
<?php endif;?>