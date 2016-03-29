<?php $this->load->view('theme/header'); ?>
<h1 class="text-center">Table</h1>
<div class="form">
	
	<?php if($eror != ''): ?>
		<div class="alert alert-danger"><?php echo $eror ?></div>
	<?php endif; ?>
	<?php if($success != ''): ?>
		<div class="alert alert-success"><?php echo $success ?></div>
	<?php endif; ?>

	<?php echo form_open('table/add'); ?>
	
	<?php if($id != ''): ?>
		<input type="hidden" value="old" name="action">
		<input type="hidden" value="<?php echo $id; ?>" name="id">
	<?php else: ?>
		<input type="hidden" value="new" name="action">
	<?php endif; ?>
	
	<div class="form-group">
		<label for="Number">Number:</label>
		<input type="number" value="<?php echo str_replace('False','',$this->DB->get_relation('table',$id,'number')); ?>" name="number" class="form-control" id="Number">
	</div>
	<div class="form-group">
		<label for="Name">Name:</label>
		<input type="text" value="<?php echo str_replace('False','',$this->DB->get_relation('table',$id,'name')); ?>" name="name" class="form-control" id="Name">
	</div>
	<button type="submit" class="btn btn-success">Submit</button>

	<?php echo form_close(); ?>

</div>

<?php $this->load->view('theme/footer'); ?>