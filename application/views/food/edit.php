<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<main id="content">
	
	<div class="form">
		<h4 class="text-center">Edit <?php echo str_replace('False', 'Not a Food', $this->Db->get_relation('food', $time, 'name')); ?></h4>
		<?php 
			if($Eror != null){
				echo '<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Danger!</strong> '. $Eror .'
				</div>';
			}
			if($Success != null){
				echo '<div class="alert alert-success fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Success!</strong> '. $Success .'
				</div>';	
			}
		 ?>

		<?php echo form_open('food/edit/'. $time); ?>
			
			<input type="hidden" name="time" value="<?php echo $time; ?>" class="form-control">
			
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Name</div>
					<input type="text" value="<?php echo str_replace('False', '', $this->Db->get_relation('food', $time, 'name')); ?>" name="name" class="form-control" id="Name">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Category</div>
					<select value="<?php echo str_replace('False', '', $this->Db->get_relation('food', $time, 'category')); ?>" name="category" id="Category" class="form-control">
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
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Print Category</div>
					<select value="<?php echo str_replace('False', '', $this->Db->get_relation('food', $time, 'print')); ?>" name="print" id="Print" class="form-control">
						<?php foreach($prints as $print): ?>
						<option value="<?php echo $print->time; ?>"><?php echo $print->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Price</div>
					<input name="price" value="<?php echo str_replace('False', '', $this->Db->get_relation('food', $time, 'price')); ?>" type="number" class="form-control" id="Price">
					<div class="input-group-addon">.00</div>
				</div>
			</div>
			
			<div class="form-group text-center">
				<input type="submit" class="btn btn-sm btn-success" id="usr">
			</div>

		</form>

	</div>

</main>