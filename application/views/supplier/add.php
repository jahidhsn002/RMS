<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<main id="content">
	
	<div class="form">
		<h4 class="text-center">Add Supplier</h4>
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

		<?php echo form_open('supplier/add'); ?>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Name</span>
					<input type="text" name="name" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Company</span>
					<input type="text" name="company" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Contact</span>
					<input type="text" name="contact" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Comment</span>
					<textarea name="comment" class="form-control"></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Address</span>
					<textarea name="address" class="form-control"></textarea>
				</div>
			</div>
			
			<div class="form-group text-center">
				<input type="submit" class="btn btn-sm btn-success" id="usr">
			</div>

		</form>

	</div>

</main>