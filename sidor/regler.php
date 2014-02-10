<?
if(session_is_registered('permission') && $_SESSION['permission']) {
?>

<table BGCOLOR="#FFFFFF" width="100%" height="100%"  bordercolor="#6C261F"  cellpadding="30" cellspacing="0">
	<tr>
		<td align="left" valign="top" frame="rhs" border="1"> 
			<center>
				<span class="header">Regler</span>
			</center>
			<br/>
			<b>Allmänt<br/></b>
			Detta är en privat tippning för ett slutet sällskap gjord av Thobias Karlsson från början.<br/>
                        Ola har fått tillgång och ändrat i den ursprungliga koden.
			Inbjudan gäller endast dig, eftersom du är så speciell.<br/>
			Deltagandet kostar <?=$price?> SEK där hälften går till FC Österlen<br/>
                        Av de resterande pengarna går:</br>
                        <?=$procent_ett?>% till vinnaren </br>
                        <?=$procent_tva?>% till tvåan</br>
                        <?=$procent_tre?>% till trean</br>
                        </br> 
			Du måste ha tippat <u>senast</u> <?=$last_bet_day?><br/>
			Skulle någon match bli inställd kommer den inte att ge några poäng.<br/>
			Din tippning behöver inte stämma hela vägen igenom.<br/>
			Dvs att om du i gruppspelet får ett lag som vinnare via resultat behöver du inte sätta detta lag som vinnare för gruppen.<br/>
			<br/>
			<b>Resultat<br/></b>
			I gruppspelet gäller resultaten 1 X 2<br/>
			I slutspelet gäller 1 2, eftersom ett lag måste vinna.<br/>
			Skulle lagen vara skiftade, dvs hemma och bortalag, får du inget poäng.<br/>
			<br/>
			<b>Vinst</b><br/>
			Den person med flest poäng tar hem rubbet!
			<br/>
			<b>Tvist</b><br/>
			Skulle tvist av något slag uppstå kommer ansvarig för tippningen att avgöra beslut.<br/>
			Ansvarigs beslut gäller oavsett deltagarens vilja.<br/>
			<br/>
			<b>Poängsättning</b><br/>
			<table width="200" border="0">
				<tr>
					<td width="150">1 X 2</td>
					<td>1p</td>
				</tr>
				<tr>
					<td>Rätt åttondelsfinallag</td>
					<td>2p</td>
				</tr>
				<tr>
					<td>Rätt kvartsfinallag</td>
					<td>3p</td>
				</tr>
				<tr>
					<td>Rätt semifinallag</td>
					<td>4p</td>
				</tr>
				<tr>
					<td>Rätt tredjeplatsfinallag</td>
					<td>5p</td>
				</tr>
				<tr>
					<td>Rätt finallag</td>
					<td>5p</td>
				</tr>
				<tr>
					<td>Hur många mål gör Brasilien</td>
					<td>5p</td>
				</tr>
				<tr>
					<td>Vem gör flest mål</td>
					<td>5p</td>
				</tr>
			</table>
			<br/>
			<b>Betalning</b><BR/>
			För att vara med i tippningen måste man betala in <?= $price ?>kr till bankkonto <b><?= $contactBankAccount ?></b> (<?= $contactBankName ?>). Betalning måste vara gjord <font color="red">SENAST <?= $last_pay_day ?></font>, annars tas användaren bort. <br/>

			<p><b>Var noga med att skriva ert användarnamn i meddelandefältet vid betalning så att vi kan koppla rätt pengar till rätt konto!</b></p>

			För frågor eller mer information, kontakta <?= $contactName ?>.<br/>
			Telefon: <?= $contactPhone ?><br/>
			E-mail: <?= $contactEmail ?><br/>
		</td>
	</tr>
</table>

<?
} else
	echo 'Permission denied!';
?>
