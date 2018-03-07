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
        $this->load->model('mail');
        $this->load->model('alert');
        $this->load->model('templates');
        $this->load->model('roles');
    }

    public function addTicket()
    {
        $config = array(
            'upload_path' => 'public/img/uploads/',
            'allowed_types' => 'gif|jpg|png',
            'file_ext_tolower' => TRUE,
            'max_size' => 4096,
            'max_width' => 0,
            'max_height' => 0,
            'max_filename' => 1000,
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
                echo json_encode(
                    array(
                        "error" => false,
                        "msg" => "<pre>" . $this->upload->display_errors() . "</pre>",
                        "href" => "unset"
                    )
                );

                $upload = false;
            } else {
                $data = $this->upload->data();

                $config_lib = array(
                    'image_library' => 'gd2',
                    'source_image' => $config['upload_path'] . $data['file_name'],
                    'create_thumb' => TRUE,
                    'thumb_marker' => '_thumb',
                    'maintain_ratio' => TRUE,
                    'width' => 200,
                    'height' => 200
                );

                $this->image_lib->initialize($config_lib);
                $this->image_lib->resize();

                $data['thumb'] = $data['raw_name'] . $config_lib['thumb_marker'] . $data['file_ext'];
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
                    $this->hash($_POST['category'] . $_POST['problem'])
                )) {
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "At this moment is is not possible to create a ticket. /n Please come back later to try again.",
                            "href" => "unset"
                        )
                    );
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
                        echo json_encode(
                            array(
                                "error" => false,
                                "msg" => "Success",
                                "href" => "/home"
                            )
                        );
                    } else {
                        echo json_encode(
                            array(
                                "error" => true,
                                "msg" => "<pre>" . $this->email->print_debugger() . "</pre>",
                                "href" => "unset"
                            )
                        );
                    }
                }
            }
        }
    }

    public function shareTicket($id)
    {
        $ticket = $this->ticket->get_single_entry($id);

        $this->load->library('email');
        $this->load->library('mailtemplates');


        $insertId = $this->db->insert_id();
        $config = array();

        //all config items
        foreach ($this->mail->get_all_entries() as $key => $item) {
            if ($key != "id"){
                $config[$key] = $item;
            }
        }

        //var_dump($config);
        //die();
        $this->email->initialize($config);

        $data = $this->user->get_single_entry_mail(6);

        $values = array(
            '({[!TITLE!]})' => "Er is een ticket met u gedeelt",
            '({[!LINK!]})' => "/image/add/" . $ticket['ticket_hash'],
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
            $this->logs->insert_entry("SHARE", "Ticket no." . $id . " Shared", ($this->session->userdata('DX_user_id') != null) ? $this->session->userdata('DX_user_id') : $this->input->ip_address());
            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Shared', 'You shared ticket no.' . $ticket["ticket_id"] . '.', 'share', '/ticket/' . $ticket["ticket_id"]);
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "Success",
                    "href" => "unset"
                )
            );
        } else {
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "<pre>" . $this->email->print_debugger() . "</pre>",
                    "href" => "unset"
                )
            );
        }
    }

    public function completeTicket($id)
    {
        if (!$this->ticket->complete_entry($id, $_POST['solution'], $_POST['status'])) {
            echo json_encode(
                array(
                    "error" => false,
                    "msg" => "At this moment is is not possible to complete a ticket. /n Please come back later to try again.",
                    "href" => "unset"
                )
            );
        } else {
            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Completed', 'Ticket no.' . $id . ' is complete.', 'check', '/ticket/' . $id);
            echo json_encode(
                array(
                    "error" => false,
                    "msg" => "Success",
                    "href" => "/ticket/" . $id
                )
            );
        }
    }

    public function getLevel($id)
    {
        $row = $this->status->get_single_entry($id);
        echo $row['status_level'];
    }

    public function editTicket($id)
    {
        if (!empty($_POST['problem'])) {
            if (!$this->ticket->update_entry($id, $_POST['problem'])) {
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "At this moment is is not possible to edit a ticket. /n Please come back later to try again.",
                        "href" => "unset"
                    )
                );
            } else {
                $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'Ticket no.' . $id . ' is updated.', 'create', '/ticket/' . $id);
                echo json_encode(
                    array(
                        "error" => false,
                        "msg" => "Success",
                        "href" => "/ticket/" . $id
                    )
                );
            }
        }
    }

    public function assignTicket($id)
    {
        if (!empty($_POST['comment'])) {
            if (!$this->ticket->update_entry_assign($id, $_POST['user'], $_POST['comment'])) {
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "At this moment is is not possible to assign a ticket. /n Please come back later to try again.",
                        "href" => "unset"
                    )
                );
            } else {
                $this->alert->insert_entry($_POST['user'], 'Re-Assigned', 'A ticket is assigned to you.', 'redo', '/ticket/' . $id);
                $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Re-Assigned', 'Ticket no.' . $id . ' is re-assigned.', 'redo', '/ticket/' . $id);
                echo json_encode(
                    array(
                        "error" => false,
                        "msg" => "Success",
                        "href" => "/ticket/" . $id
                    )
                );
            }
        }
    }

    public function restoreTicket($id)
    {
        if (!$this->ticket->restore_entry($id)) {
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "At this moment is is not possible to restore a ticket. /n Please come back later to try again.",
                    "href" => "unset"
                )
            );
        } else {
            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Restored', 'Ticket no.' . $id . ' is restored.', 'autorenew', '/ticket/' . $id);
            echo json_encode(
                array(
                    "error" => false,
                    "msg" => "Success",
                    "href" => "/ticket/" . $id
                )
            );
        }
    }

    public function addCategory()
    {
        if (!$this->category->insert_entry($_POST['name'], $_POST['info'])) {
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "At this moment is is not possible to create a category. /n Please come back later to try again.",
                    "href" => "unset"
                )
            );
        } else {
            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Created', 'Category is created.', 'add', '/admin/category/');
            echo json_encode(
                array(
                    "error" => false,
                    "msg" => "Success",
                    "href" => "/admin/category"
                )
            );
        }
    }

    public function editCategory($id)
    {
        if (!$this->category->update_entry($id, $_POST['name'], $_POST['info'])) {
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "At this moment is is not possible to edit a category. /n Please come back later to try again.",
                    "href" => "unset"
                )
            );
        } else {
            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'Category no.' . $id . ' is updated.', 'create', '/admin/category/');
            echo json_encode(
                array(
                    "error" => false,
                    "msg" => "Success",
                    "href" => "/admin/category"
                )
            );
        }
    }

    public function addStatus()
    {
        if (!empty($_POST['name'])) {
            if (!empty($_POST['level'])) {
                if (!empty($_POST['info'])) {
                    if (!$this->status->insert_entry($_POST['name'], $_POST['level'], $_POST['info'])) {
                        echo json_encode(
                            array(
                                "error" => true,
                                "msg" => "At this moment is is not possible to create a status. /n Please come back later to try again.",
                                "href" => "unset"
                            )
                        );
                    } else {
                        $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Created', 'Status is created.', 'add', '/admin/status/');
                        echo json_encode(
                            array(
                                "error" => false,
                                "msg" => "Success",
                                "href" => "/admin/status"
                            )
                        );
                    }
                } else {
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "Info is not filled in",
                            "href" => "unset"
                        )
                    );
                }
            } else {
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "Status level is not selected",
                        "href" => "unset"
                    )
                );
            }
        } else {
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => " is not filled in",
                    "href" => "unset"
                )
            );
        }
    }

    public function editStatus($id)
    {
        if (!$this->status->update_entry($id, $_POST['name'], $_POST['level'], $_POST['info'])) {
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "At this moment is is not possible to edit a status. /n Please come back later to try again.",
                    "href" => "unset"
                )
            );
        } else {
            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'Status no.' . $id . ' is updated.', 'create', '/admin/status/');
            echo json_encode(
                array(
                    "error" => false,
                    "msg" => "Success",
                    "href" => "/admin/status"
                )
            );
        }
    }

    public function addImportance()
    {
        if (!empty($_POST['name'])) {
            if (!empty($_POST['level'])) {
                if (!empty($_POST['info'])) {
                    if (!empty($_POST['color'])) {
                        if (!$this->importance->insert_entry($_POST['name'], $_POST['info'], $_POST['color'], $_POST['level'])) {
                            echo json_encode(
                                array(
                                    "error" => true,
                                    "msg" => "At this moment is is not possible to create a importance level. /n Please come back later to try again.",
                                    "href" => "unset"
                                )
                            );
                        } else {
                            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Created', 'Importance is created.', 'add', '/admin/importance/');
                            echo json_encode(
                                array(
                                    "error" => false,
                                    "msg" => "Success",
                                    "href" => "/admin/importance"
                                )
                            );
                        }
                    } else {
                        echo json_encode(
                            array(
                                "error" => true,
                                "msg" => "Color is not picked",
                                "href" => "unset"
                            )
                        );
                    }
                } else {
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "Info is not filled in",
                            "href" => "unset"
                        )
                    );
                }
            } else {
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "Status level is not selected",
                        "href" => "unset"
                    )
                );
            }
        } else {
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "Name is not filled in",
                    "href" => "unset"
                )
            );
        }
    }


    public function editImportance($id)
    {
        if (!$this->importance->update_entry($id, $_POST['name'], $_POST['info'], $_POST['color'], $_POST['level'])) {
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "At this moment is is not possible to edit a importance level. /n Please come back later to try again.",
                    "href" => "unset"
                )
            );
        } else {
            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'Importance no.' . $id . ' is updated.', 'create', '/admin/importance/');
            echo json_encode(
                array(
                    "error" => false,
                    "msg" => "Success",
                    "href" => "/admin/importance"
                )
            );
        }
    }

    public function addUser()
    {
        if (!$this->session->userdata('DX_logged_in')) {
            $this->session->sess_destroy();
            redirect('auth/login');
        } else {
            if ((int)$this->session->userdata('DX_role_id') >= 2) {
                if ($_POST['password'] == $_POST['confirm_password']) {
                    $pass = crypt($this->_encode($_POST['password']), '');
                    if (!$this->user->insert_entry($_POST['username'], $_POST['email'], $pass, $_POST['role'])) {
                        echo json_encode(
                            array(
                                "error" => true,
                                "msg" => "At this moment is is not possible to create a user. /n Please come back later to try again.",
                                "href" => "unset"
                            )
                        );
                    } else {
                        $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Created', 'User is created.', 'add', '/admin/users/');
                        echo json_encode(
                            array(
                                "error" => false,
                                "msg" => "Success",
                                "href" => "/admin/users"
                            )
                        );
                    }
                } else {
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "The passwords are not identical.",
                            "href" => "unset"
                        )
                    );
                }
            } else {
                $this->session->sess_destroy();
                echo json_encode(
                    array(
                        "error" => false,
                        "msg" => "Right level to low.",
                        "href" => "/home"
                    )
                );
            }
        }
    }

    public function editUser($id)
    {
        if (!$this->session->userdata('DX_logged_in')) {
            $this->session->sess_destroy();
            redirect('auth/login');
        } else {

            if ((int)$this->session->userdata('DX_role_id') >= 2) {
                if (!empty($_POST['username'])) {
                    if (!empty($_POST['email'])) {
                        if (!empty($_POST['role'])) {
                            if (!$this->user->update_entry($id, $_POST['username'], $_POST['email'], $_POST['role'])) {
                                echo json_encode(
                                    array(
                                        "error" => true,
                                        "msg" => "At this moment is is not possible to edit a user. /n Please come back later to try again.",
                                        "href" => "unset"
                                    )
                                );
                            } else {
                                if (!empty($_POST['password'])) {
                                    if ($_POST['password'] == $_POST['confirm_password']) {
                                        $pass = crypt($this->_encode($_POST['password']), '');
                                        if (!$this->user->update_password($id, $pass)) {
                                            echo json_encode(
                                                array(
                                                    "error" => true,
                                                    "msg" => "At this moment is is not possible to edit your password. /n Please come back later to try again.",
                                                    "href" => "unset"
                                                )
                                            );
                                        } else {
                                            $this->alert->insert_entry($id, 'Update', 'Your account is updated.', 'create', '/user/profile');
                                            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'User no.' . $id . ' is updated.', 'create', '/admin/users/');
                                            echo json_encode(
                                                array(
                                                    "error" => false,
                                                    "msg" => "Success",
                                                    "href" => "/admin/users"
                                                )
                                            );
                                        }
                                    }
                                } else {
                                    echo json_encode(
                                        array(
                                            "error" => false,
                                            "msg" => "Success",
                                            "href" => "/admin/users"
                                        )
                                    );
                                }
                            }
                        } else {
                            echo json_encode(
                                array(
                                    "error" => true,
                                    "msg" => "There is no role selected",
                                    "href" => "unset"
                                )
                            );
                        }
                    } else {
                        echo json_encode(
                            array(
                                "error" => true,
                                "msg" => "There is no email filled in",
                                "href" => "unset"
                            )
                        );
                    }
                } else {
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "There is no username filled in",
                            "href" => "unset"
                        )
                    );
                }
            } else {
                $this->session->sess_destroy();
                echo json_encode(
                    array(
                        "error" => false,
                        "msg" => "Right level to low.",
                        "href" => "/home"
                    )
                );
            }
        }
    }

    public function editUserFront($id)
    {
        if (!$this->session->userdata('DX_logged_in')) {
            $this->session->sess_destroy();
            redirect('auth/login');
        } else {
            if ((int)$this->session->userdata('DX_role_id') >= 2) {
                if (!$this->user->update_entry_user($id, $_POST['username'], $_POST['email'])) {
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "At this moment is is not possible to edit a user. /n Please come back later to try again.",
                            "href" => "unset"
                        )
                    );
                } else {
                    if (!empty($_POST['password'])) {
                        if ($_POST['password'] == $_POST['confirm_password']) {
                            $pass = crypt($this->_encode($_POST['password']), '');
                            if (!$this->user->update_password($id, $pass)) {
                                echo json_encode(
                                    array(
                                        "error" => true,
                                        "msg" => "At this moment is is not possible to edit your password. /n Please come back later to try again.",
                                        "href" => "unset"
                                    )
                                );
                            } else {
                                $this->alert->insert_entry($id, 'Update', 'Your account is updated.', 'create', '/user/profile/');
                                echo json_encode(
                                    array(
                                        "error" => false,
                                        "msg" => "Success",
                                        "href" => "/user/profile"
                                    )
                                );
                            }
                        }
                    } else {
                        echo '/user/profile';
                    }
                }
            } else {
                $this->session->sess_destroy();
                echo json_encode(
                    array(
                        "error" => false,
                        "msg" => "Right level to low.",
                        "href" => "/home"
                    )
                );
            }
        }
    }

    function _encode($password)
    {
        $majorsalt = 'UITY&O*7d8u09pasolkJGDT))polkhjg879SOI';

        // if PHP5
        if (function_exists('str_split')) {
            $_pass = str_split($password);
        } /*if PHP4*/
        else {
            $_pass = array();
            if (is_string($password)) {
                for ($i = 0; $i < strlen($password); $i++) {
                    array_push($_pass, $password[$i]);
                }
            }
        }

        // encrypts every single letter of the password
        foreach ($_pass as $_hashpass) {
            $majorsalt .= md5($_hashpass);
        }

        // encrypts the string combinations of every single encrypted letter
        // and finally returns the encrypted password
        return md5($majorsalt);
    }

    public function lineChartTicket($daysBack = 31)
    {
        $array = $this->ticket->get_all_ticket_no_join();

        $tmp = array();

        foreach ($array as $item) {
            if (!array_key_exists(
                strtotime(
                    (string)date('d-m-Y',
                        strtotime($item['ticket_created_at'])
                    )
                ), $tmp)) {
                $tmp[strtotime(
                    (string)date('d-m-Y',
                        strtotime($item['ticket_created_at'])
                    )
                )] = 1;
            } else {
                $tmp[strtotime(
                    (string)date('d-m-Y',
                        strtotime($item['ticket_created_at'])
                    )
                )] = (
                    $tmp[strtotime(
                        (string)date('d-m-Y',
                            strtotime($item['ticket_created_at'])
                        )
                    )] + 1
                );
            }
        }

        $json = '{"cols": [{"id":"","label":"Date","pattern":"","type":"string"},{"id":"","label":"Tickets","pattern":"","type":"number"}],"rows": [';

        for ($x = ($daysBack - 1); $x > -1; $x--) {
            $key = strtotime('-' . $x . ' day',
                strtotime(
                    date('d F Y')
                )
            );

            if (array_key_exists($key, $tmp)) {
                $json .= '{"c":[{"v":"' . date('d F Y', $key) . '","f":null},{"v":' . $tmp[$key] . ',"f":null}]},';
            } else {
                $json .= '{"c":[{"v":"' . date('d F Y', $key) . '","f":null},{"v":0,"f":null}]},';
            }
        }

        $json .= ']}';

        echo $json;
    }

    public function lineChartLogins($daysBack = 31)
    {
        $array = $this->user->get_all_login_entries();

        $tmp = array();

        foreach ($array as $item) {
            if (!array_key_exists(strtotime((string)date('d-m-Y', strtotime($item['date']))), $tmp)) {
                $tmp[strtotime((string)date('d-m-Y', strtotime($item['date'])))] = 1;
            } else {
                $tmp[strtotime((string)date('d-m-Y', strtotime($item['date'])))] = ($tmp[strtotime((string)date('d-m-Y', strtotime($item['date'])))] + 1);
            }
        }

        $json = '{"cols": [{"id":"","label":"Date","pattern":"","type":"string"},{"id":"","label":"Logins","pattern":"","type":"number"}],"rows": [';

        for ($x = ($daysBack - 1); $x > -1; $x--) {
            $key = strtotime(date('d F Y', strtotime('-' . $x . ' day', strtotime(date('d F Y')))));
            if (array_key_exists($key, $tmp)) {
                $json .= '{"c":[{"v":"' . date('d F Y', $key) . '","f":null},{"v":' . $tmp[$key] . ',"f":null}]},';
            } else {
                $json .= '{"c":[{"v":"' . date('d F Y', $key) . '","f":null},{"v":0,"f":null}]},';
            }
        }

        $json .= ']}';

        echo $json;
    }

    public function pieChartCat()
    {
        $array = $this->ticket->get_pie_chart();

        $tmp = array();

        foreach ($array as $item) {
            if (!array_key_exists($item['cat_name'], $tmp)) {
                $tmp[$item['cat_name']] = 1;
            } else {
                $tmp[$item['cat_name']] = ($tmp[$item['cat_name']] + 1);
            }
        }

        $json = '{"cols": [{"id":"","label":"Date","pattern":"","type":"string"},{"id":"","label":"Ticket","pattern":"","type":"number"}],"rows": [';

        foreach ($tmp as $key => $item) {
            $json .= '{"c":[{"v":"' . $key . '","f":null},{"v":' . $item . ',"f":null}]},';
        }

        $json .= ']}';

        echo $json;
    }

    public function pieChartClient()
    {
        $array = $this->ticket->get_pie_chart_client();

        $tmp = array();

        foreach ($array as $item) {
            if (!array_key_exists($item['client_name'], $tmp)) {
                $tmp[$item['client_name']] = 1;
            } else {
                $tmp[$item['client_name']] = ($tmp[$item['client_name']] + 1);
            }
        }

        $json = '{"cols": [{"id":"","label":"Date","pattern":"","type":"string"},{"id":"","label":"Ticket","pattern":"","type":"number"}],"rows": [';

        foreach ($tmp as $key => $item) {
            $json .= '{"c":[{"v":"' . $key . '","f":null},{"v":' . $item . ',"f":null}]},';
        }

        $json .= ']}';

        echo $json;
    }

    public function resetMail()
    {
        foreach ($this->mail->get_default_entry() as $key => $item) {
            if ($key != 'id') {
                if (!$this->mail->reset_entry($key, $item)) {
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "At this moment is is not possible to reset this (" . $key . ") configuration. /n Please come back later to try again.",
                            "href" => "unset"
                        )
                    );
                }
            }
        }
        $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Reset', 'The mail configuration is set to default.', 'redo', '/admin/mail/');
        echo json_encode(
            array(
                "error" => false,
                "msg" => "Success",
                "href" => ""
            )
        );
    }


    public function updateMail()
    {
        if (!empty($_POST['protocol'])){
            if (!empty($_POST['smtp_host'])){
                if (!empty($_POST['smtp_user'])){
                    if (!empty($_POST['smtp_pass'])){
                        if (!empty($_POST['smtp_port'])){
                            if (!$this->mail->update_entry(
                                1,
                                $_POST['protocol'],
                                $_POST['smtp_host'],
                                $_POST['smtp_user'],
                                $_POST['smtp_pass'],
                                $_POST['smtp_port'],
                                !empty($_POST['smtp_timeout'])? $_POST['smtp_timeout'] : '5',
                                !empty($_POST['smtp_crypto'])? $_POST['smtp_crypto'] : '',
                                !empty($_POST['mailtype'])? $_POST['mailtype'] : 'html',
                                !empty($_POST['newline'])? $_POST['newline'] : '\r\n',
                                !empty($_POST['crlf'])? $_POST['crlf'] : '\r\n',
                                !empty($_POST['charset'])? $_POST['charset'] : 'utf-8',
                                !empty($_POST['validate'])? $_POST['validate'] : '0',
                                !empty($_POST['priority'])? $_POST['priority'] : '2'
                            )) {
                                echo json_encode(
                                    array(
                                        "error" => true,
                                        "msg" => "At this moment is is not possible to edit the configuration. /n Please come back later to try again.",
                                        "href" => "unset"
                                    )
                                );
                            } else{
                                $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'The mail configuration is updated.', 'create', '/admin/mail/');
                                echo json_encode(
                                    array(
                                        "error" => true,
                                        "msg" => "Success",
                                        "href" => "unset"
                                    )
                                );
                            }
                        } else{
                            echo json_encode(
                                array(
                                    "error" => true,
                                    "msg" => "No port set",
                                    "href" => "unset"
                                )
                            );
                        }
                    } else{
                        echo json_encode(
                            array(
                                "error" => true,
                                "msg" => "No password set",
                                "href" => "unset"
                            )
                        );
                    }
                } else{
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "No user set",
                            "href" => "unset"
                        )
                    );
                }
            } else{
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "No host set",
                        "href" => "unset"
                    )
                );
            }
        } else{
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "No protocol set",
                    "href" => "unset"
                )
            );
        }
    }

    public function addMailTemp()
    {
        if (!$this->templates->insert_entry($_POST["subject"], $_POST["content"])) {
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "At this moment is is not possible to create a template. /n Please come back later to try again.",
                    "href" => "unset"
                )
            );
        } else {
            $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Reset', 'The mail configuration is set to default.', 'redo', '/admin/templates/');
            echo json_encode(
                array(
                    "error" => false,
                    "msg" => "Success",
                    "href" => "/admin/templates"
                )
            );
        }
    }

    public function updateMailTemp($id)
    {
        if (!empty($_POST['subject'])) {
            if (!empty($_POST['content'])) {
                if (!$this->templates->update_entry($id, $_POST['subject'], $_POST['content'])) {
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "At this moment is is not possible to edit this template. /n Please come back later to try again.",
                            "href" => "unset"
                        )
                    );
                } else {
                    $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'Mail template no.' . $id . ' is updated.', 'create', '/admin/templates/');
                    echo json_encode(
                        array(
                            "error" => false,
                            "msg" => "Success",
                            "href" => ""
                        )
                    );
                }
            } else{
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "No content set",
                        "href" => "unset"
                    )
                );
            }
        } else{
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "No subject set",
                    "href" => "unset"
                )
            );
        }
    }

    public function addClient()
    {

        if (!empty($_POST["username"])) {
            if (!$this->clients->insert_entry(
                $_POST["username"],
                !empty($_POST['tel']) ? $_POST['tel'] : '',
                !empty($_POST['email']) ? $_POST['email'] : '',
                !empty($_POST['country']) ? $_POST['country'] : '',
                !empty($_POST['state']) ? $_POST['state'] : '',
                !empty($_POST['town']) ? $_POST['town'] : '',
                !empty($_POST['street']) ? $_POST['street'] : '',
                !empty($_POST['number']) ? $_POST['number'] : '',
                !empty($_POST['zip']) ? $_POST['zip'] : ''
            )) {
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "At this moment is is not possible to create a client. /n Please come back later to try again.",
                        "href" => "unset"
                    )
                );
            } else {
                $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Created', 'Client is created.', 'add', '/admin/clients/');
                echo json_encode(
                    array(
                        "error" => false,
                        "msg" => "Success",
                        "href" => "/admin/clients"
                    )
                );
            }
        } else {
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "Username not filled in",
                    "href" => "unset"
                )
            );
        }

    }

    public function editClient($id)
    {
        if (!empty($_POST["username"])) {
            if (!$this->clients->update_entry(
                $id,
                $_POST["username"],
                !empty($_POST['tel']) ? $_POST['tel'] : '',
                !empty($_POST['email']) ? $_POST['email'] : '',
                !empty($_POST['country']) ? $_POST['country'] : '',
                !empty($_POST['state']) ? $_POST['state'] : '',
                !empty($_POST['town']) ? $_POST['town'] : '',
                !empty($_POST['street']) ? $_POST['street'] : '',
                !empty($_POST['number']) ? $_POST['number'] : '',
                !empty($_POST['zip']) ? $_POST['zip'] : ''
            )) {
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "At this moment is is not possible to edit a client. /n Please come back later to try again.",
                        "href" => "unset"
                    )
                );
            } else {
                $this->alert->insert_entry($this->session->userdata('DX_user_id'), 'Update', 'Client no.' . $id . ' is updated.', 'create', '/admin/clients/');
                echo json_encode(
                    array(
                        "error" => false,
                        "msg" => "Success",
                        "href" => "/admin/clients"
                    )
                );
            }
        } else {
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "Username not filled in",
                    "href" => "unset"
                )
            );
        }
    }

    public function markAsRead(){
        if ( ! $this->alert->set_read($_POST['id'])){
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "At this moment is is not possible to mark this item as read. /n Please come back later to try again.",
                    "href" => "unset"
                )
            );
        } else{
            echo json_encode(
                array(
                    "error" => false,
                    "msg" => "Success",
                    "href" => ""
                )
            );
        }
    }

    public function markAsReadAll(){
        if ( ! $this->alert->set_read_all($this->session->userdata('DX_user_id'))){
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "At this moment is is not possible to mark all items as read. /n Please come back later to try again.",
                    "href" => "unset"
                )
            );
        } else{
            echo json_encode(
                array(
                    "error" => false,
                    "msg" => "Success",
                    "href" => ""
                )
            );
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
            );

        return str_replace('/', random_int(10, 55), $majorsalt);
    }

    public function getTicketsHome(){
        $html = '';
        $data = $this->ticket->get_pending_entries();

        foreach ($data as $item){
            $html .= '<div class="card ticket-card" style="width: 18rem;"  onclick="window.location = \'/ticket/'.$item['ticket_id'] .'\'"><div class="card-body"><h5 class="card-title">'. ucfirst($item['client_name']) .'</h5><h6 class="card-subtitle mb-2 text-muted">'. checkShowOrHide($item['status_level'], 'pending', '<importance style="color:' . $item['importance_color'] . '">' . $item['importance_name'] . '</importance>').'<br/>'.$item['cat_name'].'<br/>'.$item['email'].'</h6><p class="card-text dotted">'. $item['ticket_problem'] .'</p><a href="/ticket/'. $item['ticket_id'] .'" class="card-link">More...</a></div></div>';
        }

        echo $html;
    }

    public function addRightLevel(){
        if (!empty($_POST['name'])){
            if (!empty($_POST['info'])){
                if (!$this->roles->insert_entry($_POST['name'], $_POST['info'])){
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "At this moment is is not possible create a right level. /n Please come back later to try again.",
                            "href" => "unset"
                        )
                    );
                } else{
                    echo json_encode(
                        array(
                            "error" => false,
                            "msg" => "Success",
                            "href" => "/admin/rights"
                        )
                    );
                }
            } else{
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "Info not set",
                        "href" => "unset"
                    )
                );
            }
        } else{
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "Name not set",
                    "href" => "unset"
                )
            );
        }
    }

    public function editRightLevel($id){
        if (!empty($_POST['name'])){
            if (!empty($_POST['info'])){
                if (!$this->roles->update_entry($id, $_POST['name'], $_POST['info'])){
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "At this moment is is not possible update a right level. /n Please come back later to try again.",
                            "href" => "unset"
                        )
                    );
                } else{
                    echo json_encode(
                        array(
                            "error" => false,
                            "msg" => "Success",
                            "href" => "/admin/rights"
                        )
                    );
                }
            } else{
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "Info not set",
                        "href" => "unset"
                    )
                );
            }
        } else{
            echo json_encode(
                array(
                    "error" => true,
                    "msg" => "Name not set",
                    "href" => "unset"
                )
            );
        }
    }
}