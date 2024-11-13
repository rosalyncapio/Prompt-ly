<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {
    public function __construct() {
        parent::__construct();
        $this->table = 'users';
    }

    public function get_non_admins() {
        // Retrieves all users except those with is_admin set to true
        return $this->db->table($this->table)->where('is_admin', false)->get_all();
    }

    public function get($id) {
        return $this->db->table($this->table)->where('user_id', $id)->get();
    }

    public function create($data) {
        return $this->db->table($this->table)->insert($data);
    }

    public function update($id, $data) {
        return $this->db->table($this->table)->where('user_id', $id)->update($data);
    }

    public function delete($id) {
        return $this->db->table($this->table)->where('user_id', $id)->delete();
    }

    public function get_by_email($email) {
        return $this->db->table($this->table)->where('email', $email)->get();
    }
}
