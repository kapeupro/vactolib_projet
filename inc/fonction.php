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

function selectValidation($errors,$value,$key){
if(empty($value)) {
$errors[$key] = "Veuillez renseigner un état";
}
}

function textValidation($errors,$value,$key,$min=0,$max=500)
{
if(!empty($value)){
if (mb_strlen($value)<$min) {
$errors[$key]='Min '.$min.' caractères svp';
} elseif(mb_strlen($value)>$max){
$errors[$key]='Max '.$max.' caractères svp';
}
} else{
$errors[$key]='Veuillez renseigner ce champ';
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


