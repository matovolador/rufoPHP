<?php require("../_config.php");
$users = new User();
if (!isset($_GET['id'])){
	$res = $users->getAll("users");
}else{
	$res = $users->get("users",$_GET['id']);
}

?>
<div class="panel-body">
	<h1>Users</h1>
	<?php
	if (!isset($_GET['id'])){ ?>
	<ul>
		<?php

		while($res && $row = $res->fetch_assoc()){
			echo "<li>Name :". $row["name"] . " - Email: " . $row["email"] ." <a href=".SITE_URL."users/".$row['id'].">View</a></li>";

		}
		?>


	</ul>
	<?php
	}else{
		if($res && $row = $res->fetch_assoc()){
			echo "<p>Name :". $row["name"] . " - Email: " . $row["email"] ."</p>";
		}else{
			echo "<p>User by id=".$_GET['id']."not found</p>";
		}

	}

	if ($res == false){
		echo "<p>No users found.</p>";
	}

	?>

</div>
