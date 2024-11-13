<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Prompt_model extends Model {
    public function __construct() {
        parent::__construct();
        $this->table = 'prompts';
    }

    public function get_all() {
        return $this->db->table($this->table)->get_all();
    }

    public function get($id) {
        return $this->db->table($this->table)->where('prompt_id', $id)->get();
    }

    public function create($data) {
        return $this->db->table($this->table)->insert($data);
    }

    public function edit($id, $data) {
        return $this->db->table($this->table)->where('prompt_id', $id)->update($data);
    }

    public function delete($id) {
        return $this->db->table($this->table)->where('prompt_id', $id)->delete();
    }
}