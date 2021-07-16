<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserManager extends CI_Controller
{
    public function index()
    {
        
        $this->load->view('login');
    }

    public function signUp()
    {
        // Load the signup view
        $this->load->view('signup');
    }
    public function logout()
    {
        // Load the signup view
        $this->session->unset_userdata('userId');
        $this->load->view('login');
    }

}
