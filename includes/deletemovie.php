<?php
session_start();
include "../conf/config.php";
?>

<?php
if(isset($_SESSION["user_id"]) && $_SESSION["role"] == 1)
{
	$movie_id = $_GET["movie_id"];

	mysql_query("set names 'utf8'");
	
	$select = "Select * from movies where id = $movie_id";
	$result = mysql_query($select);
	
	while($row = mysql_fetch_object($result))
	{
		$movie_name = $row->title;
	}
	
	$delete = "Delete from categories where movie_id = $movie_id";
	mysql_query($delete) OR die (mysql_error());;
	
	$delete = "Delete from credits where movie_id = $movie_id";
	mysql_query($delete) OR die (mysql_error());;
	
	$delete = "Delete from directors where movie_id = $movie_id";
	mysql_query($delete) OR die (mysql_error());;
	
	$delete = "Delete from wishlist where movie_id = $movie_id";
	mysql_query($delete) OR die (mysql_error());;

	$delete = "Delete from movies where id = $movie_id";
	mysql_query($delete);
	
	echo"<script type='text/javascript'> window.location.href='../index.php?message=$movie_name wurde gelöscht'</script>";
}
else
{
	echo"<script type='text/javascript'> window.location.href='../index.php?message=Sie müssen sich erst anmelden'</script>";
}
?>