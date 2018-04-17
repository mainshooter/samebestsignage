<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 26-1-2018
 * Time: 11:57
 */

class Users extends CI_Controller
{
    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    /**
     *
     */
    public function login()
    {
        $data['this_user'] = $this->session->userdata();
        if ( !  $this->session->userdata('DX_logged_in'))
        {
            $data['title'] = 'Login'; // Capitalize the first letter

            // Load login page view
            $this->load->view('templates/header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {
            redirect('/home');
        }
    }

    /**
     *
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    /**
     *
     */
    public function forgot(){
        if (! $this->session->userdata('DX_logged_in'))
        {
            $data['title'] = 'Login'; // Capitalize the first letter

            // Load login page view
            $this->load->view('templates/header', $data);
            $this->load->view('auth/forgot', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {
            redirect('/home');
        }
    }

    /**
     * @param $hash
     */
    public function reset($hash){
        $this->load->model('user');
        if (! $this->session->userdata('DX_logged_in')) {

            $user = $this->user->get_single_entry_by_hash($hash);
            if (!empty($user)) {
                $data['user'] = $user;
                $data['title'] = 'Reset Password'; // Capitalize the first letter

                // Load login page view
                $this->load->view('templates/header', $data);
                $this->load->view('auth/reset', $data);
                $this->load->view('templates/footer', $data);
            } else {
                echo 'User does\'t exist';
            }
        } else {
            redirect('/home');
        }
    }
}