<?php
session_start();
include "../conf/config.php";
?>

<?php
if ($_SESSION["role"] == 1)
{
	$email = $_POST["email"];

	$pw = "";
	$pool = "qwertzupasdfghkyxcvbnm23456789";
	srand ((double)microtime()*1000000);
	for($n = 0; $n <= 5; $n++)
	{
		$pw .= substr($pool,(rand()%(strlen ($pool))), 1);
	}

	$pw_md5 = md5($pw);

	$abfrage = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
	$ergebnis = mysql_query($abfrage) OR die (mysql_error());
	$row = mysql_fetch_object($ergebnis);
	if ($row == null)
	{
		$abfrage = "INSERT INTO users (email,password,newsletter,role,last_login) VALUES ('$email','$pw_md5',1,2,CURRENT_TIMESTAMP)";
		$ergebnis = mysql_query($abfrage) OR die (mysql_error());

		$empfaenger  = $email;
		$betreff = 'Einladung zu Muhvieh';
		$nachricht = "
		<html>
		<head>
		  <title>Muhvieh Einladung</title>
		</head>
		<body>
		  <p>Sie wurden für Muhvieh registriert:</p>
		  <p>Username: $email </p>
		  <p>Passwort: $pw
		  <p><a href='$homepage'>$hp_name</a></p>
		</body>
		</html>
		";
	
		$header = 'From: Muhvieh <$admin_mail>\n';
		$header  .= 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

		 mail($empfaenger, $betreff, $nachricht, $header);
		 echo "<script type='text/javascript'> window.location.href='../index.php?message=Der User $email wurde angelegt. PW: $pw '</script>";

		
	}
	else
	{
		echo "<script type='text/javascript'> window.location.href='../index.php?message=Email existiert bereits'</script>";
	}
}
else
{
	echo"<script type='text/javascript'> window.location.href='../index.php?message=Diese Seite ist nur für den Administrator'</script>";
}
?>
