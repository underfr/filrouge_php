<?php
namespace App\Controller;
use App\Model\User;
use App\Utils\Utilitaire;
class UserController{
    private User $user;

    public function __construct(){
        $this->user = new User();
    }

    public function addUser(){
        $message = "";
        if(isset($_POST["register"])){
            if(!empty($_POST["firstname"])
                AND !empty($_POST["lastname"])
                AND !empty($_POST["email"])
                AND !empty($_POST["password"])){
                    $firstname = Utilitaire::sanitize($_POST["firstname"]);
                    $lastname = Utilitaire::sanitize($_POST["lastname"]);
                    $email = Utilitaire::sanitize($_POST["email"]);
                    $password = Utilitaire::sanitize($_POST["password"]);
                    $this->user->setFirstname($firstname);
                    $this->user->setLastname($lastname);
                    $this->user->setEmail($email);
                    $this->user->setPassword($password);
                    $this->user->hashPassword();
                    $this->user->saveUser();
                    $message = "Register Complete";
                } else {
                    $message = "Veuillez remplir tout les champs";
                }
        }
        include "App/View/viewSaveUser.php";
    }
}
