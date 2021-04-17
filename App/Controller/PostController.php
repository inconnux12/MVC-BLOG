<?php 
namespace App\Controller;

use App\Categorie\Categorie;
use App\Post\Post;
use Core\Sys\Pagination;
use Core\Controller\Controller;

class PostController extends Controller
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
        $this->page->getMaxPages("SELECT Count(*) AS c FROM publications WHERE title LIKE '".$q."%'",$this->post);
        $tittle="HOME";
        $posts=$this->post->displayPosts($this->page->getOffset(),$q,$tri);
        $router=$this->router;
        $cat=$this->cat;
        $page=$this->page;
       
        
        $this->render('post/home',compact("posts","cat","router","tittle","page"));

    }
    public function categorie()
    {
        $router=$this->router;
        $cat=$this->cat;
        $id=(int)$this->cat->getIdBySlug($this->router->match()["params"]['action']);
        $tittle="categorie ".$this->cat->getTitleById($id);
        $q=($_GET['q'] ?? "");
        $tri=(int)($_GET['r'] ?? "0");
        $posts=$this->post->displayPostsByCats($id,$q,$this->page->getOffset(),$tri);
        $this->page->getMaxPages("SELECT Count(*) AS c FROM publications WHERE id_cat='".$id."' AND title LIKE '".$q."%'",$this->post);
        $this->render('categorie/categorie',compact("posts","cat","router","tittle"));
    }
    public function post()
    {
        $router=$this->router;
        $cat=$this->cat;
        $id=(int)$this->post->getIdBySlug($this->router->match()["params"]['action']);
        $res=$this->post->displayPost($id);
        $tittle=$res['title'];
        $this->render('post/post',compact("res","cat","router","tittle"));
    }
}