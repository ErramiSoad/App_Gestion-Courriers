<?php
include '../include/dbconnection.php';
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

    header ("Location: ../index.php");
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
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
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
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                 <div class="email">Bureau d'ordre</div>
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
                   
                    <li>
                        <a href="Arriver.php">
                            <i class="material-icons">system_update_alt</i>
                            <span>Arrivé</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="Depart.php">
                            <i class="material-icons">open_in_new</i>
                            <span>Départ</span>
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                          <h2>Listes des Courriers de Départ </h2>
                          <ul class="header-dropdown m-r--5">
                            <li>
                            <a href="ges_courriers/DepartForm.php"><button title="add"  class="btn btn-info btn-sm"><i style="color:white" class="material-icons">add_circle_outline</i> Nouveau </button></a>
                            </li>
                          </ul></br>
                        </div>
                        <div class="body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                 <tr>
                                    <th></th>
                                    <th style="color:#008080">N°BO</th>
                                    <th style="color:#008080">DateBO</th>
                                    <th style="color:#008080">Service</th>
                                    <th style="color:#008080">Vers</th>
                                    <th style="color:#008080">Objet</th>
                                    <th style="color:#008080"></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php

                                        $sql="SELECT c.numero ,c.exp_date ,c.objet, c.sortie, c.chemin, serv.libel_service, d.dest_etablis, d.courrier_id, e.libel_etablis
                                        FROM courriers c , courriers_services serv , courriers_destinations d ,courriers_etablissements e
                                        WHERE serv.id=c.service_id 
                                        AND d.courrier_id=c.id
                                        AND d.dest_etablis=e.id
                                        AND c.type_courrier ='D'";
                                       
                                        $result=mysqli_Query($con, $sql);
                                            if($result)
                                            
                                            while($row=mysqli_fetch_assoc($result)){
                        
                                                $id=$row['numero'];
                                                $arrive=$row['exp_date'];
                                                $service=$row['libel_service'];
                                                $etablis=$row['libel_etablis'];
                                                $obj=$row['objet'];
                                                $sortie=$row['sortie'];
                                                $chemin=$row['chemin'];
                                                $date=explode("-",$arrive);

                                                // $icon='';
                                                // if($sortie=='N') $icon='<a style="color:#008080" ><i class="material-icons">email</i></a>';
                                                // else $icon='<a style="color:#008080" ><i class="material-icons">drafts</i></a>';
                                                
                                                
                                                    echo '
                                                        <tr>
                                                            <td>
                                                                <a style="color:#008080" href="../files/PUCA/'.$date[0].'/'.$date[1].'/'.$chemin.'.pdf" target="_blank" updateid='.$id.' name="click" ><i class="material-icons">find_in_page</i></a>
                                                            </td>
                                                           
                                                        <th scope="row">'.$id.'</th>
                                                            <td>'.$arrive.'</td>
                                                            <td>'.$service.'</td>
                                                            <td>'.$etablis.'</td>
                                                            <td>'.$obj.'</td>
                                                            
                                                            
                                                           
                                                            
                                                            
                                                            
                                                        
                                                        </tr>
                                                        ';
                                                    }
                                    ?>
                            </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
           
          
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="../plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="../plugins/raphael/raphael.min.js"></script>
    <script src="../plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="../plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="../plugins/flot-charts/jquery.flot.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="../../plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="../../plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="../../plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="../../plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>