<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<main id="content">
	
	<div class="component">
		<h4 class="text-center">All Stock</h4>
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
				<th>Price</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
	<?php foreach($datas as $data): ?>
			<tr>
				<td><?php echo $this->Db->get_relation('material', $data->time, 'name'); ?></td>
				<td><?php echo $data->quantity; ?></td>
				<td><?php echo $data->price; ?></td>
				<td class="">
				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					Actions <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<?php echo form_open('prestock/wastage_change/'. $data->time, array('class'=>'form form-inline')); ?>
								<input type="text" style='width:100px;height:30px;' placeholder="wastage" name="qty" class="form-control">
								<button type="submit" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
							</form>
						</li>
					</ul>
				</div>
				</td>
			</tr>
	<?php endforeach; ?>
			</tbody>
		</table>

	</div>

</main>
