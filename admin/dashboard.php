<?php require("../_config.php");

session_start();
//TESTING:
$_SESSION['admin'] = true;
$_SESSION['breadcrumb'] = ["Home","Dashboard"];

if (!isset($_SESSION['admin'])){
  //Render login
  include("login.php");
}else{
  //RENDER DASHBOARD:
  ?>
  <div class="dashboard-items">
    <ul class="breadcrumb">
      <?php
      for ($i=0;$i<count($_SESSION['breadcrumb']);$i++){
        if ($i==count($_SESSION['breadcrumb'])-1){
          echo "<li class='active'>".$_SESSION['breadcrumb'][$i]."</li>";
        }else{
          echo "<li><a href='#'>".$_SESSION['breadcrumb'][$i]."</a></li>";
        }


      } ?>
    </ul>
  </div>
  <div class="panel-body">
    <h4>Dashboard</h4>
  </div>


<?php
}
