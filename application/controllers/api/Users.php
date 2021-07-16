<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Users extends \Restserver\Libraries\REST_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        //load User Model
        $this->load->model('UserModel');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
    }


    /**
     * Registration the user method
     */
    public function register_post()
    {
        $firstName = $this->post('firstName');
        $lastName = $this->post('lastName');
        $email = $this->post('email');
        $password = $this->post('password');

        $response = $this->UserModel->registerUser($firstName, $lastName, $email, $password);


        if ($response === true) {
            $this->set_response("Success", \Restserver\Libraries\REST_Controller::HTTP_CREATED);
        } else if (strcmp($response, "Email exists") == 0) {
            $this->set_response("Error", \Restserver\Libraries\REST_Controller::HTTP_NOT_ACCEPTABLE);
        }
    }

    /**
     * login method 
     */
    public function login_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');

        $response = $this->UserModel->authUser($email, $password);

        if (is_array($response)) {
            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
        } else if (strcmp($response, "Password is incorrect!") == 0) {
            $this->set_response("Error", \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $this->set_response("Error", \Restserver\Libraries\REST_Controller::HTTP_FORBIDDEN);
        }
    }
}
