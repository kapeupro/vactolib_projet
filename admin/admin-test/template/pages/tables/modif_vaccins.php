<?php

session_start();
require('../../../../../inc/pdo.php');
require('../../../../../inc/fonction.php');
require('../../../../../inc/request.php');

$errors = array();

if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $vaccin = getVaccinById($id);

    if(!empty($vaccin)){
        if(!empty($_POST['submitted'])){

            $name = clearXSS('name');
            $laboratoire = clearXSS('laboratoire');
            $rappel = clearXSS('rappel');
            $description = clearXSS('description');


            $errors = textValidation($errors, $name, 'name', 3, 255);
            $errors = textValidation($errors, $laboratoire, 'laboratoire', 3, 50);
            $errors = textValidation($errors, $description, 'description', 3, 450);
            $errors = intValidation($errors, $rappel, 'rappel');

            if(count($errors) == 0){

                $sql = "UPDATE vactolib_vaccins
                SET nom_vaccin = :name, laboratoire = :laboratoire, description = :description, rappel = :rappel
                WHERE id = :id";
                $query = $pdo->prepare($sql);
                $query->bindValue(':name', $name, PDO::PARAM_STR);
                $query->bindValue(':laboratoire', $laboratoire, PDO::PARAM_STR);
                $query->bindValue(':description', $description, PDO::PARAM_STR);
                $query->bindValue(':rappel', $rappel, PDO::PARAM_INT);
                $query->bindValue(':id', $id, PDO::PARAM_INT);
                $query ->execute();
//                header('Location: index.php');
                echo "OK";
            }else{
                die('404');
            }
        }
    }
}
debug($vaccin);

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
<!--            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">-->
<!--                <a class="navbar-brand brand-logo mr-5" href="../../../index.php"><img src="../../../../../asset/img/logo_vactolib.svg" class="mr-2" alt="logo"/></a>-->
<!--                <a class="navbar-brand brand-logo-mini" href="../../../index.php"><img src="../../../../../asset/img/logo_vactolib.svg" alt="logo"/></a>-->
<!--            </div>-->
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
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Modification/Ajout vaccins</h4>
                                    <!-- FORMULAIRE DE MODIFICATION -->

                                    <form role="form" id="contact-form" class="contact-form">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Nom du vaccin :</label>
                                                    <input type="text" class="form-control" name="name" value="<?php echo $vaccin['nom_vaccin']; ?>" id="Name" placeholder="Nom vaccin">
                                                    <span class="error"><?php viewError($errors, 'name'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Laboratoire :</label>
                                                    <input type="text" class="form-control" name="laboratoire" value="<?php echo $vaccin['laboratoire']; ?>" id="laboratoire" placeholder="laboratoire">
                                                    <span class="error"><?php viewError($errors, 'laboratoire'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Nombre de jours avant rappel :</label>
                                                    <input type="text" class="form-control" name="rappel" value="<?php echo $vaccin['rappel']; ?>" id="rappel" placeholder="rappel">
                                                    <span class="error"><?php viewError($errors, 'rappel'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Description :</label>
                                                    <textarea class="form-control textarea" rows="4" name="description" id="Description" placeholder="Description"><?php echo $vaccin['description']; ?></textarea>
                                                    <span class="error"><?php viewError($errors, 'description'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="submit" name="submitted" type="button" class="btn btn-primary float-right" value="Modifier">
                                            </div>
                                        </div>
                                    </form>

                                </div>
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