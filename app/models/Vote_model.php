<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Vote_model extends Model {
    public function __construct() {
        parent::__construct();
        $this->table = 'votes';
    }

    public function get_all() {
        // Join votes with users and prompts to retrieve all relevant data
        return $this->db->table('votes as v')
                        ->join('users as u', 'v.user_id = u.user_id') // Join with the users table
                        ->join('entries as p', 'v.entry_id = p.entry_id') // Join with the prompts table
                        ->select('v.vote_id, v.user_id, v.entry_id, v.vote_type, v.created_at, u.username, p.content as content')
                        ->get_all();
    }

    public function get($id) {
        return $this->db->table($this->table)->where('vote_id', $id)->get();
    }

    public function create($data) {
        return $this->db->table($this->table)->insert($data);
    }

    public function update($id, $data) {
        return $this->db->table($this->table)->where('vote_id', $id)->update($data);
    }

    public function delete($id) {
        return $this->db->table($this->table)->where('vote_id', $id)->delete();
    }
}
?>
