<?php
	require_once 'pmMain.php';
	$sumValueErtekpapirok = $connectionObj->getConnection()->query("SELECT sum(mennyiség * ea.ertek) FROM ertekpapir_adatok ea, ertekpapirok ep WHERE ea.eadatok_id = ep.ertekpapir_id AND ep.felhasznalo_id = '$user_id'")->fetch(PDO::FETCH_NUM);
	
	$sumValueIngatlan = $connectionObj->getConnection()->query("SELECT sum(ár) FROM ingatlanok WHERE felhasznalo_id = '$user_id'")->fetch(PDO::FETCH_NUM);
	
	$sumValueIngosag = $connectionObj->getConnection()->query("SELECT sum(ár) FROM ingosagok WHERE felhasznalo_id = '$user_id'")->fetch(PDO::FETCH_NUM);

	$sumValueHitelek = $connectionObj->getConnection()->query("SELECT sum(összeg) FROM hitelek WHERE felhasznalo_id = '$user_id'")->fetch(PDO::FETCH_NUM);
	
	$sumVal = round($sumValueErtekpapirok[0]) + $sumValueIngatlan[0] + $sumValueIngosag[0] - $sumValueHitelek[0];
?>
<div id='page'>
	<div><a href='pmErtekpapirok.php'>Ertekpapirok</a> <?php echo round($sumValueErtekpapirok[0]) ?></div>
	<div><a href='pmIngatlan.php'>Ingatlanok</a> <?php echo $sumValueIngatlan[0] ?></div>
	<div><a href='pmIngosag.php'>Ingóságok</a> <?php echo $sumValueIngosag[0] ?></div>
	<div><a href='pmHitelek.php'>Hitelek</a> <?php echo $sumValueHitelek[0] ?></div>
	<br>
	<div>Összesen <?php echo number_format($sumVal,0,""," "); ?></div>
</div>
<?php
include 'pmFooter.php';
/*"SELECT meret, ertek FROM ingatlanok WHERE felhasznalo_id = '$user_id'" $sumValueIngatlan = 0;
	
			
	foreach($datas as $data) {
		$value = $data->ertek*$data->meret;

		$sumValueIngatlan += $value;	
	}
	
	$sumValueIngosag = 0;
			
	foreach($datas as $data) {
		$value = $data->ertek;
		
		$sumValueIngosag += $value;	
	}
*/

?>

