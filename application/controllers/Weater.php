<?php
	
class Weater extends CI_Controller {

    public function index(){
		$data['eror'] = '';
		$data['tables'] = $this->DB->get('table');
		$this->load->view('weater/table',$data);
    }
	
	public function order($table_id = ''){
		if($this->DB->get_relation('table',$table_id,'name') != 'False'):
			$this->session->set_userdata('table_id', $table_id);
			$data['id'] = $table_id;
			$data['eror'] = '';
			$data['tables'] = $this->DB->get('table');
			$this->load->view('weater/order',$data);
		else:
			$data['eror'] = 'Table Not Found';
			$data['tables'] = $this->DB->get('table');
			$this->load->view('weater/table',$data);
		endif;
    }
	
	public function goods($eror = ''){
		$data['eror'] = $eror;
		$data['tables'] = $this->DB->get('goods');
		$this->load->view('weater/goods',$data);
    }
	
	public function special($eror = ''){
		$data['eror'] = $eror;
		$data['tables'] = $this->DB->get_where('stock',array('special'=>'True'));
		$this->load->view('weater/special',$data);
    }
	
	public function set($action = null, $time = null, $amount = null){
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
				'qty'   => $amount
			);

			$this->cart->update($data);
		elseif( $action == 'cancel' ):

			$this->cart->destroy();
		
		endif;
			$this->load->view('weater/cart');
	
    }
	
	public function complete($table = null){

		$goods = $_POST["goods"];
		$out = '<div class="alert alert-success">Order Submitted Successfully</div>';
		$items = array();
		foreach($goods as $good){
			$items[] = implode("||",$good);
		}
		$item =  implode("//",$items);
		$this->DB->insert( 'order', array( "id"=>time(), "time"=>$table, "goods" => $item, "status"=>"Booked" ));
		$this->cart->destroy();
		$this->_output( $out );
		
    }
	
	public function bill($table = null){

		$out = '<div class="alert alert-success">Order Submitted Successfully</div>';
		$this->DB->update( 'order', $table, array( "status"=>'Cashout' ));
		$this->cart->destroy();
		$this->_output( $out );
		
    }
	
	public function _output($output){
        print_r( $output );
	}
	
}
	
?>