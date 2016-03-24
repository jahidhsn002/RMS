<?php
class Shop extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
	
	public function index(){
        $this->load->view('theme');
    }
	
    public function manue(){
		$out = '<div class="list-group">';
		$goods = $this->DB->get('goods');
		foreach($goods as $good){
			$out .= '<a href="#" onclick="';
			$out .= "$('.order').load('". site_url("Shop/order/add/" . $good->time ) ."')";
			$out .= '" class="list-group-item item">'. $good->name .'<span class="badge">';
			if($this->DB->get_relation('stock',$good->time,'special') == 'True'){
				$out .= $this->DB->get_relation('stock',$good->time,'price') .' TK</span><span class="badge" id="'. $good->time .'"> ';
			}else{
				$out .= $good->price .' TK</span><span class="badge" id="'. $good->time .'"> ';
			}
			$out .= $this->DB->get_relation('stock',$good->time,'quantity') .' LEFT</span></a>';
		}
		$out .= '</div>';
		$this->_output($out);
    }
	
	public function speacial(){
        $out = '<div class="list-group">';
		$goods = $this->DB->get_where('stock',array('special'=>'True'));
		foreach($goods as $good){
			$out .= '<a href="#" onclick="';
			$out .= "$('.order').load('". site_url("Shop/order/add/" . $good->time ) ."')";
			$out .= '" class="list-group-item item" >'. $this->DB->get_relation('goods',$good->time,'name') .'<span class="badge">';
			$out .= $good->price .' TK</span><span class="badge">';
			$out .= $good->quantity .' LEFT</span></a>';
		}
		$out .= '</div>';
		$this->_output($out);
    }
	
	public function table(){
        $out = '<div class="list-group">';
		$tables = $this->DB->get('table');
		foreach($tables as $table){
			if($table->status == 'Free'){
				$out .= '<a href="#" onclick="';
				$out .= "$('.order').load('". site_url("Shop/order/table/" . $table->time . '?name=' . str_replace(" ","%20",$table->name) ) ."')";
				$out .= '" class="list-group-item item">'. $table->name .'<span class="badge">';
				$out .= $table->status .'</span></a>';
			}else{	
				$out .= '<a href="#" onclick="" class="disabled list-group-item item">'. $table->name .'<span class="badge">';
				$out .= $table->status .'</span></a>';
			}
		}
		$out .= '</div>';
		$this->_output($out);
    }
	
	public function order($action = null, $time = null, $data = null){
		//session_destroy();
		if( $action == 'add' && $this->DB->get_relation('goods',$time,'name') != 'False' ):
			if($this->DB->get_relation('stock',$time,'special') == 'True'){
				$price = $this->DB->get_relation('stock',$time,'price');
			}else{
				$price = $this->DB->get_relation('goods',$time,'price');
			}
			$data = array(
					'id'      => $time,
					'qty'     => 1,
					'price'   => $price,
					'name'    => $this->DB->get_relation('goods',$time,'name')
			);

			$this->cart->insert($data);
		elseif( $action == 'remove' ):
			$data = array(
				'rowid' => $time,
				'qty'   => $data
			);

			$this->cart->update($data);
		elseif( $action == 'cancel' ):

			$this->cart->destroy();
			$this->session->unset_userdata('table_name');
			$this->session->unset_userdata('table_id');
		elseif( $action == 'table' ):
		
			$this->session->set_userdata('table_name', $_GET['name']);
			$this->session->set_userdata('table_id', $time);
		endif;
			$this->load->view('cart');
	
    }
	
	public function complete($table = null){

		if( $this->DB->get_relation('table',$table,'status') == 'Free' ):
			$goods = $_POST["goods"];
			$out = '<ul class="print_slip animated zoomInDown list-group print">';
			$items = array();
			$out .= '<li class="list-group-item text-center">Kitchen Copy <h4>' . $this->DB->get_relation('table',$table,'name') . '</h4>'. mdate('%d/%m/%Y - %h:%i', gmt_to_local(time(), 'UP6', FALSE)) . '</li>';
			foreach($goods as $good){
				if($this->DB->get_relation('goods',$good[0],'name') != 'False'){
					if( $this->DB->get_relation('stock',$good[0],'quantity') == 'False' || $this->DB->get_relation('stock',$good[0],'quantity') < $good[1]){
						$this->_output("<h3>". $this->DB->get_relation('goods',$good[0],'name') ."Stock Limit excides</h3>");
						$this->load->view('cart');
						return null;
					}else{
						$out .= '<li class="list-group-item">'. $this->DB->get_relation('goods',$good[0],'name') . '<span class="badge">' . $good[1] . '</span></li>';
						$items[] = implode("||",$good);
					}
				}else{
					$this->_output("<h3>Table Not Free</h3>");
					$this->load->view('cart');
					return null;
				}
			}
			$out .= '</ul>';
			$item =  implode("//",$items);
			$this->DB->insert( 'order', array( "time"=>$table, "goods" => $item ));
			$this->DB->update( 'table', $table, array( "status"=>"Booked" ));
			$this->cart->destroy();
			$this->session->unset_userdata('table_name');
			$this->session->unset_userdata('table_id');
			$this->_output( $out );
		else:
			$this->_output("<h3>Table Not Free</h3>");
			$this->load->view('cart');
		endif;
		
    }
	
	public function _output($output){
        print_r( $output );
	}
}