<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Prestock extends CI_Controller {

    public function index(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('material/stock', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('prestock');
		
        $this->load->view('theme/header',$data);
		$this->load->view('prestock/view',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function low(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('material/stock', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('prestock');
		
        $this->load->view('theme/header',$data);
		$this->load->view('prestock/low',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function wastage(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('material/stock', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('prestock');
		
        $this->load->view('theme/header',$data);
		$this->load->view('prestock/wastage',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function wastage_change($time = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('material/stock', $access)){ show_404(); }
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
			$ttl = ($this->Db->get_relation('prestock', $time, 'quantity') - $_POST['qty']);
			$ttl2 = ($this->Db->get_relation('prestock', $time, 'wastage') + $_POST['qty']);
			$msg = $this->Db->update('prestock', $time, array('quantity' => $ttl));
			$msg2 = $this->Db->update('prestock', $time, array('wastage' => $ttl2));
			if($msg == 'True' && $msg2 == 'True'){
				$data['Success'] = 'Deleted';
				redirect('prestock?Success='. $data['Success'] , 'refresh');
			}else{
				$data['Eror'] = $msg . $msg2;
			}
		}
		redirect('prestock?Eror='. $data['Eror'] , 'refresh');
    }

}