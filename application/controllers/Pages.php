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

        $this->load->library('DX_Auth');
        if (! $this->dx_auth->is_logged_in()){
            $this->session->sess_destroy();
            redirect('auth/login');
        }

        $this->load->database();
    }

    private function _check_auth(){
        if(!$this->session->userdata('is_admin')){
            $this->session->sess_destroy();
            redirect('login');
        }
    }

    public function view($page = 'home')
    {
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        switch ($page){
            case('home'):
                $this->ticket();
                break;
            case('archive'):
                $this->archive();
                break;
            case('overview'):
                $this->overview();
                break;
            default:
                $this->ticket();
                break;
        }

        $this->data['title'] = ucfirst($page); // Capitalize the first letter

        $data = $this->data;

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

    public function ticket($id = null){
        $data =[];

        $query = $this->db->query('SELECT * FROM tickets 
                                    JOIN alert_types ON tickets.ticket_type = alert_types.alert_id
                                    JOIN status_types ON tickets.ticket_status = status_types.status_id
                                    JOIN importance_types ON tickets.ticket_importance = importance_types.importance_id
                                    WHERE ticket_archived_at IS NULL AND status_types.status_level = "pending"
                                    ORDER BY importance_types.importance_level ASC');

        foreach ($query->result_array() as $row)
        {
            $data[] = $row;
        }

        $this->setData('tickets', $data);
        $this->setData('page_title', 'Home');
        $this->setData('page_title_desc', 'Here are all the pending tickets visible');
    }

    public function archive($id = null){
        $data =[];

        $query = $this->db->query('SELECT * FROM tickets 
                                    JOIN alert_types ON tickets.ticket_type = alert_types.alert_id
                                    JOIN status_types ON tickets.ticket_status = status_types.status_id
                                    JOIN importance_types ON tickets.ticket_importance = importance_types.importance_id
                                    WHERE ticket_archived_at IS NOT NULL');

        foreach ($query->result_array() as $row)
        {
            $data[] = $row;
        }

        $this->setData('tickets', $data);
        $this->setData('page_title', 'Archive');
        $this->setData('page_title_desc', 'Here are all the archived tickets visible');
    }

    public function overview(){
        $this->load->library('table');

        $query = $this->db->query('SELECT ticket_id, alert_name, ticket_problem, ticket_created_at, ticket_archived_at, status_name FROM tickets 
                                    JOIN alert_types ON tickets.ticket_type = alert_types.alert_id
                                    JOIN status_types ON tickets.ticket_status = status_types.status_id
                                    JOIN importance_types ON tickets.ticket_importance = importance_types.importance_id');

        $this->setData('table', $this->table->generate($query));
        $this->setData('page_title', 'Overview');
        $this->setData('page_title_desc', 'Here are all the tickets visible.<br />You can filter and search tickets.');
    }
}