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

    include('../../inc/header.php'); ?>


            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Modification utilisateurs</h4>
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

<?php include('../../inc/footer.php'); } else{die('403');} ?>