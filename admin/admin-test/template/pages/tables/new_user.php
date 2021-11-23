<?php
session_start();
require('../../../../../inc/pdo.php');
require('../../../../../inc/fonction.php');
require('../../../../../inc/request.php');

$errors = [];
if(!empty($_POST['submitted'])){

    $nom = cleanXss('nom');
    $prenom = cleanXss('prenom');
    $email = cleanXss('email');
    $password = cleanXss('password');

    $errors = textValidation($errors, $nom, 'nom', 3, 255);
    $errors = textValidation($errors, $prenom, 'prenom', 3, 255);
    $errors = textValidation($errors, $email, 'email', 3, 255);
    $errors = textValidation($password, $password, 'password',8, 255);


    if(count($errors) == 0){

        $sql = "INSERT INTO vactolib_user
    (nom,prenom, email, password)
    VALUES (:nom, :prenom, :email, :password)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':password', $password, PDO::PARAM_STR);
        $query ->execute();
        die ("ok");
//    header('Location: index.php');
    }else{
        debug($errors);
    }
}
debug($_GET);


include('../../inc/header.php'); ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ajout d'un utilisateur</h4>
                            <!-- FORMULAIRE DE MODIFICATION -->

                            <form method="post" role="form" id="contact-form" class="contact-form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput" class="form-label">Nom de utilisateur :</label>
                                            <input type="text" class="form-control" name="nom" value="<?php recupInputValue('nom') ?>" id="nom" placeholder="nom">
                                            <span class="text-danger"><?php viewError($errors, 'nom'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput" class="form-label">Prenom de utilisateur :</label>
                                            <input type="text" class="form-control" name="prenom" value="<?php recupInputValue('nom') ?>" id="prenom" placeholder="prenom">
                                            <span class="text-danger"><?php viewError($errors, 'prenom'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput" class="form-label">Adresse Mail :</label>
                                            <input type="text" class="form-control" name="email" value="<?php recupInputValue('email') ?>" id="email" placeholder="email">
                                            <span class="text-danger"><?php viewError($errors, 'email'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput" class="form-label">Mot de Passe :</label>
                                            <input type="text" class="form-control" name="password" value="<?php recupInputValue('password') ?>" id="password" placeholder="password">
                                            <span class="text-danger"><?php viewError($errors, 'password'); ?></span>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" name="submitted" class="btn btn-primary float-right" value="Ajouter un utilisateur">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include('../../inc/footer.php');
