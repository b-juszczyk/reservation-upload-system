<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('reservation_model');
		$this->load->model('topic_model');
		

		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
		$this->isAdminLoggedIn = $this->session->userdata('isAdminLoggedIn');
		$this->userId = $this->session->userdata('userId');
	}
	

	public function deleteUser($userId){
		if($this->user_model->deleteUser($userId)){
			
			$message = array(
				'msgType' => 'success',
				'msgText' => 'Użytkownik został usunięty.'
			);

			$this->session->set_flashdata($message);

			
		}
		else{
			$message = array(
				'msgType' => 'danger',
				'msgText' => 'Wystąpił błąd. Proszę spróbować później.'
			);

			$this->session->set_flashdata($message);
		}

		redirect(site_url('users/account'));
	}

	public function topic($topicId){
		$topic = $this->topic_model->get_topic($topicId);
		$data = array();
		$data["logged"] = $this->isUserLoggedIn;
		$data["loggedAdmin"] = $this->isAdminLoggedIn;
		$data["msgType"] = $this->session->flashdata('msgType');
		$data["msgText"] = $this->session->flashdata('msgText');
		$data['topic'] = $topic;

		$this->load->view('templates/header',$data);
		$this->load->view('admin/topic',$data);
		$this->load->view('templates/footer');
	}

	public function editTopic($topicId){
		if($this->input->post('editSubmit',TRUE)){
		$editData = array(
			'title' => $this->input->post('title',TRUE),
			'topicDescription' => $this->input->post('description',TRUE),
			'updated_at' => date('Y-m-d H:i:s')
		);
		
		if($this->topic_model->editTopic($topicId,$editData)){
			
			$message = array(
				'msgType' => 'success',
				'msgText' => 'Temat zaktualizowany pomyślnie.'
			);

			$this->session->set_flashdata($message);

			
			
			redirect(site_url('admin/topic/'.$topicId));
		}
		else{

			$message = array(
				'msgType' => 'danger',
				'msgText' => 'Wystąpił błąd. Proszę spróbować później.'
			);

			$this->session->set_flashdata($message);
			
			redirect(site_url('admin/topic/'.$topicId));

		}
	}
		$topic = $this->topic_model->get_topic($topicId);
		$data = array();
		$data['topic'] = $topic;
		$data["logged"] = $this->isUserLoggedIn;
		$data["loggedAdmin"] = $this->isAdminLoggedIn;
		$data["msgType"] = $this->session->flashdata('msgType');
		$data["msgText"] = $this->session->flashdata('msgText');

		$this->load->view('templates/header',$data);
		$this->load->view('admin/editTopic',$data);
		$this->load->view('templates/footer');
	
	}

	public function deleteTopic($topicId){
		if($this->topic_model->deleteTopic($topicId)){
			
			$message = array(
				'msgType' => 'success',
				'msgText' => 'Temat został usunięty poprawnie.'
			);

			$this->session->set_flashdata($message);

			
		}
		else{
			$message = array(
				'msgType' => 'danger',
				'msgText' => 'Wystąpił błąd. Proszę spróbować później.'
			);

			$this->session->set_flashdata($message);

			
		}
		redirect(site_url('users/account'));
	}
	public function addTopic(){
		if($this->isAdminLoggedIn){
			$data = array();
			if($this->input->post('addSubmit')){
				$this->form_validation->set_rules('title','Tytuł','required');
				$this->form_validation->set_rules('description','Opis','required');
				if($this->form_validation->run()){
				$insertData = array(
					'title' => $this->input->post('title'),
					'topicDescription' => $this->input->post('description'),
					'created_at' => date('Y-m-d H:i:s'),
				);
				if($this->topic_model->insertNewTopic($insertData)){
					$data['msgType'] = 'success';
					$data['msgText'] = 'Temat dodany poprawnie.';
				}
				else{
					$data['msgType'] = 'danger';
					$data['msgText'] = 'Wystąpił błąd. Proszę spróbować później.';
				}
			}
			else{
				$data['msgType'] = 'danger';
					$data['msgText'] = 'Wystąpił błąd. Proszę sprawdzić poprawność wpisanych informacji.';
			}

			}

		$data["logged"] = $this->isUserLoggedIn;
		$data["loggedAdmin"] = $this->isAdminLoggedIn;
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);

		$this->load->view('templates/header',$data);
		$this->load->view('admin/addTopic',$data);
		$this->load->view('templates/footer');
		}
		else{
			redirect(base_url());
		}
	}
}