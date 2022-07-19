<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends Base_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->page_data = array();

        $this->load->model("User_model");
    }


    // show all email.
    function index()
    {
        $user = $this->User_model->get_all();

        $this->page_data["user"] = $user;

        // load out the view for user index panel + header + footer.
        // bring in the page data into this page
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/user/all");
        $this->load->view("admin/footer");
    }

    // add email into database.
    function add()
    {
        if ($_POST) {
            $input = $this->input->post();

            $error = false;

            if (!$error) {

                // separate the email into name part and domain name.
                // store the name part and domain name into database for sort function purpose.
                $name = explode("@", $_POST['email'])[0];
                $domain_name = explode("@",  $_POST['email'])[1];
                $data = array(
                    'email' => $input['email'],
                    'name' => $name,
                    'domain_name' => $domain_name
                );

                // insert into database.
                $this->User_model->insert($data);

                // return to index page.
                redirect("user", "refresh");
            }
        }
        // load out the view for user index panel + header + footer.
        // bring in the page data into this page
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/user/add");
        $this->load->view("admin/footer");
    }

    // edit the user email part, user id get from the param
    function edit($user_id)
    {

        if ($_POST) {
            $input = $this->input->post();

            $error = false;


            if (!$error) {
                // separate the email into name part and domain name.
                // store the name part and domain name into database for sort function purpose.
                $name = explode("@", $_POST['email'])[0];
                $domain_name = explode("@",  $_POST['email'])[1];
                $where = array(
                    'user_id' => $user_id
                );

                $data = array(
                    'email' => $input['email'],
                    'name' => $name,
                    'domain_name' => $domain_name
                );
                // update the user's email, name and domain name by following the user_id
                $this->User_model->update_where($where, $data);

                // return to index page after update successfully.
                redirect('user', "refresh");
            }
        }

        $where = array(
            "user_id" => $user_id
        );

        // get the selected user's data and show in edit page.
        $user = $this->User_model->get_where($where);

        // show error message if the user array is empty.
        $this->show_404_if_empty($user);

        // since the user is only one, we user 0 index to get the data in array.
        $this->page_data["user"] = $user[0];

        // load out the view for user index panel + header + footer.
        // bring in the page data into this page
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/user/edit");
        $this->load->view("admin/footer");
    }
}
