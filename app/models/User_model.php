<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {
    public function __construct() {
        parent::__construct();
        $this->table = 'users';
    }

    public function get($user_id) {
        return $this->db->table($this->table)->where('user_id', $user_id)->get();
    }

    public function get_by_verification_code($verification_code) {
        return $this->db->table($this->table)
            ->where('verification_code', $verification_code)
            ->get();
    }

    public function verify_user($user_id) {
        return $this->db->table($this->table)
            ->where('user_id', $user_id)
            ->update(['is_verified' => 1, 'verification_code' => null]);
    }

    public function get_by_email($email) {
        return $this->db->table($this->table)->where('email', $email)->get();
    }

    public function create($data) {
        return $this->db->table($this->table)->insert($data);
    }
    
}