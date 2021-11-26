<?php

//FONCTIONS BASIQUES DE BASE (Ne pas toucher)
function debug($tableau){
echo '<pre style="height:200px;overflow-y:scroll;font-size:.7rem;padding:.6rem;font-family: Consolas,Monospace;background-color: black;color:#33d00c;">';
   print_r($tableau);
   echo'</pre>';
};

function dateFormat($data, string $format = 'd/m/Y à H:i') : string
{
if($data == null) {
return '';
}
return date($format,strtotime($data));
}
function dateFormatWithoutHour($data, string $format = 'd/m/Y') : string
{
    if (strtotime($data) != NULL) {
        return date($format, strtotime($data));
    } else {
        return '';
    }
}

function selectValidation($errors,$value,$key){
if(empty($value)) {
$errors[$key] = "Veuillez renseigner un état";
}
}

function textValidation($errors,$value,$key,$min=0,$max=500)
{
if(!empty($value)){
if (mb_strlen($value)<$min) {
$errors[$key]='Veuillez renseigner au minimum '.$min.' caractères';
} elseif(mb_strlen($value)>$max){
$errors[$key]='Veuillez renseigner au maximum '.$max.' caractères ';
}
} else{
$errors[$key]='Veuillez renseigner ce champ';
}
return $errors;
}


function intValidation($errors, $value, $key){
    if (!empty($value)) {
        if (!is_int($key)){
            $errors[$key] = "Veuillez renseigner un entier";
        }
    }
    return $errors;
}


function mailValidation($errors,$value,$key){
if(!empty($value)){
if (filter_var($value, FILTER_VALIDATE_EMAIL)==false) {
$errors[$key]='Veuillez renseigner un email valide';
}
} else{
$errors[$key]='Veuillez renseigner ce champ';
}
return $errors;
}

function phoneNumberValidation($errors,$value,$key)
{
    if (!empty($value)) {
        $regex = '#^0[6-7]{1}\d{8}$#';
        if (!preg_match($regex, $value)) {
            $errors[$key] = "Veuillez renseigner un numéro valide";
        }
    }
    return $errors;
}

function cleanXss($key){
return trim(strip_tags($_POST[$key]));
}

function recupInputValue($key){
if (!empty($_POST[$key])) {
echo $_POST[$key];
}
}

function viewError($errors,$key)
{
if(!empty($errors[$key])) {
echo $errors[$key];
}
}
//

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function verifUserConnected(){
    if (isLogged()==false){
        header('Location: login.php');
    }
}
function verifUserConnectedAdmin(){
    if (isAdmin()==false){
        header('Location: http://localhost/Vactolib/403.php');
    }
}
function verifUserConnectedAdminTables(){
    if (isAdmin()==false){
        header('Location: http://localhost/Vactolib/403.php');
    }
}

function verifUserAlreadyConnected(){
    if (isLogged()==true){
        header('Location: index.php');
    }else{ }
}



function isLogged()
{
    if(!empty($_SESSION['user'])) {
        if (!empty($_SESSION['user']['id'])) {
            if (!empty($_SESSION['user']['email'])) {
                    if (!empty($_SESSION['user']['status'])) {
                        if (!empty($_SESSION['user']['ip'])) {
                            if ($_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
                                return true;
                            }
                        }
                    }
            }
        }
    }
    return false;
}

function isAdmin()
{
    if(isLogged()) {
        if($_SESSION['user']['status'] == 'admin') {
            return true;
        }
    }
    return false;
}
