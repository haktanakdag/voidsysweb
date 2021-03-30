<?php
	session_start();
	if(isset($_SESSION['logincust']))
	{
		header('Location: ../../base/index.php');
	}
	else
	{
		session_unset();
	}
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
	<head>
		<title>Login with Facebook and Google | Login</title>
	</head>
	<body>
		<?php
			echo '<a href="loginFB.php"><img src="images/loginfb.png" alt="Login with Facebook" width=222></a><br>';
		?>
	</body>
</html>