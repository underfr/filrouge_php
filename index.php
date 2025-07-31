<?php

//importer les ressources
include "./env.php";

include "./vendor/autoload.php";

//Analyse de l'URL avec parse_url() et retourne ses composants
$url = parse_url($_SERVER['REQUEST_URI']);
//test si l'url posséde une route sinon on renvoi à la racine
$path = $url['path'] ??  '/';

//import des classes controller
use App\Controller\HomeController;
use App\Controller\CategoryController;
use App\Controller\UserController;
//Instance des controller
$homeController = new HomeController();
$categoryController = new CategoryController();
$userController = new UserController();
//Test des routes
switch (substr($path, strlen(BASE_URL))) {
    case "/":
        $homeController->home();
        break;
    case "/category/all":
        $categoryController->showAllCategory();
        break;
    case "/category/add":
        $categoryController->addCategory();
        break;
    case "/category/delete":
        $categoryController->removeCategory();
        break;
    case "/category/update":
        $categoryController->modifyCategory();
        break;
    case "/user/register":
        $userController->addUser();
        break;
    case "/user/login":
        break;
    case "/user/logout":
        break;
    default:
        $homeController->error404();
        break;
}
