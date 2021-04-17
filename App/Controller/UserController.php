<?php 
namespace App\Controller;

use Core\Controller\Controller;
use Core\Sys\Auth;

class UserController extends Controller
{
    public $user;
    public function __construct()
    {
        parent::__construct();
        $this->user=Auth::getInstance();
    }
    public function login()
    {     
        $user=$this->user;    
        $tittle='LOGIN';
        if(isset($_SESSION['login'])&&$_SESSION['login']){
            if(isset($_SESSION['role'])&&$_SESSION['role']=='admin'){
                header('Location: /admin');
            }else{
                header('Location: /');
            }
        }
        else{
            if(isset($_POST['submit'])){
                $login=$user->Login($_POST['username'],$_POST['password']);
                
                if($login){
                header('Location: /');
                }
            }
        }
        $this->render('layout/login',compact('tittle'));

    }
    public function register()
    {
        $tittle='REGISTER';
        if(isset($_SESSION['login'])&&$_SESSION['login'])
            header('Location: /');
        $this->render('layout/register',compact("tittle"));
    }
    public function logout()
    {
        $this->user->logoutUser();
        header('location: /');
    }
}