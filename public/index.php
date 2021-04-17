<?php

use App\Categorie\Categorie;
use App\Controller\{
    PostController,
    UserController,
    AdminController
};
use App\Post\Post;
use Core\Sys\{
    Auth,
    Config,
    Pagination
};

define('TIME_MS',microtime(true));
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
session_start();
Config::getInstance();
$user=Auth::getInstance();
$post=Post::getInstance();
$cat=Categorie::getInstance();
$page=Pagination::getInstance();
$router=new AltoRouter();
$postController=new PostController($router);
$adminController=new AdminController($router);
$userController=new UserController();
$GLOBALS['r']=$router;
$router->map('GET|POST','/',function() use($postController){
    $postController->home();
});
$router->map('GET','/categorie/[:action]',function() use($postController){
    $postController->categorie();
},'categorie');
$router->map('GET|POST','/post/[:action]',function() use($postController){
    $postController->post();
},'post');
$router->map('GET|POST','/login',function() use($userController){
    $userController->login();
},'login');
$router->map('GET|POST','/logout',function() use($userController){
    $userController->logout();
},'logout');
$router->map('GET|POST','/register',function() use($userController){
    $userController->register();
},'register');
$router->map('GET|POST','/admin',function() use($adminController){
    $adminController->home();
},'admin');
$router->map('GET|POST','/admin/[a:action]',function() use($adminController){
    $adminController->home();
},'adcat');
$router->map('GET|POST','/admin/add/[:action]',function() use($adminController){
    $adminController->add();
},'add');
$router->map('GET|POST','/admin/edit/[:action]',function() use($adminController){
    $adminController->edit();
},'edit');
$router->map('GET|POST','/admin/delete/[:action]',function() use($adminController){
    $adminController->delete();
},'delete');

$match = $router->match();
if(is_array($match)){
    if(is_callable( $match['target'] ) ){
	    call_user_func_array( $match['target'], $match['params'] ); 
    }else{
        ob_start();
        require_once Config::$View."{$match['target']}.php";
        $containe=ob_get_clean();
    }
    
}else{
    ob_start();
    require_once Config::$View_layout."404.php";
    $containe=ob_get_clean();
}
require_once Config::$View_layout."Layout.php";


