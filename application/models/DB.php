<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Db extends CI_Model {

        public function __construct(){
            parent::__construct();
        }

        public function get($table){
            $query = $this->db->get($table);
            return $query->result();
        }
		
		public function get_where($table,$array){
            $query = $this->db
						->where($array)
						->get($table);
            return $query->result();
        }
		
		public function get_relation($table,$time,$demand){
			$out = 'False';
            $query = $this->db
						->where('time', $time)
						->get($table);
            $values = $query->result();
			foreach($values as $value){
				$out = $value->$demand;
			}
			return $out;
        }

        public function insert($table, $data){
			if ( ! $this->db->insert($table, $data)){
				return $this->db->error();
			}
			return 'True';
        }
		
		public function update($table, $data, $data2){
			if ( ! $this->db->where('time',$data)->update($table, $data2)){
				return $this->db->error();
			}
			return 'True';
        }
		
		public function update_where($table, $data, $data2){
			if ( ! $this->db->where($data)->update($table, $data2)){
				return $this->db->error();
			}
			return 'True';
        }

        public function trash($table,$time){
			if ( ! $this->db->delete($table, array('time' => $time))){
				return $this->db->error();
			}
			return 'True';
        }
		
		public function trash_where($table,$time){
			if ( ! $this->db->delete($table, $time)){
				return $this->db->error();
			}
			return 'True';
        }
		
		function login($username, $password){
			$this -> db -> select('time, username, password');
			$this -> db -> from('user');
			$this -> db -> where('username', $username);
			$this -> db -> where('password', MD5($password));
			$this -> db -> limit(1);
		 
			$query = $this -> db -> get();
		 
			if($query -> num_rows() == 1){
				return $query->result();
			}else{
				return false;
			}
		}

	}
	
?>