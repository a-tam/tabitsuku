<?php
class Spot extends MY_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		if ($this->admin_auth() === FALSE) {
			$this->render_view("admin/login");
		} else {
			$this->top();
		}
	}
	
	function top() {
		$this->render_view("admin/spot/index");
	}
	
	function ifafasdndex() {
		
		header("Content-type: text/html; charset=utf8;");
		$this->load->library("xml");
		$this->load->model("Category_model");
		$this->load->model("Spot_model");
		$this->load->model("Tag_model");
		$prefectures = array(
//				"hokkaido"	=>	"北海道",
// 				"ishikawa"	=>	"石川",
// 				"okayama"	=>	"岡山",
// 				"aomori"	=>	"青森",
// 				"fukui"		=>	"福井",
// 				"hiroshima" =>	"広島",
// 				"iwate"		=>	"岩手",
// 				"yamanashi"	=>	"山梨",
// 				"yamaguchi"	=>	"山口",
// 				"miyagi"	=>	"宮城",
// 				"nagano"	=>	"長野",
// 				"tokushima"	=>	"徳島",
// 				"akita"		=>	"秋田",
// 				"gifu"		=>	"岐阜",
// 				"kagawa"	=>	"香川",
// 				"yamagata"	=>	"山形",
// 				"shizuoka"	=>	"静岡",
// 				"ehime"		=>	"愛媛",
// 				"fukushima"	=>	"福島",
// 				"aichi"		=>	"愛知",
// 				"kochi"		=>	"高知",
// 				"ibaraki"	=>	"茨城",
// 				"mie"		=>	"三重",
// 				"fukuoka"	=>	"福岡",
// 				"tochigi"	=>	"栃木",
// 				"shiga"		=>	"滋賀",
// 				"saga"		=>	"佐賀",
// 				"gunma"		=>	"群馬",
// 				"kyoto"		=>	"京都",
// 				"nagasaki"	=>	"長崎",
// 				"saitama"	=>	"埼玉",
// 				"osaka"		=>	"大阪",
// 				"kumamoto"	=>	"熊本",
// 				"chiba"		=>	"千葉",
// 				"hyogo"		=>	"兵庫",
// 				"oita"		=>	"大分",
// 				"tokyo"		=>	"東京",
// 				"nara"		=>	"奈良",
// 				"miyazaki"	=>	"宮崎",
// 				"kanagawa"	=>	"神奈川",
// 				"wakayama"	=>	"和歌山",
// 				"kagoshima"	=>	"鹿児島",
// 				"niigata"	=>	"新潟",
// 				"tottori"	=>	"鳥取",
//				"okinawa"	=>	"沖縄",
// 				"toyama"	=>	"富山",
//				"shimane"	=>	"島根"
				);
		$base_url = 'http://api.tabelog.com/Ver2.1/RestaurantSearch/';
		$params["Key"] = "20666000a86337884fb30c001fa3d57f67a9af49";
		$params["ResultDatum"] = "world";
		$params["ResultSet"] = "large";
		foreach($prefectures as $key => $name) {
			$params["Prefecture"] = $key;
			for ($i = 1; $i <= 20; $i++) {
				$params["PageNum"] = $i;
				$query = array();
				foreach($params as $key => $val) {
					$query[] = $key."=".urldecode($val);
				}
				$url = $base_url."?".implode("&", $query);
				$hash_url = FCPATH.'uploads/tabelog/'.md5($url).".xml";
				if (file_exists($hash_url)) {
					print "=====================================\n".$url."\n";
					print "=====================================\n > ".$hash_url."\n";
					print "-------------------------------------\n";
					$contents = file_get_contents($hash_url);
				} else {
					sleep(rand(3, 13));
					print "=====================================\n".$url."\n";
					$contents = file_get_contents($url);
					file_put_contents($hash_url, $contents);
				}
				if ($contents) {
					$this->xml->set_document($contents);
					$data = $this->xml->parse();
					foreach($data["RestaurantInfo"][0]["Item"] as $_item) {
						if ($_item) {
							$item = array();
							foreach($_item as $key => $val) {
								$item[$key] = $val[0];
							}
							$_tags = explode("、", $item["Situation"]);
							$tags = $this->Tag_model->tag_keys($_tags);
							$data = array(
									"name"			=> $item["RestaurantName"],
									"description"	=> $item["TabelogUrl"],
									"stay_time"		=> 60,
									"lat"			=> $item["Latitude"],
									"lng"			=> $item["Longitude"],
									"category"		=> $this->getCategory($item["Category"]),
									"tags"			=> implode(",", $tags),
									"keyword"		=> $item["Rcd"],
									"addition"		=> $item
							);
							if ($id = $this->Spot_model->get_one(array("keyword" => $item["Rcd"]), "id")) {
								$this->Spot_model->update($data, $id);
								print "update:".$id.":".$item["RestaurantName"]."\n";
							} else {
								$id = $this->Spot_model->insert($data, 0);
								print "insert:".$id.":".$item["RestaurantName"]."\n";
							}
						}
					}
				}
				//*/
			}
		}
	}
	
	private function getCategory($name) {
		static $result = null;
		$names = explode("、", $name);
		$keys = array();
		foreach($names as $name) {
			$hash = md5($name);
			if ($result[$hash]) {
				$result[$hash];
			} else {
				if ($path = $this->Category_model->get_one(array("name" => $name), "path")) {
					$result[$hash] = $path;
				} else {
					$data = array(
							"parent_id" => 4,
							"path" => "/4/",
							"name" => $name,
					);
					$id = $this->Category_model->insert($data);
					$result[$hash] = $this->Category_model->one($id, "path");
				}
			}
			$keys[] = $result[$hash];
		}
		return $keys;
	}
}