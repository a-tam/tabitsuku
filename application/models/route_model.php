<?php
class Route_model extends MY_Model {
	
	function __construct(){
		parent::__construct("routes");
	}

	public function update_all($schedule_id, $route) {
		$this->deletes(array("schedule_id" => $schedule_id));
		$ids = array();
		$sort = 1;
		foreach ($route as $point) {
			$data = array(
					"schedule_id"	=> $schedule_id,
					"point_id"		=> $point["id"],
					"stay_time"		=> $point["stay_time"],
					"sort"			=> $sort
			);
			$ids[] = $this->insert($data);
			$sort++;
		}
		return $ids;
	}
	
	function get_route($id) {
		$query = $this->select(
				array("point_id"),
				array("schedule_id" => $id),
				null, 0,
				array("sort" => "asc"));
		$result = array();
		foreach($query->result_array() as $row) {
			$result[] = $row;
		}
		return $result;
	}
}