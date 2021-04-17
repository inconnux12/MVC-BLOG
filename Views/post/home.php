<?php
use App\Sys\{
    Config,
    Pagination
};

$tittle="HOME";
$q=($_GET['q'] ?? "");
$tri=(int)($_GET['r'] ?? "0");
$page->getMaxPages("SELECT Count(*) AS c FROM publications WHERE title LIKE '".$q."%'",$post);
$posts=$post->displayPosts($page->getOffset(),$q,$tri);

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
</main>