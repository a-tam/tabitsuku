			<?php if ($route):?>
				<div class="tour_point" data-spot-id="<?php echo $route["id"]?>" data-spot-lat="<?php echo $route["lat"];?>" data-spot-lng="<?php echo $route["lng"];?>">
			<?php else :?>
				<div class="tour_point pg_spot_temp" style="display:none;">
			<?php endif;?>
				<p class="time"><span class="pg_timecode">08:00</span><span class="line">&nbsp;</span></p>
				<div class="list_item">
					<p class="pic">
					<img class="pg_image" src="<?php
					if ($route["image"]):
						echo base_url("uploads/spot/thumb")."/".$route["image"]["file_name"];
					else:
						echo base_url("assets")."/img/common/noimage_s.jpg";
					endif;?>" width="54" height="54" alt="スポット名スポット名" /></p>
					<dl>
						<dt class="pg_name"><?php echo $route["name"]?></dt>
						<dd class="standard_time">参考滞在時間 <span class="pg_standard_time"><?php echo $route["defalut_time"]?></span>分</dd>
						<dd class="detaillink"><a href="#spot" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
					</dl>
					<div class="ctlbtn">
						<p class="add"><a href="#add" class="iconAdd"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
						<p class="remove"><a href="#remove" class="iconClose"><img src="<?php echo base_url("assets");?>/img/user/tour/remove.gif" alt="ツアーから外す" /></a></p>
						<ul class="ctl">
							<li><a href="" class="iconUp"><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_up.gif" alt="上へ"></a></li>
							<li><a href="" class="iconDown"><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_dn.gif" alt="下へ"></a></li>
						</ul>
					</div>
					
				</div>
				<!-- /list -->
				<p class="staytime">滞在時間
					<select class="pg_stay_time">
<?php
		$step = 15;
		for ($i = 1; $i <= 24; $i++):
			$stay_time = $i * $step;
			$disp_stay_time = date("H:i", mktime(0, $stay_time, 0, 0, 0, 0));
?>
						<option value="<?php echo $stay_time;?>"<?php if ($route["stay_time"] == $stay_time): ?> selected="selected"<?php endif;?>><?php echo $disp_stay_time;?></option>
<?php endfor;?>
					</select>
				</p>
			</div>
			<!-- //tour_point -->
