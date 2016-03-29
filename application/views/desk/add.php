<?php $this->load->view('theme/header'); ?>
<h1 class="text-center">Desk</h1>
<div class="form">
	
	<?php if($eror != ''): ?>
		<div class="alert alert-danger"><?php echo $eror ?></div>
	<?php endif; ?>
	<?php if($success != ''): ?>
		<div class="alert alert-success"><?php echo $success ?></div>
	<?php endif; ?>

	<?php echo form_open('desk/recipt'); ?>
	
	<input type="hidden" value="<?php echo $id; ?>" name="id">
	
	<div class="form-group">
		<label for="Quantity">Customer Name:</label>
		<input type="text" value="<?php echo str_replace('False','',$this->DB->get_relation('stock',$id,'quantity')); ?>" name="customer" class="form-control" id="Quantity">
	</div>
	<div class="form-group">
		<label for="Quantity">Name:</label>
		<input type="text" value="<?php echo str_replace('False','',$this->DB->get_relation('stock',$id,'quantity')); ?>" name="name" class="form-control" id="Quantity">
	</div>
	<div class="form-group">
		<label for="Speacial">Type</label>
		<select name="type" id="Speacial" class="form-control">
			<option>Menual</option>
			<option>Parcantage</option>
		</select>
	</div>
	<div class="form-group">
		<label for="number">Parcantage:</label>
		<div class="input-group">
			<div class="input-group-addon">T</div>
			<input name="parcantage" value="<?php echo str_replace('False','',$this->DB->get_relation('stock',$id,'price')); ?>" type="number" class="form-control" id="Price">
			<div class="input-group-addon">%</div>
		</div>
	</div>
	<div class="form-group">
		<label for="number">Menual:</label>
		<div class="input-group">
			<div class="input-group-addon">T</div>
			<input name="menual" value="<?php echo str_replace('False','',$this->DB->get_relation('stock',$id,'price')); ?>" type="number" class="form-control" id="Price">
			<div class="input-group-addon">.00</div>
		</div>
	</div>
	<button type="submit" class="btn btn-success">Submit</button>

	<?php echo form_close(); ?>

</div>

<?php $this->load->view('theme/footer'); ?>