<?php
namespace Core\Sys;

class Config
{        
    /**
     * dir
     *
     * @var mixed
     */
    public static $dir;    
    /**
     * View
     *
     * @var mixed
     */
    public static $View;   
    /**
     * View_layout
     *
     * @var mixed
     */
    public static $View_layout;    
    /**
     * View_admin
     *
     * @var mixed
     */
    public static $View_admin;    
    /**
     * View_post
     *
     * @var mixed
     */
    public static $View_post;    
    /**
     * View_categorie
     *
     * @var mixed
     */
    public static $View_categorie;
    /**
     * @var string contain the host name
     */    
    /**
     * host
     *
     * @var mixed
     */
    public static $host;   
    private static $_instance;

    public static function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance=new Config();
        }
        return self::$_instance;
    } 
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        self::$dir=dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR;
        self::$View=self::$dir."Views".DIRECTORY_SEPARATOR;
        self::$View_admin=self::$View."admin".DIRECTORY_SEPARATOR;
        self::$View_post=self::$View."post".DIRECTORY_SEPARATOR;
        self::$View_layout=self::$View."layout".DIRECTORY_SEPARATOR;
        self::$View_categorie=self::$View."categorie".DIRECTORY_SEPARATOR;
        self::$host='https://'.$_SERVER['HTTP_HOST'].'/public/';
    }   
            
    /**
     * getPath
     *
     * @return String the path
     */
    public static function getPath()
    {
        echo self::$dir."\n".self::$host;
    }    
    /**
     * slugify
     *
     * @param  mixed $text
     * @return void
     */
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
    public static function urlHelper($key,$val)
    {
        unset($_GET['p']);
        if(isset($_GET['url']))
            unset($_GET['url']);
        if($key=='p'){
            return http_build_query(array_merge(array($key=>$val),$_GET));    
        }else{
            if($key=='r' && $val=='0'){
                $t=explode("&r=1",$_SERVER['REQUEST_URI']);
                return count($t)==2?$t[0].$t[1]:explode("?r=1",$_SERVER['REQUEST_URI'])[0].explode("?r=1",$_SERVER['REQUEST_URI'])[1]; 
            }
            return http_build_query(array_merge($_GET,[$key=>$val]));
        }
    }
    public static function timeSince($since) 
    {
        $since=time()-$since;
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'année'),
            array(60 * 60 * 24 * 30 , 'mois'),
            array(60 * 60 * 24 * 7, 'semaine'),
            array(60 * 60 * 24 , 'jour'),
            array(60 * 60 , 'heure'),
            array(60 , 'minute'),
            array(1 , 'seconde')
        );
    
        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }
    
        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }
    
}