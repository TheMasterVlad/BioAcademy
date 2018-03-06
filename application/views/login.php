<h1>Log in</h1>	
	<?php echo validation_errors(); ?>
	<?php echo form_open('LoginController/CheckLogin'); ?>
		Username:<br>
		<input type="text" name="username"><br>	
		Password:<br>
		<input type="password" name="pass"><br>
		<input type="submit" value="Login" name="sub">
	</form>