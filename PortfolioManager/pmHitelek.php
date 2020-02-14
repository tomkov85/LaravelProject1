<?php
	include 'pmMain.php';
	$fields = array("nev", "osszeg", "torlesztoreszlet", "futamido", "hitel_id");
?>
<div id='page'>
<?php createTable($fields, "hitelek"); ?>

</div>
<?php
include 'pmFooter.php';
?>