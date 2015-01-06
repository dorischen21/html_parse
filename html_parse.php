<?php
/*
* File:			html_parse.php
* Version:		-
* Last changed:	2015/01/06
* Purpose:		parse particular html
* Author:		Fisher Liao / fisherliao@gmail.com
* Copyright:	(C) 2015
* Product:		-
*/

$http="http://invoice.etax.nat.gov.tw/";	// 網址
$ary_html = file($http);	// 將網址的html存成一個變數(陣列格式, 一行一個)

// 定義常數
$str_find1 		= "<td class=\"title\">";
$str_find1_end	= "</td>";
$str_find2		= "<span class=\"t18Red\">";
$str_find2_end	= "</span>";

// 計算字串長度
$len_find1 = mb_strlen($str_find1, "UTF-8");
$len_find2 = mb_strlen($str_find2, "UTF-8");

echo '<meta charset=utf8><br>';	// 定義網頁編碼UTF8否則中文亂碼
for($i=0; $i < count($ary_html); $i++) { //以換行為單位
	$ary_line = explode('<br />', $ary_html[$i]);	// 以<br />為單位炸開
	for($j=0; $j < count($ary_line); $j++) {	
		// init
		$pos_start	= 0;
		$pos_end	= 0;
		$str_tmp	= '';

		// 1st find
		$pos_start = mb_strpos($ary_line[$j], $str_find1, 0, "UTF-8");

		if($pos_start > 0) {
			$pos_end = mb_strpos($ary_line[$j], $str_find1_end, $pos_start, "UTF-8");
			$str_tmp = mb_substr($ary_line[$j], ($pos_start + $len_find1), ($pos_end - $pos_start - $len_find1), "UTF-8");
			echo '['.$str_tmp.'] ';
		}

		// 2nd find
		// init
		$pos_start	= 0;
		$pos_end	= 0;
		$str_tmp	= '';

		$pos_start = mb_strpos($ary_line[$j], $str_find2, 0, "UTF-8");

		if($pos_start > 0) {
			$pos_end = mb_strpos($ary_line[$j], $str_find2_end, $pos_start, "UTF-8");
			$str_tmp = mb_substr($ary_line[$j], ($pos_start + $len_find2), ($pos_end - $pos_start - $len_find2), "UTF-8");
			echo '~~'.$str_tmp.'~~<br>';
		}
	}
}
?>