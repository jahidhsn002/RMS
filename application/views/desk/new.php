<?php if($eror != ''): ?>
	<div class="alert alert-danger"><?php echo $eror ?></div>
<?php endif; ?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th colspan="10">New Orders</th>
		</tr>
		<tr>
			<th>Table</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($tables as $table): ?>
		<tr>
			<td><?php echo $this->DB->get_relation('table', $table->time, 'name'); ?></td>
			<td><?php echo $this->DB->get_relation('order', $table->time, 'status'); ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown">Print
					<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url("desk/slip/Kitchen/" . $table->time ."/". $table->id); ?>">Kitchen</a></li>
						<li><a href="<?php echo site_url("desk/slip/Drinks/" . $table->time ."/". $table->id); ?>">Drinks</a></li>
						<li><a href="<?php echo site_url("desk/slip/Foodpapa/" . $table->time ."/". $table->id); ?>">FoodPapa</a></li>
						<li><a href="<?php echo site_url("desk/slip/Change/" . $table->time); ?>">Change</a></li>
					</ul>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>