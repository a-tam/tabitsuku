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
	
}