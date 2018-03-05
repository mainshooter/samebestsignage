<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 26-1-2018
 * Time: 11:57
 */

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $data['this_user'] = $this->session->userdata();
        if (! $this->session->userdata('DX_logged_in')){
            $this->session->sess_destroy();
            redirect('auth/login');
        }

        $this->load->helper('form_helper');

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

    public function edituser(){
        $data = $this->data;
        $data['this_user'] = $this->session->userdata();
        $data['user'] = $this->user->get_single_entry($this->session->userdata('DX_user_id'));

        // Load registration page
        $data['title'] = 'Profile';

        $this->load->view('templates/header', $data);
        $this->load->view('auth/register');
        $this->load->view('templates/footer', $data);
    }
}