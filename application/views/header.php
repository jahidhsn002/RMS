 <!DOCTYPE html>
<html lang="en">
<head>
	<title>Hub Resturent 1.0</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		// Styles
	?>
	<link rel="stylesheet" href="<?php echo site_url("css/bootstrap.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo site_url("css/animate.css"); ?>">
	<link rel="stylesheet" href="<?php echo site_url("css/style.css"); ?>">
	<?php
		// Scripts
	?>
	<script src="<?php echo site_url("js/jquery.min.js"); ?>"></script>
	<script src="<?php echo site_url("js/bootstrap.min.js"); ?>"></script>
</head>
<body>
<div class="container main">
	<nav class="nav">
		<div class="dropup">
			<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Tutorials
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li class="dropdown-header">User Rolls</li>
				<li><a href="<?php echo site_url("shop"); ?>">Weater</a></li>
				<li><a href="<?php echo site_url("kitchen"); ?>">Kitchen</a></li>
				<li><a href="<?php echo site_url("desk"); ?>">Desk</a></li>
				<li class="divider"></li>
				<li class="dropdown-header">Admin Section</li>
				<li><a href="<?php echo site_url("css/style.css"); ?>">Table</a></li>
				<li><a href="<?php echo site_url("css/style.css"); ?>">Stock</a></li>
				<li><a href="<?php echo site_url("css/style.css"); ?>">Foods</a></li>
			</ul>
		</div>
	</nav>
	