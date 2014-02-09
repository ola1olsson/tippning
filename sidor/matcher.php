<? 

function getGameId($gameId) {
	if ($_SESSION['admin']) {
		return '<a href="index.php?sida=putresult&gameId='.$gameId.'">'.$gameId.'</a>';
	} else {
		return $gameId;
	}
}
function printTitle($title) {
	echo '<tr>
			<td align="center" colspan="7">
				<span class="header2">'.$title.'<br/</span>
			</td>
		</tr>';
}
function printGroupTitle($groupId) {
	echo '<tr>
			<td align="center" colspan="7">
				<span class="header3">Grupp '.$groupId.'<br/</span>
			</td>
		</tr>';
}
function printHeaders() {
	echo '<tr class="header">
			<td align="right">Match</td>
			<td align="right">Hemma</td>
			<td>-</td>
			<td align="left">Borta</td>
			<td align="center">Datum</td>
			<td align="center">Klockan</td>
			<td align="right">Plats</td>
		</tr>';
}
function printGame($game, $home, $gone, $arena) {
	echo '<tr>
			<td valign="middle" align="center">'.getGameId($game['ID']).'</td>
			<td valign="middle" align="right">'.$home['countryName_sv'].'&nbsp;';
	echo $game['hemma'] != '' ? '<img src="./pic/flaggor/'.$home['flagImage'].'" align="absmiddle" />' : '?';
	echo '</td>
			<td valign="middle" align="center"> - </td>
			<td valign="middle" align="left">';
	echo $game['borta'] != '' ? '<img src="./pic/flaggor/'.$gone['flagImage'].'" align="absmiddle" />' : '?';
	echo '&nbsp;'.$gone['countryName_sv'].'</td>
			<td valign="middle" align="center">'.$game['datum'].'</td>
			<td valign="middle" align="center">'.$game['tid'].'</td>
			<td valign="middle" align="right">'.$arena['arena'].', '.$arena['location'].'</td>
		</tr>';
}

function printDivider() {
	echo '<tr>
			<td colspan="7" align="center">
				<hr align="center" />
			</td>
		</tr>';
}

if($_SESSION['permission'] == 1)
{
	
$eights = mysql_query("SELECT * FROM matcher WHERE ID > ".$grundspel_max." AND ID <= ".$eights_max." ORDER BY ID ASC;") or die(mysql_error());
$kvarts = mysql_query("SELECT * FROM matcher WHERE ID > ".$eights_max." AND ID <= ".$quarter_max." ORDER BY ID ASC;") or die(mysql_error());
$semis = mysql_query("SELECT * FROM matcher WHERE ID > ".$quarter_max." AND ID <= ".$semi_max." ORDER BY ID ASC;") or die(mysql_error());
$thirdPlaceFinal = mysql_fetch_array(mysql_query("SELECT * FROM matcher WHERE ID = ".$secondFinalId.";"));
$final = mysql_fetch_array(mysql_query("SELECT * FROM matcher WHERE ID = ".$finalId.";"));

?>
<span class="header">Matcher<br/></span>
<table border="0" cellspacing="5" cellpadding="0">
<?php 
//---------------------------------------------------------- GRUNDSPELSMATCHERNA ----------------------------------------------------
printTitle('Gruppspel');
printHeaders();
foreach($grundspel AS $grupp) {
	$matcher = mysql_query("SELECT * FROM matcher WHERE hemma LIKE '".$grupp."%' AND borta LIKE '".$grupp."%' ORDER BY ID ASC;") or die(mysql_error());
	printGroupTitle($grupp);
	while($match = mysql_fetch_array($matcher)) {
		$hemma = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['hemma']."';"), MYSQL_ASSOC);
		$borta = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['borta']."';"), MYSQL_ASSOC);
		$arena = mysql_fetch_array(mysql_query("SELECT arena.* FROM arena,matcher WHERE matcher.plats = arena.id && matcher.plats = '".$match['plats']."';"), MYSQL_ASSOC);
		printGame($match, $hemma, $borta, $arena);	
	}
	printDivider();
}

//---------------------------------------------------------- ÅTTONDELSFINALERNA ----------------------------------------------------
printTitle('Åttondelsfinaler');
printHeaders();
while($match = mysql_fetch_array($eights, MYSQL_ASSOC)) {
	$hemma = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['hemma']."';"), MYSQL_ASSOC);
	$borta = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['borta']."';"), MYSQL_ASSOC);
	$arena = mysql_fetch_array(mysql_query("SELECT arena.* FROM arena,matcher WHERE matcher.plats = arena.id && matcher.plats = '".$match['plats']."';"), MYSQL_ASSOC);
	printGame($match, $hemma, $borta, $arena);
}
printDivider();

//---------------------------------------------------------- KVARTSFINALERNA ----------------------------------------------------
printTitle('Kvartsfinaler');
printHeaders();
while($match = mysql_fetch_array($kvarts, MYSQL_ASSOC)) {
	$hemma = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['hemma']."';"), MYSQL_ASSOC);
	$borta = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['borta']."';"), MYSQL_ASSOC);
	$arena = mysql_fetch_array(mysql_query("SELECT arena.* FROM arena,matcher WHERE matcher.plats = arena.id && matcher.plats = '".$match['plats']."';"), MYSQL_ASSOC);
	printGame($match, $hemma, $borta, $arena);
}
printDivider();

//---------------------------------------------------------- SEMIFINALERNA ----------------------------------------------------
printTitle('Semifinaler');
printHeaders();
while($match = mysql_fetch_array($semis, MYSQL_ASSOC)) {
	$hemma = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['hemma']."';"), MYSQL_ASSOC);
	$borta = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['borta']."';"), MYSQL_ASSOC);
	$arena = mysql_fetch_array(mysql_query("SELECT arena.* FROM arena,matcher WHERE matcher.plats = arena.id && matcher.plats = '".$match['plats']."';"), MYSQL_ASSOC);
	printGame($match, $hemma, $borta, $arena);
}
printDivider();

//---------------------------------------------------------- THIRD PLACE FINAL ----------------------------------------------------
printTitle('Match om tredjeplats');
printHeaders();
$match = $thirdPlaceFinal;
$hemma = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['hemma']."';"), MYSQL_ASSOC);
$borta = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['borta']."';"), MYSQL_ASSOC);
$arena = mysql_fetch_array(mysql_query("SELECT arena.* FROM arena,matcher WHERE matcher.plats = arena.id && matcher.plats = '".$match['plats']."';"), MYSQL_ASSOC);
printGame($match, $hemma, $borta, $arena);
printDivider();

//---------------------------------------------------------- FINAL ----------------------------------------------------
printTitle('Final');
printHeaders();
$match = $final;
$hemma = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['hemma']."';"), MYSQL_ASSOC);
$borta = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$match['borta']."';"), MYSQL_ASSOC);
$arena = mysql_fetch_array(mysql_query("SELECT arena.* FROM arena,matcher WHERE matcher.plats = arena.id && matcher.plats = '".$match['plats']."';"), MYSQL_ASSOC);
printGame($match, $hemma, $borta, $arena);

?>
</table>
<?
} else {
	echo 'Permission denied!';
}
	
?>
