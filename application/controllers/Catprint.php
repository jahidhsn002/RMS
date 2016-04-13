<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catprint extends CI_Controller {

    public function index(){
		
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
		$data['datas'] = $this->Db->get('print');
		
        $this->load->view('theme/header',$data);
		$this->load->view('print/view',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function add(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('praper/food', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->form_validation->set_rules('name', 'Name', 		'required|regex_match[/^[-a-zA-Z ]*$/]|max_length[50]'	);

		$data['Eror'] = null;
		$data['Back'] = 'catprint';
		$data['Success'] = null;
		
		if ($this->form_validation->run() == FALSE){
            $data['Eror'] = validation_errors();
        }else{
			$id = time();
			$array = array(
				'time' => $id,
				'name' => $_POST['name']
			);
			$msg = $this->Db->insert('print',$array);
            if($msg == 'True'){
				$data['Success'] = 'Table Added';
			}else{
				$data['Eror'] = $msg;
			}
		}
		
		$this->load->view('theme/header',$data);
		$this->load->view('print/add',$data);
		$this->load->view('theme/footer',$data);
		
    }
	
	public function edit($time = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('praper/food', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->form_validation->set_rules('name', 'Name', 		'required|regex_match[/^[-a-zA-Z ]*$/]|max_length[50]'	);

		$data['Eror'] = null;
		$data['Back'] = 'catprint';
		$data['Success'] = null;
		
		if ($this->form_validation->run() == FALSE){
            $data['Eror'] = validation_errors();
        }else{
			if($this->Db->get_relation('print', $time, 'name') != 'False'){
				$array = array(
					'name' => $_POST['name']
				);
				$msg = $this->Db->update('print', $_POST['time'], $array);
				if($msg == 'True'){
					$data['Success'] = 'Category Edited';
				}else{
					$data['Eror'] = $msg;
				}
			}else{
				$data['Eror'] = 'Print Category ID not found';
			}
		}
		
		$data['time'] = $time;
		
		$this->load->view('theme/header', $data);
		$this->load->view('print/edit', $data);
		$this->load->view('theme/footer', $data);
		
    }
	
	public function trash($time = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('praper/food', $access)){ show_404(); }
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
			$msg = $this->Db->trash('print', $time);
			if($msg == 'True'){
				$data['Success'] = 'Deleted';
				redirect('catprint?Success='. $data['Success'] , 'refresh');
			}else{
				$data['Eror'] = $msg;
			}
		}
		redirect('catprint?Eror='. $data['Eror'] , 'refresh');
    }

}