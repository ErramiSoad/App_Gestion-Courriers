<?php
    include '../../include/dbconnection.php';
    
    
   
    $Observ="";
    if(isset($_GET['updateid'])){
        $id=$_GET['updateid'];
     
    if(isset($_POST['submit'])){

        $Observ=$_POST['observation'];
        
               
                    $req="select id from `courriers` where numero='$id' ";
                        $resu=mysqli_query($con, $req);
                        if($resu){
                            while($row=mysqli_fetch_assoc($resu)){
                            $courrier_id=$row['id'];
                            // $sql="insert into `courriers_msg` observ_msg values('$Observ') where courrier_id='$courrier_id'";
                            $sql="update `courriers_msg` set observ_msg='$Observ' where courrier_id='$courrier_id' ";
                            $resultat=mysqli_query($con, $sql);
                            if($resultat) header('location:../Arriver.php');
                            else die(mysqli_error($con));
                                    }
                        }else{
                            die(mysqli_error($con));
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

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

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
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->

    <!-- #END# Overlay For Sidebars -->
       <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">Univérsité Caddi Ayyad </br> Présidence UCAM </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
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
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                 <div class="email">EL Abiad</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                           
                            <li><a  href="../index.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU PRINCIPALE</li>
                  
                    <li class="active">
                        <a href="Arriver.php">
                            <i class="material-icons">system_update_alt</i>
                            <span>Arrivé</span>
                        </a>
                    </li>
                    <li>
                        <a href="Recherche.php" >
                            <i class="material-icons">search</i>
                            <span>Recherche</span>
                        </a>
                        
                    </li>
                   
                    <li>
                        <a href="Statistique.php">
                            <i class="material-icons">pie_chart</i>
                            <span>Statistique</span>
                        </a>
                    </li>
  
                       
                    <li>
                        <a href="ges_users/ModifierPass/ChangePass.php" >
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
            <div class="row clearfix">
                    <div class="card">
                        <div class="header">
                          <h2>Nouveau Courriers Arrivées </h2>
                        </div>
                        <div class="body">
                            <form method='post' enctype="multipart/form-data">
                                <h2 class="card-inside-title header" style="color:#008080">Ajouter Observation</h2></br>
                              
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-5 form-control-label">
                                        <label for="observ">Observation</label>
                                    </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea name="observation" cols="30"  rows="3" class="form-control no-resize" placeholder="observation..." required ><?php echo $Observ; ?></textarea>
                                                </div>    
                                            </div> 
                                        </div> 
                                </div>  

                                
                                <button type="submit" name="submit" value="Upload" class="btn btn-primary">valider</button>
                            </form>
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