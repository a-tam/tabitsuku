<?php
class Category_model extends MY_Model {
	
	function __construct(){
		parent::__construct("categories");
	}
	
	function get_parent() {
		
	}
	
	function get_child() {
		
	}
	
	function get_tree($id) {
		$category_info = $this->row($id);
		$child = null;
		if ($category_info["path"]) {
			$path_keys = explode("/", $category_info["path"]);
			$path_keys = array_unique($path_keys);
			array_pop($path_keys);
			$tree = array();
			foreach($path_keys as $_id) {
				$list_rs = $this->get_list($_id);
				$list = array();
				$_addr = array();
				foreach($list_rs->result_array() as $row) {
					$list[] = array(
						"attr" => array(
							"id" => "node_".$row["id"],
							"rel" => "default"
						),
						"data" => $row["name"],
						"state" => ($row["child_cnt"] > 0) ? "closed" : ""
					);
					$_addr[] = $row["id"];
				}
				if (!$tree) {
					$tree = $list;
				} else {
					$idx = array_search($_id, $addr);
					if (!$child) {
						$tree[$idx]["state"] = "open";
						$tree[$idx]["children"] = $list;
						$child =& $tree[$idx]["children"];
 					} else {
						$child[$idx]["state"] = "open";
 						$child[$idx]["children"] = $list;
						$child =& $child[$idx]["children"];
 					}
				}
				$addr = $_addr;
			}
		}
		return $tree;
	}
	
	function get_node($id) {
		$category_info = $this->row($id);
		$path = array();
		if ($category_info["path"]) {
			$path_keys = explode("/", $category_info["path"]);
			$path_keys[] = $category_info["id"];
			$this->db->select("id, name");
			$this->db->from($this->table);
			$this->db->where_in("id", $path_keys);
			$query = $this->db->get();
			foreach($query->result_array() as $row) {
				$path[$row["id"]] = $row["name"];
			}
		}
		return array(
				"path" => $path,
				"info" => $category_info
				);
	}
	
	function get_list($id, $limit = null, $offset = 0, $sorts = array("sort" => "asc")) {
		$sql = "SELECT node.*".
			", (SELECT COUNT(parent_id)".
				" FROM categories".
				" WHERE parent_id = node.id) AS child_cnt".
			" FROM categories AS node WHERE id IN".
			" (SELECT id FROM `categories` WHERE parent_id = ? AND status = ?)".
			" ORDER BY sort ASC";
		return $this->db->query($sql, array($id, 1));
	}
	
	/**
	 * 追加時のソート番号（削除すると歯抜けになるが仕方がない）
	 * @param unknown_type $id
	 * @return Ambigous <number, boolean, unknown, unknown>
	 */
	function _insert_sort_no($id) {
		if ($sort = $this->get_one(array("parent_id" => $id), "sort", array("sort" => "desc"))) {
			$sort++;
		} else {
			$sort = 1;
		}
		return $sort;
	}
	
	function insert($data) {
		$data["sort"] = $this->_insert_sort_no($data["parent_id"]);
		$data["status"] = 1;
		$insert_id = parent::insert($data);
		$path = "";
		if ($data["path"]) {
			$path = $data["path"].$insert_id."/";
		} else {
			$path = "/".$insert_id."/";
		}
		$this->update(array("path" => $path), $insert_id);
		return $insert_id;
	}
	
	function enable($id) {
		$data["status"] = 1;
		$this->updates($data, $id);
	}
	
	function disable($id) {
		$path = $this->one($id, "path");
		$data["status"] = 0;
		$data["updated_time"] = MY_EXEC_TIME;
		$this->db->where("path like '". mysql_escape_string($path). "%'");
		$this->db->update($this->table, $data);
	}
	
	function move() {
		
	}
	
	function sort($parent_id, $list) {
		$i = 1;
		foreach($list as $id) {
			$data["sort"] = $i;
			$where = array(
					"parent_id" => $parent_id,
					"id" => $id);
			$this->updates($data, $where);
			$i++;
		}
	}
}