
<?php if($eror != ''): ?>
	<div class="alert alert-danger"><?php echo $eror ?></div>
<?php endif; ?>
<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th colspan="10"><span onclick="$('#food_item').toggleClass('hidden')" class="close" aria-label="close">×</span><h3 class="text-center">Goods</h3></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>Name</th>
			<th>Price</th>
			<th>Stock</th>
		</tr>
<?php $category = ''; ?>
<?php foreach($tables as $table): ?>
	<?php if($category != $table->category): ?>
		<?php $category = $table->category; ?>
		<tr>
			<th colspan="10"><?php echo $table->category; ?></th>
		</tr>
	<?php endif; ?>
		<tr onclick="$('.order').load('<?php echo site_url("weater/set/add/" . $table->time ) ?>')">
			<td><?php echo $table->name; ?></td>
			<td><?php echo $table->price; ?></td>
			<td><?php echo $this->DB->get_relation('stock',$table->time,'quantity'); ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>