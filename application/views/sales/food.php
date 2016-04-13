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
				<table width="100%" class="data table-condensed table table-hover table-bordered">
					<thead>
					<tr>
						<th>Number</th>
						<th>Name</th>
					</tr>
					<tr>
						<td></td>
						<td></td>
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
				<table width="100%" class="data table-condensed table table-bordered table-hover">
					<thead>
					<tr>
						<th>Name</th>
						<th>Category</th>
						<th>Print Category</th>
						<th>Price</th>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
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
				<?php echo form_open('sales/food'); ?>
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
				<p class="total text-right form-inline">
					<div class="input-group">
						<span class="input-group-addon alert-warning total text-right">Total: <b><span>0</span></b></span>
						<span class="input-group-addon alert-info">VAT</span>
						<input onchange='vat_total()' type='number' value='0' class='form-control vat_field' name='vat'>
						<span class="input-group-addon alert-success vat_total text-right">Total ( VAT ): <b><span>0</span></b></span>
						<span class="input-group-addon alert-info">Service</span>
						<input onchange='service_total()' type='number' value='0' class='form-control service_field' name='service'>
						<span class="input-group-addon alert-warning service_total text-right">Total: <b><span>0</span></b></span>
					</div>
					<div class="input-group">
						<span class="input-group-addon alert-warning">Offer</span>
						<span class="input-group-addon commition_type checkbox alert-info">
							<label><input class="check" type='checkbox' name='commition_type'>Is Percent</label>
						</span>
						<input onchange='grand_total()' type='number' value='0' class='form-control grand_field' name='commition'>
						<span class="input-group-addon alert-success grand_total text-right">Grand Total: <b><span>0</span></b></span>
						<span class="input-group-addon alert-info">Payment</span>
						<input onchange='left_total()' type='number' value='0' class='form-control left_field' name='payment'>
						<span class="input-group-addon alert-danger left_total text-right">Due: <b><span>0</span></b></span>
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
		$("#"+id+" .subtotal").html(subtotal.toFixed(2));
		material = localStorage.getItem("Material").split(',');
		for(i=0; i < material.length; i++){
			total += parseFloat($("#"+material[i]+" .subtotal").text());
		}
		$(".total span").html(total.toFixed(2));
		vat_total();
	}
	
	function vat_total(){
		total = 0;
		material = localStorage.getItem("Material").split(',');
		for(i=0; i < material.length; i++){
			total += parseFloat($("#"+material[i]+" .subtotal").text());
		}
		total = (total + ( (total * parseFloat($(".vat_field").val())) / 100 ) );
		$(".vat_total span").html(total.toFixed(2));
		service_total();
	}
	
	function service_total(){
		total = 0;
		material = localStorage.getItem("Material").split(',');
		for(i=0; i < material.length; i++){
			total += parseFloat($("#"+material[i]+" .subtotal").text());
		}
		total = (total + ( (total * parseFloat($(".vat_field").val())) / 100 ) );
		total = (total + ( (total * parseFloat($(".service_field").val())) / 100 ));
		$(".service_total span").html(total.toFixed(2));
		grand_total();
	}
	
	function grand_total(){
		total = 0;
		material = localStorage.getItem("Material").split(',');
		for(i=0; i < material.length; i++){
			total += parseFloat($("#"+material[i]+" .subtotal").text());
		}
		total = (total + ( (total * parseFloat($(".vat_field").val())) / 100 ) );
		total = (total + ( (total * parseFloat($(".service_field").val())) / 100 ));
		if($(".commition_type").find("input:checked").val() != 'on'){
			total = (total - parseFloat($(".grand_field").val()));
		}else{
			total = (total - ( (total * parseFloat($(".grand_field").val())) / 100 ));
		}
		$(".grand_total span").html(total.toFixed(2));
		left_total();
	}
	
	function left_total(){
		total = 0;
		material = localStorage.getItem("Material").split(',');
		for(i=0; i < material.length; i++){
			total += parseFloat($("#"+material[i]+" .subtotal").text());
		}
		total = (total + ( (total * parseFloat($(".vat_field").val())) / 100 ) );
		total = (total + ( (total * parseFloat($(".service_field").val())) / 100 ));
		if($(".commition_type").find("input:checked").val() != 'on'){
			total = (total - parseFloat($(".grand_field").val()));
		}else{
			total = (total - ( (total * parseFloat($(".grand_field").val())) / 100 ));
		}
		total = (total - parseFloat($(".left_field").val()));
		$(".left_total span").html(total.toFixed(2));
	}
	
}else{
	alert(" Sorry! No Web Storage support.. " );
}
	
</script>