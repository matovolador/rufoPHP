<?php include ("../../../_config.php"); 
$users = new Users();
$res = $users->getUsers();
?>
<div class="panel-body">
	<h1>Users</h1>
	<ul>
		<?php
		while($row = mysql_fetch_assoc($res)){
			echo "<li>Name :". $row["name"] . " - Email: " . $row["email"] ."</li>";
		}
		?>
	</ul>
	<a href="<?php echo SITE_URL ?>users/edit">Edit</a>
</div>