<?php
class Stock extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
	
	public function index(){
		$this->load->view('stock');
    }
	
	public function view($action = null, $time = null){
		if($action == 'trash'){
			$this->DB->trash('stock',$time);
		}else if($action == 'update' && isset($_GET['quantity'])){
			$this->DB->update('stock', $time, array('quantity'=>$_GET['quantity']));
		}else if($action == 'special' && isset($_GET['special']) && isset($_GET['price'])){
			$this->DB->update('stock', $time, array('special'=>$_GET['special']));
			$this->DB->update('stock', $time, array('price'=>$_GET['price']));
		}
		$tables = $this->DB->get('stock');
		$data = '<table class="table table-bordered"><thead>';
		$data .= '<tr>';
		$data .= '<th colspan="10" class="form-inline">';
		if($action == 'change' && isset($_GET['quantity'])){
			$data .= '<input type="number" value="'. $_GET['quantity'] .'" class="form-control" id="tbl_name"> <button onclick="';
			$data .= "$('.the_form').load('" . site_url("Stock/view/update") . "/". $time ."?quantity=' + $('#tbl_name').val().replace(' ','%20'))";
			$data .= '" class="btn btn-default">Change</button>';
		}else if($action == 'speacial' && isset($_GET['price'])){
			$data .= '<select class="form-control" id="special"><option>True</option><option>False</option></select> ';
			$data .= '<input type="number" value="'. $_GET['price'] .'" class="form-control" id="tbl_name"> <button onclick="';
			$data .= "$('.the_form').load('" . site_url("Stock/view/special") . "/". $time ."?price=' + $('#tbl_name').val().replace(' ','%20') + '&&special=' + $('#special').val().replace(' ','%20'))";
			$data .= '" class="btn btn-default">Change</button>';
		}
		$data .= '<a href="'. site_url("Stock/add") .'" class="btn btn-success pull-right">Add New</a>';
		$data .= '</th>';
		$data .= '</tr>';
		$data .= '<tr>';
		$data .= '<th>Name</th>';
		$data .= '<th>Quantity</th>';
		$data .= '<th>Speacial</th>';
		$data .= '<th>Price</th>';
		$data .= '<th>Action</th>';
		$data .= '</tr></thead>';
		foreach($tables as $table){
			$button = 	'<div class="dropdown pull-right">';
			$button .= 	'<button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown">Actions<span class="caret"></span></button>';
			$button .= 	'<ul class="dropdown-menu">';
			$button .= 	'<li><a onclick="';
			$button .= 	"$('.the_form').load('" . site_url("Stock/view/change/" . $table->time) . "?quantity=". $table->quantity ."')";
			$button .= 	'" href="#">Change Quantity</a></li>';
			$button .= 	'<li><a onclick="';
			$button .= 	"$('.the_form').load('" . site_url("Stock/view/speacial/" . $table->time) . "?price=". $table->price ."')";
			$button .= 	'" href="#">Speaciality</a></li>';
			$button .= 	'<li><a onclick="';
			$button .= 	"$('.the_form').load('" . site_url("Stock/view/trash/" . $table->time) . "')";
			$button .= 	'" href="#">Delete</a></li>';
			$button .= 	'</ul>';
			$button .= 	'</div>';
			
			$data .= '<tr>';
			$data .= '<td>'. $this->DB->get_relation('goods', $table->time, 'name') .'</td>';
			$data .= '<td>'. $table->quantity .'</td>';
			$data .= '<td>'. $table->special .'</td>';
			$data .= '<td>'. $table->price .'</td>';
			$data .= '<td>'. $button .'</td>';
			$data .= '</tr>';
		}
		$data .= '</tbody></table>';
		$this->_output($data);
    }
	
	public function add(){
		$this->form_validation->set_rules('time', 'Name', 'numeric|required');
		$this->form_validation->set_rules('quantity', 'Quantity', 'numeric|required');
		if ($this->form_validation->run() == FALSE){
            $data['goods'] = $this->DB->get('goods');
			$this->load->view('form_stock',$data);
        }else{
			if($this->DB->get_relation('stock', $_POST['time'], 'quantity') == 'False'){
				$this->DB->insert('stock', array('time'=>$_POST['time'], 'quantity'=>$_POST['quantity'], 'special'=>'False', 'price'=> 0 ));
			}
			$this->load->view('stock');
        }
    }
	
	public function _output($output){
        print_r( $output );
	}
	
}