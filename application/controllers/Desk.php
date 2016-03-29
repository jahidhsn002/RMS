<?php
	
class Desk extends CI_Controller {

    public function index(){
		$data['eror'] = '';
		//echo MD5('55@21');
		$this->load->view('desk/view',$data);
    }
	
	public function painding(){
		$data['eror'] = '';
		$data['tables'] = $this->DB->get_where('order',array('status'=>'Painding'));
		$this->load->view('desk/painding',$data);
    }
	
	public function new_order(){
		$data['eror'] = '';
		$data['tables'] = $this->DB->get_where('order',array('status'=>'Booked'));
		$this->load->view('desk/new',$data);
    }
	
	public function cashout(){
		$data['eror'] = '';
		$data['tables'] = $this->DB->get_where('order', array('status'=>'Cashout'));
		$this->load->view('desk/cashout',$data);
    }
	
	public function slip($type = null, $time = null, $id = null){
		if($type == 'Change'){
			$data['eror'] = 'Succes: Order #'.$time.' is Painding';
			$this->DB->update('order', $time, array('status'=>'Painding'));
			$this->load->view('desk/view',$data);
		}else{
			$data['eror'] = '';
			$data['type'] = $type;
			$data['id'] = $id;
			$data['time'] = $time;
			$data['tables'] = $this->DB->get_where('order', array('time'=>$time, 'id'=>$id));
			$this->load->view('desk/slip',$data);
		}
    }
	
	public function total($type = null, $time = null){
		$data['eror'] = '';
		$data['type'] = $type;
		$data['time'] = $time;
		$data['tables'] = $this->DB->get_where('order', array('time'=>$time));
		$this->load->view('desk/slip',$data);
    }
	
	public function recipt($time = null){
		$this->form_validation->set_rules('customer', 'Customer Name', 'required|alpha_numeric_spaces');
		$this->form_validation->set_rules('name', 'Offer Name', 'required|alpha_numeric_spaces');
		$this->form_validation->set_rules('type', 'Type', 'required|in_list[Menual,Parcantage]');
		$this->form_validation->set_rules('menual', 'Menual', 'numeric');
		$this->form_validation->set_rules('parcantage', 'Parcantage', 'numeric');
		
		if ($this->form_validation->run() == FALSE){
            $data['eror'] = validation_errors();
			$data['success'] = '';
			$data['id'] = $time;
			$this->load->view('desk/add',$data);
        }else{
			$data['customer'] = $_POST['customer'];
			$data['name'] = $_POST['name'];
			$data['type'] = $_POST['type'];
			$data['parcantage'] = $_POST['parcantage'];
			$data['menual'] = $_POST['menual'];
			$data['time'] = $_POST['id'];
			$data['tables'] = $this->DB->get_where('order', array('time'=>$_POST['id']));
			$this->load->view('desk/recipt',$data);
        }
    }
	
}
	
?>