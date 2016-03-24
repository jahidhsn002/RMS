<?php $this->load->view('header'); ?>
<div class="show">
	<div class="clearfix">
		<br/>
		<br/>
	</div>
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
	$('.order').load('<?php echo site_url('Kitchen/order'); ?>');
	setInterval(function(){
		$('.order').load('<?php echo site_url('Kitchen/order'); ?>');
	}, 10000 );
	//Loading Table
	//$('.slip').load('<?php echo site_url('Kitchen/view/02635544855'); ?>');
	//setInterval(function(){
	//	$('.slip').load('<?php echo site_url('Kitchen/view/02635544855'); ?>');
	//}, 10000 );
	//Loading Speacial
	//$('.speacial').load('<?php echo site_url('Shop/speacial'); ?>');
	//setInterval(function(){
	//	$('.speacial').load('<?php echo site_url('Shop/speacial'); ?>');
	//}, 10000 );
	
	//Loading Order
	//$('.order').load('<?php echo site_url('Shop/order'); ?>');
	/*//setInterval(function(){
	//	$('.order').load('http://localhost/RMS/Shop/order');
	//}, 10000 );*/
</script>