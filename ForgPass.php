
<!DOCTYPE html>
<html>
<head>
	<title>Mot de passe oublier</title>
	<link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body>
	<?php 

?>
<form class="bg-light p-5 shadow-lg" method="post">
				
				<h1 class="text-success">Mot de passe oublié</h1>
				<label for="Email" style="font-weight: bold;">Email</label>
				<input type="email" name="email" placeholder="Email Address" class="form-control form-control-sm" required><br>
				<button type="submit" >réinitialiser Mot de passe</button>
				
			</form>
<?php

if(isset($_POST['email']) ){
	$username = "root";
	$password = "";
   $db = new PDO("mysql:host=localhost;dbname=gestion_courriers",$username,$password);
  $checkEmail = $db->prepare("SELECT email FROM users WHERE email = :email");
  $checkEmail->bindParam("email",$_POST['email']);
   $checkEmail->execute();
  if( $checkEmail->rowCount() > 0){
   require_once 'mail.php';
   $password=uniqid();
  $hashedPassword=md5($password);
   $user = $checkEmail->fetchObject();
   $mail->addAddress($_POST['email']);
    $mail->Subject = "change password";
     $mail->Body = "Bonjour ,voici votre nouveau mot de passe $password" ." veuiller svp le changer après ";
    $mail->setFrom(" fatibaai077@gmail.com ", "BAALI ");
   $mail->send();
   $sql="UPDATE users SET password= ? WHERE email=?";
	$stmt=$db->prepare($sql);
	$stmt->execute([$hashedPassword,$_POST['email']]);
   echo 'nous avons envoyer à votre email votre mot de passe ';
	
   }else{
   echo "Ce mail n'existe pas";
   }
}


?>


 

</body>
</html>