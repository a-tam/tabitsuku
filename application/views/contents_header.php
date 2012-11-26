<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<header>
	<h1><a href="<?php echo base_url("/");?>"><img src="<?php echo base_url("assets"); ?>/img/logo.gif" alt="たびつく　自分だけの旅行プランを作ろう" /></a></h1>
	<dl class="search">
		<dt><img src="<?php echo base_url("assets"); ?>/img/common/header/search.gif" alt="ツアーやスポットを検索しよう" /></dt>
		<dd>
			<form>
				<p class="categoryselect">
					<select class="category" name="category">
						<option>全てのカテゴリ</option>
						<option>見る</option>
						<option>遊ぶ</option>
						<option>食べる</option>
						<option>宿泊・温泉</option>
						<option>乗り物/乗り場</option>
						<option>買う</option>
					</select>
				</p>
				<ul>
					<li><input type="radio" name="type" value="ツアー" id="headersearch_tour"><label for="headersearch_tour">ツアー</label></li>
					<li><input type="radio" name="type" value="スポット" id="headersearch_spot"><label for="headersearch_spot">スポット</label></li>
				</ul>
				<p class="keyword"><input type="text" class="text" name="keyword" value="" /></p>
				<p class="submit mouse_over"><input type="image" src="<?php echo base_url("assets"); ?>/img/common/header/searchbtn.gif" alt="検索" /></p>
			</form>
		</dd>
	</dl>
	<!-- //search -->
	<?php if ($this->user_info): ?>
	<p class="login"><a href="<?php echo base_url("user/top/logout");?>" class="mouse_over"><img src="<?php echo base_url("assets"); ?>/img/common/header/logout.gif" alt="ログアウト" /></a></p>
	<?php else: ?>
	<p class="login"><a href="#login" class="loginbtn mouse_over"><img src="<?php echo base_url("assets"); ?>/img/common/header/login.gif" alt="ログインはこちら" /></a></p>
	<?php endif; ?>
	
</header>
