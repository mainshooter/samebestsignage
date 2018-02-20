<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 30-1-2018
 * Time: 10:23
 */

class Admin extends CI_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();

        if (! $this->session->userdata('DX_logged_in') ){
            $this->session->sess_destroy();
            redirect('auth/login');
        } else{
            if ($this->session->userdata('DX_role_id') >= 2){

            } else{
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }
        $data['this_user'] = $this->session->userdata();
        $this->load->database();

        $this->load->model('ticket');
        $this->load->model('clients');
        $this->load->model('user');
        $this->load->model('category');
        $this->load->model('status');
        $this->load->model('importance');
        $this->load->model('mail');
        $this->load->model('templates');
        $this->load->model('rights');
        $this->load->model('roles');
    }

    public function view($page = 'dashboard')
    {
        if ( ! file_exists(APPPATH.'views/admin/pages/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        switch ($page){
            case ('category'):
                $data['array'] = $this->category->get_all_entries();
                break;
            case ('status'):
                $data['array'] = $this->status->get_all_entries();
                break;
            case ('importance'):
                $data['array'] = $this->importance->get_all_entries();
                break;
            case ('users'):
                $data['array'] = $this->user->get_all_entries_table();
                break;
            case ('rights'):
                $data['array'] = $this->rights->get_all_entries();
                break;
            case ('mail'):
                $data['array'] = $this->mail->get_all_entries();
                break;
            case ('templates'):
                $data['array'] = $this->templates->get_all_entries();
                break;
            case ('clients'):
                $data['array'] = $this->clients->get_all_entries_full();
                break;
            default:
                break;
        }

        $data['title'] = ucfirst($page);
        $data["company"] = '';

        $data['this_user'] = $this->session->userdata();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/pages/'.$page, $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function add($page = 'dashboard')
    {
        if ( ! file_exists(APPPATH.'views/admin/pages/add/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        switch ($page){
            case ('status'):
                $data['array'] = $this->status->get_enum();
                break;
            case ('importance'):
                $data['array'] = $this->importance->get_enum();
                break;
            case ('user'):
                $data['roles'] = $this->roles->get_all_entries();
                break;
            case ('client'):
                $data['roles'] = $this->roles->get_all_entries();
                break;
            default:
                break;
        }

        $data['title'] = ucfirst($page);
        $data["company"] = '';

        $data['this_user'] = $this->session->userdata();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/pages/add/'.$page, $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function edit($page = 'dashboard', $id)
    {
        if ( ! file_exists(APPPATH.'views/admin/pages/edit/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        switch ($page){
            case ('category'):
                $this->data['array'] = $this->category->get_single_entry($id);
                break;
            case ('status'):
                $this->data['levels'] = $this->status->get_enum();
                $this->data['status'] = $this->status->get_single_entry($id);
                break;
            case ('importance'):
                $this->data['levels'] = $this->importance->get_enum();
                $this->data['status'] = $this->importance->get_single_entry($id);
                break;
            case ('user'):
                $this->data['roles'] = $this->roles->get_all_entries();
                $this->data['user'] = $this->user->get_single_entry($id);
                break;
            case ('template'):
                $this->data['array'] = $this->templates->get_single_entry($id);
                break;
            case ('client'):
                $this->data['client'] = $this->clients->get_single_entry($id);
                break;
            default:
                break;
        }

        $data = $this->data;

        $data['title'] = ucfirst($page);
        $data["company"] = '';

        $data['this_user'] = $this->session->userdata();


        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/pages/edit/'.$page, $data);
        $this->load->view('admin/templates/footer', $data);
    }
}