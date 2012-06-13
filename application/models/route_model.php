<?php
class Route_model extends MY_Model {
	
	function __construct(){
		parent::__construct("routes");
	}

	public function update_all($tour_id, $route) {
		$this->deletes(array("tour_id" => $tour_id));
		$ids = array();
		$sort = 1;
		foreach ($route as $spot) {
			$data = array(
					"tour_id"		=> $tour_id,
					"spot_id"		=> $spot["id"],
					"stay_time"		=> $spot["stay_time"],
					"sort"			=> $sort
			);
			$ids[] = $this->insert($data);
			$sort++;
		}
		return $ids;
	}
	
	function get_route($id) {
		$query = $this->select(
				array("spot_id"),
				array("tour_id" => $id),
				null, 0,
				array("sort" => "asc"));
		$result = array();
		foreach($query->result_array() as $row) {
			$result[] = $row;
		}
		return $result;
	}
}