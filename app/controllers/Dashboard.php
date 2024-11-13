<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Dashboard extends Controller {
    public function __construct() {
        parent::__construct();
        // Check if user is logged in
        if (!$this->session->userdata('is_logged_in')) {
            $this->session->set_flashdata('error', 'Please login first');
            redirect('login');
        }
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['content'] = $this->call->view('admin/dashboard', [], true);
       
    }
}