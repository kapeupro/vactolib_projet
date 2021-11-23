<?php

session_start();
require('../../../../../inc/pdo.php');
require('../../../../../inc/fonction.php');
require('../../../../../inc/request.php');

if ($_SESSION['user']['status']==)


if ($_SESSION['user']['status']=='admin'){

    //Recuperer les admins

    $sql = "SELECT * FROM vactolib_user WHERE status = 'admin' ";
    $query = $pdo->prepare($sql);
    $query->execute();
    $admins= $query->fetchAll();

    //Recuperer tous les utilisateurs
    $sql = "SELECT * FROM vactolib_user ";
    $query = $pdo->prepare($sql);
    $query->execute();
    $users = $query->fetchAll();

    //Recuperer tous les vaccins
    $sql = "SELECT * FROM vactolib_vaccins ";
    $query = $pdo->prepare($sql);
    $query->execute();
    $vaccins = $query->fetchAll();

    $countAdmin = 0;
    $countAllUsers = 0;
    $countAllVaccins = 0;

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
    <link rel="shortcut icon" href="../../images/vactolib_coeur.svg" />
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
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-7 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Table des administrateurs</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Email</th>
                                            <th>Portable</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
<<<<<<< HEAD
                                        <?php foreach ($admins as $admin){

                                        } ?>
                                        <tr>
                                            <td>Jacob</td>
                                            <td>53275531</td>
                                            <td>12 May 2017</td>
                                            <td>Portable</td>
                                            <td><label class="badge badge-danger">Admin</label></td>
                                        </tr>
=======
                                        <?php foreach($admins as $admin){ ?>
                                            <tr>
                                                <td><?php echo $admins[$countAdmin]['nom']; ?></td>
                                                <td><?php echo $admins[$countAdmin]['prenom']; ?></td>
                                                <td><?php echo $admins[$countAdmin]['email']; ?></td>
                                                <td><?php echo $admins[$countAdmin]['portable']; ?></td>
                                                <td><label class="badge badge-danger">Admin</label></td>
                                            </tr>
                                        <?php $countAdmin++; } ?>
>>>>>>> b473c9ef8efba157281b6b18ee6b79f9c7ad2511
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Nos utilisateurs</h4>
                                <a href="modif_user.php" type="button" class="btn btn-primary float-right">Modifier</a>
                                <div class="table-responsive pt-3">
                                    <table class="table table-dark">
                                        <thead>
                                        <tr>
                                            <th>
                                                #id
                                            </th>
                                            <th>
                                                Nom
                                            </th>
                                            <th>
                                                Prénom
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>
                                                N°
                                            </th>
                                            <th>
                                                Crée le
                                            </th>
                                            <th>
                                                Status
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
                                        <?php foreach ($users as $user){ ?>
                                            <tr>
                                                <td>
                                                    <?php echo $users[$countAllUsers]['id']?>
                                                </td>
                                                <td>
                                                    <?php echo $users[$countAllUsers]['nom']?>
                                                </td>
                                                <td>
                                                    <?php echo $users[$countAllUsers]['prenom']?>
                                                </td>
                                                <td>
                                                    <?php echo $users[$countAllUsers]['email']?>
                                                </td>
                                                <td>
                                                    <?php echo $users[$countAllUsers]['portable']?>
                                                </td>
                                                <td>
                                                    <?php echo $users[$countAllUsers]['created_at']?>
                                                </td>
                                                <td>
                                                    <?php echo $users[$countAllUsers]['status']?>
                                                </td>
                                                <td>
                                                    <a href="modif_user.php?id=<?= $users[$countAllUsers]['id'] ?>">Modifier</a>
                                                </td>
                                                <td>
                                                    <a href="delete_user.php?id=<?= $users[$countAllUsers]['id'] ?>">Supprimer</a>
                                                </td>
                                            </tr>
                                       <?php $countAllUsers++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Nos vaccins</h4>
                                <div class="table-responsive pt-3">
                                    <table class="table table-bordered">
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
                                        <?php foreach($vaccins as $vaccin){ ?>
                                        <tr class="table-primary">
                                            <td>
                                                <div style="width:2rem; overflow:hidden;">
                                                    <?php echo $vaccins[$countAllVaccins]['id']; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="width:8rem; overflow:hidden;">
                                                    <?php echo $vaccins[$countAllVaccins]['nom_vaccin']; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="width:10rem; overflow:hidden;">
                                                    <?php echo $vaccins[$countAllVaccins]['laboratoire']; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="width:10rem; overflow:hidden;">
                                                    <?php echo $vaccins[$countAllVaccins]['description']; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="width:2rem; overflow:hidden;">
                                                    <?php echo $vaccins[$countAllVaccins]['rappel']; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="modif_vaccins.php?id=<?= $vaccins[$countAllVaccins]['id'] ?>">Modifier</a>
                                            </td>
                                            <td>
                                                <a href="delete_vaccin.php?id=<?= $vaccins[$countAllVaccins]['id'] ?>">Supprimer</a>
                                            </td>
                                        </tr>
                                        <?php $countAllVaccins++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
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