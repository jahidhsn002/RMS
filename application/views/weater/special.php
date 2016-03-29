
<?php if($eror != ''): ?>
	<div class="alert alert-danger"><?php echo $eror ?></div>
<?php endif; ?>
<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th colspan="10"><span onclick="$('#food_item').toggleClass('hidden')" class="close" aria-label="close">×</span><h3 class="text-center">Special</h3></th>
		</tr>
		<tr>
			<th>Name</th>
			<th>Price</th>
			<th>Stock</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($tables as $table): ?>
		<tr onclick="$('.order').load('<?php echo site_url("weater/set/add/" . $table->time ) ?>')">
			<td><?php echo $this->DB->get_relation('goods',$table->time,'name'); ?></td>
			<td><?php echo $table->price; ?></td>
			<td><?php echo $table->quantity; ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>