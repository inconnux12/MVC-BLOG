<?php

use Core\Sys\Config;


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
</main>