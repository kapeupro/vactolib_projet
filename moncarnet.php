<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

$id_session=$_SESSION['user']['id'];

$user=getUserBySessionId($id_session);
$user_vaccins=getUserVaccinsBySessionId($id_session);

if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}

$sql = 'SELECT COUNT(*) AS nb_articles FROM `vactolib_user_vaccins`;';
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetch();
$nbArticles = (int) $result['nb_articles'];
$parPage = 2;
// On calcule le nombre de pages total
$pages = ceil($nbArticles / $parPage);
// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;
$sql = 'SELECT * FROM `vactolib_user_vaccins` ORDER BY `created_at` DESC LIMIT :premier, :parpage;';
// On prépare la requête
$query = $pdo->prepare($sql);
$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$query->execute();
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

$sqlleft = "SELECT vv.nom_vaccin, vv.laboratoire, vv.id ,vuv.vaccin_date
        FROM vactolib_user_vaccins AS vuv
        LEFT JOIN vactolib_vaccins AS vv
        ON vv.id = vuv.vaccin_id
        WHERE vuv.user_id = :id_session ORDER BY created_at DESC";
$query = $pdo->prepare($sqlleft);
$query->bindValue(':id_session',$id_session,PDO::PARAM_INT);
$query->execute();
$userVaccin = $query->fetchAll();
debug($userVaccin);
//initialisation d'un compteur pour la boucle foreach
$i = 0;

include('inc/header.php'); ?>
    <link rel="stylesheet" href="asset/css/style_user.css">
<section>
    <div class="title-carnet">
        <h2>Mon Carnet</h2>

        <ul class="pagination">
            <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
            </li>
            <?php for($page = 1; $page <= $pages; $page++): ?>
                <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                    <a href="./?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                </li>
            <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
            </li>
        </ul>
    </div>

    <?php if(empty($userVaccin)) { ?>
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
                        <h3>Vaccination <?php echo $userVaccin[$i]['nom_vaccin']; ?></h3>
                        <p> <?php echo $_SESSION['user']['nom'];echo' ';echo $_SESSION['user']['prenom'] ?></p>
                        <p><?php echo $userVaccin[$i]['laboratoire'] ?> fait le <?php echo dateFormatWithoutHour($userVaccin[$i]['vaccin_date'], 'd/m/Y') ?></p>
                        <a class="button_type2" href="detail.php?id=<?php echo $userVaccin[$i]['id']; ?> "> En savoir plus </a>
                </div>
                <?php $i++; } ?>
            </div>
        </div>
    </div>

    <div class="ajout-vaccin">
            <a href="ajouter.php"><img src="asset/img/cta-ajout.svg">Ajouter un vaccin</a>
    </div>

    <?php } ?>


</section>

<?php include('inc/footer.php');
