<?php 
session_start();
$msg='';
if (isset($_SESSION['id']) && isset($_SESSION['login'])) {

    require '../../../include/dbconnection.php';
if (isset($_POST['op']) && isset($_POST['np']) && isset($_POST['c_np'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
	
	$id = $_SESSION['id'];
	$c_np = validate($_POST['c_np']);
	echo '$np';
    
    if(empty($op)){
      header("Location:ChangePass.php?error=Old Password is required");
	  exit();
    }else if(empty($np)){
      header("Location:ChangePass.php?error=New Password is required");
	  exit();
    }else if($np !== $c_np){
      header("Location:ChangePass.php?error=The confirmation password  does not match");
	  exit();
    }elseif(strlen($np) < 5) {
		$msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Error !</strong> Password at least 6 Characters !</div>';
			   
		
	  }elseif(!preg_match("#[0-9]+#",$np)) {
		$msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
		 
	  }elseif(!preg_match("#[a-z]+#",$np)) {
		$msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
		 
  $_SESSION['msg']= $msg ;
 
	  }
	
  

	else {
    	// hashing the password
    	$op = md5($op);
    	$np = md5($np);

		

        $sql = "SELECT password
                FROM users WHERE 
                id='$id' AND password='$op'";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) === 1){
        	
        	$sql_2 = "UPDATE users
        	          SET password='$np'
        	          WHERE id='$id'";
        	mysqli_query($con, $sql_2);
        	header("Location:ChangePass.php?success=Your password has been changed successfully");
	        exit();

        }else {
        	header("Location:ChangePass.php?error=Incorrect password");
	        exit();
        }

    }

    
}else{
	header("Location:ChangePass.php");
	exit();
}

}else{
     header("Location: pages/Home.php");
     exit();
}

?>