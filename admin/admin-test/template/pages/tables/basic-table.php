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


    $countAdmin = 0;
    $countAllUsers = 0;
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
            <a class="navbar-brand brand-logo mr-5" href="../../index.php"><img src="../../../../../asset/img/logo_vactolib.svg" class="mr-2" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="../../index.php"><img src="../../../../../asset/img/logo_vactolib.svg" alt="logo"/></a>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_settings-panel.html -->
        <div id="right-sidebar" class="settings-panel">
            <i class="settings-close ti-close"></i>
            <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
                </li>
            </ul>
            <div class="tab-content" id="setting-content">
                <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
                    <div class="add-items d-flex px-3 mb-0">
                        <form class="form w-100">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                                <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="list-wrapper px-3">
                        <ul class="d-flex flex-column-reverse todo-list">
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        Team review meeting at 3.00 PM
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        Prepare for presentation
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        Resolve all the low priority tickets due today
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li class="completed">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" checked>
                                        Schedule meeting for next week
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li class="completed">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" checked>
                                        Project review
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                        </ul>
                    </div>
                    <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
                    <div class="events pt-4 px-3">
                        <div class="wrapper d-flex mb-2">
                            <i class="ti-control-record text-primary mr-2"></i>
                            <span>Feb 11 2018</span>
                        </div>
                        <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
                        <p class="text-gray mb-0">The total number of sessions</p>
                    </div>
                    <div class="events pt-4 px-3">
                        <div class="wrapper d-flex mb-2">
                            <i class="ti-control-record text-primary mr-2"></i>
                            <span>Feb 7 2018</span>
                        </div>
                        <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                        <p class="text-gray mb-0 ">Call Sarah Graves</p>
                    </div>
                </div>
                <!-- To do section tab ends -->
                <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                    <div class="d-flex align-items-center justify-content-between border-bottom">
                        <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                        <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
                    </div>
                    <ul class="chat-list">
                        <li class="list active">
                            <div class="profile"><img src="../../images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                            <div class="info">
                                <p>Thomas Douglas</p>
                                <p>Available</p>
                            </div>
                            <small class="text-muted my-auto">19 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="../../images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                            <div class="info">
                                <div class="wrapper d-flex">
                                    <p>Catherine</p>
                                </div>
                                <p>Away</p>
                            </div>
                            <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                            <small class="text-muted my-auto">23 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="../../images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                            <div class="info">
                                <p>Daniel Russell</p>
                                <p>Available</p>
                            </div>
                            <small class="text-muted my-auto">14 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="../../images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                            <div class="info">
                                <p>James Richardson</p>
                                <p>Away</p>
                            </div>
                            <small class="text-muted my-auto">2 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="../../images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                            <div class="info">
                                <p>Madeline Kennedy</p>
                                <p>Available</p>
                            </div>
                            <small class="text-muted my-auto">5 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="../../images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                            <div class="info">
                                <p>Sarah Graves</p>
                                <p>Available</p>
                            </div>
                            <small class="text-muted my-auto">47 min</small>
                        </li>
                    </ul>
                </div>
                <!-- chat tab ends -->
            </div>
        </div>
        <!-- partial -->
        <!-- partial:../../partials/_sidebar.html -->
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
                            <li class="nav-item"> <a class="nav-link" href="../../pages/tables/basic-table.html">Basic table</a></li>
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
                                                #
                                            </th>
                                            <th>
                                                First name
                                            </th>
                                            <th>
                                                Product
                                            </th>
                                            <th>
                                                Amount
                                            </th>
                                            <th>
                                                Deadline
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="table-info">
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Herman Beck
                                            </td>
                                            <td>
                                                Photoshop
                                            </td>
                                            <td>
                                                $ 77.99
                                            </td>
                                            <td>
                                                May 15, 2015
                                            </td>
                                        </tr>
                                        <tr class="table-warning">
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                Messsy Adam
                                            </td>
                                            <td>
                                                Flash
                                            </td>
                                            <td>
                                                $245.30
                                            </td>
                                            <td>
                                                July 1, 2015
                                            </td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td>
                                                3
                                            </td>
                                            <td>
                                                John Richards
                                            </td>
                                            <td>
                                                Premeire
                                            </td>
                                            <td>
                                                $138.00
                                            </td>
                                            <td>
                                                Apr 12, 2015
                                            </td>
                                        </tr>
                                        <tr class="table-success">
                                            <td>
                                                4
                                            </td>
                                            <td>
                                                Peter Meggik
                                            </td>
                                            <td>
                                                After effects
                                            </td>
                                            <td>
                                                $ 77.99
                                            </td>
                                            <td>
                                                May 15, 2015
                                            </td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td>
                                                5
                                            </td>
                                            <td>
                                                Edward
                                            </td>
                                            <td>
                                                Illustrator
                                            </td>
                                            <td>
                                                $ 160.25
                                            </td>
                                            <td>
                                                May 03, 2015
                                            </td>
                                        </tr>
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
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
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