<?php
include('inc/fonction.php');



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

    }
}
debug($errors);
include('inc/header.php');
?>
    <section id="contact_form">

    <form method="post">
        <label>Email</label>
        <input type="email" name="email" required><br>
        <label>Message</label>
        <textarea name="message" required></textarea><br>
        <input type="submit">
    </form>
    <?php
    if (isset($_POST['message'])) {
        $position_arobase = strpos($_POST['email'], '@');
        if ($position_arobase === false)
            echo '<p>Votre email doit comporter un arobase.</p>';
        else {
            $retour = mail('jules@free.fr', 'Envoi depuis la page Contact', $_POST['message'], 'From: ' . $_POST['email']);
            if($retour)
                echo '<p>Votre message a été envoyé.</p>';
            else
                echo '<p>Erreur.</p>';
        }
    }
    ?>
    </section>


<?php
include('inc/footer.php');
