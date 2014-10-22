<?php
//MYSQL Connection
$config = array (
	"mysql_server" => "localhost",
	"mysql_user" => "root",
	"mysql_password" => "password",
	"mysql_database" => "muhvieh_db"
);

if (! @mysql_connect($config["mysql_server"], $config["mysql_user"], $config["mysql_password"]))
{
	
	die ("Mysql Error (Connection failed");
}

if (! @mysql_select_db($config["mysql_database"]))
{
	die ("Mysql Error (DB Selecting)");
}

// Settings
$api_key = "Your TMDB Api-Key";
$admin_mail = "Your Muhvieh Admin Mail";
$homepage = "Your Muhvieh Hompage Url";
$hp_name = "Name of your Muhvieh-Url";


?>