<?php
	include "config.php";
	include "connect_database.php";


if(!isset($_SESSION['permission']) || !$_SESSION['permission']) {
?>


<table BGCOLOR="#FFFFFF" width="100%" height="100%"  bordercolor="#6C261F"  cellpadding="30" cellspacing="0">
	<tr>
		<td align="left" valign="top" frame="rhs" border="1"> 
			<center>
				<span class="header">Regler</span>
			</center>
			<br/>
			<b>Allm�nt<br/></b>
			Detta �r en privat tippning f�r ett slutet s�llskap gjord av Thobias Karlsson fr�n b�rjan.<br/>
                        Ola har f�tt tillg�ng och �ndrat i den ursprungliga koden.
			Inbjudan g�ller endast dig, eftersom du �r s� speciell.<br/>
			Deltagandet kostar <?=$price?> SEK d�r h�lften g�r till FC �sterlen<br/>
                        Av de resterande pengarna g�r:</br>
                        <?=$procent_ett?>% till vinnaren </br>
                        <?=$procent_tva?>% till tv�an</br>
                        <?=$procent_tre?>% till trean</br>
                        </br> 
			Du m�ste ha tippat <u>senast</u> <?=$last_bet_day?><br/>
			Skulle n�gon match bli inst�lld kommer den inte att ge n�gra po�ng.<br/>
			Din tippning beh�ver inte st�mma hela v�gen igenom.<br/>
			Dvs att om du i gruppspelet f�r ett lag som vinnare via resultat beh�ver du inte s�tta detta lag som vinnare f�r gruppen.<br/>
			<br/>
			<b>Resultat<br/></b>
			I gruppspelet g�ller resultaten 1 X 2<br/>
			I slutspelet g�ller 1 2, eftersom ett lag m�ste vinna.<br/>
			Skulle lagen vara skiftade, dvs hemma och bortalag, f�r du inget po�ng.<br/>
			<br/>
			<b>Vinst</b><br/>
			Den person med flest po�ng tar hem rubbet!
			<br/>
			<b>Tvist</b><br/>
			Skulle tvist av n�got slag uppst� kommer ansvarig f�r tippningen att avg�ra beslut.<br/>
			Ansvarigs beslut g�ller oavsett deltagarens vilja.<br/>
			<br/>
			<b>Po�ngs�ttning</b><br/>
			<table width="200" border="0">
				<tr>
					<td width="150">1 X 2</td>
					<td>1p</td>
				</tr>
				<tr>
					<td>R�tt �ttondelsfinallag</td>
					<td>2p</td>
				</tr>
				<tr>
					<td>R�tt kvartsfinallag</td>
					<td>3p</td>
				</tr>
				<tr>
					<td>R�tt semifinallag</td>
					<td>4p</td>
				</tr>
				<tr>
					<td>R�tt tredjeplatsfinallag</td>
					<td>5p</td>
				</tr>
				<tr>
					<td>R�tt finallag</td>
					<td>5p</td>
				</tr>
				<tr>
					<td>Hur m�nga m�l g�r Brasilien</td>
					<td>5p</td>
				</tr>
				<tr>
					<td>Vem g�r flest m�l</td>
					<td>5p</td>
				</tr>
			</table>
			<br/>
			<b>Betalning</b><BR/>
			F�r att vara med i tippningen m�ste man betala in <?= $price ?>kr till bankkonto <b><?= $contactBankAccount ?></b> (<?= $contactBankName ?>). Betalning m�ste vara gjord <font color="red">SENAST <?= $last_pay_day ?></font>, annars tas anv�ndaren bort. <br/>

			<p><b>Var noga med att skriva ert anv�ndarnamn i meddelandef�ltet vid betalning s� att vi kan koppla r�tt pengar till r�tt konto!</b></p>

			F�r fr�gor eller mer information, kontakta <?= $contactName ?>.<br/>
			Telefon: <?= $contactPhone ?><br/>
			E-mail: <?= $contactEmail ?><br/>
		</td>
	</tr>
</table>

<?php
} else
	echo 'Permission denied!';
?>
