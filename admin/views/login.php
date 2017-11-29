<?php
$admin = new Admin();
if (isset($_SESSION['admin'])){
  echo "<div class='panel-body'>You are already signed in.</div>";
}else{

  if (!$admin->superuser_exists()){
    $_SESSION['messages'] = ['status'=> "error","message"=>"You must first create a superuser."];
    //RENDER 'create_superuser.php':
    include("create_superuser.php");

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
        <form class="my-form" id="form" action="<?php echo SITE_URL?>actions/admin/login.php" method="post">
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
<script type="text/javascript">
$(document).ready(function(){
  $("#form").validate();
});

</script>

<?php
  }
}
?>
