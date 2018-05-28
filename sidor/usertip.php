<?php
if(activeSession() && $_SESSION['admin']) {
	$users = mysqli_query($opendb, "SELECT * FROM users ORDER BY givenName ASC;");
?>
	<table BGCOLOR="#FFFFFF" width="100%" height="100%"  bordercolor="#6C261F"  cellpadding="30" cellspacing="0">
	<tr>
	<td align="left" valign="top" frame="rhs" border="1"> 
	<center><span class="header">UserTipp</span></center>
	<table style="border: 1px dotted black;">
		<tr>
			<td><b>ID</b></td>
			<td><b>Anv&aumlndare</b></td>
			<td><b>Tippat?</b></td>
			<td><b>Betalt?</b></td>
		</tr>
<?php
	$nbrTipped = 0;
	$nbrNotTipped = 0;
	$nbrPaid = 0;
	$nbrNotPaid = 0;
	while($user = mysqli_fetch_array($users, MYSQLI_ASSOC))
	{
?>
		<tr>
			<td><?=$user['id']?></td>
			<td><?=$user['givenName'].' '.$user['familyName']?></td>
			<td>
<?php
			$tip = mysqli_query($opendb, "SELECT * FROM tippning WHERE id = '".$user['id']."';");
			if (mysqli_num_rows($tip) != 0)
			{
				$nbrTipped++;
				echo '<span style="color: green;">Japps</span>';
			}
			else
			{
				$nbrNotTipped++;
				echo '<span style="color: red;">Oh noes!</span>';
			}
?>
			</td>
			<td>
<?php
			if ($user['betalt'] == 1)
			{
				$nbrPaid++;
				echo '<span style="color: green;">Japps</span>';
			}
			else
			{
				$nbrNotPaid++;
				echo '<span style="color: red;">Oh noes!</span>';
			}
?>
			</td>
		</tr>
<?php
	}
?>
	</table>
	<br/>
	Antal som tippat: <?=$nbrTipped;?><br/>
	Antal som inte tippat: <?=$nbrNotTipped;?><br/>
	Antal som betalt: <?=$nbrPaid;?><br/>
	Antal som inte betalt: <?=$nbrNotPaid;?>

	</td>
	</tr>
	</table>
<?php
}
?>
