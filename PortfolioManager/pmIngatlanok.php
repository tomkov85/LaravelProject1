<?php
	include 'pmMain.php';
	$connectionObj = new Connect();
	$datas1 = $connectionObj->getConnection()->query("SELECT ingatlan_id,nev, meret, ertek, berleti_dij FROM ingatlanok WHERE felhasznalo_id = '$user_id'")->fetchAll(PDO::FETCH_OBJ);
	
?>
<div id='page'>
<a href='' class = 'btn btn-success newBtn'>Új ingatlan</a>
<table class='table-bordered table-striped datatable'>
	<caption>Ingatlanok</caption>
	<thead><th>nev</th><th>meret</th><th>ertek</th><th>berleti_dij</th></thead>
	<tbody>
		<?php
			$values = array();
			$sumvalue = 0;
			$reSumRentalPrize = 0;
			$index = 0;
			
			foreach($datas1 as $data) {
				$value = $data->ertek*$data->meret;
				$values[$index] = $value;
				$index++;
				echo "<tr><td>".$data->nev."</td><td>".$data->meret."</td><td>".$value."</td><td>".$data->berleti_dij."</td><td><a href='pmReszletes.php?table=ingatlan&id=$data->ingatlan_id'><img src='pm_details.png'></a></td><td><a href='pmModositas.php?table=ingatlan&id=$data->ingatlan_id'><img src='pm_update.png'></a></td><td><a href='pmTorles.php?table=ingatlan&id=$data->ingatlan_id'><img src='pm_bin_icon.png'></a></td></tr>";
				$sumvalue += $value;
				$reSumRentalPrize += $data->berleti_dij;	
			}
			echo "<tr><td></td><td></td><td>".$sumvalue."</td><td>".$reSumRentalPrize."</td></tr>";
		?>
	</tbody>
</table>
<canvas id="myCanvas"></canvas>
<ul id="chartData">
	<li>ALL <?php echo $sumvalue?></li>
	<?php
			$counter = 0;
			foreach($datas1 as $data) {
				echo "<li id='name_".$counter."'>".$data->nev." <a id='value_".$counter."'>". round($values[$counter]/$sumvalue*100) ."%</a></li>";
				$counter++;
			}
			echo "<input id='data_length' type='hidden' value='$counter'>";
		?>
</ul>
</div>
<?php
include 'pmFooter.php';
?>