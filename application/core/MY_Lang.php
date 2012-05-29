<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Lang extends CI_Lang {
	
	function __construct() {
		parent::__construct();
	}

	/**
	 * デフォルト言語 ＞ 指定言語の順にファイルをロードする
	 * 英語の言語設定だけは必ず行うこととする
	 * @see CI_Language::load()
	 *
	 * @todo 言語DBにて翻訳を行う
	 */
	function load($langfile = '', $idiom = '', $return = FALSE)
	{
		$langfile = str_replace(EXT, '', str_replace('_lang.', '', $langfile)).'_lang'.EXT;

		if (in_array($langfile, $this->is_loaded, TRUE))
		{
			return;
		}

		if ($idiom == '')
		{
			$CI =& get_instance();
			$deft_lang = $CI->config->item('language');
			$idiom = ($deft_lang == '') ? 'english' : $deft_lang;
		}

		// Determine where the language file is and load it
		// 英語をデフォルトとしてロード
		if ($idiom != 'english') {
			if (file_exists(BASEPATH.'language/english/'.$langfile)) {
				include(BASEPATH.'language/english/'.$langfile);
			}
		}
		if (file_exists(BASEPATH.'language/'.$idiom.'/'.$langfile)) {
			include(BASEPATH.'language/'.$idiom.'/'.$langfile);
		}
		if ($idiom != 'english') {
			if (file_exists(APPPATH.'language/english/'.$langfile)) {
				include(APPPATH.'language/english/'.$langfile);
			}
		}
		if (file_exists(APPPATH.'language/'.$idiom.'/'.$langfile)) {
			include(APPPATH.'language/'.$idiom.'/'.$langfile);
		}
		
		if ( ! isset($lang)) {
			log_message('error', 'Language file contains no data: language/'.$idiom.'/'.$langfile);
			return;
		}

		if ($return == TRUE)
		{
			return $lang;
		}

		$this->is_loaded[] = $langfile;
		$this->language = array_merge($this->language, $lang);
		unset($lang);

		log_message('debug', 'Language file loaded: language/'.$idiom.'/'.$langfile);
		return TRUE;
	}
}
