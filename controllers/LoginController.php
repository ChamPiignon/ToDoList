<?php

 class LoginController
 {
     public function login(string $email, string $mdp)
     {
            $emailValid=Validation::valid_mail($email);
            $mdpValid=Validation::valid_string($mdp);
            new Utilisateur($emailValid,$mdpValid);
     }

     public function disconnect()
     {
         session_unset();
         session_destroy();
         setcookie('noUser','',-3600,'/','localhost',false,true);
         $_SESSION = array();
     }

     public function isConnect() : bool
     {
         if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"]=false)
             return false;
         return true;
     }
 }

