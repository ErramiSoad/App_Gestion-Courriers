<?php 
session_start();
require '../../../include/dbconnection.php';
if (isset($_SESSION['id']) && isset($_SESSION['login'])) {
//$np='';
//$np=$_SESSION['msg'];
	
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Changer votre mot de passe</title>
	<link rel="stylesheet" type="text/css" href="../../../css/style1.css">
</head>
<body>

    <form action="change-p.php" method="post">
     	<h2>Changer votre mot de passe</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } 
		//echo  $np ;
		
	
		?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

     	<label>Mot de passe actuel</label>
     	<input type="password" 
     	       name="op" 
     	       placeholder="Mot de passe actuel">
     	       <br>

     	<label>Nouveau Mot de passe</label>
     	<input type="password" 
     	       name="np" 
     	       placeholder="Nouveau Mot de passe"  required minlength="6" >
     	       <br>

     	<label>Confirmer Mot de passe</label>
     	<input type="password" 
     	       name="c_np" 
     	       placeholder="Confirmer Mot de passe">
     	       <br>

     	<button type="submit">CHANGER</button>
          <a href="../../Statistique.php" class="ca">HOME</a>
     </form>
</body>
</html>

<?php 
}else{
     //header("Location: index.php");
     exit();
}
 ?>