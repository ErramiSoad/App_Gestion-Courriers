<?php
 
 $con=mysqli_connect("localhost", "root", "", "gestion_courriers");
 if(mysqli_connect_errno()){
 echo "Connection Fail".mysqli_connect_error();
 }
 
 
 if(isset($_GET['deleteid'])){
     $id=$_GET['deleteid'];
     
     $req="select id from courriers where numero='$id'";
     $resultt=mysqli_query($con, $req);
     
     if($resultt){
        while($row=mysqli_fetch_assoc($resultt)){
            $courrier_id=$row['id'];
        
            $sql="delete from `courriers` where id='$courrier_id'";
            $result=mysqli_query($con, $sql);
            
            if($result){
            //     //echo "deleted";
                header('location:../Arriver.php');
            }else{
                die(mysqli_error($con));
            }
        }
       
 }

 }
 
 ?>