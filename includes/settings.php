<div class="content-primary" align="center">
<?php
if(isset($_SESSION["user_id"]))
{
	echo "<a href='#news' data-rel='popup' data-position-to='window' data-role='button' data-inline='true' data-theme='b'>Newsletter Einstellungen</a>";
	echo "<a href='#changepw' data-rel='popup' data-position-to='window' data-role='button' data-inline='true' data-theme='b'>Passwort ändern</a>";

	if ($_SESSION["role"] == 1)
	{
		echo "<a href='#adduser' data-rel='popup' data-position-to='window' data-role='button' data-inline='true' data-theme='b'>User hinzufügen</a>";
	}



	echo"<div data-role='popup' id='changepw' data-theme='b' data-overlay-theme='b' class='ui-corner-all'>
			<form id='pwchange' action='includes/changepw.php' method='POST' data-ajax='false'>
				<div style='padding:10px 20px;'>
				  <h3>Passwort ändern</h3>
					 <input type='password' name='pwold' id='pwold' value='' placeholder='altes Passwort' data-theme='b' />
					 <input type='password' name='pwnew' id='pwnew' value='' placeholder='neues Passwort' data-theme='b' />
					 <input type='password' name='pwrep' id='pwrep' value='' placeholder='Passwort wiederholen' data-theme='b' />
				  <button type='submit' data-theme='b'>Passwort speichern</button>
				</div>
			</form>
		</div>
		
		<div data-role='popup' id='adduser' data-theme='b' data-overlay-theme='b' class='ui-corner-all'>
			<form id='useradd' action='includes/adduser.php' method='POST' data-ajax='false'>
				<div style='padding:10px 20px;'>
				  <h3>User hinzufügen</h3>
					 <input type='email' name='email' id='email' value='' placeholder='E-Mail' data-theme='b' />
				  <button type='submit' data-theme='b'>User hinzufügen</button>
				</div>
			</form>
		</div>	

		<div data-role='popup' id='news' data-theme='b' data-overlay-theme='b' class='ui-corner-all'>
			<form id='changenews' action='includes/changenews.php' method='POST' data-ajax='false'>
				<div>
					<label for='flip-mini'>Newsletter:</label>
					<select name='flip-mini' id='flip-mini' data-role='slider' data-mini='true'>
						<option value='off'>Off</option>
						<option value='on' "; if($_SESSION["newsletter"] == 1){echo"selected='selected'";}echo">On</option>
					</select>
					<button type='submit' data-theme='b'>Speichern</button>
				</div>
			</form>
		</div>
		
	";
}
else
{
	echo"<script type='text/javascript'> window.location.href='../index.php?message=Sie müssen sich erst anmelden'</script>";
}
?>
</div>