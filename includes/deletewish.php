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
	$delete = "Delete from wishlist where user_id = $user_id AND movie_id = $movie_id";
	mysql_query($delete);

	echo "<script type='text/javascript'> window.location.href='../index.php?include=wishlist.php'</script>";
}
else
{
	echo"<script type='text/javascript'> window.location.href='../index.php?message=Sie müssen sich erst anmelden'</script>";
}
?>