<link href="assets/dist/css/signin.css" type="text/css" rel="stylesheet">
<div class="body">
  <main class="form-signin">
    <?php if(isset($_SESSION['error'])&&$_SESSION['error']):
    ?>
    <div class="alert alert-danger" role="alert">
      Wrong username or password
    </div>
    <?php endif;?>
      <form method="POST">
        <img class="mb-4" src="assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Username">
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" name="submit" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
      </form>
  </main>
</div>
<?php if( isset($_SESSION['error'])):$_SESSION['error']=false;unset($_SESSION['error']);endif;?>  