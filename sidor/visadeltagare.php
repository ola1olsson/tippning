<span class="header">Visa deltagare<br/></span>

<?
if($_REQUEST['id'] != '')
{
	$result = mysql_query("SELECT * FROM users WHERE id = ".$_REQUEST['id'].";") or die(mysql_error());
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
		 
//--------------------H�mta anv�ndarens tippning fr�n databasen------------------------------------- START - Anv�nds inte �nnu... vet inte om det kommer att anv�ndas.
/*
	// DATABASE CONNECTION ESTABLISHMENT
	$db_result = mysql_query("SELECT * FROM tippning WHERE id = '".$_REQUEST['id']."';") or die(mysql_error());		// H�mta alla v�rden fr�n tabellen "tippning" d�r "id" �r lika med "request id". D�r request id" �r anv�ndaren du vill titta p�.

	$db_result = mysql_query($query);								// vet inte om "mysql_query" ska vara med h�r... n�tt �r riktigt fucked h�r!!!! Tar man bort denna raden blir det helevete!!!
	while($db_res = mysql_fetch_array($db_result, MYSQL_ASSOC)) {
		for($i=1; $i<=$max_grupp; $i++) {
			$result[$db_res['id']][$i] = $db_res['m'.$i];			// H�mta resultat i gruppspelet
		}
		for($i=$max_grupp + 1; $i<=$max_slut; $i++) {
			$result[$db_res['id']][$i][0] = $db_res['m'.$i];		// H�mta resultat i slutspelet
			$result[$db_res['id']][$i][1] = $db_res['m'.$i.'a'];	// H�mta hemmalag i slutspelet fr�n anv�ndarens tippning
			$result[$db_res['id']][$i][2] = $db_res['m'.$i.'b'];	// H�mta bortalag i slutspelet fr�n anv�ndarens tippning
		}
		$result[$db_res['id']][$max_slut + 1] = $db_res['m'.($max_slut + 1)];				// H�mta resultat "Vem vinner EM2008?"
		$result[$db_res['id']][$max_slut + 2] = $db_res['m'.($max_slut + 2)];				// H�mta resultat "Hur m�nga m�l g�r Sverige?"
		$result[$db_res['id']][$max_slut + 3][0] = $db_res['m'.($max_slut + 3).'a'];			// H�mta resultat "Vilken spelare g�r flestm�l?"
		$result[$db_res['id']][$max_slut + 3][1] = $db_res['m'.($max_slut + 3).'b'];			// H�mta resultat "Och han spelar f�r landet?"
	}
*/
//--------------------H�mta anv�ndarens tippning fr�n databasen------------------------------------- SLUT
		 

//--------------------Skriv ut anv�ndarens uppgifter fr�n databasen------------------------------------- START
	?>	 

<div class="userContainer userContainer-full">
	<table border="0" cellspacing="5" cellpadding="0">
		<tr align="left">
			<td class="photoContainer">
				<?php if ($row['foto'] != '') { ?>
					<img class="photo" src="./pic/users/<?=$row['foto'];?>" />
				<?php } ?>
			</td>
			<td class="details">
				<span class="header2"><?=$row['user'];?><br/></span>
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
						<td>F�retag:</td>
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
	<?

	$result = mysql_query("SELECT * FROM tippning WHERE ID = ".$row['id'].";"); // H�mtar deltagarens tippning fr�n databasen.
	if(mysql_num_rows($result) > 0) {
		echo $row['username'].' har en registrerad tippning!';
		$correct = mysql_query("SELECT * FROM tippning WHERE ID = -1;"); 	// H�mtar den r�tta raden i tippningen
		$corr = mysql_fetch_array($correct, MYSQL_ASSOC);					// L�gger in den r�tta raden i en Array
		$row = mysql_fetch_array($result, MYSQL_ASSOC);						// L�gger in deltagarens tippnings rad i en Array
	} else {
		echo $row['username'].' har inte tippat �nnu!';
	}	
?>
	<br/>
</span>
<?
}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// Display users bet
if(session_is_registered('permission') && $_SESSION['permission'] && $_SESSION['betalt'] == 1 && ($cupStarted || $_SESSION['admin'])) {
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
		<td align="center" width="50">Po�ng</td>
	</tr>
	
	<? // Gruppspelet, visar - s� h�r har deltagaren tippat.
foreach($grundspel AS $grupp) {
	$matcher = mysql_query("SELECT * FROM matcher WHERE hemma LIKE '".$grupp."%' AND borta LIKE '".$grupp."%' ORDER BY ID ASC;");
?>	
		<tr><td colspan=7><span class="header2">Grupp <?echo $grupp;?></span></td></tr>
		<?
		while($match = mysql_fetch_array($matcher)) {
		$hemma = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['hemma']."';"), MYSQL_ASSOC);
		$borta = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['borta']."';"), MYSQL_ASSOC);
		?>
			<tr>
			<td valign="center" align="center"><?=$match['ID']?></td>
			<td valign="center" align="right"><?=$hemma['countryName_sv'] ?>&nbsp;<img src="./pic/flaggor/<?=$hemma['flagImage']?>" align="absmiddle"></td>
			<td valign="center" align="center"> - </td>
			<td valign="center" align="left"><img src="./pic/flaggor/<?=$borta['flagImage'] ?>" align="absmiddle">&nbsp;<?=$borta['countryName_sv']?></td>
			<td>
				<table border="0" bordercolor="black" cellspacing="0" cellpadding="0">
				<tr>
					<?
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
	<?		
	}
	?>
	<tr><td colspan=7 align="center"><hr align="center" style="width:96%; height:2px;" color="#6C261F"></td></tr>
<?	
}
?>
</table>
<? } else {	
	?>
	<span class="header4">
	<?php 
	if ($_SESSION['betalt'] != 1) { ?>
	Du har �nnu inte betalt och f�r d�rmed inte se denna persons tippning.
	<?php } else if (!$cupStarted) { ?>
		Fr�n och med <?=$last_bet_day ?> kommer du att kunna se deltagarens tippning.
	<?php } else { ?>
		Du �r inte ber�ttigad att se denna persons tippning.
	<?php } ?>
	</span>	
<?php } ?>

</td>
</tr>
</table>
