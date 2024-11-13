<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Entries extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->model('Entry_model');
    }

    public function index() {
        // Retrieve all entries
        $data['entries'] = $this->Entry_model->get_all();
        $this->call->view('admin/entries/index', $data);
    }
    public function assignBadgeToTopEntry() {
        // Step 1: Fetch the entry with the highest upvotes
        $top_entry = $this->db->table('entries')
                              ->select('*')
                              ->orderBy('upvotes', 'DESC')
                              ->limit(1)
                              ->get();

        if ($top_entry) {
            // Step 2: Define a badge for the top entry
            $badge_id = 1; // Assuming '1' is the ID of the badge for the top-voted entry

            // Step 3: Update the top entry to assign the badge
            $this->db->table('entries')
                     ->where('entry_id', $top_entry['entry_id'])
                     ->update(['badge_id' => $badge_id]);
            
            echo "Badge assigned to entry with ID: " . $top_entry['entry_id'];
        }
    }


    public function delete($entry_id) {
        if ($this->Entry_model->delete($entry_id)) {
            $this->session->set_flashdata('success', 'Entry deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete entry');
        }
        redirect('entries');
    }
}
