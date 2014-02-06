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
						<img class="photo" src="./pic/users/<?=$row['foto'];?>">
					<?php } ?>
				</td>
				<td class="details">
					<span class="header2"><?=$row['username'];?><br/></span>
					<?=$row['givenName'], '&nbsp;', $row['familyName'];?><br/>
					<?=$row['city'];?><br/>
					<?=$row['Company'];?>
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

