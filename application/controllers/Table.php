<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Table extends CI_Controller {

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
		$data['datas'] = $this->Db->get('table');
		
        $this->load->view('theme/header',$data);
		$this->load->view('table/view',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function add(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('option', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->form_validation->set_rules('number', 'Number', 		'required|numeric|max_length[20]'	);
		$this->form_validation->set_rules('name', 'Name', 		'required|regex_match[/^[-a-zA-Z ]*$/]|max_length[50]'	);

		$data['Eror'] = null;
		$data['Back'] = 'table';
		$data['Success'] = null;
		
		if ($this->form_validation->run() == FALSE){
            $data['Eror'] = validation_errors();
        }else{
			$id = time();
			$array = array(
				'time' => $id,
				'number' => $_POST['number'],
				'name' => $_POST['name']
			);
			$msg = $this->Db->insert('table',$array);
            if($msg == 'True'){
				$data['Success'] = 'Table Added';
			}else{
				$data['Eror'] = $msg;
			}
		}
		
		$this->load->view('theme/header',$data);
		$this->load->view('table/add',$data);
		$this->load->view('theme/footer',$data);
		
    }
	
	public function edit($time = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('option', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->form_validation->set_rules('number', 'Number', 	'required|numeric|max_length[20]'	);
		$this->form_validation->set_rules('name', 'Name', 		'required|regex_match[/^[-a-zA-Z ]*$/]|max_length[50]'	);

		$data['Eror'] = null;
		$data['Back'] = 'table';
		$data['Success'] = null;
		
		if ($this->form_validation->run() == FALSE){
            $data['Eror'] = validation_errors();
        }else{
			if($this->Db->get_relation('table', $time, 'name') != 'False'){
				$array = array(
					'number' => $_POST['number'],
					'name' => $_POST['name']
				);
				$msg = $this->Db->update('table', $_POST['time'], $array);
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
		$this->load->view('table/edit', $data);
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
			$msg = $this->Db->trash('table', $time);
			if($msg == 'True'){
				$data['Success'] = 'Deleted';
				redirect('table?Success='. $data['Success'] , 'refresh');
			}else{
				$data['Eror'] = $msg;
			}
		}
		redirect('table?Eror='. $data['Eror'] , 'refresh');
    }

}