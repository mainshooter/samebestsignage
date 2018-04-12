<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 18-1-2018
 * Time: 10:00
 */

class Pages extends CI_Controller
{
    public $data;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url_helper');
        $this->load->helper('main_helper');

        if (! $this->session->userdata('DX_logged_in')){
            $this->session->sess_destroy();
            redirect('/login');
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
        $this->load->model('mail');

        $this->data['pages'] = $this->page->get_all_entries_by_type('front');
        $this->data['dashboard'] = $this->page->get_entry_by_name('dashboard');
        $this->data['clients'] = $this->clients->get_all_entries_active();
        $this->data['users'] = $this->user->get_all_entries_active();
        $this->data['categorys'] = $this->category->get_all_entries_active();
        $this->data['statuses'] = $this->status->get_all_entries_active();
        $this->data['importances'] = $this->importance->get_all_entries_active();
        $this->data['alerts'] = $this->alert->get_all_entries_user($this->session->userdata('DX_user_id'));
    }

    private function _check_auth(){
        if(!$this->session->userdata('is_admin')){
            $this->session->sess_destroy();
            redirect('login');
        }
    }

    public function view($page = 'home', $id = null)
    {
        switch ($page){
            case('completed'):
                $this->completed();
                break;
            case('overview'):
                $this->overview();
                break;
            case('mytickets'):
                $this->myTickets();
                break;
            case('ticket'):
                $this->ticket($id);
                break;
            case('profile'):
                $this->profile();
                break;
            default:
                $page = 'home';
                $this->home($id);
                break;
        }

        //Right check located in libraries
        $this->rights->validate_rights($page);

        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data = $this->data;
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['this_user'] = $this->session->userdata();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * @param mixed $data
     */
    public function setData($key, $data)
    {
        $this->data[$key] = $data;
    }

    public function home($start_index = 1){
        $this->load->library('pagination');

        $count = $this->ticket->count_pending_entries();

        $config = array (
            'base_url' => base_url()."/home/",
            'total_rows' => $count,
            'per_page' => 20,
            'num_links' => 4,
        );

        $this->pagination->initialize($config);

        $this->setData('links', $this->pagination->create_links());
        $this->setData('array', $this->ticket->get_current_page_records($config['per_page'], $start_index));
    }

    public function completed($start_index = null){
        //$this->load->library('pagination');
//
        //$count = $this->ticket->count_completed_entries();
//
        //$config = array (
        //    'base_url' => base_url()."/completed/",
        //    'total_rows' => $count,
        //    'per_page' => 20,
        //    'num_links' => 2,
        //);
//
        //$this->pagination->initialize($config);
//
        //$this->setData('links', $this->pagination->create_links());
        //$this->setData('array', $this->ticket->get_current_page_records_completed($config['per_page'], $start_index));

        $this->load->library('table');
        $this->setData('table', $this->table->generate($this->ticket->get_completed_entries()));
    }

    public function overview(){
        $this->load->library('table');
        $this->setData('table', $this->table->generate($this->ticket->get_all_entries()));
    }

    public function myTickets(){
        $this->load->library('table');
        $this->setData('table', $this->table->generate($this->ticket->get_my_entries()));
    }

    public function ticket($id){
        $this->data['ticket'] = $this->ticket->get_single_entry($id);

        if (empty($this->data['ticket'])){
            redirect('/home');
        } else{
            $this->data['this_user'] = $this->session->userdata();
            $this->data['clients'] = $this->clients->get_all_entries();
            $this->data['users'] = $this->user->get_all_entries();
            $this->data['categorys'] = $this->category->get_all_entries();
            $this->data['statuses'] = $this->status->get_all_entries();
            $this->data['importances'] = $this->importance->get_all_entries();
            $this->data['alerts'] = $this->alert->get_all_entries_user($this->session->userdata('DX_user_id'));
            $this->data['statuses'] = $this->status->get_all_entries();
            $this->data['images'] = $this->image->get_group_entries($this->data['ticket']['ticket_images']);
            $this->data['progress'] = $this->ticket->get_progress($id);
        }
    }

    public function profile(){
        $this->data['user'] = $this->user->get_single_entry($this->session->userdata('DX_user_id'));
    }
}