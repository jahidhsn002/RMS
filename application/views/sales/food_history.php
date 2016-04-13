<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<main id="content">
	
	<div class="component">
		<h4 class="text-center">Food History</h4>
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
				<th>Date</th>
				<th>Number</th>
				<th>Table</th>
				<th>Food</th>
				<th>Bill</th>
				<th>Paid</th>
				<th>Profit</th>
			</tr>
			</thead>
			<tbody>
	<?php foreach($datas as $data): ?>
			<tr>
				<td><b><?php echo mdate('%m/%d/%Y', gmt_to_local($data->time, 'UP6', FALSE)); ?></b></td>
				<td><?php echo $data->table_no; ?></td>
				<td><?php echo $data->table; ?></td>
				<td><?php 
					$material = explode('|',$data->food);
					$qty = explode('|',$data->quantity);
					for($i = 0; $i < count($material); $i++){
						echo $this->Db->get_relation('food', $material[$i], 'name');
						echo '(' . $qty[$i] . ') ';
					}
				?></td>
				<td><?php echo $data->bill; ?></td>
				<td><?php echo $data->paid; ?></td>
				<td><?php echo $data->profit; ?></td>
			</tr>
	<?php endforeach; ?>
			</tbody>
		</table>

	</div>

</main>
