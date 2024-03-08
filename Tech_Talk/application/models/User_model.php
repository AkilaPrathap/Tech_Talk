<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Make sure to load the database library
        $this->load->database('users');
        // Load any other necessary models here
    }

    public function register($password)
    {
        // User data array
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $password, // Make sure this is the hashed password
            'zipcode' => $this->input->post('zipcode')
        );

        // Insert user
        return $this->db->insert('users', $data);
    }

	
	public function login()
{
    // Fetch username and password from POST data
    $username = $this->input->post('username');
    $input_password = $this->input->post('password');

    // Validate
    $this->db->where('username', $username);
    $result = $this->db->get('users');

    // Check if any user is found
    if ($result->num_rows() == 1) {
        $user_data = $result->row(0);

        // Compare the input password with the one stored in the database
        if ($input_password === $user_data->password) {
            // Return user ID if password is correct
            return $user_data->id;
        } else {
            // Password is incorrect
            return false;
        }
    } else {
        // No user found with the given username
        return false;
    }
}


    // Check if username exists
    public function check_username_exists($username)
    {
        $query = $this->db->get_where('users', array('username' => $username));
        if (empty($query->row_array())) {
            return true; // Username does not exist
        } else {
            return false; // Username exists
        }
    }

    // Check if email exists
    public function check_email_exists($email)
    {
        $query = $this->db->get_where('users', array('email' => $email));
        if (empty($query->row_array())) {
            return true; // Email does not exist
        } else {
            return false; // Email exists
        }
    }
}
