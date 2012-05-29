<?php
class Schedule extends MY_Controller {

	/**
	 * 検索
	 *
	 */
	function index() {
	}
	
	/**
	 * 追加
	 *
	 */
	function add() {
		$this->render_view("user/schedule/form");
	}
	
	/**
	 * 更新
	 *
	 */
	function update() {
		$this->render_view("user/schedule/form");
	}
	
	/**
	 * 削除
	 *
	 */
	function delete() {
	}
	
}
