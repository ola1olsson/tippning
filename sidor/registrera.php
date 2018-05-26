<HTML>

<head>
<link href="css\styles.css" rel="stylesheet" type="text/css">
</head>
<?
// Om dagens datum inte &aumlr mer 2010-11-06 s&aring &aumlr det ok att registrera sig p&aring sidan.
// <<CONFIG>>
if(date('Y-m-d')<'2010-11-06') {
?>

<?
// ---------------------- Avtalet ----------------------------
/*
H&aumlr med godk&aumlnner jag att mina personuppgifter lagras av waldis.se
Jag &aumlr inf&oumlrst&aringdd med att jag kan bli utest&aumlngd fr&aringn systemet f&oumlr oacceptabelt upptr&aumldande eller fuskande och d&aumlr igenom g&aring miste om min insats och mitt livs st&oumlrta upplevelse.
Jag fattar ocks&aring att mina eventuellt inbetalda pengar kan g&aring f&oumlrlorade pga min usla tippning.
Jag kommer att godtaga arrag&oumlrensbeslut oavsett min egen vilja, samt erk&aumlnna att jag &aumlr d&aringlig p&aring att tippa.
Jag vet att detta &aumlr en sida f&oumlr ett slutet s&aumlllskap och att jag inte kan bjuda in vem som helst. 
Ska jag vara med och t&aumlvla vet jag att jag m&aringste f&aring arrang&oumlrens godk&aumlnnande innan jag b&oumlrjar.

F&oumlr att komma vidare m&aringste du acceptera ovanst&aringende villkor.

Acceptera	Avbryt 
*/
?>





<?

// Includerar uppkopling till MySQL-server.
include "config.php";
include "connect_database.php";

if($_REQUEST['register'] == 'true') {

	// REGISTRERA ANV&AumlNDAREN	
	$result = mysqli_query($opendb, "SELECT user FROM users WHERE user='".addslashes($_POST['user'])."';");
	
	//
	if(mysqli_num_rows($result)>0 || $_POST['user'] == '') {
		$errUser = true;
	} else $errUser = false;


	// Kontroll om l&oumlsenordet st&aumlmmer, Kontrollerar s&aring att man skrivit in samma l&oumlsenord tv&aring g&aringnger.
	if($_POST['password1'] != $_POST['password2'] || empty($_POST['password1']) || empty($_POST['password2'])) {
		$errPass = true;
	} else $errPass = false;
	
	
	// Om User och Password &aumlr ok, forts&aumltt 
	if(!$errUser && !$errPass) {
		mysqli_query($opendb, "INSERT INTO users (givenName, familyName, Company, emailAddress, phoneNumber, city, username, password) 
					VALUES ('".addslashes($_POST['fornamn'])."', '".addslashes($_POST['efternamn'])."', '".addslashes($_POST['foretag'])."', '".addslashes($_POST['email'])."', '".addslashes($_POST['telefon'])."', '".addslashes($_POST['ort'])."', '".addslashes($_POST['user'])."', '".md5(addslashes($_POST['password1']))."');") or die(mysqli_error($opendb));
	} 
	
} 

if(($_POST['register'] == 'true' && ($errUser || $errPass)) || !isset($_POST['register'])) {


?>

<table width="850"  border="5" bordercolor="981a25" align="center">
<tr> 
	<td height="100%">
	

<table width="850" height="600" background="pic\uefa_euro2008_logo.jpg" border="0" bordercolor="black" align="center">
	<tr> 
	<td height="325" colspan=4 valign="bottom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T&aumlnk p&aring att inte anv&aumlnda n&aringgra anv&aumlndarnamn & l&oumlsenord<br>
											   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;som du anv&aumlnder t.ex. p&aring jobbet, till din mail m.m.<br>&nbsp;
		
		<tr>
		<form action="registrera.php" method="post" name="register">
		<td width="150" height="20"></td><td width="25">F&oumlrnamn</td><td width="150"><input type="text" name="fornamn" value="<?=$_POST['fornamn'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="20"></td><td width="25">Efternamn</td><td width="150"><input type="text" name="efternamn" value="<?=$_POST['efternamn'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="20"></td><td width="25">Ort</td><td width="150"><input type="text" name="ort" value="<?=$_POST['ort'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="20"></td><td width="25">F&oumlretag</td><td width="150"><input type="text" name="foretag" value="<?=$_POST['foretag'];?>" style="width:145px;"></td><td></td>
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
		<td width="150" height="25"></td><td width="25">Anv&aumlndarnamn</td><td width="150"><input type="text" name="user" value="<?=$_POST['user'];?>" style="width:145px;"></td>
		<td>
		<?
		// Det &aumlr n&aringgot som &aumlr fel med anv&aumlndarnamnet. Tv&aring alternativ: 1.Du har inte skrivit in n&aringgot anv&aumlndarnamn. 2.Du har skrivit in ett anv&aumlndarnamn som redan existerar.
		if($errUser) {
		echo '<span style="color:FF0000;">';
		if($_POST['user'] == '') 
		echo 'Du m&aringste ange ett <br>anv&aumlndarnamn.';
		else 
		echo 'Anv&aumlndarnamnet \''.$_POST['user'].'\' <br>&aumlr redan upptaget, prova ett nytt.';
		echo '</span>';
		}
		?>
		</td>
		</tr>
		
		<tr>
		<td width="150" height="25"></td><td width="25">L&oumlsenord</td><td width="150"><input type="password" name="password1" value="<?=$_POST['password1'];?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="25"></td><td width="25">Upprepa L&oumlsenord</td><td width="150"><input type="password" name="password2" value="<?=$_POST['password2'];?>" style="width:145px;"></td>
		<td>
		<?
		
		// Det &aumlr n&aringgot fel med l&oumlsenordet. Tv&aring alternativ: 1.Du har gl&oumlmt att fylla i l&oumlsenord. 2.Du har skrivit in olika l&oumlsenord.
		if($errPass)
		{
		echo '<span style="color:FF0000;">';
		if (empty($_POST['password1']) || empty($_POST['password2']))
		echo 'Du m&aringste ange ett l&oumlsenord.';
		else 
		echo 'Du har angivit tv&aring olika l&oumlsenord.<br>F&oumlrs&oumlk igen...';
		echo '</span>';
		}
		?>
		</td>
		</tr>
		
		<tr>
		<td width="150" height="25"></td><td width="25"></td><td width="150">
		<input type="hidden" name="register" value="true">
		<input type="submit" class="btn" value="Registrera"> &nbsp;&nbsp;&nbsp;
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

//	echo 'Du &aumlr registrerad!';
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
			Jag godk&aumlnner att mina personuppgifter lagras av waldis.se<br><br>
			Jag &aumlr inf&oumlrst&aringdd med att jag kan bli utest&aumlngd fr&aringn systemet <br>
			f&oumlr oacceptabelt upptr&aumldande eller fuskande och d&aumlr igenom g&aring<br>
			miste om min insats och mitt livs st&oumlrta upplevelse.<br><br>
			Jag fattar ocks&aring att mina eventuellt inbetalda pengar kan g&aring<br>
			f&oumlrlorade pga min usla tippning.<br><br>
			Jag kommer att godtaga arrag&oumlrensbeslut oavsett min egen vilja,<br>
			samt erk&aumlnna att jag &aumlr d&aringlig p&aring att tippa.<br><br>
			Jag vet att detta &aumlr en sida f&oumlr ett slutet s&aumlllskap och att <br>
			jag inte kan bjuda in vem som helst.<br><br> 
			Ska jag vara med och t&aumlvla vet jag att jag m&aringste f&aring arrang&oumlrens<br>
			godk&aumlnnande innan jag b&oumlrjar.<br>
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

// st&aumlnger databasen
mysqli_close($opendb);
}

} else // IF DATE IS OUT OF DATE
	echo 'Permission denied!';
?>
</HTML>
