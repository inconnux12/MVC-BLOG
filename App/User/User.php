<?php
namespace App\User;

use Core\Sys\DBConnection;

class User extends DBConnection
{    
    /**
     * id
     *
     * @var mixed id of the user.
     */
    protected $id;    
    /**
     * username
     *
     * @var mixed username of the user.
     */
    protected $username;    
    /**
     * password
     *
     * @var mixed password of the user.
     */
    protected $password;    
    /**
     * role
     *
     * @var mixed role of the user.
     */
    protected $role;    
    private static $_instance;

    public static function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance=new User();
        }
        return self::$_instance;
    }
    /**
     * __construct
     * inherit from DB. if don't exist create new instance of PDO
     * @return void 
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * addUser
     *create a new user and added to DB 
     * @param  mixed $username
     * @param  mixed $password
     * @param  mixed $role
     * @return bool success or fail
     */
    public function addUser($username,$password,$role)
    {
        if($this->verifyExist($username)){
            return false;
        }else{
            $query=$this->pdo->prepare("INSERT INTO users VALUES (?,?,?,?,?)");
            $query->execute([
                $username,
                $username,
                $username."@mail.com",
                $password,
                $role
            ]);
           return true;
        }
    }    
    /**
     * deleteUser
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteUser($id)
    {
        if($this->verifyExist($id)){
            $query=$this->pdo->prepare("DELETE FROM users WHERE user_id= :id");
            $query->execute([
                ":user"=>$id,
            ]);
            echo "c bon";
        }
    }    
        
    /**
     * modifyUser
     *
     * @param  mixed $id
     * @param  mixed $info
     * @return void
     */
    public function modifyUser($id,...$info)
    {
        if($this->verifyExist($id)){
            $query=$this->pdo->prepare("UPDATE users SET user_f_name=:user,user_l_name=:user, mail=:mail,password=:password, role=:role WHERE user_id='".$id."'");
            $query->execute([
                ":user"=>$info[0],
                ":mail"=>$info[0]."@mail.com",
                ":password"=>$info[1],
                ":role"=>$info[2]
            ]);
            echo "c bon";
        }else 
            echo "existe pas";
    }        
    /**
     * verifyExist
     *
     * @param  mixed $value
     * @return bool
     */
    protected function verifyExist($value):bool
    {
         if(is_string($value)){   
            $exist=$this->pdo->query("SELECT COUNT(*) as count from users where user_l_name='".$value."'")->fetch();
        }elseif(is_int($value)){
            $exist=$this->pdo->query("SELECT COUNT(*) as count from users where user_id ='".$value."'")->fetch();
        }
        if($exist['count']>0){
            return true;
        }else{
            return false;
        }
    }    
    /**
     * getIdUser
     *
     * @param  mixed $username
     * @return int
     */
    public function getIdUser($username)
    { 
        if(!empty($username)){
            $exist=$this->pdo->query("SELECT user_id from users where user_l_name='".$username."'")->fetch();
            if(empty($exist['user_id'])){
            return null;
            }else{
            return (int)$exist['user_id'];
            }
        }    
   }    
    /**
     * displayUsers
     *
     * @return array
     */
    public function displayUsers():array
    {
        return $this->pdo->query("SELECT * FROM users")->fetchAll();
    }
}