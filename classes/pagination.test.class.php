<?php

// class Pagination extends Database {

//     private $total,
//             $limit = 6;

//     public function set_total() {

//         $stmt = $this->connect()->prepare("SELECT id FROM products");
//         $stmt->execute();
//         $this->total = $stmt->rowCount();
//         //echo $this->total;
//     }

//     public function current_page(){
//         return isset($_GET['page']) ? (int)$_GET['page'] :1;
//     }


//     public function get_data(){
//         $start = 0;
//         if($this->current_page() > 1){
//             $start = ($this->current_page() * $this->limit) - $this->limit;
//         }
//         $stmt = $this->connect()->prepare("SELECT * FROM products LIMIT $start, $this->limit");
//         $stmt->execute();
//         return $stmt->fetchAll(PDO::FETCH_OBJ);
//     }


//     public function get_pagination_numbers(){
//         return ceil($this->total / $this->limit);
//         //$last_page = ceil($this->total / $this->limit);
//         //echo $last_page;
//     }


//     public function is_showable($num){
//         // The first conditions
//       if($this->get_pagination_numbers() < 4 || $this->current_page() == $num) {
//         return true;
//       }
            
//         // The second conditions
//       if(($this->current_page()-2) <= $num && ($this->current_page()+2) >= $num) {
//         return true;
//       }
            
//     }
        
// }  



	
	class Pagination{

		private $db, $table, $total_records, $limit = 5, $col;

		//PDO connection
		public function __construct($table){
			$this->table = $table;
			$this->db = new PDO("mysql:host=localhost; dbname=onlineshopoop", "root", "");
			//if($this->is_search()) $this->set_search_col();
			$this->set_total_records();
		}

		public function set_total_records(){

			$query  = "SELECT id FROM $this->table";

			// if($this->is_search()){
			// 	$val 	= $this->is_search();
			// 	// $query  = "SELECT id FROM $this->table WHERE username LIKE '%$val%'";
			// 	$query  = "SELECT id FROM $this->table WHERE $this->col LIKE '%$val%'";
			// }

			$stmt	= $this->db->prepare($query);
			$stmt->execute();
			$this->total_records = $stmt->rowCount();
		}

		public function get_data(){
			$start = 0;
			if($this->current_page() > 1){
				$start = ($this->current_page() * $this->limit) - $this->limit;
			}
			$query  = "SELECT * FROM $this->table LIMIT $start, $this->limit";

			// if($this->is_search()){
			// 	$val 	= $this->is_search();
			// 	// $query  = "SELECT id FROM $this->table WHERE username LIKE '%$val%' $start, $this->limit";
			// 	$query  = "SELECT id FROM $this->table WHERE $this->col LIKE '%$val%' $start, $this->limit";
			// }
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		// public function check_search(){
		// 	if($this->is_search()){
		// 		return '&search='.$this->is_search().'&col='.$this->col;
		// 	}
		// 	return '';
		// }


		// public function is_search(){
		// 	return isset($_GET['search']) ? $_GET['search'] : '';
		// }

		public function current_page(){
			return isset($_GET['page']) ? (int)$_GET['page'] :1;
		}

		public function get_pagination_numbers(){
			return ceil($this->total_records / $this->limit);
		}

		// public function prev_page(){
		// 	return ($this->current_page() > 1) ? $this->current_page() : 1;
		// }
		// public function next_page(){
		// 	return ($this->current_page() < $this->get_pagination_number()) ? $this->current_page()+1 : $this->get_pagination_number();
		// }
		// public function is_active_class($page){
		// 	return ($page == $this->current_page()) ? 'active' : '';
		// }
		
		// public function set_search_col(){
		// 	$this->col = $_GET['col'];
		// }
		public function is_showable($num){
			// The first conditions
		  if($this->get_pagination_numbers() < 4 || $this->current_page() == $num) {
			return true;
		  }
				
			// The second conditions
		  if(($this->current_page()-2) <= $num && ($this->current_page()+2) >= $num) {
			return true;
		  }
				
		}
	}