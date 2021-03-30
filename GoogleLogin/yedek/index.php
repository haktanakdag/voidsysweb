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
			include_once 'loginG.php';
			if(isset($_GET['code'])){
				$gClient->authenticate($_GET['code']);
				$_SESSION['token'] = $gClient->getAccessToken();
				header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
			}
			if (isset($_SESSION['token'])) {
				$gClient->setAccessToken($_SESSION['token']);
			}
			if ($gClient->getAccessToken()) 
			{
				$gpUserProfile = $google_oauthV2->userinfo->get();
				$_SESSION['oauth_provider'] = 'Google'; 
				$_SESSION['oauth_uid'] = $gpUserProfile['id']; 
				$_SESSION['first_name'] = $gpUserProfile['given_name']; 
				$_SESSION['last_name'] = $gpUserProfile['family_name']; 
				$_SESSION['email'] = $gpUserProfile['email'];
				$_SESSION['gender'] = $gpUserProfile['gender'];
				$_SESSION['logincust']='yes';
			print_r($gpUserProfile);
			} else {
				$authUrl = $gClient->createAuthUrl();
				$output= '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/loging.png" alt="Sign in with Google+" width=222/></a>';
			}
			echo $output;
		?>
	</body>
</html>