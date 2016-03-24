
<ul class="animated shake list-group">
<?php if( $this->session->userdata('table_name') != ''){ ?>
	<li class="clearfix list-group-item item text-center"><h3><?php echo $this->session->userdata('table_name'); ?></h3></li>
<?php } ?>
<?php 
	$i = 1;
	$goods = '[';
?>
<?php $table = $this->session->userdata('table_id'); ?>
<?php foreach ($this->cart->contents() as $items): ?>

        <li class="clearfix list-group-item item">
                <a href="#" onclick="$('.order').load('<?php echo site_url('Shop/order/remove/'. $items['rowid']) .'/'. ( $items['qty']-1 ) ; ?>')" class="btn btn-sm btn-warning pull-right">Reduce</a>
				<span>
                        <?php echo $items['name']; ?>

                        <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                <span>
                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                                <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                        <?php endforeach; ?>
                                </span>

                        <?php endif; ?>

                </span>
				<hr/>
				<span class="badge"><?php echo $this->cart->format_number($items['subtotal']); ?></span>
				<p class=""><?php echo $this->cart->format_number($items['price']); ?> <span class="glyphicon glyphicon-remove"></span> <?php echo $items['qty']; ?></p>
        </li>
	<?php $goods .= '["' . $items['id'] . '",' . $items['qty'] . '],'; ?>
		
<?php $i++; ?>

<?php 
	endforeach;
	$goods .= ']';
?>
<?php if($this->cart->format_number($this->cart->total()) != 0.00): ?>
	<li class="clearfix list-group-item item">
        <span><strong>Total</strong></span>
        <span class="badge"><?php echo $this->cart->format_number($this->cart->total()); ?></span>
		<?php if( $this->session->userdata('table_name') != ''){ ?>
			<a href="#" onclick="complete()" class="btn btn-sm btn-success">Order</a> 
		<?php } ?>
		<a href="#" onclick="$('.order').load('<?php echo site_url('Shop/order/cancel'); ?>')" class="btn btn-sm btn-danger">Cancel</a>
	</li>
<?php endif; ?>
</ul>
<script>
	function complete(){
		$.post("<?php echo site_url('Shop/complete/'. $table ); ?>",
		{
			goods: <?php echo $goods; ?>
		},
		function(data, status){
			$('.order').html(data);
		});
	}
</script>