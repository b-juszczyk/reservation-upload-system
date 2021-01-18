<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Config extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('config_model');
		$this->isAdminLoggedIn = $this->session->userdata('isAdminLoggedIn');
	}

	public function index()
	{
		if($this->isAdminLoggedIn){
		$closeDate = $this->input->post('closeDate',TRUE);
		$closeFileDate = $this->input->post('closeFileDate',TRUE);

		if($this->input->post("configSubmit",TRUE)){
			if(!empty($closeDate)){
				if($this->config_model->setCloseDate($closeDate)){
					$data = array(
						'msgType'=>'success',
						'msgText'=>'Data zamknięcia systemu została ustawiona na '.$closeDate
					);
				}

			}
			if(!empty($closeFileDate)){
				if($this->config_model->setFileCloseDate($closeFileDate)){
					$data = array(
						'msgType'=>'success',
						'msgText'=>'Data zamknięcia systemu została ustawiona na '.$closeFileDate
					);
				}

			}
		}

		$data["logged"] = $this->session->userdata('isUserLoggedIn');
		$data["loggedAdmin"] = $this->session->userdata('isAdminLoggedIn');
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$data['date'] = $this->config_model->getActualCloseDate();
		$data['dateFile'] = $this->config_model->getActualFileCloseDate();
		$this->load->view('templates/header',$data);
		$this->load->view('config/index',$data);
		$this->load->view('templates/footer');
	}
	else{
		redirect(base_url());
	}
	}
}