<?php
class Desk extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
	
	public function index(){
        $this->load->view('desk');
    }
	
	public function order(){
		$out = '<div class="animated zoomInDown list-group">';
		$out .= '<span class="list-group-item text-center"><h4>Orders</h4></span>';
		$values = $this->DB->get('order');
		foreach($values as $value){
			$out .= '<a href="#" onclick="';
			$out .= "$('.slip').load('". site_url("Desk/view/" . $value->time) . "')";
			$out .= '" class="list-group-item item">'. $this->DB->get_relation('table', $value->time, 'name');
			$out .= '<span class="badge">' . $this->DB->get_relation('table', $value->time, 'status') .'</span></a>';
		}
		$out .= '</div>';
		$this->_output($out);
    }
	
	public function view($time = null, $action = null){
		$out = '';
		if($action == 'Complete' && isset($_GET['name']) && isset($_GET['commision'])){
			$out = '<ul class="print_slip animated zoomInDown list-group">';
			$out .= '<li class="list-group-item text-center">Customer Copy <h4>' . $_GET['name'] . '</h4>'. mdate('%d/%m/%Y - %h:%i', gmt_to_local(time(), 'UP6', FALSE)) . '</li>';
		}else{
			$out = '<ul class="animated zoomInDown list-group">';
			$out .= '<li class="list-group-item text-center"><h4>'. $this->DB->get_relation('table',$time,'name') . '</h4></li>';
		}
		$values = $this->DB->get_where('order', array( 'time' => $time ));
		$total = 0;
		foreach($values as $value){
			$v3 = explode('//',$value->goods);
			foreach($v3 as $v2){
				$good = explode('||',$v2);
				$price = $this->DB->get_relation('goods', $good[0], 'price');
				if($this->DB->get_relation('stock', $good[0], 'special') == 'True'){
					$price = $this->DB->get_relation('stock', $good[0], 'price');
				}
				$out .= '<li class="list-group-item clearfix"><span class="badge">' . $price  .' <span class="glyphicon glyphicon-remove"></span> '. $good[1] .'</span>'. $this->DB->get_relation('goods', $good[0], 'name') . '<hr/><span class="badge">' . ($price * $good[1])  .' /-</span></li>';
				$total += ($price * $good[1]);
			}
		}
		
		if($this->DB->get_relation('table', $time, 'status') == 'Searved'){
			$out .= '<li class="list-group-item clearfix form-inline print">';
			if($action != 'Complete' && !isset($_GET['name']) && !isset($_GET['commision'])){
				$out .= '<input id="customer_name" type="text" class="form-control" placeholder="Customer Name"> ';
				$out .= '<input id="commision" min="0" max="' . $total  .'" type="number" class="form-control" placeholder="Commision"> ';
				$out .= '<span class="badge">Total = ' . $total  .' /-</span>';
				$out .= '<a id="submit" href="#" onclick="" class="btn btn-sm btn-info">Searve</a>';
			}else{
				$out .= '<span class="badge">Total = ' . ($total-$_GET['commision'])  .' /-</span> <span class="badge">( Commision : ' . $_GET['commision'] . '/- )</span>';
			}
		}
		$out .= '</li></ul>';
		if($action != 'Complete' && !isset($_GET['name']) && !isset($_GET['commision'])){
			$out .= '<script>
				$("#customer_name").change(function(){
					var acc = $("#commision").val();
					var bcc = $("#customer_name").val();
					var cc = "$('."'".'.slip'."'".').load('."'". site_url("Desk/view/". $time ."/Complete") .'?commision="+acc+"&&name="+bcc+"'."'".')";
					$("#submit").attr("onclick", cc );
				});
				$("#commision").change(function(){
					var acc = $("#commision").val();
					var bcc = $("#customer_name").val();
					var cc = "$('."'".'.slip'."'".').load('."'". site_url("Desk/view/". $time ."/Complete") .'?commision="+acc+"&&name="+bcc.replace(" ", "%20")+"'."'".')";
					$("#submit").attr("onclick", cc );
				});
				</script>';
		}else{
			if($_GET['commision'] == ''){
				$_GET['commision'] = 0;
			}
			if($_GET['commision'] > $total){
				$out = '<ul class="list-group"><li class="list-group-item">Your Commision Is Bigger then Bill</li></ul>';
			}else{
				$this->DB->insert( 'order_history', array( "time"=>time(), "name"=>$_GET['name'], "sale"=> ($total-$_GET['commision'])));
				$this->DB->trash( 'order', $time);
				$this->DB->update( 'table', $time, array( "status"=>"Free" ));
			}
		}
		$this->_output($out);
    }
	
	public function _output($output){
        print_r( $output );
	}
}