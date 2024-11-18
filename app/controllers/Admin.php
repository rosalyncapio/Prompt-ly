<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Admin extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->call->library('session');
        $this->call->library('lauth');
        
        // Check if user is logged in and is an admin
        if (!$this->lauth->is_logged_in() || $this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'You do not have permission to access the admin area.');
            redirect('login');
        }
    }

    public function dashboard() {
        $this->call->view('admin/dashboard');
    }

    public function prompts() {
        // Load prompts data and view
        $this->call->view('admin/prompts');
    }

    public function users() {
        // Load users data and view
        $this->call->view('admin/users');
    }

    public function entries() {
        // Load entries data and view
        $this->call->view('admin/entries');
    }

    public function votes() {
        // Load votes data and view
        $this->call->view('admin/votes');
    }
    
    public function logout()
    {
        $this->lauth->set_logged_out();
        redirect('login');
    }

}