<?php include_once ("../_config.php"); ?>
<div class="panel-body">
	<h3>Sign In</h3>
	<form id="form">
		<div class="form-group">
			<label for="email">Email address</label>
			<input type="email" class="form-control" id="email" placeholder="Enter email" required>
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" placeholder="Enter password" required>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
	<script type="text/javascript">
		$("#form").validate();
	</script>
	<p>Don't have an account? <a href="<?php echo SITE_URL ?>signup">Sign Up!</a></p>
</div>