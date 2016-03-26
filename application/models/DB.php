<?php

	class DB extends CI_Model {

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
            $this->db->insert($table, $data);
        }
		
		public function update($table, $data, $data2){
			$this->db->where('time',$data);
			$this->db->update($table, $data2);
        }

        public function trash($table,$time){
            $this->db->delete($table, array('time' => $time));
        }

	}
	
?>