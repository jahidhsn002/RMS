<div style="width:300px;text-transform:capitalize;font-family: monospace;padding:10px;">
	<center>
		<div><img width="200px" src="<?php echo site_url('images/loogo.gif'); ?>"></div>
		<h3>Customer Slip</h3>
		<div>
			<div style="text-align:left"><b>Customer Name: <?php echo $customer; ?></b></div><br/>
			<div style="text-align:left">Table <?php echo $this->DB->get_relation('table', $time, 'number'); ?><span style="float:right">Sohel: FilmyCafe</span></div>
			<div style="text-align:left"><?php echo mdate('%d/%m/%Y', gmt_to_local(time(), 'UP6', FALSE)); ?><span style="float:right"><?php echo mdate('%h:%i', gmt_to_local(time(), 'UP6', FALSE)); ?></span></div>
		</div>
		<hr/>
	<table width="100%">
		<tr>
			<th style="text-align:left">Name</th>
			<th style="text-align:center">Qty</th>
			<th style="text-align:center">Rate</th>
			<th style="text-align:right">Total</th>
		</tr>
		<?php
			$count = 0;
			$total = 0;
			$subtotal = 0;
			foreach($tables as $table): 
			$v3 = explode('//',$table->goods);
			foreach($v3 as $v2):
				$good = explode('||',$v2);
				$count++ ;
				$total += $good[1];
				$left = ($this->DB->get_relation('stock',$good[0],'quantity')-$good[1]);
				$this->DB->update('stock',$good[0],array('quantity'=>$left));
				$price = $this->DB->get_relation('goods', $good[0], 'price');
				if($this->DB->get_relation('stock', $good[0], 'special') == 'True'):
					$price = $this->DB->get_relation('stock', $good[0], 'price');
				endif;
				$subtotal += ($price * $good[1]);
		?>
		<tr>
			<td style="text-align:left"><?php echo $this->DB->get_relation('goods', $good[0], 'name'); ?></td>
			<td style="text-align:right"><?php echo $good[1]; ?></td>
			<td style="text-align:right"><?php echo $price; ?></td>
			<td style="text-align:right"><?php echo ($price * $good[1]); ?></td>
		</tr>
		<?php		
				
			endforeach;
			endforeach;
		?>
	</table>
	<?php

		$free = 0;
		if($type == 'Parcantage'){
			$free = ($subtotal/100)*$parcantage;
		}if($type == 'Menual'){
			$free = $menual;
		}
	
	?>
		<hr/>
		<div style="text-align:right">Item: <?php echo $count; ?> | Total: <?php echo $total; ?></div>
		<div style="text-align:right">Sub Total: BDT : <?php echo $subtotal; ?></div>
		<div style="text-align:right">-<?php echo $name .' '. $parcantage; ?>% : <?php echo $free; ?></div>
		<div style="text-align:right">Grand Total: <?php echo ($subtotal - $free); ?></div>
		<br/>
		<div style="text-align:center">Powerd by hubdrive.net</div>
		<br/>
	</center>
	<?php
		
		$this->DB->insert('order_history',array('time'=>time(), 'name'=>$customer, 'sale'=>($subtotal - $free)));
		$this->DB->trash('order',$time);
	
	?>
</div>