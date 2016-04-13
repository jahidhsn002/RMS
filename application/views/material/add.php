<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<main id="content">
	
	<div class="form">
		<h4 class="text-center">Add Material</h4>
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

		<?php echo form_open('material/add'); ?>
			
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Name</div>
					<input type="text" value="" name="name" class="form-control" id="Name">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group ui-widget">
					<div class="input-group-addon">Category</div>
					<select name="category" id="combobox" class="form-control">
						<?php 
						$cat = 'cc_xx';
						foreach($datas as $data): 
							if($cat != $data->category):
								$cat = $data->category;
								echo '<option>';
								echo $cat;
								echo '</option>';
							endif;
						endforeach;
						?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Price</div>
					<input name="price" value="" type="number" class="form-control" id="Price">
					<div class="input-group-addon">.00</div>
				</div>
			</div>
	
			<div class="form-group text-center">
				<input type="submit" class="btn btn-sm btn-success" id="usr">
			</div>

		</form>

	</div>

</main>
