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
}