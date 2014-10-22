<?php
include "conf/config.php";

if(isset($_SESSION["user_id"]))
{
	echo "<ul data-role='listview' data-split-icon='star' data-inset='true' data-filter='true' data-input='#search-mini'>";
	$last_log = $_SESSION["last_login"];
	mysql_query("set names 'utf8'");
	$abfrage = "SELECT * FROM movies where add_time > '$last_log' order by add_time desc";
	$ergebnis = mysql_query($abfrage) OR die (mysql_error());;
	$menge = mysql_num_rows($ergebnis);

	if ($menge == 0)
	{
		echo "Leider keine neuen Filme seit ihrem letzten Login hinzugefügt =(";
	}

	while($row = mysql_fetch_object($ergebnis))
		{
			echo "
						<li><a href='index.php?include=movieinfo.php&movie_id=$row->id' data-ajax='false'>
							<img src='http://image.tmdb.org/t/p/w500$row->cover' />
							<h2>$row->title</h2>
							<p>$row->release_date</p>
							<p>
							";
							$quer = "Select * from categories_main where id IN (Select categorie_id from categories where movie_id = $row->id)";
							$ret = mysql_query($quer);
							while($row2 = mysql_fetch_object($ret))
							{
								echo "$row2->name ";
							}
							echo "</p></a><a href='includes/addwish.php?movie_id=$row->id' data-ajax='false' ></a></li>";
							
					
		}
	echo "</ul>";
	$id = $_SESSION["user_id"];
	$abfrage = "UPDATE users SET last_login=CURRENT_TIMESTAMP where id=$id";
	$ergebnis = mysql_query($abfrage) OR die (mysql_error());
}
else
{
	echo"<script type='text/javascript'> window.location.href='../index.php?message=Sie müssen sich erst anmelden'</script>";
}
?>

