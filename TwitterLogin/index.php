<?php

session_start();
require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'J6xtWiUqla2322ikahC2lVtLV'); 	// add your app consumer key between single quotes
define('CONSUMER_SECRET', 'YDKTsRqpYBza6E74SyP6YQeMK5rm5VvKNB1p56p8kWEjseoxti'); // add your app consumer 																			secret key between single quotes
define('OAUTH_CALLBACK', 'http://voidev.com/TwitterLogin/callback.php'); // your app callback URL i.e. page 																			you want to load after successful 																			  getting the data
//define('oauth_token', '842987337353052160-LL8z2AHxYRP7lHo8iDaq8cLNzeSu8OP');
//define('oauth_token_secret', '6eZZno5qC6d8E5Gtc9jakmhEgvP07F3MfxOBwJ5ysLm8x');
if (!isset($_SESSION['access_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	//echo $url;
        header('Location: '.$url);
	//echo "<a href='$url'><img src='twitter-login-blue.png' style='margin-left:4%; margin-top: 4%'></a>";
} else {
    $access_token = $_SESSION['access_token'];
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
    $user = $connection->get("account/verify_credentials", ['include_email' => 'true']);
        
//    $user1 = $connection->get("https://api.twitter.com/1.1/account/verify_credentials.json", ['include_email' => true]);
   /* echo "<img src='$user->profile_image_url'>";
    echo "<br>";		//profile image twitter link
    echo $user->name;echo "<br>";									//Full Name
    echo $user->location;echo "<br>";								//location
    echo $user->screen_name;echo "<br>";							//username
    echo $user->created_at;echo "<br>";
//    echo $user->profile_image_url;echo "<br>";
    echo $user->email;echo "<br>";//Email, note you need to check permission on Twitter App Dashboard and it will take max 24 hours to use email 
    * */
    $_SESSION['oauth_provider'] = 'Twitter'; 
    $_SESSION['oauth_uid'] = $user->screen_name; 
    $_SESSION['first_name'] = $user->name; 
    $_SESSION['last_name'] = $user->surname; 
    $_SESSION['email'] = $user->email;
    $_SESSION['gender'] = $user->gender;
    $_SESSION['logincust']='yes';
    /*echo "<pre>";
    print_r($user);
    echo "<pre>";*/
    //header('Location: ../base/index.php');

    
//These are the sets of data you will be getting from Twitter 												Database 

?>
<script src="../js/jquery.loadingModal.js" type="text/javascript"></script>
<script src="../js/jquery.loadingModal.min.js" type="text/javascript"></script>
<script src="../js/loadingModal.js" type="text/javascript"></script>
<?php

echo "<script type='text/javascript'>location.href = '../base/index.php';</script>";
echo '<form method="post"><input class="btn btn-danger" style="margin-top:5px;width:70px;height:35px;" type="submit" value="Logout" name="logoutsr" width="48" height="48"></form>';
}
    if(isset($_POST['logoutsr']))
{
	session_unset();
	echo "<script type='text/javascript'>location.href = 'index.php';</script>";
}
?>
</body>