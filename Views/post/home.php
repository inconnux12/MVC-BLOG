<?php
use App\Sys\Config;

$tittle="HOME";
$page=(int)($_GET['p'] ?? 0);
$q=($_GET['q'] ?? "");
$tri=(int)($_GET['r'] ?? "0");
$numPost=$post->numberPosts($q);
$max_page=floor((int)$numPost['c']/12);
$posts=$post->displayPosts($page,$q,$tri);
/* dd($tri);
exit; */
?>
<main class="container mb-5">
    <h1>welcome hello</h1>
    <div class="row">
    <?php foreach($posts as $res):?>
        <div class="col-md-3">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title"><?=$res['title']?></h5>
                    <a style="color:#ffc107;text-decoration: none;" href="<?=$router->generate('categorie', ['action' => $cat->getSlugById((int)$res['id_cat'])])?>"><?=$cat->getTitleById((int)$res['id_cat'])?></a>
                    <small class="d-block text-muted">publier il y a <?=Config::timeSince(strtotime($res['created_at']))?></small>
                    <p><?=substr($res['cont_pub'],0,100)."..."?></p>
                    <p><a href="<?=$router->generate('post', ['action' =>$res['slug']])?>" class="btn btn-warning">more</a></p>
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