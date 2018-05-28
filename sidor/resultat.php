<?php
if((isset($_SESSION['betalt']) && $_SESSION['betalt'] == 1 && $cupStarted) || $_SESSION['admin']) {
?>

	<table BGCOLOR="#FFFFFF" width="100%" height="100%"  bordercolor="#6C261F"  cellpadding="30" cellspacing="0">
	<tr>
	<td align="left" valign="top" frame="rhs" border="1"> 

	<span class="header">J&aumlmf&oumlr<br></span><br>


<?php
	if(isset($_POST['check'])) {
		if(isset($_REQUEST['cmd']) && $_REQUEST['cmd'] == 'allusers') {
			$allusers = mysqli_query($opendb, "SELECT tippning.id FROM users, tippning WHERE users.id != ".$_SESSION['userID']." AND users.id = tippning.id ORDER BY givenName ASC;") or die(mysqli_error($opendb));
			$k_usr = -1;
			unset($_POST['users']);
			while($usr = mysqli_fetch_array($allusers, MYSQLI_ASSOC))
				$_POST['users'][$k_usr++] = $usr['id'];	
		}
		echo '<a href="index.php?sida=resultat">Klicka h&aumlr f&oumlr att g&oumlra en ny j&aumlmf&oumlrelse</a><br><br>';

		$users[0] = -1;
		$users[1] = $_SESSION['userID'];
		$i_user = 2;
		if (isset($_POST['users'])) { 
			foreach($_POST['users'] as $user) {
				$users[$i_user] = $user;
				$i_user++;
			}
		}

		// DATABASE CONNECTION ESTABLISHMENT
		$query = "SELECT * FROM tippning WHERE ";
		for($i=0; $i<sizeof($users); $i++) {
			$query .= "id = ".$users[$i];
			if ($i < sizeof($users) - 1) {
				$query .= " OR ";
			}
		}

		$query .= ";";
		$db_result = mysqli_query($opendb, $query) or die(mysqli_error($opendb));
		while($db_res = mysqli_fetch_array($db_result,MYSQLI_ASSOC)) {
			for($i=1; $i<=$grundspel_max; $i++) {
				$result[$db_res['id']][$i] = $db_res['m'.$i];
			}

			for($i=$grundspel_max + 1; $i<=$slutspel_max; $i++) {
				if (isset($db_res['m'.$i])) {
					$result[$db_res['id']][$i][0] = $db_res['m'.$i];
				}
				if (isset($db_res['m'.$i.'a'])) {
					$result[$db_res['id']][$i][1] = $db_res['m'.$i.'a'];
				}
				if (isset($db_res['m'.$i.'b'])) {
					$result[$db_res['id']][$i][2] = $db_res['m'.$i.'b'];
				}
			}

			$result[$db_res['id']]['topScorer'] = $db_res['topScorer'];
			$result[$db_res['id']]['swedishGoals'] = $db_res['swedishGoals'];
        
		}
		$rowspan = (8*7)+3;
		echo '<table border=0 bordercolor=black cellspacing=5 cellpadding=0>';
		echo '<tr>
			<td align=left valign=bottom colspan=4></td>
			<td align=center valign=bottom><span class=vertical>Resultat</span></td>';
		for($i=1; $i<sizeof($users); $i++) 
		{	
			$user_name = mysqli_fetch_array(mysqli_query($opendb, "SELECT givenName, familyName FROM users WHERE id = ".$users[$i].";"), MYSQLI_ASSOC);
			$givenName = $user_name['givenName'];
			$vertUserName = '';
			for ($k = 0; $k < strlen($givenName); $k++) {
				$vertUserName .= $givenName{$k}.'<br/>';
			}
			$vertUserName .= '<br/>'.$user_name['familyName']{0};
			echo '<td align=left valign=top><span class=vertical>'.$vertUserName.'</span></td>';
			echo '<td style="width:1px;" bgcolor="#550000" rowspan='.$rowspan.'><img src="./pics/spacer.gif" style="width:1px;" border=0></td>';
		}
		echo '</tr>';
		echo '<tr style="font-weight:bold;">
			<td align=left valign=bottom colspan=5>Antal po&aumlng:</td>';
		for($i=1; $i<sizeof($users); $i++) 
		{
			$user_points = mysqli_fetch_array(mysqli_query($opendb, "SELECT points FROM users WHERE id = ".$users[$i].";"), MYSQLI_ASSOC);
			echo '<td align=center valign=bottom>'.$user_points['points'].'p</td>';
		}
		echo '</tr>';
		$colspans = 4+(sizeof($users)+1);

		// GRUPPSPEL
		echo '<tr><td colspan='.$colspans.' align=left><span class="header4">Gruppspel</span></td></tr>';
		$grundspel = Array('A','B','C','D','E','F','G','H');
		foreach($grundspel AS $grupp) {
		$matcher = mysqli_query($opendb, "SELECT * FROM matcher WHERE hemma LIKE '".$grupp."%' AND borta LIKE '".$grupp."%' ORDER BY id ASC;");
		echo '<tr><td colspan='.$colspans.' align=left><span class="header5">Grupp '.$grupp.'</span></td></tr>';
		
		while($match = mysqli_fetch_array($matcher, MYSQLI_ASSOC)) {
			$hemma = mysqli_fetch_array(mysqli_query($opendb, "SELECT * FROM lag WHERE lag = '".$match['hemma']."';"),MYSQLI_ASSOC);
			$borta = mysqli_fetch_array(mysqli_query($opendb, "SELECT * FROM lag WHERE lag = '".$match['borta']."';"),MYSQLI_ASSOC);
?>
			<tr>
			<td align=left><?=$match['ID']?>. </td>
			<td align=center>
			<img src="./pic/flaggor/<?=$hemma['flagImage']?>" title="<?=$hemma['countryName_sv']?>">
			</td>
			<td align=center> - </td>
			<td align=center>
			<img src="./pic/flaggor/<?=$borta['flagImage']?>" title="<?=$borta['countryName_sv']?>">&nbsp;&nbsp;
			</td>
			<td align=center bgcolor="#AAFFAA"><?=$result[-1][$match['ID']]?></td>
<?php
			for($i=1; $i<sizeof($users); $i++) {
				echo '<td align=center style="background-color: ';
				if($result[-1][$match['ID']] != '') {
					if($result[$users[$i]][$match['ID']] == $result[-1][$match['ID']])
						echo '#00FF00';
					else
						echo '#FFAAAA';
				} else {
				echo 'none';
				}
				echo ';">'.$result[$users[$i]][$match['ID']].'</td>';
			}
			echo '</tr>';	
		}
	}
	echo '</table><br><br>';

	// SLUTSPELET
	
	$rowspan = 2+sizeof($users);
	$teams_res = mysqli_query($opendb, "SELECT * FROM lag ORDER BY id ASC;");
	while($team_row = mysqli_fetch_array($teams_res)) {
		$teams[$team_row['lag']]['land'] = substr($team_row['countryName_sv'],0,3);
		$teams[$team_row['lag']]['flag'] = $team_row['flagImage'];
	}
	
	echo '<span class="header4">Slutspel<br></span>'.
		'<table border=0 cellspacing=2 cellpadding=0>'.
		'<tr><td><span class="header4">Match</span></td>'.
		'<td style="width:1px;" bgcolor="#550000" rowspan='.$rowspan.'><img src="./pics/spacer.gif" style="width:1px;" border=0></td>';
	for($i=$grundspel_max + 1; $i<=$slutspel_max; $i++) {
		echo '<td colspan=4 align=center><span style="font-weight:bold;">'.$i.'</span></td>'.
			'<td style="width:1px;" bgcolor="#550000" rowspan='.$rowspan.'><img src="./pics/spacer.gif" style="width:1px;" border=0></td>';
	}
	echo '<td colspan=4 align=center><span style="font-weight:bold;">TopScorer and Goals</span></td>'.
		'<td style="width:1px;" bgcolor="#550000" rowspan='.$rowspan.'><img src="./pics/spacer.gif" style="width:1px;" border=0></td>';
	echo '</tr>';
	echo '<tr bgcolor="#AAFFAA"><td><span class="header5">Resultat</span></td>';

	for($i=$grundspel_max + 1; $i<=$slutspel_max; $i++) {
		echo '<td align=center>';
		if(isset($result[-1][$i][1]) && $result[-1][$i][1] != '')
			echo '<img src="./pic/flaggor/'.$teams[$result[-1][$i][1]]['flag'].'" border=0><br>'.$teams[$result[-1][$i][1]]['land'];
		else 
			echo '&nbsp';
		echo '</td><td align=center>&nbsp;-&nbsp;</td><td align=center>';
		if(isset($result[-1][$i][2]) && $result[-1][$i][2] != '')
			echo '<img src="./pic/flaggor/'.$teams[$result[-1][$i][2]]['flag'].'" border=0><br>'.$teams[$result[-1][$i][2]]['land'];
		echo '</td><td align=center><span style="font-size:18px;">';
		if(isset($result[-1][$i][0]) && $result[-1][$i][0] != '')
			echo $result[-1][$i][0];
		else
			echo '&nbsp;';
		echo '</span></td>';
	}

	echo '</tr>';
	for($k=1; $k<sizeof($users); $k++) {
		$user_name = mysqli_fetch_array(mysqli_query($opendb, "SELECT givenName, familyName FROM users WHERE id = ".$users[$k].";"), MYSQLI_ASSOC);
		echo 	'<tr>'.
		'<td align=left>'.$user_name['givenName'].' '.$user_name['familyName']{0}.'</td>';
		for($i=$grundspel_max + 1; $i<=$slutspel_max; $i++) {
                               echo '<td align=center';
                               if(isset($result[-1][$i][1]) && $result[-1][$i][1] != '') {
                                       if(isset($result[$users[$k]][$i][1]) && $result[$users[$k]][$i][1] == $result[-1][$i][1])
                                               echo ' bgcolor="#00FF00"';
                                       else
                                               echo ' bgcolor="#FFAAAA"';
				}
	                               echo '>';
					if (isset($result[$users[$k]][$i][1])) {
	                                       echo '<img src="./pic/flaggor/'.$teams[$result[$users[$k]][$i][1]]['flag'].'" border=0><br>'.$teams[$result[$users[$k]][$i][1]]['land'];
					}
                                       echo '</td><td align=center>&nbsp;-&nbsp;</td><td align=center';
                               if(isset($result[-1][$i][2]) && $result[-1][$i][2] != '') {
                                       if(isset($result[$users[$k]][$i][2]) && $result[$users[$k]][$i][2] == $result[-1][$i][2])
                                               echo ' bgcolor="#00FF00"';
                                       else
                                               echo ' bgcolor="#FFAAAA"';
				}
	                               echo '>';
					if (isset($result[$users[$k]][$i][2])) {
	                                       echo '<img src="./pic/flaggor/'.$teams[$result[$users[$k]][$i][2]]['flag'].'" border=0><br>'.$teams[$result[$users[$k]][$i][2]]['land'];
					}
                                       echo '</td><td align=center';
                               if(isset($result[-1][$i][0]) && $result[-1][$i][0] != '') {
                                       if(isset($result[$users[$k]][$i][0]) && $result[$users[$k]][$i][0] == $result[-1][$i][0])
                                               echo ' bgcolor="#00FF00"';
                                       else
                                               echo ' bgcolor="#FFAAAA"';

				}
				echo '><span style="font-size:18px;">'.$result[$users[$k]][$i][0].'</span></td>';

			}
		echo	'</td><td align=center';
	if($result[-1]['topScorer'] != '') {
		if(strcmp($result[$users[$k]]['topScorer'],$result[-1]['topScorer']) == 0)
			echo ' bgcolor="#00FF00"';
		} else {
			echo ' bgcolor="#FFAAAA"';
		}
		echo '><span style="font-size:18px;">' . $result[$users[$k]]['topScorer'] . '</span></td>';
		echo	'<td align=center';
	if($result[-1]['swedishGoals'] != '') {
		if($result[$users[$k]]['swedishGoals'] == $result[-1]['swedishGoals'])
		echo ' bgcolor="#00FF00"';
		} else {
			echo ' bgcolor="#FFAAAA"';
		}
		echo '><span style="font-size:18px;">' . $result[$users[$k]]['swedishGoals'] . '</span></td>';
		echo	'</td></tr>';
	}
	echo '</table></div>';
		
		/**
		echo '<table border=0 bordercolor=black cellspacing=2 cellpadding=0>';
		
		echo '<tr><td colspan='.$colspans.' align=left><span class="header2"><br>&Aringttondelsfinaler</span></td></tr>';
		echo '<tr>
				<td align=left valign=bottom colspan=4></td>
				<td align=center valign=bottom><span class=vertical>Resultat</span></td>';
		for($i=1; $i<sizeof($users); $i++) {
			$user_name = mysqli_fetch_array(mysqli_query($opendb, "SELECT givenName, familyName FROM users WHERE ID ='".$users[$i]."';"), MYSQLI_ASSOC);
			echo '<td align=left valign=bottom><span class=vertical>'.$user_name['givenName'].'<br>'.$user_name['givenName'].'</span></td>';
			echo '<td style="width:1px;" bgcolor="#550000" rowspan='.$rowspan.'><img src="./pics/spacer.gif" style="width:1px;" border=0></td>';
		}
		echo '</tr>';
		$colspans = 3+sizeof($users)*3;
		$teams_res = mysqli_query($opendb, "SELECT * FROM teams ORDER BY ID ASC;");
		while($team_row = mysqli_fetch_array($teams_res)) {
			$teams[$team_row['ID']]['land'] = substr($team_row['land'],0,3);
			$teams[$team_row['ID']]['flag'] = $team_row['flagImage'];	
		}
		
		for($i=49; $i<=56; $i++) {
			echo '<tr><td align=left rowspan=3>'.$i.'. </td>';
			echo '<td align=center>H</td>';
			echo '<td align=center>&nbsp;';
			if($result[-1][$i][1] != '')
				echo '<img src="./pic/flaggor/'.$teams[$result[-1][$i][1]]['flag'].'">';
			echo '&nbsp;</td>';
			for($k=1; $k<sizeof($users); $k++) {
				echo '<td align=center style="background-color: ';
				if($result[-1][$i][1]!='') {
					if($result[$users[$k]][$i][1] == $result[-1][$i][1])
						echo '#00FF00';
					else
						echo '#FF7777';
				} else 
					echo 'none';
				echo ';">&nbsp;<img src="./pic/flaggor/'.$teams[$result[$users[$k]][$i][1]]['flag'].'" border=0>&nbsp;</td>';
			}
			echo '</tr>';
			
			echo '<tr>'.
				'<td align=center>R</td>'.
				'<td align=center>&nbsp;';
			if($result[-1][$i][0] != '')
				echo $result[-1][$i][0];
			echo '&nbsp;</td>';
			for($k=1; $k<sizeof($users); $k++) {
				echo '<td align=center style="background-color: ';
				if($result[-1][$i][0]!='') {
					if($result[$users[$k]][$i][0] == $result[-1][$i][0])
						echo '#00FF00';
					else
						echo '#FF7777';
				} else 
					echo 'none';
				echo ';">'.$result[$users[$k]][$i][0].'</td>';
			}
			echo '</tr>';
			
			echo '<tr>'.
				'<td align=center>B</td>'.
				'<td align=center>&nbsp;';
			if($result[-1][$i][2] != '')
				echo '<img src="./pic/flaggor/'.$teams[$result[-1][$i][2]]['flag'].'">';
			echo '&nbsp;&nbsp;</td>';
			for($k=1; $k<sizeof($users); $k++) {
				echo '<td align=center style="background-color: ';
				if($result[-1][$i][2]!='') {
					if($result[$users[$k]][$i][2] == $result[-1][$i][2])
						echo '#00FF00';
					else
						echo '#FF7777';
				} else 
					echo 'none';
				echo ';">&nbsp;<img src="./pic/flaggor/'.$teams[$result[$users[$k]][$i][2]]['flag'].'" border=0>&nbsp;</td>';
			}
			echo '</tr>';
		}
		echo '</table>';
		*/
		
		
			
			/**
			echo '<td align=center> - </td><td align=center>';
			if($result[-1][$i][2] != '')
				echo '<img src="./pic/flaggor/'.$teams[$result[-1][$i][2]]['flag'].'">';
			echo '&nbsp;&nbsp;</td>';
			echo '<td align=center bgcolor="#AAFFAA">'.$result[-1][0].'</td>';
			for($k=1; $k<sizeof($users); $k++) {
				echo '<td align=center style="background-color: ';
				if($result[-1][$i][1]!='') {
					if($result[$users[$k]][$i][1] == $result[-1][$i][1])
						echo '#00FF00';
					else
						echo '#FF7777';
				} else 
					echo 'none';
				echo ';"><img src="./pic/flaggor/'.$teams[$result[$users[$k]][$i][1]]['flag'].'" border=0></td>';
				echo '<td align=center style="background-color: ';
				if($result[-1][$i][0]!='') {
					if($result[$users[$k]][$i][0] == $result[-1][$i][0])
						echo '#00FF00';
					else
						echo '#FF7777';
				} else
					echo 'none';
				echo ';">'.$result[$users[$k]][$i][0].'</td>';
				echo '<td align=center style="background-color: ';
				if($result[-1][$i][2]!='') {
					if($result[$users[$k]][$i][2] == $result[-1][$i][2])
						echo '#00FF00';
					else
						echo '#FF7777';
				} else 
					echo 'none';
				echo ';"><img src="./pic/flaggor/'.$teams[$result[$users[$k]][$i][2]]['flag'].'" border=0></td>';
			}
			echo '</tr>';*/	

	/**
	// KVARTSFINALER
	echo '<tr><td colspan='.$colspans.' align=left><span class="header2"><br>Kvartsfinaler</span></td></tr>';
	
	
	// SEMIFINALER
	echo '<tr><td colspan='.$colspans.' align=left><span class="header2"><br>Semifinaler</span></td></tr>';
	
	
	// FINAL
	echo '<tr><td colspan='.$colspans.' align=left><span class="header2"><br>Final</span></td></tr>';
	
	*/
	
} else {
	if(mysqli_num_rows(mysqli_query($opendb, "SELECT id FROM tippning WHERE id = ".$_SESSION['userID'].";"))) {
		echo '<span class="header4">Kryssa f&oumlr de personer vilka Du vill j&aumlmf&oumlra Ditt resultat med.<br></span>Obs! Endast de personer som har tippat visas i listan.<br><br>';
		echo '<input type=button class=btn value="Jämför alla" onClick="this.form.action=\'index.php?sida=resultat&cmd=allusers\'; this.form.submit();"><br><br>';
		echo '<input type=hidden name=check value=true>';
		$users = mysqli_query($opendb, "SELECT users.id, users.givenName, users.familyName FROM users, tippning WHERE users.id != ".$_SESSION['userID']." AND users.id = tippning.id ORDER BY givenName ASC;") or die(mysqli_error($opendb));
		echo '<table border=0 cellspacing=0 cellpadding=2>';
		$i_user = 0;
		while($user = mysqli_fetch_array($users, MYSQLI_ASSOC)) {
			echo '<tr><td>'.$user['givenName'].' '.$user['familyName'].'</td><td><input type=checkbox name=users['.($i_user++).'] value="'.$user['id'].'"></td></tr>';
		}
		echo '</tr><tr><td colspan=2 align=right><input type=button class=btn value="Jämför!" onClick="this.form.action=\'index.php?sida=resultat\'; this.form.submit();"></td></tr></table>';
	} else {
		echo '<span class="header2">Du m&aringste tippa innan du kan j&aumlmf&oumlra ditt resultat med n&aringgon annans.<br></span>';
	}
}
?>
</td>
</tr>
</table>
<?php
} else {
	echo 'Permission denied!';
}
?>
