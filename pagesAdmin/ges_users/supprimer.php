 <?php
 
$con=mysqli_connect("localhost", "root", "", "gestion_courriers");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}


if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="delete from `users` where id=$id";
    $result=mysqli_query($con, $sql);
    
    if($result){
        //echo "deleted";
        header('location:../Profile.php');
    }else{
        die(mysqli_error($con));
    }
}

?>