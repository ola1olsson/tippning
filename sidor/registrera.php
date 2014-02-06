<HTML>

<head>
<link href="css\styles.css" rel="stylesheet" type="text/css">
</head>
<?
// Om dagens datum inte är mer 2010-11-06 så är det ok att registrera sig på sidan.
// <<CONFIG>>
if(date('Y-m-d')<'2010-11-06') {
?>

<?
// ---------------------- Avtalet ----------------------------
/*
Här med godkänner jag att mina personuppgifter lagras av waldis.se
Jag är införstådd med att jag kan bli utestängd från systemet för oacceptabelt uppträdande eller fuskande och där igenom gå miste om min insats och mitt livs störta upplevelse.
Jag fattar också att mina eventuellt inbetalda pengar kan gå förlorade pga min usla tippning.
Jag kommer att godtaga arragörensbeslut oavsett min egen vilja, samt erkänna att jag är dålig på att tippa.
Jag vet att detta är en sida för ett slutet sällskap och att jag inte kan bjuda in vem som helst. 
Ska jag vara med och tävla vet jag att jag måste få arrangörens godkännande innan jag börjar.

För att komma vidare måste du acceptera ovanstående villkor.

Acceptera	Avbryt 
*/
?>





<?

// Includerar uppkopling till MySQL-server.
include "config.php";
include "connect_database.php";

if($_REQUEST['register'] == 'true') {

	// REGISTRERA ANVÄNDAREN	
	$result = mysql_query("SELECT user FROM users WHERE user='".addslashes($_POST['user'])."';");
	
	//
	if(mysql_num_rows($result)>0 || $_POST['user'] == '') {
		$errUser = true;
	} else $errUser = false;


	// Kontroll om lösenordet stämmer, Kontrollerar så att man skrivit in samma lösenord två gånger.
	if($_POST['password1'] != $_POST['password2'] || empty($_POST['password1']) || empty($_POST['password2'])) {
		$errPass = true;
	} else $errPass = false;
	
	
	// Om User och Password är ok, fortsätt 
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
	<td height="325" colspan=4 valign="bottom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tänk på att inte använda några användarnamn & lösenord<br>
											   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;som du använder t.ex. på jobbet, till din mail m.m.<br>&nbsp;
		
		<tr>
		<form action="registrera.php" method="post" name="register">
		<td width="150" height="20"></td><td width="25">Förnamn</td><td width="150"><input type="text" name="fornamn" value="<?=$_POST['fornamn'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="20"></td><td width="25">Efternamn</td><td width="150"><input type="text" name="efternamn" value="<?=$_POST['efternamn'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="20"></td><td width="25">Ort</td><td width="150"><input type="text" name="ort" value="<?=$_POST['ort'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="20"></td><td width="25">Företag</td><td width="150"><input type="text" name="foretag" value="<?=$_POST['foretag'];?>" style="width:145px;"></td><td></td>
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
		<td width="150" height="25"></td><td width="25">Användarnamn</td><td width="150"><input type="text" name="user" value="<?=$_POST['user'];?>" style="width:145px;"></td>
		<td>
		<?
		// Det är något som är fel med användarnamnet. Två alternativ: 1.Du har inte skrivit in något användarnamn. 2.Du har skrivit in ett användarnamn som redan existerar.
		if($errUser) {
		echo '<span style="color:FF0000;">';
		if($_POST['user'] == '') 
		echo 'Du måste ange ett <br>användarnamn.';
		else 
		echo 'Användarnamnet \''.$_POST['user'].'\' <br>är redan upptaget, prova ett nytt.';
		echo '</span>';
		}
		?>
		</td>
		</tr>
		
		<tr>
		<td width="150" height="25"></td><td width="25">Lösenord</td><td width="150"><input type="password" name="password1" value="<?=$_POST['password1'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="25"></td><td width="25">Upprepa Lösenord</td><td width="150"><input type="password" name="password2" value="<?=$_POST['password2'];?>" style="width:145px;"></td>
		<td>
		<?
		
		// Det är något fel med lösenordet. Två alternativ: 1.Du har glömt att fylla i lösenord. 2.Du har skrivit in olika lösenord.
		if($errPass)
		{
		echo '<span style="color:FF0000;">';
		if (empty($_POST['password1']) || empty($_POST['password2']))
		echo 'Du måste ange ett lösenord.';
		else 
		echo 'Du har angivit två olika lösenord.<br>Försök igen...';
		echo '</span>';
		}
		?>
		</td>
		</tr>
		
		<tr>
		<td width="150" height="25"></td><td width="25"></td><td width="150">
		<input type="hidden" name="register" value="true">
		<input type="submit" class="btn" value="Nästa"> &nbsp;&nbsp;&nbsp;
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

//	echo 'Du är registrerad!';
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
			Jag godkänner att mina personuppgifter lagras av waldis.se<br><br>
			Jag är införstådd med att jag kan bli utestängd från systemet <br>
			för oacceptabelt uppträdande eller fuskande och där igenom gå<br>
			miste om min insats och mitt livs störta upplevelse.<br><br>
			Jag fattar också att mina eventuellt inbetalda pengar kan gå<br>
			förlorade pga min usla tippning.<br><br>
			Jag kommer att godtaga arragörensbeslut oavsett min egen vilja,<br>
			samt erkänna att jag är dålig på att tippa.<br><br>
			Jag vet att detta är en sida för ett slutet sällskap och att <br>
			jag inte kan bjuda in vem som helst.<br><br> 
			Ska jag vara med och tävla vet jag att jag måste få arrangörens<br>
			godkännande innan jag börjar.<br>
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

// stänger databasen
mysql_close($opendb);
}

} else // IF DATE IS OUT OF DATE
	echo 'Permission denied!';
?>
</HTML>
