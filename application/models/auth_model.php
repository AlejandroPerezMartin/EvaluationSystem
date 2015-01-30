<?php
/**
 * Class and Function List:
 * Function list:
 * - login()
 * Classes list:
 * - User extends CI_Model
 */
class User extends CI_Model
{

    public function __construct() {
        $this->load->library('session');
        $this->load->model(array('encrypt_model'));
    }

    public function login($email, $password)
    {
        $db->select->('id', 'email', 'password');
        $db->from->('users');
        $db->where->('email', $email);
        $db->where->('password', $this->encrypt->sha1($password));
        $db->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1)
        {
            // user and password match
            $this->session->set_userdata(array(
                'id' => $query->row->id,
                'name' => $query->row->name,
                'logged_user' => true
            ));
            return true;

        } else
        {
            return false;
        }
    }

    public function is_user_logged(){
        return ($this->session->userdata('logged_user')) ? true : false;
    }

    public function get_logged_user_id(){
        return ($this->is_user_logged()) ? $this->session->userdata('logged_user') : '';
    }

}
?>
