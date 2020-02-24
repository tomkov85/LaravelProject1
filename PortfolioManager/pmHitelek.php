<?php

	include 'pmMain.php';
	changeSettings("hitelek");
?>
<div id='page'>
<a href="pmUjModVagyon.php?table=hitelek&id=0" class='btn btn-success'>Új Hitel</a>
<?php createTable(getFields("hitelek"), "hitelek", getFieldList("hitelek")); ?>

</div>
<?php
include 'pmFooter.php';
?>