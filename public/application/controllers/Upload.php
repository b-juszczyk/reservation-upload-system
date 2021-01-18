<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('config_model');
		$this->load->model('user_model');
		$this->load->model('reservation_model');
		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
		$this->isAdminLoggedIn = $this->session->userdata('isAdminLoggedIn');
		$this->userId = $this->session->userdata('userId');
	}

	public function index(){

		if(!($this->isUserLoggedIn OR $this->isAdminLoggedIn)){
			redirect(base_url());
		}
		if(!empty($this->reservation_model->getUsersReservation($this->session->userdata('userId'))->filename)){
		$userFile = $this->reservation_model->getUsersReservation($this->session->userdata('userId'))->filename;
		}
		$data = array();
		if(!empty($userFile))
		{
			$data['didUserUploadFile'] = TRUE;
		}
		else{
			$data['didUserUploadFile'] = FALSE;
		}
		$data['logged'] = $this->isUserLoggedIn;
		$data['loggedAdmin'] = $this->isAdminLoggedIn;
		$data['msgType'] = $this->session->flashdata('msgType');
		$data['msgText'] = $this->session->flashdata('msgText');
		$data['csrf'] = array(
		   'name' => $this->security->get_csrf_token_name(),
		   'hash' => $this->security->get_csrf_hash()
		); 
		if($this->config_model->getActualFileCloseDate()<date('Y-m-d')){
			$message = array(
				'msgType'=>'danger',
				'msgText'=>'Czas na przesyłanie projektów upłynął.'
			);
			$this->session->set_flashdata($message);

			redirect(base_url());
		}
		
		if($this->input->post('uploadSubmit') != NULL ){ 
		   
		   if(!empty($_FILES['file']['name'])){
			   $name = $this->user_model->getNameFromId($this->session->userdata('userId'));
			   $date = date('d-m-Y'); 
			  
			  $config['upload_path'] = 'uploads/'; 
			  $config['allowed_types'] = 'zip';
			  $config['overwrite'] = TRUE; 
			  $config['max_size'] = '8000'; // max_size in kb 
			  $config['file_name'] = $name.'_'.$date.'_TSW_Projekt'; 
			  
			  $this->upload->initialize($config); 
		
			  if($this->upload->do_upload('file')){ 
				 
				 $uploadData = $this->upload->data(); 
				 $filename = $uploadData['file_name'];
				 if($this->reservation_model->setProjectAsSended($this->session->userdata('userId'),$filename)){ 
				 
				 	$data['msgType'] = 'success';
					$data['msgText'] = 'Plik został dodany pomyślnie.';
					$from = "admin@juchol.tk";
					$to = $this->user_model->getUserMail($this->session->userdata('userId'))->email;
					$subject = "Powiadomienie - Reservation System PRO";
					$message = 'Twój projekt został wgrany do systemu.<br>Oczekuj teraz na ocenę przez prowadzącego';
					
					$this->email->from($from,"Reservation System PRO");
					$this->email->to($to);
					$this->email->subject($subject);
					$this->email->message($message);
		
					$this->email->send();
				}
				else
				{
					$data['msgType'] = 'danger';
					$data['msgText'] = 'Nie posiadasz żadnych rezerwacji.';
					unlink('uploads/'.$filename);
				}
			  }else{
				
				$data['msgType'] = 'danger';
					$data['msgText'] = 'Wystąpił błąd: '.$this->upload->display_errors('', '');
				
				
			  } 
		   }else{ 
			$data['msgType'] = 'danger';
			$data['msgText'] = 'Wystąpił błąd: '.$this->upload->display_errors('', '');
		   } 
		  
		$this->load->view('templates/header',$data);
		$this->load->view('upload/index',$data);
		$this->load->view('templates/footer'); 
		}else{
			$this->load->view('templates/header',$data);
		   $this->load->view('upload/index',$data);
		   $this->load->view('templates/footer'); 
		}
		
		
	  }
}