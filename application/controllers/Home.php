<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

		$data['Eror'] = null;
		$data['Back'] = 'table';
		$data['Success'] = null;
		
		if($this->form_validation->run() == FALSE){
			//Field validation failed.  User redirected to login page
			$data['Eror'] = validation_errors();
		}else{
			//Go to private area
			redirect('home/dash', 'refresh');
		}
		
		$this->load->view('login',$data);

	}

	function check_database($password){
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->Db->login($username, $password);

		if($result){
			$sess_array = array();
			foreach($result as $row){
				$sess_array = array(
					'id' => $row->time
				);
				$this->session->set_userdata('he645200_on', $sess_array);
			}
			return TRUE;
		}else{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}
	
	function dash(){
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('dash', $access)){ show_404(); }
		}else{ show_404(); }
			
		$data['accesss'] = explode('|',$this->Db->get_relation('user', $data['id'], 'roll'));
		
		$data['profit'] = 0.00;
		$data['sell'] = 0.00;
		$data['paid'] = 0.00;
		$data['due'] = 0.00;
		$data['perchase'] = 0.00;
		$data['perchase_paid'] = 0.00;
		
		$pps = $this->Db->get('order_history');
		foreach($pps as $pp){
			$data['profit'] += $pp->profit;
		}
		
		$pps = $this->Db->get('order_history');
		foreach($pps as $pp){
			$data['sell'] += $pp->bill;
		}
		
		$pps = $this->Db->get('order_history');
		foreach($pps as $pp){
			$data['paid'] += $pp->paid;
		}
		
		$pps = $this->Db->get('due_payment');
		foreach($pps as $pp){
			$data['perchase'] += $pp->bill;
		}
		
		$pps = $this->Db->get('due_payment');
		foreach($pps as $pp){
			$data['perchase_paid'] += $pp->paid;
		}
		
		$pps = $this->Db->get('due_payment');
		foreach($pps as $pp){
			$data['due'] += ($pp->bill - $pp->paid);
		}
		
		
		$data['Back'] = 'home/dash';
		$this->load->view('theme/header',$data);
		$this->load->view('dashboard', $data);
		$this->load->view('theme/footer',$data);
		
	}
	
	function logout(){
		$this->session->unset_userdata('he645200_on');
		session_destroy();
		redirect('home', 'refresh');
	}
	
}
?>
