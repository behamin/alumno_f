<?php
class Home_model extends CI_Model{

	private $result = "";
	
	public function __construct()
	{
		
    	parent::__construct();
		$this->result = FALSE;
   
  	}
	 
   public function get_data($table)
   {
   		
		$this->db->select('id, name, YEAR(discharge_date) AS year, MONTH(discharge_date) AS month, DAY(discharge_date) AS day');
		$query = $this->db->get_where($table,array('id_language' => 1));
		
		if($query->num_rows() > 0)
			$this->result = $query->result();

		return $this->result;
		$this->db->close();

   }
   
   public function set_data($table)
   {
   		
		$data = array(
		
		   'id_language' => 1,
		   'name' => ''
		);
		
		$this->db->insert($table, $data);
		$this->result = $this->db->insert_id();
		return $this->result;
		$this->db->close();

   }
   
} 

