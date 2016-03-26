<?php $this->load->view('header'); ?>
<div class="show">
	<div class="row">
		<div class="col-sm-4 hide_print">
			<div class="manue">
			</div>
		</div>
		<div class="col-sm-4 hide_print">
			<div class="ttable">
			</div>
		</div>
		<div class="col-sm-4 hide_print">
			<div class="speacial">
			</div>
		</div>
		<div class="col-sm-12 print">
			<div class="order">
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('footer'); ?>
<script>
	//Loading manue
	$('.manue').load('<?php echo site_url('Shop/manue'); ?>');
	setInterval(function(){
		$('.manue').load('<?php echo site_url('Shop/manue'); ?>');
	}, 10000 );
	//Loading Table
	$('.ttable').load('<?php echo site_url('Shop/table'); ?>');
	setInterval(function(){
		$('.ttable').load('<?php echo site_url('Shop/table'); ?>');
	}, 10000 );
	//Loading Speacial
	$('.speacial').load('<?php echo site_url('Shop/speacial'); ?>');
	setInterval(function(){
		$('.speacial').load('<?php echo site_url('Shop/speacial'); ?>');
	}, 10000 );
	
	//Loading Order
	$('.order').load('<?php echo site_url('Shop/order'); ?>');
</script>