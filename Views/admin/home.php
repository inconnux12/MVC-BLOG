<?php

use Core\Sys\Config;

$q=($_GET['q'] ?? "");
$tri=(int)($_GET['r'] ?? "0");
if(!isset($match['params']['action'])){
        $page->getMaxPages("SELECT Count(*) AS c FROM publications WHERE title LIKE '".$q."%'",$post);
        $posts=$post->displayPosts($page->getOffset(),$q,$tri);
    }elseif($match['params']['action']=='cat'){
        $page->getMaxPages("SELECT Count(*) AS c FROM categorie WHERE title LIKE '".$q."%'",$cat);
        $posts=$cat->displayCats($page->getOffset(),$tri);
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
</main>