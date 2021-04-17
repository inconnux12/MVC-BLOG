<?php

use Core\Sys\Config;

$id=(int)$post->getIdBySlug($match["params"]['action']);
$res=$post->displayPost($id);
$tittle=$res['title'];
?>
<main class="container mb-5">
    <h1>welcome hello</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title"><?=$res['title']?></h5>
                    <small class="d-block text-muted">publier il y a <?=Config::timeSince(strtotime($res['created_at']))?></small>
                    <a style="color:#ffc107;text-decoration: none;" href="<?=$router->generate('categorie', ['action' => $cat->getSlugById((int)$res['id_cat'])])?>"><?=$cat->getTitleById((int)$res['id_cat'])?></a>
                    <p><?=$res['cont_pub'] ?></p>
                </div>
            </div>
        </div>
    </div>
</main>