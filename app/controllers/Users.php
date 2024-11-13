<?php 
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Users extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->model('User_model');    
    }

    public function index() {
        // Retrieve non-admin users only
        $data['users'] = $this->User_model->get_non_admins();
        $this->call->view('admin/users/index', $data);
    }
}
