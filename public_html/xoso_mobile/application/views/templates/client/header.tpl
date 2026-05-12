<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo(isset($_meta['description']) ? $_meta['description'] : '');?>" />
<meta name="keywords" content="<?php echo(isset($_meta['keywords']) ? $_meta['keywords'] : '');?>" />
<title><?php echo(isset($_meta['title']) ? $_meta['title'] : '');?></title>
<script type="text/javascript" src="<?php echo js_link('jquery-1.7.2.min.js');?>"></script>
<script type="text/javascript" src="<?php echo js_link('common.js');?>"></script>
<script>
	var base_url = '<?php echo base_url();?>';
</script>
<!--[if IE 6]>
		<script src="js/DD_belatedPNG.js"></script>
		<script>
		  DD_belatedPNG.fix('img, div, a, span');
		</script>
	<![endif]-->
<link href="<?php echo css_link('content.css','client','css')?>" rel="stylesheet" type="text/css" />

</head>

<body>
	