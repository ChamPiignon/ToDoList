<?php

    class Utilisateur
    {
        private $_email;
        private $_pass;
        private $_nom;
        private $_prenom;

        public function __construct()
        {
            $ctp = func_num_args();
            $args = func_get_args();
            switch($ctp)
            {
                case 1:
                    $this->hydrate($args[0]);
                    break;
                case 2:
                    $this->login($args[0],$args[1]);
                    break;
                case 4:
                    $this->create($args[0],$args[1],$args[2],$args[3]);
                    break;
                default:
                    throw new Exception("Invalid utilisateur constructeur");
            }
        }

        public function login(string $email, string $pass)
        {
            global $db,$login,$mdp;
            $utilisateurGateway = new UtilisateurGateway($db,$login,$mdp);
            if ($utilisateurGateway->userExist($email, $pass)) {
                $_SESSION['utilisateur'] = $email;
                $_SESSION['prenom'] = $utilisateurGateway->getPrenom($email);
                $_SESSION['nom'] = $utilisateurGateway->getNom($email);
                $_SESSION["loggedIn"] = true;

                if(isset($_REQUEST['isRemember']))
                {
                    setcookie('auth',$utilisateurGateway->getNoUserConnected(),time()+3600*24,'/','localhost',false,true);// true non editable js
                }
            }
        }

        public function create(string $email, string $pass, string $nom, string $prenom)
        {
            $this->setPrenom($prenom);
            $this->setEmail($email);
            $this->setNom($nom);
            $this->setPass($pass);
        }



        //APPEL LE SETTER DE CHACUNS DES ATTRIBUTS
        public function hydrate(array $data)
        {
            foreach($data as $element => $value)
            {
                $method = 'set'.ucfirst($element);
                if(method_exists($this,$method))
                    $this->$method($value);
            }
        }

        public function setEmail($email)
        {
            if(is_string($email))
            {
                $this->_email = $email;
            }
            else
            {
                throw new Exception("email is invalid");
            }
        }

        public function setPass($pass)
        {
            if(is_string($pass))
            {
                $this->_pass=$pass;
            }
            else
            {
                throw new Exception("pass is invalid");
            }
        }

        public function setNom($nom)
        {
            if(is_string($nom))
            {
                $this->_nom=$nom;
            }
            else
            {
                throw new Exception("nom is invalid");
            }
        }
        public function setPrenom($prenom)
        {
            if(is_string($prenom))
            {
                $this->_prenom=$prenom;
            }
            else
            {
                throw new Exception("prenom is invalid");
            }
        }

        public function getEmail()
        {
            return $this->_email;
        }

        public function getPass()
        {
            return $this->_pass;
        }

        public function getNom()
        {
            return $this->_nom;
        }

        public function getPrenom()
        {
            return $this->_prenom;
        }

}