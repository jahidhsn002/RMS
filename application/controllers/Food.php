<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Food extends CI_Controller {

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
		$data['datas'] = $this->Db->get('food');
		
        $this->load->view('theme/header',$data);
		$this->load->view('food/view',$data);
		$this->load->view('theme/footer',$data);
    }
	
	public function add(){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('praper/food', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->form_validation->set_rules('name', 'Name', 'max_length[50]|required|regex_match[/^[-a-zA-Z0-9 ]*$/]');
		$this->form_validation->set_rules('category', 'Category', 'max_length[50]|required|in_list[Filmy Food,Filmy Drinks,Bangla Tea,Hollywood Coffee,Dessert,Food papa Item,Regular Drinks,Tobacco]');
		$this->form_validation->set_rules('print', 'Print Category', 'max_length[50]|required|numeric');
		$this->form_validation->set_rules('price', 'Price', 'max_length[20]|required|numeric');
		
		$data['Eror'] = null;
		$data['Back'] = 'food';
		$data['Success'] = null;
		$data['prints'] = $this->Db->get('print');
		
		if ($this->form_validation->run() == FALSE){
            $data['Eror'] = validation_errors();
        }else{
			$id = time();
			$array = array(
				'time' => $id,
				'name' => $_POST['name'],
				'category' => $_POST['category'],
				'print' => $_POST['print'],
				'price' => $_POST['price']
			);
			$msg = $this->Db->insert('food',$array);
			$array2 = array(
				'time' => $id,
				'quantity' => 0,
				'wastage' => 0,
				'price'=>0
			);
			$msg2 = $this->Db->insert('stock',$array2);
            if($msg == 'True' && $msg2 == 'True'){
				$data['Success'] = 'Food Added';
			}else{
				$data['Eror'] = $msg;
			}
		}
		
		$this->load->view('theme/header',$data);
		$this->load->view('food/add',$data);
		$this->load->view('theme/footer',$data);
		
    }
	
	public function edit($time = null){
		
		if($this->session->userdata('he645200_on')){
			$session_data = $this->session->userdata('he645200_on');
			$id = $session_data['id']; $data['id'] = $id;
			$access = explode('|', $this->Db->get_relation('user', $id, 'roll'));
			if(!in_array('praper/food', $access)){ show_404(); }
		}else{ show_404(); }
		
		$this->form_validation->set_rules('name', 'Name', 'max_length[50]|required|regex_match[/^[-a-zA-Z0-9 ]*$/]');
		$this->form_validation->set_rules('category', 'Category', 'max_length[50]|required|in_list[Filmy Food,Filmy Drinks,Bangla Tea,Hollywood Coffee,Dessert,Food papa Item,Regular Drinks,Tobacco]');
		$this->form_validation->set_rules('print', 'Print Category', 'max_length[50]|required|numeric');
		$this->form_validation->set_rules('price', 'Price', 'max_length[20]|required|numeric');
		
		$data['Eror'] = null;
		$data['Back'] = 'food';
		$data['Success'] = null;
		$data['prints'] = $this->Db->get('print');
		
		if ($this->form_validation->run() == FALSE){
            $data['Eror'] = validation_errors();
        }else{
			if($this->Db->get_relation('food', $time, 'name') != 'False'){
				$array = array(
					'name' => $_POST['name'],
					'category' => $_POST['category'],
					'print' => $_POST['print'],
					'price' => $_POST['price']
				);
				$msg = $this->Db->update('food', $_POST['time'], $array);
				if($msg == 'True'){
					$data['Success'] = 'Food Edited';
				}else{
					$data['Eror'] = $msg;
				}
			}else{
				$data['Eror'] = 'Food ID not found';
			}
		}
		
		$data['time'] = $time;
		
		$this->load->view('theme/header', $data);
		$this->load->view('food/edit', $data);
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
			$msg = $this->Db->trash('food', $time);
			if($msg == 'True'){
				$data['Success'] = 'Deleted';
				redirect('food?Success='. $data['Success'] , 'refresh');
			}else{
				$data['Eror'] = $msg;
			}
		}
		redirect('food?Eror='. $data['Eror'] , 'refresh');
    }

}