<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reservation_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->table = 'reservations';
	}

	public function countAllReservations(){
		return $this->db->get($this->table)->num_rows();
	}

	public function getAllReservationsForAdmin(){
		$this->db->select('*');
		$this->db->from('reservations');
		$this->db->join('topics', 'topics.id = reservations.topic_id');
		$this->db->join('users','users.id = reservations.user_id');
		$this->db->order_by('topics.custom','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getReservation($id){
		$this->db->select('*');
		$this->db->from('reservations');
		$this->db->where('reservation_id',$id);
		$this->db->join('topics', 'topics.id = reservations.topic_id');
		$this->db->join('users','users.id = reservations.user_id');
		$query = $this->db->get();
		return $query->row();
	}

	public function getReservationFromUserId($id){
		$this->db->select('*');
		$this->db->from('reservations');
		$this->db->join('topics', 'topics.id = reservations.topic_id');
		$this->db->join('users','users.id = reservations.user_id');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getUsersReservation($userId){
		$this->db->select('*');
		$this->db->from('reservations');
		$this->db->join('topics', 'topics.id = reservations.topic_id');
		$this->db->join('users','users.id = reservations.user_id');
		$this->db->where('reservations.user_id',$userId);
		$query = $this->db->get();
		return $query->row();
	}

	public function getUserIdFromReservation($id){
		$this->db->select('*');
		$this->db->from('reservations');
		$this->db->where('reservation_id',$id);
		$query = $this->db->get();
		return $query->row()->user_id;
	}

	public function createReservation($insertData){


		$data = array(
			'user_id' => $insertData['user_id'],
			'topic_id' => $insertData['topic_id'],
			'reservation_created_at' => date('Y-m-d H:i:s'),
			'reservation_updated_at'=> date('Y-m-d H:i:s'),
			'accepted'=>$insertData['accepted'],
			'category' => $insertData['category'],
			'description'=>$insertData['description'],
		);

		return $this->db->insert($this->table,$data);
	}

	public function acceptReservation($id){
		
		$this->db->where('reservation_id',$id);
		return $this->db->update('reservations',array('accepted'=>1));
	}

	public function commentReservation($id,$comments){
		
		$this->db->where('reservation_id',$id);
		return $this->db->update('reservations',array('comments'=>$comments));
	}

	public function deleteReservation($id){
		return $this->db->delete('reservations',array('reservation_id'=>$id));
	}

	public function checkIfReservationExist($userId){
		$this->db->where('user_id',$userId);
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}

	public function setProjectAsSended($userId,$filename){
		$this->db->update('reservations',array('filename'=>$filename),array('user_id'=>$userId));
		return $this->db->affected_rows()?TRUE:FALSE;
	}


}
