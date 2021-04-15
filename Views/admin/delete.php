<?php 
$slug=$match['params']['action'];
if(empty($post->getIdBySlug($slug))){
    $id=$cat->getIdBySlug($slug);
    $cat->deleteCategorie($id,$post);
    header('location: /admin?t=cat');
}else{
    $id=$post->getIdBySlug($slug);
    $post->deletePost($id);
    header('Location: /admin');
}
