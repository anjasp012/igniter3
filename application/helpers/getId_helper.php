<?php

if (!function_exists('getId')) {
    function getId($int=0)
	{
		isset($_SESSION['COUNTER']) ? $_SESSION['COUNTER']++ : $_SESSION['COUNTER']=0 ;
		if($_SESSION['COUNTER']==10000){ $_SESSION['COUNTER']=0; }
		if($int>99){$ms=99;} else {$ms=$int;}
		$d3 = sprintf("%02d%02d",date('s'),$ms);
		$strResult = sprintf('%04s%04s-%04s-%04s-%04d-%04x%04x%04x',
			// 32 bits for "time_low"
			// mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			date('Y'), date('md'),
			// 16 bits for "time_mid"
			// mt_rand(0, 0xffff),
			date('Hi'),
			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			// mt_rand(0, 0x0fff) | 0x4000,
			$d3,
			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			// mt_rand(0, 0x3fff) | 0x8000,
			$_SESSION['COUNTER'],
			// 48 bits for "node"
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
		return $strResult;
	}
}
?>
