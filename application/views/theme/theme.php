<?php $this->load->view('header'); ?>
<div class="show">
	<div class="clearfix hide_print">
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