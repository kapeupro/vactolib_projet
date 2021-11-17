<?php
include('inc/fonction.php');
include('inc/header.php');

//echo $_GET['nom'];
//echo $_GET['prenom'];
//debut($_GET);
$errors=array();


//existe et n'est pas vide
if(!empty($_POST['submitted']))
{
//    echo'OK FORMULAIRE SOUMIS';
    debug($_POST);
    //faille XSS
    $prenom    = cleanXss('prenom');
    $nom       = cleanXss('nom');
    $phone     = cleanXss('phone');
    $email     = cleanXss('email');
    $message   = cleanXss('message');


    $errors=textValidation($errors,$nom,'nom',10);
    $errors=textValidation($errors,$prenom,'prenom',2,80);
    $errors=textValidation($errors,$message,'message',10,500);
    $errors=mailValidation($errors,$email,'email');

    //If no error
    if(count($errors)==0){
        die('ok ici aucune error cest good');
    }
}
debug($errors);
?>

    <h1>Les formulaires</h1>

    <form action="" method="post" novalidate>
        <label for="nom">Nom *</label>
        <input type="text" name="nom" id="nom" value="<?php recupInputeValue('nom'); ?>">
        <span class="error"> <?php viewError($errors,'nom');?></span>

        <label for="prenom">Prénom *</label>
        <input type="text" name="prenom" id="prenom" value="<?php recupInputeValue('prenom'); ?>" >
        <span class="error"> <?php viewError($errors,'prenom');?></span>

        <label for="email">Email *</label>
        <input type="text" name="email" id="email" value="<?php recupInputeValue('prenom'); ?>">
        <span class="error"> <?php viewError($errors,'email'); ?></span>
        <br/>
        <br/>

        <label for="message">Message :</label>
        <textarea name="message" id="message" cols="30" rows="10"><?php if (!empty($_POST['message'])) {echo $_POST['message']; } ?></textarea>
        <span class="error"> <?php if(!empty($errors['message'])){echo$errors['message'];} ?></span>
        <br/>

        <input type="submit" name="submitted">

    </form>

<?php
include('inc/footer.php');
