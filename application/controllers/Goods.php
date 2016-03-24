<?php
class Goods extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
	
	public function index(){
		$this->load->view('goods');
    }
	
	public function view($action = null, $time = null){
		if($action == 'trash'){
			$this->DB->trash('goods',$time);
		}else if($action == 'update' && isset($_GET['price'])){
			$this->DB->update('goods', $time, array('price'=>$_GET['price']));
		}
		$tables = $this->DB->get('goods');
		$data = '<table class="table table-bordered"><thead>';
		$data .= '<tr>';
		$data .= '<th colspan="10" class="form-inline">';
		if($action == 'change' && isset($_GET['price'])){
			$data .= '<input type="number" value="'. $_GET['price'] .'" class="form-control" id="tbl_name"> <button onclick="';
			$data .= "$('.the_form').load('" . site_url("Goods/view/update") . "/". $time ."?price=' + $('#tbl_name').val().replace(' ','%20'))";
			$data .= '" class="btn btn-default">Change</button>';
		}
		$data .= '<a href="'. site_url("Goods/add") .'" class="btn btn-success pull-right">Add New</a>';
		$data .= '</th>';
		$data .= '</tr>';
		$data .= '<tr>';
		$data .= '<th>Name</th>';
		$data .= '<th>Category</th>';
		$data .= '<th>Price</th>';
		$data .= '<th>Action</th>';
		$data .= '</tr></thead>';
		foreach($tables as $table){
			$button = 	'<div class="dropdown pull-right">';
			$button .= 	'<button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown">Actions<span class="caret"></span></button>';
			$button .= 	'<ul class="dropdown-menu">';
			$button .= 	'<li><a onclick="';
			$button .= 	"$('.the_form').load('" . site_url("Goods/view/change/" . $table->time) . "?price=". $table->price ."')";
			$button .= 	'" href="#">Change Price</a></li>';
			$button .= 	'<li><a onclick="';
			$button .= 	"$('.the_form').load('" . site_url("Goods/view/trash/" . $table->time) . "')";
			$button .= 	'" href="#">Delete</a></li>';
			$button .= 	'</ul>';
			$button .= 	'</div>';
			
			$data .= '<tr>';
			$data .= '<td>'. $table->name .'</td>';
			$data .= '<td>'. $table->category .'</td>';
			$data .= '<td>'. $table->price .'</td>';
			$data .= '<td>'. $button .'</td>';
			$data .= '</tr>';
		}
		$data .= '</tbody></table>';
		$this->_output($data);
    }
	
	public function add(){
		$this->form_validation->set_rules('name', 'Name', 'alpha_numeric_spaces|required');
		$this->form_validation->set_rules('category', 'Category', 'alpha_numeric_spaces|required');
		$this->form_validation->set_rules('price', 'Price', 'numeric|required');
		if ($this->form_validation->run() == FALSE){
            $this->load->view('form_goods');
        }else{
			$this->DB->insert('goods', array('time'=>time(), 'name'=>$_POST['name'], 'category'=>$_POST['category'], 'price'=>$_POST['price']));
			$this->load->view('goods');
        }
    }
	
	public function _output($output){
        print_r( $output );
	}
	
}