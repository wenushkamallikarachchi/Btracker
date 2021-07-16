<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookmarkManager extends CI_Controller{
    public function index()
    {
        // Get the user id from session
        $userId = $this->session->userdata("userId");
        if ($userId == null) {
            // Load the login view
            $this->load->view('login');
        } else {
            // Load the bookmark list view
            $this->load->view('bookmarklist');
        }
    }

    public function bookmarkItem() {
        // Get the user id from session
        $userId = $this->session->userdata("userId");
        if($userId == null) {
            // Load the login view
            $this->load->view('login');
        }
        else {
            // Load the bookmark list item view
            $this->load->view('bookmarklistitem');
        }
    }
}