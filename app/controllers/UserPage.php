<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Users extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->library('session');
        $this->call->library('lauth');
        $this->call->model('UserPage_model');
        
        // Check if user is logged in
        if (!$this->lauth->is_logged_in()) {
            $this->session->set_flashdata('error', 'Please login to access your account.');
            redirect('login');
        }
    }

    public function userpage() {
        // Get user data
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->UserPage_model->get_user_by_id($user_id);
        
        // Get user's prompts
        $data['prompts'] = $this->UserPage_model->get_user_prompts($user_id);
        
        // Get user's entries
        $data['entries'] = $this->UserPage_model->get_user_entries($user_id);
        
        // Get user's votes
        $data['votes'] = $this->UserPage_model->get_user_votes($user_id);
        
        $this->call->view('users/userpage', $data);
    }
}