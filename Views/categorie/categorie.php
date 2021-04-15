<?php

use App\Sys\Config;

$id=(int)$cat->getIdBySlug($match["params"]['action']);
$tittle="categorie ".$cat->getTitleById($id);
$page=(int)($_GET['p'] ?? 0);
$q=($_GET['q'] ?? "");
$tri=(int)($_GET['r'] ?? "0");
$posts=$post->displayPostsByCats($id,$q,$page,$tri);
$max_page=floor(count($posts)/12);
?>
<main class="container mb-5">
    <h1><?=$tittle?></h1>
    <div class="row">
    <?php foreach($posts as $res):?>
        <div class="col-md-3">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title"><?=$res['title']?></h5>
                    <small class="d-block text-muted">publier il y a <?=Config::timeSince(strtotime($res['created_at']))?></small>
                    <p><?=substr($res['cont_pub'],0,100)."..."?></p>
                    <p><a href="/post/<?=$res['slug']?>" class="btn btn-warning">more</a></p>
                </div>
            </div>
        </div>
    <?php endforeach;?>
    </div>
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