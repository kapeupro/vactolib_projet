<?php

session_start();
require('../../../../../inc/pdo.php');
require('../../../../../inc/fonction.php');
require('../../../../../inc/request.php');

$errors = [];
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $user = getUserById($id);
}

if(!empty($user)){
    if(!empty($_POST['submitted'])){

        $nom = cleanXss('nom');
        $prenom = cleanXss('prenom');
        $email = cleanXss('email');
        $telephone = cleanXss('telephone');
        $status = cleanXss('status');


        $errors = textValidation($errors, $nom, 'nom', 3, 70);
        $errors = textValidation($errors, $prenom, 'prenom', 3, 70);
        $errors = mailValidation($errors, $email, 'email');
        $errors = phoneNumberValidation($errors, $telephone, 'telephone');
        $errors = textValidation($errors, $status, 'status', 2, 20);

        if(count($errors) == 0){
            $sql = "UPDATE vactolib_user
                SET nom = :nom, prenom = :prenom, email = :email, portable = :portable, status = :status
                WHERE id = :id";
            $query = $pdo->prepare($sql);
            $query->bindValue(':nom', $nom, PDO::PARAM_STR);
            $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':portable', $telephone, PDO::PARAM_INT);
            $query->bindValue(':status', $status, PDO::PARAM_STR);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query ->execute();
            header('Location: basic-table.php');
        }else{
        }
    }
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
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Modification/Ajout utilisateurs</h4>
                                        <!-- FORMULAIRE DE MODIFICATION -->

                                    <form method="post" role="form" id="contact-form" class="contact-form">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Nom :</label>
                                                    <input type="text" class="form-control" name="nom" value="<?php echo $user['nom']; ?>" id="nom" placeholder="Nom">
                                                    <span class="text-danger"><?php viewError($errors, 'nom'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Prénom :</label>
                                                    <input type="text" class="form-control" name="prenom" value="<?php echo $user['prenom']; ?>" id="Name" placeholder="prenom">
                                                    <span class="text-danger"><?php viewError($errors, 'prenom'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Email :</label>
                                                    <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>" id="email" placeholder="email">
                                                    <span class="text-danger"><?php viewError($errors, 'email'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Téléphone :</label>
                                                    <input type="text" class="form-control" name="telephone" value="<?php echo $user['portable']; ?>" id="telephone" placeholder="telephone">
                                                    <span class="text-danger"><?php viewError($errors, 'telephone'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Status :</label>
                                                    <input type="text" class="form-control" name="status" value="<?php echo $user['status']; ?>" id="status" placeholder="status">
                                                    <span class="text-danger"><?php viewError($errors, 'status'); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="submit" name="submitted" class="btn btn-primary float-right" value="Modifier">
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