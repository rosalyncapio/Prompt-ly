<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Home extends Controller {
    public function index() {
        $this->call->view('home/index');
    }
}