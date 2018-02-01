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

        $this->load->library('DX_Auth');
        if (! $this->dx_auth->is_logged_in()){
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
                $data['array'] = $this->category();
                break;
            case ('status'):
                $data['array'] = $this->status();
                break;
            case ('importance'):
                $data['array'] = $this->importance();
                break;
            case ('users'):
                $data['array'] = $this->users();
                break;
            case ('rights'):
                $data['array'] = $this->rights();
                break;
            case ('mail'):
                $data['array'] = $this->mail();
                break;
            case ('templates'):
                $data['array'] = $this->templates();
                break;
            default:
                break;
        }

        $data['title'] = ucfirst($page);
        $data["company"] = '';
        $data["page_title_desc"] = '';

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
                $data['array'] = $this->addStatus();
                break;
            case ('importance'):
                $data['array'] = $this->addImportance();
                break;
            case ('user'):
                $data['roles'] = $this->addUser();
                break;
            default:
                break;
        }

        $data['title'] = ucfirst($page);
        $data["company"] = '';
        $data["page_title_desc"] = '';

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
                $this->data['array'] = $this->editCategory( $id );
                break;
            case ('status'):
                $this->data['array'] = $this->editStatus( $id );
                break;
            case ('importance'):
                $this->data['array'] = $this->editImportance( $id );
                break;
            case ('user'):
                $this->data['array'] = $this->editUser( $id );
                break;
            case ('template'):
                $this->data['array'] = $this->editTemplate( $id );
                break;
            default:
                break;
        }

        $data = $this->data;

        $data['title'] = ucfirst($page);
        $data["company"] = '';
        $data["page_title_desc"] = '';

        $data['this_user'] = $this->session->userdata();


        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/pages/edit/'.$page, $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function delete($page = 'dashboard', $id)
    {
        /*
        if ( ! file_exists(APPPATH.'views/admin/pages/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        switch ($page){
            case ('category'):
                $data['array'] = $this->category();
                break;
            case ('status'):
                $data['array'] = $this->status();
                break;
            case ('importance'):
                $data['array'] = $this->importance();
                break;
            case ('user'):
                $data['array'] = $this->users();
                break;
            default:
                break;
        }

        $data['title'] = ucfirst($page);
        $data["company"] = '';
        $data["page_title_desc"] = '';

        $data['this_user'] = $this->session->userdata();


        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/pages/'.$page, $data);
        $this->load->view('admin/templates/footer', $data);
        */
    }

    public function category(){
        $query = $this->db->query('SELECT * FROM alert_types');
        return $query->result_array();
    }

    public function editCategory($id = null){
        $query = $this->db->query('SELECT * FROM alert_types WHERE alert_id = '.$this->db->escape($id));
        return $query->row_array();
    }

    public function status(){
        $query = $this->db->query('SELECT * FROM status_types');
        return $query->result_array();
    }

    public function addstatus(){
        $query = $this->db->query('
            SELECT COLUMN_TYPE 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = "ticket"
            AND TABLE_NAME = "status_types" 
            AND COLUMN_NAME = "status_level"');
        $x = $query->result_array();
        $x = $x[0]['COLUMN_TYPE'];
        $x = str_replace('enum(', '', $x);
        $x = str_replace(')', '', $x);
        $x = str_replace('\'', '', $x);
        $x = explode(','. '', $x);
        return $x;
    }

    public function editStatus($id = null){
    // docs
        $query = $this->db->query('
            SELECT COLUMN_TYPE 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = "ticket"
            AND TABLE_NAME = "status_types" 
            AND COLUMN_NAME = "status_level"');
        $x = $query->result_array();
        $x = $x[0]['COLUMN_TYPE'];
        $x = str_replace('enum(', '', $x);
        $x = str_replace(')', '', $x);
        $x = str_replace('\'', '', $x);
        $x = explode(','. '', $x);
        $this->data['levels'] = $x;

        $query = $this->db->query('SELECT * FROM status_types WHERE status_id = '.$this->db->escape($id));
        $this->data['status'] = $query->result_array();
    }

    public function importance(){
        $query = $this->db->query('SELECT * FROM importance_types');
        return $query->result_array();
    }

    public function addImportance(){
        $query = $this->db->query('
            SELECT COLUMN_TYPE 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = "ticket"
            AND TABLE_NAME = "importance_types" 
            AND COLUMN_NAME = "importance_level"');
        $x = $query->result_array();
        $x = $x[0]['COLUMN_TYPE'];
        $x = str_replace('enum(', '', $x);
        $x = str_replace(')', '', $x);
        $x = str_replace('\'', '', $x);
        $x = explode(','. '', $x);
        return $x;
    }

    public function editImportance($id = null){
        $query = $this->db->query('
            SELECT COLUMN_TYPE 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = "ticket"
            AND TABLE_NAME = "importance_types" 
            AND COLUMN_NAME = "importance_level"');
        $x = $query->result_array();
        $x = $x[0]['COLUMN_TYPE'];
        $x = str_replace('enum(', '', $x);
        $x = str_replace(')', '', $x);
        $x = str_replace('\'', '', $x);
        $x = explode(','. '', $x);
        $this->data['levels'] = $x;

        $query = $this->db->query('SELECT * FROM importance_types WHERE importance_id = '.$this->db->escape($id));
        $this->data['importance'] = $query->result_array();
    }

    public function users(){
        $query = $this->db->query('SELECT u.id, u.username, u.email, u.created, u.last_login, r.name FROM users as u
            JOIN roles as r ON u.role_id = r.id');
        return $query->result_array();
    }

    public function addUser(){
        $data['this_user'] = $this->session->userdata();
        $query = $this->db->query('SELECT * FROM roles');
        return $query->result_array();
    }

    public function editUser($id = null){
        $query = $this->db->query('SELECT * FROM roles');
        $this->data['roles'] = $query->result_array();

        $query = $this->db->query('SELECT * FROM users WHERE id = '.$this->db->escape($id));
        $this->data['user'] = $query->row_array();
    }

    public function rights(){
        $query = $this->db->query('SELECT * FROM roles');
        return $query->result_array();
    }

    public function mail(){
        $query = $this->db->query('SELECT * FROM mail_config WHERE id = 1');
        return $query->row_array();
    }

    public function templates(){
        $query = $this->db->query('SELECT * FROM mail_templates');
        return $query->result_array();
    }

    public function editTemplate($id){
        $query = $this->db->query('SELECT * FROM mail_templates WHERE id = '.$id);
        return $query->row_array();
    }
}