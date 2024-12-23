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

     <!-- Morris Css -->
     <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- script barchart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
                    
                    <li>
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
                    <li class="active">
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

    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2 style="font-weight: bold;">Statistique</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">filter_none</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL COURRIERS
                            <?php
                                $sql = "SELECT * From courriers ";
                                $result = mysqli_Query($con, $sql);
                                if ($category_total = mysqli_num_rows($result)) {
                                    echo '<div class="number count-to" data-from="0" data-to=' . $category_total . ' ></div>';
                                } else {
                                    echo '<h4 class="nb-0">NO DATA</h4>';
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                        <i class="material-icons">system_update_alt</i>
                        </div>
                        <div class="content">
                            <div class="text">COURRIERS ARRIVEE
                            <?php
                                $sql = "SELECT * From courriers WHERE type_courrier='A' ";
                                $result = mysqli_Query($con, $sql);
                                if ($category_total = mysqli_num_rows($result)) {
                                    echo '<div class="number count-to" data-from="0" data-to=' . $category_total . ' ></div>';
                                } else {
                                    echo '<h4 class="nb-0">NO DATA</h4>';
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                        <i class="material-icons">open_in_new</i>
                        </div>
                        <div class="content">
                            <div class="text">COURRIERS DEPART
                            <?php
                                $sql = "SELECT * From courriers WHERE type_courrier='D' ";
                                $result = mysqli_Query($con, $sql);
                                if ($category_total = mysqli_num_rows($result)) {
                                    echo '<div class="number count-to" data-from="0" data-to=' . $category_total . ' ></div>';
                                } else {
                                    echo '<h4 class="nb-0">NO DATA</h4>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL USERS
                            <?php
                                $sql = "SELECT * From users ";
                                $result = mysqli_Query($con, $sql);
                                if ($category_total = mysqli_num_rows($result)) {
                                    echo '<div class="number count-to" data-from="0" data-to=' . $category_total . ' ></div>';
                                } else {
                                    echo '<h4 class="nb-0">NO DATA</h4>';
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                           <h2>
                              Nombre de courriers par mois de chaque année
                             <small>Arrivée & Départ</small>
                           </h2>
                        </div><br><br>
                        <div class="col-sm-3">
                            <!-- <select class="form-control show-tick" name="service" required>
                                <option >2022</option>
                                <option>2021</option>
                                <option > 2020</option>

                            </select> -->
                        </div>
                        <button type="button" class="btn btn-primary mb-4"  onclick="drawStuff()"> 2022</button>
                        <button type="button" class="btn btn-primary mb-4"  onclick="drawStuff1()"> 2021</button>
                        <br><br><br><br>

                        <div class="container" id="dual_x_div" style="width: 900px; height: 500px;"></div>
                        <!-- <div id="piechart" style="width: 900px; height: 500px;"></div> -->

                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                           <h2>
                              Nombre de courriers par mois de chaque année
                             <small>Arrivée & Départ</small>
                           </h2>
                        </div><br><br>
                        <div class="col-sm-3">
                            <!-- <select class="form-control show-tick" name="service" required>
                                <option >2022</option>
                                <option >2021</option>
                                <option > 2020</option>

                            </select> -->
                        </div>
                        <button type="button" class="btn btn-primary mb-4" onclick="drawChart()">2022</button>
                        <button type="button" class="btn btn-primary mb-4" onclick="drawChart1()">2021</button>
                        <br><br><br><br>

                        <!-- <div class="container" id="dual_x_div" style="width: 900px; height: 500px;"></div> -->
                        <div id="piechart" style="width: 900px; height: 500px;"></div>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
        ['Mois', 'Arrivée', 'Départ'],
        ['1', 575, 600],
        ['2', 700, 500],
        ['3', 800, 600],
        ['4', 680, 475],
        ['5', 750, 675],
        ['6', 175, 100],
        ['7', 55, 120],
        ['8', 0, 0],
        ['9', 60, 50],
        ['10', 13, 40],
        ['11', 250, 120],
        ['12', 120, 340]
        ]);

        var options = {
        width: 600,
        bars: 'vertical',
        title: 2021, // Required for Material Bar Charts.
        hAxis: {
               format: 'decimal'
                },
        colors: ['teal', '#d95f02']
                       };
        var chart = new google.charts.Bar(document.getElementById('dual_x_div'));
        chart.draw(data, options);
        };



        function drawStuff1() {
         var data = new google.visualization.arrayToDataTable([
        ['Mois', 'Arrivée', 'Départ'],
        ['1', 225, 170],
        ['2', 500, 320],
        ['3', 600, 570],
        ['4', 580, 475],
        ['5', 450, 275],
        ['6', 175, 100],
        ['7', 155, 120],
        ['8', 0, 0],
        ['9', 0,0 ],
        ['10', 50, 40],
        ['11', 150, 120],
        ['12', 200, 240]
        ]);
        var options = {
        width: 600,
        bars: 'vertical', // Required for Material Bar Charts.
        hAxis: {
                format: 'decimal'
                },
        colors: ['aqua', 'brown']
                         };
        var chart = new google.charts.Bar(document.getElementById('dual_x_div'));
        chart.draw(data, options);
        document.getElementById("btn").style.background='red';
         };

    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = new google.visualization.arrayToDataTable([
            ['Mois', 'Arrivée', 'Départ'],
            ['1', 225, 170],
            ['2', 500, 320],
            ['3', 700, 570],
            ['4', 680, 475],
            ['5', 450, 275],
            ['6', 175, 100],
            ['7', 155, 120],
            ['8', 0, 0],
            ['9', 0,0 ],
            ['10', 50, 40],
            ['11', 150, 120],
            ['12', 200, 240]

            ]);
            var options = {
            title: ''
                           };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
            }

           function drawChart1() {
           var data = new google.visualization.arrayToDataTable([
            ['Mois', 'Arrivée', 'Départ'],
            ['1', 225, 170],
            ['2', 500, 320],
            ['3', 700, 570],
            ['4', 680, 475],
            ['5', 450, 275],
            ['6', 175, 100],
            ['7', 155, 120],
            ['8', 0, 0],
            ['9', 0,0 ],
            ['10', 50, 40],
            ['11', 150, 120],
            ['12', 200, 240]
           ]);
            var options = {
            title: '',
            colors: ['#47B39C', '#d95f02','#FFC154','#EC6B56','#008080','#000080','#808000','#800000','#808080','#00FFFF','#800000','red']
                        };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
            }
    </script>


    !-- Jquery Core Js -->
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

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

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