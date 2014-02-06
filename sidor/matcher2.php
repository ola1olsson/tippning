<table BGCOLOR="#FFFFFF" width="100%" height="100%" frame="rhs" border="1" bordercolor="#6C261F"  cellpadding="0" cellspacing="0">
<tr>
<td align="center">

<? 

if($_SESSION['permission'] == 1)
{

include "config.php";
include "connect_database.php";

$grundspel = Array('A','B','C','D'/*,'E','F','G','H'*/);
// $eights = mysql_query("SELECT * FROM matcher WHERE ID >= '49' AND ID <= '56' ORDER BY ID ASC;");
$kvarts = mysql_query("SELECT * FROM matcher WHERE ID >= '25' AND ID <= '28' ORDER BY ID ASC;");
$semis = mysql_query("SELECT * FROM matcher WHERE ID >= '29' AND ID <= '30' ORDER BY ID ASC;");
$finals = mysql_query("SELECT * FROM matcher WHERE ID >= '31' AND ID <= '31' ORDER BY ID ASC;");
?>



<span class="header"><br>Matcher<br></span><br>
<?
//---------------------------------------------------------- GRUNDSPELSMATCHERNA ----------------------------------------------------
?>
<span class="header">Gruppspelsmatcher<br><br></span>

<table border=0 cellspacing=0 cellpadding=2>
	<tr class="header">
		<td align="right">Match</td>
		<td align="right">Hemma</td>
		<td>-</td>
		<td align="left">Borta</td>
		<td align="center">Datum</td>
		<td align="center">Klockan</td>
		<td align="center">Plats</td>
	</tr>


<?
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
			<td valign="center" align="center"><?=$match['id']?></td>
			<td valign="center" align="right"><?=$hemma['land'] ?>&nbsp;<img src="./pic/flaggor/<?=$hemma['flagga']?>" align="absmiddle"></td>
			<td valign="center" align="center"> - </td>
			<td valign="center" align="left"><img src="./pic/flaggor/<?=$borta['flagga'] ?>" align="absmiddle">&nbsp;<?=$borta['land']?></td>
			<td valign="center" align="center"><?=$match['datum']?></td>
			<td valign="center" align="center"><?=$match['tid'];?></td>
			<td valign="center" align="center"><?=$match['plats'];?></td>
			</tr>
	<?		
	}
	?>
	<tr><td colspan=7 align="center"><hr align="center" style="width:96%; height:2px;" color="#6C261F"></td></tr>
<?	
}
?>
</table>
<br>
<br>
<br>

<?
//---------------------------------------------------------- GRUNDSPELSMATCHERNA SLUT ----------------------------------------------------

//---------------------------------------------------------- KVARTSFINALERNA ----------------------------------------------------
?>
<span class="header">Kvartsfinaler<br><br></span>

<table border=0 cellspacing=0 cellpadding=2>
	<tr class="header">
		<td align="right">Match</td>
		<td align="right">Hemma</td>
		<td>-</td>
		<td align="left">Borta</td>
		<td align="center">Datum</td>
		<td align="center">Klockan</td>
		<td align="center">Plats</td>
	</tr>

<?
while($kvart = mysql_fetch_array($kvarts, MYSQL_ASSOC)) {
		$hemma = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$kvart['hemma']."';"), MYSQL_ASSOC);
		$borta = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$kvart['borta']."';"), MYSQL_ASSOC);
?>
	<tr>
		<td valign="center" align="center"><?=$kvart['id']?></td>
		<td valign="center" align="right"><?=$hemma['land'] ?>&nbsp;<img src="./pic/flaggor/<?=$hemma['flagga']?>" align="absmiddle"></td>
		<td valign="center" align="center"> - </td>
		<td valign="center" align="left"><img src="./pic/flaggor/<?=$borta['flagga']?>" align="absmiddle">&nbsp;<?=$borta['land']?></td>
		<td valign="center" align="center"><?=$kvart['datum']?></td>
		<td valign="center" align="center"><?=$kvart['tid'];?></td>
		<td valign="center" align="center"><?=$kvart['plats'];?></td>
	</tr>
	<?		
	}
	?>
	<tr><td colspan=7 align="center"><hr align="center" style="width:96%; height:2px;" color="#6C261F"></td></tr>



</table>
<br>

<?
//---------------------------------------------------------- KVARTSFINALERNA SLUT ----------------------------------------------------

//---------------------------------------------------------- SEMIFINALERNA ----------------------------------------------------
?>

<span class="header">Semifinaler<br><br></span>

<table border=0 cellspacing=0 cellpadding=2>
	<tr class="header">
		<td align="right">Match</td>
		<td align="right">Hemma</td>
		<td>-</td>
		<td align="left">Borta</td>
		<td align="center">Datum</td>
		<td align="center">Klockan</td>
		<td align="center">Plats</td>
	</tr>

<?
while($semi = mysql_fetch_array($semis, MYSQL_ASSOC)) {
		$hemma = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$semi['hemma']."';"), MYSQL_ASSOC);
		$borta = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$semi['borta']."';"), MYSQL_ASSOC);
?>
	<tr>
		<td valign="center" align="center"><?=$semi['id']?></td>
		<td valign="center" align="right"><?=$hemma['land'] ?>&nbsp;<img src="./pic/flaggor/<?=$hemma['flagga']?>" align="absmiddle"></td>
		<td valign="center" align="center"> - </td>
		<td valign="center" align="left"><img src="./pic/flaggor/<?=$borta['flagga']?>" align="absmiddle">&nbsp;<?=$borta['land']?></td>
		<td valign="center" align="center"><?=$semi['datum']?></td>
		<td valign="center" align="center"><?=$semi['tid'];?></td>
		<td valign="center" align="center"><?=$semi['plats'];?></td>
	</tr>
	<?		
	}
	?>
	<tr><td colspan=7 align="center"><hr align="center" style="width:96%; height:2px;" color="#6C261F"></td></tr>



</table>
<br>

<?
//---------------------------------------------------------- SEMIFINALERNA SLUT ----------------------------------------------------

//---------------------------------------------------------- FINAL ----------------------------------------------------
?>

<span class="header">Final<br><br></span>

<table border=0 cellspacing=0 cellpadding=2>
	<tr class="header">
		<td align="right">Match</td>
		<td align="right">Hemma</td>
		<td>-</td>
		<td align="left">Borta</td>
		<td align="center">Datum</td>
		<td align="center">Klockan</td>
		<td align="center">Plats</td>
	</tr>

<?
while($final = mysql_fetch_array($finals, MYSQL_ASSOC)) {
		$hemma = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$final['hemma']."';"), MYSQL_ASSOC);
		$borta = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$final['borta']."';"), MYSQL_ASSOC);
?>
	<tr>
		<td valign="center" align="center"><?=$final['id']?></td>
		<td valign="center" align="right"><?=$hemma['land'] ?>&nbsp;<img src="./pic/flaggor/<?=$hemma['flagga']?>" align="absmiddle"></td>
		<td valign="center" align="center"> - </td>
		<td valign="center" align="left"><img src="./pic/flaggor/<?=$borta['flagga']?>" align="absmiddle">&nbsp;<?=$borta['land']?></td>
		<td valign="center" align="center"><?=$final['datum']?></td>
		<td valign="center" align="center"><?=$final['tid'];?></td>
		<td valign="center" align="center"><?=$final['plats'];?></td>
	</tr>
	<?		
	}
	?>
	<tr><td colspan=7 align="center"><hr align="center" style="width:96%; height:2px;" color="#6C261F"></td></tr>



</table>
<br>

<table border="1">
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>

<?
} else
	echo 'Permission denied!';
	
?>	
</td>
</tr>
</table>
