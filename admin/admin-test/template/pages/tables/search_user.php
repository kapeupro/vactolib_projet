<?php

session_start();
require('../../../../../inc/pdo.php');
require('../../../../../inc/fonction.php');
require('../../../../../inc/request.php');

$errors = [];
$countAllUsers = 0;

if(!empty($_GET['search'])) {
    $search = trim(strip_tags($_GET['search']));
    $searchUsers = getUserBySearch($search);
}


if ($_SESSION['user']['status']=='admin'){

    include('../../inc/header.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Nos utilisateurs</h4>
                                    <div class="table-responsive pt-3">
                                        <table class="table table-bordered">

                                            <!-- BARRE DE RECHERCHE -->
                                            <form action="search_user.php" method="get">
                                                <div>
                                                    <div class="col d-flex flex-row py-3 justify-content-end">
                                                        <input type="search" class="form-control mr-2 col-5" id="datatable-search-input" placeholder="Rechercher ..." name="search" value="<?php if(!empty($_GET['search'])) {echo $_GET['search'];} ?>">
                                                        <input class=" btn btn-primary" type="submit" class="form-control col-1">
                                                    </div>
                                                </div>
                                            </form>

                                            <?php
                                            if(empty($searchUsers)) {
                                                echo '<p style="color: red; font-weight: bold;">Aucun utilisateur trouvé ... </p>';
                                            }else { ?>
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
                                            <?php foreach($searchUsers as $searchUser){ ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $searchUsers[$countAllUsers]['id']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $searchUsers[$countAllUsers]['nom']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $searchUsers[$countAllUsers]['prenom']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $searchUsers[$countAllUsers]['email']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $searchUsers[$countAllUsers]['portable']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $searchUsers[$countAllUsers]['created_at']?>
                                                    </td>
                                                    <td>
                                                        <?php echo $searchUsers[$countAllUsers]['status']?>
                                                    </td>
                                                    <td>
                                                        <a href="modif_user.php?id=<?= $searchUsers[$countAllUsers]['id'] ?>">Modifier</a>
                                                    </td>
                                                    <td>
                                                        <a href="delete_user.php?id=<?= $searchUsers[$countAllUsers]['id'] ?>">Supprimer</a>
                                                    </td>
                                                </tr>
                                                <?php $countAllUsers++; } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php include('../../inc/footer.php'); } else{die('403');} ?>