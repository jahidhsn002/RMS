<?php $this->load->view('header'); ?>
<div class="show">
	<div class="row">
		<div class="col-sm-4 hide_print">
			<div class="order">
			</div>
		</div>
		<div class="col-sm-8 print">
			<div class="slip">
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('footer'); ?>
<script>
	//Loading manue
	$('.order').load('<?php echo site_url('Desk/order'); ?>');
	setInterval(function(){
		$('.order').load('<?php echo site_url('Desk/order'); ?>');
	}, 10000 );
</script>