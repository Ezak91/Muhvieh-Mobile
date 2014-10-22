<?php
session_start();
include "../conf/config.php";
?>

<?php
$pwold = md5($_POST["pwold"]);
$pwnew = md5($_POST["pwnew"]);
$pwrep = md5($_POST["pwrep"]);
$id = $_SESSION["user_id"];

$abfrage = "SELECT password FROM users WHERE id = '$id' LIMIT 1";
$ergebnis = mysql_query($abfrage) OR die (mysql_error());
$row = mysql_fetch_object($ergebnis);
if ($row == null)
{
    echo "<script type='text/javascript'> window.location.href='../index.php?message=User nicht gefunden'</script>";
}
else
{
	if($pwnew == $pwrep)
	{
		if($row->password == $pwold)
			{	
				$abfrage = "UPDATE users SET password='$pwnew' where id=$id";
				$ergebnis = mysql_query($abfrage) OR die (mysql_error());
				echo "<script type='text/javascript'> window.location.href='../index.php?message=Passwort wurde geändert'</script>";
			}
		else
			{
				echo "<script type='text/javascript'> window.location.href='../index.php?message=Falsches Passwort'</script>";
			}
	}
	else
	{
		echo "<script type='text/javascript'> window.location.href='../index.php?message=Passwörter stimmen nicht überein'</script>";
	}
}
?>