<?php

class Router
{
    private $ctrl;
    function __construct()
    {

        global $views,$dir;
        $errors = array();

        try
        {
            if(isset($_REQUEST['action']))
            {
                $action = Validation::valid_url($_REQUEST['action']);
                switch ($action)
                {
                    case 'home':
                        $this->ctrl = new HomeController();
                        break;
                    case 'register':
                        $this->ctrl = new RegisterController();
                        break;
                    case 'login':
                        require_once($views['login']);
                        $this->login();
                        break;
                    case 'disconnect':
                        $this->disconnect();
                        require_once($views['home']);
                        break;
                    default:
                        throw new Exception('404 not found');
                }
            }
            else
            {
                $this->ctrl = new HomeController();
            }
        }
        catch (Exception $e)
        {
            $errors[] = 'Exception: ' . $e->getMessage();
            require_once($views['error']);
        }
        exit(0);
    }

    private function login()
    {
        $this->ctrl = new LoginController();
        if(isset($_POST["email"]) && isset($_POST["password"]))
        {
            $this->ctrl->login($_POST["email"],$_POST["password"]);
        }
        if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"])
        {
            header('Location: ./?action=home');
        }
    }

    private function disconnect()
    {
        $this->ctrl = new LoginController();
        $this->ctrl->disconnect();
        header('Location: ./?action=home');
    }
}
