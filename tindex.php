<?php
ob_start();
session_start();
require_once('connect_to_database.php');
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) 
{
    header('Location: ./logout.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$content = $connection->get('account/verify_credentials');
$_SESSION['username']=$content->screen_name;
// Let's request the access token

if(isset($content->error))
{
    // Something's wrong, go back to square 1
    header('Location: login.php');
} else 
{
    // Let's find the user by its ID
    $query = mysql_query("SELECT * FROM Users WHERE oauth_provider = 'twitter' AND id = '{$content->id}' ");
    $result = mysql_fetch_array($query);
     //oauth_uid --> watch for that variable
    // If not, let's add it to the database
    if(empty($result))
    {
        $query = mysql_query("INSERT INTO Users (oauth_provider, id, username, oauth_token, oauth_secret) VALUES ('twitter', '{$content->id}', '{$content->screen_name}', '{$access_token['oauth_token']}', '{$access_token['oauth_token_secret']}')");
        $mid=mysql_insert_id();
        $query = mysql_query("SELECT * FROM Users WHERE id = '{$mid}'");
        $result = mysql_fetch_array($query);
       header('Location: index.php');
       $_SESSION['oauth_provider'] = $result['oauth_provider'];
    } 
    else 
    {
        // Update the tokens
        $query = mysql_query("UPDATE Users SET oauth_token = '{$access_token['oauth_token']}', oauth_secret = '{$access_token['oauth_token_secret']}' WHERE oauth_provider = 'twitter' AND id = '{$content->id}' AND username='{$content->screen_name}'");
         $_SESSION['oauth_provider'] = 'twitter';
         header('Location: index.php');
    }

 /*

    $_SESSION['id'] = $result['id'];
    $_SESSION['username'] = $result['username'];
    $_SESSION['oauth_uid'] = $result['oauth_uid'];
    $_SESSION['oauth_provider'] = $result['oauth_provider'];
    $_SESSION['oauth_token'] = $result['oauth_token'];
    $_SESSION['oauth_secret'] = $result['oauth_secret'];
 
  */   

}
/*
// for testing purposes--> ensure all info are correct
echo $content->oauth_uid." is the ouath_id</br>";
echo $content->id." is the id </br>";
echo $content->oauth_secret." is the ouath secret </br>";
echo $content->screen_name." is the screename </br>";
echo "============";
echo $result['id']." is the id </br>";
echo  $result['username']." is the username</br>";
echo  $result['oauth_uid']." is the ouath_id</br>";
echo $result['oauth_provider']." is the ouath_provider </br>";
echo  $result['oauth_token']." is the ouath_token</br>";
echo  $result['oauth_secret']." is the ouath_secret</br>";
echo "============";
echo $_SESSION['username'];
 */  

 ob_flush();
?>