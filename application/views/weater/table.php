<?php $this->load->view('theme/header'); ?>

<h1 class="text-center">Order Tables</h1>
<?php if($eror != ''): ?>
	<div class="alert alert-danger"><?php echo $eror ?></div>
<?php endif; ?>
<div class="row">
<?php foreach($tables as $table): ?>
	<div class="col-sm-3">
		<a class="h3 order_table" href="<?php echo site_url('weater/order/'. $table->time); ?>">
			<?php echo $table->number; ?><br/>
			<?php echo $table->name; ?>
		</a>
	</div>
<?php endforeach; ?>
</div>

<?php $this->load->view('theme/footer'); ?>