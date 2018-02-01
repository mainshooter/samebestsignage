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

        $data['this_user'] = $this->session->userdata();
        $this->load->database();
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
            default:
                $page = 'home';
                $this->ticket();
                break;
        }

        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $this->data['title'] = ucfirst($page); // Capitalize the first letter

        $data = $this->data;
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

    public function ticket($id = null){
        $data =[];

        $query = $this->db->query('SELECT * FROM tickets AS t 
                                    JOIN alert_types AS a ON t.ticket_type = a.alert_id
                                    JOIN status_types AS s ON t.ticket_status = s.status_id
                                    JOIN importance_types AS i ON t.ticket_importance = i.importance_id
                                    JOIN users AS u ON t.ticket_master = u.id
                                    WHERE t.ticket_completed_at IS NULL AND s.status_level = "pending"
                                    ORDER BY i.importance_level ASC');

        foreach ($query->result_array() as $row)
        {
            $data[] = $row;
        }

        $this->setData('tickets', $data);
        $this->setData('page_title', 'Home');
        $this->setData('page_title_desc', 'Here are all the pending tickets visible');
    }

    public function completed($id = null){
        $data =[];

        $query = $this->db->query('SELECT * FROM tickets AS t 
                                    JOIN alert_types AS a ON t.ticket_type = a.alert_id
                                    JOIN status_types AS s ON t.ticket_status = s.status_id
                                    JOIN importance_types AS i ON t.ticket_importance = i.importance_id
                                    JOIN users AS u ON t.ticket_master = u.id
                                    WHERE t.ticket_completed_at IS NOT NULL');

        foreach ($query->result_array() as $row)
        {
            $data[] = $row;
        }

        $this->setData('tickets', $data);
        $this->setData('page_title', 'Completed Tickets');
        $this->setData('page_title_desc', 'Here are all the completed tickets visible');
    }

    public function overview(){
        $this->load->library('table');

        $query = $this->db->query('SELECT t.ticket_id, a.alert_name, t.ticket_problem, t.ticket_created_at, t.ticket_completed_at, s.status_name, u.email FROM tickets AS  t
                                    JOIN alert_types AS a ON t.ticket_type = a.alert_id
                                    JOIN status_types AS s ON t.ticket_status = s.status_id
                                    JOIN users AS u ON t.ticket_master = u.id
                                    JOIN importance_types AS i ON t.ticket_importance = i.importance_id');

        $this->setData('table', $this->table->generate($query));
        $this->setData('page_title', 'Overview');
        $this->setData('page_title_desc', 'Here are all the tickets visible.<br />You can filter and search tickets.');
    }

    public function myTickets(){
        $this->load->library('table');

        $query = $this->db->query('SELECT t.ticket_id, a.alert_name, t.ticket_problem, t.ticket_created_at, t.ticket_completed_at, s.status_name FROM tickets AS  t
                                    JOIN alert_types AS a ON t.ticket_type = a.alert_id
                                    JOIN status_types AS s ON t.ticket_status = s.status_id
                                    JOIN users AS u ON t.ticket_master = u.id
                                    JOIN importance_types AS i ON t.ticket_importance = i.importance_id
                                    WHERE t.ticket_master = '.$this->session->userdata('DX_user_id'));

        $this->setData('table', $this->table->generate($query));
        $this->setData('page_title', 'Overview');
        $this->setData('page_title_desc', 'Here are all the tickets visible.<br />You can filter and search tickets.');
    }
}