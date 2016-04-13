<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<main id="content">
	
	<br/>
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
		
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#Supplier">Supplier</a></li>
			<li><a data-toggle="tab" href="#Material">Material</a></li>
			<li class="pull-right">
				<a data-toggle="tab" href="#Sale" onclick="set_cart()" class="text-danger">
					<b class="Supplier">0</b> <span class="glyphicon glyphicon-user"></span>
					<b class="Material">0</b> <span class="glyphicon glyphicon-gift"></span>
				</a>
			</li>
		</ul>

		<div class="tab-content">
			<div id="Supplier" class="tab-pane fade in active">
				<p></p>
				<table width="100%" class="data table">
					<thead>
					<tr class="hidden">
						<th>Name</th>
						<th>Company</th>
						<th>Contact</th>
						<th>Comment</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($datas as $data): ?>
					<tr>
						<td><?php echo $data->name; ?></td>
						<td><?php echo $data->company; ?></td>
						<td><?php echo $data->contact; ?></td>
						<td><?php echo $data->comment; ?></td>
						<td><?php echo $data->address; ?></td>
						<td class="text-right">
							<button onclick="set_supplier('<?php echo $data->time; ?>');" class="btn btn-sm btn-success" type="button" ><span class="glyphicon glyphicon-ok"></span></button>
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div id="Material" class="tab-pane fade">
				<p></p>
				<table width="100%" class="data table">
					<thead>
					<tr class="hidden">
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
				<?php echo form_open('supplier/complete_slip'); ?>
				<table width="100%" class="table table-bordared">
					<thead>
					<tr class="hidden">
						<th>Name</th>
						<th>Category</th>
						<th>Quantity</th>
						<th>Subtotal</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				<p class="total text-right">Total:<span>0</span></p>
				<p class="total text-right form-inline">Commition:<input onchange='grand_total()' type='number' value='0' class='form-control grand_field' name=''></p>
				<p class="grand_total text-right">Grand Total:<span>0</span></p>
				<p class="total text-right form-inline">Payment:<input onchange='left_total()' type='number' value='0' class='form-control left_field' name=''></p>
				<p class="left_total text-right">Left to Pay:<span>0</span></p>
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
			data = '';
			for(i=0; i < material.length; i++){
				data += "<tr id='"+ material[i] +"'>";
				data += "<td>"+ ccs[material[i]]["name"] +"<input type='hidden' name='id[]' value='"+ material[i] +"'></td>";
				data += "<td>"+ ccs[material[i]]["category"] +"</td>";
				data += "<td>"+ ccs[material[i]]["price"] +"</td>";
				data += "<td><input onchange='calculate("+ material[i] +","+ ccs[material[i]]["price"] +",$(this).val())' style='width:80px' type='number' value='0' class='qty form-control' name='"+ material[i] +"'></td>";
				data += "<td class='subtotal'>0</td>";
				data += "<td><span onclick='remove_cart("+ material[i] +")' class='btn btn-xs btn-danger glyphicon glyphicon-remove'></span></td>";
				data += "</tr>";
			}
			$("#Sale tbody").html(data);
			if(localStorage.getItem("Supplier")){
				$(".Supplier").html(1);
			}
			if(localStorage.getItem("Material")){
				material = localStorage.getItem("Material").split(',');
				$(".Material").html(material.length);
			}
		}else{
			$("#Sale tbody").empty();
		}
	}
	
	function calculate(id,price,qty){
		total = 0;
		subtotal = (price * qty);
		$("#"+id+" .subtotal").html(subtotal);
		material = localStorage.getItem("Material").split(',');
		for(i=0; i < material.length; i++){
			total += (ccs[material[i]]["price"] * $("#"+material[i]+" .qty").val());
		}
		$(".total span").html(total);
		grand_total();
	}
	
	function grand_total(){
		total = 0;
		material = localStorage.getItem("Material").split(',');
		for(i=0; i < material.length; i++){
			total += (ccs[material[i]]["price"] * $("#"+material[i]+" .qty").val());
		}
		g_total = (total - $(".grand_field").val());
		$(".grand_total span").html(g_total);
		left_total();
	}
	
	function left_total(){
		total = 0;
		material = localStorage.getItem("Material").split(',');
		for(i=0; i < material.length; i++){
			total += (ccs[material[i]]["price"] * $("#"+material[i]+" .qty").val());
		}
		g_total = (total - $(".grand_field").val());
		l_total = (g_total - $(".left_field").val());
		$(".left_total span").html(l_total);
	}
	
}else{
	alert(" Sorry! No Web Storage support.. " );
}
	
</script>