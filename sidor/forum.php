<table BGCOLOR="#FFFFFF" style="width: 100%; height: 100%;" frame="rhs" border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="center" valign="top">
<br>
<br>
<br>


<?php
if(activeSession() && (($_SESSION['betalt'] || $_SESSION['admin']))) {

	$hrcolor = "#ff0000";
	$bgcolor = "#ffaaaa";

	echo '<span class="header">Forum<br></span><br>';

	$cmd = isset($_REQUEST['cmd']) ? $_REQUEST['cmd'] : null;

	if(!isset($_REQUEST['cmd'])) {
		if(isset($_POST['register']) &&$_POST['register'] == 'newThread') {
			mysqli_query($opendb, "INSERT INTO forum_titles (title,owner,date,time) VALUES ('".$_POST['title']."','".$_SESSION['userID']."','".date('Y-m-d')."','".date('H:i')."');") or die(mysqli_error($opendb));
			$threadID = mysqli_data_seek(mysqli_query($opendb, "SELECT MAX(ID) AS forumID FROM forum_titles;"), 0);
			mysqli_query($opendb, "INSERT INTO forum_entries (forumID,user,date,time,title,contribution) VALUES ('".$threadID."','".$_SESSION['userID']."','".date('Y-m-d')."','".date('H:i')."','".$_POST['title']."','".$_POST['contribution']."');") or die(mysqli_error($opendb));
	}
		echo '<input type=button class=btn value="Nytt meddelande" onClick="document.location=\'index.php?sida=forum&cmd=newThread\';"><br><br>';
		$forum_titles = mysqli_query($opendb, "SELECT forum_titles.ID AS forumID, forum_titles.title, forum_titles.date, forum_titles.time, users.username AS owner, users.ID AS userID FROM forum_titles, users WHERE forum_titles.owner = users.ID ORDER BY forum_titles.date DESC, forum_titles.time DESC;") or die(mysqli_error($opendb));
		if(mysqli_num_rows($forum_titles)>0) {
			echo '<table border=0 cellspacing=0 cellpadding=0>
				<tr class=rub>
					<td style="width:75px;">Datum&nbsp;</td>
					<td style="width:45px;">Tid&nbsp;</td>
					<td>Titel&nbsp;</td>
					<td>Inl&aumlgg&nbsp;</td>
					<td>&Aumlgare</td>
				</tr>
				<tr><td colspan=5><hr align=center style="width:100%; height:1px;" color="'.$hrcolor.'"></td></tr>';
			while($ft = mysqli_fetch_array($forum_titles, MYSQLI_ASSOC)) {
				$nbrEntries = mysqli_num_rows(mysqli_query($opendb,"SELECT forumID FROM forum_entries WHERE forumID = '".$ft['forumID']."';"));
				echo '<tr>
						<td>'.$ft['date'].'&nbsp;</td>
						<td>'.$ft['time'].'&nbsp;</td>
						<td><a href="./index.php?sida=forum&cmd=show&id='.$ft['forumID'].'">'.$ft['title'].'</a>&nbsp;</td>
						<td><b>'.$nbrEntries.'</b>st&nbsp;</td>
						
						<td><a href="./index.php?sida=visadeltagare&id='.$ft['userID'].'">'.$ft['owner'].'</a></td>
					</tr>
					<tr><td colspan=5><hr align=center style="width:100%; height:1px;" color="'.$hrcolor.'"></td></tr>';		// rad visa deltagare var innan = "<td><a href="./index.php?sida=deltagare&cmd=showUser&id='.$ft['userID'].'">'.$ft['owner'].'</a></td>"
			}
		echo '</table>';
		}
	} else if($cmd == 'show') {
		if(isset($_REQUEST['cmd2']) && $_REQUEST['cmd2'] == 'delEntry') {
			mysqli_query($opendb, "DELETE FROM forum_entries WHERE forumID = '".$_REQUEST['entryID']."';");
	} else if(isset($_REQUEST['cmd2']) && $_REQUEST['cmd2'] == 'newEntry') {
		echo '<br>HOHOHOHO</br>';
		mysqli_query($opendb, "INSERT INTO forum_entries (forumID,user,date,time,title,contribution) VALUES ('".$_REQUEST['id']."','".$_SESSION['userID']."','".date('Y-m-d')."','".date('H:i')."','".$_POST['title']."','".$_POST['contribution']."');") or die(mysqli_error($opendb));
	}
	$ft = mysqli_fetch_array(mysqli_query($opendb, "SELECT title, owner FROM forum_titles WHERE ID = '".$_REQUEST['id']."';"), MYSQLI_ASSOC);
	$fe = mysqli_query($opendb, "SELECT forum_entries.forumID AS entryID,
							forum_entries.date, 
							forum_entries.time, 
							forum_entries.title, 
							forum_entries.contribution, 
							users.username,
							users.foto, 
							users.ID AS userID
						FROM forum_entries, users 
						WHERE forum_entries.forumID = '".$_REQUEST['id']."' AND forum_entries.user = users.ID 
						ORDER BY forum_entries.date ASC, forum_entries.time ASC;") or die(mysqli_error($opendb));
	//echo arrowBack('Alla diskutioner','index.php?sida=forum').'<br><br>										// Denna raden orsakar ett problem, kolla upp "arrowBack". Om den ska anväaumlndas glöoumlm inte ta bort "echo' "-tecknet påaaring näaumlsta rad.
		 echo '<table border=0 cellspacing=0 cellpadding=0 style="width:400px;"><tr>
			<td align=left valign=bottom><input type="button" class="btn" value="Tillbaka" onClick="document.location=\'index.php?sida=forum\';"></td>
			<td align=center valign=bottom><span class="header">'.$ft['title'].'</span><br><b>'.mysqli_num_rows($fe).'</b>st meddelande</td>
			<td align=right valign=bottom>';
	if($_SESSION['admin']) {
		echo '<input type=button class=alert value="Radera meddelande" onClick="document.location=\'index.php?sida=forum&cmd=delThread&forumID='.$_REQUEST['id'].'\';"><br/><br/>';
	}
	echo '<input type=button class=btn value="Nytt meddelande" onClick="document.location=\'index.php?sida=forum&cmd=newEntry&forumID='.$_REQUEST['id'].'&entryID='.$_REQUEST['id'].'\';">
			</td>
		</tr><tr><td colspan=3><hr align=left style="width:100%px; height:1px;" color="'.$hrcolor.'"></td></tr></table>';
	if(mysqli_num_rows($fe)>0) {
		echo '<table border=0 cellspacing=0 cellpadding=1 style="width:400px;">';
		while($entry = mysqli_fetch_array($fe, MYSQLI_ASSOC)) {
			echo '<tr bgcolor="'.$bgcolor.'"> 
					<td align=left valign=bottom><a href="./index.php?sida=visadeltagare&id='.$entry['userID'].'"><span class="header3" style="font-weight:bold;">'.$entry['username'].'</span></a></td>
					<td align=left valign=bottom><span class="header3">'.$entry['title'].'</span></td>
					<td align=right valign=bottom><span class="header3">'; 									// i stäaumlllet föoumlr "visadeltagare" = "deltagare&cmd=showUser"
			if($ft['owner'] == $_SESSION['userID'] || $entry['userID'] == $_SESSION['userID'] || $_SESSION['admin']) {
				echo '<a href="./index.php?sida=forum&cmd=show&id='.$_REQUEST['id'].'&cmd2=delEntry&entryID='.$entry['entryID'].'">Ta bort</a>&nbsp;&nbsp;';	
			}
					
			echo $entry['date'].'&nbsp;&nbsp;'.$entry['time'].'</span></td>
				</tr>
				<tr>
					<td bgcolor="'.$bgcolor.'" align=left valign=top>';
			if($entry['foto']!='') 
				echo '<img src="'.$entry['foto'].'" alt="'.$entry['username'].'" border=1 style="width:55px;"><br>';
			echo '	</td>
					<td align=left valign=top colspan=2>'.$entry['contribution'].'</td>
				</tr>
				<tr><td colspan=3><hr align=left style="width:100%px; height:1px;" color="'.$hrcolor.'"></td></tr>';
		}	
		echo '</table>';
	}

	} else if($cmd == 'newEntry') {
		$ft = mysqli_fetch_array(mysqli_query($opendb, "SELECT title FROM forum_titles WHERE ID = '".$_REQUEST['entryID']."';"), MYSQLI_ASSOC);
		echo '<span class="header2">Nytt inl&aumlgg i \''.$ft['title'].'\'<br></span><br>
			Titel:<br>
			<input type=text style="width:400px;" value="SV: '.$ft['title'].'" name=title><br><br>
			<textarea name=contribution style="width:400px; height:300px;"></textarea>
			<input type=hidden name=register value=register>
			<table border=0 cellspacing=0 cellpadding=0 style="width:400px;"><tr>
			<td align=left><input type=button class=btn value="Avbryt" onClick="document.location=\'index.php?sida=forum&cmd=show&id='.$_REQUEST['forumID'].'\';"></td>
			<td align=right><input type=button class=btn value="Skicka!" onClick="this.form.action=\'index.php?sida=forum&cmd=show&id='.$_REQUEST['forumID'].'&cmd2=newEntry\'; this.form.submit();"></td>
		</tr></table>';

	} else if($cmd == 'newThread') {
		echo '<span class="header4">Ny tr&aringd<br></span><br>
		Titel:<br>
		<input type=text name=title style="width:400px;"><br><br>
		Inl&aumlgg:<br>
		<textarea name=contribution style="width:400px; height:300px;"></textarea><br><br>
		<input type=hidden name=register value="newThread">
		<table border=0 cellspacing=0 cellpadding=0 style="width:400px;"><tr>
		<td align=left><input type=button class=btn value="Avbryt" onClick="document.location=\'index.php?sida=forum\';"></td>
		<td align=right><input type=button class=btn value="Skapa meddelande!" onClick="this.form.action=\'index.php?sida=forum\'; this.form.submit();"></td>
		</tr></table>';

	} else if($cmd == 'delThread' && $_SESSION['admin']) {
		if (isset($_POST['register']) && $_POST['register'] == 'delThread') {
			mysqli_query($opendb, "DELETE FROM forum_entries WHERE forumID = '".$_POST['forumID']."';");
			mysqli_query($opendb, "DELETE FROM forum_titles WHERE ID = '".$_POST['forumID']."';");
			echo '<span class="header2">Tr&aringd borttagen.<br></span><br>
			<input type=button class=btn value="Tillbaka" onClick="document.location=\'index.php?sida=forum\';">';	
		} else {
			$ft = mysqli_fetch_array(mysqli_query($opendb, "SELECT title, owner FROM forum_titles WHERE ID = '".$_REQUEST['forumID']."';"), MYSQLI_ASSOC);
			echo '<span class="header2" style="color: #550000;">&Aumlr du s&aumlker p&aring att du vill ta bort denna tr&aringd?<br></span><br>
				<table border=0 cellspacing=0 cellpadding=0>
				<tr><td colspan=2><span class="header3">Tr&aringd</span></td></tr>
				<tr><td align=left>Titel:&nbsp;</td><td>'.$ft['title'].'</td></tr>
				<tr><td colspan=2>&nbsp;</td></tr>';
			$owner = mysqli_fetch_array(mysqli_query($opendb, "SELECT username, givenName, familyName, foto FROM users WHERE id = '".$ft['owner']."';"), MYSQLI_ASSOC);
			echo '<tr><td colspan=2><span class="header3">&Aumlgare</span></td></tr>';
			if($owner['foto'] != '') 
			echo '<tr><td></td><td><img src="'.$owner['foto'].'" border=0 style="width:55px;"></td></tr>';
			echo '<tr><td>Anvi&aumlndarnamn:&nbsp;</td><td>'.$owner['username'].'</td></tr>
				<tr><td>Efternamn:&nbsp;</td><td>'.$owner['familyName'].', '.$owner['givenName'].'</td></tr>
				</table>';
			echo '<hr align="center" style="width:300px; height:1px;" color="'.$hrcolor.'">
				<table border=0 cellspacing=0 cellpadding=0 style="width:300px;"><tr>
				<input type=hidden name=register value=delThread>
				<input type=hidden name=forumID value='.$_REQUEST['forumID'].'>
				<td align=left><input type=button class=btn value="Avbryt" onClick="document.location=\'index.php?sida=forum&cmd=show&id='.$_REQUEST['forumID'].'\'"></td>
				<td align=right><input type=button class=btn value="Radera!" onClick="this.form.action=\'index.php?sida=forum&cmd=delThread\'; this.form.submit();"></td>
				</tr></table>';
		}
	} else {
		echo 'Woops! CMD='.$cmd;
	}
} else {
	echo 'Permission denied!';
}
?>
</td>
</tr>
</table>
