<table BGCOLOR="#FFFFFF" border="0" width="100%" height="100%">
<tr>
<td align="center" valign="top">
<br>
<?
if(session_is_registered('permission') && $_SESSION['permission']) {
echo '<span class="header">Min profil<br><br></span>';
		

//-----
if($cmd == 'passwd') {
	if($_POST['register'] == 'register') {
		// SAVE PASSWORD
		$passres = mysql_query("SELECT password FROM users WHERE ID = '".$_SESSION['userID']."';");
		if(mysql_result($passres,0,'password') == $_POST['oldPass'] && $_POST['newPass1'] == $_POST['newPass2']) {
			mysql_query("UPDATE users SET password = '".$_POST['newPass1']."' WHERE ID = '".$_SESSION['userID']."';");
			echo '<span class="header3">Det nya lösenordet sparades!<br></span><br>'.
					'<input type=button value="Ok" onClick="document.location=\'default.php?page=default\';" class=btn>';
		} else {
			// ERROR PASSWORD
			echo '<span class="header3">Fel uppstod vid sparandet! Försök igen...<br></span>'.
				'<input type=button class=btn value="Försök igen..." onClick="document.location=\'index.php?page=profile&cmd=passwd\';">';
		}
	} else {
		// ENTER NEW PASSWORD
		echo 'Gammalt lösenord:<br><input type=password name=oldPass><br><br><br>'.
			'Nytt lösenord:<br><input type=password name=newPass1><br><br>'.
			'Upprepa lösenord:<br><input type=password name=newPass2><br><br>'.
			'<input type=hidden name=register value=register>'.
			'<input type=button value="Spara lösenord" class=btn onClick="this.form.action=\'index.php?page=profile&cmd=passwd\'; this.form.submit();">';
		
	}
} else {
	if($_POST['register'] == 'register') {
		// SPARA INSTÄLLNINGAR	
		mysql_query("UPDATE users SET ".
					"givenName = '".$_POST['givenName']."', ".
					"familyName = '".$_POST['familyName']."', ".
					"emailAddress = '".$_POST['emailAddress']."', ".
					"phoneNumber = '".$_POST['phoneNumber']."', ".
					"Company = '".$_POST['Company']."', ".
					"city = '".$_POST['city']."' WHERE id = '".$_SESSION['userID']."';") or die(mysql_error());
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 200000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
      move_uploaded_file($_FILES["file"]["tmp_name"], "./pic/users/" . $_SESSION['userID']);
      mysql_query("UPDATE users SET foto= './pic/users/" . $_SESSION['userID'] . "';") or die(mysql_error());
    }
  }
else
  {
  echo "Invalid file";
  }
		echo 'Profil sparad!<br>'.
				'<input type=button class=btn value="Tillbaka" onClick="document.location=\'index.php?page=default\';">';


	} else {
		// STANDARD
		$dbuser = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id = '".$_SESSION['userID']."';"), MYSQL_ASSOC);
		
		?>
		<table border="0" cellspacing="30">
		<tr valign="top">
			<td><img src="<?=$dbuser['foto'];?>" width="150" height="150"></td>
			<td rowspan="2">
				<table border=0 cellspacing=5 cellpadding=0 style="width:200px;">
					<tr>
						<td>Förnamn</td>
						<td colspan="2"><input type="text" style="width:200px;" name="givenName" value="<?=$dbuser['givenName'];?>"></td>
					</tr>	
					<tr>
						<td>Efternamn</td>
						<td colspan="2"><input type="text" style="width:200px;" name="familyName" value="<?=$dbuser['familyName'];?>"></td>
					</tr>
					<tr>
						<td>Företag</td>
						<td colspan="2"><input type="text" style="width:200px;" name="Company" value="<?=$dbuser['Company'];?>"></td>
					</tr>
					<tr>
						<td>Telefon</td>
						<td colspan="2"><input type="text" style="width:200px;" name="phoneNumber" value="<?=$dbuser['phoneNumber'];?>"></td>
					</tr>
					<tr>
						<td>Ort</td>
						<td colspan="2"><input type="text" style="width:200px;" name="city" value="<?=$dbuser['city'];?>"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td colspan="2"><input type="text" style="width:200px;" name="emailAddress" value="<?=$dbuser['emailAddress'];?>"></td>
					</tr>
					<tr>
						<td>Logins</td>
						<td><?=$dbuser['nbrOfLogins'];?></td>
					</tr>
	
					<tr>
						<input type="hidden" name="register" value="register">
						<td></td>
						<td align="left"><input type="button" value="Tillbaka" onClick="history.back();" class="btn"></td>
						<input type="file" name="file" id="file"><br>
						<td align="right"><input type="button" value="Spara profil" onClick="this.form.action='index.php?sida=profil'; this.form.submit();" class="btn"></td>
					</tr>
				</table>
				<br><br>
				
			</td>
		<tr>
			<td align="center"><h4><?=$dbuser['user'];?></h4></td>
		</tr>
		</tr>
		</table>
		<?
	}
}
} else
	echo 'Permission denied!';
?>



</td>
</tr>
</table>
