<?php
if(isset($_SESSION["user_id"]))
{
	include "conf/config.php";
	$user_id = $_SESSION["user_id"];

	echo "<ul data-role='listview' data-inset='true' data-split-icon='delete'  data-filter='true' data-input='#search-mini'>";
	mysql_query("set names 'utf8'");
	$abfrage = "SELECT * FROM movies where id IN (SELECT movie_id from wishlist where user_id = $user_id)";
	$ergebnis = mysql_query($abfrage);

	$menge = mysql_num_rows($ergebnis);

	if ($menge == 0)
	{
		echo "Sie haben keine Filme in ihrer Wunschliste";
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
							echo "</p></a>
							<a href='includes/deletewish.php?movie_id=$row->id' data-ajax='false' ></a>
							</li>";
							
					
		}

	echo "</ul>";
}
else
{
	echo"<script type='text/javascript'> window.location.href='../index.php?message=Sie müssen sich erst anmelden'</script>";
}
?>