<?php include("_config.php");
session_start();
//ROUTING-----
$routes = new Routes();
//echo $route->getCurrentUri();
$viewFile = $routes->getView($routes->getCurrentUri());
//echo $viewFile;
//------------------
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>RufoPHP - PHP Framework</title>
        <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		-->
		<link rel="stylesheet" href="<?php echo SITE_URL ?>css/bootstrap-sandstone.min.css" >

		<link rel="stylesheet" href="<?php echo SITE_URL ?>css/style.css">
		
		<script type="text/javascript">var SITE_URL = "<?php echo SITE_URL;?>"</script>
		<!--JQuery minified -->
		<script src="<?php echo SITE_URL ?>js/jquery-3.1.1.min.js"></script>
		<script src="<?php echo SITE_URL ?>js/jquery-validation-1.15.0.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
    <header>
    	<nav class="navbar navbar-default">
		  	<div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="<?php echo SITE_URL ?>">RufoPHP</a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				    <div id="mymenu"> <!--JS purposes -->
				      <ul class="nav navbar-nav">
				        <li><a class="mylinks active" href="<?php echo SITE_URL ?>home">Home</a></li>
				        <li><a class="mylinks" href="<?php echo SITE_URL ?>contact">Contact</a></li>
				        <li><a class="mylinks" href="<?php echo SITE_URL ?>users">Users</a></li>
				      </ul>
				     </div>
			      <ul class="nav navbar-nav navbar-right">
			      <?php
			    	if (isset($_SESSION['id'])){ ?>
				    	<li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
				          <ul class="dropdown-menu">
				            <li><a href="#">Profile</a></li>
				            <li><a href="#">Another action</a></li>
				            <li><a href="#">Configuration</a></li>
				            <li role="separator" class="divider"></li>
				            <li><a href="<?php echo SITE_URL ?>actions/logout.php">Sign Out</a></li>
				          </ul>
				        </li>
				    <?php
			    	}else{  ?>
			    		<li><a href="<?php echo SITE_URL ?>signin">Sign In</a></li>	
			    	<?php } ?>
			        
			        
			      </ul>
			      <form class="navbar-form navbar-right">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-default">Search</button>
			      </form>
			    </div><!-- /.navbar-collapse -->
		  	</div><!-- /.container-fluid -->
		</nav>
    </header>
    <!--Load views in this div -->
    <div id="main-content"></div>
    <!-- -->
    <footer>
		<div class="panel panel-default">
			<div class="panel-footer">
				&copy; RufoDev.com 2016
			</div>
		</div>
		
	</footer>
		<script type="text/javascript">
		var viewFile = "<?php echo $viewFile ?>";
		$(document).ready(function(){

			$("#main-content").load(SITE_URL+"views/"+viewFile);
			for (i=0;i<$('#mymenu ul li').length;i++){
				var node = document.getElementById("mymenu").getElementsByTagName("li")[i];
				node.setAttribute("class", "");
			}
			var node;
			switch (viewFile){
				case "":
					node = document.getElementById("mymenu").getElementsByTagName("li")[0];
					break;
				case "home.php":
					node = document.getElementById("mymenu").getElementsByTagName("li")[0];
					break;
				case "contact.php":
					node = document.getElementById("mymenu").getElementsByTagName("li")[1];
					break;
				case "users.php":
					node = document.getElementById("mymenu").getElementsByTagName("li")[2];
					break;					
			}
			node.setAttribute("class", "active");
		});

		function signout() {
	      	$.ajax({
	           type: "POST",
	           url: SITE_URL+'actions/logout.php',
	           data:{action:'logout'},
	           success:function(txt) {
	           		alert(txt);
					window.location.reload();
	           }

	      	});
		}
		</script>
	</body>
</html>
