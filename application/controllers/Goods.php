<?php
	
class Goods extends CI_Controller {

    public function index(){
		$data['eror'] = '';
		$data['tables'] = $this->DB->get('goods');
		$this->load->view('goods/view',$data);
    }

    public function add($id = ''){
		
		$this->form_validation->set_rules('action', 'Action', 'required|in_list[old,new]');
		$this->form_validation->set_rules('name', 'Name', 'max_length[50]|required|regex_match[/^[-a-zA-Z0-9 ]*$/]');
		$this->form_validation->set_rules('category', 'Category', 'max_length[50]|required|in_list[Filmy Food,Filmy Drinks,Bangla Tea,Hollywood Coffee,Dessert,Food papa Item,Regular Drinks,Tobacco]');
		$this->form_validation->set_rules('print', 'Print Category', 'max_length[50]|required|in_list[Kitchen,Drinks,Food papa]');
		$this->form_validation->set_rules('price', 'Price', 'max_length[20]|required|numeric');
		
		if ($this->form_validation->run() == FALSE){
            $data['eror'] = validation_errors();
			$data['success'] = '';
			$data['id'] = $id;
			$this->load->view('goods/add',$data);
        }else{
			$data['id'] = $id;
			if($_POST['action'] == 'new'){
				$id = time();
				$this->DB->insert('goods', array(
					'time'=>$id,
					'name'=>$_POST['name'],
					'category'=>$_POST['category'],
					'print'=>$_POST['print'],
					'price'=>$_POST['price']
				));
				$this->DB->insert('stock', array('time'=>$id, 'quantity'=>0, 'special'=>'False', 'price'=> 0 ));
				$data['eror'] = '';
				$data['success'] = 'Food Added';
			}else if($_POST['action'] == 'old'){
				if($this->DB->get_relation('goods',$_POST['id'],'name') != 'False'){
					$this->DB->update('goods', $_POST['id'], array(
						'name'=>$_POST['name'],
						'category'=>$_POST['category'],
						'print'=>$_POST['print'],
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
			$this->load->view('goods/add',$data);
        }
	   
    }
	
	public function trash($id = ''){
		$data['eror'] = '';
		if($this->DB->get_relation('goods',$id,'name') != 'False'){
			$this->DB->trash('goods',$id);
			$this->DB->trash('stock',$id);
			$data['eror'] = 'Food Deleted';
		}else{
			$data['eror'] = 'Food Not Found';
		}
		$data['tables'] = $this->DB->get('goods');
		$this->load->view('goods/view',$data);
    }
	
}
	
?>