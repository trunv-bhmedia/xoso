<?php
if(!class_exists('HTMLCleaner'))
{
	require_once('HTMLCleaner.php');
}
function mostidy_clean($str_in = '',$remove_script = true, $remove_table = true){
	/*	$str_in	=	'<div>demo</div> <p>demo 1</p> <p>demo 2</p> <p>demo <div> demo 3</div> <div> demo 4</div> <p> demo 5';
	echo htmlspecialchars($str_in);
	echo '<br /><hr />';
	echo $str_in;*/	
	if ($remove_script) {
		$str_in	=	preg_replace('/<script[^>]*>.*?<\/script>/ism','<!--remove script here-->',$str_in);
	}
	$str_in	=	str_replace(array("\r\n","\t"),array(' ',' '),$str_in);
	$cleaner=new HTMLCleaner();

		$cleaner->Options['UseTidy']=true;
		$cleaner->Options['OutputXHTML']=false;
		$cleaner->Options['Optimize']=true;
		$cleaner->Options['IsWord']=true;
		if ($remove_table) {
			$cleaner->Tag_whitelist='<p><br><hr><blockquote>'.
									'<b><i><u><sub><sup><strong><em><tt><var>'.
									'<code><xmp><cite><pre><abbr><acronym><address><samp>'.
									'<fieldset><legend>'.
									'<a><img><h1><h2><h3><h4><h4><h5><h6>'.
									'<ul><ol><li><dl><dt><iframe><frame><frameset>'.
									'<form><input><select><option><optgroup><button><textarea><object><param><embed><center><xcode_html5><source>';	
		}else {
			$cleaner->Tag_whitelist='<table><tbody><thead><tfoot><tr><th><td><colgroup><col><p><br><hr><blockquote>'.
									'<b><i><u><sub><sup><strong><em><tt><var>'.
									'<code><xmp><cite><pre><abbr><acronym><address><samp>'.
									'<fieldset><legend>'.
									'<a><img><h1><h2><h3><h4><h4><h5><h6>'.
									'<ul><ol><li><dl><dt><iframe><frame><frameset>'.
									'<form><input><select><option><optgroup><button><textarea><object><param><embed><center><xcode_html5><source>'.
									'';
		}

	//	
		$cleaner->TidyConfig['indent']=true;
		$cleaner->TidyConfig['output-xhtml']=false;
		$cleaner->TidyConfig['show-body-only']=true;
		$cleaner->TidyConfig['hide-comments']=false;
		$cleaner->TidyConfig['clean']=false;
		$cleaner->TidyConfig['drop-proprietary-attributes']=false;	
		$cleaner->TidyConfig['wrap']=0;
		$arr_tag_xcode	=	array('video','audio','source');
		
		$arr_data_xcode	=	array();
		for ($i =0; $i<count($arr_tag_xcode); $i++)
		{
			$tag	=	$arr_tag_xcode[$i];
			
			
			if(preg_match_all('/<'.$tag.'[^>]*>/ism',$str_in,$matches))
			{
				$arr_data_xcode[$tag]	=	$matches[0];
				for ($j=0; $j<count($matches[0]);$j++)				
				{
					$str_in	=	str_replace($matches[0][$j],'__BEGIN__TAG__'.$tag.'_'.$j.'__',$str_in);
				}
				$str_in	=	str_replace('</'.$tag.'>','__END__TAG__'.$tag.'__',$str_in);					
			}			
		}		
		
		
		$str_in	=	str_replace('<video','<xcode_html5',$str_in);
		$str_in	=	str_replace('</video>','</xcode_html5>',$str_in);		
		$cleaner->html=$str_in;
//	if($run_bug == 1)
//	{
//		echo strip_tags('<p>abc<\p><abc a> asd </abc>','<p><abc>');
//		echo $str_in; die('aaaaaaaaaaaa');		
//	}
/**
 * The encoding parameter sets the encoding for input/output documents. 
 * The possible values for encoding are: ascii, latin0, latin1, raw, utf8, iso2022, mac,
 * win1252, ibm858, utf16, utf16le, utf16be, big5, and shiftjis. 
**/
	$cleanHTML=$cleaner->cleanUp('utf8');
	$return	=	is_object($cleanHTML)?$cleanHTML->value:$cleanHTML;
	$return	=	str_replace(array("\r\n","\t"),array(' ',' '),$return);
	$str_in	=	$return;
	
	for ($i =0; $i<count($arr_tag_xcode); $i++)		{
			$tag	=	$arr_tag_xcode[$i];
			if (!isset($arr_data_xcode[$tag])) {
					continue;
				}	
			for ($j=0; $j<count($arr_data_xcode[$tag]);$j++)
			{
				$str_in	=	str_replace('__BEGIN__TAG__'.$tag.'_'.$j.'__',$arr_data_xcode[$tag][$j],$str_in);
			}
			$str_in	=	str_replace('__END__TAG__'.$tag.'__','</'.$tag.'>',$str_in);
		}
	$return	=	$str_in;

	return $return;	
}
?>
