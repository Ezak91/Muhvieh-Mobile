<?php
session_start();
include "../conf/config.php";
?>

<?php
if ($_SESSION["role"] == 1)
{
	$movie_id = $_GET["id"];

	// header('Cache-Control: no-cache, must-revalidate');
	// header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	// header('Content-type: application/json');

	$arr = json_decode(file_get_contents("http://api.themoviedb.org/3/movie/$movie_id?&api_key=$apikey&language=de&append_to_response=trailers"),true);

	$id = $arr['id'];
	$title = mysql_real_escape_string($arr['title']);
	$original_title = mysql_real_escape_string($arr['original_title']);
	$overview = mysql_real_escape_string($arr['overview']);
	$cover = $arr['poster_path'];
	$adult = $arr['adult'];
	$release_date = $arr['release_date'];
	$duration = $arr['runtime'];
	$homepage = $arr['homepage'];
	$imdb_id = $arr['imdb_id'];
	$vote_average = $arr['vote_average'];
	$vote_count = $arr['vote_count'];
	$trailer_id = $arr['trailers']['youtube'][0]['source'];

	$credits = json_decode(file_get_contents("http://api.themoviedb.org/3/movie/$movie_id/credits?&api_key=$apikey&language=de"),true);	
	
	$crew = $credits['crew'];
	$cast = $credits ['cast'];
	
	foreach ($crew as &$director)
	{
		$director_job = $director["job"];
		$director_name = $director["name"];
		$director_id = $director["id"];
		
		if($director_job == "Director")
		{
			mysql_query("set names 'utf8'");
			$insert = "INSERT INTO directors_main VALUES ($director_id,'$director_name')";
			mysql_query($insert);
			$insert = "INSERT INTO directors VALUES ($id,$director_id)";
			mysql_query($insert);
		} 
	}	
	
	//3 Schauspieler speichern
	for ($i = 0; $i < 3 ; $i++)
	{
		$cast_name = $cast[$i]["name"];
		$cast_id = $cast[$i]["id"];
		mysql_query("set names 'utf8'");
		$insert = "INSERT INTO credits_main VALUES ($cast_id,'$cast_name')";
		mysql_query($insert);
		$insert = "INSERT INTO credits VALUES ($id,$cast_id)";
		mysql_query($insert);
	}
	
foreach ($arr['genres'] as &$genre) {
	$categorie_id = $genre['id'];
	$categorie_name = $genre['name'];
	mysql_query("set names 'utf8'");
	$insert = "INSERT INTO categories_main VALUES ($categorie_id,'$categorie_name')";
	mysql_query($insert);
	$insert = "INSERT INTO categories VALUES ($id,$categorie_id)";
	mysql_query($insert);
}
	
	mysql_query("set names 'utf8'");
	$insert = "INSERT INTO movies VALUES ($id, '$title', '$original_title', '$overview', '$cover', 0, '$release_date', $duration, '$homepage', '$imdb_id', $vote_average, $vote_count, '$trailer_id', CURRENT_TIMESTAMP)";
	mysql_query($insert) OR die (mysql_error());;
	echo"<script type='text/javascript'> window.location.href='../index.php?include=admin.php&film=$title'</script>";
}
else
{
	echo "<script type='text/javascript'> window.location.href='../index.php?message=Filme können nur von einem Admin hinzugefügt werden!'</script>";
}

?>
