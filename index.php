<?php
	ini_set('display_errors', 'On');
	session_start();
	$page = (isset($_GET['sida']) ? $_GET['sida'] : 'startsida');
	
	include "config.php";
	include "connect_database.php";
	include "utils.php";

	// Register
	if(isset($_POST['register']) && isset($_POST['username']) && isset($_POST['password'])) {
		$result = mysqli_query($opendb, "SELECT * FROM users WHERE username = '".addslashes($_POST['username'])."' AND password = '".md5(addslashes($_POST['password']))."';") or die(mysqli_error($opendb));
		if($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			$_SESSION['user'] = $row['username'];
			$_SESSION['userFullName'] = $row['givenName'].' '.$row['familyName'];
			$_SESSION['userID'] = $row['id'];
			$_SESSION['foto'] = $row['foto'];
			$_SESSION['betalt'] = $row['betalt'];
			$_SESSION['permission'] = 1;
			$_SESSION['admin'] = $row['admin'];
                        mysqli_query($opendb, "UPDATE users SET nbrOfLogins = nbrOfLogins + 1 where id = '" . $row['id'] . "';");
			//$_SESSION['admin'] = 1;
			//$_SESSION['betalt'] = 1;
		} else {
			$logstatus = "Felaktiga inloggningsuppgifter";
			$_SESSION['permission'] = 0;
		}
	}
	
	if(isset($_GET['command'])) {
		if ($_GET['command'] == 'logout') {
			$_SESSION['username'] = '';
			$_SESSION['permission'] = 0;
			session_destroy();
			$logstatus = "Du &aumlr nu utloggad!";
		}
	}


?>

<html>
	<head>
		<title>Tippning</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link href="css/styles.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<?php
		if(activeSession()) {
			$menu[0]['token'] 	= 'startsida';
			$menu[0]['text']	= 'Start';
			$menu[0]['access']	= true;

			$menu[1]['token'] 	= 'matcher';
			$menu[1]['text']	= 'Matcher';
			$menu[1]['access']	= true;

			$menu[2]['token'] 	= 'deltagare';
			$menu[2]['text']	= 'Deltagare';
			$menu[2]['access']	= true;
			
			$menu[3]['token'] 	= 'tippning';
			$menu[3]['text']	= 'Tippning';
			$menu[3]['access']	= !$cupStarted || $_SESSION['admin'];

			$menu[4]['token'] 	= 'resultat';
			$menu[4]['text']	= 'Resultat';
			$menu[4]['access']	= $cupStarted || $_SESSION['admin'];

			$menu[5]['token'] 	= 'regler';
			$menu[5]['text']	= 'Regler';
			$menu[5]['access']	= true;

			$menu[6]['token'] 	= 'forum';
			$menu[6]['text']	= 'Forum';
			$menu[6]['access']	= true;
		?>
		<center>
			<table id="mainContainer" border="0" cellspacing="0" cellpadding="0">
				<tr valign="bottom">
					<!-- MAIN MENU -->
					<td id="topContainer" colspan="2" border="0" cellspacing="0" cellpadding="0" align="left">
						<div id="topInnerContainer">
							<div id="logo"></div>
							<div id="topBanner"></div>
							<div id="menu">
								<ul>
									<?php 
									for ($i = 0; $i < sizeof($menu); $i++) { 
										if ($menu[$i]['access'] == true) { ?>
			    						<li>
			    							<a href="index.php?sida=<?= $menu[$i]['token'] ?>" <?= $page == $menu[$i]['token'] ? 'id="current"' : "" ?>><?= $menu[$i]['text'] ?></a>
			    						</li>
		    						<?php
										} 
									} ?>
								</ul>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<!-- LEFT SIDE -->
					<td id="westContainer" border="1" valign="top" align="left">
						<div class="westPanel">
							<?php if ($_SESSION['foto'] != '') { ?>
								<img class="profilePicture" src="<?=$_SESSION['foto'];?>" />
							<?php }?>
							<p>
								<b><?=$_SESSION['user']?></b>
							</p>
							<p>
								<a href="index.php?sida=profil">Min Profil</a><br>
								<?php if (!$cupStarted) { ?>
									<a href="index.php?sida=tippning">Min Tippning</a>
								<?php } else { ?>
									<a href="index.php?sida=visadeltagare&id=<?= $_SESSION['userID'] ?>">Min Tippning</a>
								<?php } ?>
							</p>
							<a href="index.php?command=logout">Logga ut</a>
							<?php if ($_SESSION['admin']) { ?>
								<p>
									<a href="index.php?sida=usertip">Anv&aumlndar Info<br/></a>
									<a href="index.php?sida=update">Uppdatera Po&aumlng<br/></a>
								</p>
							<?php } ?>
						</div>
						<?php if ($cupStarted) { ?>
							<div class="westPanel">
								<?php include './sidor/halloffame.php'; ?>
							</div>
						<?php } ?>
					</td>
					<!-- MAIN FRAME -->
					<td id="bodyContainer" valign="top">
						<form method="POST" name="verify" enctype="multipart/form-data" id="666" onSubmit="return formCheck(this);">
							<?php include('./sidor/'.$page.'.php');?>
						</form>
					</td>
				</tr>
			</table>
		</center>
		<?php } else { ?>
		<form action="index.php" method="POST">
			<table border="0" align="center">
				<tr> 
					<td colspan="2">
						<img src="pic/banner.jpg" />
					</td>
				</tr>
				<tr>
					<td align="center">
						<table border="0">
							<tr>
								<td colspan="2">
									<h3><b>&nbsp;<?=isset($logstatus)? $logstatus : '' ?></b></h3>
								</td>
							</tr>
							<tr>
								<td>Anv&aumlndarnamn</td>
								<td><input type="text" name="username" style="width:145px;"></td>
							</tr>
							<tr>
								<td>L&oumlsenord</td>
								<td><input type="password" name="password" style="width:145px;"></td>
							</tr>
							<tr>
								<td colspan="2" align="right">
									<input type="hidden" name="register" value="true" />
									<input type="submit" class="btn" value="Logga in" />
								</td>
							</tr>
						</table>
						<?php if(!$cupStarted) { ?>
							<a href="registrera.php">Registrera ny anv&aumlndare</a>
						<?php } else { ?>
							<i>Registreringen &aumlr st&aumlngd - cupen har startat!</i>
						<?php } ?>
					</td>
				</tr>
			</table>
		</form>
		<?php } ?>
	</body>
</html>
