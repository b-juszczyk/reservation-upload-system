<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topics extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('topic_model');
		$this->load->model('reservation_model');
		$this->load->model('config_model');
		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
		$this->isAdminLoggedIn = $this->session->userdata('isAdminLoggedIn');
	}

	public function index()
	{
		
		$data = array(
			"topics" => $this->topic_model->get_all_topics(),
			"allReservationsCounter" => $this->reservation_model->countAllReservations(),
			"logged" => $this->isUserLoggedIn,
			"loggedAdmin" => $this->isAdminLoggedIn,
			"msgType" => $this->session->flashdata('msgType'),
			"msgText" => $this->session->flashdata('msgText'),
		);

		$this->load->view('templates/header',$data);
		$this->load->view('topics/topics',$data);
		$this->load->view('templates/footer');
	}

	public function view($id)
	{
		if(!($this->isUserLoggedIn OR $this->isAdminLoggedIn)){
			redirect(site_url('users/login'));
		}
		if($this->config_model->getActualCloseDate()<date('Y-m-d')){
			$message = array(
				'msgType'=>'danger',
				'msgText'=>'Czas na rezerwację tematów upłynął.'
			);

			$this->session->set_flashdata($message);

			redirect(base_url());
		}

		$data = array(
			"topic" => $this->topic_model->get_topic($id),
			"logged" => $this->isUserLoggedIn,
			"loggedAdmin" => $this->isAdminLoggedIn,
			'msgType' => $this->session->flashdata('msgType'),
			'msgText'=>$this->session->flashdata('msgText')
		);
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('templates/header',$data);
		$this->load->view('topics/topic',$data);
		$this->load->view('templates/footer');

	}

	public function add(){
		if(!($this->isUserLoggedIn OR $this->isAdminLoggedIn)){
			redirect(site_url('users/login'));
		}

		$data = array(
			"logged" => $this->isUserLoggedIn,
			"loggedAdmin" => $this->isAdminLoggedIn
		);
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('templates/header',$data);
		$this->load->view('topics/add',$data);
		$this->load->view('templates/footer');
	}
	public function store(){
		if(!($this->isUserLoggedIn OR $this->isAdminLoggedIn)){
			redirect(site_url('users/login'));
		}

		$userId = $this->session->userdata('userId');
		

		if($this->reservation_model->checkIfReservationExist($userId)==0){

		$insertTopicData = array(
			'title'=>$this->input->post('title',TRUE),
			'topicDescription'=>$this->input->post('topicDescription',TRUE),
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s'),
			'custom'=>1,
		);

		$newTopicId = $this->topic_model->insertNewTopic($insertTopicData);

		$insertReservationData = array(
			'category' => $this->input->post('category',TRUE),
			'description' => $this->input->post('desc',TRUE)
		);
		
		
		
		redirect(site_url('reservations/create/').$newTopicId.'?cat='.$insertReservationData['category'].'&desc='.$insertReservationData['description']);
	}
	else{
		$message = array(
			'msgType' => 'danger',
			'msgText'=>'Posiadasz już aktywną rezerwację. Skontatkuj się z prowadzącym, jeżeli chcesz dokonać zmian.'
		);
		
		$this->session->set_flashdata( $message );
		redirect(site_url('topics'));
	}
		
		
	}
}