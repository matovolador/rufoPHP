<?php require("../_config.php");
session_start();
if (isset($_SESSION['admin'])){
  echo "<div class='panel-body'>You are already signed in.</div>";
}else{
//RENDER LOGIN PAGE:
?>


<div class="panel-body">
<div class="row">
  <div class="col-sm-0 col-md-4"></div>
  <div class="col-sm-12 col-md-4 text-center">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Login
      </div>
      <div class="panel-body">
        <form class="" action="<?php echo SITE_URL?>actions/admin/login.php" method="post">
          <div class="form-group">
            <label for="username">Username: </label>
            <input class="form-control" type="text" name="username" required />
          </div>
          <div class="form-group">
            <label for="password">Password: </label>
            <input class="form-control" type="password" name="password" required />
          </div>
          <input class="btn btn-primary" type="submit" value="Submit" />
        </form>

      </div>
    </div>
  </div>
  <div class="col-sm-0 col-md-4"></div>
</div>
</div>
<?php
} ?>
