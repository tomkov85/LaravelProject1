<?php	
	require_once 'pmConnection.php';
	$connectionObj = new Connect();
	
	$tablename = $_GET['table'];
	$idFieldName = substr($_GET['table'],0,strlen($_GET['table']) - 2)."_id";
	
	session_start();
	if($connectionObj->getConnection()->query("DELETE FROM ".$tablename." WHERE ".$idFieldName."=".$_GET['id'])) {
		$connectionObj->getConnection()->query("DELETE FROM ".$tablename." WHERE ".$idFieldName."=".$_GET['id']);
		$_SESSION['status'] = "<a class='alert alert-success'> A törlés sikerült!</a>";
	} else {
		$_SESSION['status'] = "<a class='alert alert-danger'> A törlés nem sikerült!</a>";
	}
	header('location:pmIngatlanok.php');
?>