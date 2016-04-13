<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<main id="content">
	
	<div class="form">
		<h4 class="text-center">Edit <?php echo str_replace('False', 'Not a Table', $this->Db->get_relation('table', $time, 'name')); ?></h4>
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

		<?php echo form_open('user/edit/'. $time); ?>
			
			<input type="hidden" name="time" value="<?php echo $time; ?>" class="form-control">
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Name</span>
					<input type="text" name="name" value="<?php echo $this->Db->get_relation('user',$time,'name'); ?>" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Dasignation</span>
					<input type="text" name="designation" value="<?php echo $this->Db->get_relation('user',$time,'designation'); ?>" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Email</span>
					<input type="text" name="username" value="<?php echo $this->Db->get_relation('user',$time,'username'); ?>" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Password</span>
					<input type="text" name="password" value="" class="form-control">
				</div>
			</div>
			
			<div class="checkbox">
				<span class="h4">Access</span>
				<?php foreach($rolls as $roll): ?>
				<div><label><input name="roll[]" type="checkbox" value="<?php echo $roll->time; ?>"><?php echo $roll->name; ?></label></div>
				<?php endforeach; ?>
			</div>
			
			<div class="form-group text-center">
				<input type="submit" class="btn btn-sm btn-success" id="usr">
			</div>

		</form>

	</div>

</main>