<?php
namespace Core\Sys;

use App\User\User;

class Auth
{
    private static $_instance;

    public static function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance=new Auth();
        }
        return self::$_instance;
    }
    /**
     * createSession
     *
     * @param  mixed $array
     * @return bool
     */
    private function createSession($array):bool
    {
        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }
        if(empty($array)){
            $session_created=false;
            $_SESSION['error']=true;
        }else{
            $_SESSION['error']=true;
            $_SESSION['login']=true;
            $_SESSION['id']=$array['id'];
            $_SESSION['role']=$array['role'];
            $session_created=true;
        }
        return $session_created;
    }        
    /**
     * Login
     *
     * @param  mixed $username
     * @param  mixed $password
     * @return bool
     */
    public function Login($username,$password)
    {
        $result=[];
        if($id=(int)User::getInstance()->getIdUser($username)){        
            $users=User::getInstance()->pdo->query("SELECT * FROM users WHERE user_id='".$id."'")->fetchAll();
            foreach($users as $user){
                if($user['password']==$password){
                    $result['role']=(int)$user['role']?'admin':'user';
                    $result['id']=$user['user_id'];
                    break 1;
                }
            }   
        } 
        if($this->createSession($result)){
            return true;
        }else{
            return false;
        }
    }        
    /**
     * logoutUser
     *
     * @return void
     */
    public static function logoutUser()
    {
        session_destroy();
    }
}