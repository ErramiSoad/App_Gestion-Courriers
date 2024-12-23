<?php
include '../../include/dbconnection.php';
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

    header ("Location: ../index.php");
}
$numm="SELECT max(c.numero) AS num FROM courriers c WHERE c.type_courrier='D'";

        $result=mysqli_Query($con, $numm);
        if($result)
        while($row=mysqli_fetch_assoc($result)){
        $id=$row['num'];
       
        }
    
if(isset($_POST['submit'])){
    
        $numr=$_POST['numr'];
        $support=$_POST['support'];
        $date=$_POST['date'];
        $serv=$_POST['service'];
        $piece=$_POST['piece'];
        $nombre=$_POST['nbr'];
        $etab=$_POST['etablis'];
        $obj=$_POST['objet'];
        if(!empty($_FILES)){
            $fn=$_FILES['fichier']['name'];
            $file_extension= strrchr($fn,".");
            $tm=$_FILES['fichier'][ 'tmp_name'];
            // echo 'depart'.$date;
            $annee=explode("-",$date);
            // print_r($annee);
            $nomFichier='D_'.$date.'_'.$numr;
            // $fd = "sample/path/newfolder";
            $fd='../../files/PUCA/'.$annee[0];
            if (!file_exists($fd)) {
                mkdir($fd, 0777, true);
            }
            if (!file_exists($fd.'/'.$annee[1])) {
                mkdir($fd.'/'.$annee[1], 0777, true);
            }
            $fd='../../files/PUCA/'.$annee[0].'/'.$annee[1].'/'.$nomFichier.'.pdf';
            $extensions_autorises=array('.pdf','.PDF');
            if(in_array($file_extension,$extensions_autorises)){
                if(move_uploaded_file($tm, $fd)){

            $sql="insert into `courriers`( numero, support_id, exp_date, enregistre_le, service_id, type_courrier, pj, nbr_pj, objet, sortie, chemin) values ( '$numr', '$support', '$date', NOW(),'$serv','D','$piece', '$nombre', '$obj', 'N', '$nomFichier')";
            $result=mysqli_query($con, $sql);
                if($result){
                    $req="select id from `courriers` where numero='$numr' ";
                    $resu=mysqli_query($con, $req);
                    if($resu){
                        while($row=mysqli_fetch_assoc($resu)){
                        $courrier_id=$row['id'];
                    $sql="insert into `courriers_destinations`( courrier_id, exp_etablis, dest_etablis) values ( '$courrier_id', '98', '$etab')";
                    $resultat=mysqli_query($con, $sql);
                    if($resultat) header('location:DepartForm.php');
                    else die(mysqli_error($con));
                    }
                }else{
                    die(mysqli_error($con));
                }
            }else{
                die(mysqli_error($con));
            }
                echo'Fichier envoyé avec succès';
            } else {
                echo "une erreur est revenue";
            } 
            }else {
                echo 'seuls les fichiers PDF sont autorisés'  ;
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
                    <img src="../../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                 <div class="email">Cabinet de Présidence</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                           
                            <li><a  href="../../index.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU PRINCIPALE</li>
                 
                    <li >
                        <a href="../Arriver.php">
                            <i class="material-icons">system_update_alt</i>
                            <span>Arrivé</span>
                        </a>
                    </li>
                    <li class="active">
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
                        <a href="../ges_users/ModifierPass/ChangePass.php" >
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
                                <h2 class="card-inside-title header" style="color:#008080">Bureau D'ordre</h2></br>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="numero" >Numéro</label>
                                    </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="numr" id="numero" class="form-control" placeholder="Numéro" value=<?php echo $id+1; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="Support">Support</label>
                                    </div>
                                    <div class="col-sm-3">
                                            <select class="form-control show-tick" name="support" required>
                                                <option value="">....</option>
                                                <?php
                                                    $sqli="select id, libel_support, abrev_support from courriers_supports" ;
                                                    $res=mysqli_query($con, $sqli);
                                                    if($res)
                                                        while($row=mysqli_fetch_assoc($res)){
                                                            echo "<option value=".$row['id'].">".$row['libel_support']."</option>";
                                                        }
                                                    
                                                ?>
                                            </select>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="Date">Déposer le</label>
                                    </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="date" id="Date" class="form-control" placeholder="Date">
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="Service">Service</label>
                                    </div>
                                    <div class="col-sm-3">
                                            <select class="form-control show-tick" name="service" required>
                                                <option value="">....</option>
                                                <?php
                                                    $sqli="select id, intitule_service from courriers_services" ;
                                                    $res=mysqli_query($con, $sqli);
                                                    if($res)
                                                        while($row=mysqli_fetch_assoc($res)){
                                                            echo "<option value=".$row['id'].">".$row['intitule_service']."</option>";
                                                        }
                                                    
                                                ?>
                                            </select>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                        <label for="Pieces">Pièces Jointes</label>
                                    </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="piece" id="Pieces" class="form-control" placeholder="Pièces Jointes">
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                        <label for="Nombre">Nombre</label>
                                    </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="nbr" id="Nombre" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                    
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-5 form-control-label">
                                        <label for="etablis">Etablissement</label>
                                    </div>
                                    <div class="col-sm-6">
                                            <select class="form-control show-tick" name="etablis" required>
                                                <option value="">....</option>
                                                <?php
                                                    $sqli="select id, libel_etablis, abrev_etablis from courriers_etablissements" ;
                                                    $res=mysqli_query($con, $sqli);
                                                    if($res)
                                                        while($row=mysqli_fetch_assoc($res)){
                                                            echo "<option value=".$row['id'].">".$row['libel_etablis']."</option>";
                                                        }
                                                    
                                                ?>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-primary"><i style="color:white" class="material-icons">add_circle_outline</i></button>
                                </div>  
                            
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-5 form-control-label">
                                        <label for="objet">Objet</label>
                                    </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea name="objet" cols="30" rows="3" class="form-control no-resize" placeholder="objet..." required></textarea>
                                                </div>    
                                            </div> 
                                        </div> 
                                </div>         

                                <div class="row clearfix">
                                    <div class=" col-lg-2 col-md-2 col-sm-6 col-xs-5 form-control-label">
                                        <label for="fichier">Fichier</label>
                                    </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" name="fichier" class="form-control-file" id="exampleFormControlFile1">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                            <label for="taille">20mo max</label>
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