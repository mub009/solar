<?php

class Truncate_Model extends CI_Model {
	
   protected $tablename=array();

	function __construct()
	{
		parent::__construct();

		$this->tablename();
	}


	public function tablename()
	{
		$this->tablename=array(
			'api_keys',
			''

		);
	}

	public function truncateTable($value)
	{
	
		if(!in_array($value,$this->tablename))
		{
			
		   return true;
		   
		}
		else
		{
			return false;
		}
	}

	public function truncateAll(){

	
		$table_list=$this->db->list_tables();


		foreach($table_list as $row)
		{


			if($this->truncateTable($row))
			{
				$this->db->truncate($row);
			}
		}

	}
	

}