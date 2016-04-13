<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hub Resturent 1.0</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php
		// Scripts
	?>
	<script src="<?php echo site_url("js/jquery.min.js"); ?>"></script>
	<script src="<?php echo site_url("js/bootstrap.min.js"); ?>"></script>
	<script src="<?php echo site_url("js/jquery.dataTables.min.js"); ?>"></script>
	<script src="<?php echo site_url("js/dataTables.bootstrap.min.js"); ?>"></script>
	
	<?php
		// Styles
	?>
	<link rel="stylesheet" href="<?php echo site_url("css/bootstrap.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo site_url("css/animate.css"); ?>">
	<link rel="stylesheet" href="<?php echo site_url("css/dataTables.bootstrap.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo site_url("css/style.css"); ?>">
	
</head>
<body>
<div class="container main">
	<br/>
	<br/>
<main id="main" class="clearfix">
	<header id="header">
		<div class="clearfix">
		<h4>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HUB RMS 1.0
		</h4>
		</div>
	</header>
<main id="content">
	<br/>
	<br/>
	<br/>
	<div class="form animated jello">
		
		<?php echo form_open('home',array('class'=>'form-signin')); ?>
			<h3 class="form-signin-heading text-center">Please sign in</h3>
			<?php 
				if($Eror != null){
					echo '<div class="alert alert-danger fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Danger!</strong> '. $Eror .'
					</div>';
				}
				if($Success != null){
					echo '<div class="alert alert-success fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Success!</strong> '. $Success .'
					</div>';	
				}
			?>
			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" name="username" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		</form>
	
	</div>

</main>
</main>
</div>
</body>
</html>