<?php 
namespace Core\Sys;

class Pagination
{       
    /**
     * maxPages
     *
     * @var int
     */
    private $maxPages;    
    /**
     * currentPage
     *
     * @var int
     */
    private $currentPage;    
    /**
     * _instance
     *
     * @var mixed
     */
    private static $_instance;

    public static function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance=new Pagination();
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
        $this->currentPage=(int)($_GET['p'] ?? 1);
    }    
    /**
     * getOffset
     *
     * @return void
     */
    public function getOffset()
    {
        return $this->currentPage;
    } 
        
    /**
     * getMaxPages
     *
     * @param  mixed $query
     * @param  mixed $class
     * @return void
     */
    public function getMaxPages($query,$class)
    {
        $this->maxPages=ceil((int)$class->getNumber($query)['c']/12);
    }    
    /**
     * getPositive
     *
     * @param  mixed $number
     * @return void
     */
    public function getPositive($number)
    { 
        return $number;
    }    
    /**
     * voidZero
     *
     * @param  mixed $req
     * @return void
     */
    public function voidZero($req)
    {
        $text=explode('p=2&',$req);
        if(count($text)<2){
            $text=explode('?p=2',$req);
        }
        return $text[0].($text[1]??"");
    }    
    /**
     * urlReseter
     *
     * @param  mixed $key
     * @param  mixed $val
     * @return void
     */
    public static function urlReseter($key,$val)
    {
        unset($_GET['p']);
        if(isset($_GET['url']))
            unset($_GET['url']);
        if($key=='p'){
            return http_build_query(array_merge(array($key=>$val),$_GET));    
        }else{
            return http_build_query(array_merge($_GET,[$key=>$val]));
        }
    }    
    /**
     * prePage
     *
     * @param  mixed $curent
     * @return void
     */
    public function prePage()
    {
        if($this->currentPage >1){
            echo "<a href=";echo ($this->currentPage!=2)? "?".self::urlReseter("p",$this->currentPage-1):$this->voidZero($_SERVER['REQUEST_URI']);echo " class=\"btn btn-warning bd-highlight\">left</a>";
        }
        
    }    
    /**
     * nxtPage
     *
     * @param  mixed $curent
     * @param  mixed $max
     * @return void
     */
    public function nxtPage()
    {
        if($this->currentPage< $this->maxPages){
            echo "<a href=?";echo self::urlReseter("p",$this->currentPage+1);echo " class=\"btn btn-warning ms-auto bd-highlight\">right</a>";
        }
    }
}