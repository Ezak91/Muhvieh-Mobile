<?php
session_start();
include "../conf/config.php";
?>

<?php
if(isset($_SESSION["user_id"]) && $_SESSION["role"] == 1)
{
	$user_id = $_GET["user_id"];

	mysql_query("set names 'utf8'");
	
	$select = "Select * from users where id = $user_id";
	$result = mysql_query(($select));
	while($row = mysql_fetch_object($result))
	{
		$user_name = $row->email;
	}

	$delete = "Delete from users where id = $user_id";
	mysql_query($delete) OR die (mysql_error());;;
	
	$delete = "Delete from wishlist where user_id = $user_id";
	mysql_query($delete) OR die (mysql_error());;;

	echo"<script type='text/javascript'> window.location.href='../index.php?message=$user_name wurde gelöscht'</script>";
}
else
{
	echo"<script type='text/javascript'> window.location.href='../index.php?message=Sie müssen sich erst anmelden'</script>";
}
?>