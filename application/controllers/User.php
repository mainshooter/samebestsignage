<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 26-1-2018
 * Time: 11:57
 */

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $data['this_user'] = $this->session->userdata();
        if (! $this->dx_auth->is_logged_in()){
            $this->session->sess_destroy();
            redirect('auth/login');
        }

        $this->load->helper('form_helper');
        $this->load->database();
    }

    public function edituser(){
        $data['this_user'] = $this->session->userdata();

        $query = $this->db->query('SELECT * FROM users WHERE id = '.$this->db->escape($this->session->userdata('DX_user_id')));
        $data['user'] = $query->row_array();

        // Load registration page
        $data['title'] = 'Profile'; // Capitalize the first letter
        $data['page_title'] = 'Profile'; // Capitalize the first letter
        $data['page_title_desc'] = 'Here is your information'; // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view($this->dx_auth->register_view);
        $this->load->view('templates/footer', $data);
    }
}