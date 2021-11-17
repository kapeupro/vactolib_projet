<?php
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
    $errors=textValidation($errors,$message,'message',10,500);


    //If no error
    if(count($errors)==0){
        mail('vactolibsupport@gmail.com', 'Envoi depuis la page Contact', $_POST['message'], 'From: ' . $_POST['email']);
    }
}
//debug($errors);
include('inc/header.php');
?>
    <section id="contact_form">
        <form action="" method="post" class="wrapform" novalidate>

            <div class="info_box">
                <label for="nom"></label>
                <input type="text" placeholder="Nom/Prenom*" id="nom" name="nom" value="<?=recupInputValue('nom');?>">
                <span class="error"><?= viewError($errors,'nom'); ?></span>
            </div>

            <div class="info_box">
                <label for="email"></label>
                <input type="email" placeholder="Email*" id="email" name="email" value="<?= recupInputValue('email'); ?>">
                <span class="error"><?= viewError($errors,'email'); ?></span>
            </div>

            <div class="info_box">
                <label for="phone"></label>
                <input type="tel" placeholder="Numéro de téléphone" pattern="[0-9]{10}" maxlength="10" id="phone" name="phone" value="<?= recupInputValue('phone'); ?>">
                <span class="error"><?= viewError($errors,'phone'); ?></span>
            </div>

            <div class="info_box">
                <label for="message"></label>
                <textarea type="text" placeholder="Votre message...*" id="message" name="message" value=""></textarea>
                <span class="error"><?= viewError($errors,'email'); ?></span>
            </div>

            <div class="info_box_button">
                <input type="submit" name="submitted" value="ENVOYER">
            </div>
            <p>Les champs avec * sont requis</p>
        </form>
        </div>
    </section>


<?php
include('inc/footer.php');
