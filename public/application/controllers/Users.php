<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {

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
	
	public function login()
	{

		if($this->isUserLoggedIn OR $this->isAdminLoggedIn){
			redirect(site_url('users/account'));
		}

		$data = array();
		$data["msgType"] = $this->session->flashdata('msgType');
		$data["msgText"] = $this->session->flashdata('msgText');
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		if ($this->input->post('loginSubmit', TRUE)) {
			$this->form_validation->set_rules('password', 'Hasło', 'required|min_length[6]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			if ($this->form_validation->run() == true) {
				$con = array(
					'returnType' => 'single',
					'conditions' => array(
						'email' => $this->input->post('email', TRUE),
						'password' => md5($this->input->post('password', TRUE)),
						'status'=>1
					)
				);
				$checkLogin = $this->user_model->getRows($con);

				if ($checkLogin) {
					$this->session->set_userdata('isUserLoggedIn', TRUE);
					$this->session->set_userdata('userId', $checkLogin['id']);
					redirect(site_url('users/account'));
				} else {
					$data['msgType'] = 'danger';
					$data['msgText'] = 'Błędny e-mail lub hasło!';
				}

				$con = array(
					'returnType' => 'single',
					'conditions' => array(
						'email' => $this->input->post('email', TRUE),
						'password' => md5($this->input->post('password', TRUE)),
						'status' => 2
					)
				);
				$checkAdmin = $this->user_model->getRows($con);
				if ($checkAdmin) {
					$this->session->set_userdata('isAdminLoggedIn', TRUE);
					$this->session->set_userdata('userId', $checkAdmin['id']);
					redirect(site_url('users/account'));
				} else {
					$data['msgType'] = 'danger';
					$data['msgText'] = 'Błędny e-mail lub hasło!';
				}
			} else {
				$data['msgType'] = 'danger';
				$data['msgText'] = 'Proszę poprawnie uzupełnić wszystkie pola!';
			}
		}
		$data["logged"] = $this->isUserLoggedIn;
		$data["loggedAdmin"] = $this->isAdminLoggedIn;
		
		$this->load->view('templates/header',$data);
		$this->load->view('user/login',$data);
		$this->load->view('templates/footer');
	}

	public function registration()
	{
		if($this->isUserLoggedIn OR $this->isAdminLoggedIn){
			redirect(site_url('users/account'));
		}

		if($this->input->post('registerSubmit',TRUE)){
			$activateToken = random_string('alnum',30);
			$config = array(
				array(
					'field' => 'first_name',
					'label' => 'Imię',
					'rules' => 'required'
				),
				array(
					'field' => 'last_name',
					'label' => 'Nazwisko',
					'rules' => 'required'
				),
				array(
					'field' => 'email',
					'label' => 'E-mail',
					'rules' => 'required|valid_email|is_unique[users.email]'
				),
				array(
					'field' => 'password',
					'label' => 'Hasło',
					'rules' => 'required|min_length[6]'
				),
				array(
					'field' => 'confpassword',
					'label' => 'Potwierdź hasło',
					'rules' => 'required|matches[password]'
				),
			);

			$this->form_validation->set_rules($config);
			if($this->form_validation->run()){
				$userData = array(
					'first_name' => $this->input->post('first_name',TRUE),
					'last_name' => $this->input->post('last_name',TRUE),
					'email' => $this->input->post('email',TRUE),
					'password' => md5($this->input->post('password',TRUE)),
					'created_at' => date('Y-m-d H:i:s'),
					'activate_token' => $activateToken
				);
				

				if($this->user_model->addUser($userData)){
					$message = array(
						'msgType' => 'success',
						'msgText' => 'Konto zostało utworzone. Na podany adres e-mail został wysłany link do aktywacji.'
					);

					$this->session->set_flashdata($message);
					
					$from = "admin@juchol.tk";
					$to = $userData['email'];
					$subject = "Aktywacja konta - Reservation System PRO";
					$message = 'Link do aktywacji konta: <a href="http://vue.ci/users/activateUser?token='.$activateToken.'">http://vue.ci/users/activateUser?token='.$activateToken.'</a>';
		$this->email->from($from,"Reservation System PRO");
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();
				}
				else{
					$message = array(
						'msgType' => 'danger',
						'msgText' => 'Wystąpił błąd. Proszę spróbować później.'
					);

					$this->session->set_flashdata($message);
				}
				

				redirect(base_url());

			}

		}
		
		

		$data["logged"] = $this->isUserLoggedIn;
		$data["loggedAdmin"] = $this->isAdminLoggedIn;
		$data["msgType"] = $this->session->flashdata('msgType');
		$data["msgText"] = $this->session->flashdata('msgText');
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('templates/header',$data);
		$this->load->view('user/register',$data);
		$this->load->view('templates/footer');
	}

	public function account(){
		
		$data = array();
		$con = array(
			'id' => $this->session->userdata('userId')
		);
		$data['user'] = $this->user_model->getRows($con);
		$data['logged'] = $this->isUserLoggedIn;
		
		$data['msgType'] = $this->session->flashdata('msgType');
		$data['msgText'] = $this->session->flashdata('msgText');
		if ($this->isUserLoggedIn) {
			$data['reservation'] = $this->reservation_model->getUsersReservation($this->userId);
			$this->load->view('templates/header',$data);
			$this->load->view('user/account', $data);
			$this->load->view('templates/footer');
		} elseif($this->isAdminLoggedIn) {
			$data['users'] = $this->user_model->getAllUsers();
			$data['loggedAdmin'] = $this->isAdminLoggedIn;
			$data['reservations'] = $this->reservation_model->getAllReservationsForAdmin();
			$data['topics'] = $this->topic_model->getAllTopicsForAdmin();
			$this->load->view('templates/header',$data);
			$this->load->view('admin/index', $data);
			$this->load->view('templates/footer');
		}

	}

	public function logout()
	{
		$this->session->unset_userdata('isUserLoggedIn');
		$this->session->unset_userdata('isAdminLoggedIn');
		$this->session->unset_userdata('userId');
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function resetPassword($userId){
		$resetToken = random_string('alnum',30);
		if($this->user_model->addResetToken($userId,$resetToken))
		{
			$from = "admin@juchol.tk";
			$to = $this->user_model->getUserMail($userId)->email;
			$subject = "Przypomnienie hasła - Reservation System PRO";
			$message = 'Link do przypomnienia hasła: <a href="http://vue.ci/users/changePassword?token='.$resetToken.'">http://vue.ci/users/changePassword?token='.$resetToken.'</a>';
			
			$this->email->from($from,"Reservation System PRO");
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($message);

			$this->email->send();

			$message = array(
				'msgType' => 'success',
				'msgText' => 'Link do zmiany hasła został wysłany na Twój e-mail.'
			);
			
			$this->session->set_flashdata($message);
			

			if($this->isUserLoggedIn OR $this->isAdminLoggedIn){
			redirect(site_url('users/account'));
			}
			else{
				redirect(site_url('users/login'));
			}

		}

	}

	public function changePassword(){
		$data = array();
		if($this->isUserLoggedIn OR $this->isAdminLoggedIn){
			$userId = $this->userId;
			$status = 1;
		}
		elseif(!empty($this->input->get('token',TRUE))){
			$token = $this->input->get('token',TRUE);
			
			if($this->user_model->checkResetToken($token)){
				$status = 1;
				$reset = 1;
				$userId = $this->user_model->getUserIdFromToken($token)->id;
			}
			else{
				show_404();
			}
		}
		else{
			redirect(base_url());
		}
		
		if($status){
			if($this->input->post('changePassword',TRUE)){
				$this->form_validation->set_rules('passwd','Hasło','required|matches[confPasswd]|min_length[6]');
				$this->form_validation->set_rules('confPasswd','Potwierdź hasło','required');
				$this->form_validation->set_message('matches', 'Hasła nie są identyczne!');
	
					if ($this->form_validation->run()) {
						$password = md5($this->input->post('passwd',TRUE));
						if($this->user_model->setNewPassword($userId,$password)){			
							if(!$reset){
								$array = array(
									'msgType' => 'success',
									'msgText' => 'Hasło zostało zmienione.'
								);
							}
							else{		
								$array = array(
									'msgType' => 'success',
									'msgText' => 'Hasło zostało zmienione. Zaloguj się przy użyciu nowego hasła.'
							);
						}
						$this->session->set_flashdata( $array );
						if(!$reset){
						redirect(site_url('users/account'));
						}
						else{
							redirect(site_url('users/login'));
						}
					}
					
				}
				
			}
			$data = array(
				"logged" => $this->isUserLoggedIn,
				"loggedAdmin" => $this->isAdminLoggedIn,
				"msgType" => $this->session->flashdata('msgType'),
				"msgText" => $this->session->flashdata('msgText'),
			);
			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);
			$this->load->view('templates/header',$data);
			$this->load->view('user/changePassword', $data);
			$this->load->view('templates/footer');
		}
		
		

		
	}
	public function showResetForm(){
		$data = array(
			"logged" => $this->isUserLoggedIn,
			"loggedAdmin" => $this->isAdminLoggedIn,
			"msgType" => $this->session->flashdata('msgType'),
			"msgText" => $this->session->flashdata('msgText'),
		);
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->form_validation->set_rules('email','e-mail','required|valid_email');
		if($this->form_validation->run()){
			$email = $this->input->post('email',TRUE);
			if($this->user_model->getUserIdFromEmail($email))
			{
				$userId = $this->user_model->getUserIdFromEmail($email)->id;
			}
			else{
				$data['msgType'] = 'danger';
				$data['msgText'] = 'Nie znaleziono użytkownika z podanym adresem e-mail.';
			}
			if(!empty($userId)){
				$this->resetPassword($userId);
			}
		}
		
		$this->load->view('templates/header',$data);
		$this->load->view('user/reset', $data);
		$this->load->view('templates/footer');
	}

	public function activateUser(){
		$token = $this->input->get('token',TRUE);
		if($this->user_model->activateUser($token)){
			
			$message = array(
				'msgType' => 'success',
				'msgText' => 'Konto zostało aktywowane.'
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

		redirect(site_url('users/login'));
	}
}