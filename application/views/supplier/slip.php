<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<main id="content">
	
	<div class="component">
		<div class="text-center"><img style="height:70px" src="<?php echo site_url('images/loogo.gif'); ?>"></div>
		<h4 class="text-center">Supplier Slip</h4>
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
		
		<?php echo $out; ?>

	</div>

</main>

<script>

var data = '';
var total = 0;
var g_total = 0;
var ccs = {
	<?php foreach($datas2 as $data){
		echo '"'. $data->time .'"';
		echo ':{';
		echo '"name":"'. $data->name .'",';
		echo '"category":"'. $data->category .'",';
		echo '"price":"'. $data->price .'"';
		echo '},';
	} ?>
};
if(typeof(Storage) !== "undefined") {
	
	localStorage.removeItem("Material");
	localStorage.removeItem("Supplier");
	
}else{
	alert(" Sorry! No Web Storage support.. " );
}
	
</script>
