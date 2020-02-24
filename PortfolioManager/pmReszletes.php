<?php

	include 'pmMain.php';
	
	$connectionObj = new Connect();
	$idFieldName = substr($_GET['table'],0,strlen($_GET['table']) - 2)."_id";
	$tablename = $_GET['table'];
	$data = $connectionObj->getConnection()->query("SELECT * FROM ".$tablename." WHERE ".$idFieldName."=".$_GET['id'])->fetch(PDO::FETCH_NUM);
	$fields = $connectionObj->getConnection()->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'$tablename'")->fetchAll(PDO::FETCH_NUM);
	
	echo "<div id='page'><table class = 'table table-bordered table-striped table-hover datatable'><caption>".$data[1]."</caption><thead><tr><th>oszlop</th><th>erték</th></thead><tbody>";
	for($i = 2; $i < count($data) - 1; $i++) {
		echo "<tr><td>".$fields[$i][0]."</td><td>".$data[$i]."</td></tr>";
	}
	echo "</tbody></table></div>";
	include 'pmFooter.php';
?>