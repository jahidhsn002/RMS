<?php $this->load->view('theme/header'); ?>
<h1 class="text-center">Goods</h1>
<div class="form">
	
	<?php if($eror != ''): ?>
		<div class="alert alert-danger"><?php echo $eror ?></div>
	<?php endif; ?>
	<?php if($success != ''): ?>
		<div class="alert alert-success"><?php echo $success ?></div>
	<?php endif; ?>

	<?php echo form_open('goods/add'); ?>
	
	<?php if($id != ''): ?>
		<input type="hidden" value="old" name="action">
		<input type="hidden" value="<?php echo $id; ?>" name="id">
	<?php else: ?>
		<input type="hidden" value="new" name="action">
	<?php endif; ?>

	<div class="form-group">
		<label for="Name">Name:</label>
		<input type="text" value="<?php echo str_replace('False','',$this->DB->get_relation('goods',$id,'name')); ?>" name="name" class="form-control" id="Name">
	</div>
	<div class="form-group">
		<label id="Category" for="Category">Category:</label>
		<select name="category" id="Category" class="form-control">
			<option>Filmy Food</option>
			<option>Filmy Drinks</option>
			<option>Bangla Tea</option>
			<option>Hollywood Coffee</option>
			<option>Dessert</option>
			<option>Food papa Item</option>
			<option>Regular Drinks</option>
			<option>Tobacco</option>
		</select>
	</div>
	<div class="form-group">
		<label for="number">Print Category:</label>
		<select name="print" id="Print" class="form-control">
			<option>Kitchen</option>
			<option>Drinks</option>
			<option>Food papa</option>
		</select>
	</div>
	<div class="form-group">
		<label for="number">Price:</label>
		<div class="input-group">
			<div class="input-group-addon">T</div>
			<input name="price" value="<?php echo str_replace('False','',$this->DB->get_relation('goods',$id,'price')); ?>" type="number" class="form-control" id="Price">
			<div class="input-group-addon">.00</div>
		</div>
	</div>
	<button type="submit" class="btn btn-success">Submit</button>

	<?php echo form_close(); ?>

</div>

<?php $this->load->view('theme/footer'); ?>