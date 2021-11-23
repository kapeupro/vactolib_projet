<?php
session_start();

include('inc/fonction.php');

$errors=array();
if(!empty($_POST['submitted']))
{
    //faille XSS
    $nom       = cleanXss('nom');
    $phone     = cleanXss('phone');
    $email     = cleanXss('email');
    $message   = cleanXss('message');

    $errors=mailValidation($errors,$email,'email');
    $errors=textValidation($errors,$nom,'nom',2);
    $errors=textValidation($errors,$phone,'phone',2);
    $errors=textValidation($errors,$message,'message',10,500);


    //If no error
    if(count($errors)==0){
        mail('vactolibsupport@gmail.com', 'Envoi depuis la page Contact', $_POST['message'], 'From: ' . $_POST['email']);
    }
}
//debug($_SESSION);
include('inc/header.php');
?>
<div class="title_contact">
    <h2>Nous Contacter</h2>
</div>
<?php if(!empty($_SESSION)){ echo'<link rel="stylesheet" href="asset/css/style_user.css">';} else {} ?>
<section id="form_contact">
    <form action="" method="post" class="wrapform" novalidate>
        <div class="boxinfo_contact_bis">
            <label for="nom"></label>
            <input type="text" placeholder="Nom Prenom*" id="nom" name="nom" value="<?=recupInputValue('nom');?>">
            <span class="error"><?= viewError($errors,'nom'); ?></span>
        </div>
        <div class="boxinfo_contact">
            <label for="email"></label>
            <input type="email" placeholder="Email*" id="email" name="email" value="<?= recupInputValue('email'); ?>">
            <span class="error"><?= viewError($errors,'email'); ?></span>
        </div>
        <div class="boxinfo_contact_bis">
            <label for="phone"></label>
            <input type="tel" placeholder="Numéro de téléphone*" pattern="[0-9]{10}" maxlength="10" id="phone" name="phone" value="<?= recupInputValue('phone'); ?>">
            <span class="error"><?= viewError($errors,'phone'); ?></span>
        </div>
        <div class="boxinfo_contact">
            <label for="message"></label>
            <textarea type="text" placeholder="Votre message...*" id="message" name="message" value=""></textarea>
            <span class="error"><?= viewError($errors,'email'); ?></span>
        </div>
        <div class="button_type1">
            <input type="submit" name="submitted" value="ENVOYER">
        </div>
        <p>Les champs avec * sont requis</p>
    </form>
</section>


<?php
include('inc/footer.php');
