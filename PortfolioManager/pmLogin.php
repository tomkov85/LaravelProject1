<?php

	require_once 'pmConnection.php';
	$stmt = $connectionObj->getConnection()->prepare("SELECT felhasznalo_id,jelszo FROM felhasznalo WHERE felhasznalo_nev = :un");

?>
<form class='form-horizontal' target='_self' method='POST' action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
			<div class='form-group'>
				<label for='control-label username' class='col-sm-5'>Name: </label> <input type='text' class='form-control input-field' name='username' size='10' pattern='[^()/><\][\\\x22,;|]+'/>
			</div>
			<div class='form-group'>
				<label for='control-label password' class='col-sm-5'>Password: </label> <input type='text' class='form-control input-field' name='userpassword' size='10' pattern='[^()/><\][\\\x22,;|]+'/>
			</div>
			<div class='form-group'>
				<input type='submit' name='usubmit' value='Send' class='btn btn-success col-sm-3 submit-btn' />
			</div>
</form>

<?php
	if (isset($_POST['usubmit'])) {
    $un = $_POST['username'];
    $up = $_POST['userpassword'];
    
    if($un === filter_var($un, FILTER_SANITIZE_STRING)) {
        $stmt->bindParam(":un", $un);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
		
        if($up === $user->jelszo) {
           session_start();
		   $_SESSION['user'] = $user->felhasznalo_id;
		   header('location:pmOsszes.php');
        } else {
            echo "<p class='alert alert-danger col-sm-3'> Wrong creditanstals! </p>";
            sleep(10);
        }
    } else {
        echo "<p class='alert alert-danger col-sm-3'> please dont use special characters </p>";
    } 
}
?>