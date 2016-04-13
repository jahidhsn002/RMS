<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supplier extends CI_Controller {

    public function index(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('perchase/material', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('supplier');
		
        $this->load->view('theme/header',$data);
		$this->load->view('supplier/view',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function add(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('perchase/material', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->form_validation->set_rules('name', 'Name', 'required|alpha_numeric_spaces|max_length[50]');
		$this->form_validation->set_rules('company', 'Company', 'required|alpha_numeric_spaces|max_length[50]');
		$this->form_validation->set_rules('contact', 'Contact', 'numeric|max_length[25]');
		$this->form_validation->set_rules('comment', 'Comment', 'alpha_numeric_spaces|max_length[150]');
		$this->form_validation->set_rules('address','Address', 'alpha_numeric_spaces|max_length[150]');
		
		$data['Eror'] = null;
		$data['Back'] = 'supplier';
		$data['Success'] = null;
		
		if ($this->form_validation->run() == FALSE){
            $data['Eror'] = validation_errors();
        }else{
			$array = array(
				'time' => time(),
				'name' => $_POST['name'],
				'company' => $_POST['company'],
				'contact' => $_POST['contact'],
				'comment' => $_POST['comment'],
				'address' => $_POST['address']
			);
			$msg = $this->Db->insert('supplier',$array);
            if($msg == 'True'){
				$data['Success'] = 'Supplier Added';
			}else{
				$data['Eror'] = $msg;
			}
		}
		
		$this->load->view('theme/header',$data);
		$this->load->view('supplier/add',$data);
		$this->load->view('theme/footer',$data);
		
    }
	
	public function edit($time = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('perchase/material', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->form_validation->set_rules('name', 'Name', 'required|alpha_numeric_spaces|max_length[50]');
		$this->form_validation->set_rules('company', 'Company', 'required|alpha_numeric_spaces|max_length[50]');
		$this->form_validation->set_rules('contact', 'Contact', 'numeric|max_length[25]');
		$this->form_validation->set_rules('comment', 'Comment', 'alpha_numeric_spaces|max_length[150]');
		$this->form_validation->set_rules('address','Address', 'alpha_numeric_spaces|max_length[150]');
		
		$data['Eror'] = null;
		$data['Back'] = 'supplier';
		$data['Success'] = null;
		
		if ($this->form_validation->run() == FALSE){
            $data['Eror'] = validation_errors();
        }else{
			if($this->Db->get_relation('supplier', $time, 'name') != 'False'){
				$array = array(
					'name' => $_POST['name'],
					'company' => $_POST['company'],
					'contact' => $_POST['contact'],
					'comment' => $_POST['comment'],
					'address' => $_POST['address']
				);
				$msg = $this->Db->update('supplier', $_POST['time'], $array);
				if($msg == 'True'){
					$data['Success'] = 'Supplier Edited';
				}else{
					$data['Eror'] = $msg;
				}
			}else{
				$data['Eror'] = 'Supplier ID not found';
			}
		}
		
		$data['time'] = $time;
		
		$this->load->view('theme/header', $data);
		$this->load->view('supplier/edit', $data);
		$this->load->view('theme/footer', $data);
		
    }
	
	public function trash($time = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('perchase/material', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Success'] = null;
		$delete = array(
			'time' => $time
		);

		$this->form_validation->set_data($delete);
		$this->form_validation->set_rules('time', 'ID', 'required|numeric|max_length[20]'	);
		
		if ($this->form_validation->run() == FALSE){
			$data['Eror'] = validation_errors();
        }else{
			$msg = $this->Db->trash('supplier', $time);
			if($msg == 'True'){
				$data['Success'] = 'Deleted';
				redirect('supplier?Success='. $data['Success'] , 'refresh');
			}else{
				$data['Eror'] = $msg;
			}
		}
		redirect('supplier?Eror='. $data['Eror'] , 'refresh');
    }
	
	public function material(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('perchase/material', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('supplier');
		$data['datas2'] = $this->Db->get('material');
		
        $this->load->view('theme/header',$data);
		$this->load->view('supplier/material',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function kitchen(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('praper/food', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('food');
		$data['datas2'] = $this->Db->get('material');
		
        $this->load->view('theme/header',$data);
		$this->load->view('supplier/kitchen',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function cock_food(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('praper/food', $access)){ show_404(); }
		}else{ show_404(); }
		
		if(isset($_POST['food']) && isset($_POST['food_qty']) && isset($_POST['id'])){
			if($this->Db->get_relation('food',$_POST['food'],'name') != 'False'){
				$total = 0;
				$price = 0;
				$qty = array();
				$ids = $_POST['id'];
				foreach($ids as $id){
					$prev = $this->Db->get_relation('prestock', $id, 'quantity');
					$next = round(( $prev - $_POST[ 'qty_' . $id ] ), 2, PHP_ROUND_HALF_UP);
					$this->Db->update('prestock', $id, array('quantity' => $next));
					$total += $_POST[ 'qty_' . $id ];
					$qty[] = $_POST[ 'qty_' . $id ];
					$price += $this->Db->get_relation('prestock', $id, 'price');
				}
				
				$pre_food_qty = $this->Db->get_relation('stock', $_POST['food'], 'quantity');
				$pre_food_price = $this->Db->get_relation('stock', $_POST['food'], 'price');
				$post_food_qty = ( $pre_food_qty + $_POST['food_qty'] );
				if($pre_food_qty == 0 || $pre_food_price == 0){
					$post_food_price = round(($price / $_POST['food_qty']), 2, PHP_ROUND_HALF_UP);
					$this->Db->update('stock', $_POST['food'], array('quantity' => $_POST['food_qty'],'price' => $post_food_price));
				}else{
					$post_food_price = round((( ($pre_food_price * $pre_food_qty) + ($price * $_POST['food_qty']) ) / $post_food_qty), 2, PHP_ROUND_HALF_UP);
					$this->Db->update('stock', $_POST['food'], array('quantity' => round($post_food_qty, 2, PHP_ROUND_HALF_UP),'price' => $post_food_price));
				}
				
				$this->Db->insert('coock_history', array(
					'time' => time(),
					'food' => $_POST['food'],
					'food_qty' => round($_POST['food_qty'], 2, PHP_ROUND_HALF_UP),
					'material' => implode('|',$ids),
					'qty' => implode('|',$qty),
					'total' => round($total, 2, PHP_ROUND_HALF_UP)
				));
				redirect('supplier/kitchen?Success='. 'Food Coocked' , 'refresh');
			}else{
				redirect('supplier/kitchen?Eror='. 'That is not a Food' , 'refresh');
			}
		}else{
			redirect('supplier/kitchen?Eror='. 'No Food Selected' , 'refresh');
		}
    }
	
	public function complete_slip(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('perchase/material', $access)){ show_404(); }
		}else{ show_404(); }
		
		$out = '';
		$qty = array();
		$total = 0;
		$invoice = time();
		if(isset($_POST['Supplier']) && isset($_POST['id'])){
		if($this->Db->get_relation('supplier',$_POST['Supplier'],'name') != 'False'){
			$supplier = $this->Db->get_relation('supplier',$_POST['Supplier'],'name');
			$contact = $this->Db->get_relation('supplier',$_POST['Supplier'],'contact');
			$company = $this->Db->get_relation('supplier',$_POST['Supplier'],'company');
		
			$ids = $_POST['id'];
			$out .= '<table class="table slip">';
			$out .= '<thead><tr>';
			$out .= '<td colspan="4" class="text-center">House-24, Road-09, Block-Kha, Shekhertek PCCulture Housing Society,Mohammadpur, 1207 Dhaka, Bangladesh</td>';
			$out .= '</tr><tr>';
			$out .= '<td colspan="2">';
			$out .= 'Name<br/>';
			$out .= 'Phone<br/>';
			$out .= 'Company<br/>';
			$out .= mdate('%d/%m/%Y', gmt_to_local(time(), 'UP6', FALSE)) . '<br/>';
			$out .= '<b>Invoice</b>';
			$out .= '</td>';
			$out .= '<td colspan="2" class="text-right">';
			$out .= $supplier.'<br/>';
			$out .= $contact.'<br/>';
			$out .= $company.'<br/>';
			$out .= mdate('%h:%i', gmt_to_local(time(), 'UP6', FALSE)).'<br/>';
			$out .= '<b>#'.$invoice.'</b>';
			$out .= '</td>';
			$out .= '</tr><tr>';
			$out .= '<th>Name</th>';
			$out .= '<th>Price</th>';
			$out .= '<th>Qty</th>';
			$out .= '<th class="text-right">Subtotal</th>';
			$out .= '</tr></thead><tbody>';
			foreach($ids as $id){
				$qty[] = $_POST['qty_'.$id];
				$get_qty = $this->Db->get_relation('prestock',$id,'quantity');
				$get_price = $this->Db->get_relation('prestock',$id,'price');
				if($get_qty == 0 || $get_price == 0){
					$final_qty = round($_POST['qty_'.$id], 2, PHP_ROUND_HALF_UP);
					$final_price = round($_POST['price_'.$id], 2, PHP_ROUND_HALF_UP);
				}else{
					$get_total = ($get_qty * $get_price);
					$post_total = ($_POST['qty_'.$id] * $_POST['price_'.$id]);
					$final_qty = round(($get_qty + $_POST['qty_'.$id]), 2, PHP_ROUND_HALF_UP);
					$final_price = round((($get_total + $post_total) / $final_qty ), 2, PHP_ROUND_HALF_UP);
				}
				$this->Db->update('prestock',$id,array(
					'quantity'=>$final_qty,
					'price'=>$final_price
				));
				$total += ($_POST['qty_' . $id] * $_POST['price_' . $id]);
				$out .= '<tr><td>'. $this->Db->get_relation('material',$id,'name') .'</td>';
				$out .= '<td>'. $_POST['price_' . $id] .'</td>';
				$out .= '<td>'. $_POST['qty_' . $id] .'</td>';
				$out .= '<td class="text-right">'. ($_POST['qty_' . $id] * $_POST['price_' . $id]) .'</td></tr>';
			}
			$out .= '<tr><td></td><td colspan="3" class="text-right"><b>';
			$out .= 'Total: '.$total.'</br>';
			$out .= 'Commition: - '.$_POST['commition'].'</br>';
			//$out .= 'Grandtotal: '.($total - $_POST['commition']).'</br>';
			$out .= 'Payment: - '.$_POST['payment'].'</br><hr>';
			$out .= 'Due Payment: '.(($total - $_POST['commition']) - $_POST['payment']);
			$out .= '</b></td></tr>';
			$out .= '</tbody></table>';
			$this->Db->insert('stock_history', array(
				'time' => $invoice,
				'supplier' => $_POST['Supplier'],
				'material' => implode('|',$ids),
				'quantity'=> implode('|',$qty),
				'total'=> round(($total - $_POST['commition']), 2, PHP_ROUND_HALF_UP),
				'paid'=> round($_POST['payment'], 2, PHP_ROUND_HALF_UP)
			));
			$this->Db->insert('due_payment', array(
				'time' => $invoice,
				'supplier' => $_POST['Supplier'],
				'bill'=> round(($total - $_POST['commition']), 2, PHP_ROUND_HALF_UP),
				'paid'=> round($_POST['payment'], 2, PHP_ROUND_HALF_UP)
			));
			
			$data['Eror'] = null;
			$data['Back'] = 'supplier/material';
			$data['Success'] = null;
			if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
			if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
			$data['datas'] = $this->Db->get('supplier');
			$data['datas2'] = $this->Db->get('material');
			$data['out'] = $out;

			$this->load->view('theme/header',$data);
			$this->load->view('supplier/slip',$data);
			$this->load->view('theme/footer',$data);
		}else{redirect('supplier/material?Eror='. 'Not a Supplier' , 'refresh');}
		}else{redirect('supplier/material?Eror='. 'No Supplier Selected' , 'refresh');}
    }
	
	public function material_history(){
		
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
		$data['datas'] = $this->Db->get('stock_history');
		
        $this->load->view('theme/header',$data);
		$this->load->view('supplier/material_history',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function coock_history(){
		
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
		$data['datas'] = $this->Db->get('coock_history');
		
        $this->load->view('theme/header',$data);
		$this->load->view('supplier/coock_history',$data);
		$this->load->view('theme/footer',$data);
    }

}