<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reservations extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('reservation_model');
		$this->load->model('user_model');
		$this->load->model('topic_model');
		$this->load->model('config_model');
		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
		$this->isAdminLoggedIn = $this->session->userdata('isAdminLoggedIn');
		
	}
	public function create($topicId){
		if(!($this->isUserLoggedIn OR $this->isAdminLoggedIn)){
			redirect(site_url('users/login'));
		}

		$userId = $this->session->userdata('userId');

		if($this->reservation_model->checkIfReservationExist($userId)==0){
		
		$insertData = array(
			'user_id' => $userId,
			'topic_id' => $topicId,
		);

		if(empty($this->input->get('cat',TRUE)) AND empty($this->input->get('desc',TRUE))){
			$insertData += array(
				'category' => $this->input->post('category',TRUE),
				'description' => $this->input->post('desc',TRUE),
				'accepted'=>1
			);
			$wait = '';
		}
		else{
			$insertData += array(
				'category' =>$this->input->get('cat',TRUE),
				'description' =>$this->input->get('desc',TRUE),
				'accepted'=>0
			);
			$wait = ' Oczekuj teraz na akceptację przez prowadzącego.';
		}
		
		$insert = $this->reservation_model->createReservation($insertData);

		if($insert){
			$message = array(
				'msgType' => 'success',
				'msgText'=>'Rezerwacja dokonana pomyślnie.'.$wait
			);
			
			$this->session->set_flashdata( $message );

			// $debugData = array(
			// 	'topic'=>$newTopic['category'],
			// 	'reservation'=>$newTopic['description']
			// );
	
			// $this->load->view('debug/index',$debugData);

			redirect(site_url('topics'));
			
		}
		else{
			
			$message = array(
				'msgType' => 'danger',
				'msgText'=>'Rezerwacja nie została dokonana. Spróbuj ponownie później.'
			);
			
			$this->session->set_flashdata( $message );
			redirect(site_url('topics'));
		}
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

	public function custom(){
		if(!($this->isUserLoggedIn OR $this->isAdminLoggedIn)){
			redirect(site_url('users/login'));
		}

		if($this->config_model->getActualCloseDate()<date('Y-m-d')){
			$message = array(
				'msgType'=>'danger',
				'msgText'=>'Czas na rezerwację tematów upłynął. '.$this->closeDate
			);

			$this->session->set_flashdata($message);

			redirect(base_url());
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
		$this->load->view('reservations/custom',$data);
		$this->load->view('templates/footer');
	}

	public function show($id){
		if(!$this->session->userdata('isAdminLoggedIn')){
			redirect(base_url());
		}
		$reservation = $this->reservation_model->getReservation($id);
		$data = array(
			'logged' => $this->session->userdata('isUserLoggedIn'),
			'loggedAdmin' => $this->session->userdata('isAdminLoggedIn'),
			'reservation' => $reservation,
			'msgType' => $this->session->flashdata('msgType'),
			'msgText' => $this->session->flashdata('msgText')
		);
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('templates/header',$data);
		$this->load->view('reservations/show',$data);
		$this->load->view('templates/footer');
	}

	public function accept($id){

		$userId = $this->reservation_model->getUserIdFromReservation($id);
		$acceptStatus = $this->reservation_model->acceptReservation($id);

		if($acceptStatus){
			$from = "admin@juchol.tk";
			$to = $this->user_model->getUserMail($userId)->email;
			$subject = "Akceptacja tematu - Reservation System PRO";
			$message = 'Twój temat został zaakceptowany przez prowadzącego.<br><br>Możesz przystąpić do jego realizacji.';
			$this->email->from($from,"Reservation System PRO");
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($message);

			$this->email->send();
			$this->session->set_flashdata('msgType', 'success');
			$this->session->set_flashdata('msgText', 'Rezerwacja zaakceptowana pomyślnie! Student został poinformowany mailowo.');
		}
		else{
			$this->session->set_flashdata('msgType', 'danger');
			$this->session->set_flashdata('msgText', 'Wystąpił błąd, proszę spróbować później!');
		}
		redirect($this->ua->referrer());
	}

	public function comment($id){
		$this->form_validation->set_rules('comments','Uwagi','required');
		
		if ($this->form_validation->run()) {
			$comments = $this->input->post('comments',TRUE);
			$commentStatus = $this->reservation_model->commentReservation($id,$comments);
			if($commentStatus){
				$this->session->set_flashdata('msgType', 'success');
				$this->session->set_flashdata('msgText', 'Komentarz dodany pomyślnie!');
				
			}
			else{
				$this->session->set_flashdata('msgType', 'danger');
				$this->session->set_flashdata('msgText', 'Wystąpił błąd, proszę spróbować później!');
			}
		}
		else{
			$this->session->set_flashdata('msgType', 'danger');
			$this->session->set_flashdata('msgText', 'Wystąpił błąd, proszę spróbować później!');
		}
		redirect($this->ua->referrer());
	}

	public function delete($id){
		
		if((!$this->isAdminLoggedIn) AND ($id!=$this->session->userdata('userId'))){
			redirect(site_url('users/account'));
		}

		if(!$this->isAdminLoggedIn){
			$reservationId = $this->reservation_model->getReservationFromUserId($id)->reservation_id;
		}
		else{
			$reservationId = $id;
		}
		
		$topicId = $this->reservation_model->getReservation($reservationId)->topic_id;

		$deleteStatus = $this->reservation_model->deleteReservation($reservationId);

		if($this->topic_model->get_topic($topicId)->custom){
			$this->topic_model->deleteTopic($topicId);
		}
		

		if($deleteStatus){
			$this->session->set_flashdata('msgType', 'success');
			$this->session->set_flashdata('msgText', 'Rezerwacja usunięta pomyślnie!');
			
		}
		else{
			$this->session->set_flashdata('msgType', 'danger');
			$this->session->set_flashdata('msgText', 'Wystąpił błąd, proszę spróbować później!');
		}

		redirect(site_url('users/account'));
	}
}
