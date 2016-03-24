<?php $this->load->view('header'); ?>
<div class="show">
	<div class="row">
		<div class="col-sm-4 hide_print">
			<div class="manue">
			</div>
		</div>
		<div class="col-sm-4 hide_print">
			<div class="">
			</div>
		</div>
		<div class="col-sm-4 hide_print">
			<div class="speacial">
			</div>
		</div>
		<div class="col-sm-12 print">
			<div class="the_form">
				
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('footer'); ?>
<script>
	$('.the_form').load('<?php echo site_url('Stock/view'); ?>');
	//setInterval(function(){
	//	$('.the_form').load('<?php echo site_url('Goods/view'); ?>');
	//}, 15000 );
</script>