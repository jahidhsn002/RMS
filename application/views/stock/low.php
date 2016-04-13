<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<main id="content">
	
	<div class="component">
		<h4 class="text-center">Low Stock</h4>
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
		
		<table id="table" class="table">
			<thead>
			<tr>
				<th>Name</th>
				<th>Quantity</th>
				<th>Cost</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
	<?php foreach($datas as $data): ?>
		<?php if($data->quantity < 5): ?>
			<tr>
				<td><?php echo $this->Db->get_relation('food', $data->time, 'name'); ?></td>
				<td><?php echo $data->quantity; ?></td>
				<td><?php echo $data->price; ?></td>
				<td>
					<?php echo form_open('stock/edit/'. $data->time, array('class'=>'form form-inline')); ?>
						<input type="text" style='width:50px;height:20px;' placeholder="wtg" name="drug_code" class="form-control">
						<button type="submit" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
					</form>
				</td>
			</tr>
		<?php endif; ?>
	<?php endforeach; ?>
			</tbody>
		</table>

	</div>

</main>
