<?php
if($_SESSION['admin']) {
	if (!isset($_POST['putresult'])) {
?>
		<form action="index.jsp?sida=putresult" method="POST">
<?php
		$gameId = $_GET['gameId'];
		$game = mysqli_query($opendb,"SELECT * FROM matcher WHERE ID = ".$gameId.";") or die(mysqli_error($opendb));
		$game = mysqli_fetch_array($game);
		
		$home = mysqli_query($opendb,"SELECT * FROM $dbname.lag WHERE $dbname.lag.lag = '".$game['hemma']."';") or die(mysqli_error($opendb));
		$home = mysqli_fetch_array($home);
		$gone = mysqli_query($opendb, "SELECT * FROM $dbname.lag WHERE $dbname.lag.lag = '".$game['borta']."';") or die(mysqli_error($opendb));
		$gone = mysqli_fetch_array($gone);
?>
		Update game <?=$gameId?> (<?=$home['countryName_sv'] ?> - <?=$gone['countryName_sv']?>)<br>
			<input type="text" name="gameId" value="<?=$gameId?>" />
			<input type="text" name="result"></input>
<?php
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
<?php
						$allTeams = mysqli_query($opendb, "SELECT * FROM $dbname.lag ORDER BY $dbname.lag.lag ASC;") or die(mysqli_error($opendb));
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
<?php
						$allTeams = mysqli_query($opendb, "SELECT * FROM $dbname.lag ORDER BY $dbname.lag.lag ASC;") or die(mysqli_error($opendb));
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
<?php
		}
?>
			<br>
			<br>
			<input type="hidden" name="putresult" value="true"/>
			<input type="submit" value="Put result" />
		</form>
<?php
	} else if (isset($_POST['gameId']) && isset($_POST['result'])){
		$gameId = $_POST['gameId'];
		$result = $_POST['result'];
		mysqli_query($opendb, "UPDATE tippning SET m".$gameId."='". strtoupper($result) ."' WHERE id = -1;") or die(mysqli_error($opendb));
		if ($gameId > $grundspel_max) {
			$newHome = $_POST['home'];
			$newGone = $_POST['gone'];
			mysqli_query($opendb, "UPDATE tippning SET m".$gameId."a='".$newHome."', m".$gameId."b='".$newGone."' WHERE id = -1;") or die(mysqli_error($opendb));
			mysqli_query($opendb, "UPDATE matcher SET hemma='".$newHome."', borta='".$newGone."' WHERE id = ".$gameId.";") or die(mysqli_error($opendb));
		}
?>
		Game <?=$gameId?> updated successfully!
		Result: <?=$result?><br>
<?php
		if ($gameId > $grundspel_max) {
?>
			Home: <?=$newHome?><br>
			Gone: <?=$newGone?><br>
<?php
		}
?>
		<br>
		<br>
		<a href="index.php?sida=update">Update points!</a> | <a href="index.jsp">Go home</a>
<?php
	}
} else { 
	echo 'Permission denied!';
}
?>
