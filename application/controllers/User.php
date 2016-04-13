<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    public function index(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('option', $access)){ show_404(); }
		}else{ show_404(); }
		
		$data['Eror'] = null;
		$data['Back'] = 'home/dash';
		$data['Success'] = null;
		if(isset($_GET['Success'])){$data['Success'] = $_GET['Success'];}
		if(isset($_GET['Eror'])){$data['Eror'] = $_GET['Eror'];}
		$data['datas'] = $this->Db->get('user');
		
        $this->load->view('theme/header',$data);
		$this->load->view('user/view',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function add(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('option', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->form_validation->set_rules('name', 'Name', 				'required|regex_match[/^[-a-zA-Z ]*$/]|max_length[50]'	);
		$this->form_validation->set_rules('designation', 'Dasignation', 'required|regex_match[/^[-a-zA-Z ]*$/]|max_length[50]'	);
		$this->form_validation->set_rules('username', 'Email', 			'required|valid_email|max_length[50]'	);
		$this->form_validation->set_rules('password', 'Password', 		'required|regex_match[/^[-a-zA-Z0-9 ]*$/]|max_length[50]'	);
		
		$data['Eror'] = null;
		$data['Back'] = 'user';
		$data['Success'] = null;
		$data['rolls'] = $this->Db->get('module');
		
		if ($this->form_validation->run() == FALSE){
            $data['Eror'] = validation_errors();
        }else{
			$id = time();
			$array = array(
				'time' => $id,
				'name' => $_POST['name'],
				'designation' => $_POST['designation'],
				'username' => $_POST['username'],
				'password' => md5($_POST['password']),
				'roll' => implode('|', $_POST['roll'])
			);
			$msg = $this->Db->insert('user',$array);
            if($msg == 'True'){
				$data['Success'] = 'Table Added';
			}else{
				$data['Eror'] = $msg;
			}
		}
		
		$this->load->view('theme/header',$data);
		$this->load->view('user/add',$data);
		$this->load->view('theme/footer',$data);
		
    }
	
	public function edit($time = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('option', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->form_validation->set_rules('name', 'Name', 				'required|regex_match[/^[-a-zA-Z ]*$/]|max_length[50]'	);
		$this->form_validation->set_rules('designation', 'Dasignation', 'required|regex_match[/^[-a-zA-Z ]*$/]|max_length[50]'	);
		$this->form_validation->set_rules('username', 'Email', 			'required|valid_email|max_length[50]'	);
		$this->form_validation->set_rules('password', 'Password', 		'required|regex_match[/^[-a-zA-Z0-9 ]*$/]|max_length[50]'	);
		
		$data['Eror'] = null;
		$data['Back'] = 'user';
		$data['Success'] = null;
		$data['rolls'] = $this->Db->get('module');
		
		if ($this->form_validation->run() == FALSE){
            $data['Eror'] = validation_errors();
        }else{
			if($this->Db->get_relation('user', $time, 'name') != 'False'){
				$array = array(
					'name' => $_POST['name'],
					'designation' => $_POST['designation'],
					'username' => $_POST['username'],
					'password' => md5($_POST['password']),
					'roll' => implode('|', $_POST['roll'])
				);
				$msg = $this->Db->update('user', $_POST['time'], $array);
				if($msg == 'True'){
					$data['Success'] = 'Table Edited';
				}else{
					$data['Eror'] = $msg;
				}
			}else{
				$data['Eror'] = 'Table ID not found';
			}
		}
		
		$data['time'] = $time;
		
		$this->load->view('theme/header', $data);
		$this->load->view('user/edit', $data);
		$this->load->view('theme/footer', $data);
		
    }
	
	public function trash($time = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('option', $access)){ show_404(); }
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
			$msg = $this->Db->trash('user', $time);
			if($msg == 'True'){
				$data['Success'] = 'Deleted';
				redirect('user?Success='. $data['Success'] , 'refresh');
			}else{
				$data['Eror'] = $msg;
			}
		}
		redirect('user?Eror='. $data['Eror'] , 'refresh');
    }

}