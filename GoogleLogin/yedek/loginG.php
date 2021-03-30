<?php
	include_once 'src/Google_Client.php';
	include_once 'src/contrib/Google_Oauth2Service.php';
	
	// Edit Following 3 Lines
	$clientId = '193469065170-lcqv1ge5aekvqvbnek4asjnvico8rbbm.apps.googleusercontent.com'; //Application client ID
	$clientSecret = 'RUp9-Sf1HdoQ6Ov_blQmU6F-'; //Application client secret
	$redirectURL = 'https://voidev.com/GoogleLogin/index.php'; //Application Callback URL
	
	$gClient = new Google_Client();
	$gClient->setApplicationName('Voidev Login');
	$gClient->setClientId($clientId);
	$gClient->setClientSecret($clientSecret);
	$gClient->setRedirectUri($redirectURL);
	$google_oauthV2 = new Google_Oauth2Service($gClient);
        
?>