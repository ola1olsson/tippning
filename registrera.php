<?// Includerar uppkopling till MySQL-server.
include "config.php";
include "connect_database.php";
?>
<HTML>

<head>
<link href="css\styles.css" rel="stylesheet" type="text/css">
</head>
<?
// Om dagens datum inte �r mer 2010-11-06 s� �r det ok att registrera sig p� sidan.
if(date('Y-m-d')<=$last_bet_day) {
?>

<?
// ---------------------- Avtalet ----------------------------
/*
H�rmed godk�nner jag att mina personuppgifter lagras i databasen.<br>
Jag �r inf�rst�dd med att jag kan bli utest�ngd fr�n systemet<br>
genom oacceptabelt upptr�dande eller fuskande och d�rmed g� miste<br>
om insatsen. Inbetalda pengar kan f�rloras genom d�lig tippning.<br>
Jag kommer att godta arrang�rsbeslut oavsett min egen vilja, <br>
samt erk�nna att jag �r d�lig p� att tippa.<br>
Jag vet att detta �r en sida f�r ett slutet s�llskap och att <br>
jag inte kan bjuda in vem som helst. <br>
D� Ola �r d�lig p� webbsidor s� m�ste jag �ven spara mina tips <br>
lokalt, g�rna skriva ut dem som backup om n�got skulle g� �t h*vete<br>
<br>
F�r att komma vidare m�ste du acceptera ovanst�ende villkor.<br>
*/
?>





<?


if($_REQUEST['register'] == 'true') {

	// REGISTRERA ANV�NDAREN	
	$result = mysql_query("SELECT username FROM users WHERE username='".addslashes($_POST['user'])."';") or die(mysql_error());
	
	//
	if(mysql_num_rows($result)>0 || $_POST['user'] == '') {
		$errUser = true;
	} else $errUser = false;


	// Kontroll om l�senordet st�mmer, Kontrollerar s� att man skrivit in samma l�senord tv� g�nger.
	if($_POST['password1'] != $_POST['password2'] || empty($_POST['password1']) || empty($_POST['password2'])) {
		$errPass = true;
	} else $errPass = false;
	
	
	// Om User och Password �r ok, forts�tt 
	if(!$errUser && !$errPass) {
		mysql_query("INSERT INTO users (givenName, familyName, Company, emailAddress, phoneNumber, city, username, password) 
					VALUES ('".addslashes($_POST['fornamn'])."', '".addslashes($_POST['efternamn'])."', '".addslashes($_POST['foretag'])."', '".addslashes($_POST['email'])."', '".addslashes($_POST['telefon'])."', '".addslashes($_POST['ort'])."', '".addslashes($_POST['user'])."', '".md5(addslashes($_POST['password1']))."');") or die(mysql_error());
	} 
	
} 

if(($_POST['register'] == 'true' && ($errUser || $errPass)) || !isset($_POST['register'])) {


?>

<table width="850"  border="5" bordercolor="981a25" align="center">
<tr> 
	<td height="100%">
	

<table width="850" height="600" background="pic\uefa_euro2008_logo.jpg" border="0" bordercolor="black" align="center">
	<tr> 
	<td height="325" colspan=4 valign="bottom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T�nk p� att inte anv�nda n�gra anv�ndarnamn & l�senord<br>
											   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;som du anv�nder t.ex. p� jobbet, till din mail m.m.<br>&nbsp;
		
		<tr>
		<form action="registrera.php" method="post" name="register">
		<td width="150" height="20"></td><td width="25">F�rnamn</td><td width="150"><input type="text" name="fornamn" value="<?=$_POST['fornamn'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="20"></td><td width="25">Efternamn</td><td width="150"><input type="text" name="efternamn" value="<?=$_POST['efternamn'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="20"></td><td width="25">Ort</td><td width="150"><input type="text" name="ort" value="<?=$_POST['ort'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="20"></td><td width="25">F�retag</td><td width="150"><input type="text" name="foretag" value="<?=$_POST['foretag'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="20"></td><td width="25">Mobiltel.</td><td width="150"><input type="text" name="telefon" value="<?=$_POST['telefon'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="20"></td><td width="25">Email</td><td width="150"><input type="text" name="email" value="<?=$_POST['email'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td height="30"></td></td><td width="25"></td><td valign="bottom"><B>Inloggningsuppgifter</B></td><td></td>
		</tr>

		<tr>
		<td width="150" height="25"></td><td width="25">Anv�ndarnamn</td><td width="150"><input type="text" name="user" value="<?=$_POST['user'];?>" style="width:145px;"></td>
		<td>
		<?
		// Det �r n�got som �r fel med anv�ndarnamnet. Tv� alternativ: 1.Du har inte skrivit in n�got anv�ndarnamn. 2.Du har skrivit in ett anv�ndarnamn som redan existerar.
		if($errUser) {
		echo '<span style="color:FF0000;">';
		if($_POST['user'] == '') 
		echo 'Du m�ste ange ett <br>anv�ndarnamn.';
		else 
		echo 'Anv�ndarnamnet \''.$_POST['user'].'\' <br>�r redan upptaget, prova ett nytt.';
		echo '</span>';
		}
		?>
		</td>
		</tr>
		
		<tr>
		<td width="150" height="25"></td><td width="25">L�senord</td><td width="150"><input type="password" name="password1" value="<?=$_POST['password1'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="25"></td><td width="25">Upprepa L�senord</td><td width="150"><input type="password" name="password2" value="<?=$_POST['password2'];?>" style="width:145px;"></td>
		<td>
		<?
		
		// Det �r n�got fel med l�senordet. Tv� alternativ: 1.Du har gl�mt att fylla i l�senord. 2.Du har skrivit in olika l�senord.
		if($errPass)
		{
		echo '<span style="color:FF0000;">';
		if (empty($_POST['password1']) || empty($_POST['password2']))
		echo 'Du m�ste ange ett l�senord.';
		else 
		echo 'Du har angivit tv� olika l�senord.<br>F�rs�k igen...';
		echo '</span>';
		}
		?>
		</td>
		</tr>
		
		<tr>
		<td width="150" height="25"></td><td width="25"></td><td width="150">
		<input type="hidden" name="register" value="true">
		<input type="submit" class="btn" value="N�sta"> &nbsp;&nbsp;&nbsp;
		<input type="button" onClick="history.back();" class="btn" value="Avbryt"></td><td></td>
		</tr>
		</form>
		
		<tr>
		<td height="100%" colspan=4></td>
		</tr>
	</td>
	</tr>
</table>

</td>
</tr>
</table>
<?
} else {

//	echo 'Du �r registrerad!';
//	echo 'DEBUG:'=$debug;
	?>
		
		
<table width="850"  border="5" bordercolor="981a25" align="center">
<tr> 
	<td height="100%">
	
		<table width="850" height="600" background="pic\uefa_euro2008_logo.jpg" border="0" bordercolor="black" align="center">
		<tr height="300" colspan=""2>
		<td></td>
		</tr>
		<tr>
			<td width="30" height="180"></td>
			<td>
H�rmed godk�nner jag att mina personuppgifter lagras i databasen.<br>
Jag �r inf�rst�dd med att jag kan bli utest�ngd fr�n systemet<br>
genom oacceptabelt upptr�dande eller fuskande och d�rmed g� miste<br>
om insatsen. Inbetalda pengar kan f�rloras genom d�lig tippning.<br>
Jag kommer att godta arrang�rsbeslut oavsett min egen vilja, <br>
samt erk�nna att jag �r d�lig p� att tippa.<br>
Jag vet att detta �r en sida f�r ett slutet s�llskap och att <br>
jag inte kan bjuda in vem som helst. <br>
D� Ola �r d�lig p� webbsidor s� m�ste jag �ven spara mina tips <br>
lokalt, g�rna skriva ut dem som backup om n�got skulle g� �t h*vete<br>
<br>
F�r att komma vidare m�ste du acceptera ovanst�ende villkor.<br>


			</td>
		</tr>
		<tr>
		<td></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" onClick="location.href='index.php'" class="btn" value="Registrera"></td>
		</tr>
		</table>

	</td>
</tr>
</table>
	<?

// st�nger databasen
mysql_close($opendb);
}

} else // IF DATE IS OUT OF DATE
	echo 'Permission denied!';
?>
</HTML>
