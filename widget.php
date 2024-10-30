<?php
function moj_widget () {
	$out = "";
	
	$out .= '<ol class="first">'."\n".
					 '	<a href="http://mojtv.net"><img src="http://backend.mojtv.hr/img/hor.png" height="25" alt="TV Program" style="position:relative; height: 25px;"></a>'."\n".
					 '	<br><strong style="font-size:10px;color: #999;">'. (get_option('mojtv_setting_type') == '0' ? 'FILMOVI' : 'SERIJE') .' NA TV</strong>'."\n".
					 '</ol>'."\n";
	if(get_option('mojtv_setting_type') == '0') {
		$xml=simplexml_load_file(MOJTV_PLUGIN_DIR."/cache/movies.xml");
	} else {
		$xml=simplexml_load_file(MOJTV_PLUGIN_DIR."/cache/series.xml");
	}
	
	foreach($xml->children() as $child) {
		$attributes = $child->attributes();
		$dateArr = explode(' ',$attributes->start);
		$dateTmp = $dateArr[0];
		$dateTmp = substr($dateTmp, -6, 4);
			
			$out .= '<li>'."\n".
					 '	<div class="channel">'. $attributes->channel .'</div>'."\n".
					 '	<a'. (get_option('mojtv_setting_target') == '2' ? ' target="_blank"' : '') .' href="'. $child->url .'"><img src="http://mojtv.hr/thumb.ashx?path=images/'. str_replace("http://mojtv.net/images/","",$child->icon) .'&w=100&h=50" /></a>'."\n".
					 '	<div class="time">'. substr_replace($dateTmp, ':', 2, 0) .'</div>'."\n".
					 '	<h3 class="title"><a'. (get_option('mojtv_setting_target') == '2' ? ' target="_blank"' : '') .' href="'. $child->url .'">'. $child->title .'</a></h3>'."\n".
					 '	<div class="genres">'. $child->genres .'</div>'."\n".
					 '	<div class="year">'. $child->date .', '. $child->country .'</div>'."\n".
					 '	<div class="actors">'. $child->actors .'</div>'."\n".
					 '</li>'."\n";
	}
	
	return $out;
}


?>