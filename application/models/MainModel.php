<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');

class MainModel extends CI_Model {

   public function __construct() {
        parent::__construct();
    }
	
	  public function getAllData($condition='', $tableName='', $selectQuery='', $order='' )
    {
        $this->db->select($selectQuery);
        if ($condition): $this->db->where($condition);
        endif;
		if($order):$this->db->order_by($order);
		endif;
        return $this->db->get($tableName)->result();

    }

    public function getSingleData($field,$condition, $tableName, $selectQuery)
    {
        $this->db->select($selectQuery);
        $this->db->where($field,$condition);
        return $this->db->get($tableName)->row();

    }

	public function getSingleDataArrayType($field,$condition, $tableName, $selectQuery)
	{
		$this->db->select($selectQuery);
		$this->db->where($field,$condition);
		return $this->db->get($tableName)->row_array();

	}

	public function getDataRow($field,$condition, $tableName, $selectQuery)
	{
		$this->db->select($selectQuery);
		$this->db->where($field,$condition);
		return $this->db->get($tableName)->num_rows();

	}

    function insertData($tableName,$data)
    {
        return $this->db->insert($tableName, $data);
    }

    function deleteData($field,$condition, $tableName)
    {
         $this->db->where($field,$condition);
        return $this->db->delete($tableName);
    }

	function AllQueryDalta($query)
	{
		return $this->db->query($query)->result();
	}
	function SingleQueryData($query)
	{
		return $this->db->query($query)->row();
	}
	function QuerySingleData($query)
	{
		return $this->db->query($query)->row();
	}


	function QuerySingleDataDelete($query)
	{
		 $this->db->query($query)->result();
		 if($this->db->affected_rows()>0){
		 	return true;
		 }
		 else {

		 	return false;
		 }
	}

    function updateData($field,$condition,$tableName,$data)
    {
      
        $this->db->where($field,$condition);
        $result= $this->db->update($tableName, $data);
		if($result){

			return true;
		}
		else {

			return false;
		}
    }
	function loginCheck($email,$password)
	{
		$this->db->select('*');
		$this->db->where(array('user_email'=>$email,'user_password'=>$password));
		return $this->db->get('users')->row();
	}

	function returnInsertId($tableName,$data)
	{
		$this->db->insert($tableName, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	function updateDataReturnInsertId($field,$condition,$tableName,$data)
	{

		$this->db->where($field,$condition);
		 $this->db->update($tableName, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;

	}

	function visitorCount($ip,$date)
	{
		$this->db->where('visitor_ip', $ip);
		$this->db->where('visitor_date', $date);
		$insert_id = $this->db->get('visitors')->row();
		return $insert_id;
	}
	function countByLikeCondition($field_name, $cond, $tableName)
	{
		$this->db->like($field_name, $cond, 'after');
		return $this->db->count_all_results($tableName);
	}
	function countAll($tableName)
	{
		return $this->db->count_all($tableName);
	}
	public function select_all_data_by_name($limit, $start,$fieldName, $field_title,$tableName,$orderBy)
	{
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->like($fieldName, $field_title, 'both');
		$this->db->order_by($orderBy);
		$query_result = $this->db->get($tableName);
		$result = $query_result->result();
		return $result;
	}

	public function select_all_data_by_limit($limit, $start,$tableName,$orderBy)
	{
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->order_by($orderBy);
		$query_result = $this->db->get($tableName);
		$result = $query_result->result();
		return $result;
	}






}
	

   
