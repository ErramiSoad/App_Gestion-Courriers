<?php
    include '../../include/dbconnection.php';
    session_start();

    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

        header ("Location: ../index.php");
    }
    $numero="";
    $DateArr="";
    $NumExp="";
    $DateExp="";
    $piece="";
    $nbrpj="";
    $support="";
    $etab="";
    $Obj="";
    $etab_id="";
    $id="";
    $file="";
    $fichier="";
    if(isset($_GET['updateid'])){
        $id=$_GET['updateid'];
        $sql="select * from `courriers` where numero=$id";
        $result=mysqli_Query($con, $sql);
        $row=mysqli_fetch_assoc($result);
        $numero=$row['numero'];
        $DateArr=$row['arrive_le'];
        $NumExp=$row['exp_numero'];
        $DateExp=$row['exp_date'];
        $piece=$row['pj'];
        $nbrpj=$row['nbr_pj'];
        $Obj=$row['objet'];
        $file=$row['chemin'];
        $fichier=$row['chemin'];
        $sqll="SELECT c.numero ,E.id ,E.libel_etablis ,s.id , s.libel_support FROM courriers c, courriers_destinations d, courriers_etablissements E, courriers_supports s
        WHERE c.id=d.courrier_id 
        AND E.id=d.exp_etablis
        AND c.support_id=s.id 
        AND c.numero=$id ";
        $result=mysqli_Query($con, $sqll);
        $row=mysqli_fetch_assoc($result);
        $etab=$row['libel_etablis'];
        $etab_id=$row['id'];
        $support=$row['libel_support'];
        $support_id=$row['id'];
        // $req="SELECT c.numero, s.id, s.libel_support FROM courriers c ,courriers_supports s 
        // WHERE c.support_id=s.id 
        // AND c.numero=$id ";
        // $result=mysqli_Query($con, $req);
        // $row=mysqli_fetch_assoc($result);
        // $support=$row['libel_support'];
        // $support_id=$row['id'];
    }
    
    if(isset($_POST['submit'])){
        // $numr=$_POST['numr'];
        $arriv=$_POST['arrive'];
        $num=$_POST['numero'];
        $support=$_POST['support'];
        $date=$_POST['date'];
        $piece=$_POST['piece'];
        $nombre=$_POST['nombre'];
        $obj=$_POST['objet'];
        $etab=$_POST['etablis'];
        // $fichier=$_POST['fichier'];
        $estDeplace=false;
        // echo '<br>dateArr'.$DateArr;
        // echo '<br>arriv'.$arriv;
        // if ($arriv != $DateArr) echo '<br> D <br>';
        // else echo '<br> E <br>';
        // echo !empty($_FILES);
        if(!empty($_FILES) && $_FILES['fichier']['name'] && $_FILES['fichier']['tmp_name']){
            $fn=$_FILES['fichier']['name'];
            echo '<br>nom:'.$_FILES['fichier']['name'];
            $file_extension= strrchr($fn,".");
            $tm=$_FILES['fichier'][ 'tmp_name'];
            echo '<br>tmp_name:'.$_FILES['fichier']['tmp_name'];
            $annee=explode("-",$arriv);
            $fichier='A_'.$arriv.'_'.$id;
            $fd='../../files/PUCA/'.$annee[0];
            if (!file_exists($fd)) {
                mkdir($fd, 0777, true);
            }
            if (!file_exists($fd.'/'.$annee[1])) {
                mkdir($fd.'/'.$annee[1], 0777, true);
            }
            // echo '<br>fichier :'.$fichier;
            // echo '<br>file :'.$file;
            $fd='../../files/PUCA/'.$annee[0].'/'.$annee[1].'/'.$fichier.'.pdf';
            $extensions_autorises=array('.pdf','.PDF');
            if(in_array($file_extension,$extensions_autorises)){
                if(move_uploaded_file($tm, $fd)){
                    $dateExploded=explode("-",$DateArr);
                    if($file != $fichier) {
                        $fd2='../../files/PUCA/'.$dateExploded[0].'/'.$dateExploded[1].'/'.$file.'.pdf';
                        unlink($fd2);
                    }
                    $estDeplace=true;
                }
            } else {
                echo 'seuls les fichiers PDF sont autorisés'  ;
            }
        }
        // if ($arriv == $DateArr) {
            $sql="update `courriers` set arrive_le='$arriv', exp_numero='$num', exp_date='$date', 
            support_id='$support' , pj='$piece', nbr_pj='$nombre', objet='$obj', chemin='$fichier' where numero='$id'";
            $result=mysqli_query($con, $sql);
            if($result){
                $req="select id from `courriers` where numero='$id' ";
                    $resu=mysqli_query($con, $req);
                    if($resu){
                        while($row=mysqli_fetch_assoc($resu)){
                            $courrier_id=$row['id'];
                            $sql="update `courriers_destinations` set exp_etablis='$etab', dest_etablis='98' where courrier_id='$courrier_id' ";
                            $resultat=mysqli_query($con, $sql);
                            if($resultat) header('location:../Arriver.php');
                            else die(mysqli_error($con));
                        }
                    }else{
                        die(mysqli_error($con));
                    } 
                    echo'Fichier envoyé avec succès';
            } else {
                echo "une erreur est revenue";
            }
        // }
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
                    <img src="../../images/user.jpg" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                 <div class="email">Administrateur</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="../Profile.php"><i class="material-icons">person</i>Profile</a></li>
                           
                            <li><a href="../../index.php"><i class="material-icons">input</i>Sign Out</a></li>
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
                        <a href="../Arriver.php">
                            <i class="material-icons">system_update_alt</i>
                            <span>Arrivé</span>
                        </a>
                    </li>
                    <li >
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
                          <h2>Modifier Courriers Arrivées </h2>
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
                                                    <input type="text" name="numr" id="numero" class="form-control" placeholder="Numéro" value=<?php echo $id; ?> disabled>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="date">Arrivé le</label>
                                    </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="arrive" id="date" class="form-control" placeholder="Date" value=<?php echo $DateArr; ?>>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <h2 style="padding-top:10px ;color:#008080" class="card-inside-title header" >Entité d'origine</h2></br>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="numero">Numéro</label>
                                    </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="numero" id="numero" class="form-control" placeholder="Numéro" value=<?php echo $NumExp; ?> >
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="support">Support</label>
                                    </div>
                                    <div class="col-sm-3">
                                            <select class="form-control show-tick" name="support">
                                                <!-- <option ><?php echo $support; ?></option> -->
                                                <?php
                                                    $sqli="select id, libel_support, abrev_support from courriers_supports" ;
                                                    $res=mysqli_query($con, $sqli);
                                                    if($res)
                                                        while($row=mysqli_fetch_assoc($res)){
                                                            if($support_id==$row['id'])
                                                                echo "<option value=".$row['id']." selected>".$row['libel_support']."</option>";
                                                            else echo "<option value=".$row['id'].">".$row['libel_support']."</option>";
                                                        }
                                                    
                                                ?>
                                            </select>
                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                        <label for="Date">Date</label>
                                    </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="date" id="date" class="form-control" placeholder="Date" value=<?php echo $DateExp; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                        <label for="piece">Pièces Jointes</label>
                                    </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="piece" id="email_address_2" class="form-control" placeholder="Nom pièce jointe" value=<?php echo $piece; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                        <label for="nombre">Nombre</label>
                                    </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" value=<?php echo $nbrpj; ?>>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-5 form-control-label">
                                        <label for="etablis">Etablissement</label>
                                    </div>
                                        <div class="col-sm-6">
                                        <div class="form-line">
                                            <select class="form-control show-tick" name="etablis">
                                                <!-- <option ><?php echo $etab; ?></option> -->
                                                <?php
                                                    $sqli="select id, libel_etablis, abrev_etablis from courriers_etablissements" ;
                                                    $res=mysqli_query($con, $sqli);
                                                    if($res)
                                                        while($row=mysqli_fetch_assoc($res)){
                                                            if($etab_id==$row['id'])
                                                                echo "<option value=".$row['id']." selected>".$row['libel_etablis']."</option>";
                                                            else echo "<option value=".$row['id'].">".$row['libel_etablis']."</option>";
                                                        }
                                                    
                                                ?>
                                            </select>
                                        </div>
                                        </div>
                                        
                                </div> 
                                
                            
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-5 form-control-label">
                                        <label for="objet">Objet</label>
                                    </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea name="objet" cols="30"  rows="3" class="form-control no-resize" placeholder="objet..." required ><?php echo $Obj; ?></textarea>
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
                                                    <input type="file" name="fichier" class="form-control-file" id="exampleFormControlFile1" value=<?php echo $file; ?> >
                                                </div>
                                            </div>
                                        </div> 
                                        <div  class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                            <label for="piece">20mo max</label>
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