<?php
		require_once 'pmMain.php';
		
		function getActualData($link, $date) {
		$pageContent = file_get_contents($link);
		$content_start= explode('<td>árfolyam*</td>', $pageContent);
		$content_end= explode('<td>'.$date.'</td>', $content_start[1]);
		return floatval(str_replace(",",".",substr($content_end[0],144,5)));	
		}
		
		function getMainData($name) {
			$str = file_get_contents("https://www.portfolio.hu");
			$g_start= explode('<span class="name">'.$name.'</span>', $str);
			$g_end= explode('<span class="chg up">', $g_start[1]);
			return str_replace(" ","",substr($g_end[0],21,6));
		}
		$mainNames = array('EUR','USD','BUX');

		$datas = $connectionObj->getConnection()->query("SELECT * FROM ertekpapir_adatok ea, ertekpapirok ep WHERE ea.eadatok_id = ep.ertekpapir_id AND ep.felhasznalo_id = '$user_id'")->fetchAll(PDO::FETCH_OBJ);
		//$chartDatas = $connectionObj->getConnection()->query("SELECT ea.nev, sum(ep.mennyiseg * ea.ertek) as ar FROM `ertekpapirok` ep, ertekpapir_adatok ea WHERE ea.eadatok_id = ep.ertekpapir_id AND ep.felhasznalo_id = '$user_id' GROUP BY ea.nev ORDER by ea.nev")->fetchAll(PDO::FETCH_OBJ);
		$chartDatas = $connectionObj->getConnection()->query("SELECT et.nev, sum(ep.mennyiseg * ea.ertek) as ar FROM `ertekpapirok` ep, ertekpapir_adatok ea, ertekpapir_tipus et WHERE ep.ertekpapir_id = ea.eadatok_id AND ea.tipus_id = et.id AND ep.felhasznalo_id = '$user_id' GROUP By ea.tipus_id ORDER BY et.nev")->fetchAll(PDO::FETCH_OBJ);
		
		$connected = @fsockopen("www.google.com", 80); 
		if(!$connected){
			echo "<a class='alert alert-danger'>nem sikerült csatlakozni</a>";
		} else {
			foreach($mainNames as $mainName) {
				$actualMainData = intval(getMainData($mainName));
				$connectionObj->getConnection()->query("UPDATE ertekpapir_adatok SET ertek = $actualMainData WHERE nev = '$mainName'");
			} 
		}

		echo "<table class='table-bordered table-striped datatable'><caption>".'ertekpapirok'."</caption><thead><th>Név</th><th>Érték</th><th>Vásárlás óta</th><th>Éveleje óta</th><th>Frissítés óta</th><th colspan = '3'></th></thead><tbody>";		
			$sumvalue = 0;			
			foreach($datas as $index => $data) {
				$actualPrize = $data->ertek;
				$oldPrize = $data->ertek;
				
				if($data->fordulonap !== null && $data->fordulonap !== "1950-01-01" ) {	
					$actualPrize = $data->ertek * (((time() - strtotime($data->fordulonap))/(60 * 60 * 24 * 365) * $data->kamat) /100 + 1);	
				}
				
				if($data->fordulonap === "1950-01-01" && $data->ertek === '1' ) {
					$actualPrize = $data->ertek * (((time() - strtotime($data->vasarlas_datuma))/(60 * 60 * 24 * 365) * $data->kamat) /100 + 1);	
				}
				
				
				if($data->link !== null && $connected) {
					$actualPrize = getActualData($data->link,"2020-01-03");
					$connectionObj->getConnection()->query("UPDATE ertekpapir_adatok SET ertek = $actualPrize WHERE eadatok_id = $data->ertekpapir_id");
				}
				
				$value = $actualPrize * $data->mennyiseg;
				$val = round($value);
				echo "<td><a href='$data->link'>$data->nev</a></td><td>$val</td><td>".round(intval((($actualPrize/$data->bekerulesi_ertek) - 1) * 100))."%</td><td>".intval((($actualPrize/$data->eveleji_ertek) - 1) * 100)."%</td><td>".intval((($actualPrize/$oldPrize) - 1) * 100)."%</td><td><a href='pmReszletes.php?table='ertekpapirok'&id=$data->ertekpapir_id'><img src='pm_details.png'></a></td><td><a href='pmModositas.php?table='ertekpapirok'&id=$data->ertekpapir_id'><img src='pm_update.png'></a></td><td><a href='pmTorles.php?table='ertekpapirok'&id=$data->ertekpapir_id'><img src='pm_bin_icon.png'></a></td></tr>";
				$sumvalue += $value;	
			}
			$sumvalue = round($sumvalue);
			echo "<tr class = 'sumRow'><td>Összesen: </td><td>".$sumvalue."</td></tr></tbody></table>";			
			
			
			
			echo "<canvas id='myCanvas'></canvas><ul id='chartData'><li>ALL $sumvalue</li>";
	
			foreach($chartDatas as $dataIndex => $chartData ) {
				echo "<li id='name_".$dataIndex."'>".$chartData->nev." <a id='value_".$dataIndex."'>". round($chartData->ar/$sumvalue*100) ."%</a></li>";
			
			}
			$dataLength = count($chartDatas);
			echo "<input id='data_length' type='hidden' value='$dataLength'></ul>";
		

		
			echo "<table class='mainShares'><tbody>";
			foreach($mainNames as $mainName) {
				$actualValue = $connectionObj->getConnection()->query("SELECT ertek, eveleji_ertek FROM ertekpapir_adatok WHERE nev = '$mainName'")->fetch(PDO::FETCH_NUM);
				echo "<tr><td> ".$mainName." </td><td> ".$actualValue[0]." </td><td> ".intval((($actualValue[0]/$actualValue[1]) - 1) * 100)."%</td></tr>";
			}
			echo "</tbody></table>";



		include 'pmFooter.php';
?>