<?php
	
	session_start();
	$user_id;
	if(empty($_SESSION['user'])) {
		header('location:pmLogin.php');
	} else {
		$user_id = $_SESSION['user'];
	}
	
	require_once 'pmConnection.php';
	
	
	function queryBulider($fields, $tableName) {
		$idFieldName = substr($tableName,0,strlen($tableName) - 2)."_id";
		$sqlCommand = "SELECT ".$idFieldName.",";
		foreach ($fields as $field) {
			$sqlCommand.= $field .",";
		}
		$sqlCommand = substr($sqlCommand,0,strlen($sqlCommand) - 1);
		$user_id = $_SESSION['user'];
		$orderBy = "";
		
		if(!empty($_GET['order'])) {
			$orderBy = "ORDER BY ".$_GET['order'];
		}
		$connectionObj = new Connect();
		$sqlCommand .=" FROM ".$tableName." WHERE felhasznalo_id = '$user_id' ".$orderBy; 
		return $connectionObj->getConnection()->query($sqlCommand)->fetchAll(PDO::FETCH_NUM);
	}
	
	function getFields($tablename) {
		$connectionObj = new Connect();
		$user_id = $_SESSION['user'];
		$fieldList = $connectionObj->getConnection()->query("SELECT beallitas FROM beallitasok WHERE felhasznalo_id = '$user_id' AND oldal = '$tablename'")->fetch(PDO::FETCH_NUM); 
		$fieldListRaw = $fieldList[0];
		$fields = array();
	
		while(strlen($fieldListRaw) > 0) {
			$fields[count($fields)] = substr($fieldListRaw, 0 , stripos($fieldListRaw, ","));
			$fieldListRaw = substr($fieldListRaw, strpos($fieldListRaw, ",") + 1);
		}
						
		return $fields;
	}
	
	function getFieldList($tablename) {
		$connectionObj = new Connect();
		return $fieldList = $connectionObj->getConnection()->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'$tablename'")->fetchAll(PDO::FETCH_NUM);
	}
	
	function createTable($fields, $tableName, $fieldList) {	
		echo "<button class='btn btn-info btnFieldList'>Oszlopok</button><div class='fieldListContainer'><form onchange='this.submit()' class = 'fieldList' method='POST'>";
		for($i = 1; $i < count($fieldList) - 1; $i++) {
			$l = $fieldList[$i][0];
			echo "<label>".$l."</label><input type = 'checkbox' value = '$l' name = fieldList".$i." ";
			if (array_search($fieldList[$i][0], $fields) > -1) {
				echo "checked ";
			}
			echo "/><br>";
		}
		echo "</div></form><table class='table-bordered table-striped datatable'><caption>".$tableName."</caption><thead>";
		$datas = queryBulider($fields, $tableName);
		foreach ($fields as $field) {
			echo "<th><a href=".$_SERVER['PHP_SELF']."?order=$field >".$field."</a></th>";
		}
		echo "<th colspan = '3'></th></thead><tbody>";
		
			$values = array();
			$sumvalue = 0;
		//	$index = 0;
			
			foreach($datas as $index => $data) {
				$value = $data[2];
				$values[$index] = $value;
			//	$index++;
			//	$fieldIndex = 0;
				for ($fieldIndex = 1;$fieldIndex <= count($fields);$fieldIndex++) {
					echo "<td>".$data[$fieldIndex]."</td>";
					//$fieldIndex++;
				}
				echo "<td><a href='pmReszletes.php?table=$tableName&id=$data[0]'><img src='pm_details.png'></a></td><td><a href='pmUjModVagyon.php?table=$tableName&id=$data[0]'><img src='pm_update.png'></a></td><td><a href='pmTorles.php?table=$tableName&id=$data[0]'><img src='pm_bin_icon.png'></a></td></tr>";
				
				//echo "<td><a href='pmReszletes.php?table=$tableName&id=$fieldIndex'><img src='pm_details.png'></a></td><td><a href='pmModositas.php?table=$tableName&id=$fieldIndex'><img src='pm_update.png'></a></td><td><a href='pmTorles.php?table=$tableName&id=$fieldIndex'><img src='pm_bin_icon.png'></a></td></tr>";
				$sumvalue += $value;	
			}
			echo "<tr class = 'sumRow'><td>Összesen: </td><td>".$sumvalue."</td></tr></tbody></table>";			

			echo "<canvas id='myCanvas'></canvas><ul id='chartData'><li>ALL $sumvalue</li>";
	
			foreach($datas as $dataIndex => $data ) {
				echo "<li id='name_".$dataIndex."'>".$data[1]." <a id='value_".$dataIndex."'>". round($values[$dataIndex]/$sumvalue*100) ."%</a></li>";
			
			}
			$dataLength = count($values);
			echo "<input id='data_length' type='hidden' value='$dataLength'></ul>";
	}

	$messages1 = $connectionObj->getConnection()->query("(SELECT megnevezes, day(datum) as ido FROM `feladatok` WHERE (gyakorisag = 'eves' AND datum - CURRENT_DATE < 100) OR gyakorisag = 'havi' AND day(datum) - day(CURRENT_DATE) >= 0 ORDER BY day(datum))")->fetchAll(PDO::FETCH_OBJ);
	$messages2 = $connectionObj->getConnection()->query("(SELECT megnevezes, day(datum) as ido FROM `feladatok` WHERE gyakorisag = 'havi' AND day(datum) - day(CURRENT_DATE) < 0 ORDER BY day(datum))")->fetchAll(PDO::FETCH_OBJ);

	function changeSettings($tableName) {
		$connectionObj = new Connect();
		$user_id = $_SESSION['user'];

		if(!empty($_POST)) {
			$settings="";
			foreach ($_POST as $setting) {
				$settings.=$setting.",";
			}
			
			$connectionObj->getConnection()->query("UPDATE beallitasok SET beallitas='$settings' WHERE felhasznalo_id='$user_id' AND oldal='$tableName';"); 
		}
	}
?>

<html lang='hu'>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">

		<title>Portfolio Manager</title>
		<script src='jQuery.js'></script>
		<link rel='stylesheet' href='bootstrap.css' type='text/css' />
		<link rel='stylesheet' href='pm.css' />
		<script src='bootstrap.js'></script>
		<script src='jQuery.js'></script>
		<script>
		function createChart() {
	var max = parseInt(document.getElementById("data_length").value);
	var colors = ["#fde23e","#f16e23", "#57d9ff","#937e88","#4CAF50","#f60000","#872d1d","#3204ff","#37d531","#b507f4","#000000","#fb78a6","#509b64"];
	var myData = [];
	var myColors = [];
	
	for (var i = 0; i < max; i++) {
		myData.push(parseInt(document.getElementById('value_' + i).innerHTML));
		myColors.push(colors[i]);
		document.getElementById('name_' + i).style.color=colors[i];	
	}	
	 
	 var myCanvas = document.getElementById("myCanvas");
	 myCanvas.width = 200;
	 myCanvas.height = 200;

	 var ctx = myCanvas.getContext("2d");
	 
	 function drawLine(ctx, startX, startY, endX, endY){
		    ctx.beginPath();
		    ctx.moveTo(startX,startY);
		    ctx.lineTo(endX,endY);
		    ctx.stroke();
		}
	 
	 function drawArc(ctx, centerX, centerY, radius, startAngle, endAngle){
		    ctx.beginPath();
		    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
		    ctx.stroke();
		}
	 
	 function drawPieSlice(ctx,centerX, centerY, radius, startAngle, endAngle, color ){
		    ctx.fillStyle = color;
		    ctx.beginPath();
		    ctx.moveTo(centerX,centerY);
		    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
		    ctx.closePath();
		    ctx.fill();
		}
	 
	 var Piechart = function(options){
	     this.options = options;
	     this.canvas = options.canvas;
	     this.ctx = this.canvas.getContext("2d");
	     this.colors = options.colors;
	  
	     this.draw = function(){
	         var total_value = 0;
	         var color_index = 0;
	         for (var categ in this.options.data){
	             var val = this.options.data[categ];
	             total_value += val;
	         }
	  
	         var start_angle = 0;
	         for (categ in this.options.data){
	             val = this.options.data[categ];
	             var slice_angle = 2 * Math.PI * val / total_value;
	  
	             drawPieSlice(
	                 this.ctx,
	                 this.canvas.width/2,
	                 this.canvas.height/2,
	                 Math.min(this.canvas.width/2,this.canvas.height/2),
	                 start_angle,
	                 start_angle+slice_angle,
	                 this.colors[color_index%this.colors.length]
	             );
	  
	             start_angle += slice_angle;
	             color_index++;
	         }
	  
	     }
	 }
	
	 var myPiechart = new Piechart(
	 	    {
	 	        canvas:myCanvas,
	 	        data:myData,
	 	        colors:myColors
	 	    }
	 	);
	 	myPiechart.draw();
		}
	
	$(document).ready(function () {
		$('.btnFieldList').click(function(){
			$('.fieldListContainer').slideToggle();
		});
	});
</script>
	</head>
	<body>
	 <nav class="nav navbar navbar-inverse">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Portfolio Manager</a>

  <!-- Links -->
  <ul class="nav navbar-nav">
	<li class="nav-item">
      <a class="nav-link" href="#">Fájl</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Szerkesztés</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Nézet</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="#">Előrejelzés</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="#">Elemzés</a>
    </li>
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Ablak
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="/PortfolioManager/pmOsszes.php">Összegzés</a><br>
        <a class="dropdown-item" href="/PortfolioManager/pmErtekpapirok.php">Értékpapírok</a><br>
        <a class="dropdown-item" href="/PortfolioManager/pmIngatlanok.php">Ingatalanok</a><br>
		<a class="dropdown-item" href="/PortfolioManager/pmHitelek.php">Hitelek</a><br>
		<a class="dropdown-item" href="/PortfolioManager/pmIngosagok.php">Ingóságok</a>
      </div>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="#">Súgó</a>
    </li>
  </ul>
</nav>
<?php if(!empty($_SESSION['status'])) {
		echo $_SESSION['status'];
		unset($_SESSION['status']);
	}
?>
<div class="messagesContainer"> Üzenetek
	<ul class="messageList">
	<?php 
	foreach($messages1 as $message) {
			echo "<li>".$message->megnevezes." ".$message->ido."</li>";
	}
	foreach($messages2 as $message) {
			echo "<li>".$message->megnevezes." ".$message->ido."</li>";
	}
	?>
	</ul>
</div>