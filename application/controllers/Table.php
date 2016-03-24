<?php
class Table extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
	
	public function index(){
		$this->load->view('table');
    }
	
	public function view($action = null, $time = null){
		if($action == 'trash'){
			$this->DB->trash('table',$time);
		}else if($action == 'add' && isset($_GET['name'])){
			$this->DB->insert('table',array('time'=>time(),'name'=>$_GET['name'],'status'=>'Free'));
		}
		$tables = $this->DB->get('table');
		$data = '<table class="table table-bordered"><thead>';
		$data .= '<tr>';
		$data .= '<th class="form-inline"><input type="text" class="form-control" id="tbl_name"><button onclick="';
		$data .= "$('.the_form').load('" . site_url("Table/view/add") . "?name=' + $('#tbl_name').val().replace(' ','%20'))";
		$data .= '" class="btn btn-default">Add New</button></th>';
		$data .= '</tr>';
		$data .= '</thead>';
		foreach($tables as $table){
			if($table->status == 'Free'){
				$button = 	'<div class="dropdown pull-right">';
				$button .= 	'<button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown">Actions<span class="caret"></span></button>';
				$button .= 	'<ul class="dropdown-menu">';
				$button .= 	'<li><a onclick="';
				$button .= 	"$('.the_form').load('" . site_url("Table/view/trash/" . $table->time) . "')";
				$button .= 	'" href="#">Delete</a></li>';
				$button .= 	'</ul>';
				$button .= 	'</div>';
			}else{
				$button = '<div class="label label-danger pull-right">' . $table->status . '</div>';
			}
			$data .= '<tr>';
			$data .= '<td>'. $table->name . $button .'</td>';
			$data .= '</tr>';
		}
		$data .= '</tbody></table>';
		$this->_output($data);
    }
	
	public function _output($output){
        print_r( $output );
	}
	
}