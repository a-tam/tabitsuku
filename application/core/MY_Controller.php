<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
	
	var $user_info = null;
	var $admin_info = null;
	
	function __construct() {
		parent::__construct();
	}
	
	function auth() {
		if (!$this->user_info = $this->phpsession->get("user_info")) {
			return FALSE;
		} else {
			return $this->user_info;
		}
	}
	
	function admin_auth() {
		if (!$this->admin_info = $this->phpsession->get("admin_info")) {
			return FALSE;
		} else {
			return $this->admin_info;
		}
	}
	
	function login_form() {
		$this->load->library("form_validation");
		$this->render_view('user/login');
	}
	
	function admin_login_form() {
		$this->render_view('admin/login');
	}
	
	function render_view($page, $_data = array(), $options = array()) {
		// JS files
		$js_files = array(
			'/assets/js/jquery/jquery-1.7.2.min.js',
			'/assets/js/jquery/jquery-ui-1.8.20.custom.min.js'
		);
		// CSS files
		$css_files = array(
			'assets/css/common/import.css',
			'assets/css/ui-lightness/jquery-ui-1.8.20.custom.css',
			);
		if (isset($options['js_files'])) 	$js_files = array_merge($js_files, $options['js_files']);
		if (isset($options['css_files'])) 	$css_files = array_merge($css_files, $options['css_files']);
		$header = array(
			'title' 		=> 'プロジェクト管理システム',
			'sub_title' 	=> isset($options['sub_title']) ? $options['sub_title'] : "",
			'js_files'		=> $js_files,
			'css_files' 	=> $css_files,
		);
		if (!file_exists('application/views/'.$page.'.php')) {
			show_error('404');
		}
		$data = array(
			'header' 		=> $header,
			'main_page' 	=> $page,
			'data'			=> $_data
		);
		$frame_type = substr($page, 0, strpos($page, "/"));
		$this->load->view($frame_type."/frame.php", $data);
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $fields
	 * @param unknown_type $data
	 * @param unknown_type $err_delim
	 */
	function set_validation($fields, $err_delim = array('<div class="error">', '</div>')) {
		$this->load->library("form_validation");
		foreach($fields as $id => $field) {
			if (isset($field["rule"]) && $field["rule"]) {
				$rules = implode("|", $field["rule"]);
				$this->form_validation->set_rules($id, $field["name"], $rules);
			}
		}
		$this->form_validation->set_error_delimiters($err_delim[0], $err_delim[1]);
	}
	
	function _set_validation($form_data) {
		$this->set_validation($form_data);
	}
	
	function set_ticket() {
		$this->ticket = hash("sha256", uniqid('', TRUE));
		$this->phpsession->set("__ticket", $this->ticket, $this->ns);
	}
	
	function check_ticket() {
		$ticket = $this->phpsession->get("__ticket", $this->ns);
		if ($this->input->post("__ticket") !== $ticket) {
			return FALSE;
		} else {
			$this->phpsession->clear("__ticket", $this->ns);
			return TRUE;
		}
	}
	
	/**
	 * メールや認証用のURLを発行する際に可逆可能な暗号文字列を生成する
	 * @param string $code
	 */
	function encode($id) {
		$this->load->library("encrypt");
		// デフォルトは長すぎるためBLOWFISHに変更
		$this->encrypt->set_cipher(MCRYPT_BLOWFISH);
		$string = $this->encrypt->encode($id);
		// ／、＋の文字がURLとして利用しづらいため変換
		$string = str_replace('+', '_', $string);
		$string = str_replace('/', '-', $string);
		return $string;
	}
	
	/**
	 * 生成した暗号化文字列を復号化
	 * @param string $id
	 */
	function decode($id) {
		$this->load->library("encrypt");
		// デフォルトは長すぎるためBLOWFISHに変更
		$this->encrypt->set_cipher(MCRYPT_BLOWFISH);
		// ／、＋を復号
		$id = str_replace('_', '+', $id);
		$id = str_replace('-', '/', $id);
		return $this->encrypt->decode($id);
	}
}