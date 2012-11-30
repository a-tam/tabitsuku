		<div class="tour_point pg_memo_temp"<?php if ($route):?> style="display:none;"<?php endif;?>>
			<p class="time"><span class="pg_timecode">08:00</span><span class="line">&nbsp;</span></p>
			<div class="memo_item">
				<dl class="tool">
					<dt><img src="<?php echo base_url("assets");?>/img/user/tour/memo.gif" alt="メモ" /></dt>
					<dd>メモが必要な場合は追加してください。</dd>
				</dl>
				<div class="edit">
					<dl>
						<dt><img src="<?php echo base_url("assets");?>/img/user/tour/memo.gif" alt="メモ" /></dt>
						<dd><textarea name="memo" class="pg_memo"></textarea></dd>
					</dl>
					<div class="ctlbtn">
						<p class="add"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
						<p class="remove"><a href="#remove"><img src="<?php echo base_url("assets");?>/img/user/tour/remove.gif" alt="ツアーから外す" /></a></p>
							<ul class="ctl">
								<li><a href=""><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_up.gif" alt="上へ"></a></li>
								<li><a href=""><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_dn.gif" alt="下へ"></a></li>
							</ul>
						</div>
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
					<option value="<?php echo $stay_time;?>"><?php echo $disp_stay_time;?></option>
<?php endfor;?>
				</select>
			</p>
		</div>
		<!-- //tour_point -->
