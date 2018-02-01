<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 24-1-2018
 * Time: 13:24
 */

class Ajax extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('DX_Auth');
        if (! $this->dx_auth->is_logged_in()){
            $this->session->sess_destroy();
            redirect('auth/login');
        }

        $this->load->helper('main_helper');
        $this->load->database();
    }

    public function login(){
        if ($this->dx_auth->login(html_entity_decode($_POST['username']), $_POST['password'], false)){
            echo check('check-success', 'check', '/home');
        } else{
            echo alert('danger', '', 'Password or username is incorrect');
        }
    }

    public function addTicket(){
       if ( ! $query = $this->db->query('
          INSERT INTO tickets (ticket_type, ticket_status, ticket_importance, ticket_problem, ticket_creator, ticket_master)
          VALUES (
          '.$this->db->escape($_POST['category']).',
           '.$this->db->escape($_POST['status']).',
            '.$this->db->escape($_POST['importance']).',
             '.$this->db->escape($_POST['problem']).',
             '.$this->session->userdata('DX_user_id').',
              '.$this->db->escape($_POST['user']).')
               
           '))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           $this->load->library('email');
           $this->load->library('mailtemplates');


           $insertId = $this->db->insert_id();
           $config = array();


           $query = $this->db->query('SELECT * FROM mail_config WHERE id = 1');
           $array = $query->row_array();
           foreach ($array as $key => $item){
               $config[$key] = $item;
           }
           $this->email->initialize($config);


           $query = $this->db->query('SELECT username, email FROM users WHERE id = '.$this->db->escape($_POST['user']));
           $data = $query->row_array();


           $query = $this->db->query('SELECT * FROM alert_types WHERE alert_id = '.$this->db->escape($_POST['category']));
           $cat = $query->row_array();


           $values = array(
               '({[!TITLE!]})' => $cat['alert_name'],
               '({[!TICKETID!]})' => $insertId,
               '({[!PROBLEM!]})' => $_POST['problem'],
               '({[!CATEGORY!]})' => $cat['alert_name'],
               '({[!BASEURL!]})' => base_url(),
           );
           $this->mailtemplates->setTemplate(1);
           $this->mailtemplates->setCustomSubject($cat['alert_name']);
           $this->mailtemplates->writeData($values);


           $this->email->from('info@idsignage.nl', 'IdSignage');
           $this->email->to($data['email']);
           $this->email->subject($this->mailtemplates->subject());
           $this->email->message($this->mailtemplates->getData());

           if ($this->email->send()){
               echo check('check-success', 'check', '/home');
           } else{
               echo alert('danger', 'MAIL::ERROR!!!!', $this->email->print_debugger());
           }
        }
    }

    public function completeTicket($id){
        if (!empty($_POST['solution']) && !empty($_POST['status'])){
            if ( ! $query = $this->db->query('UPDATE tickets
                                                SET ticket_solution = '.$this->db->escape($_POST['solution']).',
                                                 ticket_status = '.$this->db->escape($_POST['status']).',
                                                 ticket_edited_at = NOW(),
                                                 ticket_completed_at = NOW()
                                                WHERE ticket_id = '.$this->db->escape($id)))
            {
                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
            } else{
                echo check('check-success', 'check', '/ticket/' . $id);
            }
        } elseif (!empty($_POST['failed']) && !empty($_POST['status'])){
            if ( ! $query = $this->db->query('UPDATE tickets
                                                SET ticket_comment = '.$this->db->escape($_POST['failed']).',
                                                 ticket_status = '.$this->db->escape($_POST['status']).',
                                                 ticket_edited_at = NOW(),
                                                 ticket_completed_at = NOW()
                                                WHERE ticket_id = '.$this->db->escape($id)))
            {
                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
            } else{
                echo check('check-success', 'check', '/ticket/' . $id);
            }
        } else{
            echo alert('warning', '', 'You didn\'t explain how you completed this ticket');
        }
    }

    public function getLevel($id){
        if ( $query = $this->db->query('SELECT status_level FROM status_types 
                                            WHERE status_id = '.$this->db->escape($id)))
        {
            $row = $query->row_array();
            echo $row['status_level'];
        } else{
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        }
    }

    public function editTicket($id){
        if (!empty($_POST['problem']) && !empty($_POST['status'])){
            if ( ! $query = $this->db->query('UPDATE tickets
                                                SET ticket_problem = '.$this->db->escape($_POST['problem']).'
                                                 ticket_edited_at = NOW()
                                                WHERE ticket_id = '.$this->db->escape($id)))
            {
                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
            } else{
                echo check('check-success', 'check', '/ticket/' . $id);
            }
        } else{
            echo alert('warning', '', 'You didn\'t explain what the problem is');
        }
    }

    public function restoreTicket($id){
        if ( ! $query = $this->db->query('UPDATE tickets
                                          SET ticket_status = 1, 
                                           ticket_completed_at = NULL, 
                                           ticket_edited_at = NOW()
                                          WHERE ticket_id = '.$this->db->escape($id)))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
            echo check('check-success', 'check', '/ticket/' . $id);
        }
    }

    public function addCategory(){
       if ( ! $query = $this->db->query('
          INSERT INTO alert_types (alert_name, alert_info)
          VALUES (
          '.$this->db->escape($_POST['name']).',
           '.$this->db->escape($_POST['info']).')
           '))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           echo check('check-success', 'check', '/admin/category');
        }
    }

    public function editCategory($id){
       if ( ! $query = $this->db->query('UPDATE alert_types
            SET alert_name = '.$this->db->escape($_POST['name']).',
             alert_info = '.$this->db->escape($_POST['info']).'
            WHERE alert_id = '.$this->db->escape($id)))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           echo check('check-success', 'check', '/admin/category');
        }
    }

    public function addStatus(){
       if ( ! $query = $this->db->query('
          INSERT INTO status_types (status_name, status_level, status_info)
          VALUES (
          '.$this->db->escape($_POST['name']).',
           '.$this->db->escape($_POST['level']).',
            '.$this->db->escape($_POST['info']).')
           '))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           echo check('check-success', 'check', '/admin/status');
        }
    }

    public function editStatus($id){
       if ( ! $query = $this->db->query('UPDATE status_types
            SET 
             status_name = '.$this->db->escape($_POST['name']).',
             status_info = '.$this->db->escape($_POST['info']).',
             status_level = '.$this->db->escape($_POST['level']).'
            WHERE 
             status_id = '.$this->db->escape($id)))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           echo check('check-success', 'check', '/admin/status');
        }
    }

    public function addImportance(){
       if ( ! $query = $this->db->query('
          INSERT INTO importance_types (importance_name, importance_info, importance_color, importance_level)
          VALUES (
          '.$this->db->escape($_POST['name']).',
           '.$this->db->escape($_POST['info']).',
            '.$this->db->escape($_POST['color']).',
             '.$this->db->escape($_POST['level']).')
           '))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           echo check('check-success', 'check', '/admin/importance');
        }
    }

    public function editImportance($id){
       if ( ! $query = $this->db->query('UPDATE importance_types
            SET 
             importance_name = '.$this->db->escape($_POST['name']).',
             importance_info = '.$this->db->escape($_POST['info']).',
             importance_color = '.$this->db->escape($_POST['color']).',
             importance_level = '.$this->db->escape($_POST['level']).'
            WHERE 
             importance_id = '.$this->db->escape($id)))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
            echo check('check-success', 'check', '/admin/importance');
        }
    }

    public function addUser(){
        if (! $this->dx_auth->is_logged_in()){
            $this->session->sess_destroy();
            redirect('auth/login');
        } else {
            if ((int)$this->session->userdata('DX_role_id') >= 2) {
                if ($_POST['password'] == $_POST['confirm_password']) {
                    $this->dx_auth->register($_POST['username'], $_POST['password'], $_POST['email'], $_POST['role']);
                } else {
                    echo alert('warning', '', 'The password must be the same');
                }
            } else {
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }
    }

    public function editUser($id){
        if (! $this->dx_auth->is_logged_in()){
            $this->session->sess_destroy();
            redirect('auth/login');
        } else {
            if ((int)$this->session->userdata('DX_role_id') >= 2) {
                if (empty($_POST['password'])) {
                    if (empty($_POST['role'])){
                        if ( ! $query = $this->db->query('UPDATE users
                            SET username = '.$this->db->escape($_POST['username']).', email = '.$this->db->escape($_POST['email']).'
                            WHERE id = '.$this->db->escape($id)))
                        {
                            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
                        } else{
                            echo check('check-success', 'check', '/user/profile');
                        }
                    } else{
                        if ( ! $query = $this->db->query('UPDATE users
                            SET 
                             username = '.$this->db->escape($_POST['username']).',
                             email = '.$this->db->escape($_POST['email']).',
                             role_id = '.$this->db->escape($_POST['role']).'
                            WHERE 
                             id = '.$this->db->escape($id)))
                        {
                            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
                        } else{
                            echo check('check-success', 'check', '/admin/users');
                        }
                    }
                } else {
                    if ($_POST['password'] == $_POST['confirm_password']) {
                        if (empty($_POST['role'])){
                            if ( ! $query = $this->db->query('UPDATE users
                            SET username = '.$this->db->escape($_POST['username']).', email = '.$this->db->escape($_POST['email']).'
                            WHERE id = '.$this->db->escape($id)))
                            {
                                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
                            } else{
                                echo check('check-success', 'check', '/user/profile');
                            }
                        } else{
                            if ( ! $query = $this->db->query('UPDATE users
                            SET 
                             username = '.$this->db->escape($_POST['username']).',
                             email = '.$this->db->escape($_POST['email']).',
                             role_id = '.$this->db->escape($_POST['role']).'
                            WHERE 
                             id = '.$this->db->escape($id)))
                            {
                                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
                            } else{
                                echo check('check-success', 'check', '/admin/users');
                            }
                        }

                        $this->dx_auth->change_password_user($id, $_POST['password']);
                    } else {
                        echo alert('warning', '', 'The password must be the same');
                    }
                }
            } else{
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }
    }

    public function lineChartTicket($daysBack = 14){
        $query = $this->db->query('SELECT * FROM tickets');
        $array = $query->result_array();

        $tmp = array();

        foreach ($array as $item) {
            if (!array_key_exists(strtotime((string) date('d-m-Y', strtotime($item['ticket_created_at']))), $tmp)) {
                $tmp[strtotime((string) date('d-m-Y', strtotime($item['ticket_created_at'])))] = 1;
            } else{
                $tmp[strtotime((string) date('d-m-Y', strtotime($item['ticket_created_at'])))] = ($tmp[strtotime((string) date('d-m-Y', strtotime($item['ticket_created_at'])))] + 1);
            }
        }

        $json = '{"cols": [{"id":"","label":"Date","pattern":"","type":"string"},{"id":"","label":"Tickets","pattern":"","type":"number"}],"rows": [';

        for ($x = ($daysBack - 1); $x > -1;$x--) {
            $key = strtotime( date( 'd F Y', strtotime( '-' . $x . ' day', strtotime( date( 'd F Y') ) ) ) );
            if (array_key_exists($key, $tmp)){
                $json .= '{"c":[{"v":"' . date('d F Y', $key) . '","f":null},{"v":' . $tmp[$key] . ',"f":null}]},';
            } else{
                $json .= '{"c":[{"v":"' . date('d F Y', $key) . '","f":null},{"v":0,"f":null}]},';
            }
        }

        $json .= ']}';

        echo $json;
    }

    public function lineChartLogins($daysBack = 14){
        $query = $this->db->query('SELECT date FROM logins');
        $array = $query->result_array();

        $tmp = array();

        foreach ($array as $item) {
            if (!array_key_exists(strtotime((string) date('d-m-Y', strtotime($item['date']))), $tmp)) {
                $tmp[strtotime((string) date('d-m-Y', strtotime($item['date'])))] = 1;
            } else{
                $tmp[strtotime((string) date('d-m-Y', strtotime($item['date'])))] = ($tmp[strtotime((string) date('d-m-Y', strtotime($item['date'])))] + 1);
            }
        }

        $json = '{"cols": [{"id":"","label":"Date","pattern":"","type":"string"},{"id":"","label":"Logins","pattern":"","type":"number"}],"rows": [';

        for ($x = ($daysBack - 1); $x > -1;$x--) {
            $key = strtotime( date( 'd F Y', strtotime( '-' . $x . ' day', strtotime( date( 'd F Y') ) ) ) );
            if (array_key_exists($key, $tmp)){
                $json .= '{"c":[{"v":"' . date('d F Y', $key) . '","f":null},{"v":' . $tmp[$key] . ',"f":null}]},';
            } else{
                $json .= '{"c":[{"v":"' . date('d F Y', $key) . '","f":null},{"v":0,"f":null}]},';
            }
        }

        $json .= ']}';

        echo $json;
    }

    public function pieChartCat(){
        $query = $this->db->query('SELECT a.alert_name FROM tickets AS t JOIN alert_types AS a  ON t.ticket_type = a.alert_id');
        $array = $query->result_array();

        $tmp = array();

        foreach ($array as $item){
            if (!array_key_exists($item['alert_name'], $tmp)) {
                $tmp[$item['alert_name']] = 1;
            } else{
                $tmp[$item['alert_name']] = ($tmp[$item['alert_name']] + 1);
            }
        }

        $json = '{"cols": [{"id":"","label":"Date","pattern":"","type":"string"},{"id":"","label":"Ticket","pattern":"","type":"number"}],"rows": [';

        foreach ($tmp as $key => $item){
            $json .= '{"c":[{"v":"' . $key . '","f":null},{"v":' . $item . ',"f":null}]},';
        }

        $json .= ']}';

        echo $json;
    }

    public function resetMail(){
        if ($query = $this->db->query('SELECT * FROM mail_config WHERE id = 0')) {
            foreach ($query->row_array() as $key => $item) {
                if ($key != 'id'){
                    if (!$query = $this->db->query('UPDATE mail_config SET ' . $key . ' = ' . $this->db->escape($item) . ' WHERE id = 1')) {
                        echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
                    }
                }
            }
        }

        echo check('check-success', 'check', '');
    }


    public function updateMail(){
        foreach ($_POST as $key => $item){
            if ( ! $query = $this->db->query('UPDATE mail_config SET ' . $key . ' = '.$this->db->escape($item).' WHERE id = 1')) {
                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
            }
        }

        echo check('check-success', 'check', '');
    }

    public function addMailTemp(){
        if ( ! $query = $this->db->query('
          INSERT INTO mail_templates ( subject, content ) 
            VALUES ('.$this->db->escape($_POST["subject"]).',
             '.$this->db->escape($_POST["content"]).')'))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
            echo check('check-success', 'check', '/admin/templates');
        }
    }

    public function updateMailTemp($id){

        foreach ($_POST as $key => $item){
            if ( ! $query = $this->db->query('UPDATE mail_templates SET ' . $key . ' = '.$this->db->escape($item).' WHERE id = '.$id)) {
                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
            }
        }

        echo check('check-success', 'check', '');
    }
}