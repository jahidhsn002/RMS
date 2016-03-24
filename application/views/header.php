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
			<button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">Menue
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li class="dropdown-header">User Rolls</li>
				<li><a href="<?php echo site_url("Shop"); ?>">Weater</a></li>
				<li><a href="<?php echo site_url("Kitchen"); ?>">Kitchen</a></li>
				<li><a href="<?php echo site_url("Desk"); ?>">Desk</a></li>
				<li class="divider"></li>
				<li class="dropdown-header">Admin Section</li>
				<li><a href="<?php echo site_url("Table"); ?>">Table</a></li>
				<li><a href="<?php echo site_url("Stock"); ?>">Stock</a></li>
				<li><a href="<?php echo site_url("Goods"); ?>">Foods</a></li>
			</ul>
		</div>
	</nav>
	