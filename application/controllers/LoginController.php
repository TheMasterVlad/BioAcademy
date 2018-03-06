<?php 
class LoginController extends CI_Controller{
	
		public function index()
		{		
			$this->load->view('LoginView.php');
		}
		
			public function CheckLogin()
		{		
			$this->form_validation->set_rules('login','Login','required|valid_email');
			$this->form_validation->set_rules('password','Password','required|callback_varifyUser');
			if($this->form_validation->run() == false){
				$this->load->view('LoginView.php');
			} else {
				
			}
			$this->load->view('HomepageView.php');
		}
		
		public function varifyUser(){
			$login = $this->input->post('login');
			$password = $this->input->post('password');
		}
} 

?>