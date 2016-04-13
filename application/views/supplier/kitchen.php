<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<main id="content">

	<div class="component">
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
		
		<div class="btn-group btn-group-sm">
			<a class="btn btn-success" data-toggle="tab" href="#Food">Food</a>
			<a class="btn btn-success" data-toggle="tab" href="#Material">Material</a>
			<a class="btn btn-warning" data-toggle="tab" href="#Sale" onclick="set_cart()">
				<b class="Food">0</b> <span class="glyphicon glyphicon-fire"></span>
				<b class="Material">0</b> <span class="glyphicon glyphicon-gift"></span>
			</a>
		</div>

		<div class="tab-content">
			<div id="Food" class="tab-pane fade in active">
				<p></p>
				<table width="100%" class="data table-condensed table table-bordered">
					<thead>
					<tr class="">
						<th>Name</th>
						<th>Category</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($datas as $data): ?>
					<tr>
						<td><?php echo $data->name; ?></td>
						<td><?php echo $data->category; ?></td>
						<td class="text-right">
							<button onclick="set_food('<?php echo $data->time; ?>');" class="<?php echo $data->time; ?> btn btn-sm btn-success" type="button" ><span class="glyphicon glyphicon-ok"></span></button>
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div id="Material" class="tab-pane fade">
				<p></p>
				<table width="100%" class="data table-condensed table table-bordered">
					<thead>
					<tr class="">
						<th>Name</th>
						<th>Category</th>
						<th>Price</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($datas2 as $data): ?>
					<tr>
						<td><?php echo $data->name; ?></td>
						<td><?php echo $data->category; ?></td>
						<td><?php echo $data->price; ?></td>
						<td class="text-right">
							<button onclick="set_material('<?php echo $data->time; ?>');" class="btn btn-sm btn-success" type="button" ><span class="glyphicon glyphicon-ok"></span></button>
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div id="Sale" class="tab-pane fade">
				<p></p>
				<?php echo form_open('supplier/cock_food'); ?>
				<table width="100%" class="table table-condensed table-bordered">
					<thead>
					<tr class="hidden">
						<th>Name</th>
						<th>Category</th>
						<th>Quantity</th>
						<th>total</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				<p class="total text-right form-inline">
					<div class="input-group">
						<span class="input-group-addon alert-warning total text-right">Total Material Used: <b><span>0</span></b></span>
						<span class="input-group-addon alert-info">Finished Food Quantity</span>
						<input type='text' value='0' class='form-control grand_field' name='food_qty'>
						<span class="input-group-addon alert-success">Finished</span>
					</div>
				</p>
				<button class="btn btn-success" type="submit">Complete</button> <button onclick="clear_item()" class="btn btn-danger" type="button">Cancle</button>
				<?php echo form_close(); ?>
			</div>
		</div>
		<br/>
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
	
	var count = 0;
	var check = 'false';
	var material = new Array();
	var material_modify = new Array();
	
	if(localStorage.getItem("Food")){
		$(".Food").html(1);
	}
	
	if(localStorage.getItem("Material")){
		material = localStorage.getItem("Material").split(',');
		$(".Material").html(material.length);
	}
	
	function set_food(id){
		$("button").removeClass('disabled');
		$("button."+ id).addClass('disabled');
		localStorage.Food = id;
		
		if(localStorage.getItem("Food")){
			$(".Food").html(1);
		}
	}
	
	function set_material(id){
		if(localStorage.getItem("Material")){
			material = localStorage.getItem("Material").split(',');
			check = 'false';
			for(i=0; i < material.length; i++){
				if(material[i] == id){
					check = 'true';
					break;
				}
			}
			if(check == 'false'){
				material[material.length] = id;
				localStorage.setItem("Material", material);
			}
		}else{
			material[material.length] = id;
			localStorage.setItem("Material", material);
		}
		$(".Material").html(material.length);
	}
	
	function clear_item(){
		localStorage.removeItem("Material");
		localStorage.removeItem("Food");
		$(".Food").html(0);
		$(".Material").html(0);
		$("#Sale tbody").empty();
		material = new Array();
	}
	
	function remove_cart(id){
		material = localStorage.getItem("Material").split(',');
		material_modify = new Array();
		for(i=0; i < material.length; i++){
			if(material[i] != id){
				material_modify[material_modify.length] = material[i];
			}
		}	
		localStorage.setItem("Material", material_modify);
		set_cart();
	}
	
	function set_cart(){
		if(localStorage.getItem("Material") != '' && localStorage.getItem("Material") != null){
			material = localStorage.getItem("Material").split(',');
			data = '<input type="hidden" name="food" value="'+ localStorage.getItem("Food") +'">';
			for(i=0; i < material.length; i++){
				data += "<tr id='"+ material[i] +"'>";
				data += "<td>"+ ccs[material[i]]["name"] +"<input type='hidden' name='id[]' value='"+ material[i] +"'></td>";
				data += "<td>"+ ccs[material[i]]["category"] +"</td>";
				data += "<td><input onchange='calculate()' style='width:80px' type='text' value='0' class='qty form-control' name='qty_"+ material[i] +"'></td>";
				data += "<td class='text-right'><span onclick='remove_cart("+ material[i] +")' class='btn btn-xs btn-danger glyphicon glyphicon-remove'></span></td>";
				data += "</tr>";
			}
			$("#Sale tbody").html(data);
		}else{
			$("#Sale tbody").empty();
		}
		if(localStorage.getItem("Food")){
			$(".Food").html(1);
		}
		if(localStorage.getItem("Material")){
			material = localStorage.getItem("Material").split(',');
			$(".Material").html(material.length);
		}
	}
	
	function calculate(){
		total = 0;
		material = localStorage.getItem("Material").split(',');
		for(i=0; i < material.length; i++){
			total += parseFloat($("#"+material[i]+" .qty").val());
		}
		$(".total span").html(total);
		grand_total();
	}
	
	function grand_total(){
		total = 0;
		material = localStorage.getItem("Material").split(',');
		for(i=0; i < material.length; i++){
			total += parseFloat($("#"+material[i]+" .subtotal").text());
		}
		g_total = (total - $(".grand_field").val());
		$(".grand_total span").html(g_total);
		left_total();
	}
	
	function left_total(){
		total = 0;
		material = localStorage.getItem("Material").split(',');
		for(i=0; i < material.length; i++){
			total += parseFloat($("#"+material[i]+" .subtotal").text());
		}
		g_total = (total - $(".grand_field").val());
		l_total = (g_total - $(".left_field").val());
		$(".left_total span").html(l_total);
	}
	
}else{
	alert(" Sorry! No Web Storage support.. " );
}
	
</script>