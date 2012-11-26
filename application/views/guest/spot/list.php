				<?php foreach($data["spots"]["list"] as $spot) :?>
			
				<div class="list_item">
					<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="ツアー" /></p>
					
					<p class="photo"><a href="">
						<?php if ($spot["image"]):?>
						<img src="<?php echo base_url("uploads/tour/thumb/".$spot["image"]["file_name"]);?>" width="137" height="104" alt="" /></div>
						<?php else:?>
						<img src="<?php echo base_url("assets"); ?>/img/common/noimage.jpg" width="137" height="104" alt="<?php echo $spot["name"];?>" />
						<?php endif;?>
					</a></p>
					
					<div class="info_area">
						<dl class="maininfo">
							<dt><?php echo $spot["name"];?></dt>
							<dd><?php echo $spot["description"];?></dd>
						</dl>
						<!-- //maininfo -->
						
						<div class="subinfo">
							<dl class="name">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/name.gif" alt="作成者" /></dt>
								<dd><?php echo $spot["owner"];?></dd>
							</dl>
							<dl class="departure">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/location.gif" alt="場所" /></dt>
								<dd><?php echo $spot["prefecture"];?></dd>
							</dl>
							<dl class="time">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/time.gif" alt="時間" /></dt>
								<dd><?php echo $spot["stay_time"];?>分</dd>
							</dl>
						</div>
						<!-- //subinfo -->
					</div>
					<!-- //info_area -->
		
					<div class="sub_box">
						<div class="pg_like_count fb-like" data-href="<?php echo base_url("spot/show/".$spot["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
						<dl class="category">
							<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
							<dd>
								<ul>
						<?php
						$categories = explode(",", $spot["category"]);
						foreach($categories as $tree):
							preg_match_all("/\d+/", $tree, $category);
							$tree = array();
							foreach($category[0] as $category_id) {
								$tree[] = $data["spots"]["relation"]["categories"][$category_id];
							}
						?>
									<li><a href=""><?php echo implode(" > ", $tree);?></a></li>
						<?php endforeach;?>
								</ul>
							</dd>
						</dl>
						<p class="linkbtn"><a href="<?php echo base_url("spot/show/".$spot["id"]);?>" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット内容を見る"></a></p>
					</div>
					<!-- //sub_box -->
		
				</div>
				<!-- //list_item -->
				<?php endforeach;?>