
<?php $this->load->view('theme/header'); ?>

<h1 class="text-center">Orders</h1>

<?php if($eror != ''): ?>
	<div class="alert alert-success"><?php echo $eror ?></div>
<?php endif; ?>

<div id="new"></div>

<div id="painding"></div>

<div id="cashout"></div>

<script>

	//Loading manue
	$('#new').load('<?php echo site_url('desk/new_order'); ?>');
	setInterval(function(){
		$('#new').load('<?php echo site_url('desk/new_order'); ?>');
	}, 10000 );
	
	//Loading manue
	$('#painding').load('<?php echo site_url('desk/painding'); ?>');
	setInterval(function(){
		$('#painding').load('<?php echo site_url('desk/painding'); ?>');
	}, 10000 );
	
	//Loading manue
	$('#cashout').load('<?php echo site_url('desk/cashout'); ?>');
	setInterval(function(){
		$('#cashout').load('<?php echo site_url('desk/cashout'); ?>');
	}, 10000 );
	
</script>

<?php $this->load->view('theme/footer'); ?>