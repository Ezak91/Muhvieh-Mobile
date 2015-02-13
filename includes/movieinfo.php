<?php
include "conf/config.php";

if(isset($_SESSION["user_id"]))
{

	$id = $_GET["movie_id"];

	mysql_query("set names 'utf8'");
	$abfrage = "SELECT * FROM movies where id=$id";
	$ergebnis = mysql_query($abfrage);
	$row = mysql_fetch_object($ergebnis);
	$cover = $row->cover;

	echo"

		<div data-role='header' data-theme='a'>
		<h1>$row->title</h1>
		</div>
		<div>	
			<ul data-role='listview' data-inset='true'>
			<span style='float: right;'>
				<a href='#popupcover' data-rel='popup' data-position-to='window' data-transition='fade'>
					<img src = 'http://image.tmdb.org/t/p/w500$row->cover' style='width:40%'>
				</a>
			</span><br>	
			<li>Titel: <b>$row->title</b></li>
			<li>Original Titel: <b>$row->original_title</b></li>
			<li>Veröffentlicht am: <b>$row->release_date</b></li>
			<li>Dauer: <b>$row->duration min.</b></li>
			<li>Bewertung: <b>$row->vote_average / 10 ($row->vote_count Stimmen)</b></li>
			<li>Kategorien: <b>";
			$quer = "Select * from categories_main where id IN (Select categorie_id from categories where movie_id = $row->id)";
			$ret = mysql_query($quer);
			while($row2 = mysql_fetch_object($ret))
			{
				echo "$row2->name ";
			}
		
			echo "</b></li>
			<li>Regisseur: <b>";
			$quer = "Select * from directors_main where id IN (Select director_id from directors where movie_id = $row->id)";
			$ret = mysql_query($quer);
			while($row2 = mysql_fetch_object($ret))
			{
				echo "$row2->name ";
			}
			echo "</b></li><li>Schauspieler: <b>";
			$quer = "Select * from credits_main where id IN (Select credits_id from credits where movie_id = $row->id)";
			$ret = mysql_query($quer);
			while($row2 = mysql_fetch_object($ret))
			{
				echo "$row2->name ";
			}
			echo "</b></li>
			<li>Inhalt:</b><br><b>$row->overview</b></li>
			<li><a href='$row->homepage'>Homepage: <b>$row->homepage</b></a></li>
			<li><a href='http://www.imdb.com/title/$row->imdb_id'> Film auf <b>IMDB<b></a></li>";
			if (!empty($row->trailer_id))
			{
				echo"<li><iframe width=\"425\" height=\"350\" src=\"//www.youtube.com/embed/$row->trailer_id?rel=0\" frameborder=\"0\" allowfullscreen></iframe></li>";
			}
			echo "</ul></div>";
			echo "<div data-role='popup' id='popupcover' data-overlay-theme='a' data-theme='d' data-corners='false'>
                  <a href='#' data-rel='back' data-role='button' data-theme='b' data-icon='delete' data-iconpos='notext' class='ui-btn-right'>Close</a><img src='http://image.tmdb.org/t/p/w500$cover' style='max-height:512px;'' alt='$cover' />
                  </div>";

}
else
{
	echo "<script type='text/javascript'> window.location.href='../index.php?message=Sie müssen sich erst anmelden'</script>";
}
?>
