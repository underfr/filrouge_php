<?php

namespace App\Controller;

use App\Model\Category;
use App\Utils\Utilitaire;

class CategoryController
{
    //Attribut Model Category
    private Category $category;

    public function __construct()
    {
        //Injection de dépendance
        $this->category = new Category();
    }

    public function showAllCategory()
    {
        //Test si le message existe
        if (isset($_GET["message"])) {
            //Récupération et sanitize du message
            $message = Utilitaire::sanitize($_GET["message"]);
            //refresh de la page au bout de 1 seconde et demie
            header("Refresh:1.5; url=".BASE_URL."/category/all");
        }
        //tableau des catégories
        $categories = $this->category->findAllCategory();
        include "App/View/viewAllCategory.php";
    }

    public function addCategory()
    {
        //Message erreur ou confirmation
        $message = "";
        //tester si le formulaire est soumis
        if (isset($_POST["submit"])) {
            //tester si le champs est non vide
            if (!empty($_POST["name"])) {
                //nettoyer les informations
                $name = Utilitaire::sanitize($_POST["name"]);
                //Créer un Objet Category
                $category = new Category();
                //Setter le nom
                $category->setName($name);
                //tester si la category n'existe pas
                if (!$category->isCategoryByNameExist()) {
                    //ajouter la category en BDD
                    $category->saveCategory();
                    //redirection vers la liste des categories avec un paramètre GET
                    header("Location: ".BASE_URL."/category/all?message=La category " . $name . " a été ajouté en BDD", true, 201);
                } else {
                    $message = "La categorie existe déja";
                }
            } else {
                $message = "Veuillez remplir les champs obligatoire";
            }
        }

        include "App/View/viewAddCategory.php";
    }

    public function removeCategory()
    {
        if (isset($_POST["delete"])) {
            $id = Utilitaire::sanitize($_POST["id"]);
            $this->category->deleteCategory($id);
            header('Location: '.BASE_URL.'/category/all?message=La catégorie a été supprimé');
        }
        header('Location: '.BASE_URL.'/category/all');
    }

    public function modifyCategory()
    {

        //test si le formulaire est submit
        if (isset($_POST["submit"])) {
            //Test si le champ est vide
            if (empty($_POST["name"])) {
                //redirection à la liste des catégorie avec un message
                header('Location: '.BASE_URL.'/category/all?message=Veuillez remplir tous les champs');
            }
            //nettoyage des informations
            $name = Utilitaire::sanitize($_POST["name"]);
            $id = Utilitaire::sanitize($_POST["id"]);
            //set du name
            $this->category->setName($name);
            //Test si la catégorie existe déja (éviter les doublons)
            if ($this->category->isCategoryByNameExist()) {
                //redirection à la liste des catégorie avec un message
                header('Location: '.BASE_URL.'/category/all?message=Aucune mise à jour');
            }
            //Mise à jour de la catégorie
            $this->category->updateCategory($id);
            //redirection à la liste des catégorie avec un message
            header('Location: '.BASE_URL.'/category/all?message=la categorie a été mise à jour');
        } else {
            //sanitize de l'id
            $id = Utilitaire::sanitize($_POST["id"]);
            //récupération de la précédente valeur de la catégorie
            $cat = $this->category->findCategory($id);
        }
        include "App/View/viewModifyCategory.php";
    }
}
