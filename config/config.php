<?php
//
$dir=__DIR__.'/../';

//BD
$host='mysql:host=localhost';
$base='projetweb';
$db='mysql:host=localhost;dbname=projetweb';
$login='root';
$mdp='';

//VIEWS
$views['error']=$dir.'views/error.php';
$views['home']=$dir.'views/home.php';
$views['login']=$dir.'views/login.php';
$views['register']=$dir.'views/register.php';

//CSS
$css['style']='views/css/style.css';
$css['utils']='views/css/utils.css';

session_start();
if(isset($_COOKIE['noUser']) && !isset($_SESSION["utilisateur"]))
{
    //new Utilisateur($email,$pass)
}