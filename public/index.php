<?php

use App\Categorie\Categorie;
use App\Post\Post;
use App\Sys\{
    Auth,
    Config,
    Pagination
};

define('TIME_MS',microtime(true));
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
session_start();
new Config();
$user=new Auth();
$post=new Post();
$cat=new Categorie();
$router=new AltoRouter();
$page=new Pagination();
$router->map('GET|POST','/','post/home');
$router->map('GET|POST','/login','layout/login','login');
$router->map('GET|POST','/logout','layout/logout','logout');
$router->map('GET|POST','/register','layout/register','register');
$router->map('GET','/categorie/[:action]','categorie/categorie','categorie');
$router->map('GET|POST','/post/[:action]','post/post','post');
$router->map('GET|POST','/admin','admin/home','admin');
$router->map('GET|POST','/admin/add/[:action]','admin/add','add');
$router->map('GET|POST','/admin/edit/[:action]','admin/edit','edit');
$router->map('GET|POST','/admin/delete/[:action]','admin/delete','delete');
/* $router->map('GET|POST','/login','layout/login','login');
$router->map('GET|POST','/logout','layout/logout','logout');
 */
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


