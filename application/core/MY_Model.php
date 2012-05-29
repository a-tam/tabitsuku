<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
	
	var $table = "";
	function __construct($table = "") {
		parent::__construct();
		$this->table = $table;
	}
	
	function get_structure() {
		
	}

	/**
	 * IDを指定し１行１列取得
	 * @param unknown_type $id
	 * @param unknown_type $field
	 * @return Ambigous <boolean, unknown, unknown>
	 */
	function one($id, $field) {
		return $this->get_one(array("id" => $id), $field);
	}
	
	/**
	 * IDを指定し１行取得
	 * @param unknown_type $id
	 * @param unknown_type $fields
	 */
	function row($id, $fields = array()) {
		return $this->get_row(array("id" => $id), $fields);
	}
	
	/**
	 * 条件を指定し１行１列取得
	 * @param unknown_type $wheres
	 * @param unknown_type $field
	 * @return boolean|unknown
	 */
	function get_one($wheres, $field, $sorts = array()) {
		if ($field == "" || !is_array($wheres)) {
			return FALSE;
		}
		$this->db->select($field);
		$this->db->from($this->table);
		foreach ($wheres as $_key => $_val) {
			$this->db->where($_key, $_val);
		}
		$this->db->limit(1, 0);
		// order_by
		foreach ($sorts as $fields => $sort) {
			$this->db->order_by($fields, $sort);
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if (isset($row[$field])) {
				return $row[$field];
			}
		}
		return FALSE;
	}
	
	/**
	 * 条件を指定し１行取得
	 * @param unknown_type $wheres
	 * @param unknown_type $fields
	 * @return boolean|unknown
	 */
	function get_row($wheres, $fields = array()) {
		if (!is_array($wheres)) {
			return FALSE;
		}
		foreach ($fields as $field) {
			$this->db->select($field);
		}
		$this->db->from($this->table);
		foreach ($wheres as $_key => $_val) {
			$this->db->where($_key, $_val);
		}
		$this->db->limit(1, 0);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			return $row;
		}
		return FALSE;
	}

	/**
	 * 有効なリストをID, NAMEの連想配列で取得したい場合
	 * @return multitype:|multitype:unknown
	 */
	function key_val() {
		if (!$user_info = $this->phpsession->get("user_info")) {
			return array();
		}
		$this->db->select("id");
		$this->db->select("name");
		$this->db->from($this->table);
		$this->db->where("user_id", $user_info["id"]);
		$this->db->where("status", "1");
		$query = $this->db->get();
		$rows = array();
		foreach($query->result_array() as $row) {
			$rows[$row["id"]] = $row["name"];
		}
		return $rows;
	}
	
	/**
	 * 単一テーブルに対しての単純なSELECTクエリー実行
	 * @param array $fields
	 * @param array $wheres
	 * @param integer $limit
	 * @param integer $offset
	 * @param array $sorts
	 * @return 成功：クエリ結果オブジェクト、失敗：FALSE
	 *
	 * @todo モデルの構造体を元にしたクエリーを生成できるといいかもしれない。
	 */
	function select($fields = array(), $wheres = array(), $limit = null, $offset = 0, $sorts = array()) {
		if (!is_array($fields) || !is_array($wheres) ||
			(!is_null($limit) && !is_int($limit)) || !is_int($offset) || !is_array($sorts)) {
			log_message("debug", "引数が正しくセットされていない");
			return FALSE;
		}
		// select
		foreach ($fields as $field) {
			$this->db->select($field);
		}
		// from
		$this->db->from($this->table);
		// where
		foreach ($wheres as $_key => $_val) {
			$this->db->where($_key, $_val);
		}
		// limit
		if (is_numeric($limit)) {
			$this->db->limit($limit, $offset);
		}
		// order_by
		foreach ($sorts as $fields => $sort) {
			$this->db->order_by($fields, $sort);
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query;
		}
		return FALSE;
	}
	
	/**
	 * 追加
	 * @param mixed $data
	 * @return string
	 */
	function insert($data) {
//		$data["id"] = $this->uniqid();
		$data["created_time"] = MY_EXEC_TIME;
		$data["updated_time"] = MY_EXEC_TIME;
		$this->db->insert($this->table, $data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	/**
	 * IDを指定して更新
	 * @param unknown_type $data
	 * @param unknown_type $id
	 * @return boolean
	 */
	function update($data, $id) {
		return $this->updates($data, array("id" => $id));
	}
	
	/**
	 * 更新
	 * @param mixed $data
	 * @param array $wheres
	 */
	function updates($data, $wheres) {
		// 無条件の更新は不可
		if (!is_array($wheres) || !$wheres) {
			return FALSE;
		}
		$data["updated_time"] = MY_EXEC_TIME;
		foreach ($wheres as $_key => $_val) {
			$this->db->where($_key, $_val);
		}
		$this->db->update($this->table, $data);
	}
	
	/**
	 * IDを指定して削除
	 * @param string $id
	 * @return boolean
	 */
	function delete($id) {
		return $this->deletes(array("id" => $id));
	}
	
	/**
	 * 削除
	 * @param string $wheres
	 * @return boolean
	 */
	function deletes($wheres) {
		// 無条件の更新は不可
		if (!is_array($wheres) || !$wheres) {
			return FALSE;
		}
		foreach ($wheres as $_key => $_val) {
			$this->db->where($_key, $_val);
		}
		$this->db->delete($this->table);
	}
	
	/**
	 * 全件削除（滅びの合言葉が必要です）
	 *
	 */
	function trancate($word) {
		if ($word === "バルス") {
			$this->db->truncate($this->table);
		}
	}
	
	/**
	 * ユニークキーの生成ルール
	 * @return string
	 */
	function uniqid() {
		return substr(str_replace('.', '', uniqid('', TRUE)), 0, 20);
	}
	
	/**
	 * パスワードハッシュ用
	 * @param unknown_type $string
	 * @param unknown_type $id
	 * @return string
	 */
	function hash_password($string, $id = "") {
		if (!is_string($id)) {
			$id = "";
		}
		return hash("sha256", $id.$string);
	}
}