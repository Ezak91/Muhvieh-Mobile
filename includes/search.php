<?php
include "conf/config.php";
function getResults($key, $term, $language) {
  return json_encode(json_decode(file_get_contents("http://api.themoviedb.org/3/search/movie?api_key=$key&language=$language&query=".urlencode($term)))->results, JSON_PRETTY_PRINT);
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo getResults($api_key, $_GET['term'], 'de');
?>
