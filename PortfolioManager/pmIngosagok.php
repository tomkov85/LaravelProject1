<?php

	include 'pmMain.php';
	
	$fieldList = $connectionObj->getConnection()->query("SELECT beallitas FROM beallitasok WHERE felhasznalo_id = '$user_id' AND oldal = 'ingosagok'")->fetch(PDO::FETCH_NUM); 
	$fieldListRaw = $fieldList[0];
	$fields = array();
	
	while(strlen($fieldListRaw) > 0) {
		$fields[count($fields)] = substr($fieldListRaw, 0 , stripos($fieldListRaw, ","));
		$fieldListRaw = substr($fieldListRaw, strpos($fieldListRaw, ",") + 1);
	}
	
	$fieldList = $connectionObj->getConnection()->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'ingosagok'")->fetchAll(PDO::FETCH_NUM);
	//$fields = array("nev", "ertek", "ingosag_id");
?>
<div id='page'>
<?php createTable($fields, "ingosagok", $fieldList); ?>

</div>
<?php
include 'pmFooter.php';
?>