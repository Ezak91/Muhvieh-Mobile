<?php
include "conf/config.php";

if ($_SESSION["role"] == 1)
{
	if (isset($_GET["film"]))
	{
		$movie_name = $_GET["film"];
		echo"<ul data-role='listview' data-inset='true'><li data-role='list-divider'>$movie_name wurde hinzugefügt</li></ul>";
	}
	echo "<div data-role='content' id='contentConfirmation' name='contentConfirmation' align='center'>
		  <label for='movie-search'>Search Movie:</label>
	      <ul id='autocomplete' data-role='listview' data-inset='true' data-filter='true' data-filter-placeholder='Film hinzufügen' data-filter-theme='d'></ul>
	      </div>";

	echo "<div data-role='collapsible' data-content-theme='false'><h4>Userliste</h4><p><ul data-role='listview' data-inset='true' data-icon='delete'>";
	mysql_query("set names 'utf8'");
	$abfrage = "SELECT * FROM users ORDER BY last_login DESC";
	$ergebnis = mysql_query($abfrage);

	while($row = mysql_fetch_object($ergebnis))
	{
		echo "
				<li>
					<a href='includes/deleteuser.php?user_id=$row->id' data-ajax='false' >
					<h2>Username: $row->email</h2>
					<p>Letzter Login: $row->last_login</p>
					</a>
				</li>";
						
				
	}

	echo "</ul></p><div>";

}
else
{
	echo "<script type='text/javascript'> window.location.href='../index.php?message=Diese Seite ist nur für Administratoren'</script>";
}
?>

   <script>
		$('document').ready(function() {
			$( "#autocomplete" ).on( "listviewbeforefilter", function ( e, data ) {
				var $ul = $( this ),
					$input = $( data.input ),
					value = $input.val(),
					html = "";
				$ul.html( "" );
				if ( value && value.length > 2 ) {
					$ul.html( "<li><div class='ui-loader'><span class='ui-icon ui-icon-loading'></span></div></li>" );
					$ul.listview( "refresh" );
					$.ajax({
						url: "includes/search.php",
						dataType: "json",
						data: {
							term: $input.val()
						}
					})
					.then( function ( response ) {
						$.each( response, function ( i, val ) {
						if (i < 5)
						{
						    dt = new Date(val.release_date);
							datum = dt.getDate() + '.' + (dt.getMonth() + 1) + '.' + dt.getFullYear();							
							html += "<li><a data-ajax='false' href='includes/addmovie.php?&id=" + val.id + "'><img src='http://image.tmdb.org/t/p/w500" + val.poster_path + "' />" + val.title + "<br>" + datum + "</a></li>";
						}
							});
							$ul.html( html );
							$ul.listview( "refresh" );
							$ul.trigger( "updatelayout");
					});
				}
			});
		});
    </script>
