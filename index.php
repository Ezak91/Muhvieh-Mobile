<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="Marc Szymkowiak" content="http://muhvieh.ezak91.de/" />
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1" />
	<link rel="stylesheet" href="css/jquery-ui.css" />	
	<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css" />
	<script  src="jquery/jquery-1.11.2.min.js"></script>
	<script  src="jquery/jquery.mobile-1.4.5.min.js"></script>
</head>		
<body>	
	<div data-role="page">
		<div data-role="header">
			<a href="index.php" data-role="button">Home</a>
			<h1>Muhvieh Mobile</h1>
				<?php
					if(isset ($_SESSION["user_id"]))
					{
						echo"
						<div data-role='navbar'>
							<ul>
								<li><a href='index.php?include=movies.php' data-icon='home' data-ajax='false'>Start</a></li>
								<li><a href='index.php?include=news.php' data-icon='video' data-ajax='false'>News</a></li>
								<li><a href='index.php?include=settings.php' data-icon='edit' data-ajax='false'>Settings</a></li>
						";
						if($_SESSION["role"] == 1)
						{
							echo "
								<li><a href='index.php?include=admin.php' data-icon='user' data-ajax='false'>Admin</a></li>
							";
						}
						else
						{
							echo "
								<li><a href='index.php?include=wishlist.php' data-icon='user' data-ajax='false'>Wunschliste</a></li>
							";
						}
						echo "
								
							</ul>
						</div>
						";
					}
				?>
		</div>
	
		<div data-role="main" class="ui-content">
			<?php
				$include = "";

				if(isset($_GET['message']) AND !empty($_GET['message']))
				{
					$message = $_GET['message'];
					include "includes/message.php";
				}
				else
				{
					if (isset($_SESSION["user_id"]))
					{
						if (isset($_GET['include']))
						{
							$include = $_GET['include'];
							include "includes/$include";
						}
						else
						{
							include "includes/movies.php";
						}
					}
					else
					{
						include "includes/login.html";
					}
				}
			?>
		</div>
		<?php
			if (isset($_SESSION["user_id"]))
			{
				echo"
				<div data-role='footer' align='center'>
					<a href='includes/logout.php?' data-ajax='false'>Logout</a>
				</div>
				";
			}
			else
			{
				echo"
				<div data-role='footer'>
					<h1>Muhvieh 2014</h1>
				</div>
				";
			}
		?>
		
	</div>
	
</body>
</html>
