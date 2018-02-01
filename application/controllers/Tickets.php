<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 18-1-2018
 * Time: 16:57
 */

class Tickets extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('DX_Auth');
        if (! $this->dx_auth->is_logged_in()){
            $this->session->sess_destroy();
            redirect('auth/login');
        }
        $data['this_user'] = $this->session->userdata();
        $this->load->database();
    }

    public function view($id = null){
        $data['this_user'] = $this->session->userdata();
        $data['ticket'] = $this->fetch($this->uri->segment('2'));

        $query = $this->db->query('SELECT * FROM status_types ');
        $data['statuses'] = $query->result_array();

        $data['title'] = 'Ticket: ' . $this->uri->segment('2');
        $data["page_title"] = '';
        $data["page_title_desc"] = '';

        $this->load->view('templates/header', $data);
        $this->load->view('ticket/view.php', $data);
        $this->load->view('templates/footer', $data);
    }

    public function fetch($id){
        $query = $this->db->query('
          SELECT * FROM tickets 
           JOIN alert_types ON tickets.ticket_type = alert_types.alert_id
           JOIN status_types ON tickets.ticket_status = status_types.status_id
           JOIN importance_types ON tickets.ticket_importance = importance_types.importance_id
           WHERE ticket_id = '.$this->db->escape($id).'
           ');

        return $query->row_array();
    }

    public function add(){
        $data['this_user'] = $this->session->userdata();

        $query = $this->db->query('SELECT id, username, email FROM users ');
        $data['users'] = $query->result_array();

        $query = $this->db->query('SELECT * FROM alert_types ');
        $data['categorys'] = $query->result_array();

        $query = $this->db->query('SELECT * FROM status_types ');
        $data['statuses'] = $query->result_array();

        $query = $this->db->query('SELECT * FROM importance_types ');
        $data['importances'] = $query->result_array();

        $data['title'] = 'Add Ticket';
        $data["page_title"] = 'Add Ticket';
        $data["page_title_desc"] = 'Here you can create a ticket';

        $this->load->view('templates/header', $data);
        $this->load->view('ticket/add.php', $data);
        $this->load->view('templates/footer', $data);
    }

}