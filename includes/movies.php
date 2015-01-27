<?php
include "conf/config.php";

if (isset($_SESSION["user_id"]))
{

	$order = 0;
	$abfrage = "";

	if (isset($_GET["order"]))
	{
		$order = $_GET["order"];
	}

	echo "<input type='search' name='search-mini' id='search-mini' placeholder='Filter' data-mini='true'>

				<label for='select-order' class='select'>Sortieren nach:</label>
				<select name='select-order' id='select-order' data-theme='a' data-icon='arrow-d' data-inline='true' data-native-menu='false'>
					<option value='0' ";if($order == 0 ){echo"selected='selected'";} echo">A-Z</option>
					<option value='1' ";if($order == 1 ){echo"selected='selected'";} echo">Z-A</option>
					<option value='2' ";if($order == 2 ){echo"selected='selected'";} echo">Zuletzt hinzugefügt</option>
					<option value='3' ";if($order == 3 ){echo"selected='selected'";} echo">Erscheinungsdatum absteigend</option>
					<option value='4' ";if($order == 4 ){echo"selected='selected'";} echo">Erscheinungsdatum aufsteigend</option>
				</select>

	<ul data-role='listview' data-inset='true' ";
			if ($_SESSION["role"] == 1)
				{
					echo "data-split-icon='delete' ";
				}
			else
				{
					echo "data-split-icon='star' ";
				}
	echo "data-split-icon='star'  data-filter='true' data-input='#search-mini'>";

	mysql_query("set names 'utf8'");

	switch($order)
	{
		case 0:
			$abfrage = "SELECT * FROM movies order by title asc";
			break;
		case 1:
			$abfrage = "SELECT * FROM movies order by title desc";
			break;
		case 2:
			$abfrage = "SELECT * FROM movies order by add_time desc";
			break;	
		case 3:
			$abfrage = "SELECT * FROM movies order by release_date desc";
			break;
		case 4:
			$abfrage = "SELECT * FROM movies order by release_date asc";
			break;	
	}

	$result = mysql_query("SELECT COUNT(*) FROM movies");
	$movies_count = mysql_result($result,0);
	echo "$movies_count Filme";

	$ergebnis = mysql_query($abfrage);
	while($row = mysql_fetch_object($ergebnis))
		{
			echo "
						<li><a href='index.php?include=movieinfo.php&movie_id=$row->id' data-ajax='false'>
							<img src='http://image.tmdb.org/t/p/w500$row->cover' />
							<h2>$row->title</h2>
							<p>Veröffentlicht am: $row->release_date</p>
							<p> Kategorien: 
							";
							$quer = "Select * from categories_main where id IN (Select categorie_id from categories where movie_id = $row->id)";
							$ret = mysql_query($quer);
							while($row2 = mysql_fetch_object($ret))
							{
								echo "$row2->name ";
							}
							echo "</p><p style='display:none;'>Schauspieler: ";
							$quer = "Select * from credits_main where id IN (Select credits_id from credits where movie_id = $row->id)";
							$ret = mysql_query($quer);
							while($row2 = mysql_fetch_object($ret))
							{
								echo "$row2->name ";
							}
							echo "</p><p style='display:none;'> Regisseur: ";
							$quer = "Select * from directors_main where id IN (Select director_id from directors where movie_id = $row->id)";
							$ret = mysql_query($quer);
							while($row2 = mysql_fetch_object($ret))
							{
								echo "$row2->name ";
							}
							echo "</p></a>";
							if ($_SESSION["role"] == 1)
								{
									echo "<a href='includes/deletemovie.php?movie_id=$row->id' data-ajax='false' ></a></li>";
								}
							else
								{
									echo "<a href='includes/addwish.php?movie_id=$row->id' data-ajax='false' ></a></li>";
								}												
		}

	echo "</ul>";


}
else
{
	echo"<script type='text/javascript'> window.location.href='../index.php?message=Sie müssen sich erst einloggen'</script>";
}
?>
	<script>
		$('#select-order').bind( 'change', function(event, ui) {
		var $order_nr = document.getElementById('select-order').value;
		window.location.href='index.php?include=movies.php&order=' + $order_nr;
		});
	</script>
