<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // load form validation library
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    // login method
    public function login()
    {
        // check if user is already logged in
        if($this->session->userdata('logged_in'))
        {
            // redirect to home page
            redirect(base_url());
        }
        else
        {
            // set form validation rules
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            // run form validation
            if ($this->form_validation->run() == FALSE)
            {
                // load login view with errors
                $this->load->view('login_view');
            }
            else
            {
                // get user input
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                // get user details from database
                $this->db->where('Email', $email);
                $query = $this->db->get('tblusers');
                $user = $query->row();

                // verify password
                if ($user && password_verify($password, $user->Password))
                {
                    // set session data
                    $userdata = array(
                        'id' => $user->id,
                        'email' => $user->Email,
                        'first_name' => $user->FirstName,
                        'last_name' => $user->LastName,
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($userdata);

                    // set flash message
                    $this->session->set_flashdata('success', 'You have logged in successfully.');

                    // redirect to home page
                    redirect(base_url());
                }
                else
                {
                    // set flash message
                    $this->session->set_flashdata('error', 'Invalid email or password.');

                    // redirect to login page
                    redirect(base_url('login'));
                }
            }
        }
    }

    // signup method
    public function signup()
    {
        // check if user is already logged in
        if($this->session->userdata('logged_in'))
        {
            // redirect to home page
            redirect(base_url());
        }
        else
        {
            // set form validation rules
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tblusers.Email]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

            // run form validation
            if ($this->form_validation->run() == FALSE)
            {
                // load login view with errors
                $this->load->view('signup_view');
            }
            else
            {
                // get user input
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                // hash the password
                $password = password_hash($password, PASSWORD_DEFAULT);

                // prepare user data
                $user_data = array(
                    'FirstName' => $first_name,
                    'LastName' => $last_name,
                    'Email' => $email,
                    'Password' => $password
                );

                // insert user data into database
                $this->db->insert('tblusers', $user_data);

                // set flash message
                $this->session->set_flashdata('success', 'You have registered successfully. Please login to continue.');

                // redirect to login page
                redirect(base_url('login'));
            }
        }
    }

    // logout method
    public function logout()
    {
        // check if user is logged in
        if($this->session->userdata('logged_in'))
        {
            // unset session data
            $this->session->unset_userdata(array('id', 'email', 'first_name', 'last_name', 'logged_in'));

            // set flash message
            $this->session->set_flashdata('success', 'You have logged out successfully.');

            // redirect to login page
            redirect(base_url('login'));
        }
        else
        {
            // redirect to home page
            redirect(base_url('login'));
        }
    }
}
