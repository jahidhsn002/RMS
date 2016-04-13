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
			<a class="btn btn-success" data-toggle="tab" href="#Supplier">Order</a>
			<a class="btn btn-success" data-toggle="tab" href="#Material">Food</a>
			<a class="btn btn-warning" data-toggle="tab" href="#Sale" onclick="set_cart()">
				<b class="Supplier">0</b> <span class="glyphicon glyphicon-cutlery"></span>
				<b class="Material">0</b> <span class="glyphicon glyphicon-gift"></span>
			</a>
		</div>

		<div class="tab-content">
			<div id="Supplier" class="tab-pane fade in active">
				<p></p>
				<table width="100%" class="data table-condensed table table-bordered">
					<thead>
					<tr class="">
						<th>Number</th>
						<th>Name</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($datas as $data): ?>
					<tr onclick="set_supplier('<?php echo $data->time; ?>');">
						<td><?php echo $data->number; ?></td>
						<td><?php echo $data->name; ?></td>
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
						<th tabIndex="null">Name</th>
						<th>Category</th>
						<th>Print Category</th>
						<th>Price</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($datas2 as $data): ?>
					<tr onclick="set_material('<?php echo $data->time; ?>');">
						<td><?php echo $data->name; ?></td>
						<td><?php echo $data->category; ?></td>
						<td><?php echo $this->Db->get_relation('print',$data->print,'name'); ?></td>
						<td><?php echo $data->price; ?></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div id="Sale" class="tab-pane fade">
				<p></p>
				<?php echo form_open('sales/place_order'); ?>
				<table width="100%" class="table table-condensed table-bordered">
					<thead>
					<tr class="">
						<th>Name</th>
						<th>Category</th>
						<th>Price</th>
						<th>Quantity</th>
						<th colspan="2">Total</th>
					</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
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
	
	if(localStorage.getItem("Supplier")){
		$(".Supplier").html(1);
	}
	
	if(localStorage.getItem("Material")){
		material = localStorage.getItem("Material").split(',');
		$(".Material").html(material.length);
	}
	
	function set_supplier(id){
		$("button").removeClass('disabled');
		$("button."+ id).addClass('disabled');
		localStorage.Supplier = id;
		
		if(localStorage.getItem("Supplier")){
			$(".Supplier").html(1);
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
		localStorage.removeItem("Supplier");
		$(".Supplier").html(0);
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
			data = '<input type="hidden" name="Table" value="'+ localStorage.getItem("Supplier") +'">';
			for(i=0; i < material.length; i++){
				data += "<tr id='"+ material[i] +"'>";
				data += "<td>"+ ccs[material[i]]["name"] +"<input type='hidden' name='id[]' value='"+ material[i] +"'></td>";
				data += "<td>"+ ccs[material[i]]["category"] +"</td>";
				data += "<td><input onchange='calculate("+ material[i] +")' style='width:80px' type='number' value='"+ ccs[material[i]]["price"] +"' class='price form-control' name='price_"+ material[i] +"' disabled></td>";
				data += "<td><input onchange='calculate("+ material[i] +")' style='width:80px' type='number' value='0' class='qty form-control' name='qty_"+ material[i] +"'></td>";
				data += "<td class='subtotal'>0</td>";
				data += "<td><span onclick='remove_cart("+ material[i] +")' class='btn btn-xs btn-danger glyphicon glyphicon-remove'></span></td>";
				data += "</tr>";
			}
			$("#Sale tbody").html(data);
		}else{
			$("#Sale tbody").empty();
		}
		if(localStorage.getItem("Supplier")){
			$(".Supplier").html(1);
		}
		if(localStorage.getItem("Material")){
			material = localStorage.getItem("Material").split(',');
			$(".Material").html(material.length);
		}
	}
	
	function calculate(id){
		total = 0;
		price = $("#"+id+" .price").val();
		qty = $("#"+id+" .qty").val();
		subtotal = (price * qty);
		$("#"+id+" .subtotal").html(subtotal);
		material = localStorage.getItem("Material").split(',');
		for(i=0; i < material.length; i++){
			total += parseFloat($("#"+material[i]+" .subtotal").text());
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