<center>
	<span class="header2" style="white-space: nowrap;">Hall of fame<br/></span>
</center>
<br/>
<table border=0 cellspacing=0 cellpadding=1 style="width:100%;">
	<?
	$top10 = mysql_query("SELECT * FROM users ORDER BY points DESC, givenName ASC;") or die(mysql_error());
	$placering = 1;
	$points = -1;
	for($i = 1; $i <= mysql_num_rows($top10); $i++) {
		$user = mysql_fetch_array($top10, MYSQL_ASSOC);
		if($points != $user['points'] && $points != -1)
			$placering++;
		$points = $user['points'];
//if ($user['username'] == 'Manxz') { $user['points'] = '1000'; }
		?>
		<tr>
			<td align="right"><?=$placering?></td>
			<td style="width:100%;" style="white-space: nowrap;">
				<a href="index.php?sida=visadeltagare&id=<?=$user['id']?>"><?=$user['givenName']?> <?=$user['familyName']{0}?></a>
			</td>
			<td align="right"><?=$user['points'] ?>p</td>
		</tr>
		<?
	}
	?>
</table>
<br/>