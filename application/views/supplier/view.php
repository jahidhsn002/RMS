<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<main id="content">
	
	<div class="component">
		<h4 class="text-center">Supplier List</h4>
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
		
		<table class="table">
			<thead>
			<tr>
				<th colspan="8"><a class="btn btn-sm btn-success" href="<?php echo site_url('supplier/add'); ?>">Add Supplier</a></th>
			</tr>
			<tr>
				<th>Name</th>
				<th>Company</th>
				<th>Contact</th>
				<th>Comment</th>
				<th>Address</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
	<?php foreach($datas as $data): ?>
			<tr>
				<td><?php echo $data->name; ?></td>
				<td><?php echo $data->company; ?></td>
				<td><?php echo $data->contact; ?></td>
				<td><?php echo $data->comment; ?></td>
				<td><?php echo $data->address; ?></td>
				<td>
					<a class="btn btn-sm btn-info" href="<?php echo site_url( 'supplier/edit/'. $data->time ); ?>"><span class="glyphicon glyphicon-cog"></span></a>
					<a class="btn btn-sm btn-danger" href="<?php echo site_url( 'supplier/trash/'. $data->time ); ?>"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
			</tr>
	<?php endforeach; ?>
			</tbody>
		</table>

	</div>

</main>
