<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data = array();

        $this->load->model("Access_model");
        $this->load->model("Admin_model");
        $this->load->model("Api_error_model");
        $this->load->model("Api_request_model");

        $this->load->model("User_model");

        $this->load->model("Joke_model");

        // Store the REQUEST in database
        if ($_REQUEST) {

            $data = array(
                'params' => json_encode($_REQUEST),
                'action' => basename($_SERVER['REQUEST_URI']),
            );
            $this->Api_request_model->insert($data);
        }
    }

    public function get_email()
    {
        try {
            if ($_POST) {
                // 0 : sort by name
                // 1 : sort by domain name
                // 2 : sort by domain name and name
                if ($_POST['is_sort'] == 0) {
                    $sql = "SELECT * FROM user WHERE deleted = 0 ORDER BY name ASC";
                } else if ($_POST['is_sort'] == 1) {
                    $sql = "SELECT * FROM user WHERE deleted = 0 ORDER BY domain_name ASC";
                } else {
                    $sql = "SELECT * FROM user WHERE deleted = 0 ORDER BY domain_name ASC, name ASC";
                }

                // query out the sql query to get the result.
                $user = $this->db->query($sql)->result_array();

                // expose results to frontend.
                die(json_encode(array(
                    "status" => true,
                    "data" => $user,
                )));
            }
        } catch (Error $e) {

            // store error data if error occur.
            $data = array(
                'params' => $e->getMessage(),
                'action' => basename($_SERVER['REQUEST_URI']),
            );
            $this->Api_error_model->insert($data);

            // show the error at front to alert user.
            die(json_encode(array(
                "status" => false,
                "message" => 'Error',
            )));
        }
    }

    function send_email()
    {
        // POST THE selected email 
        if ($_POST) {
            $email = $_POST['email'];

            // if email is empty, show alert message to user.
            if ($email == "") {
                $message = 'Please select an email.';
                die(json_encode([
                    'status' => false,
                    'message' => $message
                ]));
            }

            // take a random joke from API
            $joke = $this->Joke_model->joke();

            // email body
            $body = '<!DOCTYPE html>
            <html>
                <head>
                    <title>Chuck Norris Joke</title>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <div class="header">
                        <h1>If you do not laugh, Chuck Norris will be standing behind you</h1>
                    </div>
                    <div class="content">
                        <p>Test,<p>
                        <br>
                        <p>Joke : " ' . $joke['joke'] . ' " .</p>
                        <br>
                        <br>
                        <br>

                    </div>
                    <div class="footer">
                    </div>
                </body>
            </html>
            ';

            // load library from email.
            $this->load->library('email');

            // config for the email, we use google email function
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'chucknorris.joke.assignment@gmail.com',
                // Must open 2 steps verification at Gmail, (Open verification and Add password)
                'smtp_pass' => 'mbqbggeyzoyqtbgi',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'newline' => "\r\n"
            );


            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from('chucknorris.joke.assignment@gmail.com', "Assignment");
            $this->email->to($email);
            $this->email->reply_to('chucknorris.joke.assignment@gmail.com', "Chuck Norris Joke");
            $this->email->subject('Chuck Norris Joke');
            $this->email->message($body);

            if ($this->email->send()) {
                // if email sent, success.
                die(json_encode(array(
                    "status" => true,
                    "data" => 'Joke sent.',
                )));
            } else {
                // else failed, show the error message to user.
                $message = $this->email->print_debugger();

                die(json_encode(array(
                    "status" => false,
                    "message" => $message,
                )));
            }
        }
    }
}
