<?php

	include 'pmMain.php';
	
	$connectionObj = new Connect();
	$idFieldName = substr($_GET['table'],0,strlen($_GET['table']) - 2)."_id";
	$tablename = $_GET['table'];
	$isOld = false;
	$user_id = $_SESSION['user'];
	$sql = "INSERT INTO ".$tablename." VALUES ";
	
	if($_GET['id'] !== "0") {
		$isOld = true;
		$data = $connectionObj->getConnection()->query("SELECT * FROM ".$tablename." WHERE ".$idFieldName."=".$_GET['id'])->fetch(PDO::FETCH_NUM);
		$sql = "UPDATE ".$tablename." SET ";
	} else {
		$isOld = false;
	}
	
	$fields = $connectionObj->getConnection()->query("SELECT COLUMN_NAME,DATA_TYPE,is_nullable FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'$tablename'")->fetchAll(PDO::FETCH_NUM);
	
	echo "<div id='page'><form class='form-horizontal pmForm' target='_self' method='POST' action='' enctype='multipart/form-data'>";	
	if($isOld) {
		echo $data[1];
	} else {
		echo " Új ".substr($idFieldName,0,strlen($idFieldName)-3);
	}
	//echo "".$_SERVER['PHP_SELF']."<table class = 'table table-bordered table-striped datatable'><caption>;</caption><thead><tr><th>oszlop</th><th>erték</th></thead><tbody></td><td><input type='text' name='$i' value = '</tbody></table>";
	for($i = 1; $i < count($fields) - 1; $i++) {
		echo "<div class='form-group'><label for='control-label username' class='col-sm-5'>".$fields[$i][0]."</label> <input type='text' class='form-control input-field' name='$i' size='10' pattern='[^()/><\][\\\x22,;|]+'";
		if($isOld){echo "value = '".$data[$i]."' ";}
		if($fields[$i][2] == 'NO'){echo "required ";} 
		echo "/> ";
		if($fields[$i][2] == 'NO'){echo "<a style='color:red'>*</a>";}
		echo "</div>";
	}
	echo "<div class='form-group'><input class='btn btn-success col-sm-3' name = 'pmUjModVagyonSubmit' type = 'submit' value = 'küldés'></div></form></div>";
	include 'pmFooter.php';
	
	if (isset($_POST['pmUjModVagyonSubmit'])) {
		if($isOld) {
			for($i = 1; $i < count($fields) - 1; $i++) {
				$actData = filter_var($_POST[$i], FILTER_SANITIZE_STRING);
				if(substr($fields[$i][1],0,4) === "text" || substr($fields[$i][1],0,4) === "varc" || substr($fields[$i][1],0,4) === "date") {
					$actData = "'".$actData."'";
				}
				$sql .= $fields[$i][0]."=".$actData." ";
			}
			$sql .="WHERE ".$idFieldName."=".$data[0];
		} else {
			$sql .="(null";
			for($i = 1; $i < count($fields) - 1; $i++) {
				$actData = filter_var($_POST[$i], FILTER_SANITIZE_STRING);
				if(substr($fields[$i][1],0,4) === "text" || substr($fields[$i][1],0,4) === "varc" || substr($fields[$i][1],0,4) === "date") {
					$actData = "'".$actData."'";
				}
				$sql .= ",".$actData;
			}
			$sql .=",$user_id)";
		}
	
		$connectionObj->getConnection()->query($sql);
		if($isOld) {$_SESSION['status'] = "<a class='alert alert-success'>A módosítás sikeres volt</a>";} else {$_SESSION['status'] = "<a class='alert alert-success'>Az új adat bevitele sikeres volt</a>";}
		header("location:pmOsszes.php");
	}
	/*
	$stmt = setConnection()->prepare("SELECT password FROM users WHERE user=:user");
    if (isset($_POST['usubmit'])) {
        $un = filter_var(($_POST['username']), FILTER_SANITIZE_STRING);
        $up =  filter_var(($_POST['userpassword']), FILTER_SANITIZE_STRING);
        
        $stmt->bindParam(":user", $un);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        
        if ($result->password === $up) {
            $obj = new readerClass();
            echo $obj->getFile()."<br>";
            $obj->setSession($_SERVER['PHP_SELF']);
            echo $obj->getSession()."<br>";
            $obj->setCookie("def");
            echo $obj->getCookie()."<br>";
        } else {
            sleep(5);
            echo "<a class = 'alert alert-danger'>bad password or username </a>";
            
        }
    }*/
?>