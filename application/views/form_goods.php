
<?php $this->load->view('header'); ?>

<?php echo validation_errors(); ?>

<?php echo form_open('Goods/add'); ?>

<h5>Name</h5>
<input type="text" class="form-control" name="name" value="" size="50" />

<h5>Category</h5>
<input type="text" class="form-control" name="category" value="" size="50" />

<h5>Price</h5>
<input type="number" class="form-control" name="price" value="" size="50" />
</br>
<div><input class="btn btn-success btn-sm" type="submit" value="Submit" /></div>

</form>

<?php $this->load->view('footer'); ?>

