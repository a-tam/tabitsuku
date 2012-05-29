<?php echo validation_errors(); ?>
<form action="<?php echo base_url("user/top/singup")?>" method="post">
<fieldset>
<legend>サインアップ</legend>
<div>
<span>ID(Email)</span><br />
<input type="text" name="login_id" value="<?php echo set_value('login_id'); ?>" size="40" /><br />
</div>
<div>
<span>パスワード</span><br />
<input type="text" name="password" value="" /><br />
</div>
<div>
<span>名前</span><br />
<input type="text" name="name" value="<?php echo set_value('name'); ?>" /><br />
</div>
<input type="submit" />
</fieldset>
</form>

<form action="<?php echo base_url("user/top/singin")?>" method="post">
<fieldset>
<legend>ログイン</legend>
ID: <input type="text" name="user_id" value="" />
PW: <input type="text" name="user_pw" value="" />
<input type="submit" />
<a href="">Facebookでログイン</a>
</fieldset>
</form>
