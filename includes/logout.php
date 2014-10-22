<?php
session_start();
?>
<?php
session_destroy();	
echo"<script type='text/javascript'> window.location.href='../index.php?message=Erfolgreich ausgeloggt'</script>";
?>