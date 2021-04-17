<?php
namespace App\Controller;

use App\Categorie\Categorie;
use App\Post\Post;
use Core\Sys\Pagination;
use Core\Controller\Controller;
use Core\Sys\Config;

class AdminController extends Controller
{
    public $page;
    public $post;
    public $cat;
    public function __construct($router)
    {
        parent::__construct();
        $this->router=$router; 
        $this->page=Pagination::getInstance();
        $this->post=Post::getInstance();
        $this->cat=Categorie::getInstance();
    }
    public function home()
    { 
        $q=($_GET['q'] ?? "");
        $tri=(int)($_GET['r'] ?? "0");
        $cat=$this->cat;
        $router=$this->router;
        $tittle="ADMIN HOME";
        $page=$this->page;
        if(!isset($this->router->match()['params']['action'])){
                $this->page->getMaxPages("SELECT Count(*) AS c FROM publications WHERE title LIKE '".$q."%'",$this->post);
                $posts=$this->post->displayPosts($this->page->getOffset(),$q,$tri);
            }elseif($this->router->match()['params']['action']=='cat'){
                $this->page->getMaxPages("SELECT Count(*) AS c FROM categorie WHERE title LIKE '".$q."%'",$cat);
                $posts=$this->cat->displayCats($this->page->getOffset(),$tri);
            }
        
        $this->render('admin/home',compact("posts","cat","router","tittle","page"));

    }
    public function add()
    {
        $cat=$this->cat;
        $router=$this->router;
        $tittle="ADMIN HOME";
        $page=$this->page;
        $res=[];
        $ptype=$this->router->match()['params']['action'];
        if(isset($_POST['sub'])){
            if($ptype=='cat'){
                $res=$cat->addCategorie($_POST['title'],Config::slugify($_POST['title']));
                if($res){
                    header('location: /admin/cat');
                }else{
                    echo "error";
                }
            }else{
                $res=$this->post->addPost($_POST['title'],$_POST['desc'],$_POST['cont'],Config::slugify($_POST['title']),(int)$_POST['cat']);
                if($res){
                    header('location: /admin');
                }else{
                    echo "error";
                }
            }
        }
        $this->render('admin/add',compact("res","ptype","cat","router","tittle"));
    }
    public function edit()
    {
        $cat=$this->cat;
        $router=$this->router;
        $tittle="ADMIN HOME";
        $page=$this->page;
        $res=[];
        $slug=$this->router->match()['params']['action'];
        $ptype="";
        if(empty($this->post->getIdBySlug($slug))){
            $ptype="cat";
            $id=$cat->getIdBySlug($slug);
            $res=$cat->displayCat($id);
        }else{
            $ptype="pub";
            $id=$this->post->getIdBySlug($slug);
            $res=$this->post->displayPost($id);
            $cats=$cat->displayCats();
        }
        if(isset($_POST['sub'])){
            if($ptype=='pub'){
                $this->post->modifyPost($id,$_POST['title'],$_POST['desc'],$_POST['cont'],Config::slugify($_POST['title']),(int)$_POST['cat']);
                header('location: /admin');
            }else{
                $cat->modifyCategorie($id,$_POST['title'],Config::slugify($_POST['title']));
                header('location: /admin/cat');
            }
        }else{

        }
        $this->render('admin/edit',compact("cats","res","ptype","cat","router","tittle"));
    }
    public function delete()
    {
        $slug=$this->router->match()['params']['action'];
        if(empty($this->post->getIdBySlug($slug))){
            $id=$this->cat->getIdBySlug($slug);
            $this->cat->deleteCategorie($id,$this->post);
            header('location: /admin/cat');
        }else{
            $id=$this->post->getIdBySlug($slug);
            $this->post->deletePost($id);
            header('Location: /admin');
        }
    }
}