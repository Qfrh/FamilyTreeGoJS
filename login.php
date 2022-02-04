<?php 
include('server.php');
include('header.php');
?>
	 
<style>
.login-form {
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>

<div class="login-form">
	<form method="post" action="login.php"> 
		<?php include('errors.php'); ?>
		<h2 class="text-center">Log in</h2>       
		<div class="form-group mb-2">
			<input type="text" name="username" class="form-control" placeholder="Username" required="required">
		</div>
		<div class="form-group mb-2">
			<input type="password" name="password" class="form-control" placeholder="Password" required="required">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block" name="login_user">Log in</button>
		</div>
		<div class="clearfix">
			<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
			<a href="#" class="float-right">Forgot Password?</a>
		</div>        
	</form>
</div>

<?php
include('./layout/footer.php');
?>
</body>
</html>