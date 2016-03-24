<?php $this->load->view('header'); ?>
<div class="show">
	<div class="clearfix">
		<div class="btn-group index pull-right">
			<button onclick="$('#manue').toggleClass('bounceInRight bounceOutRight')" type="button" class="btn btn-warning">Foods</button>
			<button onclick="$('#ttable').toggleClass('bounceInRight bounceOutRight')" type="button" class="btn btn-warning">Tables</button>
			<button onclick="$('#speacial').toggleClass('bounceInRight bounceOutRight')" type="button" class="btn btn-warning">Speacial</button>
		</div>
		<br/>
		<br/>
	</div>
	<div class="row">
		<div id="manue" class="box animated bounceOutRight hide_print">
			<div class="manue">
			</div>
		</div>
		<div id="ttable" class="box animated bounceOutRight hide_print">
			<div class="ttable">
			</div>
		</div>
		<div id="speacial" class="box animated bounceOutRight hide_print">
			<div class="speacial">
			</div>
		</div>
		<div class="col-sm-12 print">
			<div class="order">
				<h1 class="main_title">Welcome to<hr/>Resturent Manegement Software</h1>
				<p class="text-center"><button onclick="$('.order').load('<?php echo site_url('Shop/order'); ?>')" class="btn btn-warning">Load Previous Data</button></p>
				<script>
					$('.main_title').addClass('animated bounce');
					setInterval(function(){
						$('.main_title').removeClass('animated bounce');
						setTimeout(function(){
							$('.main_title').addClass('animated bounce');
						}, 100 );
					}, 3000 );
				</script>
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
	
</script>