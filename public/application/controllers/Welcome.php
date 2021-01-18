<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('config_model');
	}

	public function index()
	{
		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
		$this->isAdminLoggedIn = $this->session->userdata('isAdminLoggedIn');
		$data['closeDate'] = $this->config_model->getActualCloseDate();
		$data['closeFileDate'] = $this->config_model->getActualFileCloseDate();
		$data['logged'] = $this->isUserLoggedIn;
		$data['loggedAdmin'] = $this->isAdminLoggedIn;
		$data["msgType"] = $this->session->userdata('msgType');
		$data["msgText"] = $this->session->userdata('msgText');
		
		$this->load->view('templates/header',$data);
		$this->load->view('welcome_message',$data);
		$this->load->view('templates/footer');
	}
}
