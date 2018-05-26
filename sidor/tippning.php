<?php

//include "../config.php";
//include "../connect_database.php";


if(isset($_SESSION['permission']) && !$_SESSION['permission'] && !$cupStarted || (isset($_SESSION['admin']) && $_SESSION['admin'])) {
	echo '<span class="header2">Permission denied!</span>';
} else {
?>

	<table BGCOLOR="#FFFFFF" border="0" width="100%" height="100%">
	<tr>
	<td align="center">

	<br>
	<span class="header4"><b>Tippningen</b></span>
	<br>
	<br>

<?php
	if (isset($_SESSION['betalt']) && $_SESSION['betalt'] != 1) {
?>
		<span style="color: red;">
		<b>VARNING!<br/></b>
		Du har ännu inte betalt. Dock har du chans att lägga din tippning fram till <?= $last_bet_day ?>, sen stänger vi slussarna, men är inte betalning gjord innan <?= $last_pay_day ?> så kommer din användaridentitet att tas bort.
		<br/>
		<br/>
		</span>
<?php	}

	$slutspel_max = $finalId; // 64

	$err = false;

//----------------------------------------------------------------------------------------------------------------------
	if(isset($_POST['match'])) { 
		$_SESSION['match'] = $_POST['match'];
		for($i=1; $i<=$grundspel_max; $i++) {
			if(isset($_SESSION['match']) && $_SESSION['match'][$i] == '') 
			$err = true;
		}
		for($i= $slutspel_max; $i<=$slutspel_max; $i++) {
			if($_SESSION['match'][$i][0]=='' || $_SESSION['match'][$i][1]=='' || $_SESSION['match'][$i][2]=='')
				$err = true;
			if($_SESSION['match']['swedishGoals']=='' || $_SESSION['match']['topScorer']=='')
				$err = true;
			echo '<br><br>';
		}
	} else {
		if (isset($_SESSION['userID'])) {
			$restip = mysqli_query($opendb, "SELECT * FROM tippning WHERE id = ".$_SESSION['userID'].";") or die(mysqli_error($opendb));
			if($tipp = mysqli_fetch_array($restip, MYSQLI_ASSOC)) {
				for($i=1; $i<=$grundspel_max; $i++) {
					$debug .= 'm'.$i.'='.$tipp['m'.$i].',';
					$_SESSION['match'][$i] = $tipp['m'.$i];	
				}
				for($i=$grundspel_max + 1; $i<=$slutspel_max; $i++) {
					$_SESSION['match'][$i][0] = $tipp['m'.$i];
					$_SESSION['match'][$i][1] = $tipp['m'.$i.'a'];
					$_SESSION['match'][$i][2] = $tipp['m'.$i.'b'];
				}
				$_SESSION['match']['swedishGoals'] = $tipp['swedishGoals'];
				$_SESSION['match']['topScorer'] = $tipp['topScorer'];
			}
		}

	}

	if(isset($_POST['match']) && !$err && date('Y-m-d')<=$last_bet_day) {
		// INSERT INTO DATABASE
		$user_chk = mysqli_query($opendb, "SELECT id FROM tippning WHERE id = ".$_SESSION['userID'].";") or die(mysqli_error($opendb));
		if(mysqli_num_rows($user_chk) > 0) {
		// UPDATE TIP IN DATABASE
		$query = "UPDATE tippning SET ";
		for($i=1; $i<=$grundspel_max; $i++) {
			 $query .= "m".$i."='".$_SESSION['match'][$i]."', ";
		}
		for($i=$grundspel_max + 1; $i<=$slutspel_max; $i++) {
			$query .= "m".$i."='".$_SESSION['match'][$i][0]."', ";
			$query .= "m".$i."a='".$_SESSION['match'][$i][1]."', ";
			$query .= "m".$i."b='".$_SESSION['match'][$i][2]."', ";
		}
		$query .= "swedishGoals='" . $_SESSION['match']['swedishGoals'] . "', ";
		$query .= "topScorer='" . $_SESSION['match']['topScorer'] . "'";
		$query .= " WHERE id = ".$_SESSION['userID'].";";
		} else {
			// INSERT TIP INTO DATABASE
			$query = "INSERT INTO tippning (";
			$query .= 'id';
			for($i=1; $i<=$grundspel_max; $i++) {
				$query .= ', m'.$i;
			}
			for($i=$grundspel_max + 1; $i<=$slutspel_max; $i++) {
				$query .= ', m'.$i.', m'.$i.'a, m'.$i.'b';
			}
			$query .= ', swedishGoals, topScorer';
			$query .= ') VALUES (';
			$query .= "'".$_SESSION['userID']."'";
			for($i=1; $i<=$grundspel_max; $i++) {
				$query.= ", '".$_SESSION['match'][$i]."'";
			}
			for($i=$grundspel_max + 1; $i<=$slutspel_max; $i++) {
				for($k=0; $k<=2; $k++)
				$query .= ", '".$_SESSION['match'][$i][$k]."'";
			}
			$query .= ", " . $_SESSION['match']['swedishGoals'] . ",";
			$query .= "'" . $_SESSION['match']['topScorer'] . "'";
			$query .= ');';
		}
		mysqli_query($opendb, $query) or die(mysqli_error($opendb));
		echo '<span class="header2">Tippning registrerad!<br></span><br><input type=button class=btn value="Ok!" onClick="document.location=\'index.php?sida=tippning\';">';
	} else {
// -----------------------------------------GRUNDSPEL-----------------------------------------
		echo '<h3>Gruppspel</h3>';

		foreach($grundspel AS $grupp) {
			$matcher = mysqli_query($opendb, "SELECT * FROM matcher WHERE hemma LIKE '".$grupp."%' AND borta LIKE '".$grupp."%' ORDER BY ID ASC;") or die(mysqli_error($opendb));
?>
			<table border=0 cellspacing=0 cellpadding=2>
			<tr>
			<td colspan=7 align="center"><span class="header4"><b>Grupp <?=$grupp?></b></span></td>
			</tr>
			<tr class="header">
			<td align="right">Match</td>
			<td align="right">Hemma</td>
			<td>-</td>
			<td align="left">Borta</td>
			<td align="center">1</td>
			<td align="center">X</td>
			<td align="center">2</td>
			</tr>
<?php
			while($match = mysqli_fetch_array($matcher, MYSQLI_ASSOC)) {
				// Kolumn 'lag' är skönt - 2014 fixa sig!
				if (isset($match) && isset($match['ID'])) {
					$hemma = mysqli_fetch_array(mysqli_query($opendb, "SELECT * FROM lag WHERE lag = '".$match['hemma']."';"), MYSQLI_ASSOC);
					$borta = mysqli_fetch_array(mysqli_query($opendb, "SELECT * FROM lag WHERE lag = '".$match['borta']."';"), MYSQLI_ASSOC);
					if(!empty($_SESSION['match']) && $_SESSION['match'][$match['ID']] == '') { 
						echo '<tr style="background-color: #FF0000;">';
						$err = true;
					} else {
						echo '<tr>';
					} 
?>
					<td align="center"><?=$match['ID']?></td>
					<td align="right"><?=$hemma['countryName_sv'] ?>&nbsp;<img src="./pic/flaggor/<?=$hemma['flagImage']?>" align="absmiddle"></td>
					<td valign="center" align="center"> - </td>
					<td valign="center" align="left"><img src="./pic/flaggor/<?=$borta['flagImage']?>" align="absmiddle">&nbsp;<?=$borta['countryName_sv']?></td>
					<td align="center"><input type="radio" class="radio" name="<?='match['.$match['ID'].']'?>" value="1"
<?php
					if(isset($_SESSION['match']) && $_SESSION['match'][$match['ID']] == '1')
					echo ' checked';
?>
					></td>
					<td align="center"><input type="radio" class="radio" name="<?='match['.$match['ID'].']'?>" value="X"
<?php
					if(isset($_SESSION['match']) && $_SESSION['match'][$match['ID']] == 'X') 
						echo ' checked';
?>
>
					</td>
					<td align="center"><input type="radio" class="radio" name="<?='match['.$match['ID'].']'?>" value="2"
<?php
					if(isset($_SESSION['match']) && $_SESSION['match'][$match['ID']] == '2') 
						 echo ' checked';
?>
					></td>
					</tr>
<?php
				}
			}
?>
			<tr>
			<td colspan=7 align="center"><hr align="center" style="width:96%; height:1px;" color="#6C261F"></td>
			</tr>
			</table>
			<br>
<?php
		}
	}
?>
// -----------------------------------------GRUNDSPEL SLUT------------------------------------



// -----------------------------------------ÅTTONDEL BÖRJAR -------------------------------------
		<h3>Åttondelsfinaler</h3>
		<table border="0" cellspacing="0" cellpadding="2">
			<tr class="header">
			<td align="right"></td>
		<td width=150 align="center"></td>
		<td></td>
		<td width=150 align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		</tr>
<?php
/**
		groups förklaring:
		groups[i] -> i = gruppnummer
		groups[i][k] -> k(0) = hemma, k(1) = borta
*/

		$groups[1][0] = '2:a i grupp A';
		$groups[1][1] = '2:a i grupp C';
		$groups[2][0] = '1:a i grupp B';
		$groups[2][1] = 'Bästa 3:a i A/C/D';
		$groups[3][0] = '1:a grupp D';
		$groups[3][1] = 'Bästa 3:A i B/E/F';
		$groups[4][0] = '1:a i grupp A';
		$groups[4][1] = 'Bästa 3:e i C/D/E';
		$groups[5][0] = '1:a i grupp C';
		$groups[5][1] = 'Bästa 3:a i A/B/F';
		$groups[6][0] = '1:a i grupp F';
		$groups[6][1] = '2:a i grupp E';
		$groups[7][0] = '1:a i grupp E';
		$groups[7][1] = '2:a i grupp D';
		$groups[8][0] = '2:a i grupp B';
		$groups[8][1] = '2:a i grupp F';

		$match_offset = $grundspel_max; // sista matchnumret i gruppspelet
		$err = false;
		for($match = 1; $match <= 8; $match++) {
			if (isset($groups[$match])) {
			$hamtahemma = mysqli_query($opendb, "SELECT * FROM lag WHERE lag LIKE '".$groups[$match][0]."%';");
			$hamtaborta = mysqli_query($opendb, "SELECT * FROM lag WHERE lag LIKE '".$groups[$match][1]."%';");

			$matchnumber = $match + $match_offset;
?>

			<tr>
			<td colspan="7" align="center"><span class="header4"><b>Åttondelsfinal <?=$match?></b></span><br><br></td>
			</tr>
			<tr>
<?php
			// kollar så att just denna match blivit tippad, annars färgar vi hela TR'n röööööööd
			if(!empty($_SESSION['match']) && ($_SESSION['match'][$matchnumber][0] == '')) {
				echo '  style="background-color: #FF0000;"';
				$err = true;
			}
?>
			<td align="center"><?=$matchnumber?></td>
			<td align="center"><input type="radio" class="radio" name="<?='match['.$matchnumber.'][0]'?>" value="1"
<?php
			// kolla om matchen redan är tippad (och isf sparad i sessionen), i så fall skall rätt tippning "checkas"
			if(isset($_SESSION['match']) && $_SESSION['match'][$matchnumber][0] == '1') echo ' checked';
?>
			></td>
			<td align="center"> - </td>
			<td align="center"><input type="radio" class="radio" name="<?='match['.$matchnumber.'][0]'?>" value="2"
<?php
			if(isset($_SESSION['match']) && $_SESSION['match'][$matchnumber][0] == '2') echo ' checked';
?>
			></td>
			</tr>
			<tr>
			<td></td>
			<td align="center"><?=$groups[$match][0]?></td>
			<td></td>
			<td align="center"><?=$groups[$match][1]?></td>
			</tr>
			<tr>
			<td colspan=7 align="center"><hr align="center" style="width:96%; height:1px;" color="#6C261F"></td>
			</tr>
<?php
		}	}
?>

		</table>
		<br>
		<br>
		<br>

<?php
// ------------------------------------------------ ÅTTONDEL SLUT ---------------------------
// -------------------------------------------------------- KVART BÖRJAR --------------------------
?>

		<h3>Kvartsfinaler</h3>
		<table border=0 cellspacing=0 cellpadding=2>
			<tr class="header">
				<td align="right">Match</td>
				<td width=150 align="center">Hemma</td>
				<td>-</td><td width=150 align="center">Borta</td>
				<td align="center">1</td>
				<td align="center">-</td>
				<td align="center">2</td>
			</tr>
<?php
			// OPTIMERADE KVARTAR

			if (defined($WORLD_CUP)) { 
			$groups[1][0][0] = 'A';
			$groups[1][0][1] = 'B';
			$groups[1][1][0] = 'C';
			$groups[1][1][1] = 'D';
			$groups[2][0][0] = 'E';
			$groups[2][0][1] = 'F';
			$groups[2][1][0] = 'G';
			$groups[2][1][1] = 'H';
			$groups[3][0][0] = 'B';
			$groups[3][0][1] = 'A';
			$groups[3][1][0] = 'D';
			$groups[3][1][1] = 'C';
			$groups[4][0][0] = 'F';
			$groups[4][0][1] = 'E';
			$groups[4][1][0] = 'H';
			$groups[4][1][1] = 'G';

			$winner[1][0] = 2;
			$winner[1][1] = 1;
			$winner[2][0] = 5;
			$winner[2][1] = 6;
			$winner[3][0] = 3;
			$winner[3][1] = 4;
			$winner[4][0] = 7;
			$winner[4][1] = 8;
			$match_offset = $eights_max; // Sista matchen av åttondelsfinalerna + 1 = första kvartsfinalen
			} else {
			$groups[1][0] = 'Vinnare match 37';
			$groups[1][1] = 'Vinnare match 39';
			$groups[2][0] = 'Vinnare match 38';
			$groups[2][1] = 'Vinnare match 42';
			$groups[3][0] = 'Vinnare match 41';
			$groups[3][1] = 'Vinnare match 43';
			$groups[4][0] = 'Vinnare match 40';
			$groups[4][1] = 'Vinnare match 44';
			$match_offset = $eights_max;
			}

			for($match = 1; $match <= 4; $match++) {
			if (defined($WORLD_CUP)) { 
				$hamtahemma = mysqli_query($opendb, "SELECT * FROM lag WHERE lag LIKE '".$groups[$match][0][0]."%' OR lag LIKE '".$groups[$match][0][1]."%' ORDER BY lag;");
				$hamtaborta = mysqli_query($opendb, "SELECT * FROM lag WHERE lag LIKE '".$groups[$match][1][0]."%' OR lag LIKE '".$groups[$match][1][1]."%' ORDER BY lag;");
			} else {
				$hamtahemma = mysqli_query($opendb, "SELECT * FROM lag WHERE lag LIKE '".$groups[$match][0]."%' ORDER BY lag;");
				$hamtaborta = mysqli_query($opendb, "SELECT * FROM lag WHERE lag LIKE '".$groups[$match][1]."%' ORDER BY lag;");

			}
				
			$matchnumber = $match + $match_offset;
?>
			<tr>
			<td colspan="7" align="center"><span class="header4"><b>Kvartsfinal <?=$match?></b></span><br><br></td>
			</tr>

<?php
			echo '<tr';
			// Används för att kolla om man "glömt" tippa på nån match, i så fall skall hela den TR'n bli röd. 
			//(err=true säger åt dig att något inte har tippats, används säkert senare..... 2014? Nu tänker du - "Ja!"
			if(!empty($_SESSION['match']) && ($_SESSION['match'][$matchnumber][0] == '')) 
			{
				echo ' style="background-color: #FF0000;"';
				$err = true;
			}
			echo '><td align="center">'.($matchnumber).'</td>'.
					'</td>'.		
					'<td align="center"><input type="radio" class=radio name="match['.($matchnumber).'][0]" value="1"';
			if(isset($_SESSION['match']) && $_SESSION['match'][$matchnumber][0] == '1') // används för att kolla med tippningen som ligger i sessionen om man tippat "etta"
				echo ' checked';
				echo '></td>'.
				'<td align="center"> - </td>'.
				'<td align="center"><input type="radio" class=radio name="match['.($matchnumber).'][0]" value="2"';
				if(isset($_SESSION['match']) && $_SESSION['match'][$matchnumber][0] == '2') // används för att kolla med tippningen som ligger i sessionen om man tippat "tvåa"
					echo ' checked';
					echo '></td>'.
					'</tr>';
					echo '<tr><td></td><td align="center">'.$groups[$match][0].'</td><td></td><td align="center">'.$groups[$match][1].'</td></tr>';	
				echo '<tr><td colspan=7 align=center><hr align=center style="width:96%; height:1px;" color="#6C261F"></td></tr>';	
			}
		echo '</table><br><br><br>';
// -------------------------------------------------------- KVART SLUT ----------------------------

// -------------------------------------------------------- SEMI BÖRJAR --------------------------
?>
		<h3>Semifinaler</h3>
		<table border=0 cellspacing=0 cellpadding=2>
			<tr class="header">
				<td align="right">Match</td>
				<td width=150 align="center">Hemma</td>
				<td>-</td><td width=150 align="center">Borta</td>
				<td align="center">1</td>
				<td align="center">-</td>
				<td align="center">2</td>
			</tr>
<?php

		if (1) {
			$groups[1][0][0] = 'A';
			$groups[1][0][1] = 'E';
			$groups[1][1][0] = 'B';
			$groups[1][1][1] = 'F';
			$groups[1][2][0] = 'C';
			$groups[1][2][1] = 'G';
			$groups[1][3][0] = 'D';
			$groups[1][3][1] = 'H';
			$groups[2][0][0] = 'B';
			$groups[2][0][1] = 'F';
			$groups[2][1][0] = 'A';
			$groups[2][1][1] = 'E';
			$groups[2][2][0] = 'D';
			$groups[2][2][1] = 'H';
			$groups[2][3][0]	 = 'C';
			$groups[2][3][1] = 'G';
		} else {
			$groups[1][0][0] = 'A';
			$groups[1][0][1] = 'C';
			$groups[1][1][0] = 'B';
			$groups[1][1][1] = 'D';
			$groups[2][0][0] = 'A';
			$groups[2][0][1] = 'C';
			$groups[2][1][0] = 'B';
			$groups[2][1][1] = 'D';
		}
		$winner[1][0] = 1;
		$winner[1][1] = 2;
		$winner[2][0] = 3;
		$winner[2][1] = 4;

		$match_offset = $quarter_max; // sista matchen i kvartarna (+ 1 = första semin)

		for($match = 1; $match <= 2; $match++) {

			if (1) {
				$hamtahemma = mysqli_query($opendb, "SELECT * FROM lag WHERE lag LIKE '".$groups[$match][0][0]."%' OR lag LIKE '".$groups[$match][1][0]."%' OR lag LIKE '".$groups[$match][2][0]."%' OR lag LIKE '".$groups[$match][3][0]."%' ORDER BY lag;");
				$hamtaborta = mysqli_query($opendb, "SELECT * FROM lag WHERE lag LIKE '".$groups[$match][0][1]."%' OR lag LIKE '".$groups[$match][1][1]."%' OR lag LIKE '".$groups[$match][2][1]."%' OR lag LIKE '".$groups[$match][3][1]."%' ORDER BY lag;");
	
			} else {
				$hamtahemma = mysqli_query($opendb, "SELECT * FROM lag WHERE lag LIKE '".$groups[$match][0][0]."%' OR lag LIKE '".$groups[$match][1][0]."%' ORDER BY lag;");
				$hamtaborta = mysqli_query($opendb, "SELECT * FROM lag WHERE lag LIKE '".$groups[$match][0][1]."%' OR lag LIKE '".$groups[$match][1][1]."%' ORDER BY lag;");
			}
			$matchnumber = $match + $match_offset;
?>	
			<tr>
			<td colspan="7" align="center"><span class="header4"><b>Semifinal <?=$match?></b></span><br><br></td>
			</tr>
<?php
			echo '<tr';
			// Används för att kolla om man "glömt" tippa på nån match, i så fall skall hela den TR'n bli röd. 
			//(err=true säger åt dig att något inte har tippats, används säkert senare.....
			if(!empty($_SESSION['match']) && ($_SESSION['match'][$matchnumber][0] == '')) {
				echo ' style="background-color: #FF0000;"';
				$err = true;
			}
			echo '><td align="center">'.($matchnumber).'</td>'.
			'<td align="center"> Vinnare kvartsfinal '. $winner[$match][0] .
			'</td>'.
			'<td align="center"> - </td>'.
			'<td align="center"> Vinnare kvartsfinal '. $winner[$match][1] .
			'</td>'.		
			'<td align="center"><input type="radio" class=radio name="match['.($matchnumber).'][0]" value="1"';
			if(isset($_SESSION['match']) && $_SESSION['match'][$matchnumber][0] == '1') // används för att kolla med tippningen som ligger i sessionen om man tippat "etta"
				echo ' checked';
			echo '></td>'.
			'<td align="center"> - </td>'.
			'<td align="center"><input type="radio" class=radio name="match['.($matchnumber).'][0]" value="2"';
			if(isset($_SESSION['match']) && $_SESSION['match'][$matchnumber][0] == '2') // används för att kolla med tippningen som ligger i sessionen om man tippat "två"
				echo ' checked';
			echo '></td>'.
			'</tr>';
			echo '<tr><td colspan=7 align=center><hr align=center style="width:96%; height:1px;" color="#6C261F"></td></tr>';	
		}
		echo '</table><br><br><br>';
// -------------------------------------------------------- SEMI SLUT ----------------------------

// ------------------------ SECOND FINAL -----------------------------------
		if (1)	{
			echo '<h3>Match om tredjeplats</h3>';
			echo '<table border=0 cellspacing=0 cellpadding=2>';
			echo '<tr class="header"><td align=right>Match</td><td width=150 align=center>Hemma</td><td>-</td><td width=150 align=center>Borta</td><td align=center>1</td><td align=center>-</td><td align=center>2</td></tr>';
			$hamtahemma = mysqli_query($opendb, "SELECT * FROM lag WHERE id <= '8' '%' ORDER BY lag;");
			$hamtaborta = mysqli_query($opendb, "SELECT * FROM lag WHERE id >= '9' && id <= '16' '%' ORDER BY lag;");

			$matchfinal = $secondFinalId;
			echo '<tr';
			if(!empty($_SESSION['match']) && ($_SESSION['match'][$matchfinal][0]=='' || $_SESSION['match'][$matchfinal][1]=='' || $_SESSION['match'][$matchfinal][2]=='')) {
				echo ' style="background-color: #FF0000;"';
				$err = true;
			}
			echo '><td align="center">'.$matchfinal.'</td>'.
			'<td><select style="width:100%;" name="match['.$matchfinal.'][1]">'.
			'<option value="">-- Välj lag --';
			$allTeams = mysqli_query($opendb, "SELECT * FROM lag ORDER BY lag;");
			while($alag = mysqli_fetch_array($allTeams,MYSQLI_ASSOC)) {
				echo '<option value="'.$alag['lag'].'"';
				if(isset($_SESSION['match']) && $_SESSION['match'][$matchfinal][1] == $alag['lag'])
					echo ' selected';
				echo '>'.$alag['countryName_sv'];
			}
			echo	'</select>'.
			'</td>'.
			'<td align="center"> - </td>'.
			'<td><select style="width:100%;" name="match['.$matchfinal.'][2]">'.
			'<option value="">-- Välj lag --';
			$allTeams = mysqli_query($opendb, "SELECT * FROM lag ORDER BY lag;");
			while($blag = mysqli_fetch_array($allTeams,MYSQLI_ASSOC)) {
				echo '<option value="'.$blag['lag'].'"';
				if(isset($_SESSION['match']) && $_SESSION['match'][$matchfinal][2] == $blag['lag'])
					echo ' selected';
				echo '>'.$blag['countryName_sv'];
			}
			echo	'</select>'.
			'</td>'.
			'<td align="center"><input type="radio" class=radio name="match['.$matchfinal.'][0]" value="1"';
			if(isset($_SESSION['match']) && $_SESSION['match'][$matchfinal][0] == '1')
				echo ' checked';
			echo '></td>'.
			'<td align="center"> - </td>'.
			'<td align="center"><input type="radio" class=radio name="match['.$matchfinal.'][0]" value="2"';
			if(isset($_SESSION['match']) && $_SESSION['match'][$matchfinal][0] == '2')
				echo ' checked';
			echo '></td>'.
			'</tr>';
			echo '<tr><td></td><td>Förlorare semifinal 1</td><td></td><td>Förlorare semifinal 2</td></tr>';	
			echo '<tr><td colspan=7 align=center><hr align=center style="width:96%; height:1px;" color="#6C261F"></td></tr>';	
			echo '</table><br><br><br>';
		}
// ------------------------ SECOND FINAL ----------------------------------- SLUT

// ------------------------ FINAL -----------------------------------
?>

		<h2>Final</h2>
		<table border=0 cellspacing=0 cellpadding=2>
			<tr class="header">
			<td align="right">Match</td>
			<td width=150 align="center">Hemma</td>
			<td>-</td><td width=150 align="center">Borta</td>
			<td align="center">1</td>
			<td align="center">-</td>
			<td align="center">2</td>
		</tr>
<?php

	//$hamtahemma = mysqli_query("SELECT * FROM lag WHERE id <= '8' '%' ORDER BY lag;");
	//$hamtaborta = mysqli_query("SELECT * FROM lag WHERE id >= '9' && id <= '16' '%' ORDER BY lag;");

		$matchfinal = $finalId;
		echo '<tr';
		if(isset($_SESSION['match']) && ($_SESSION['match'][$matchfinal][0]=='' || $_SESSION['match'][$matchfinal][1]=='' || $_SESSION['match'][$matchfinal][2]=='')) {
			echo ' style="background-color: #FF0000;"';
			$err = true;
		}
		echo '><td align="center">'.$matchfinal.'</td>'.
		'<td><select style="width:100%;" name="match['.$matchfinal.'][1]">'.
		'<option value="">-- Välj lag --';
		$allTeams = mysqli_query($opendb, "SELECT * FROM lag ORDER BY lag;");
		while($alag = mysqli_fetch_array($allTeams,MYSQLI_ASSOC)) {
			echo '<option value="'.$alag['lag'].'"';
			if(isset($_SESSION['match']) && $_SESSION['match'][$matchfinal][1] == $alag['lag'])
				echo ' selected';
			echo '>'.$alag['countryName_sv'];
		}
		echo '</select>'.
		'</td>'.
		'<td align="center"> - </td>'.
		'<td><select style="width:100%;" name="match['.$matchfinal.'][2]">'.
		'<option value="">-- Välj lag --';
		$allTeams = mysqli_query($opendb, "SELECT * FROM lag ORDER BY lag;");
		while($blag = mysqli_fetch_array($allTeams,MYSQLI_ASSOC)) {
			echo '<option value="'.$blag['lag'].'"';
			if(isset($_SESSION['match']) && $_SESSION['match'][$matchfinal][2] == $blag['lag'])
				echo ' selected';
			echo '>'.$blag['countryName_sv'];
		}
		echo	'</select>'.
		'</td>'.		
		'<td align="center"><input type="radio" class=radio name="match['.$matchfinal.'][0]" value="1"';
		if(isset($_SESSION['match']) && $_SESSION['match'][$matchfinal][0] == '1')
			echo ' checked';
		echo '></td>'.
		'<td align="center"> - </td>'.
		'<td align="center"><input type="radio" class=radio name="match['.$matchfinal.'][0]" value="2"';
		if(isset($_SESSION['match']) && $_SESSION['match'][$matchfinal][0] == '2')
			echo ' checked';
		echo '></td>'.
		'</tr>';
		echo '<tr><td></td><td>Vinnare semifinal 1</td><td></td><td>Vinnare semifinal 2</td></tr>';	
		echo '<tr><td colspan=7 align=center><hr align=center style="width:96%; height:1px;" color="#6C261F"></td></tr>';
		echo '</table><br><br><br>';

// ------------------------ FINAL ----------------------------------- SLUT
		if (isset($_SESSION['match'])) {
?>
			<h2>Extrafrågor</h2>
			<table border=0 cellspacing=0 cellpadding=2>
			<tr><td></td><td>Hur många mål gör Sverige?:</td><td>
			<td colspan="2"><input type="text" size="3" maxlength="3" name="match[swedishGoals]" value="<?=$_SESSION['match']['swedishGoals'];?>"
<?php
		}

		if (isset($_SESSION['match'])) {
			if(!empty($_SESSION['match']) && $_SESSION['match']['swedishGoals'] == '') {
				echo ' style="background-color: #FF0000;"';
				$err = true;
			}
		}

		if (isset($_SESSION['match'])) {
?>
			</td></tr>
			<tr><td></td><td>Vilken spelare, för- och efternamn, gör flest mål i turneringen:</td><td>
			<td colspan="2"><input type="text" size="30" maxlength="30" name="match[topScorer]" value="<?=$_SESSION['match']['topScorer'];?>"
<?php
		}

		if(!empty($_SESSION['match']) && $_SESSION['match']['topScorer'] == '') {
			echo ' style="background-color: #FF0000;"';
			$err = true;    
		}       
?>
		></td></tr>
		</table><br><br><br>

<?php
		if($err){
			echo '<tr><td colspan=7 align="center"><span style="color: #FF0000; font-size: 14px; font-weight: bold;">DU HAR GLÖMT ATT FYLLA I NÅGOT!</span></td></tr>';	
		}
?>
		<tr>
		<td colspan=7 align="center"><hr align="center" style="width:96%; height:1px;" color="#6C261F"></td>
		</tr>
		<tr>
		<td colspan=7 align="right"><input type="button" class="btn" value="Skicka tippning!" onClick="this.form.action='index.php?sida=tippning'; this.form.submit();"></td>
		</tr>
		</td>
		</tr>
		</table>
<?php
		}
?>
