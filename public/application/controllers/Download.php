<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
		$this->isAdminLoggedIn = $this->session->userdata('isAdminLoggedIn');
		$this->userId = $this->session->userdata('userId');
	}

	public function index(){
		$filename = $this->input->get('file');
		if($this->isAdminLoggedIn){
		redirect(base_url().'uploads/'.$filename);
		}
		else{
			show_404();
		}
	}
}
