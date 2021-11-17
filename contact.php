<?php
include('inc/fonction.php');


//echo $_GET['nom'];
//echo $_GET['prenom'];
//debut($_GET);
//$errors=array();


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


<?php
include('inc/footer.php');
