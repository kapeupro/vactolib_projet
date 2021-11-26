<?php

session_start();
require('../../../../../inc/pdo.php');
require('../../../../../inc/fonction.php');
require('../../../../../inc/request.php');
verifUserConnectedAdminTables();
$errors = [];
$countAllVaccins = 0;

if(!empty($_GET['search'])) {
    $search = trim(strip_tags($_GET['search']));
    $searchVaccins = getVaccinBySearch($search);
}


if ($_SESSION['user']['status']=='admin'){

    include('../../inc/header.php'); ?>
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

<?php include('../../inc/footer.php'); } ?>