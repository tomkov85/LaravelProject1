<?php
	require_once 'pmMain.php';
	
	$datas = $connectionObj->getConnection()->query("SELECT meret, ertek FROM ingatlanok WHERE felhasznalo_id = '$user_id'")->fetchAll(PDO::FETCH_OBJ);
	
	$sumValueIngatlan = 0;
			
	foreach($datas as $data) {
		$value = $data->ertek*$data->meret;

		$sumValueIngatlan += $value;	
	}
	
	$datas = $connectionObj->getConnection()->query("SELECT ertek FROM ingosagok WHERE felhasznalo_id = '$user_id'")->fetchAll(PDO::FETCH_OBJ);

	$sumValueIngosag = 0;
			
	foreach($datas as $data) {
		$value = $data->ertek;
		
		$sumValueIngosag += $value;	
	}
?>
<div id='page'>
	<div><a href='pmIngatlan.php'>Ingatlanok</a> <?php echo $sumValueIngatlan ?></div>
	<div><a href='pmIngosag.php'>Ingóságok</a> <?php echo $sumValueIngosag ?></div>
</div>
<?php
include 'pmFooter.php';
?>