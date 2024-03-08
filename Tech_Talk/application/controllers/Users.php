<?php
	class Users extends CI_Controller{
		public function __construct() {
			parent::__construct();
			$this->load->library('form_validation');
			  $this->load->model('user_model');
			
		}
		// Register user
		public function register(){
			$data['title'] = 'Sign Up';

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			} else {
				// Encrypt password
				$password = $this->input->post('password');

				$this->user_model->register($password);

				// Set message
				$this->session->set_flashdata('user_registered', 'You are now registered and can log in');

				redirect('posts');
			}
		}

		// Log in user
		public function login(){
			// Set form validation rules
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
		
			if($this->form_validation->run() === FALSE){
				// Load views with form errors
				$this->load->view('templates/header');
				$this->load->view('users/login');
				$this->load->view('templates/footer');
			} else {
				// Attempt to log in the user
				$user_id = $this->user_model->login();
		
				if($user_id){
					// Create session data if login is successful
					$user_data = array(
						'user_id' => $user_id,
						'username' => $this->input->post('username'),
						'logged_in' => TRUE
					);
		
					$this->session->set_userdata($user_data);
		
					// Set success message and redirect
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');
					redirect('posts');
				} else {
					// Set error message and redirect if login failed
					$this->session->set_flashdata('login_failed', 'Login is invalid');
					redirect('users/login');
				}       
			}
		}
		

		// Log user out
		public function logout(){
			// Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');

			// Set message
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');

			redirect('users/login');
		}

		// Check if username exists
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
			if($this->user_model->check_username_exists($username)){
				return true;
			} else {
				return false;
			}
		}

		// Check if email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
			if($this->user_model->check_email_exists($email)){
				return true;
			} else {
				return false;
			}
		}
	}