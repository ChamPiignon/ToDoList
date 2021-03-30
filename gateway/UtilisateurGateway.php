<?php

class UtilisateurGateway extends Gateway
{
    public function userExist(string $email, string $password) : bool
    {
        $query = "SELECT password FROM Utilisateur WHERE email=:email";
        $this->con->executeQuery($query, array
        (
            ':email' => array($email, PDO::PARAM_STR),
        ));
        $res = $this->con->getResults();

        if(isset($res[0]["password"]) && password_verify($password,$res[0]["password"]))
        {
            return true;
        }
        return false;
    }

    public function register(Utilisateur $utilisateur)
    {
        $query = 'INSERT INTO Utilisateur(email, nom, password, prenom) VALUES (:email, :nom, :password, :prenom)';
        return $this->con->executeQuery($query, array
        (
            ':email' => array($utilisateur->getEmail(), PDO::PARAM_STR),
            ':nom' => array($utilisateur->getNom(), PDO::PARAM_STR),
            ':password' => array(password_hash($utilisateur->getPass(),PASSWORD_DEFAULT), PDO::PARAM_STR),
            ':prenom' => array($utilisateur->getPrenom(), PDO::PARAM_STR)
        ));
    }

    public function getNoUserConnected() : string
    {
        if(!isset($_SESSION['utilisateur']))
        {
            throw new Exception("Utilisateur non connecté");
        }
        $query = "SELECT noUser FROM `Utilisateur` WHERE email=:email";
        $this->con->executeQuery($query, array(':email' => array($_SESSION['utilisateur'], PDO::PARAM_STR)));
        $res = $this->con->getResults();
        if (count($res) == 1)
        {
            return strval($res[0][0]);
        }
    }

    public function getPrenom(string $email) : string
    {
        $query = "SELECT Prenom FROM `Utilisateur` WHERE email=:email";
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR)));
        $res = $this->con->getResults();
        if (count($res) == 1)
        {
            return strval($res[0]["Prenom"]);
        }
    }

    public function getNom(string $email): string
    {
        $query = "SELECT Nom FROM `Utilisateur` WHERE email=:email";
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR)));
        $res = $this->con->getResults();
        if (count($res) == 1)
        {
            return strval($res[0]["Nom"]);
        }
    }
}