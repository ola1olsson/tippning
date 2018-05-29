<HTML>

<head>
<link href="css\styles.css" rel="stylesheet" type="text/css">
</head>

<?php
include "config.php";
include "connect_database.php";

$current_date = date('Y-m-d');
if($current_date > $last_bet_day) {
	echo 'Permission denied! ' .$current_date . ' is far beyond what we allow (' .$last_bet_day . ')';
} else {
	$errUser = false;
	$errPass = false;

	if(isset($_REQUEST['register']) && $_REQUEST['register'] == 'true') {

		$escaped_name       = mysqli_escape_string($opendb, isset($_POST['fornamn']) ? $_POST['fornamn'] : '');
		$escaped_surname    = mysqli_escape_string($opendb, $_POST['efternamn']);
		$escaped_company    = mysqli_escape_string($opendb, $_POST['foretag']);
		$escaped_email      = mysqli_escape_string($opendb, $_POST['email']);
		$escaped_phone      = mysqli_escape_string($opendb, $_POST['telefon']);
		$escaped_city       = mysqli_escape_string($opendb, $_POST['ort']);
		$escaped_user       = mysqli_escape_string($opendb, $_POST['user']);
		$escaped_password   = mysqli_escape_string($opendb, $_POST['password1']);

		$result = mysqli_query($opendb, "SELECT count(*) FROM users WHERE username='".addslashes($escaped_user)."';");
		$count = $result->fetch_row();

		if($count[0] > 0 || $_POST['user'] == '') {
			$errUser = true;
			echo $count[0];
		}

		if($_POST['password1'] != $_POST['password2'] || empty($_POST['password1']) || empty($_POST['password2'])) {
			$errPass = true;
		}

		// Om User och Password &aumlr ok, forts&aumltt 
		if(!$errUser && !$errPass) {

			mysqli_query($opendb, "INSERT INTO users (givenName, familyName, Company, emailAddress, phoneNumber, city, username, password) 
						VALUES ('".addslashes($escaped_name)."', '".addslashes($escaped_surname)."', '".addslashes($escaped_company)."', '".addslashes($escaped_email)."', '".addslashes($escaped_phone)."', '".addslashes($escaped_city)."', '".addslashes($escaped_user)."', '".md5(addslashes($escaped_password))."');") or die(mysqli_error($opendb));
		}
	}

	if(($errUser || $errPass) || !isset($_POST['register'])) {
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
		<td width="150" height="20"></td><td width="25">F&oumlrnamn</td><td width="150"><input type="text" name="fornamn" value="<?=isset($_POST['fornamn']) ? $_POST['fornamn'] : '';?>" style="width:145px;"></td><td></td>
		</tr>

		<tr>
		<td width="150" height="20"></td><td width="25">Efternamn</td><td width="150"><input type="text" name="efternamn" value="<?=isset($_POST['surname']) ? $_POST['surname'] : '';?>" style="width:145px;"></td><td></td>
		</tr>

		<tr>
		<td width="150" height="20"></td><td width="25">Ort</td><td width="150"><input type="text" name="ort" value="<?=isset($_POST['ort']) ? $_POST['ort'] : '';?>" style="width:145px;"></td><td></td>
		</tr>

		<tr>
		<td width="150" height="20"></td><td width="25">F&oumlretag</td><td width="150"><input type="text" name="foretag" value="<?=isset($_POST['foretag']) ? $_POST['foretag'] : '';?>" style="width:145px;"></td><td></td>
		</tr>

		<tr>
		<td width="150" height="20"></td><td width="25">Mobiltel.</td><td width="150"><input type="text" name="telefon" value="<?=isset($_POST['telefon']) ? $_POST['telefon'] : '';?>" style="width:145px;"></td><td></td>
		</tr>

		<tr>
		<td width="150" height="20"></td><td width="25">Email</td><td width="150"><input type="text" name="email" value="<?=isset($_POST['email']) ? $_POST['email'] : '';?>" style="width:145px;"></td><td></td>
		</tr>

		<tr>
		<td height="30"></td></td><td width="25"></td><td valign="bottom"><B>Inloggningsuppgifter</B></td><td></td>
		</tr>

		<tr>
		<td width="150" height="25"></td><td width="25">Anv&aumlndarnamn</td><td width="150"><input type="text" name="user" value="<?=isset($_POST['user']) ? $_POST['user'] : '';?>" style="width:145px;"></td>
		<td>
	<?php
		// Det &aumlr n&aringgot som &aumlr fel med anv&aumlndarnamnet. Tv&aring alternativ: 1.Du har inte skrivit in n&aringgot anv&aumlndarnamn. 2.Du har skrivit in ett anv&aumlndarnamn som redan existerar.
		if ($errUser) {
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
		<td width="150" height="25"></td><td width="25">L&oumlsenord</td><td width="150"><input type="password" name="password1" value="<?=isset($_POST['password1']) ? $_POST['password1'] : '';?>" style="width:145px;"></td><td></td>
		</tr>
		
		<tr>
		<td width="150" height="25"></td><td width="25">Upprepa L&oumlsenord</td><td width="150"><input type="password" name="password2" value="<?=isset($_POST['password2']) ? $_POST['password2'] : '';?>" style="width:145px;"></td>
		<td>
<?php

		// Det &aumlr n&aringgot fel med l&oumlsenordet. Tv&aring alternativ: 1.Du har gl&oumlmt att fylla i l&oumlsenord. 2.Du har skrivit in olika l&oumlsenord.
		if($errPass) {
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
<?php
	} else {
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
				Jag godk&aumlnner att mina personuppgifter lagras.<br><br>
				Jag &aumlr inf&oumlrst&aringdd med att jag kan bli utest&aumlngd fr&aringn systemet <br>
				f&oumlr oacceptabelt upptr&aumldande eller fuskande och d&aumlr igenom g&aring<br>
				miste om min insats och mitt livs st&oumlrsta upplevelse.<br><br>
				Jag fattar ocks&aring att mina eventuellt inbetalda pengar kan g&aring<br>
				f&oumlrlorade pga min usla tippning.<br><br>
				Jag kommer att godtaga arrag&oumlrens beslut oavsett min egen vilja,<br>
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
<?php
	}
mysqli_close($opendb);
}
?>
</HTML>
