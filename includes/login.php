<?php
session_start();
include "../conf/config.php";
?>

<?php
$email = $_POST["email"];
$passwort = md5($_POST["password"]);

$abfrage = "SELECT id, email, password, newsletter, role, last_login FROM users WHERE email = '$email' LIMIT 1";
$ergebnis = mysql_query($abfrage) OR die (mysql_error());
$row = mysql_fetch_object($ergebnis);
if ($row == null)
{
	echo "<script type='text/javascript'> window.location.href='../index.php?message=Username existiert nicht'</script>";
}
else
{
if($row->password == $passwort)
    {
		$_SESSION["user_id"] = $row->id;
		$_SESSION["role"] = $row->role;
		$_SESSION["last_login"] = $row->last_login;
		$_SESSION["newsletter"] = $row->newsletter;
	
    echo "<script type='text/javascript'> window.location.href='../index.php?include=movies.php'</script>";
    }
else
    {
    echo "<script type='text/javascript'> window.location.href='../index.php?message=Falsches Passwort'</script>";
    }
}

?>