<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
require('vendor/autoload.php');
verifUserConnected();
use JasonGrimes\Paginator;

$id_session = $_SESSION['user']['id'];

$sql = "SELECT * FROM vactolib_user WHERE id=:id ";
$query = $pdo->prepare($sql);
$query->bindValue(':id',$id_session,PDO::PARAM_STR);
$query->execute();
$user= $query->fetch();


// PAGINATION
$currentPage = 1;
$itemsPerPage = 2;
$totalItems = countAllVaccinUser();
$urlPattern = '?page=(:num)';

if(!empty($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = $_GET['page'];
    $offset = ($currentPage - 1) * $itemsPerPage;
}

$user_vaccins = getVaccins($itemsPerPage, $offset, $id_session);
debug($user_vaccins);
$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

//initialisation d'un compteur pour la boucle foreach
$i = 0;

include('inc/header.php'); ?>
    <section>
        <div class="title-carnet">
            <h2>Mon Carnet</h2>
        </div>

        <?php if(empty($user_vaccins)) { ?>
            <div class="carnet_vide">
                <p>Nous n'avons aucun vaccin à afficher ...</p>
                <a class="button_type2" href="ajouter.php">Ajouter un vaccin ?</a>
            </div>
        <?php } else { ?>

            <div id="carnet">
                <div class="wrap">
                    <div id="container-carnet">
                        <?php foreach ($user_vaccins as $user_vaccin){ ?>
                            <div class="items-carnet">
                                <h3>Vaccination <?php echo $user_vaccins[$i]['nom_vaccin']; ?></h3>
                                <p> <?php echo $user['nom'];echo' ';echo $user['prenom'] ?></p>
                                <p><?php echo $user_vaccins[$i]['laboratoire'] ?> fait le <?php echo dateFormatWithoutHour($user_vaccins[$i]['vaccin_date'], 'd/m/Y') ?></p>
                                <a class="button_type2" href="detail.php?id=<?php echo $user_vaccins[$i]['id']; ?> "> En savoir plus </a>
                                <a onclick="Validation()" class="button_type2" href="delete.php?id=<?php echo $user_vaccins[$i]['id'] ?>"> Supprimer </a>
                                <script>function Validation() {confirm("Voulez-vous vraiment supprimer ce vaccin de votre carnet ?");}</script>
                            </div>
                            <?php $i++; } ?>
                    </div>
                </div>
            </div>

            <div class="ajout-vaccin">
                <a href="ajouter.php"><img src="asset/img/cta-ajout.svg">Ajouter un vaccin</a>
            </div>
        <?php } ?>

        <div class="text-center">
            <?php echo $paginator; ?>
        </div>

    </section>

<?php include('inc/footer.php');
