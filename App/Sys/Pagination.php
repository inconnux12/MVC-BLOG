<?php 
namespace App\Sys;

class Pagination
{
    public function getNumber($query,$class)
    {
        return ceil((int)$class->getNumber($query)['c']/12);
    }
    public function getPositive($number)
    { 
        return $number;
    }
    public function voidZero($req)
    {
        $text=explode('p=2&',$req);
        if(count($text)<2){
            $text=explode('?p=2',$req);
        }
        return $text[0].($text[1]??"");
    }
    public static function urlHelper($key,$val)
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
    public function prePage()
    {
    
        
    }
    public function nxtPage()
    {
        
    }
}