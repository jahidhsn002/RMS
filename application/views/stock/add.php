<?php $this->load->view('theme/header'); ?>
<h1 class="text-center">Stock</h1>
<div class="form">
	
	<?php if($eror != ''): ?>
		<div class="alert alert-danger"><?php echo $eror ?></div>
	<?php endif; ?>
	<?php if($success != ''): ?>
		<div class="alert alert-success"><?php echo $success ?></div>
	<?php endif; ?>

	<?php echo form_open('stock/add'); ?>
	
	<input type="hidden" value="old" name="action">
	<input type="hidden" value="<?php echo $id; ?>" name="id">

	<div class="form-group">
		<label for="Quantity">Quantity:</label>
		<input type="number" value="<?php echo str_replace('False','',$this->DB->get_relation('stock',$id,'quantity')); ?>" name="quantity" class="form-control" id="Quantity">
	</div>
	<div class="form-group">
		<label for="Speacial">Speacial:</label>
		<select name="special" id="Speacial" class="form-control">
			<?php if($this->DB->get_relation('stock',$id,'special') == "True" ): ?>
			<option>True</option>
			<option>False</option>
			<?php else: ?>
			<option>False</option>
			<option>True</option>
			<?php endif; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="number">Price:</label>
		<div class="input-group">
			<div class="input-group-addon">T</div>
			<input name="price" value="<?php echo str_replace('False','',$this->DB->get_relation('stock',$id,'price')); ?>" type="number" class="form-control" id="Price">
			<div class="input-group-addon">.00</div>
		</div>
	</div>
	<button type="submit" class="btn btn-success">Submit</button>

	<?php echo form_close(); ?>

</div>

<?php $this->load->view('theme/footer'); ?>