<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sales extends CI_Controller {
	
    public function index(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('salse', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('table');
		$data['datas2'] = $this->Db->get('food');
		
        $this->load->view('theme/header',$data);
		$this->load->view('sales/food',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function waiter(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('waiter', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('table');
		$data['datas2'] = $this->Db->get('food');
		
        $this->load->view('theme/header',$data);
		$this->load->view('sales/waiter',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function order(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('salse', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('order');
		
        $this->load->view('theme/header',$data);
		$this->load->view('sales/order',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function trash($data = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; //$data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('salse', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->Db->trash('order',$data);
		
		redirect('sales/order?Eror='. 'Order Deleter' , 'refresh');
		
    }
	
	public function combine($table = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('salse', $access)){ show_404(); }
		}else{ show_404(); }
		
		if($this->Db->get_relation('table',$table,'name') != null){
			$this->Db->update('order', $table, array('status'=>'bill'));
			redirect('sales/order?Success='. 'Combined' , 'refresh');
		}else{redirect('sales/order?Eror='. 'Not a Order' , 'refresh');}
    }
	
	public function food_history(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('history', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('order_history');
		
        $this->load->view('theme/header',$data);
		$this->load->view('sales/food_history',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function place_order(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('waiter', $access)){ show_404(); }
		}else{ show_404(); }
		
		$qty = array();
		$total = 0;
		$profit = 0;
		$invoice = time();
		if(isset($_POST['Table']) && isset($_POST['id'])){
		if($this->Db->get_relation('table',$_POST['Table'],'name') != 'False'){
			$ids = $_POST['id'];
			foreach($ids as $id){
				$qty[] = $_POST['qty_' . $id];
			}
			$this->Db->insert('order', array(
				'time' => $invoice,
				'table' => $_POST['Table'],
				'food' => implode('|',$ids),
				'quantity'=> implode('|',$qty),
				'status'=> 'ordering'
			));
			redirect('sales/waiter?Success='. 'Order Placed' , 'refresh');
		}else{redirect('sales/waiter?Eror='. 'Not a Supplier' , 'refresh');}
		}else{redirect('sales/waiter?Eror='. 'No Supplier Selected' , 'refresh');}
    }
	
	public function food_print( $ids = null ){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('salse', $access)){ show_404(); }
		}else{ show_404(); }
		
		if($this->Db->get_relation('order',$ids,'table') != null){
			$data['Eror'] = null;
			$data['Back'] = 'home';
			$data['Success'] = null;
			$data['prints'] = $this->Db->get('print');
			$data['ids'] = $ids;
			if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
			if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
			$data['datas'] = $this->Db->get('order');

			$this->load->view('theme/header',$data);
			$this->load->view('sales/multi_slip',$data);
			$this->load->view('theme/footer',$data);
		}else{redirect('sales/order?Eror='. 'Not a Order' , 'refresh');}
    }
	
	public function food(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('salse', $access)){ show_404(); }
		}else{ show_404(); }
		
		$out = '';
		$qty = array();
		$total = 0;
		$profit = 0;
		$invoice = time();
		if(isset($_POST['Table']) && isset($_POST['id'])){
		if($this->Db->get_relation('table',$_POST['Table'],'name') != 'False'){
			$number = $this->Db->get_relation('table',$_POST['Table'],'number');
			$name = $this->Db->get_relation('table',$_POST['Table'],'name');
		
			$ids = $_POST['id'];
			$out .= '<table class="table slip">';
			$out .= '<thead><tr>';
			$out .= '<td colspan="4" class="text-center">House-24, Road-09, Block-Kha, Shekhertek PCCulture Housing Society,Mohammadpur, 1207 Dhaka, Bangladesh</td>';
			$out .= '</tr><tr>';
			$out .= '<td colspan="2">';
			$out .= 'Table Name<br/>';
			$out .= 'Table Number<br/>';
			$out .= mdate('%d/%m/%Y', gmt_to_local($invoice, 'UP6', FALSE)) . '<br/>';
			$out .= '<b>Invoice</b>';
			$out .= '</td>';
			$out .= '<td colspan="2" class="text-right">';
			$out .= $name.'<br/>';
			$out .= $number.'<br/>';
			$out .= mdate('%h:%i', gmt_to_local($invoice, 'UP6', FALSE)).'<br/>';
			$out .= '<b>#'.$invoice.'</b>';
			$out .= '</td>';
			$out .= '</tr><tr>';
			$out .= '<th>Name</th>';
			$out .= '<th>Price</th>';
			$out .= '<th>Qty</th>';
			$out .= '<th class="text-right">Subtotal</th>';
			$out .= '</tr></thead><tbody>';
			foreach($ids as $id){
				$qty[] = $_POST['qty_' . $id];
				$total += ($_POST['qty_' . $id] * $this->Db->get_relation('food',$id,'price'));
				$profit += (($this->Db->get_relation('food',$id,'price') - $this->Db->get_relation('stock',$id,'price')) * $_POST['qty_' . $id]);
				$prev = $this->Db->get_relation('stock',$id,'quantity');
				$next = ($prev - $_POST['qty_' . $id]);
				$this->Db->update('stock',$id,array(
					'quantity'=>round($next, 2, PHP_ROUND_HALF_UP)
				));
				$out .= '<tr><td>'. $this->Db->get_relation('food',$id,'name') .'</td>';
				$out .= '<td>'. $this->Db->get_relation('food',$id,'price') .'</td>';
				$out .= '<td>'. $_POST['qty_' . $id] .'</td>';
				$out .= '<td class="text-right">'. ($_POST['qty_' . $id] * $this->Db->get_relation('food',$id,'price')) .'</td></tr>';
			}
			$t_vat = ($total + (($total * $_POST['vat'])/100));
			$t_ser = ($t_vat + (($t_vat * $_POST['service'])/100));
			if(!isset($_POST['commition_type'])){
				$t_com = ($t_ser - $_POST['commition']);
			}else{
				$t_com = ($t_ser - (($t_ser * $_POST['commition'])/100));
			}
			$t_pay = ($t_com - $_POST['payment']);
			$out .= '<tr><td colspan="4" class="text-right"><b>';
			$out .= 'Total: '.$total.'</br>';
			$out .= 'VAT('.$_POST['vat'].'%): +'. round((($total * $_POST['vat'])/100), 2, PHP_ROUND_HALF_UP) .'</br>';
			//$out .= 'Grandtotal: '. $t_vat .'</br>';
			$out .= 'Service('.$_POST['service'].'%): +'.round((($t_vat * $_POST['service'])/100), 2, PHP_ROUND_HALF_UP).'</br>';
			//$out .= 'Grandtotal: '. $t_ser .'</br>';
			if(!isset($_POST['commition_type'])){
				$out .= 'Offer: -'.$_POST['commition'].'<hr>';
			}else{
				$out .= 'Offer('.$_POST['commition'].'%): -'. round((($t_ser * $_POST['commition'])/100), 2, PHP_ROUND_HALF_UP) .'<hr>';
			}
			$out .= 'Grandtotal: '.round($t_com, 2, PHP_ROUND_HALF_UP).'</br>';
			$out .= 'Payment: - '.$_POST['payment'].'</br>';
			$out .= 'Left Money: '.round($t_pay, 2, PHP_ROUND_HALF_UP);
			$out .= '</b></td></tr>';
			$out .= '</tbody></table>';
			$this->Db->insert('order_history', array(
				'time' => $invoice,
				'table' => $name,
				'table_no' => $number,
				'food' => implode('|',$ids),
				'quantity'=> implode('|',$qty),
				'bill'=> round(($t_com), 2, PHP_ROUND_HALF_UP),
				'paid'=> round($t_pay, 2, PHP_ROUND_HALF_UP),
				'profit'=> round($profit, 2, PHP_ROUND_HALF_UP)
			));
			$data['Eror'] = null;
			$data['Back'] = 'sales';
			$data['Success'] = null;
			if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
			if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
			$data['datas'] = $this->Db->get('supplier');
			$data['datas2'] = $this->Db->get('material');
			$data['out'] = $out;

			$this->load->view('theme/header',$data);
			$this->load->view('sales/slip',$data);
			$this->load->view('theme/footer',$data);
		}else{redirect('supplier/material?Eror='. 'Not a Supplier' , 'refresh');}
		}else{redirect('supplier/material?Eror='. 'No Supplier Selected' , 'refresh');}
    }
	
	public function food_sale(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('salse', $access)){ show_404(); }
		}else{ show_404(); }
		
		$qty = array();
		$total = 0;
		$profit = 0;
		$invoice = time();
		if(isset($_POST['Table']) && isset($_POST['id'])){
		if($this->Db->get_relation('table',$_POST['Table'],'name') != 'False'){
			$number = $this->Db->get_relation('table',$_POST['Table'],'number');
			$name = $this->Db->get_relation('table',$_POST['Table'],'name');
		
			$ids = $_POST['id'];
			foreach($ids as $id){
				$qty[] = $_POST['qty_' . $id];
				$total += ($_POST['qty_' . $id] * $this->Db->get_relation('food',$id,'price'));
				$profit += (($this->Db->get_relation('food',$id,'price') - $this->Db->get_relation('stock',$id,'price')) * $_POST['qty_' . $id]);
				$prev = $this->Db->get_relation('stock',$id,'quantity');
				$next = ($prev - $_POST['qty_' . $id]);
				$this->Db->update('stock',$id,array(
					'quantity'=>round($next, 2, PHP_ROUND_HALF_UP)
				));
			}
			
			$t_vat = ($total + (($total * $_POST['vat'])/100));
			$t_ser = ($t_vat + (($t_vat * $_POST['service'])/100));
			if($_POST['commition_type'] != 'on'){
				$t_com = ($t_ser - $_POST['commition']);
			}else{
				$t_com = ($t_ser - (($t_ser * $_POST['commition'])/100));
			}
			$t_pay = ($t_com - $_POST['payment']);
			
			$this->Db->insert('order_history', array(
				'time' => $invoice,
				'table' => $name,
				'table_no' => $number,
				'food' => implode('|',$ids),
				'quantity'=> implode('|',$qty),
				'bill'=> round(($t_com), 2, PHP_ROUND_HALF_UP),
				'paid'=> round($t_pay, 2, PHP_ROUND_HALF_UP),
				'profit'=> round($profit, 2, PHP_ROUND_HALF_UP)
			));
			
			$this->Db->trash_where('order', array('table' => $_POST['Table']));
			redirect('sales/order?Success='. 'Order Complited' , 'refresh');
		}else{redirect('sales/order?Eror='. 'Not a Supplier' , 'refresh');}
		}else{redirect('sales/order?Eror='. 'No Supplier Selected' , 'refresh');}
    }

}