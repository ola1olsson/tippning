<?php

if(activeSession()) {
?>


<table BGCOLOR="#FFFFFF" width="100%" height="100%"  bordercolor="#6C261F"  cellpadding="30" cellspacing="0">
	<tr>
		<td align="left" valign="top" frame="rhs" border="1"> 
			<center>
				<span class="header">Regler</span>
			</center>
			<br/>
			<b>Allm&aumlnt<br/></b>
			Inbjudan g&aumlller endast dig, eftersom du &aumlr s&aring speciell.<br/>
			Deltagandet kostar <?=$price?> SEK<br/>
			<?=$procent_ett?>% till vinnaren </br>
			<?=$procent_tva?>% till tv&aringan</br>
			<?=$procent_tre?>% till trean</br>
			</br> 
			Du m&aringste ha tippat <u>senast</u> <?=$last_bet_day?><br/>
			Din tippning beh&oumlver inte st&aumlmma hela v&aumlgen igenom.<br/>
			Dvs att om du i gruppspelet f&aringr ett lag som vinnare via resultat beh&oumlver du inte s&aumltta detta lag som vinnare f&oumlr gruppen.<br/>
			<br/>
			<b>Resultat<br/></b>
			I gruppspelet och slutspelet g&aumlller resultaten 1 X 2<br/>
			Finalen och match om brons tippar du också 1 2.<br/>
			Skulle lagen vara skiftade, dvs hemma och bortalag, f&aringr du inget po&aumlng.<br/>
			<br/>
			<b>Tvist</b><br/>
			Skulle tvist av n&aringgot slag uppst&aring kommer ansvarig f&oumlr tippningen att avg&oumlra beslut.<br/>
			Ansvarigs beslut g&aumlller oavsett deltagarens vilja.<br/>
			<br/>
			<b>Po&aumlngs&aumlttning</b><br/>
			<table width="200" border="0">
				<tr>
					<td width="150">1 X 2</td>
					<td>1p</td>
				</tr>
				<tr>
					<td>R&aumltt tredjeplatsfinallag</td>
					<td>5p</td>
				</tr>
				<tr>
					<td>R&aumltt finallag</td>
					<td>5p</td>
				</tr>
				<tr>
					<td>Hur m&aringnga m&aringl g&oumlr Sverige</td>
					<td>5p</td>
				</tr>
				<tr>
					<td>Vem g&oumlr flest m&aringl</td>
					<td>5p</td>
				</tr>
			</table>
			<br/>
			<b>Betalning</b><BR/>
			F&oumlr att vara med i tippningen m&aringste man betala in <?= $price ?>kr till bankkonto <b><?= $contactBankAccount ?></b> (<?= $contactBankName ?>). Betalning m&aringste vara gjord <font color="red">SENAST <?= $last_pay_day ?></font>, annars tas anv&aumlndaren bort. <br/>

			<p><b>Var noga med att skriva ert anv&aumlndarnamn i meddelandef&aumlltet vid betalning s&aring att vi kan koppla r&aumltt pengar till r&aumltt konto!</b></p>

			F&oumlr fr&aringgor eller mer information, kontakta <?= $contactName ?>.<br/>
			Telefon: <?= $contactPhone ?><br/>
			E-mail: <?= $contactEmail ?><br/>
		</td>
	</tr>
</table>

<?php
} else
	echo 'Permission denied!';
?>
