<?php
class Auth extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('Form_validation');
		
		$this->load->helper('url_helper');
		$this->load->helper('form_helper');
        $data['this_user'] = $this->session->userdata();

        $this->load->database();

        $this->load->model('user');
	}

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
	
	public function logout()
	{
        $this->session->sess_destroy();
        redirect('login');
	}

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

	public function reset($hash){
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
?>