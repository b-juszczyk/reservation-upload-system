<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Topic_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'topics';
	}

	public function get_all_topics()
	{	
		$this->db->select('*,COUNT(reservations.topic_id) AS reservationsCount,SUM(reservations.reservation_id) AS allReservations');
		$this->db->from($this->table);
		$this->db->join('reservations','reservations.topic_id = topics.id','left');
		$this->db->group_by('topics.id');
		$this->db->order_by('reservationsCount','DESC');
		$this->db->where(array('custom'=>0));
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getAllTopicsForAdmin(){
		$this->db->order_by('custom,id','ASC');
		$query = $this->db->get('topics');
		return $query->result_array(); 
	}

	public function get_topic($id){
		$query =$this->db->get_where('topics',array("id"=>$id));
		return $query->row();
	}

	public function insertNewTopic($insertData){
		
		$this->db->insert($this->table,$insertData);
		return $this->db->insert_id();
	}

	public function editTopic($topicId, $data){
		return $this->db->update('topics',$data,array('id'=>$topicId));
	}

	public function deleteTopic($topicId){
		return $this->db->delete('topics',array('id'=>$topicId));
	}

}
