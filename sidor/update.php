<?

function getCorrectText($correct) {
	return $correct != '' ? $correct : '-';
}
if($_SESSION['admin']) {
?>
<table BGCOLOR="#FFFFFF" width="100%" height="100%" bordercolor="#6C261F"  cellpadding="30" cellspacing="0">
	<tr>
		<td align="left" valign="top" frame="rhs" border="1"> 
			<center>
				<span class="header">Uppdatering av poängställning</span>
			</center>
			<br>
			<table>
				<tr>
					<td>
						<b>Match</b>
					</td>
					<td>
						<b>User</b>
					</td>
					<td>
						<b>Correct</b>
					</td>
					<td>
						<b>Points</b>
					</td>
					<td>
						<b>Worth points</b>
					</td>
				</tr>
				<?
				$correctTipQuery = mysqli_query("SELECT * FROM tippning WHERE id = -1;") or die(mysqli_error($opendb));
				$correctTip = mysqli_fetch_array($correctTipQuery, MYSQLI_ASSOC);
				
				$usersTips = mysqli_query("SELECT * FROM tippning WHERE id != -1;") or die(mysqli_error($opendb));
				$nbrUsers = mysqli_num_rows($usersTips);
				$userIdx = 0;
				while($userTip = mysqli_fetch_array($usersTips, MYSQLI_ASSOC)) {
					$userIdx++;
					$userQuery = mysqli_query("SELECT * FROM users WHERE id =".$userTip['id'].";") or die(mysqli_error($opendb));
					$user = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
					$points = 0;
					$maxPoints = 0;
					?>
				<tr>
					<td colspan="4" bgcolor="#dddddd">
						<b><?=$userIdx?>. <?=$user['givenName']?> <?=$user['familyName']?> (<?=$user['username']?>)</b>
					</td>
				</tr>
						<?
						if($userTip['topScorer'] == $correctTip['topScorer'] && $userTip['topScorer'] != '') {
							$points = $points + 5
							?>
							<td bgcolor="#00ff00">Topscorer:<?=$correctTip['topScorer']?></td>
							<?
						} else {
							?>
							<td bgcolor="#ff0000">Topscorer:<?=$correctTip['topScorer']?></td>
							<?
						}
						?>
	
						<?
						if($userTip['swedishGoals'] == $correctTip['swedishGoals'] && $userTip['swedishGoals'] != '') {
							$points = $points + 5
							?>
							<td bgcolor="#00ff00">Goals:<?=$correctTip['swedishGoals']?></td>
							<?
						} else {
							?>
							<td bgcolor="#ff0000">Goals:<?=$correctTip['swedishGoals']?></td>
							<?
						}
						?>
	
					<?
					// 1p för rätt resultat för varje match
					$points_result = 1;
					for($k = 1; $k <= $slutspel_max; $k++) {
						$maxPoints = $maxPoints + $points_result;
						?>
				<tr>
					<td><?=$k?></td>
					<td><?=$userTip['m'.$k]?></td>
					<td><?=getCorrectText($correctTip['m'.$k])?></td>
						<?
						if($userTip['m'.$k] == $correctTip['m'.$k] && $userTip['m'.$k] != '') {
							$points = $points + $points_result;
							?>
							<td bgcolor="#00ff00"><?=$points_result?>p</td>
							<?
						} else {
							?>
							<td></td>
							<?
						}
						?>
					<td><?=$points_result?></td>
				</tr>
						<?
					}
					
					// 2p - Rätt tippad åttondels-, kvarts-, semi- eller tredjeplatslag, (och final just nu)
					for ($k = $grundspel_max + 1; $k <= $eights_max; $k++) {
						$points_team[$k] = 2; // Points for correct eights final team
					}
					for ($k = $eights_max + 1; $k <= $quarter_max; $k++) {
						$points_team[$k] = 3; // Points for correct quarter final team
					}
					for ($k = $quarter_max + 1; $k <= $semi_max; $k++) {
						$points_team[$k] = 4; // Points for correct semi final team
					}
					$points_team[$secondFinalId] = 5; // Points for correct second final team
					$points_team[$finalId] = 5; // Points for correct final team
					
					for($k = $grundspel_max + 1; $k <= $slutspel_max; $k++) {
						$teamPoint = $points_team[$k];
						$maxPoints = $maxPoints + 2 * $teamPoint;
						?>
				<tr>
					<td>m<?=$k?>a</td>
					<td><?=$userTip['m'.$k.'a']?></td>
					<td><?=getCorrectText($correctTip['m'.$k.'a'])?></td>
						<?
						if($userTip['m'.$k.'a'] == $correctTip['m'.$k.'a'] && $userTip['m'.$k.'a'] != '') {
							$points = $points + $teamPoint;
							?>
					<td bgcolor="#00ff00"><?=$teamPoint?>p</td>
							<?
						} else {
							?>
					<td></td>
							<?
						}
						?>
					<td><?=$teamPoint?></td>
				</tr>
				<tr>
					<td>m<?=$k?>b</td>
					<td><?=$userTip['m'.$k.'b']?></td>
					<td><?=getCorrectText($correctTip['m'.$k.'b'])?></td>
						<?
						if($userTip['m'.$k.'b'] == $correctTip['m'.$k.'b'] && $userTip['m'.$k.'b'] != '') {
							$points = $points + $teamPoint; 
							?>
					<td bgcolor="#00ff00"><?=$teamPoint?>p</td>
							<?
						} else {
							?>
					<td></td>
							<?
						}
						?>
					<td><?=$teamPoint?></td>
				</tr>
					<?
					}
					?>
				<tr>
					<td colspan="3" bgcolor="#dddddd">
						<b>Total points:</b>
					</td>
					<td bgcolor="#dddddd">
						<b><?=$points?>p</b>
					</td>
					<td>
						<b>Max <?=$maxPoints?>p</b>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
				</tr>
				<?
				mysqli_query("UPDATE users SET points = '".$points."' WHERE id = ".$userTip['id'].";") or die(mysqli_error($opendb));
				}
				?>
			<table>
			<?=$nbrUsers?>st deltagares poängställning har uppdaterats.<br/>
			<br/>
			<input type=button class=btn value="Startsidan" onClick="document.location=\'index.php?sida=startsida\';" />
		</td>
	</tr>
</table>
<?
} else { 
	echo 'Permission denied!';
}
?>
