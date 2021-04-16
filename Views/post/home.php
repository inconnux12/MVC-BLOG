<?php
use App\Sys\{
    Config,
    Pagination
};
$page->voidZero($_SERVER['REQUEST_URI']);
$tittle="HOME";
$q=($_GET['q'] ?? "");
$tri=(int)($_GET['r'] ?? "0");
$pag=($page->getPositive((int)($_GET['p'] ?? 1)));
$max_page=$page->getNumber("SELECT Count(*) AS c FROM publications WHERE title LIKE '".$q."%'",$post);
$posts=$post->displayPosts($pag,$q,$tri);
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
            <?php if($pag >1):?>
            <a href="<?=($pag!=2)? "?".Config::urlHelper("p",$pag-1):$page->voidZero($_SERVER['REQUEST_URI'])?>" class="btn btn-warning bd-highlight">left</a>
            <?php endif;?>
        </div>
        <div class="d-flex col-md-5 ms-auto bd-highlight">
        <?php if($pag<= $max_page): ?>
            <a href="?<?=Config::urlHelper("p",$pag+1)?>" class="ms-auto  bd-highlight btn btn-warning">right</a>
            <?php endif;?>
        </div>
    </div>
</main>