<div class="panel-body">
<div class="row">
  <div class="col-sm-0 col-md-4"></div>
  <div class="col-sm-12 col-md-4 text-center">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Create Superuser
      </div>
      <div class="panel-body">
        <form class="" id="form-1" action="<?php echo SITE_URL?>actions/admin/create_superuser.php" method="post">
          <div class="form-group">
            <label for="username">Username: </label>
            <input class="form-control" type="text" name="username" required />
          </div>
          <div class="form-group">
            <label for="username">Email: </label>
            <input class="form-control" type="email" name="email" required />
          </div>
          <div class="form-group">
            <label for="password">Password: </label>
            <input class="form-control" type="password" name="password" required />
          </div>
          <div class="form-group">
            <label for="password">Repeat Password: </label>
            <input class="form-control" type="password" name="password_repeat" required />
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
  $("#form-1").validate();
})
</script>
