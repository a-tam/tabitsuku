		<div class="tour_point pg_memo_temp"<?php if (!$route):?> style="display:none;"<?php endif;?>>
			<p class="time"><span class="pg_timecode">08:00</span><span class="line">&nbsp;</span></p>
			<div class="memo_item">
				<div class="select">
					<dl class="tool">
						<dt><img src="<?php echo base_url("assets");?>/img/user/tour/memo.gif" alt="メモ" /></dt>
						<dd>移動時間やメモを追加</dd>
					</dl>
					<div class="ctlbtn">
						<p class="add"><a href="#add" class="iconAdd"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
					</div>
				</div>
				<div class="edit">
					<dl>
						<dt><img src="<?php echo base_url("assets");?>/img/user/tour/memo.gif" alt="メモ" /></dt>
						<dd><textarea name="memo" class="pg_memo"><?php echo $route["info"];?></textarea></dd>
					</dl>
					<div class="ctlbtn">
						<p class="remove"><a href="#remove" class="iconClose"><img src="<?php echo base_url("assets");?>/img/user/tour/remove.gif" alt="ツアーから外す" /></a></p>
							<ul class="ctl">
								<li><a href="" class="iconUp"><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_up.gif" alt="上へ"></a></li>
								<li><a href="" class="iconDown"><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_dn.gif" alt="下へ"></a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /list -->
				<p class="staytime">滞在時間
				<select class="pg_stay_time">
<?php
		$step = 15;
		for ($i = 0; $i <= 24; $i++):
			$stay_time = $i * $step;
			$disp_stay_time = date("H:i", mktime(0, $stay_time, 0, 0, 0, 0));
?>
						<option value="<?php echo $stay_time;?>"<?php if ($route["stay_time"] == $stay_time): ?> selected="selected"<?php endif;?>><?php echo $disp_stay_time;?></option>
<?php endfor;?>
!				</select>
			</p>
		</div>
		<!-- //tour_point -->
