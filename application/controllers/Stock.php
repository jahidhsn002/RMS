<?php
	
class Stock extends CI_Controller {

    public function index(){
		$data['eror'] = '';
		$data['tables'] = $this->DB->get('stock');
		$this->load->view('Stock/view',$data);
    }

    public function add($id = ''){
		
		$this->form_validation->set_rules('action', 'Action', 'required|in_list[old]');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
		$this->form_validation->set_rules('special', 'Special', 'required|in_list[True,False]');
		$this->form_validation->set_rules('price', 'Price', 'max_length[20]|required|numeric');
		
		if ($this->form_validation->run() == FALSE){
            $data['eror'] = validation_errors();
			$data['success'] = '';
			$data['id'] = $id;
			$this->load->view('stock/add',$data);
        }else{
			$data['id'] = $id;
			if($_POST['action'] == 'old'){
				if($this->DB->get_relation('stock',$_POST['id'],'time') != 'False'){
					$this->DB->update('stock', $_POST['id'], array(
						'quantity'=>$_POST['quantity'],
						'special'=>$_POST['special'],
						'price'=>$_POST['price']
					));
					$data['id'] = $_POST['id'];
					$data['eror'] = '';
					$data['success'] = 'Food Updated';
				}else{
					$data['eror'] = 'Food Not Found';
					$data['success'] = '';
				}
			}
			$this->load->view('stock/add',$data);
        }
	   
    }
	
}
	
?>