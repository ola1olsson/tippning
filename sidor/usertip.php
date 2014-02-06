
<?
if(session_is_registered('permission') && $_SESSION['permission'] && $_SESSION['admin']) {
	$users = mysql_query("SELECT * FROM deltagare ORDER BY fornamn ASC;");
	
	?>
	<table BGCOLOR="#FFFFFF" width="100%" height="100%"  bordercolor="#6C261F"  cellpadding="30" cellspacing="0">
<tr>
<td align="left" valign="top" frame="rhs" border="1"> 


<center><span class="header">UserTipp</span></center>
	
	<table style="border: 1px dotted black;">
		<tr>
			<td><b>ID</b></td>
			<td><b>Användare</b></td>
			<td><b>Tippat?</b></td>
			<td><b>Betalt?</b></td>
		</tr>
	<?
	$nbrTipped = 0;
	$nbrLoser = 0;
	while($user = mysql_fetch_array($users, MYSQL_ASSOC))
	{
		?>
		<tr>
			<td><?=$user['id']?></td>
			<td><?=$user['fornamn'].' '.$user['efternamn']?></td>
			<td><?
			$tip = mysql_query("SELECT * FROM tippning WHERE id = '".$user['id']."';");
			if (mysql_num_rows($tip) != 0)
			{
				$nbrTipped++;
				echo '<span style="color: green;">Japps</span>';
			}
			else
			{
				$nbrLosers++;
				echo '<span style="color: red;">Oh noes!</span>';
			}
			?></td>
			<td><?
			if ($user['betalt'] == 1)
			{
				$nbrTipped++;
				echo '<span style="color: green;">Japps</span>';
			}
			else
			{
				$nbrLosers++;
				echo '<span style="color: red;">Oh noes!</span>';
			}
			?></td>
		</tr>
		<?
	}
	?>
	</table>
	<br/>
	Antal som är duktiga: <?=$nbrTipped;?><br/>
	Antal som suger balle: <?=$nbrLosers;?>
	
	</td>
</tr>
</table>
	<?
}
?>