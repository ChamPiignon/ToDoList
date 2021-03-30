<?php

    class RegisterController
    {
            public function __construct()
            {
                global $db,$login,$mdp,$views;

                require_once($views['register']);

                if(isset($_REQUEST['firstName']) && !empty($_REQUEST['firstName']) && isset($_REQUEST['familyName']) && !empty($_REQUEST['familyName'])
                    && isset($_REQUEST['email']) && !empty($_REQUEST['email']) && isset($_REQUEST['password']) && !empty($_REQUEST['password'])
                    && isset($_REQUEST['checkPassword']) && !empty($_REQUEST['checkPassword']))
                {
                    $mail=Validation::valid_mail($_REQUEST['email']);
                    $name=Validation::valid_url($_REQUEST['familyName']);
                    $fName=validation::valid_url($_REQUEST['firstName']);
                    $pass=validation::valid_url($_REQUEST['password']);
                    $checkPass=validation::valid_url($_REQUEST['checkPassword']);
                    if($checkPass === $pass)
                    {
                        $newUtilisateur = new Utilisateur($mail,$pass,$name,$fName);
                        $gateway = new UtilisateurGateway($db,$login,$mdp);
                        if($gateway->register($newUtilisateur))
                        {
                            header('Location: ./?action=login');
                        }
                    }
                }
            }
    }
