<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock extends CI_Controller {

    public function index(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('food/stock', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('stock');
		
        $this->load->view('theme/header',$data);
		$this->load->view('stock/view',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function low(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('food/stock', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('stock');
		
        $this->load->view('theme/header',$data);
		$this->load->view('stock/low',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function premade(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('food/stock', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('stock');
		
        $this->load->view('theme/header',$data);
		$this->load->view('stock/premade',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function wastage(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('food/stock', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('stock');
		
        $this->load->view('theme/header',$data);
		$this->load->view('stock/wastage',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function wastage_change($time = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('food/stock', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Success'] = null;
		$delete = array(
			'time' => $time,
			'quantity' => $_POST['qty']
		);

		$this->form_validation->set_data($delete);
		$this->form_validation->set_rules('time', 'ID', 'required|numeric|max_length[20]');
		
		if ($this->form_validation->run() == FALSE){
			$data['Eror'] = validation_errors();
        }else{
			$ttl = ($this->Db->get_relation('stock', $time, 'quantity') - $_POST['qty']);
			$ttl2 = ($this->Db->get_relation('stock', $time, 'wastage') + $_POST['qty']);
			$msg = $this->Db->update('stock', $time, array('quantity' => $ttl));
			$msg2 = $this->Db->update('stock', $time, array('wastage' => $ttl2));
			if($msg == 'True' && $msg2 == 'True'){
				$data['Success'] = 'Deleted';
				redirect('stock?Success='. $data['Success'] , 'refresh');
			}else{
				$data['Eror'] = $msg . $msg2;
			}
		}
		redirect('stock?Eror='. $data['Eror'] , 'refresh');
    }
	
	public function premade_change($time = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('food/stock', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Success'] = null;
		$delete = array(
			'time' => $time,
			'quantity' => $_POST['qty']
		);

		$this->form_validation->set_data($delete);
		$this->form_validation->set_rules('time', 'ID', 'required|numeric|max_length[20]');
		
		if ($this->form_validation->run() == FALSE){
			$data['Eror'] = validation_errors();
        }else{
			$ttl = ($this->Db->get_relation('stock', $time, 'quantity') - $_POST['qty']);
			$ttl2 = ($this->Db->get_relation('stock', $time, 'premade') + $_POST['qty']);
			$msg = $this->Db->update('stock', $time, array('quantity' => $ttl));
			$msg2 = $this->Db->update('stock', $time, array('premade' => $ttl2));
			if($msg == 'True' && $msg2 == 'True'){
				$data['Success'] = 'Deleted';
				redirect('stock?Success='. $data['Success'] , 'refresh');
			}else{
				$data['Eror'] = $msg . $msg2;
			}
		}
		redirect('stock?Eror='. $data['Eror'] , 'refresh');
    }

}