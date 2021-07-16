<?php


class UserModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function registerUser($firstName, $lastName, $email, $password)
    {
       
        $user = array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => $password
        );

        return $this->db->insert('users', $user);
       
    }
  
    public function authUser($email, $password)
    {
        $result = $this->db->get_where('users', array('email' => $email));

        if (count($result->result()) == 0) {

            return "Invalid Credentials";
        } else {
            log_message('debug', "after email");
            $row = $result->result();
            log_message('debug', " User results: " . print_r($row, True));
            $hashedPassword = $row[0]->password;
            if ($password === $hashedPassword) {

                $this->session->is_loggedin = true;

                $this->session->set_userdata('userId', $row[0]->userId);
                log_message('debug', "Successfully Verified the user!");
                log_message("debug", $this->session->set_userdata('userId', $row[0]->userId));
                return array('firstName' => $row[0]->firstName, 'lastName' => $row[0]->lastName);
            } else {

                return "Password is incorrect!";
            }
        }
    }
}
