<?php
	
class Table extends CI_Controller {

    public function index(){
		$data['eror'] = '';
		$data['tables'] = $this->DB->get('table');
		$this->load->view('table/view',$data);
    }

    public function add($id = ''){
		
		$this->form_validation->set_rules('action', 'Action', 'required|in_list[old,new]');
		$this->form_validation->set_rules('number', 'Name', 'max_length[20]|required|numeric');
		$this->form_validation->set_rules('name', 'Name', 'max_length[50]|required|regex_match[/^[-a-zA-Z0-9 ]*$/]');
		
		if ($this->form_validation->run() == FALSE){
            $data['eror'] = validation_errors();
			$data['success'] = '';
			$data['id'] = $id;
			$this->load->view('table/add',$data);
        }else{
			$data['id'] = $id;
			if($_POST['action'] == 'new'){
				$id = time();
				$this->DB->insert('table', array(
					'time'=>$id,
					'number'=>$_POST['number'],
					'name'=>$_POST['name'],
					'status'=>'Free'
				));
				$data['eror'] = '';
				$data['success'] = 'Food Added';
			}else if($_POST['action'] == 'old'){
				if($this->DB->get_relation('table',$_POST['id'],'name') != 'False'){
					$this->DB->update('table', $_POST['id'], array(
						'number'=>$_POST['number'],
						'name'=>$_POST['name']
					));
					$data['id'] = $_POST['id'];
					$data['eror'] = '';
					$data['success'] = 'Food Updated';
				}else{
					$data['eror'] = 'Food Not Found';
					$data['success'] = '';
				}
			}
			$this->load->view('table/add',$data);
        }
	   
    }
	
	public function trash($id = ''){
		$data['eror'] = '';
		if($this->DB->get_relation('table',$id,'name') != 'False'){
			$this->DB->trash('table',$id);
			$this->DB->trash('order',$id);
			$data['eror'] = 'Food Deleted';
		}else{
			$data['eror'] = 'Food Not Found';
		}
		$data['tables'] = $this->DB->get('table');
		$this->load->view('table/view',$data);
    }
	
}
	
?>