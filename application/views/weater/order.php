<?php $this->load->view('theme/header'); ?>

<h1 class="text-center"><?php echo $this->DB->get_relation('table',$id,'number') .' '. $this->DB->get_relation('table',$id,'name'); ?></h1>
<?php if($eror != ''): ?>
	<div class="alert alert-danger"><?php echo $eror ?></div>
<?php endif; ?>

<div id="food_item" class="hidden"></div>
	<div class="dropup">
		<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Dropup Example
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<li><a onclick="$('#food_item').toggleClass('hidden').load('<?php echo  site_url("weater/goods"); ?>')" href="#">Food Menue</a></li>
			<li><a onclick="$('#food_item').toggleClass('hidden').load('<?php echo  site_url("weater/special"); ?>')" href="#">Speacial Food</a></li>
			<?php if($this->DB->get_relation('order',$id,'goods') != 'False'): ?>
			<li class="divider"></li>
			<li><a class="btn-danger" onclick="$('#food_item').toggleClass('hidden').load('<?php echo  site_url("weater/bill/". $id); ?>')" href="#">Clear Table</a></li>
			<?php endif; ?>
		</ul>
	</div>
<div class="row">
	<div class="col-sm-12 order">
		
	</div>
</div>

<?php $this->load->view('theme/footer'); ?>