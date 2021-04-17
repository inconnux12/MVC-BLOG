<main class="container mt-4 p-4" >
<a href="<?=$router->generate('add', ['action' =>($match['params']['action'])??'pub'])?>" class="btn btn-primary ">add</a>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">title</th>
        <?php if(!isset($router->match()['params']['action'])):?>
        <th scope="col">Description</th>
        <?php endif;?>
        <th class="text-center" scope="col">Options</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($posts as $res):?>
        <tr>
            <th scope="row"><?=$res['title']?></th>
            <?php if(!isset($router->match()['params']['action'])):?>
            <td><?=substr($res['desc_pub'],0,50)?></td>
            <?php endif;?>
            <td class="d-flex  justify-content-evenly"><a href="<?=$router->generate('edit', ['action' =>$res['slug']])?>" class="btn btn-warning ">edit</a><a href="<?=$router->generate('delete', ['action' =>$res['slug']])?>" class="btn btn-danger">delete</a></td>
        </tr>
        <?php endforeach;?>
    </tbody>
  </table>
</main>