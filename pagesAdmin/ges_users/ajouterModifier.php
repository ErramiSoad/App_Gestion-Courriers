<?php

    include '../../include/dbconnection.php';
    
    session_start();

    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

        header ("Location: ../index.php");
    }

    $nameUp="";
    $Niveau="";
    $Libel_user="";
    $Password="";

    $action="";
    $msg = "";

    if(isset($_GET['updateid'])){
        $id=$_GET['updateid'];
        $sql="select * from `users` where id=$id";
        $result=mysqli_Query($con, $sql);
        $row=mysqli_fetch_assoc($result);
        $nameUp=$row['login'];
        $Niveau=$row['niveau'];
        $Libel_user=$row['libel_user'];
        $Password=$row['password'];
        $action="Modifier";
        

    }else{
        $action="Ajouter";
    }
    if(isset($_POST['submit'])){
        $name=$_POST['Login'];
        $Niveau=$_POST['Niveau'];
        $Libel_user=$_POST['Libel_user'];
        $Password=md5($_POST['Password']);
        
        if((strlen($Password) < 5) ) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error !</strong> Password at least 6 Characters !</div>';
                   
            
          }elseif((!preg_match("#[0-9]+#",$Password)) ) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
             
         }
         elseif((!preg_match("#[a-z]+#",$Password))) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Your Password Must Contain At Least 1 character !</div>';
              
          }
      
    else {
        $sql="insert into `users` ( login, niveau, libel_user, Password) values ('$name', '$Niveau', '$Libel_user', '$Password')";
        if(isset($_GET['updateid'])){
            $sql="update `users` set login='$name', niveau='$Niveau', libel_user='$Libel_user' , password='$Password' where id='$id' ";
        }
        $result=mysqli_query($con, $sql);
        if($result){
            header('location:../Profile.php');
        }
    }
}

        
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Gestion courriers</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../../plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="theme-teal">
    <!-- Page Loader -->
   
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->

    <!-- #END# Overlay For Sidebars -->
        <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <p style="color:white;font-size: 1.2em;">Univérsité Caddi Ayyad </br> Présidence UCAM </p>            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <g style="font-size: 1.2em;">Gestion des Courriers</g>
                           
                        </a>
                      
                    </li>
                            
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../../images/user.jpg" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="email">Administrateur</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="../Profile.php"><i class="material-icons">person</i>Profile</a></li>
                            
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU PRINCIPALE</li>
                   
                    <li>
                        <a href="../Arriver.php">
                            <i class="material-icons">library_books</i>
                            <span>Arrivé</span>
                        </a>
                    </li>
                    <li>
                        <a href="../Depart.php">
                            <i class="material-icons">open_in_new</i>
                            <span>Départ</span>
                        </a>
                    </li>
                    <li>
                        <a href="../Recherche.php" >
                            <i class="material-icons">search</i>
                            <span>Recherche</span>
                        </a>
                        
                    </li>
                    
                    <li>
                        <a href="../Statistique.php">
                            <i class="material-icons">pie_chart</i>
                            <span>Statistique</span>
                        </a>
                    </li>

                        
                    <li>
                        <a href="javascript:void(0);" >
                            <i class="material-icons">vpn_key</i>
                            <span>Mot de Passe</span>
                        </a>
                    </li>
                    
                    </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    copyright &copy; 2022<a href="javascript:void(0);"> UCAM </a>.
                </div>
                </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        
        <!-- #END# Right Sidebar -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
            <?php 
             echo $msg  ;
           
             ?>
                <h2 style="font-weight:bold;"><?php echo $action ;?> un utilisateur</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body table-responsive">
                            <form method = "post">
                                    <div>
                                    <label for="recipient-name" style="color:#008080" >Login :</label>
                                    <input type="text" class="form-control" id="recipient-name" placeholder="Login" name="Login" required="" value=<?php echo $nameUp; ?>>
                                </div><br/>
                                <div>
                                    <label for="recipient-name" style="color:#008080" >Niveau :</label> 
                                    <input type="text" class="form-control" id="recipient-name" placeholder="Niveau" name="Niveau" value=<?php echo $Niveau; ?>>
                                </div><br/>
                                <div>
                                    <label for="recipient-name" style="color:#008080" >Libelle utilisateur :</label>
                                    <input type="text" class="form-control" id="recipient-name" placeholder="Libelle utilisateur " name="Libel_user" value=<?php echo $Libel_user; ?>>
                                </div><br/>
                                <div>
                                    <label for="recipient-name" style="color:#008080" >Mot de passe :</label>
                                    <input type="text" class="form-control" id="recipient-name" placeholder="Password" name="Password" required="" value=<?php echo $Password; ?>>
                                </div><br/>
                                <div class="modal-footer">
                                    <a href="../Profile.php"><button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button></a>
                                    <button type="submit" class="btn btn-primary" name="submit"><?php echo $action ;?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="../../plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="../../plugins/raphael/raphael.min.js"></script>
    <script src="../../plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="../../plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="../../plugins/flot-charts/jquery.flot.js"></script>
    <script src="../../plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="../../../plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="../../../plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="../../../plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="../../../plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
</body>

</html> 