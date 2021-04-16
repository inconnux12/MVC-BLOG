<?php

use App\Sys\Config;

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.82.0">
        <title><?=$tittle ?? 'mon blog'?></title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-fixed/">
        <!-- Bootstrap core CSS -->
        <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">
        
        
        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>
    </head>
    <body>
    <?php if(strcmp($_SERVER['REQUEST_URI'],'/login')!=0 && strcmp($_SERVER['REQUEST_URI'],'/register')!=0):?>    
    <nav class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 text-white">Home</a></li>
        <li><a href="?<?=Config::urlHelper("r",'1')?>" class="nav-link px-2 text-white">Reverse</a></li>
        <?php if(isset($_SESSION['role'])&&$_SESSION['role']=='admin'):?>
        <li><a class="nav-link px-2 text-white" href="<?=$router->generate('adcat',['action'=>'cat'])?>">categorie</a></li>
        <li><a class="nav-link px-2 text-white" href="<?=$router->generate('admin')?>">posts</a></li>
        <?php endif;?>
      </ul>

      <form class="d-inline-block col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="search" name="q" class="form-control form-control-dark" placeholder="Search...">
      </form>

      <div class="text-end">
        <form method="POST" style="display: inline-block;">
          <?php if(!isset($_SESSION['login'])):?>
          <a href="<?=$router->generate('login')?>" class="btn btn-outline-light me-2">Login</a>
          <a href="<?=$router->generate('register')?>" class="btn btn-warning">Sign-up</a>
          <?php elseif ($_SESSION['login']):?>
            <a href="<?=$router->generate('logout')?>" class="btn btn-warning ">Logout</a>
          <?php endif;?>
          <?php if (isset($_SESSION['role'])&& $_SESSION['role']=='admin'):?>
            <a href="<?=$router->generate('admin')?>" class="btn btn-danger ">admin</a>
          <?php endif;?>
        </form>
      </div>
    </div>
  </div>
    </nav>
    <?php endif; ?>
        <?=$containe ?? '' ?>
        <footer class="bg-light py-4 footer" style="position: relative;width:100%;bottom:0;">
            <div class="container">
              <?= round(1000*(microtime(true)-TIME_MS))."ms"?>
            </div>
        </footer>
        <script src="/assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/dist/js/cheatsheet.js"></script>
    </body>
</html>
