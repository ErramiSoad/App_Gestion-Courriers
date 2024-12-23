
<?php

require 'include/dbconnection.php';
session_start();
$err='';
$_SESSION['login']='';
$_SESSION['id'] ='';
$sql="select * from users";
$user= $con->query($sql);
foreach($user as $row){
	if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        // $sql = "SELECT * FROM users WHERE login ='$username' AND password='$password'";
        // $query =mysqli_Query($con,$sql);
		// echo $query->num_rows;
		if($username==$row['login'] &&  $password==$row['password'] && $row['niveau']=='1'){
			//BO
            $_SESSION['login']=$row['login'];
			$_SESSION['id'] =$row['id'];
            header("location:pagesBO/Statistique.php");
		}
		elseif($username==$row['login'] && $password==$row['password'] && $row['niveau']=='2'){
			//admin
				$_SESSION['login']=$row['login'];
				$_SESSION['id'] =$row['id'];
			     header("location:pagesAdmin/Statistique.php");
			}
		elseif($username==$row['login'] && $password==$row['password'] && $row['niveau']=='3'){
				//CP
					$_SESSION['login']=$row['login'];
					$_SESSION['id'] =$row['id'];
					 header("location:pagesCP/Statistique.php");
				}
		elseif($username==$row['login'] && $password==$row['password'] && $row['niveau']=='4'){
					//User
						$_SESSION['login']=$row['login'];
						$_SESSION['id'] =$row['id'];
						 header("location:pagesUser/Statistique.php");
					}else{
				$err="email ou le mot de passe est incorrect ";
			}
}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>login</title>
    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/styleIndex.css">
</head>
<body >
	<div class="container">
		<?php 
		echo $err;
		 ?>
 	<div class="header">
 		<h1>login</h1>
 	</div>
 	<div class="main">
 		<form  method="post">
			
 			<span>
 				<i class="fa fa-user"></i>
 				<input type="text" placeholder="Username" name="username" required="">
 			</span><br>
 			<span>
 				<i class="fa fa-lock"></i>
 				<input type="password" placeholder="password" name="password"  required>
				
 			</span><br>
 				<button name="login" style="cursor:pointer ; color:black;">login</button><br>
 					<span>
 				<button><a class="underlineHover" href="ForgPass.php" style="cursor:pointer ; color:black; " >Forgot Password</a></button>
 				</span>
 			

 		</form>
 	</div>
</div>
 </div>
</body>
</html>