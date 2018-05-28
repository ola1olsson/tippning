<center>
	<span class="header2" style="white-space: nowrap;">Hall of fame<br/></span>
</center>
<br/>
<table border=0 cellspacing=0 cellpadding=1 style="width:100%;">
<?php
	$top10 = mysqli_query($opendb, "SELECT * FROM users ORDER BY points DESC, givenName ASC;") or die(mysqli_error($opendb));
	$placering = 1;
	$points = -1;
	for($i = 1; $i <= mysqli_num_rows($top10); $i++) {
		$user = mysqli_fetch_array($top10, MYSQLI_ASSOC);
		if($points != $user['points'] && $points != -1)
			$placering++;
		$points = $user['points'];
//if ($user['username'] == 'Manxz') { $user['points'] = '1000'; }
		?>
		<tr>
			<td align="right"><?=isset($placering) ? $placering : '0';?></td>
			<td style="width:100%;" style="white-space: nowrap;">
<?php
if (isset($user)) {
?>
				<a href="index.php?sida=visadeltagare&id=<?=isset($user['id']) ? $user['id'] : '0';?>"><?=isset($user['givenName']) ? $user['givenName'] : '0';?></a>
<?php
}
?>
			</td>
			<td align="right"><?=isset($user['points']) ? $user['points'] : '0';?>p</td>
		</tr>
<?php
	}
?>
</table>
<br/>
