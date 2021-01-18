<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'users';
	}

	function getRows($params = array())
	{
		$this->db->select('*');
		$this->db->from($this->table);

		if(array_key_exists("conditions",$params))
		{
			foreach ($params['conditions'] as $key => $val)
			{
				$this->db->where($key,$val);
			}
		}

		if(array_key_exists("returnType",$params) && $params['returnType']=='count')
		{
			$result = $this->db->count_all_results();
		}
		else
		{
			if(array_key_exists("id",$params) || $params['returnType']=='single')
			{
				if(!empty($params['id']))
				{
					$this->db->where('id',$params['id']);
				}

				$query = $this->db->get();
				$result = $query->row_array();
			}
			else
			{
				$this->db->order_by('id','desc');
				if(array_key_exists("start",$params) && array_key_exists("limit",$params))
				{
					$this->db->limit($params['limit'],$params['start']);
				}elseif(!array_key_exists("start",$params)&&array_key_exists("limit",$params))
				{
					$this->db->limit($params['limit']);
				}
				$query = $this->db->get();
				$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
			}
		}

		return $result;
	}

	public function addUser($userData){
		return $this->db->insert('users',$userData);
	}

	public function getAllUsers(){
		$this->db->select('id, first_name, last_name ,email, status');
		$this->db->where('status!=',2);
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function getUserMail($userId){
		$this->db->select('email');
		$this->db->where(array('id'=>$userId));
		$query = $this->db->get('users');
		return $query->row();
	}

	public function getNameFromId($userId){
		$this->db->select('first_name,last_name');
		$this->db->where(array('id'=>$userId));
		$query = $this->db->get('users');
		return $query->row()->first_name.'_'.$query->row()->last_name;
	}

	public function addResetToken($userId,$token){
		return $this->db->update('users',array('reset_token'=>$token),array('id'=>$userId));
	}

	public function checkResetToken($token){
		$this->db->where(array('reset_token'=>$token));
		$query = $this->db->get('users');
		return $query->row();
	}
	public function setNewPassword($userId, $password){
		$this->db->where('id',$userId);
		return $this->db->update('users',array('password'=>$password,'reset_token'=>NULL));
	}
	public function getUserIdFromToken($token){
		$this->db->where('reset_token',$token);
		$query = $this->db->get('users');
		return $query->row();
	}
	public function getUserIdFromEmail($email){
		$this->db->where('email',$email);
		$query = $this->db->get('users');
		return $query->row();
	}

	public function activateUser($token){
		
		return $this->db->update('users',array('status'=>1,'activate_token'=>NULL),array('activate_token'=>$token));
		
	}

	public function deleteUser($userId){
		return $this->db->delete('users',array('id'=>$userId));
	}
}
