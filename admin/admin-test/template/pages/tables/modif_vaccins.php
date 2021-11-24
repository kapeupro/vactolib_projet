<?php

session_start();
require('../../../../../inc/pdo.php');
require('../../../../../inc/fonction.php');
require('../../../../../inc/request.php');

if ($_SESSION['user']['status']=='admin'){

$errors = [];
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $vaccin = getVaccinById($id);

}
    if(!empty($vaccin)){
        if(!empty($_POST['submitted'])){

            $name = cleanXss('name');
            $laboratoire = cleanXss('laboratoire');
            $rappel = cleanXss('rappel');
            $description = cleanXss('description');


            $errors = textValidation($errors, $name, 'name', 3, 255);
            $errors = textValidation($errors, $laboratoire, 'laboratoire', 3, 50);
            $errors = textValidation($errors, $description, 'description', 3, 450);
            $errors = textValidation($errors, $rappel, 'rappel', 1, 11);

            if(count($errors) == 0){
                $sql = "UPDATE vactolib_vaccins
                SET nom_vaccin = :nom_vaccin, laboratoire = :laboratoire, description = :description, rappel = :rappel
                WHERE id = :id";
                $query = $pdo->prepare($sql);
                $query->bindValue(':nom_vaccin', $name, PDO::PARAM_STR);
                $query->bindValue(':laboratoire', $laboratoire, PDO::PARAM_STR);
                $query->bindValue(':description', $description, PDO::PARAM_STR);
                $query->bindValue(':rappel', $rappel, PDO::PARAM_INT);
                $query->bindValue(':id', $id, PDO::PARAM_INT);
                $query ->execute();
                header('Location: basic-table.php');
            }else{
            }
        }
}
    include('../../inc/header.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Modification vaccins</h4>
                                    <!-- FORMULAIRE DE MODIFICATION -->

                                    <form method="post" role="form" id="contact-form" class="contact-form">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Nom du vaccin :</label>
                                                    <input type="text" class="form-control" name="name" value="<?php echo $vaccin['nom_vaccin']; ?>" id="Name" placeholder="Nom vaccin">
                                                    <span class="text-danger"><?php viewError($errors, 'name'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Laboratoire :</label>
                                                    <input type="text" class="form-control" name="laboratoire" value="<?php echo $vaccin['laboratoire']; ?>" id="laboratoire" placeholder="laboratoire">
                                                    <span class="text-danger"><?php viewError($errors, 'laboratoire'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Nombre de jours avant rappel :</label>
                                                    <input type="text" class="form-control" name="rappel" value="<?php echo $vaccin['rappel']; ?>" id="rappel" placeholder="rappel">
                                                    <span class="text-danger"><?php viewError($errors, 'rappel'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput" class="form-label">Description :</label>
                                                    <textarea class="form-control textarea" rows="4" name="description" id="Description" placeholder="Description"><?php echo $vaccin['description']; ?></textarea>
                                                    <span class="text-danger"><?php viewError($errors, 'description'); ?></span>
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


<?php include('../../inc/footer.php'); } else{header("Location: 403.php");
    die();} ?>