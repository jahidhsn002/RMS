<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<main id="content">
	
	<div class="component">
		<div class="print_none btn-group btn-group-md" role="group">
			<a class="btn btn-success" href="<?php echo site_url('sales/food_print/'.$ids.'?query_type=time&&query='.$ids); ?>"><span class="glyphicon glyphicon-th-list"></span></a>
			<a class="btn btn-primary" href="<?php echo site_url('sales/food_print/'.$ids.'?query_type=table&&query='.$this->Db->get_relation('order', $ids, 'table')); ?>"><span class="glyphicon glyphicon-list-alt"></span></a>
			<?php foreach($prints as $print): ?>
				<a class="btn btn-info" href="<?php echo site_url('sales/food_print/'.$ids.'?query_type=time&&query='.$ids.'&&print='.$print->time); ?>"><span class="glyphicon glyphicon-print"></span></a>
			<?php endforeach; ?>
		</div>
		<div class="text-center"><img style="height:70px" src="<?php echo site_url('images/loogo.gif'); ?>"></div>
		<h4 class="text-center">Order Copy</h4>
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
			$table_id = $this->Db->get_relation('order', $ids, 'table');
			$number = $this->Db->get_relation('table', $table_id, 'number');
			$name = $this->Db->get_relation('table', $table_id, 'name');
			$total = 0;
			$total_item = 0;
		?>
		<?php echo form_open('sales/food_sale'); ?>
		<table class="table slip">
			<thead>
			<tr>
				<td colspan="4" class="text-center">House-24, Road-09, Block-Kha, Shekhertek PCCulture Housing Society,Mohammadpur, 1207 Dhaka, Bangladesh</td>
			</tr>
			<tr>
				<td colspan="2">
					Table Name<br/>
					Table Number<br/>
					<?php echo mdate('%d/%m/%Y', gmt_to_local($ids, 'UP6', FALSE)); ?><br/>
					<b>Invoice</b>
				</td>
				<td colspan="2" class="text-right">
					<?php echo $name; ?><br/>
					<?php echo $number; ?><br/>
					<?php echo mdate('%h:%i', gmt_to_local($ids, 'UP6', FALSE)); ?><br/>
					<b>#<?php echo $id; ?></b>
				</td>
			</tr>
			<tr>
				<th>Name</th>
				<?php if( ! isset($_GET['print'])): ?>
					<th>Price</th>
				<?php endif; ?>
				<th>Qty</th>
				<th class="text-right">Subtotal</th>
			</tr>
			</thead>
			<tbody>
		<?php
			foreach($datas as $data):
			$food = explode('|',$data->food);
			$qty = explode('|',$data->quantity);
			
			if(isset($_GET['query_type']) && isset($_GET['query'])):
				if($data->$_GET['query_type'] == $_GET['query']):
				for($i=0; $i<count($food); $i++):
				if(isset($_GET['print'])):
				if($this->Db->get_relation('food',$food[$i],'print') == $_GET['print']):
				$total += ($this->Db->get_relation('food',$food[$i],'price') * $qty[$i]);
				$total_item += $qty[$i];
		?>
			<tr>
				<td><?php echo $this->Db->get_relation('food',$food[$i],'name'); ?></td>
				<?php if( ! isset($_GET['print'])): ?>
					<td><?php echo $this->Db->get_relation('food',$food[$i],'price'); ?></td>
				<?php endif; ?>
				<td><?php echo $qty[$i]; ?></td>
				<td class="text-right"><?php echo ($this->Db->get_relation('food',$food[$i],'price') * $qty[$i]); ?></td>
			</tr>
		<?php 
				endif;
				else:
				$total += ($this->Db->get_relation('food',$food[$i],'price') * $qty[$i]);
				$total_item += $qty[$i];
		?>
			<input name="id[]" value="<?php echo $food[$i]; ?>" type="hidden">
			<input name="qty_<?php echo $food[$i]; ?>" value="<?php echo $qty[$i]; ?>" type="hidden">
			<tr>
				<td><?php echo $this->Db->get_relation('food',$food[$i],'name'); ?></td>
				<?php if( ! isset($_GET['print'])): ?>
					<td><?php echo $this->Db->get_relation('food',$food[$i],'price'); ?></td>
				<?php endif; ?>
				<td><?php echo $qty[$i]; ?></td>
				<td class="text-right"><?php echo ($this->Db->get_relation('food',$food[$i],'price') * $qty[$i]); ?></td>
			</tr>
		<?php 
				endif;
				endfor;
				endif;
			endif;
			endforeach;
		?>
			<tr>
				<td colspan="4" class="text-right">
					<b>
					
					<?php
						$out = '';
						$out .= 'Total Item: '.$total_item.'</br>';
						
						if(isset($_GET['commition']) && isset($_GET['payment']) && isset($_GET['service']) && isset($_GET['vat'])):
						
						$out .= 'Total: '.$total.'</br>';
						$t_vat = ($total + (($total * $_GET['vat'])/100));
						$t_ser = ($t_vat + (($total * $_GET['service'])/100));
						if(isset($_GET['commition_type'])){
							$t_com = ($t_ser - $_GET['commition']);
						}else{
							$t_com = ($t_ser - (($t_ser * $_GET['commition'])/100));
						}
						$t_pay = ($t_com - $_GET['payment']);
						
						$out .= 'VAT('.$_GET['vat'].'%): +'. round((($total * $_GET['vat'])/100), 2, PHP_ROUND_HALF_UP) .'</br>';
						//$out .= 'Grandtotal: '. $t_vat .'</br>';
						$out .= 'Service('.$_GET['service'].'%): +'.round((($t_vat * $_GET['service'])/100), 2, PHP_ROUND_HALF_UP).'</br>';
						//$out .= 'Grandtotal: '. $t_ser .'</br>';
						if(isset($_GET['commition_type'])){
							$out .= 'Offer: -'.$_GET['commition'].'<hr>';
						}else{
							$out .= 'Offer('.$_GET['commition'].'%): -'. round((($t_ser * $_GET['commition'])/100), 2, PHP_ROUND_HALF_UP) .'<hr>';
						}
						$out .= 'Grandtotal: '.round($t_com, 2, PHP_ROUND_HALF_UP).'</br>';
						$out .= 'Payment: - '.$_GET['payment'].'</br>';
						$out .= 'Left Money: '.round($t_pay, 2, PHP_ROUND_HALF_UP);
						
						endif;
						
						echo $out;
					?>
					</b>
				</td>
			</tr>
			</tbody>
		</table>
		<div class="text-right print_none">
			<?php if(isset($_GET['commition']) && isset($_GET['payment'])): ?>
				<input name="Table" value="<?php echo $_GET['query']; ?>" type="hidden">
				<input name="vat" value="<?php echo $_GET['vat']; ?>" type="hidden">
				<input name="service" value="<?php echo $_GET['service']; ?>" type="hidden">
				<input name="commition" value="<?php echo $_GET['commition']; ?>" type="hidden">
				<input name="payment" value="<?php echo $_GET['payment']; ?>" type="hidden">
				<?php if(isset($_GET['commition_type'])): ?>
					<input name="commition_type" value="on" type="hidden">
				<?php else: ?>
					<input name="commition_type" value="off" type="hidden">
				<?php endif; ?>
				<input type="submit" class="btn btn-warning" value="Complite Sale">
			<?php endif; ?>
		</div>
		</form>
		<div class="print_none">
			<p></p>
			<?php echo form_open('sales/food_print/'.$ids, array("class"=>"form-inline","method"=>"GET")); ?>
				<input name="query_type" value="table" type="hidden">
				<input name="query" value="<?php echo $this->Db->get_relation('order', $ids, 'table'); ?>" type="hidden">
				<?php if( ! isset($_GET['commition']) && ! isset($_GET['payment']) && ! isset($_GET['print'])): ?>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> VAT</span>
					<input class="form-control" value="0" name="vat" type="number">
					<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> Service Charge</span>
					<input class="form-control" value="0" name="service" type="number">
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> Commition</span>
					<span class="input-group-addon alert-info">
						<span class="commition_type checkbox">
							<label><input class="check" type='checkbox' name='commition_type'>Is Percent</label>
						</span>
					</span>
					<input class="form-control" value="0" name="commition" type="number">
					<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> Payment</span>
					<input class="form-control" value="0" name="payment" type="number">
				</div>
				<input class="form-control btn-success" type="submit">
				<?php endif; ?>
			</form>
		</div>
	</div>

</main>