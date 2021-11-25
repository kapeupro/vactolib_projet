<?php

session_start();
require('../../../../../inc/pdo.php');
require('../../../../../inc/fonction.php');
require('../../../../../inc/request.php');
verifUserConnectedAdmin();


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

    include('../../inc/header.php'); ?>


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
                                        <?php foreach ($admins as $admin){

                                        } ?>
                                        <tr>
                                            <td>Jacob</td>
                                            <td>53275531</td>
                                            <td>12 May 2017</td>
                                            <td>Portable</td>
                                            <td><label class="badge badge-danger">Admin</label></td>
                                        </tr>
                                        <?php foreach($admins as $admin){ ?>
                                            <tr>
                                                <td><?php echo $admins[$countAdmin]['nom']; ?></td>
                                                <td><?php echo $admins[$countAdmin]['prenom']; ?></td>
                                                <td><?php echo $admins[$countAdmin]['email']; ?></td>
                                                <td><?php echo $admins[$countAdmin]['portable']; ?></td>
                                                <td><label class="badge badge-danger">Admin</label></td>
                                            </tr>
                                        <?php $countAdmin++; } ?>
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
                                        <!-- BARRE DE RECHERCHE -->

                                        <form action="search_user.php" method="get">
                                            <div>
                                                <div class="col d-flex flex-row py-3 justify-content-end">
                                                    <input type="search" class="form-control mr-2 col-5" id="datatable-search-input" placeholder="Rechercher ..." name="search" value="<?php if(!empty($_GET['search'])) {echo $_GET['search'];} ?>">
                                                    <input class=" btn btn-primary" type="submit" class="form-control col-1">
                                                </div>
                                            </div>
                                        </form>

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
                                <a href="new_vaccin.php" type="button" class="mr-3 btn btn-primary float-right">Ajouter Vaccin</a>
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
        </div>

<?php include('../../inc/footer.php');