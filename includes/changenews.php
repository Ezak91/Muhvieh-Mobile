<?php
session_start();
include "../conf/config.php";
?>

<?php
if(isset($_SESSION["user_id"]))
{
	$newsletter = $_POST["flip-mini"];
	$id = $_SESSION["user_id"];

	if ($newsletter == "on")
	{
		$newsletter = 1;	
	}
	else
	{
		$newsletter = 0;
		
	}

	$_SESSION["newsletter"] = $newsletter;
	$abfrage = "UPDATE users SET newsletter=$newsletter where id=$id";
	$ergebnis = mysql_query($abfrage) OR die (mysql_error());

	if ($newsletter == 0)
	{
		echo "<script type='text/javascript'> window.location.href='../index.php?message=Newsletter wurde abbestellt'</script>";
	}
	else
	{
		echo "<script type='text/javascript'> window.location.href='../index.php?message=Newsletter wurde bestellt'</script>";
	}
}
else
{
	echo"<script type='text/javascript'> window.location.href='../index.php?message=Sie müssen sich erst anmelden'</script>";
}

?>