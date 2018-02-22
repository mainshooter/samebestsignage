<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 24-1-2018
 * Time: 13:24
 */

class Ajax extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('DX_logged_in')) {
            $this->session->sess_destroy();
            redirect('auth/login');
        }

        $this->load->helper('main_helper');
        $this->load->database();

        $this->load->model('ticket');
        $this->load->model('clients');
        $this->load->model('user');
        $this->load->model('category');
        $this->load->model('status');
        $this->load->model('importance');
        $this->load->model('logins');
        $this->load->model('mail');
        $this->load->model('alert');
    }

    public function login()
    {
        if ($this->dx_auth->login(html_entity_decode($_POST['username']), $_POST['password'], false)) {
            echo '/home';
        } else {
            echo alert('danger', '', 'Password or username is incorrect');
        }
    }

    public function addTicket()
    {
        $config = array(
            'upload_path'      => 'public/img/uploads/',
            'allowed_types'    => 'gif|jpg|png',
            'file_ext_tolower' => TRUE,
            'max_size'         => 4096,
            'max_width'        => 0,
            'max_height'       => 0,
            'max_filename'     => 1000,
        );

        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->upload->initialize($config);

        $upload = true;

        $files_uploaded = array();
        $number_of_files_uploaded = count($_FILES['image']['name']);
        for ($i = 0; $i < $number_of_files_uploaded; $i++) {
            $_FILES['userfile']['name'] = $_FILES['image']['name'][$i];
            $_FILES['userfile']['type'] = $_FILES['image']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $_FILES['image']['error'][$i];
            $_FILES['userfile']['size'] = $_FILES['image']['size'][$i];

            if (!$this->upload->do_upload('userfile')) {
                echo alert('danger', 'UPLOAD::ERROR!!!!', $this->upload->display_errors());

                $upload = false;
            } else {
                $data = $this->upload->data();

                $config_lib = array(
                    'image_library'  => 'gd2',
                    'source_image'   => $config['upload_path'] . $data['file_name'],
                    'create_thumb'   => TRUE,
                    'thumb_marker'   => '_thumb',
                    'maintain_ratio' => TRUE,
                    'width'          => 200,
                    'height'         => 200
                );

                $this->image_lib->initialize($config_lib);
                $this->image_lib->resize();

                $data['thumb'] = $data['raw_name'].$config_lib['thumb_marker'].$data['file_ext'];
                $data['file_path'] = $config['upload_path'];
                $data['file_path'] = $config['upload_path'];
                $data['full_path'] = $config['upload_path'] . $data['file_name'];
                $files_uploaded[] = $data;
            }
        }

        if ($upload != false) {
            $group = $this->image->generate_new_group();

            $insert = true;
            foreach ($files_uploaded as $key => $item) {
                if (!$this->image->insert_entry($group, $item['file_name'], $item['thumb'], $item['file_path'], $item['file_size'])) {
                    $insert = false;
                }
            }

            if ($insert !== false) {
                if (!$this->ticket->insert_entry(
                    $_POST['client'],
                    $_POST['category'],
                    $_POST['status'],
                    $_POST['importance'],
                    $_POST['problem'],
                    $group,
                    $this->session->userdata('DX_user_id'),
                    $_POST['user'],
                    $this->hash($_POST['category'].$_POST['problem'])
                )) {
                    echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
                } else {


                    $this->load->library('email');
                    $this->load->library('mailtemplates');


                    $insertId = $this->db->insert_id();
                    $config = array();

                    //all config items
                    foreach ($this->mail->get_all_entries() as $key => $item) {
                        $config[$key] = $item;
                    }
                    $this->email->initialize($config);

                    $data = $this->user->get_single_entry_mail($_POST['user']);
                    $cat = $this->category->get_single_entry($_POST['category']);

                    $values = array(
                        '({[!TITLE!]})' => $cat['cat_name'],
                        '({[!TICKETID!]})' => $insertId,
                        '({[!PROBLEM!]})' => $_POST['problem'],
                        '({[!CATEGORY!]})' => $cat['cat_name'],
                        '({[!BASEURL!]})' => base_url(),
                    );

                    $this->mailtemplates->setTemplate(1);
                    $this->mailtemplates->setCustomSubject($cat['cat_name']);
                    $this->mailtemplates->writeData($values);


                    $this->email->from('info@idsignage.nl', 'IdSignage');
                    $this->email->to($data['email']);
                    $this->email->subject($this->mailtemplates->subject());
                    $this->email->message($this->mailtemplates->getData());

                    if ($this->email->send()) {
                        $this->alert->insert_entry($_POST['user'], 'Assigned', 'A ticket is assigned to you.', 'redo', '/ticket/' . $insertId);
                        $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Created', 'Ticket no.' . $insertId . ' is created.', 'add', '/ticket/' . $insertId);
                        echo '/home';
                    } else {
                        echo alert('danger', 'MAIL::ERROR!!!!', $this->email->print_debugger());
                    }
                }
            }
        }
    }

    public function shareTicket($id){
        $ticket = $this->ticket->get_single_entry($id);

        $this->load->library('email');
        $this->load->library('mailtemplates');


        $insertId = $this->db->insert_id();
        $config = array();

        //all config items
        foreach ($this->mail->get_all_entries() as $key => $item) {
            $config[$key] = $item;
        }

        $this->email->initialize($config);

        $data = $this->user->get_single_entry_mail(6);

        $values = array(
            '({[!TITLE!]})' => "Er is een ticket met u gedeelt",
            '({[!LINK!]})' => "/image/add/".$ticket['ticket_hash'],
            '({[!BASEURL!]})' => base_url(),
        );

        $this->mailtemplates->setTemplate(3);
        $this->mailtemplates->setCustomSubject("Uw ticket");
        $this->mailtemplates->writeData($values);


        $this->email->from('info@idsignage.nl', 'IdSignage');
        $this->email->to($_POST['email']);
        $this->email->subject($this->mailtemplates->subject());
        $this->email->message($this->mailtemplates->getData());

        if ($this->email->send()) {
            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Shared', 'You shared ticket no.' . $ticket["ticket_id"] . '.', 'share', '/ticket/' . $ticket["ticket_id"]);
            echo '';
        } else {
            echo alert('danger', 'MAIL::ERROR!!!!', $this->email->print_debugger());
        }
    }

    public function completeTicket($id){
        if ( ! $this->ticket->complete_entry($id, $_POST['solution'], $_POST['status'])){
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Completed', 'Ticket no.' . $id . ' is complete.', 'check', '/ticket/' . $id);
            echo '/ticket/' . $id;
        }
    }

    public function getLevel($id){
        $row = $this->status->get_single_entry($id);
        echo $row['status_level'];
    }

    public function editTicket($id){
        if (!empty($_POST['problem']) ){
            if ( ! $this->ticket->update_entry($id, $_POST['problem'])){
                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
            } else{
                $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'Ticket no.' . $id . ' is updated.', 'create', '/ticket/' . $id);
                echo '/ticket/' . $id;
            }
        }
    }

    public function assignTicket($id){
        if (!empty($_POST['comment']) ){
            if ( ! $this->ticket->update_entry_assign($id, $_POST['user'] ,$_POST['comment'])){
                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
            } else{
                $this->alert->insert_entry($_POST['user'], 'Re-Assigned', 'A ticket is assigned to you.', 'redo', '/ticket/' . $id);
                $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Re-Assigned', 'Ticket no.' . $id . ' is re-assigned.', 'redo', '/ticket/' . $id);
                echo '/ticket/' . $id;
            }
        }
    }

    public function restoreTicket($id){
        if ( ! $this->ticket->restore_entry($id)){
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Restored', 'Ticket no.' . $id . ' is restored.', 'autorenew', '/ticket/' . $id);
            echo '/ticket/' . $id;
        }
    }

    public function addCategory(){
       if ( ! $this->category->insert_entry($_POST['name'], $_POST['info'])){
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Created', 'Category is created.', 'add', '/admin/category/');
           echo '/admin/category';
        }
    }

    public function editCategory($id){
       if ( ! $this->category->update_entry($id, $_POST['name'], $_POST['info'])){
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'Category no.' . $id . ' is updated.', 'create', '/admin/category/');
           echo '/admin/category';
        }
    }

    public function addStatus(){
       if ( ! $this->status->insert_entry($_POST['name'], $_POST['level'], $_POST['info'])) {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Created', 'Status is created.', 'add', '/admin/status/');
           echo '/admin/status';
        }
    }

    public function editStatus($id){
       if ( ! $this->status->update_entry($id, $_POST['name'], $_POST['level'], $_POST['info'])) {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'Status no.' . $id . ' is updated.', 'create', '/admin/status/');
           echo '/admin/status';
        }
    }

    public function addImportance(){
       if ( ! $this->importance->insert_entry($_POST['name'], $_POST['info'], $_POST['color'], $_POST['level'])){
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Created', 'Importance is created.', 'add', '/admin/importance/');
           echo '/admin/importance';
        }
    }

    public function editImportance($id){
       if ( ! $this->importance->update_entry($id, $_POST['name'], $_POST['info'], $_POST['color'], $_POST['level'])){
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'Importance no.' . $id . ' is updated.', 'create', '/admin/importance/');
            echo '/admin/importance';
        }
    }

    public function addUser(){
        if (! $this->session->userdata('DX_logged_in')){
            $this->session->sess_destroy();
            redirect('auth/login');
        } else {
            if ((int)$this->session->userdata('DX_role_id') >= 2) {
                if ($_POST['password'] == $_POST['confirm_password']) {
                    $pass = crypt($this->_encode($_POST['password']), '');
                    if (!$this->user->insert_entry($_POST['username'], $_POST['email'], $pass, $_POST['role'])) {
                        echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
                    } else{
                        $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Created', 'User is created.', 'add', '/admin/users/');
                        echo '/admin/users';
                    }
                } else {
                    echo alert('warning', '', 'The passwords must be the same');
                }
            } else {
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }
    }

    public function editUser($id){
        if (! $this->session->userdata('DX_logged_in')){
            $this->session->sess_destroy();
            redirect('auth/login');
        } else {
            if ((int)$this->session->userdata('DX_role_id') >= 2) {
                if (!$this->user->update_entry($id, $_POST['username'], $_POST['email'], $_POST['role'])) {
                    echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
                } else {
                    if (!empty($_POST['password'])) {
                        if ($_POST['password'] == $_POST['confirm_password']) {
                            $pass = crypt($this->_encode($_POST['password']), '');
                            if (!$this->user->update_password($id, $pass)){
                                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
                            } else{
                                $this->alert->insert_entry($id, 'Update', 'Your account is updated.', 'create', '/user/profile');
                                $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'User no.' . $id . ' is updated.', 'create', '/admin/users/');
                                echo '/admin/users';
                            }
                        }
                    } else{
                        echo '/admin/users';
                    }
                }
            } else{
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }
    }

    public function editUserFront($id){
        if (! $this->session->userdata('DX_logged_in')){
            $this->session->sess_destroy();
            redirect('auth/login');
        } else {
            if ((int)$this->session->userdata('DX_role_id') >= 2) {
                if (!$this->user->update_entry_user($id, $_POST['username'], $_POST['email'])) {
                    echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
                } else {
                    if (!empty($_POST['password'])) {
                        if ($_POST['password'] == $_POST['confirm_password']) {
                            $pass = crypt($this->_encode($_POST['password']), '');
                            if (!$this->user->update_password($id, $pass)){
                                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
                            } else{
                                $this->alert->insert_entry($id, 'Update', 'Your account is updated.', 'create', '/user/profile/');
                                echo '/user/profile';
                            }
                        }
                    } else{
                        echo '/user/profile';
                    }
                }
            } else{
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }
    }

    function _encode($password)
    {
        $majorsalt = 'UITY&O*7d8u09pasolkJGDT))polkhjg879SOI';

        // if PHP5
        if (function_exists('str_split'))
        {
            $_pass = str_split($password);
        } /*if PHP4*/
        else {
            $_pass = array();
            if (is_string($password))
            {
                for ($i = 0; $i < strlen($password); $i++)
                {
                    array_push($_pass, $password[$i]);
                }
            }
        }

        // encrypts every single letter of the password
        foreach ($_pass as $_hashpass)
        {
            $majorsalt .= md5($_hashpass);
        }

        // encrypts the string combinations of every single encrypted letter
        // and finally returns the encrypted password
        return md5($majorsalt);
    }

    public function lineChartTicket($daysBack = 31){
        $array = $this->ticket->get_all_ticket_no_join();

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

    public function lineChartLogins($daysBack = 31){
        $array = $this->logins->get_all_entries();

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
        $array = $this->ticket->get_pie_chart();

        $tmp = array();

        foreach ($array as $item){
            if (!array_key_exists($item['cat_name'], $tmp)) {
                $tmp[$item['cat_name']] = 1;
            } else{
                $tmp[$item['cat_name']] = ($tmp[$item['cat_name']] + 1);
            }
        }

        $json = '{"cols": [{"id":"","label":"Date","pattern":"","type":"string"},{"id":"","label":"Ticket","pattern":"","type":"number"}],"rows": [';

        foreach ($tmp as $key => $item){
            $json .= '{"c":[{"v":"' . $key . '","f":null},{"v":' . $item . ',"f":null}]},';
        }

        $json .= ']}';

        echo $json;
    }

    public function pieChartClient(){
        $array = $this->ticket->get_pie_chart_client();

        $tmp = array();

        foreach ($array as $item){
            if (!array_key_exists($item['client_name'], $tmp)) {
                $tmp[$item['client_name']] = 1;
            } else{
                $tmp[$item['client_name']] = ($tmp[$item['client_name']] + 1);
            }
        }

        $json = '{"cols": [{"id":"","label":"Date","pattern":"","type":"string"},{"id":"","label":"Ticket","pattern":"","type":"number"}],"rows": [';

        foreach ($tmp as $key => $item){
            $json .= '{"c":[{"v":"' . $key . '","f":null},{"v":' . $item . ',"f":null}]},';
        }

        $json .= ']}';

        echo $json;
    }

    public function pieChartImp(){
        $array = $this->ticket->get_pie_chart_imp();

        $tmp = array();

        foreach ($array as $item){
            if (!array_key_exists($item['importance_name'], $tmp)) {
                $tmp[$item['importance_name']] = 1;
            } else{
                $tmp[$item['importance_name']] = ($tmp[$item['importance_name']] + 1);
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
        foreach ($this->mail->get_default_entry() as $key => $item) {
            if ($key != 'id') {
                if (! $this->mail->update_entry($key, $item)) {
                    echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
                }
            }
        }
        $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Reset', 'The mail configuration is set to default.', 'redo', '/admin/mail/');
        echo '';
    }


    public function updateMail(){
        foreach ($_POST as $key => $item){
            if ( ! $this->mail->update_entry($key, $item)) {
                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
            }
        }
        $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'The mail configuration is updated.', 'create', '/admin/mail/');
        echo '';
    }

    public function addMailTemp(){
        if ( ! $this->templates->insert_entry($_POST["subject"], $_POST["content"])) {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Reset', 'The mail configuration is set to default.', 'redo', '/admin/templates/');
            echo '/admin/templates';
        }
    }

    public function updateMailTemp($id){

        foreach ($_POST as $key => $item){
            if ( ! $this->templates->update_entry($id, $key, $item)) {
                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
            } else{
                $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'Mail template no.'. $id .' is updated.', 'create', '/admin/templates/');
            }
        }

        echo '';
    }

    public function addClient(){
        if (! $this->dx_auth->is_logged_in()){
            $this->session->sess_destroy();
            redirect('auth/login');
        } else {
            if ( ! $this->templates->insert_entry(
                $_POST["username"],
                $_POST["tel"],
                $_POST["email"],
                $_POST["country"],
                $_POST["state"],
                $_POST["town"],
                $_POST["street"],
                $_POST["number"],
                $_POST["zip"]
            )) {
                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
            } else{
                $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Created', 'Client is created.', 'add', '/admin/clients/');
                echo '/admin/clients';
            }
        }
    }

    public function editClient($id){
        if (! $this->dx_auth->is_logged_in()){
            $this->session->sess_destroy();
            redirect('auth/login');
        } else {
            if ( ! $this->templates->insert_entry(
                $id,
                $_POST["username"],
                $_POST["tel"],
                $_POST["email"],
                $_POST["country"],
                $_POST["state"],
                $_POST["town"],
                $_POST["street"],
                $_POST["number"],
                $_POST["zip"]
            )){
                echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
            } else{
                $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'Client no.'. $id .' is updated.', 'create', '/admin/clients/');
                echo '/admin/clients';
            }
        }
    }

    public function markAsRead(){
        if ( ! $this->alert->set_read($_POST['id'])){
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
            echo '';
        }
    }

    public function markAsReadAll(){
        if ( ! $this->alert->set_read_all($this->session->userdata('DX_user_id'))){
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
            echo '';
        }
    }

    function hash($data){
        $majorsalt = '';

        // if PHP5
        if (function_exists('str_split'))
        {
            $_data = str_split($data);
        }

        foreach ($_data as $_hashdata)
        {
            $majorsalt .= crypt(
                crypt(
                    md5($_hashdata.random_int(1, 100)),
                    $data
                ),
                crypt(
                    md5(
                        json_encode($_data)
                    ),
                    date('Y/F\W-l H:m:s e+c')
                )
            );
        }

        //just some fun
        $majorsalt .= sha1(
                md5($majorsalt.random_int(8946, 89465)),
                false
            )
            .sha1(
                crypt(
                    md5($majorsalt.random_int(100, 1000)),
                    '$6$rounds=5000$iDoNotKnowWhatiAmDoingButiAmHavingFun$'
                ),
                false
            );

        return str_replace('/', random_int(10, 55), $majorsalt);
    }


}