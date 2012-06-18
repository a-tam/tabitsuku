<?php echo validation_errors(); ?>
<style type="text/css">
<!--
#signup {
    width: 50%;
    float: left;
}
#login {
    width: 50%;
    float: left;
}
-->
</style>
<form action="<?php echo base_url("user/top/signup")?>" method="post">
<fieldset id="signup">
<legend>サインアップ</legend>
<div>
<span>ID(Email)</span><br />
<input type="text" name="login_id" size="40" value="<?php echo set_value('login_id'); ?>" /><br />
</div>
<div>
<span>パスワード</span><br />
<input type="password" name="password" value="" /><br />
</div>
<div>
<span>名前</span><br />
<input type="text" name="name" value="<?php echo set_value('name'); ?>" /><br />
</div>
<input type="submit" />
</fieldset>
</form>

<form action="<?php echo base_url("user/top/login")?>" method="post">
<fieldset>
<legend>サインイン</legend>
<label>ID:</label><br />
<input type="text" name="login_id" size="40" value="" /><br />
<label>PW:</label><br />
<input type="password" name="password" value="" /><br />
<br />
<input type="submit" /><br />
<a href="<?php echo $data["fb_login"]; ?>">Facebookでログイン</a>
</fieldset>
</form>
