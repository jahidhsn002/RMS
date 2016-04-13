<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Material extends CI_Controller {

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
		$data['datas'] = $this->Db->get('material');
		
        $this->load->view('theme/header',$data);
		$this->load->view('material/view',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function add(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('perchase/material', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->form_validation->set_rules('name', 'Name', 'max_length[50]|required|regex_match[/^[-a-zA-Z0-9 ]*$/]');
		$this->form_validation->set_rules('category', 'Category', 'max_length[50]|required|in_list[Filmy Food,Filmy Drinks,Bangla Tea,Hollywood Coffee,Dessert,Food papa Item,Regular Drinks,Tobacco]');
		$this->form_validation->set_rules('price', 'Price', 'max_length[20]|required|numeric');
		
		$data['Eror'] = null;
		$data['Back'] = 'material';
		$data['Success'] = null;
		
		if ($this->form_validation->run() == FALSE){
            $data['Eror'] = validation_errors();
        }else{
			$id = time();
			$array = array(
				'time' => $id,
				'name' => $_POST['name'],
				'category' => $_POST['category'],
				'price' => $_POST['price']
			);
			$msg = $this->Db->insert('material',$array);
			$array2 = array(
				'time' => $id,
				'quantity' => 0,
				'wastage' => 0
			);
			$msg2 = $this->Db->insert('prestock',$array2);
            if($msg == 'True' && $msg2 == 'True'){
				$data['Success'] = 'Material Added';
			}else{
				$data['Eror'] = $msg;
			}
		}
		
		
		$data['datas'] = $this->Db->get('material');
		$this->load->view('theme/header',$data);
		$this->load->view('material/add',$data);
		$this->load->view('theme/footer',$data);
		
    }
	
	public function edit($time = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('perchase/material', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->form_validation->set_rules('name', 'Name', 'max_length[50]|required|regex_match[/^[-a-zA-Z0-9 ]*$/]');
		$this->form_validation->set_rules('category', 'Category', 'max_length[50]|required|in_list[Filmy Food,Filmy Drinks,Bangla Tea,Hollywood Coffee,Dessert,Food papa Item,Regular Drinks,Tobacco]');
		$this->form_validation->set_rules('price', 'Price', 'max_length[20]|required|numeric');
		
		$data['Eror'] = null;
		$data['Back'] = 'material';
		$data['Success'] = null;
		
		if ($this->form_validation->run() == FALSE){
            $data['Eror'] = validation_errors();
        }else{
			if($this->Db->get_relation('material', $time, 'name') != 'False'){
				$array = array(
					'name' => $_POST['name'],
					'category' => $_POST['category'],
					'price' => $_POST['price']
				);
				$msg = $this->Db->update('material', $_POST['time'], $array);
				if($msg == 'True'){
					$data['Success'] = 'Material Edited';
				}else{
					$data['Eror'] = $msg;
				}
			}else{
				$data['Eror'] = 'Material ID not found';
			}
		}
		
		$data['time'] = $time;
		
		$data['datas'] = $this->Db->get('material');
		$this->load->view('theme/header', $data);
		$this->load->view('material/edit', $data);
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
			$msg = $this->Db->trash('material', $time);
			$msg2 = $this->Db->trash('prestock', $time);
			if($msg == 'True' && $msg2 == 'True'){
				$data['Success'] = 'Deleted';
				redirect('material?Success='. $data['Success'] , 'refresh');
			}else{
				$data['Eror'] = $msg;
			}
		}
		redirect('material?Eror='. $data['Eror'] , 'refresh');
    }

}