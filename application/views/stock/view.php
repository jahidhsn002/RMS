<?php $this->load->view('theme/header'); ?>
<h1 class="text-center">Stock</h1>
<?php if($eror != ''): ?>
	<div class="alert alert-danger"><?php echo $eror ?></div>
<?php endif; ?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Quantity</th>
			<th>Speacial</th>
			<th>Price</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($tables as $table): ?>
		<tr>
			<td><?php echo $this->DB->get_relation('goods', $table->time, 'name'); ?></td>
			<td><?php echo $table->quantity; ?></td>
			<td><?php echo $table->special; ?></td>
			<td><?php echo $table->price; ?></td>
			<td><a class="btn btn-xs btn-success" href="<?php echo site_url('stock/add/'. $table->time); ?>">Change</a></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>