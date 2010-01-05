<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];       

	include 'db_con.php';

$sql = mysql_query("select count(*) from users
where userName = '$username' and userPass = md5('$password')") or die(mysql_error());        

$results = mysql_result($sql, "0");   

if ($results == 0){
header( 'Location:loginfailed.php');
}
else
{
	$_SESSION['valid_user'] = $username;
	header('Location: http://localhost/labinv/index.php');
}
}
?>
