<span class="header">Deltagare<br/></span>

<?
$result = mysql_query("SELECT * FROM users ORDER BY username") or die(mysql_error());
while($row = mysql_fetch_array( $result )) { 
	?>
	<div class="userContainer" onclick="document.location='index.php?sida=visadeltagare&id=<?=$row['id'];?>';">
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="photoContainer">
					<?php if ($row['foto'] != '') { ?>
						<img class="photo" src="<?=$row['foto'];?>">
					<?php } ?>
				</td>
				<td class="details">
					<span class="header2"><?=$row['username'];?><br/></span>
					Namn: <?=$row['givenName'], '&nbsp;', $row['familyName'];?><br/>
					Ort: <?=$row['city'];?><br/>
					Foretag: <?=$row['Company'];?><br/>
					Antal logins: <?=$row['nbrOfLogins'];?>
					<?/*
					if(mysql_num_rows($result2) > 0)
					{
					echo '<br>';
					echo 'Tippning OK!';
					}
					*/?>
				</td>
			</tr>
		</table>
	</div>
	<?
}
?>

