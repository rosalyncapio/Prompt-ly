<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Entry_model extends Model {
    public function __construct() {
        parent::__construct();
        $this->table = 'entries';
    }

    public function get_all() {
        return $this->db->table($this->table . ' as e')
                        ->join('users as u', 'e.user_id = u.user_id') // Join with users
                        ->join('prompts as p', 'e.prompt_id = p.prompt_id') // Join with prompts
                        ->select('e.*, u.username, p.title AS prompt_title') // Select relevant columns
                        ->get_all();
    }

    public function get($entry_id) {
        return $this->db->table($this->table . ' as e')
                        ->join('users as u', 'e.user_id = u.user_id') // Join with users
                        ->join('prompts as p', 'e.prompt_id = p.prompt_id') // Join with prompts
                        ->select('e.*, u.username, p.title AS prompt_title') // Select relevant columns
                        ->where('e.entry_id', $entry_id) // Filter by entry_id
                        ->get();
    }


    public function delete($entry_id) {
        // Delete an entry by its ID
        return $this->db->table($this->table)
                        ->where('entry_id', $entry_id)
                        ->delete();
    }
}
