<?php

use App\Sys\Config;

$pag=($page->getPositive((int)($_GET['p'] ?? 1)));
$q=($_GET['q'] ?? "");
$tri=(int)($_GET['r'] ?? "0");
if(!isset($match['params']['action'])){
        $max_page=$page->getNumber("SELECT Count(*) AS c FROM publications WHERE title LIKE '".$q."%'",$post);
        $posts=$post->displayPosts($pag,$q,$tri);
    }elseif($match['params']['action']=='cat'){
        $max_page=$page->getNumber("SELECT Count(*) AS c FROM categorie WHERE title LIKE '".$q."%'",$cat);
        $posts=$cat->displayCats($pag,$tri);
    }else{

    }
?>
<main class="container mt-4 p-4" >
<a href="<?=$router->generate('add', ['action' =>($match['params']['action'])??'pub'])?>" class="btn btn-primary ">add</a>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">title</th>
        <?php if(!isset($match['params']['action'])):?>
        <th scope="col">Description</th>
        <?php endif;?>
        <th class="text-center" scope="col">Options</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($posts as $res):?>
        <tr>
            <th scope="row"><?=$res['title']?></th>
            <?php if(!isset($match['params']['action'])):?>
            <td><?=substr($res['desc_pub'],0,50)?></td>
            <?php endif;?>
            <td class="d-flex  justify-content-evenly"><a href="<?=$router->generate('edit', ['action' =>$res['slug']])?>" class="btn btn-warning ">edit</a><a href="<?=$router->generate('delete', ['action' =>$res['slug']])?>" class="btn btn-danger">delete</a></td>
        </tr>
        <?php endforeach;?>
    </tbody>
  </table>
  <div class="row d-flex bd-highlight mt-4">
        <div class="col-md-5">
            <?php if($pag >1):?>
            <a href="<?=($pag!=2)? "?".Config::urlHelper("p",$pag-1):$page->voidZero($_SERVER['REQUEST_URI'])?>" class="btn btn-warning bd-highlight">left</a>
            <?php endif;?>
        </div>
        <div class="d-flex col-md-5 ms-auto bd-highlight">
        <?php if($pag< $max_page): ?>
            <a href="?<?=Config::urlHelper("p",$pag+1)?>" class="ms-auto  bd-highlight btn btn-warning">right</a>
            <?php endif;?>
        </div>
    </div>
</main>