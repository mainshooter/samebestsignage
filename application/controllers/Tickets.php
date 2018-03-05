<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 18-1-2018
 * Time: 16:57
 */

class Tickets extends CI_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();

        if (! $this->session->userdata('DX_logged_in')){
            $this->session->sess_destroy();
            redirect('auth/login');
        }
        $data['this_user'] = $this->session->userdata();
        $this->load->database();

        $this->load->model('ticket');
        $this->load->model('clients');
        $this->load->model('user');
        $this->load->model('category');
        $this->load->model('status');
        $this->load->model('importance');
        $this->load->model('alert');

        $this->data['clients'] = $this->clients->get_all_entries();
        $this->data['users'] = $this->user->get_all_entries();
        $this->data['categorys'] = $this->category->get_all_entries();
        $this->data['statuses'] = $this->status->get_all_entries();
        $this->data['importances'] = $this->importance->get_all_entries();
        $this->data['alerts'] = $this->alert->get_all_entries_user($this->session->userdata('DX_user_id'));
    }

    public function view($id = null){
        $data = $this->data;

        $data['this_user'] = $this->session->userdata();

        $data['ticket'] = $this->ticket->get_single_entry($id);
        $data['statuses'] = $this->status->get_all_entries();
        $data['images'] = $this->image->get_group_entries($data['ticket']['ticket_images']);

        $data['title'] = 'Ticket: ' . $id;

        $this->load->view('templates/header', $data);
        $this->load->view('ticket/view.php', $data);
        $this->load->view('templates/footer', $data);
    }
}