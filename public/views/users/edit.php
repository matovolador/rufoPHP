<?php include ("../../../_config.php"); 
$user = new Users();
$res = $user->getUserById($_GET['id']);
?>
<div class="panel-body">
	<h1>Users</h1>
	<h3>Edit</h3>
	<p>ID: <?php echo $_GET['id'] ?></p>
	<?php
	if($row = $res->fetch_assoc()){
		echo "<p>Name :". $row["name"] . " - Email: " . $row["email"] ."</p>";
	}else{
		echo "<p>User by id=".$_GET['id']."not found</p>";
	}
	?>
	
</div>