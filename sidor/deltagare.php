<span class="header">Deltagare<br/></span>

<?php
$result = mysqli_query($opendb, "SELECT * FROM users ORDER BY username") or die(mysqli_error($opendb));
while($row = mysqli_fetch_array($result )) { 
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
					F&oumlretag: <?=$row['Company'];?><br/>
					Antal logins: <?=$row['nbrOfLogins'];?>
				</td>
			</tr>
		</table>
	</div>
<?php
}
?>

