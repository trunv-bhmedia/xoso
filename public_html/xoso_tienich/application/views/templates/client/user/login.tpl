<form method="post" action="">
	<label>Username:</label>
	<input name="username"/>
	<br/>
	<label>Password:</label>
	<input name="password" type="password"/>
	<br />
	<input name="url" type="hidden" value="<?php echo base_url();?>"/>
	<input name="url_login" type="hidden" value="<?php echo base_url();?>login"/>
	<a href="http://bhpay.dev/register">Register</a>
	<input type="submit" />
</form>