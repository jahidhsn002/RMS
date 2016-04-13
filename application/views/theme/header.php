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
	<script src="<?php echo site_url("js/jquery-ui.js"); ?>"></script>
	
	<?php
		// Styles
	?>
	
	<link rel="stylesheet" href="<?php echo site_url("css/jquery-ui.css"); ?>">
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
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HUB RMS 1.2.7
			<?php if(isset($id)): ?>
			| <span class="small"><?php echo $this->Db->get_relation('user',$id,'name'); ?></span>
			<?php endif;?>
			<div class="pull-right btn-group btn-group-xs">
				<a class="btn btn-danger" href="<?php echo site_url('home/logout'); ?>">Logout</a>
				<a type="button" onclick="window.location.reload(false);" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Reload</a>
				<?php if($Back != null){ ?>
					<a href="<?php echo site_url($Back); ?>" type="button" class="btn btn-warning"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
				<?php } ?>
			</div>
		</h4>
		<div class="btn btn-info" tabIndex="null">hi</div>
		</div>
		<nav id="nav">
			<?php 
				if($this->session->userdata('he645200_on')):
				$session_data = $this->session->userdata('he645200_on');
				$id = $session_data['id']; $data['id'] = $id;
				$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			?>
			<div class="btn-group btn-group-sm">
			
				<?php if(in_array('dash', $access)){ ?>
			
				<a href="<?php echo site_url('home/dash'); ?>" type="button" class="btn btn-default">Dashboard</a>
				
				<?php }if(in_array('waiter', $access)){ ?>
				
				<div class="btn-group btn-group-sm">
					<a class="btn btn-default" href="<?php echo site_url('sales/waiter'); ?>">Waiter</a>
				</div>
				
				<?php }if(in_array('material/stock', $access)){ ?>
				
				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					Material Stock <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo site_url('prestock'); ?>">All Stock</a></li>
						<li><a href="<?php echo site_url('prestock/low'); ?>">Low Stock</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url('prestock/wastage'); ?>">Wastage Control</a></li>
					</ul>
				</div>
				
				<?php }if(in_array('food/stock', $access)){ ?>
				
				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					Food Stock <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo site_url('stock'); ?>">All Stock</a></li>
						<li><a href="<?php echo site_url('stock/low'); ?>">Low Stock</a></li>
						<li><a href="<?php echo site_url('stock/premade'); ?>">Premade Stock</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url('stock/wastage'); ?>">Wastage Control</a></li>
					</ul>
				</div>
				
				<?php }if(in_array('perchase/material', $access)){ ?>
				
				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					Perchase<span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo site_url('material'); ?>">Material</a></li>
						<li><a href="<?php echo site_url('supplier'); ?>">Suppliers</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url('supplier/material'); ?>">Purchage</a></li>
					</ul>
				</div>
				
				<?php }if(in_array('praper/food', $access)){ ?>
				
				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					Praper<span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo site_url('food'); ?>">Foods</a></li>
						<li><a href="<?php echo site_url('catprint'); ?>">Print</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url('supplier/kitchen'); ?>">Coock Food</a></li>
					</ul>
				</div>
				
				<?php }if(in_array('salse', $access)){ ?>
				
				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					Sales <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo site_url('sales/order'); ?>">View Orders</a></li>
						<li><a href="<?php echo site_url('sales'); ?>">Manager Sales</a></li>
					</ul>
				</div>
				
				<?php }if(in_array('due', $access)){ ?>
				
				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					Dues <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo site_url('due'); ?>">Due Payment</a></li>
						<li><a href="<?php echo site_url('due/history'); ?>">Due History</a></li>
					</ul>
				</div>
				
				<?php }if(in_array('history', $access)){ ?>
				
				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					History <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo site_url('due/history'); ?>">Due History</a></li>
						<li><a href="<?php echo site_url('supplier/coock_history'); ?>">Coock History</a></li>
						<li><a href="<?php echo site_url('supplier/material_history'); ?>">Purchage History</a></li>
						<li><a href="<?php echo site_url('sales/food_history'); ?>">Sales History</a></li>
					</ul>
				</div>
				
				<?php }if(in_array('option', $access)){ ?>
				
				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					Option <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo site_url('table'); ?>">Tables</a></li>
						<li><a href="<?php echo site_url('user'); ?>">Users</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url(''); ?>" >Settings</a></li>
					</ul>
				</div>
				
				<?php } ?>
				
			</div>
			<?php endif; ?>
		</nav>
	</header>