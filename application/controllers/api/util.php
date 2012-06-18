<?php
class Util extends MY_Controller {
	
	function kana_zenhan_conv() {
		$filename = dirname(__FILE__)."/sample.txt";
		$contents = file_get_contents($filename);
		file_put_contents($filename.".bk", mb_convert_kana($contents, "k", "utf8"));
	}
}