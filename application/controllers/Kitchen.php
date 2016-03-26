<?php
class Kitchen extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
	
	public function index(){
        $this->load->view('kitchen');
    }
	
	public function order(){
		$out = '<div class="list-group">';
		$out .= '<span class="list-group-item text-center">Orders</span>';
		$values = $this->DB->get('order');
		foreach($values as $value){
			$out .= '<a href="#" onclick="';
			$out .= "$('.slip').load('". site_url("Kitchen/view/" . $value->time) . "')";
			$out .= '" class="list-group-item item">'. $this->DB->get_relation('table', $value->time, 'name');
			$out .= '<span class="badge">' . $this->DB->get_relation('table', $value->time, 'status') .'</span></a>';
		}
		$out .= '</div>';
		$this->_output($out);
    }
	
	public function view($time = null, $action = null){
		if($action == 'Searved'){
			$this->DB->update( 'table', $time, array( "status"=>"Searved" ));
		}
		$out = '<ul class="list-group">';
		$out .= '<li class="list-group-item text-center">Kitchen Copy <br/>'. mdate('%d/%m/%Y - %h:%i', gmt_to_local(time(), 'UP6', FALSE)) . '<hr/>' . $this->DB->get_relation('table',$time,'name') . '</li>';
		$values = $this->DB->get_where('order', array( 'time' => $time ));
		
		foreach($values as $value){
			$v3 = explode('//',$value->goods);
			foreach($v3 as $v2){
				$good = explode('||',$v2);
				$out .= '<li class="list-group-item item">'. $this->DB->get_relation('goods', $good[0], 'name') . '<span class="badge">' . $good[1]  .'</span></li>';
				if($action == 'Searved'){
					$prev = $this->DB->get_relation('stock', $good[0], 'quantity');
					$next = ($prev - $good[1]);
					$this->DB->update( 'stock', $good[0], array( "quantity"=>$next ));
				}
			}
		}
		
		if($this->DB->get_relation('table', $time, 'status') == 'Booked'){
			$out .= '<li class="list-group-item text-center hide_print"><a href="#" onclick="';
			$out .= "$('.slip').load('". site_url("Kitchen/view/" . $time . "/Searved") . "')";
			$out .= '" class="btn btn-info">Searve</a></li>';
		}
		$out .= '</ul>';
		$this->_output($out);
    }
	
	public function _output($output){
        print_r( $output );
	}
}