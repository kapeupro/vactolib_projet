<?php

session_start();
require('../../../../../inc/pdo.php');
require('../../../../../inc/fonction.php');
require('../../../../../inc/request.php');

$errors = [];
$countAllVaccins = 0;

if(!empty($_GET['search'])) {
    $search = trim(strip_tags($_GET['search']));
    $searchVaccins = getVaccinBySearch($search);
}


if ($_SESSION['user']['status']=='admin'){
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Vactolib Admin</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="../../vendors/feather/feather.css">
        <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="../../../../../asset/img/logo_vactolib.svg" />
    </head>

    <body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="../../../index.php"><img src="../../../../../asset/img/logo_vactolib.svg" class="mr-2" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="../../../index.php"><img src="../../../../../asset/img/logo_vactolib.svg" alt="logo"/></a>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                            <i class="icon-bar-graph menu-icon"></i>
                            <span class="menu-title">Charts</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../../pages/charts/chartjs.html">ChartJs</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                            <i class="icon-grid-2 menu-icon"></i>
                            <span class="menu-title">Tables</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../../pages/tables/basic-table.php">Liste tables</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Nos vaccins</h4>
                                    <div class="table-responsive pt-3">
                                        <table class="table table-bordered">

                                            <!-- BARRE DE RECHERCHE -->
                                            <form action="search_vaccin.php" method="get">
                                                <div>
                                                    <div class="col d-flex flex-row py-3 justify-content-end">
                                                        <input type="search" class="form-control mr-2 col-5" id="datatable-search-input" placeholder="Rechercher ..." name="search" value="<?php if(!empty($_GET['search'])) {echo $_GET['search'];} ?>">
                                                        <input class=" btn btn-primary" type="submit" class="form-control col-1">
                                                    </div>
                                                </div>
                                            </form>

                                            <?php
                                            if(empty($searchVaccins)) {
                                                echo '<p style="color: red; font-weight: bold;">Aucun vaccin ne correspond à votre recherche</p>';
                                            }else { ?>
                                            <thead>
                                            <tr>
                                                <th>
                                                    #id
                                                </th>
                                                <th>
                                                    Nom du vaccin
                                                </th>
                                                <th>
                                                    Laboratoire
                                                </th>
                                                <th>
                                                    Description
                                                </th>
                                                <th>
                                                    Rappel
                                                </th>
                                                <th>
                                                    Modif.
                                                </th>
                                                <th>
                                                    Suppr.
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($searchVaccins as $searchVaccin){ ?>
                                                <tr class="table-primary">
                                                    <td>
                                                        <div style="width:2rem; overflow:hidden;">
                                                            <?php echo $searchVaccins[$countAllVaccins]['id']; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="width:6rem; overflow:hidden;">
                                                            <?php echo $searchVaccins[$countAllVaccins]['nom_vaccin']; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="width:6rem; overflow:hidden;">
                                                            <?php echo $searchVaccins[$countAllVaccins]['laboratoire']; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="width:6rem; overflow:hidden;">
                                                            <?php echo $searchVaccins[$countAllVaccins]['description']; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="width:2rem; overflow:hidden;">
                                                            <?php echo $searchVaccins[$countAllVaccins]['rappel']; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="width:4rem; overflow:hidden;">
                                                            <a href="modif_vaccins.php?id=<?= $searchVaccins[$countAllVaccins]['id'] ?>">Modifier</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="width:4rem; overflow:hidden;">
                                                            <a href="delete_vaccin.php?id=<?= $searchVaccins[$countAllVaccins]['id'] ?>">Supprimer</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $countAllVaccins++; } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- plugins:js -->
            <script src="../../vendors/js/vendor.bundle.base.js"></script>
            <!-- endinject -->
            <!-- Plugin js for this page -->
            <!-- End plugin js for this page -->
            <!-- inject:js -->
            <script src="../../js/off-canvas.js"></script>
            <script src="../../js/hoverable-collapse.js"></script>
            <script src="../../js/template.js"></script>
            <script src="../../js/settings.js"></script>
            <script src="../../js/todolist.js"></script>
            <!-- endinject -->
            <!-- Custom js for this page-->
            <!-- End custom js for this page-->
    </body>

    </html>
<?php } else{die('403');} ?>