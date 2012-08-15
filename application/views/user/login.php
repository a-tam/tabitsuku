
<?php $this->load->view("contents_header"); ?>
<?php echo validation_errors(); ?>



<div id="containerInner">
			<div id="loginFormArea">
				<h3>ログイン </h3>
				<div class="innerArea">
					<form action="<?php echo base_url("user/top/login")?>" method="post">
							<p class="center" style="padding-top:10px; padding-bottom:25px; border-bottom:3px dashed #ddd;"><a href="<?php echo $data["fb_login"]; ?>" class="btnFacebook"><span>Facebookでログイン</span></a></p>
							<p style="padding-top:5px;">
								<label>ユーザーID</label>
								<input type="text" name="login_id" size="40" value=""  class="inputRounnd" />
							</p>
							<p>
								<label>パスワード</label>
								<input type="password" name="password" value=""  class="inputRounnd" />
							</p>
							<p>
								<input type="submit" />
							</p>
						</form>
					</div>
			</div>
		<div id="newFormArea">
			<h3>新規会員登録 </h3>
			<div class="innerArea">
<form action="<?php echo base_url("user/top/signup")?>" method="post">
				<p>
					<label>ユーザーID(Email)</label>
<input type="text" name="login_id" size="40" value="<?php echo set_value('login_id'); ?>"  class="inputRounnd" />
				</p>
				<p>
					<label>パスワード</label>
<input type="password" name="password" value=""  class="inputRounnd" />
				</p>
				
				<p>
					<label>名前</label>
<input type="text" name="name" value="<?php echo set_value('name'); ?>"  class="inputRounnd" />
				</p>
				
				<p>
					<input type="submit" />
				</p>
			</form>
			</div>
		</div>
		
		</div>