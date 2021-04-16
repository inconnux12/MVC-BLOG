<?php 
namespace App\Sys;

class Pagination
{
    public function getNumber($query,$class)
    {
        return ceil((int)$class->getNumber($query)['c']/12);
    }
    public function getPositive($number)
    { return $number;
      /*   if($number==1){
            header('location: '.explode('?',$_SERVER['REQUEST_URI'])[0]);
        }else{
           
        } */
    }
    public function voidZero($req)
    {
        $text=explode('p=2',$req);
        return $text[0].($text[1]??"");
    }
}