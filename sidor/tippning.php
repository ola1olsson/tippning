<?
if(!session_is_registered('permission') || !$_SESSION['permission']) {
	echo '<span class="header2">Permission denied!</span>';
//} else if ($_SESSION['betalt'] != 1) {
//	echo '<span class="header2">Vi har inte registrerat någon betalning för dig - du måste betala innan du får tippa!</span>';	
} else if ($cupStarted) {
	echo '<span class="header2">Kuppen har redan startat - du får inte längre tippa!</span>';	
} else {
//if(session_is_registered('permission') && $_SESSION['permission'] && (!$cupStarted || $_SESSION['admin'])) {
?>

<table BGCOLOR="#FFFFFF" border="0" width="100%" height="100%">
<tr>
<td align="center">

<br>
<span class="header4"><b>Tippningen</b></span>
<br>
<br>

<?
if ($_SESSION['betalt'] != 1) { ?>
   <span style="color: red;">
      <b>VARNING!<br/></b>
     Du har ännu inte betalt, och i vanliga fall får du då inte tippa. Detta året gör vi ett undantag då vi har varit sena 
     ut med sajten. Du har chans att lägga din tippning fram till <?= $last_bet_day ?>, sen stänger vi slussarna, men är inte betalning gjord innan <?= $last_pay_day ?> så kommer din användare att tas bort.
     <br/>
     <br/>
   </span>
<? }

$grundspel_max = 48; // 1-48
$eights_max = $grundspel_max + 8; // 49 - 56
$quarter_max = $eights_max + 4; // 57 - 60
$semi_max = $quarter_max + 2; // 61 - 62
$secondFinalId = $semi_max + 1; // 63
$finalId = $secondFinalId + 1; // 64

$slutspel_max = $finalId; // 64

$err = false;

//----------------------------------------------------------------------------------------------------------------------
if(isset($_POST['match'])) { 
	$_SESSION['match'] = $_POST['match'];
	for($i=1; $i<=$grundspel_max; $i++) {
		if($_SESSION['match'][$i] == '') 
			$err = true;	
			
	}
	for($i= $grundspel_max + 1; $i<=$slutspel_max; $i++) {
		if($_SESSION['match'][$i][0]=='' || $_SESSION['match'][$i][1]=='' || $_SESSION['match'][$i][2]=='')
			$err = true;	
	}		
	
	//echo 'ERRORS FOUND: ';
	//if($err) 
	//	echo 'YES';
	//else
	//	echo 'NO';
	echo '<br><br>';
	
//----------------------------------------------------------------------------------------------------------------------	
//																									
} else {	
	$restip = mysql_query("SELECT * FROM tippning WHERE id = ".$_SESSION['userID'].";") or die(mysql_error());
	if($tipp = mysql_fetch_array($restip, MYSQL_ASSOC)) {
		for($i=1; $i<=$grundspel_max; $i++) {
			$debug .= 'm'.$i.'='.$tipp['m'.$i].',';
			$_SESSION['match'][$i] = $tipp['m'.$i];	
		}
		for($i=$grundspel_max + 1; $i<=$slutspel_max; $i++) {
			$_SESSION['match'][$i][0] = $tipp['m'.$i];
			$_SESSION['match'][$i][1] = $tipp['m'.$i.'a'];
			$_SESSION['match'][$i][2] = $tipp['m'.$i.'b'];
		}
	}
}

//----------------------------------------------------------------------------------------------------------------------	
// 																								REGISTRERA I DATABASEN
if(isset($_POST['match']) && !$err && date('Y-m-d')<=$last_bet_day) {
	// REGISTRERA I DATABASEN	
	/** PRINT POST
	
	for($i=1; $i<=48; $i++) {
		echo 'M'.$i.': '.$_SESSION['match'][$i].'<br>';	
	}
	for($i=49; $i<=64; $i++) {
		echo 'M'.$i.': '.$_SESSION['match'][$i][0].'<br>';
		echo 'M'.$i.'A: '.$_SESSION['match'][$i][1].'<br>';	
		echo 'M'.$i.'B: '.$_SESSION['match'][$i][2].'<br>';			
	}
	echo 'M65: '.$_SESSION['match'][65].'<br>';	
	echo 'M66: '.$_SESSION['match'][66].'<br>';	
	echo 'M67A: '.$_SESSION['match'][67][0].'<br>';	
	echo 'M67B: '.$_SESSION['match'][67][1].'<br>';	
	*/

	// INSERT INTO DATABASE
	$user_chk = mysql_query("SELECT id FROM tippning WHERE id = ".$_SESSION['userID'].";") or die(mysql_error());
	if(mysql_num_rows($user_chk) > 0) {
		// UPDATE TIP IN DATABASE	
		$query = "UPDATE tippning SET ";
		for($i=1; $i<=$grundspel_max; $i++) {
			 $query .= "m".$i."='".$_SESSION['match'][$i]."', ";
		}
		for($i=$grundspel_max + 1; $i<=$slutspel_max; $i++) {
			$query .= "m".$i."='".$_SESSION['match'][$i][0]."', ";
			$query .= "m".$i."a='".$_SESSION['match'][$i][1]."', ";
			$query .= "m".$i."b='".$_SESSION['match'][$i][2]."'";
			if ($i != $slutspel_max) {
				$query .= ", ";
			}
		}
		
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
		$query .= ') VALUES (';
		$query .= "'".$_SESSION['userID']."'";
		for($i=1; $i<=$grundspel_max; $i++) {
			$query.= ", '".$_SESSION['match'][$i]."'";	
		}
		for($i=$grundspel_max + 1; $i<=$slutspel_max; $i++) {
			for($k=0; $k<=2; $k++)
				$query .= ", '".$_SESSION['match'][$i][$k]."'";		
		}
		$query .= ');';
		
		
	}
	mysql_query($query) or die(mysql_error());
	echo '<span class="header2">Tippning registrerad!<br></span><br><input type=button class=btn value="Ok!" onClick="document.location=\'index.php?sida=tippning\';">';
	
} else {

// -----------------------------------------GRUNDSPEL-----------------------------------------
echo '<h3>Gruppspel</h3>';


$grundspel = Array('A','B','C','D','E','F','G','H');
foreach($grundspel AS $grupp) {
	$matcher = mysql_query("SELECT * FROM matcher WHERE hemma LIKE '".$grupp."%' AND borta LIKE '".$grupp."%' ORDER BY ID ASC;") or die(mysql_error());
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
<?	
	while($match = mysql_fetch_array($matcher, MYSQL_ASSOC)) {
		// Kolumn 'lag' är skönt - 2014 fixa sig!
		$hemma = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['hemma']."';"), MYSQL_ASSOC);
		$borta = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['borta']."';"), MYSQL_ASSOC);
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
		<?
		if($_SESSION['match'][$match['ID']] == '1') 
		echo ' checked';
		?>
		>
		</td>
		<td align="center"><input type="radio" class="radio" name="<?='match['.$match['ID'].']'?>" value="X"
		<?
		if($_SESSION['match'][$match['ID']] == 'X') 
			echo ' checked';
		?>
		>
		</td>
		<td align="center"><input type="radio" class="radio" name="<?='match['.$match['ID'].']'?>" value="2"
		<?
		if($_SESSION['match'][$match['ID']] == '2') 
			 echo ' checked';
		?>
		>
		</td>
	</tr>
	<?
	}
	?>
	<tr>
		<td colspan=7 align="center"><hr align="center" style="width:96%; height:1px;" color="#6C261F"></td>
	</tr>
	</table>
<br>
<?
}
// -----------------------------------------GRUNDSPEL SLUT------------------------------------



// -----------------------------------------ÅTTONDEL BÖRJAR -------------------------------------

?>

<h3>Åttondelsfinaler</h3>

<table border="0" cellspacing="0" cellpadding="2">
	<tr class="header">
		<td align="right">Match</td>
		<td width=150 align="center">Hemma</td>
		<td>-</td>
		<td width=150 align="center">Borta</td>
		<td align="center">1</td>
		<td align="center">-</td>
		<td align="center">2</td>
	</tr>
<?
/**
	groups förklaring:
	groups[i] -> i = gruppnummer
	groups[i][k] -> k(0) = hemma, k(1) = borta
*/

$groups[1][0] = 'A';
$groups[1][1] = 'B';
$groups[2][0] = 'C';
$groups[2][1] = 'D';
$groups[3][0] = 'E';
$groups[3][1] = 'F';
$groups[4][0] = 'G';
$groups[4][1] = 'H';
$groups[5][0] = 'B';
$groups[5][1] = 'A';
$groups[6][0] = 'D';
$groups[6][1] = 'C';
$groups[7][0] = 'F';
$groups[7][1] = 'E';
$groups[8][0] = 'H';
$groups[8][1] = 'G';

$nbr_eight_games = 8;

$match_offset = $grundspel_max; // sista matchnumret i gruppspelet
$err = false;
for($match = 1; $match <= $nbr_eight_games; $match++) {
	$hamtahemma = mysql_query("SELECT * FROM lag WHERE lag LIKE '".$groups[$match][0]."%';");
	$hamtaborta = mysql_query("SELECT * FROM lag WHERE lag LIKE '".$groups[$match][1]."%';");
	
	$matchnumber = $match + $match_offset;
?>	
	
	<tr>
		<td colspan="7" align="center"><span class="header4"><b>Åttondelsfinal <?=$match?></b></span><br><br></td>
	</tr>
	<tr
<?	// kollar så att just denna match blivit tippad, annars färgar vi hela TR'n röööööööd
	if(!empty($_SESSION['match']) && ($_SESSION['match'][$matchnumber][0] == '' || $_SESSION['match'][$matchnumber][1] == '' || $_SESSION['match'][$matchnumber][2] == '')) {
		echo '  style="background-color: #FF0000;"';
		$err = true;
	}
?>	>
		<td align="center"><?=$matchnumber?></td>
		<td><select style="width:100%;" name="<?='match['.$matchnumber.'][1]'?>">
			<option value="">---- Välj lag ----
			
<?			
			while($alag = mysql_fetch_array($hamtahemma,MYSQL_ASSOC)) {
				echo '<option value="'.$alag['lag'].'"'; // här kan du använda ID istället om du vill, så länge du använder samma attribut som när du skall spara det i databasen
				if($_SESSION['match'][$matchnumber][1] == $alag['lag']) 
					echo ' selected';
				echo '>'.$alag['countryName_sv'];
			}
?>
			</select>
		</td>
		<td align="center"> - </td>
		<td><select style="width:100%;" name="<?='match['.$matchnumber.'][2]'?>">
			<option value="">---- Välj lag ----
<?
			while($blag = mysql_fetch_array($hamtaborta,MYSQL_ASSOC)) {
				echo '<option value="'.$blag['lag'].'"';
				if($_SESSION['match'][$matchnumber][2] == $blag['lag']) 
					echo ' selected';
				echo '>'.$blag['countryName_sv'];
			}
?>
			</select>
		</td>
		<td align="center"><input type="radio" class="radio" name="<?='match['.$matchnumber.'][0]'?>" value="1"
<?
	// kolla om matchen redan är tippad (och isf sparad i sessionen), i så fall skall rätt tippning "checkas"
	if($_SESSION['match'][$matchnumber][0] == '1') echo ' checked';		
?>
		>
		</td>
		<td align="center"> - </td>
		<td align="center"><input type="radio" class="radio" name="<?='match['.$matchnumber.'][0]'?>" value="2"
<?
	if($_SESSION['match'][$matchnumber][0] == '2') echo ' checked';	
?>
		>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>Vinnare grupp <?=$groups[$match][0]?></td>
		<td></td>
		<td>Andraplats grupp <?=$groups[$match][1]?></td>
	</tr>	
	<tr>
	<td colspan=7 align="center"><hr align="center" style="width:96%; height:1px;" color="#6C261F"></td>
	</tr>	
<?
}
?>

</table>
<br>
<br>
<br>
<?
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
	
<?
// OPTIMERADE KVARTAR

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

$winner[1][0] = 1;
$winner[1][1] = 2;
$winner[2][0] = 3;
$winner[2][1] = 4;
$winner[3][0] = 5;
$winner[3][1] = 6;
$winner[4][0] = 7;
$winner[4][1] = 8;

$nbr_quarters = 4;
$match_offset = $eights_max; // Sista matchen av åttondelsfinalerna + 1 = första kvartsfinalen

for($match = 1; $match <= $nbr_quarters; $match++) {

	/**
	hamtahemma = (första iterationen) alla lag som ligger i grupp A eller grupp B
	hamtaborta = (första iterationen) alla lag som ligger i grupp C eller grupp D
	*/
	$hamtahemma = mysql_query("SELECT * FROM lag WHERE lag LIKE '".$groups[$match][0][0]."%' OR lag LIKE '".$groups[$match][0][1]."%' ORDER BY lag;");
	$hamtaborta = mysql_query("SELECT * FROM lag WHERE lag LIKE '".$groups[$match][1][0]."%' OR lag LIKE '".$groups[$match][1][1]."%' ORDER BY lag;");
	
	$matchnumber = $match + $match_offset;
?>	
	<tr>
	<td colspan="7" align="center"><span class="header4"><b>Kvartsfinal <?=$match?></b></span><br><br></td>
	</tr>
	
	
<?	
	echo '<tr';
	// Används för att kolla om man "glömt" tippa på nån match, i så fall skall hela den TR'n bli röd. 
	//(err=true säger åt dig att något inte har tippats, används säkert senare..... 2014? Nu tänker du - "Ja!"
	if(!empty($_SESSION['match']) && ($_SESSION['match'][$matchnumber][0] == '' || $_SESSION['match'][$matchnumber][1] == '' || $_SESSION['match'][$matchnumber][2] == '')) 
	{
		echo ' style="background-color: #FF0000;"';
		$err = true;
	}
	echo '><td align="center">'.($matchnumber).'</td>'.
			'<td><select style="width:100%;" name="match['.($matchnumber).'][1]">'.
			'<option value="">-- Välj lag --';
			while($alag = mysql_fetch_array($hamtahemma,MYSQL_ASSOC)) {
				echo '<option value="'.$alag['lag'].'"';
				if($_SESSION['match'][$matchnumber][1] == $alag['lag']) // Detta kommer att användas om användaren redan tippat (dvs tippningen har sparats i sessionen)
					echo ' selected'; // ...isf sätter vi den till selected
				echo '>'.$alag['countryName_sv'];
			}
	echo	'</select>'.
			'</td>'.
			'<td align="center"> - </td>'.
			'<td><select style="width:100%;" name="match['.($matchnumber).'][2]">'.
			'<option value="">-- Välj lag --';
			while($blag = mysql_fetch_array($hamtaborta,MYSQL_ASSOC)) {
				echo '<option value="'.$blag['lag'].'"';
				if($_SESSION['match'][$matchnumber][2] == $blag['lag'])
					echo ' selected';
				echo '>'.$blag['countryName_sv'];
			}
	echo	'</select>'.
			'</td>'.		
			'<td align="center"><input type="radio" class=radio name="match['.($matchnumber).'][0]" value="1"';
	if($_SESSION['match'][$matchnumber][0] == '1') // används för att kolla med tippningen som ligger i sessionen om man tippat "etta"
		echo ' checked';
	echo '></td>'.
			'<td align="center"> - </td>'.
			'<td align="center"><input type="radio" class=radio name="match['.($matchnumber).'][0]" value="2"';
	if($_SESSION['match'][$matchnumber][0] == '2') // används för att kolla med tippningen som ligger i sessionen om man tippat "tvåa"
		echo ' checked';
	echo '></td>'.
			'</tr>';
	echo '<tr><td></td><td>Vinnare åttondelsfinal '.$winner[$match][0].'</td><td></td><td>Vinnare åttondelsfinal '.$winner[$match][1].'</td></tr>';	
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
	
<?

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
$groups[2][3][0] = 'C';
$groups[2][3][1] = 'G';

$winner[1][0] = 1;
$winner[1][1] = 2;
$winner[2][0] = 3;
$winner[2][1] = 4;

$nbr_semis = 2;
$match_offset = $quarter_max; // sista matchen i kvartarna (+ 1 = första semin)

for($match = 1; $match <= $nbr_semis; $match++) {

	$hamtahemma = mysql_query("SELECT * FROM lag WHERE lag LIKE '".$groups[$match][0][0]."%' OR lag LIKE '".$groups[$match][1][0]."%' OR lag LIKE '".$groups[$match][2][0]."%' OR lag LIKE '".$groups[$match][3][0]."%' ORDER BY lag;");
	$hamtaborta = mysql_query("SELECT * FROM lag WHERE lag LIKE '".$groups[$match][0][1]."%' OR lag LIKE '".$groups[$match][1][1]."%' OR lag LIKE '".$groups[$match][2][1]."%' OR lag LIKE '".$groups[$match][3][1]."%' ORDER BY lag;");
	
	$matchnumber = $match + $match_offset;
?>	
	<tr>
	<td colspan="7" align="center"><span class="header4"><b>Semifinal <?=$match?></b></span><br><br></td>
	</tr>
	
	
<?	
	echo '<tr';
	// Används för att kolla om man "glömt" tippa på nån match, i så fall skall hela den TR'n bli röd. 
	//(err=true säger åt dig att något inte har tippats, används säkert senare.....
	if(!empty($_SESSION['match']) && ($_SESSION['match'][$matchnumber][0] == '' || $_SESSION['match'][$matchnumber][1] == '' || $_SESSION['match'][$matchnumber][2] == '')) 
	{
		echo ' style="background-color: #FF0000;"';
		$err = true;
	}
	echo '><td align="center">'.($matchnumber).'</td>'.
			'<td><select style="width:100%;" name="match['.($matchnumber).'][1]">'.
			'<option value="">-- Välj lag --';
			while($alag = mysql_fetch_array($hamtahemma,MYSQL_ASSOC)) {
				echo '<option value="'.$alag['lag'].'"';
				if($_SESSION['match'][$matchnumber][1] == $alag['lag']) // Detta kommer att användas om användaren redan tippat (dvs tippningen har sparats i sessionen)
					echo ' selected'; // ...isf sätter vi den till selected
				echo '>'.$alag['countryName_sv'];
			}
	echo	'</select>'.
			'</td>'.
			'<td align="center"> - </td>'.
			'<td><select style="width:100%;" name="match['.($matchnumber).'][2]">'.
			'<option value="">-- Välj lag --';
			while($blag = mysql_fetch_array($hamtaborta,MYSQL_ASSOC)) {
				echo '<option value="'.$blag['lag'].'"';
				if($_SESSION['match'][$matchnumber][2] == $blag['lag'])
					echo ' selected';
				echo '>'.$blag['countryName_sv'];
			}
	echo	'</select>'.
			'</td>'.		
			'<td align="center"><input type="radio" class=radio name="match['.($matchnumber).'][0]" value="1"';
	if($_SESSION['match'][$matchnumber][0] == '1') // används för att kolla med tippningen som ligger i sessionen om man tippat "etta"
		echo ' checked';
	echo '></td>'.
			'<td align="center"> - </td>'.
			'<td align="center"><input type="radio" class=radio name="match['.($matchnumber).'][0]" value="2"';
	if($_SESSION['match'][$matchnumber][0] == '2') // används för att kolla med tippningen som ligger i sessionen om man tippat "två"
		echo ' checked';
	echo '></td>'.
			'</tr>';
	echo '<tr><td></td><td>Vinnare kvartsfinal '.$winner[$match][0].'</td><td></td><td>Vinnare kvartsfinal '.$winner[$match][1].'</td></tr>';	
	echo '<tr><td colspan=7 align=center><hr align=center style="width:96%; height:1px;" color="#6C261F"></td></tr>';	

}

echo '</table><br><br><br>';


// -------------------------------------------------------- SEMI SLUT ----------------------------



// ------------------------ SECOND FINAL -----------------------------------

echo '<h3>Match om tredjeplats</h3>';
echo '<table border=0 cellspacing=0 cellpadding=2>';
echo '<tr class="header"><td align=right>Match</td><td width=150 align=center>Hemma</td><td>-</td><td width=150 align=center>Borta</td><td align=center>1</td><td align=center>-</td><td align=center>2</td></tr>';


		//$hamtahemma = mysql_query("SELECT * FROM lag WHERE id <= '8' '%' ORDER BY lag;");
		//$hamtaborta = mysql_query("SELECT * FROM lag WHERE id >= '9' && id <= '16' '%' ORDER BY lag;");

$matchfinal = $secondFinalId;
echo 'SecMatchfinal: "'.$matchfinal.'"<br/>';
echo '<tr';
if(!empty($_SESSION['match']) && ($_SESSION['match'][$matchfinal][0]=='' || $_SESSION['match'][$matchfinal][1]=='' || $_SESSION['match'][$matchfinal][2]=='')) {
	echo ' style="background-color: #FF0000;"';
	$err = true;	
}
echo '><td align="center">'.$matchfinal.'</td>'.
		'<td><select style="width:100%;" name="match['.$matchfinal.'][1]">'.
		'<option value="">-- Välj lag --';
		$allTeams = mysql_query("SELECT * FROM lag ORDER BY lag;");
		while($alag = mysql_fetch_array($allTeams,MYSQL_ASSOC)) {
			echo '<option value="'.$alag['lag'].'"';
			if($_SESSION['match'][$matchfinal][1] == $alag['lag'])
				echo ' selected';
			echo '>'.$alag['countryName_sv'];
		}
echo	'</select>'.
		'</td>'.
		'<td align="center"> - </td>'.
		'<td><select style="width:100%;" name="match['.$matchfinal.'][2]">'.
		'<option value="">-- Välj lag --';
		$allTeams = mysql_query("SELECT * FROM lag ORDER BY lag;");
		while($blag = mysql_fetch_array($allTeams,MYSQL_ASSOC)) {
			echo '<option value="'.$blag['lag'].'"';
			if($_SESSION['match'][$matchfinal][2] == $blag['lag'])
				echo ' selected';
			echo '>'.$blag['countryName_sv'];
		}
echo	'</select>'.
		'</td>'.		
		'<td align="center"><input type="radio" class=radio name="match['.$matchfinal.'][0]" value="1"';
		if($_SESSION['match'][$matchfinal][0] == '1')
			echo ' checked';
		echo '></td>'.
		'<td align="center"> - </td>'.
		'<td align="center"><input type="radio" class=radio name="match['.$matchfinal.'][0]" value="2"';
		if($_SESSION['match'][$matchfinal][0] == '2')
			echo ' checked';
		echo '></td>'.
		'</tr>';
echo '<tr><td></td><td>Förlorare semifinal 1</td><td></td><td>Förlorare semifinal 2</td></tr>';	
echo '<tr><td colspan=7 align=center><hr align=center style="width:96%; height:1px;" color="#6C261F"></td></tr>';	

echo '</table><br><br><br>';

// ------------------------ SECOND FINAL ----------------------------------- SLUT
		


// ------------------------ FINAL -----------------------------------

echo '<h3>Final</h3>';
echo '<table border=0 cellspacing=0 cellpadding=2>';
echo '<tr class="header"><td align=right>Match</td><td width=150 align=center>Hemma</td><td>-</td><td width=150 align=center>Borta</td><td align=center>1</td><td align=center>-</td><td align=center>2</td></tr>';


		//$hamtahemma = mysql_query("SELECT * FROM lag WHERE id <= '8' '%' ORDER BY lag;");
		//$hamtaborta = mysql_query("SELECT * FROM lag WHERE id >= '9' && id <= '16' '%' ORDER BY lag;");

$matchfinal = $finalId;
echo 'Matchfinal: "'.$matchfinal.'"<br/>';
echo '<tr';
if(!empty($_SESSION['match']) && ($_SESSION['match'][$matchfinal][0]=='' || $_SESSION['match'][$matchfinal][1]=='' || $_SESSION['match'][$matchfinal][2]=='')) {
	echo ' style="background-color: #FF0000;"';
	$err = true;	
}
echo '><td align="center">'.$matchfinal.'</td>'.
		'<td><select style="width:100%;" name="match['.$matchfinal.'][1]">'.
		'<option value="">-- Välj lag --';
		$allTeams = mysql_query("SELECT * FROM lag ORDER BY lag;");
		while($alag = mysql_fetch_array($allTeams,MYSQL_ASSOC)) {
			echo '<option value="'.$alag['lag'].'"';
			if($_SESSION['match'][$matchfinal][1] == $alag['lag'])
				echo ' selected';
			echo '>'.$alag['countryName_sv'];
		}
echo	'</select>'.
		'</td>'.
		'<td align="center"> - </td>'.
		'<td><select style="width:100%;" name="match['.$matchfinal.'][2]">'.
		'<option value="">-- Välj lag --';
		$allTeams = mysql_query("SELECT * FROM lag ORDER BY lag;");
		while($blag = mysql_fetch_array($allTeams,MYSQL_ASSOC)) {
			echo '<option value="'.$blag['lag'].'"';
			if($_SESSION['match'][$matchfinal][2] == $blag['lag'])
				echo ' selected';
			echo '>'.$blag['countryName_sv'];
		}
echo	'</select>'.
		'</td>'.		
		'<td align="center"><input type="radio" class=radio name="match['.$matchfinal.'][0]" value="1"';
		if($_SESSION['match'][$matchfinal][0] == '1')
			echo ' checked';
		echo '></td>'.
		'<td align="center"> - </td>'.
		'<td align="center"><input type="radio" class=radio name="match['.$matchfinal.'][0]" value="2"';
		if($_SESSION['match'][$matchfinal][0] == '2')
			echo ' checked';
		echo '></td>'.
		'</tr>';
echo '<tr><td></td><td>Vinnare semifinal 1</td><td></td><td>Vinnare semifinal 2</td></tr>';	
echo '<tr><td colspan=7 align=center><hr align=center style="width:96%; height:1px;" color="#6C261F"></td></tr>';	

echo '</table><br><br><br>';

// ------------------------ FINAL ----------------------------------- SLUT
		
if($err) {
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


<?
}

}
?>
