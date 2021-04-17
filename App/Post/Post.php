<?php 
namespace App\Post;

use Core\Sys\DBConnection;

class Post extends DBConnection
{
    protected $id;
    protected $title;
    protected $description;
    protected $slug;
    protected $contain;
    protected $created_at;
    protected $categorie;
    private static $_instance;

    public static function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance=new Post();
        }
        return self::$_instance;
    }
    public function __construct(){
        parent::__construct();
    }
    public function addPost(...$items){
        if($this->verifyExist($items[0])){
            return false;
        }
        else{
            //  dd($items);
            $query=$this->pdo->prepare("INSERT INTO publications (title,desc_pub,cont_pub,slug,id_cat) VALUES (:title,:desc,:cont,:slug,:cat)");
            $query->execute([
                ":title"=>$items[0],
                ":desc"=>$items[1],
                ":cont"=>$items[2],
                ":slug"=>$items[3],
                ":cat"=>$items[4],
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
    public function deletePost($id)
    {
        if($this->verifyExist($id)){
            $query=$this->pdo->prepare("DELETE FROM publications WHERE id_pub= :id");
            $query->execute([
                ":id"=>$id,
            ]);
            echo "c bon";
        }
    }    
    public function deletePostByCat($id)
    {
        $query=$this->pdo->prepare("DELETE FROM publications WHERE id_cat= :id");
        $query->execute([
            ":id"=>$id,
        ]);
        echo "c bon";
    }
    /**
     * modifyUser
     *
     * @param  mixed $id
     * @param  mixed $info
     * @return void
     */
    public function modifyPost($id,...$info){    
        $query=$this->pdo->prepare("UPDATE publications SET title=:title,desc_pub=:desc, cont_pub=:cont,slug=:slug, id_cat=:cat WHERE id_pub='".$id."'");
        $query->execute([
            ":title"=>$info[0],
            ":desc"=>$info[1],
            ":cont"=>$info[2],
            ":slug"=>$info[3],
            ":cat"=>$info[4]
        ]);
        echo"cbon";
}        
    /**
     * verifyExist
     *
     * @param  mixed $value
     * @return bool
     */
    protected function verifyExist($value):bool{
         if(is_string($value))   
            $exist=$this->pdo->query("SELECT COUNT(*) as count from publications where title='".$value."'")->fetch();
        elseif(is_int($value))
            $exist=$this->pdo->query("SELECT COUNT(*) as count from publications where id_pub ='".$value."'")->fetch();
        if($exist['count']>0){
            return true;
        }
        else{
            return false;
        }
    }    
    /**
     * getIdUser
     *
     * @param  mixed $username
     * @return int
     */
    protected function getIdPost($slug):int{ 
        $exist=$this->pdo->query("SELECT id_pub from publications where user_l_name='".$slug."'")->fetch();
       if(empty($exist['id_pub'])){
           return null;
       }
       else{
           return (int)$exist['id_pub'];
       }
   }    
    /**
     * displayUsers
     *
     * @return array
     */    
    /**
     * displayPosts
     *
     * @param  mixed $i
     * @param  mixed $q
     * @param  mixed $tri
     * @return array
     */
    public function displayPosts($i,$q,$tri):array
    {
        if(isset($i))
            $i-=1;
        $tri? $t="": $t="DESC";
        return $this->pdo->query("SELECT * FROM publications WHERE title LIKE '".$q."%' ORDER BY id_pub ".$t." LIMIT 12 OFFSET ". 12*$i)->fetchAll();
    }
    /**
     * displayPostsByCats
     *
     * @param  mixed $id
     * @param  mixed $q
     * @param  mixed $i
     * @param  mixed $tri
     * @return array
     */
    public function displayPostsByCats($id,$q,$i,$tri):array
    {
        if(isset($i))
            $i-=1;
        $tri? $t="": $t="DESC";
        return $this->pdo->query("SELECT * FROM publications WHERE id_cat='".$id."' AND title LIKE '".$q."%' ORDER BY id_pub ".$t." LIMIT 12 OFFSET ". 12*$i)->fetchAll();
    }    
    /**
     * displayPost
     *
     * @param  mixed $id
     * @return void
     */
    public function displayPost($id){
        return $this->pdo->query("SELECT * FROM publications WHERE id_pub='".$id."'")->fetch();
    }    
    /**
     * getIdBySlug
     *
     * @param  mixed $slug
     * @return void
     */
    public function getIdBySlug($slug)
    {
        $exist=$this->pdo->query("SELECT id_pub from publications where slug='".$slug."'")->fetch();
       if(empty($exist['id_pub'])){
           return "";
       }else{
           return (int)$exist['id_pub'];
       }
   
    }

/************************************************************************************************************************ */
    public function numberPosts($q):array{
        return $this->pdo->query("SELECT COUNT(*) as c FROM publications where title LIKE '".$q."%'")->fetch();
    } 
    
    public function getNumber($query)
    {
        return $this->pdo->query($query)->fetch();
    }
}

