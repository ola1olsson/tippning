<span class="header">Visa deltagare<br/></span>


<?php


if($_REQUEST['id'] != '')
{
	$result = mysqli_query($opendb, "SELECT * FROM users WHERE id = ".$_REQUEST['id'].";") or die(mysqli_error($opendb));
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		 
//--------------------H&aumlmta anv&aumlndarens tippning fr&aringn databasen------------------------------------- START - Anv&aumlnds inte &aumlnnu... vet inte om det kommer att anv&aumlndas.
/*
	// DATABASE CONNECTION ESTABLISHMENT
	$db_result = mysql_query("SELECT * FROM tippning WHERE id = '".$_REQUEST['id']."';") or die(mysql_error());		// H&aumlmta alla v&aumlrden fr&aringn tabellen "tippning" d&aumlr "id" &aumlr lika med "request id". D&aumlr request id" &aumlr anv&aumlndaren du vill titta p&aring.

	$db_result = mysql_query($query);								// vet inte om "mysql_query" ska vara med h&aumlr... n&aringtt &aumlr riktigt fucked h&aumlr!!!! Tar man bort denna raden blir det helevete!!!
	while($db_res = mysql_fetch_array($db_result, MYSQL_ASSOC)) {
		for($i=1; $i<=$max_grupp; $i++) {
			$result[$db_res['id']][$i] = $db_res['m'.$i];			// H&aumlmta resultat i gruppspelet
		}
		for($i=$max_grupp + 1; $i<=$max_slut; $i++) {
			$result[$db_res['id']][$i][0] = $db_res['m'.$i];		// H&aumlmta resultat i slutspelet
			$result[$db_res['id']][$i][1] = $db_res['m'.$i.'a'];	// H&aumlmta hemmalag i slutspelet fr&aringn anv&aumlndarens tippning
			$result[$db_res['id']][$i][2] = $db_res['m'.$i.'b'];	// H&aumlmta bortalag i slutspelet fr&aringn anv&aumlndarens tippning
		}
		$result[$db_res['id']][$max_slut + 1] = $db_res['m'.($max_slut + 1)];				// H&aumlmta resultat "Vem vinner EM2008?"
		$result[$db_res['id']][$max_slut + 2] = $db_res['m'.($max_slut + 2)];				// H&aumlmta resultat "Hur m&aringnga m&aringl g&oumlr Sverige?"
		$result[$db_res['id']][$max_slut + 3][0] = $db_res['m'.($max_slut + 3).'a'];			// H&aumlmta resultat "Vilken spelare g&oumlr flestm&aringl?"
		$result[$db_res['id']][$max_slut + 3][1] = $db_res['m'.($max_slut + 3).'b'];			// H&aumlmta resultat "Och han spelar f&oumlr landet?"
	}
*/
//--------------------H&aumlmta anv&aumlndarens tippning fr&aringn databasen------------------------------------- SLUT
		 

//--------------------Skriv ut anv&aumlndarens uppgifter fr&aringn databasen------------------------------------- START
	?>	 

<div class="userContainer userContainer-full">
	<table border="0" cellspacing="5" cellpadding="0">
		<tr align="left">
			<td class="photoContainer">
				<?php if ($row['foto'] != '') { ?>
					<img class="photo" src="<?=$row['foto'];?>" />
				<?php } ?>
			</td>
			<td class="details">
				<span class="header2"><?=$row['username'];?><br/></span>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>Namn:</td>
						<td><?=$row['givenName'], '&nbsp;', $row['familyName'];?></td>
					</tr>
					<tr>
						<td>Ort:</td>
						<td><?=$row['city'];?></td>
					</tr>
					<tr>
						<td>F&oumlretag:</td>
						<td><?=$row['Company'];?></td>
					</tr>
					<tr>
						<td>Telefon:</td>
						<td><?=$row['phoneNumber'];?></td>
					</tr>
					<tr>
						<td>E-post:</td>
						<td><?=$row['emailAddress'];?></td>
					</tr>
					<tr>
						<td>Logins:</td>
						<td><?=$row['nbrOfLogins'];?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<br/>
	
<span class="header3">
	<?php

	$result = mysqli_query($opendb, "SELECT * FROM tippning WHERE ID = ".$row['id'].";"); // H&aumlmtar deltagarens tippning fr¨n databasen.
	if(mysqli_num_rows($result) > 0) {
		echo $row['username'].' har en registrerad tippning!';
		$correct = mysqli_query($opendb, "SELECT * FROM tippning WHERE ID = -1;"); 	// H&aumlmtar den r&aumltta raden i tippningen
		$corr = mysqli_fetch_array($correct, MYSQLI_ASSOC);					// L&aumlgger in den r&aumltta raden i en Array
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);						// L&aumlgger in deltagarens tippnings rad i en Array
	} else {
		echo $row['username'].' har inte tippat &aumlnnu!';
	}	
?>
	<br/>
</span>
<?php
}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// Display users bet
if(isset($_SESSION['permission']) && $_SESSION['permission'] && $_SESSION['betalt'] == 1 && ($cupStarted || $_SESSION['admin'])) {
?>
	<table border="0" cellspacing="0" cellpadding="0">
	<tr class="header">
		<td align="center">Match</td>
		<td align="center" width="100">Hemma</td>
		<td align="center">-</td>
		<td align="center" width="100">Borta</td>
		<td>
			<table border="1" bordercolor="black" cellspacing="0" cellpadding="0">
			<tr class="header">
				<td align="center" width="20" height="20">1</td>
				<td align="center" width="20" height="20">X</td>
				<td align="center" width="20" height="20">2</td>
			</tr>
			</table>
		</td>
		<td align="center" width="50">Po&aumlng</td>
	</tr>
	
	<?php
foreach($grundspel AS $grupp) {
	$matcher = mysqli_query($opendb,"SELECT * FROM matcher WHERE hemma LIKE '".$grupp."%' AND borta LIKE '".$grupp."%' ORDER BY ID ASC;");
?>	
		<tr><td colspan=7><span class="header2">Grupp <?echo $grupp;?></span></td></tr>
		<?php
		while($match = mysql_fetch_array($matcher)) {
		$hemma = mysqli_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['hemma']."';"), MYSQL_ASSOC);
		$borta = mysqli_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['borta']."';"), MYSQL_ASSOC);
		?>
			<tr>
			<td valign="center" align="center"><?=$match['ID']?></td>
			<td valign="center" align="right"><?=$hemma['countryName_sv'] ?>&nbsp;<img src="./pic/flaggor/<?=$hemma['flagImage']?>" align="absmiddle"></td>
			<td valign="center" align="center"> - </td>
			<td valign="center" align="left"><img src="./pic/flaggor/<?=$borta['flagImage'] ?>" align="absmiddle">&nbsp;<?=$borta['countryName_sv']?></td>
			<td>
				<table border="0" bordercolor="black" cellspacing="0" cellpadding="0">
				<tr>
					<?php
						$tmp_c = $corr['m'.$match['ID']];
						$tmp_r = $row['m'.$match['ID']];
					?>
					<td align="center" width="20" height="20" <? if($tmp_r == '1') { if($tmp_c == '1') echo 'bgcolor=#00ff00;'; else echo 'bgcolor=#ff0000;'; } ?>><? if($tmp_r == '1') echo '1'; ?></td>
					<td align="center" width="20" height="20" <? if($tmp_r == 'X') { if($tmp_c == 'X') echo 'bgcolor=#00ff00;'; else echo 'bgcolor=#ff0000;'; } ?>><? if($tmp_r == 'X') echo 'X'; ?></td>
					<td align="center" width="20" height="20" <? if($tmp_r == '2') { if($tmp_c == '2') echo 'bgcolor=#00ff00;'; else echo 'bgcolor=#ff0000;'; } ?>><? if($tmp_r == '2') echo '2'; ?></td>
				</tr>
				</table>
			</td>
			<td align="center"><? if($tmp_r == '1') { if($tmp_c == '1') echo '1p'; else echo ''; } 
							  elseif($tmp_r == 'X') { if($tmp_c == 'X') echo '1p'; else echo ''; } 
							  elseif($tmp_r == '2') { if($tmp_c == '2') echo '1p'; else echo ''; } ?>
			</td>			
		</tr>
	<?php
	}
	?>
	<tr><td colspan=7 align="center"><hr align="center" style="width:96%; height:2px;" color="#6C261F"></td></tr>
<?php
}
?>
</table>
<?php } else {
	?>
	<span class="header4">
	<?php 
	if ($_SESSION['betalt'] != 1) { ?>
	Du har &aumlnnu inte betalt och f&aringr d&aumlrmed inte se denna persons tippning.
	<?php } else if (!$cupStarted) { ?>
		Fr&aringn och med <?=$last_bet_day ?> kommer du att kunna se deltagarens tippning.
	<?php } else { ?>
		Du &aumlr inte ber&aumlttigad att se denna persons tippning.
	<?php } ?>
	</span>	
<?php } ?>

</td>
</tr>
</table>
