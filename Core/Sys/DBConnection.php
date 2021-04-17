<?php
namespace Core\Sys;

use PDO;
use PDOException;

class DBConnection
{
    protected $DBservername="localhost";
    protected $DBusername="root";
    protected $DBpassword="";
    protected $DBfetch_mod=PDO::FETCH_ASSOC;
    public $DBname="blog";
    public $pdo;
    private static $_instance;

    public static function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance=new DBConnection();
        }
        return self::$_instance;
    }
    public function __construct()
    {
        if(!isset($this->pdo)){    
            return $this->createConnection();
        }
    }
    protected function createConnection()
    {
        try{
            $this->pdo=new PDO("mysql:host=$this->DBservername;dbname=$this->DBname",$this->DBusername,$this->DBpassword,[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => $this->DBfetch_mod
            ]);
        }catch(PDOException $e){
            $this->exceptionError($e);
        }
    }
    protected function exceptionError($e)
    {
        echo "connection fail :".$e;
    }
}