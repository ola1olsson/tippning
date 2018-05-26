<?
if($_SESSION['admin']) {
	if ($_POST['putresult'] != 'true') {
		?>
		<form action="index.jsp?sida=putresult" method="POST">
		<?
		$gameId = $_GET['gameId'];
		$game = mysqli_query("SELECT * FROM matcher WHERE ID = ".$gameId.";") or die(mysqli_error($opendb));
		$game = mysqli_fetch_array($game);
		
		$home = mysqli_query("SELECT * FROM lag WHERE lag = '".$game['hemma']."';") or die(mysqli_error($opendb));
		$home = mysqli_fetch_array($home);
		$gone = mysqli_query("SELECT * FROM lag WHERE lag = '".$game['borta']."';") or die(mysqli_error($opendb));
		$gone = mysqli_fetch_array($gone);
		?>
		Update game <?=$gameId?> (<?=$home['countryName_sv'] ?> - <?=$gone['countryName_sv']?>)<br>
			<input type="text" name="gameId" value="<?=$gameId?>" />
			<input type="text" name="result"></input>
		<? 
		if ($gameId > $grundspel_max) {
			?>
			<br>
			<br>
			Update teams:<br>
			<table>
				<tr>
					<td>Home</td>
					<td></td>
					<td>Gone</td>
				</tr>
				<tr>
					<td>
						<select name="home">
							<option value="">-- Not set --</option>
						<?
						$allTeams = mysqli_query("SELECT * FROM lag ORDER BY lag ASC;") or die(mysqli_error($opendb));
						while ($team = mysqli_fetch_array($allTeams)) {
							echo '<option value="'.$team['lag'].'"';
							if ($team['lag'] == $home['lag']) {
								echo ' selected="true"';
							}
							echo '>'.$team['countryName_sv'].'</option>';
						}
						?>
						</select>
					</td>
					<td>&nbsp;-&nbsp;</td>
					<td>
						<select name="gone">
							<option value="">-- Not set --</option>
						<?
						$allTeams = mysqli_query("SELECT * FROM lag ORDER BY lag ASC;") or die(mysqli_error($opendb));
						while ($team = mysqli_fetch_array($allTeams)) {
							echo '<option value="'.$team['lag'].'"';
							if ($team['lag'] == $gone['lag']) {
								echo ' selected="true"';
							}
							echo '>'.$team['countryName_sv'].'</option>';
						}
						?>
						</select>
					</td>
				</tr>
			</table>
			<?
		}
		?>
			<br>
			<br>
			<input type="hidden" name="putresult" value="true"/>
			<input type="submit" value="Put result" />
		</form>
		<?
	} else {
		$gameId = $_POST['gameId'];
		$result = $_POST['result'];
		mysqli_query("UPDATE tippning SET m".$gameId."='".$result."' WHERE id = -1;") or die(mysqli_error($opendb));
		if ($gameId > $grundspel_max) {
			$newHome = $_POST['home'];
			$newGone = $_POST['gone'];
			mysqli_query("UPDATE tippning SET m".$gameId."a='".$newHome."', m".$gameId."b='".$newGone."' WHERE id = -1;") or die(mysqli_error($opendb));
			mysqli_query("UPDATE matcher SET hemma='".$newHome."', borta='".$newGone."' WHERE id = ".$gameId.";") or die(mysqli_error($opendb));
		}
		?>
		Game <?=$gameId?> updated successfully!
		Result: <?=$result?><br>
		<?
		if ($gameId > $grundspel_max) {
			?>
			Home: <?=$newHome?><br>
			Gone: <?=$newGone?><br>
			<?
		}
		?>
		<br>
		<br>
		<a href="index.php?sida=update">Update points!</a> | <a href="index.jsp">Go home</a>
		<?
	}
} else { 
	echo 'Permission denied!';
}
?>
