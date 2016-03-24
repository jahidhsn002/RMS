
<?php $this->load->view('header'); ?>

<?php echo validation_errors(); ?>

<?php echo form_open('Stock/add'); ?>

<h5>Name</h5>
<select class="form-control" name="time">
	<?php foreach($goods as $good){
		echo '<option value="'. $good->time .'">'. $good->name .'</option>';
	} ?>
</select>

<h5>Quantity</h5>
<input type="number" class="form-control" name="quantity" value="" size="50" />

</br>
<div><input class="btn btn-success btn-sm" type="submit" value="Submit" /></div>

</form>

<?php $this->load->view('footer'); ?>

