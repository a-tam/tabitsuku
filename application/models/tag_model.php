<?php
class Tag_model extends MY_Model {
	
	function __construct(){
		parent::__construct("tags");
	}
	
	function tag_keys($tags) {
		$exists = array();
		$tag_keys = array();
		if ($tags) {
			// 登録済みデータの取得
			$this->db->select('id, name');
			$this->db->from($this->table);
			$this->db->where_in("name", $tags);
			$this->db->where("status", TAG_STATUS_ENABLED);
			$query = $this->db->get();
			foreach($query->result_array() as $row) {
				$exists[$row["id"]] = $row["name"];
			}
			foreach($tags as $tag) {
				if ($tag != "") {
					if (!$key = array_search($tag, $exists)) {
						$key = $this->insert($tag);
					}
					$tag_keys[] = $key;
				}
			}
		}
		return $tag_keys;
	}
	
	function like($term) {
		$sql = "SELECT id, name FROM ".$this->table.
				" WHERE name LIKE ?".
				" ORDER BY name ASC";
		$query = $this->db->query($sql, $term."%");
		$rows = array();
		foreach($query->result_array() as $row) {
			$rows[] = $row["name"];
		}
		return $rows;
	}
	
	function tag_values($keys) {
		$result = array();
		if ($keys) {
			if (!is_array($keys)) {
				$keys = explode(",", $keys);
			}
			// 登録済みデータの取得
			$this->db->select('id, name');
			$this->db->from($this->table);
			$this->db->where_in("id", $keys);
			$this->db->where("status", TAG_STATUS_ENABLED);
			$query = $this->db->get();
			foreach($query->result_array() as $row) {
				$result[$row["id"]] = $row["name"];
			}
		}
		return $result;
	}
	
	function insert($tag) {
		$data["name"] = $tag;
		$data["status"] = TAG_STATUS_ENABLED;
		return parent::insert($data);
	}
}