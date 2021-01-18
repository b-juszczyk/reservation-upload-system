<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Config_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'config';
	}
	public function getActualCloseDate(){
		$query = $this->db->get($this->table);
		return $query->row()->closeDate;
	}
	public function setCloseDate($date){
		return $this->db->update($this->table,array('closeDate'=>$date),array('id'=>1));
	}
	public function getActualFileCloseDate(){
		$query = $this->db->get($this->table);
		return $query->row()->closeFileDate;
	}
	public function setFileCloseDate($date){
		return $this->db->update($this->table,array('closeFileDate'=>$date),array('id'=>1));
	}

}
