<?php

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model("sessions_model");
		$this->load->model("user_details_model");
	}

	public function index(){
		
		if($this->sessions_model->is_logged_in()){
			redirect("/home");
			exit();
		}
		
		$data["title"] = "Login";
		
		$this->load->view('../includes/header.php', $data);
		$this->load->view('login_view');
		$this->load->view('../includes/footer.php');
	}
	
	/***********************************
	* Function that validates the username and password fields
	* Uses the form validation library
	************************************/
	public function validate(){
		
		if($this->sessions_model->is_logged_in()){
			redirect("/home");
			exit();
		}
		
		$this->form_validation->set_rules("username","username","trim|required|max_length[20]");
		$this->form_validation->set_rules("password","password","required||max_length[30]");
		
		if($this->form_validation->run() == false){
			
			$data["title"] = "Login";

			$this->load->view('../includes/header.php', $data);
			$this->load->view('login_view');
			$this->load->view('../includes/footer.php');
		}
		else{
			
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			
			$result = $this->user_details_model->check_user($username, $password);
			
			if($result != false){
				$data = array(
					"username" => $username,
					"user_id" => $result,
					"logged_in" => true
				);
				
				setcookie(
					$this->config->item('sess_cookie_name'), // Use the session cookie name from config
					session_id(), // Use the current session ID
					time() + $this->config->item('sess_expiration'), // Use the session expiration time from config
					$this->config->item('cookie_path'), // Use the cookie path from config
					$this->config->item('cookie_domain'), // Use the cookie domain from config
					$this->config->item('cookie_secure'), // Use the cookie secure flag from config
					$this->config->item('cookie_httponly') // Use the cookie HttpOnly flag from config
				);
		
				// Redirect to the home page or dashboard
				redirect('/home');
			}
			else{
				
				$data["title"] = "Login";
				$data["error"] = "Login unsuccessful. Please try again.";
				$this->load->view('../includes/header.php', $data);
				$this->load->view('login_view');
				$this->load->view('../includes/footer.php');
			}
		}
	}
}

?>