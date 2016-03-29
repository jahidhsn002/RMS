<?php $this->load->view('theme/header'); ?>
<h1 class="text-center">Goods</h1>
<?php if($eror != ''): ?>
	<div class="alert alert-danger"><?php echo $eror ?></div>
<?php endif; ?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Category</th>
			<th>Print Category</th>
			<th>Price</th>
			<th class="text-right"><a class="btn btn-xs btn-success" href="<?php echo site_url('goods/add'); ?>">Add New</a></th>
		</tr>
	</thead>
	<tbody>
<?php foreach($tables as $table): ?>
		<tr>
			<td><?php echo $table->name; ?></td>
			<td><?php echo $table->category; ?></td>
			<td><?php echo $table->print; ?></td>
			<td><?php echo $table->price; ?></td>
			<td><div class="dropdown pull-right">
					<button class="btn btn-xs btn-success btn-default dropdown-toggle" type="button" data-toggle="dropdown">Actions<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('goods/add/'. $table->time); ?>">Edit</a></li>
						<li><a href="<?php echo site_url('goods/trash/'. $table->time); ?>">Delete</a></li>
					</ul>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>