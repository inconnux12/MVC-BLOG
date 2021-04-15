<?php

use App\Sys\Config;

if(!isset($_GET['t'])){
        $page=(int)($_GET['p'] ?? 0);
        $q=($_GET['q'] ?? "");
        $tri=(int)($_GET['r'] ?? "0");
        $numPost=$post->numberPosts($q);
        $max_page=floor((int)$numPost['c']/12);
        $posts=$post->displayPosts($page,$q,$tri);
        
        

    }elseif($_GET['t']=='cat'){
        $page=(int)($_GET['p'] ?? 0);
        $q=($_GET['q'] ?? "");
        $tri=(int)($_GET['r'] ?? "0");
        $numCat=$cat->numberCats();
        $max_page=floor((int)$numCat['c']/12);
        $posts=$cat->displayCats($page,$tri);
    }else{

    }
?>
<main class="container mt-4 p-4" >
<a href="<?=$router->generate('add', ['action' =>($_GET['t'])??'pub'])?>" class="btn btn-primary ">add</a>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">title</th>
        <?php if(!isset($_GET['t'])):?>
        <th scope="col">Description</th>
        <?php endif;?>
        <th class="text-center" scope="col">Options</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($posts as $res):?>
        <tr>
            <th scope="row"><?=$res['title']?></th>
            <?php if(!isset($_GET['t'])):?>
            <td><?=substr($res['desc_pub'],0,50)?></td>
            <?php endif;?>
            <td class="d-flex  justify-content-evenly"><a href="<?=$router->generate('edit', ['action' =>$res['slug']])?>" class="btn btn-warning ">edit</a><a href="<?=$router->generate('delete', ['action' =>$res['slug']])?>" class="btn btn-danger">delete</a></td>
        </tr>
        <?php endforeach;?>
    </tbody>
  </table>
  <div class="row d-flex bd-highlight mt-4">
        <div class="col-md-5">
            <?php if($page >1): ?>
            <a href="?<?=Config::urlHelper("p",$page-1)?>" class="btn btn-warning bd-highlight">left</a>
            <?php endif;?>
        </div>
        <div class="d-flex col-md-5 ms-auto bd-highlight">
        <?php if($page< $max_page): ?>
            <a href="?<?=Config::urlHelper("p",$page+1)?>" class="ms-auto  bd-highlight btn btn-warning">right</a>
            <?php endif;?>
        </div>
    </div>
</main>