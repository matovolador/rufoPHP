<?php require("_config.php");
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RufoPHP - PHP Framework</title>
        <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		-->
		<link rel="stylesheet" href="<?php echo SITE_URL ?>css/bootstrap-theme.min.css" >

    <link rel="stylesheet" href="<?php echo SITE_URL ?>css/style.css">

		<script type="text/javascript">var SITE_URL = "<?php echo SITE_URL;?>"</script>
		<!--JQuery minified -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="<?php echo SITE_URL ?>js/jquery-validation-1.15.0.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
    <header>
    	<nav class="navbar navbar-inverse">
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
 				      <li><a href="<?php echo SITE_URL ?>actions/logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Sign Out</a></li>

 				    <?php
 			    	}else{  ?>
 			    		<li><a href="<?php echo SITE_URL ?>signin"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Sign In</a></li>
 			    	<?php } ?>


 			      </ul>
			    </div><!-- /.navbar-collapse -->
		  	</div><!-- /.container-fluid -->
		</nav>
    </header>

    <?php
    if (isset($_SESSION['messages']) ){
      echo "<div class='messages ".$_SESSION['messages']['status']."'>".$_SESSION['messages']['message']." </div>";
    }
    ?>
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
		var mainFile = "";
		$(document).ready(function(){

			$("#main-content").load(SITE_URL+"views/"+viewFile);
			pos = viewFile.indexOf("?");
			cleanFile = viewFile.substr(0,pos);
			idPos = viewFile.indexOf("=");
			fileId = viewFile.substr(idPos+1,viewFile.length);
			if (cleanFile == "") cleanFile = viewFile;
			for (i=0;i<$('#mymenu ul li').length;i++){
				var node = document.getElementById("mymenu").getElementsByTagName("li")[i];
				node.setAttribute("class", "");
			}
			var node;
			switch (cleanFile){
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
					<?php if (isset($_SESSION['id'])){
						$sessionId = $_SESSION['id'];
					}else{
						$sessionId = null;
					} ?>
					session = <?php echo json_encode($sessionId) ?>;
					if ( fileId == session){
						node = document.getElementById("mymenu").getElementsByTagName("li")[2];
					}else{
						node=false;
					}

					break;
				default :
					node = false;
					break;
			}
			if (!node==false)
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

<?php

unset($_SESSION['messages']);

?>
