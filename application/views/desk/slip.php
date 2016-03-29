<div style="width:300px;text-transform:capitalize;font-family: monospace;padding:10px;">
	<center>
		<div><img width="200px" src="<?php echo site_url('images/loogo.gif'); ?>"></div>
		<h3><?php echo $type; ?> Slip</h3>
		<div>
			<div style="text-align:left">Table <?php echo $this->DB->get_relation('table', $time, 'number'); ?><span style="float:right">Waiter: FilmyCafe</span></div>
			<div style="text-align:left"><?php echo mdate('%d/%m/%Y', gmt_to_local(time(), 'UP6', FALSE)); ?><span style="float:right"><?php echo mdate('%h:%i', gmt_to_local(time(), 'UP6', FALSE)); ?></span></div>
		</div>
		<hr/>
	<table width="100%">
		<tr>
			<th style="text-align:left">Name</th>
			<th style="text-align:right">Qty</th>
		</tr>
		<?php
			$count = 0;
			$total = 0;
			foreach($tables as $table): 
			$v3 = explode('//',$table->goods);
			foreach($v3 as $v2):
				$good = explode('||',$v2);
				if($this->DB->get_relation('goods', $good[0], 'print') == $type):
				$count++ ;
				$total += $good[1];
		?>
		<tr>
			<td style="text-align:left"><?php echo $this->DB->get_relation('goods', $good[0], 'name'); ?></td>
			<td style="text-align:right"><?php echo $good[1]; ?></td>
		</tr>
		<?php		
				endif;
			endforeach;
			endforeach;
		?>
	</table>
		<hr/>
		<div style="text-align:right">Item: <?php echo $count; ?> | Total: <?php echo $total; ?></div>
		<br/>
		<div style="text-align:center">Powerd by hubdrive.net</div>
		<br/>
	</center>
</div>