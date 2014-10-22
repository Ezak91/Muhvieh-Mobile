<?php
session_start();
include "../conf/config.php";
?>

<?php
if(isset($_SESSION["user_id"]))
{
	$movie_id = $_GET["movie_id"];
	$user_id = $_SESSION["user_id"];

	mysql_query("set names 'utf8'");
	$insert = "INSERT INTO wishlist VALUES ($user_id,'$movie_id')";
	mysql_query($insert);

	echo "<script type='text/javascript'> window.location.href='../index.php?include=wishlist.php'</script>";
}
else
{
	echo "<script type='text/javascript'> window.location.href='../index.php?message=Sie müssen sich anmelden'</script>";
}
?>