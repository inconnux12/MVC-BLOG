<?php
namespace App\Categorie;

use App\Sys\DBConnection;

class Categorie extends DBConnection
{
    public function deleteCategorie($id,$post)
    {
        if($this->verifyExist($id)){
            $query=$this->pdo->prepare("DELETE FROM categorie WHERE id_cat= :id");
            $query->execute([
                ":id"=>$id,
            ]);
            $post->deletePostByCat($id);
            echo "c bon";
        }
    }
    public function addCategorie(...$items)
    {
        if($this->verifyExist($items[0])){
            return false;
        }
        else{
            $query=$this->pdo->prepare("INSERT INTO categorie (title,slug) VALUES (:title,:slug)");
            $query->execute([
                ":title"=>$items[0],
                ":slug"=>$items[1],
            ]);
           return true;
        }
    }
    protected function verifyExist($value):bool
    {
        if(is_string($value))   
           $exist=$this->pdo->query("SELECT COUNT(*) as count from categorie where title='".$value."'")->fetch();
       elseif(is_int($value))
           $exist=$this->pdo->query("SELECT COUNT(*) as count from categorie where id_cat ='".$value."'")->fetch();
       if($exist['count']>0){
           return true;
       }
       else{
           return false;
       }
   }    
    public function modifyCategorie($id,...$info)
    {    
        $query=$this->pdo->prepare("UPDATE categorie SET title=:title,slug=:slug WHERE id_cat='".$id."'");
        $query->execute([
            ":title"=>$info[0],
            ":slug"=>$info[1],
        ]);
        echo"cbon";
    }
    public function getTitleById($id)
    {
        $exist=$this->pdo->query("SELECT title from categorie where id_cat='".$id."'")->fetch();
       if(empty($exist['title'])){
           return "";
       }else{
           return $exist['title'];
       }
   
    }
    public function getSlugById($id)
    {
        $exist=$this->pdo->query("SELECT slug from categorie where id_cat='".$id."'")->fetch();
       if(empty($exist['slug'])){
           return "";
       }else{
           return $exist['slug'];
       }
   
    }
    public function getIdBySlug($slug)
    {
        $exist=$this->pdo->query("SELECT id_cat from categorie where slug='".$slug."'")->fetch();
       if(empty($exist['id_cat'])){
           return "";
       }else{
           return (int)$exist['id_cat'];
       }
   
    }
    
    /**
     * displayCats
     *
     * @param  mixed $i
     * @param  mixed $tri
     * @return array
     */
    public function displayCats($i=null,$tri=null):array
    {
        if(isset($i))
            $i-=1;
        $tri? $t="": $t="DESC";
        return $this->pdo->query("SELECT * FROM categorie ORDER BY id_cat ".$t." LIMIT 12 OFFSET ". 12*$i)->fetchAll();
    }    
    /**
     * displayCat
     *
     * @param  mixed $id
     * @return array
     */
    public function displayCat($id):array{
        return $this->pdo->query("SELECT * FROM categorie WHERE id_cat='".$id."'")->fetch();
    }
/******************************************************************************************** */    
    public function numberCats():array
    {
        return $this->pdo->query("SELECT COUNT(*) as c FROM categorie")->fetch();
    }
    public function getNumber($query)
    {
        return $this->pdo->query($query)->fetch();
    }
    
}