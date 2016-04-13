<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<main id="content">
	
	<div class="component">
		<h3 class="text-center">Dashboard</h3>
		<h4 class="text-center">Welcome <?php echo $this->Db->get_relation('user',$id,'name'); ?>!</h4>
	</div>
	<div class="component">
		<div class="btn-group-vertical" role="group">
			<button class="btn btn-success">Your Modules</button>
			<?php foreach($accesss as $access): ?>
				<a href="<?php echo site_url($this->Db->get_relation('module', $access,'link')); ?>" class="btn btn-default">
					<?php echo $this->Db->get_relation('module', $access,'name'); ?>
				</a>
			<?php endforeach; ?>
		</div>
		<div class="btn-group-vertical" role="group">
			<button class="btn btn-success">Sell Summery</button>
			<button class="btn btn-warning">Total Profit</button>
			<a href="#" class="btn btn-default">
				<?php echo $profit; ?>
			</a>
			<button class="btn btn-warning">Total Sale</button>
			<a href="#" class="btn btn-default">
				<?php echo $sell; ?>
			</a>
			<button class="btn btn-warning">Total Paid</button>
			<a href="#" class="btn btn-default">
				<?php echo $paid; ?>
			</a>
		</div>
		<div class="btn-group-vertical" role="group">
			<button class="btn btn-success">Perchase Summery</button>
			<button class="btn btn-warning">Total Due Payment</button>
			<a href="#" class="btn btn-default">
				<?php echo $due; ?>
			</a>
			<button class="btn btn-warning">Perchase From Supplier</button>
			<a href="#" class="btn btn-default">
				<?php echo $perchase; ?>
			</a>
			<button class="btn btn-warning">Paid To Supplier</button>
			<a href="#" class="btn btn-default">
				<?php echo $perchase_paid; ?>
			</a>
			<button class="btn btn-warning">Net Money</button>
			<a href="#" class="btn btn-default">
				<?php echo ($profit - $perchase_paid); ?>
			</a>
		</div>
		<div class="btn-group-vertical" role="group">
			
		</div>
	</div>
</main>
