<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<main id="content">
	
	<div class="component">
		<h4 class="text-center">Print Category</h4>
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
				<th colspan="3"><a class="btn btn-success btn-sm" href="<?php echo site_url('catprint/add'); ?>">Add Table</a></th>
			</tr>
			<tr>
				<th>Name</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
	<?php foreach($datas as $data): ?>
			<tr>
				<td><?php echo $data->name; ?></td>
				<td class="text-right">
					<a class="btn btn-sm btn-info" href="<?php echo site_url( 'catprint/edit/'. $data->time ); ?>"><span class="glyphicon glyphicon-cog"></span></a>
					<a class="btn btn-sm btn-danger" href="<?php echo site_url( 'catprint/trash/'. $data->time ); ?>"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
			</tr>
	<?php endforeach; ?>
			</tbody>
		</table>

	</div>

</main>
