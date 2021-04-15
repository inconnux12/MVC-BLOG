<?php

use App\Sys\Config;

$slug=$match['params']['action'];
if(empty($post->getIdBySlug($slug))){
    $ptype="cat";
    $id=$cat->getIdBySlug($slug);
    $res=$cat->displayCat($id);
}else{
    $ptype="pub";
    $id=$post->getIdBySlug($slug);
    $res=$post->displayPost($id);
    $cats=$cat->displayCats();
}
if(isset($_POST['sub'])){
    if($ptype=='pub'){
        $post->modifyPost($id,$_POST['title'],$_POST['desc'],$_POST['cont'],Config::slugify($_POST['title']),(int)$_POST['cat']);
        header('location: /admin');
    }else{
        $cat->modifyCategorie($id,$_POST['title'],Config::slugify($_POST['title']));
        header('location: /admin?t=cat');
    }
}else{

}
?>
<div class="body container mt-4">
  <main class="form-signin d-flex">
    <form class="col-md-8 m-auto" method="POST">
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" name="title" value="<?=$res['title']?>">
        <label for="floatingInput">title <?=($ptype=='cat' ? 'categorie':'posts')?></label>
      </div>
      <?php if($ptype!='cat'):?>
      <div class="form-floating">
        <textarea type="text" class="form-control" name="desc" id="floatingInput"><?=$res['desc_pub']?></textarea>
        <label for="floatingInput">description posts</label>
      </div>
      <div class="form-floating">
      <textarea type="text" class="form-control" name="cont" id="floatingInput"><?=$res['cont_pub']?></textarea>
        <label for="floatingInput">contain posts</label>
      </div>
      <select class="form-select" aria-label="Default select example " name="cat">
      <?php foreach($cats as $c):?>
        <option value="<?=$c['id_cat']?>"><?=$c['title']?></option>
      <?php endforeach;?>
      </select>
      <?php endif;?>
      <div class="mt-4">
        <button class="w-100 btn btn-lg btn-primary" name="sub" type="submit">Submit</button>
      </div>
    </form>
  </main>
</div>  