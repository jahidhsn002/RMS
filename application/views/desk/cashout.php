<?php if($eror != ''): ?>
	<div class="alert alert-danger"><?php echo $eror ?></div>
<?php endif; ?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th colspan="10">Cashout Request</th>
		</tr>
		<tr>
			<th>Table</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php $check = null; ?>
<?php foreach($tables as $table): ?>
		<?php if($check != $table->time): ?>
		<?php $check = $table->time; ?>
		<tr>
			<td><?php echo $this->DB->get_relation('table', $table->time, 'name'); ?></td>
			<td><?php echo $this->DB->get_relation('order', $table->time, 'status'); ?></td>
			<?php 
				
				/*$out = '<ul class="list-group">';
				$v3 = explode('//',$table->goods);
				foreach($v3 as $v2){
					$good = explode('||',$v2);
					$out .= '<li class="list-group-item item">'. $this->DB->get_relation('goods', $good[0], 'name') . '<span class="badge">' . $good[1]  .'</span></li>';
					//$prev = $this->DB->get_relation('stock', $good[0], 'quantity');
					//$next = ($prev - $good[1]);
					//$this->DB->update( 'stock', $good[0], array( "quantity"=>$next ));
					
				}
				$out .= '</ul>';
				echo $out; */
				
			?>
			<td>
				<div class="dropdown">
					<button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown">Print
					<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url("desk/total/Kitchen/" . $table->time) ?>">Kitchen</a></li>
						<li><a href="<?php echo site_url("desk/total/drinks/" . $table->time) ?>">Drinks</a></li>
						<li><a href="<?php echo site_url("desk/total/foodpapa/" . $table->time) ?>">FoodPapa</a></li>
						<li><a href="<?php echo site_url("desk/recipt/" . $table->time) ?>">CashOut</a></li>
					</ul>
				</div>
			</td>
		</tr>
		<?php endif; ?>
<?php endforeach; ?>
	</tbody>
</table>