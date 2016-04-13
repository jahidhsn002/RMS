<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<main id="content">
	
	<div class="component">
		<h4 class="text-center">Due Payment</h4>
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
				<th>ID</th>
				<th>Supplier</th>
				<th>Company</th>
				<th>Bill</th>
				<th>Paid</th>
				<th>Due</th>
			</tr>
			</thead>
			<tbody>
	<?php foreach($datas2 as $data2): ?>
		<tr>
			<td><?php echo $data2->time; ?></td>
			<td><?php echo $data2->name; ?></td>
			<td><?php echo $data2->company; ?></td>
		<?php
			$bill = 0;
			$paid = 0;
			foreach($datas as $data):
			if($data2->time == $data->supplier):
				$bill += $data->bill;
				$paid += $data->paid;
			endif;
			endforeach;
		?>
			<td><?php echo $bill; ?></td>
			<td><?php echo $paid; ?></td>
			<td><?php echo ($bill - $paid); ?></td>
		</tr>
	<?php endforeach; ?>
			</tbody>
		</table>

	</div>

</main>
