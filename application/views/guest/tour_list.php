		<ul id="pg_tours">
			<li class="pg_tour" id="pg_tour_temp" style="display: none;">
				<div>
					<div class="pg_tour_left">
						<div class="pg_img"><img src="" alt="" /></div>
						<div>
							<label>タイトル</label>
							<p class="pg_title">インドカレーが食べたい！</p>
						</div>
						<div class="pg_like_count" data-href="<?php echo base_url("user/spot/show/1");?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
						<div>
							<label>カテゴリ</label>
							<ul class="pg_category">
								<li>カテゴリ1</li>
								<li>カテゴリ2</li>
							</ul>
						</div>
						<div>
							<label>タグ</label>
							<ul class="pg_tags">
								<li>タグ1</li>
								<li>タグ2</li>
							</ul>
						</div>
						<div>
							<label>説明</label>
							<p class="pg_description">一口にインド料理と言っても本当に様々です。おおまかに言うと、南インドと北インドではちょっと食文化が違います。 日本で言ったら、九州豚骨ラーメンと関東醤油ラーメンのような感じでしょうか。インドでは、カレーの種類もたくさんあり、毎日3食カレーを食べてい ...</p>
						</div>
					</div>
					<div class="pg_tour_right">
						<ul class="pg_routes">
							<li>スポット1</li>
							<li>スポット2</li>
							<li>スポット3</li>
						</ul>
					</div>
					<p class="pg_detail" style="clear: both;"><a href="">詳細</a></p>
<?php if($this->user_info):?>
					<p class="pg_copy"><a href="<?php echo base_url("user/tour/copy/");?>">コピーしてツアーを作る</a></p>
<?php endif;?>
				</div>
			</li>
		</ul><!-- pg_tours -->
