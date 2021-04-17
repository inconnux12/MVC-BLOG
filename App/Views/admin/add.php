<div class="body container mt-4">
  <main class="form-signin d-flex">
    <form class="col-md-8 m-auto" method="POST">
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" name="title">
        <label for="floatingInput">title <?=($ptype=='cat' ? 'categorie':'posts')?></label>
      </div>
      <?php if($ptype!='cat'):?>
      <div class="form-floating">
        <textarea type="text" class="form-control" name="desc" id="floatingInput"></textarea>
        <label for="floatingInput">description posts</label>
      </div>
      <div class="form-floating">
      <textarea type="text" class="form-control" name="cont" id="floatingInput"></textarea>
        <label for="floatingInput">contain posts</label>
      </div>
      <select class="form-select" aria-label="Default select example " name="cat">
      <?php foreach($cat->displayCats(null,null) as $c):?>
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