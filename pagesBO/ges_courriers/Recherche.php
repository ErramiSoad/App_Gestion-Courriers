<?php
include '../include/dbconnection.php';
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

    header ("Location: ../index.php");
}
$inActiveArrive='in active ';
$inActiveDepart='';
$ActiveArrive='active';
$ActiveDepart='';
if(isset($_POST['submit'])){
    $inActiveArrive='in active';
    $ActiveArrive='active';
    $inActiveDepart='';
    $ActiveDepart='';
}
if(isset($_POST['submitt'])){
    $inActiveDepart='in active';
    $ActiveDepart='active';
    $inActiveArrive='';
    $ActiveArrive='';
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

    <!-- Colorpicker Css -->
    <link href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="../plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="../plugins/multi-select/css/multi-select.css" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="../plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="../plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- noUISlider Css -->
    <link href="../plugins/nouislider/nouislider.min.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" >
    <script type="text/javascript" src="../table-to-excel-master/dist/tableToExcel.js"></script>
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
                  
                    <li>
                        <a href="Arriver.php">
                            <i class="material-icons">system_update_alt</i>
                            <span>Arrivé</span>
                        </a>
                    </li>
                    <li>
                        <a href="Depart.php">
                            <i class="material-icons">open_in_new</i>
                            <span>Départ</span>
                        </a>
                    </li>
                    <li class="active">
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
            <!-- Example Tab -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Recherche Avancée
                            </h2>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                         
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="<?php echo $ActiveArrive; ?>">
                                <a href="#arrivée" data-toggle="tab"><i class="material-icons">system_update_alt</i> Arrivée</a></button>
                                </li>
                                <li role="presentation" class="<?php echo $ActiveDepart; ?>">
                                    <a href="#départ"  data-toggle="tab"><i class="material-icons">open_in_new</i> Départ</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade <?php echo $inActiveArrive; ?>" id="arrivée">
                                 <div>
                                    <form method='post'>
                                        <h2 class="card-inside-title header" style="color:#008080">Bureau D'ordre</h2>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                                <label for="numero">N° BO</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="numero" id="numero" class="form-control" placeholder="Numéro" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                                <label for="date">Arrivée Du</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="dateArrive" id="date" class="form-control" placeholder="Date D'arrivée">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                                <label for="date">Au</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="arriveAu" id="date" class="form-control" placeholder="Date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h2 style="color:#008080" class="card-inside-title header">Entité d'origine</h2>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="numero">N° d'Origine</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="numeroOrigine" id="numero" class="form-control" placeholder="Numéro">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="date">Date Origine Du</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="dateOrig" id="date" class="form-control" placeholder="Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                                <label for="date" style='position:center'>Au</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="origineAu" id="date" class="form-control" placeholder="Date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="support">Support</label>
                                            </div>
                                            <div class="col-md-3">
                                            <select class="form-control show-tick" name="support">
                                                <option value="">....</option>
                                                <?php
                                                    $sqli="select id, libel_support, abrev_support from courriers_supports" ;
                                                    $res=mysqli_query($con, $sqli);
                                                    if($res)
                                                        while($row=mysqli_fetch_assoc($res)){
                                                            echo "<option >".$row['libel_support']."</option>";
                                                        }
                                                    
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="etablis">Etablissement d'Origine </label>
                                            </div>
                                            <div class="col-md-7">
                                            <select class="form-control show-tick" name="etablis">
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
                                        </div>
                                        <h2 class="card-inside-title header" style="color:#008080">Objet</h2>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                                <label for="objet">Objet</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="obj" id="objet" class="form-control" placeholder="Objet">
                                                    </div>
                                                </div>
                                            </div>
                                        </div></br>
                                        <button type="submit" name="submit" class="btn btn-primary">Recherche</button>
                                    </form></br>
                                    </div>
                                    <div class="body table-responsive">
                                          <div class="teext-center">
                                            <a style="color:#008080 ; cursor:pointer" type ="button" name="b_print" onclick="printdiv('divID');" value=" Print "><i class="material-icons">print</i></a>
                                            <a style="color:#008080 ; cursor:pointer" type="button" onclick="ExportTableToExcel()" ><i class="material-icons">note_add</i></a>
                                           </div>
                                           <!-- <input name="b_print" type="button" onclick="printdiv('divID');" value=" Print " /> -->
                                           <div id='divID'>
                                        <table class="table table-hover" id="TblData" data-toggle="table" data-target="table" data-sortable="true">
                                            <thead>
                                                <tr>
                                                   
                                                    <th style="color:#008080">NBO</th>
                                                    <th style="color:#008080">Date Arrivé</th>
                                                    <th style="color:#008080">N°EXP</th>
                                                    <th style="color:#008080">Date EXP</th>
                                                    <th style="color:#008080">De</th>
                                                    <th style="color:#008080">Objet</th>
                                                    
                                                </tr>
                                            </thead>
                                           
                                            <tbody>
                                                        <?php
                                                        
                                                            if(isset($_POST['submit'])&&( $_POST['numero']|| $_POST['numeroOrigine']|| $_POST['dateArrive']|| $_POST['arriveAu']|| $_POST['dateOrig']|| $_POST['origineAu'] || $_POST['obj']|| $_POST['etablis']|| $_POST['support'])){
                                                            $sql="SELECT DISTINCT (c.numero) ,c.arrive_le ,c.exp_numero ,c.exp_date ,c.objet ,c.chemin , E.libel_etablis  FROM courriers c , courriers_destinations d, courriers_etablissements E ,courriers_supports s
                                                            WHERE c.id=d.courrier_id 
                                                            AND E.id=d.exp_etablis
                                                            AND c.type_courrier ='A'";
                                                            if ($_POST['numero']) 
                                                                $sql = $sql." AND c.numero=".$_POST['numero'];
                                                            if ($_POST['numeroOrigine']) 
                                                                $sql = $sql." AND c.exp_numero=".$_POST['numeroOrigine'];
                                                            if ($_POST['arriveAu']) 
                                                                $sql = $sql." AND c.enregistre_le <='".$_POST['arriveAu']."'" ; 
                                                            if ($_POST['dateArrive']) 
                                                                $sql = $sql." AND c.arrive_le >='".$_POST['dateArrive']."'" ; 
                                                            if ($_POST['dateOrig']) 
                                                                $sql = $sql." AND c.exp_date >='".$_POST['dateOrig']."'" ;
                                                            if ($_POST['origineAu']) 
                                                                $sql = $sql." AND c.enregistre_le <='".$_POST['origineAu']."'" ; 
                                                            if ($_POST['obj']) 
                                                                $sql = $sql." AND c.objet LIKE '%".$_POST['obj']."%'";
                                                            if ($_POST['etablis']) 
                                                                $sql = $sql." AND E.id =".$_POST['etablis'] ;  
                                                            if ($_POST['support']) 
                                                                $sql = $sql." AND c.support_id=s.id AND s.libel_support='".$_POST['support']."'" ;    
                                                            $result=mysqli_Query($con, $sql);
                                                            
                                                                if($result)
                                                                while($row=mysqli_fetch_assoc($result)){
                                                                
                                                                    // print($row['numero']);
                                                                    // print($row['arrive_le']);
                                                                    // print($row['exp_numero']);
                                                                    // print($row['exp_date']);
                                                                    // print($row['libel_etablis']);
                                                                    // print($row['objet']);
                                                                    $id=$row['numero'];
                                                                    $arrive=$row['arrive_le'];
                                                                    $expN=$row['exp_numero'];
                                                                    $expD=$row['exp_date'];
                                                                    $abrev=$row['libel_etablis'];
                                                                    $obj=$row['objet'];
                                                                    $chemin=$row['chemin'];
                                                                    $date=explode("-",$arrive);
                                                                    
                                                                        echo '
                                                                            <tr class="table-active">
                                                                               
                                                                            <th scope="row">'.$id.'</th>
                                                                                <td>'.$arrive.'</td>
                                                                                <td>'.$expN.'</td>
                                                                                <td>'.$expD.'</td>
                                                                                <td>'.$abrev.'</td>
                                                                                <td>'.$obj.'</td>
                                                                                
                                                                                
                                                                            </tr>
                                                                            ';
                                                                        }
                                                                    }
                                                        ?>
                                            </tbody>
                                        </table>
                                         <script>
                                             function ExportTableToExcel(){
                                                TableToExcel.convert(document.getElementById("TblData"));
                                                                          }

                                        </script>
                                        </div>
                                       <script language="javascript" type="text/javascript">
                                        function printdiv(divID)
                                        {
                                        var headstr = "<html><head><title></title></head><body>";
                                        var footstr = "</body>";
                                        var newstr = document.all.item(divID).innerHTML;
                                        var oldstr = document.body.innerHTML;
                                        document.body.innerHTML = headstr+newstr+footstr;
                                        window.print();
                                        document.body.innerHTML = oldstr;
                                        return false;
                                        }
                                    </script>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade <?php echo $inActiveDepart; ?>" id="départ">
                                    <form method='post'>
                                        <h2 class="card-inside-title header" style="color:#008080">Objet</h2>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                                <label for="objet">Objet</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="objet" id="objet" class="form-control" placeholder="Objet">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h2 class="card-inside-title header" style="color:#008080">Bureau D'ordre</h2>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                                <label for="numero">N° BO</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="numeroDep" id="numero" class="form-control" placeholder="Numéro">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                                <label for="date">Arrivée Du</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="dateAr" id="date" class="form-control" placeholder="Date D'arrivée">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                                                <label for="date">Au</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="dateAu" id="date" class="form-control" placeholder="Date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="service">Service</label>
                                            </div>
                                            <div class="col-md-6">
                                            <select class="form-control show-tick" name="service">
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
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="support">Support</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control show-tick" name="supportt">
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
                                                <label>Sortie</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control show-tick" name="sortie">
                                                    <option value="">....</option>
                                                    <option> N </option>
                                                    <option> O </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="etablis">Etablissement</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control show-tick" name="etablise">
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
                                        </div></br></br>
                                        <button type="submit" name="submitt" class="btn btn-primary" value="Search">Recherche</button>
                                    </form></br>
                                    <div class="body table-responsive">
                                        <div class="teext-center">
                                            <a style="color:#008080 ;cursor:pointer" type ="button" name="b_print" onclick="printD('DivId');" value=" Print "><i class="material-icons">print</i></a>
                                            <!-- <button onclick="exportTableToExcel()">Excel</button> -->
                                            <a style="color:#008080 ; cursor:pointer" type="button" onclick="exportTableToExcel()" ><i class="material-icons">note_add</i></a>
                                        </div>
                                           <!-- <input name="b_print" type="button" onclick="printdiv('divID');" value=" Print " /> -->
                                           <div id='DivId'>
                                        <table class="table table-hover" id="tbData" data-toggle="table" data-target="table" data-sortable="true">
                                            <thead>
                                                <tr>
                                                 
                                                    
                                                    <th style="color:#008080">Sortie</th>
                                                    <th style="color:#008080">N°BO</th>
                                                    <th style="color:#008080">Date BO</th>
                                                    <th style="color:#008080">Service</th>
                                                    <th style="color:#008080">Vers</th>
                                                    <th style="color:#008080">Objet</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php
                                                    
                                                        if(isset($_POST['submitt'])&&( $_POST['numeroDep']|| $_POST['service']|| $_POST['dateAr']|| $_POST['dateAu']|| $_POST['sortie']|| $_POST['objet']|| $_POST['etablise']|| $_POST['supportt'])){
                                                        $sql="SELECT DISTINCT(c.numero) ,c.exp_date ,c.objet, c.sortie ,c.chemin ,serv.libel_service ,d.dest_etablis ,d.courrier_id ,e.libel_etablis
                                                        FROM courriers c , courriers_services serv , courriers_destinations d , courriers_etablissements e,courriers_supports s
                                                        WHERE serv.id=c.service_id 
                                                        AND d.courrier_id=c.id
                                                        AND d.dest_etablis=e.id
                                                        AND c.type_courrier ='D'";
                                                        if ($_POST['objet']) 
                                                            $sql = $sql." AND c.objet LIKE '%".$_POST['objet']."%'";
                                                        if ($_POST['numeroDep']) 
                                                            $sql = $sql." AND c.numero=".$_POST['numeroDep'];
                                                        if ($_POST['dateAr']) 
                                                            $sql = $sql." AND c.exp_date >='".$_POST['dateAr']."'" ; 
                                                        if ($_POST['dateAu']) 
                                                            $sql = $sql." AND c.enregistre_le <='".$_POST['dateAu']."'" ; 
                                                        if ($_POST['service']) 
                                                            $sql = $sql." AND serv.id=".$_POST['service'];
                                                        if ($_POST['etablise']) 
                                                            $sql = $sql." AND E.id =".$_POST['etablise'] ;  
                                                        if ($_POST['supportt']) 
                                                            $sql = $sql." AND c.support_id=s.id AND s.id=".$_POST['supportt'] ;
                                                        if ($_POST['sortie'])
                                                            $sql = $sql." AND c.sortie ='".$_POST['sortie']."'" ;
                                                        
                                                        $result=mysqli_Query($con, $sql);
                                                        if($result)
                                                            while($row=mysqli_fetch_assoc($result)){
                                                            
                                                                // print($row['numero']);
                                                                // print($row['arrive_le']);
                                                                // print($row['exp_numero']);
                                                                // print($row['exp_date']);
                                                                // print($row['libel_etablis']);
                                                                // print($row['objet']);
                                                                
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
                                                                        <tr class="table-active">
                                                                            
                                                                            <td>
                                                                                '.$sortie.'
                                                                            </td>
                                                                        
                                                                            <th scope="row">'.$id.'</th>
                                                                            <td>'.$arrive.'</td>
                                                                            <td>'.$service.'</td>
                                                                            <td>'.$etablis.'</td>
                                                                            <td>'.$obj.'</td>
                                                                            
                                                                            
                                                                        </tr>
                                                                        ';
                                                                    }
                                                                }
                                                    ?>
                                            </tbody>
                                        </table>
                                        <script>
                                             function exportTableToExcel(){
                                                TableToExcel.convert(document.getElementById("tbData"));
                                                                          }

                                        </script>
                                        </div>
                                        <script language="javascript" type="text/javascript">
                                        function printD(DivId)
                                        {
                                        var headstr = "<html><head><title></title></head><body>";
                                        var footstr = "</body>";
                                        var newstr = document.all.item(DivId).innerHTML;
                                        var oldstr = document.body.innerHTML;
                                        document.body.innerHTML = headstr+newstr+footstr;
                                        window.print();
                                        document.body.innerHTML = oldstr;
                                        return false;
                                        }
                                    </script>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <!-- import excel -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
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
<!-- <td>
    <a style="color:#008080" href="../files/PUCA/'.$date[0].'/'.$date[1].'/'.$chemin.'.pdf" target="_blank" ><i class="material-icons">find_in_page</i></a>
 </td>
<td>
     <a style="color:#008080"  ><i class="material-icons">print</i></a>
</td> -->