<?php
	include "../conf/config.php";

	function auth()
	{
		$user = $_Post["username"];
		$passwort = md5($_POST["password"]);

		$abfrage = "SELECT id, email, password, role FROM users WHERE email = '$user' LIMIT 1";
		$ergebnis = mysql_query($abfrage) OR die (mysql_error());
		$row = mysql_fetch_object($ergebnis);
		if($row->password == $passwort && $row->role == 1)
		    {
		    	return true;
		    }
		else
		    {
		    	return false;
		    }
		}
	}

	function addMovie()
	{
		$movie_id = $_GET["movieid"];
		$api_key = $_GET["apikey"];
		$language = $_GET["language"];
		$arr = json_decode(file_get_contents("http://api.themoviedb.org/3/movie/$movie_id?&api_key=$api_key&language=$language&append_to_response=trailers"),true);
		$id = $arr['id'];
		$title = mysql_real_escape_string($arr['title']);
		$original_title = mysql_real_escape_string($arr['original_title']);
		$overview = mysql_real_escape_string($arr['overview']);

		if ( $arr['poster_path'] == "")
		{
			$cover = "/nocover.png";
		}
		else
		{
			$cover = $arr['poster_path'];
			$url = 'http://image.tmdb.org/t/p/w500'.$cover;
			$img = '../cover'.$cover;
			file_put_contents($img, file_get_contents($url));	
		}

		$adult = $arr['adult'];
		$release_date = $arr['release_date'];
		$duration = $arr['runtime'];
		$homepage = $arr['homepage'];
		$imdb_id = $arr['imdb_id'];
		$vote_average = $arr['vote_average'];
		$vote_count = $arr['vote_count'];
		$trailer_id = $arr['trailers']['youtube'][0]['source'];

		$credits = json_decode(file_get_contents("http://api.themoviedb.org/3/movie/$movie_id/credits?&api_key=$api_key&language=de"),true);	
		
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
		
	foreach ($arr['genres'] as &$genre)
		{
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
		$check = mysql_query($insert);
		if($check == false)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	$action = $_POST["action"];
	if(auth())
	{
		if($action == "addmovie")
		{
			if(addMovie())
			{
				echo "Film wurde hinzugefügt";
			}
			else
			{
				echo "Fehler beim hinzufügen des Films";
			}
		}
	}
	else
	{
		echo "Fehler bei der Anmeldung";
	}

?>