<?php

define("DS", DIRECTORY_SEPARATOR);
define("PATH_ROOT", __DIR__);
define("PATH_IMGS", $_SERVER["DOCUMENT_ROOT"] . DS . "res" . DS . "site" . DS . "img" . DS . "products" . DS);

use \Hcode\Model\User;

function formatPrice($vlprice)
{
    if(!$vlprice > 0) $vlprice = 0;
    return number_format($vlprice, 2, ",", ".");
}

function checkLogin($inadmin = true)
{
    return User::checkLogin($inadmin);
}

function getUserName()
{
    $user = User::getFromSession();
    return $user->getdesperson();
}

function onlyNumbers($str){
    preg_match_all("/\d+/", $str, $arr);
    $res = implode("", $arr[0]);
    return $res;
}

function goURL($url, $stop = true){
    header("Location: {$url}");
    if($stop) exit;
}




