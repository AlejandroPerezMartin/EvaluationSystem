<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - process_login()
 * - is_user_logged()
 * - get_logged_user_id()
 * - get_logged_user_role()
 * Classes list:
 * - Authentication extends CI_Model
 */
class Authentication extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function process_login($email, $password)
    {
        $this->db->select('id, email, password, role');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', $this->encrypt->sha1(md5($password)));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1)
        {
            // if user and password match, add to session data
            $this->session->set_userdata(array('id' => $query->row->id, 'name' => $query->row->name, 'role' => $query->row->role, 'logged_in' => true));
            return true;
        }
        else
        {
            return false;
        }
    }

    public function is_user_logged()
    {
        return ($this->session->userdata('logged_in')) ? true : false;
    }

    public function get_logged_user_id()
    {
        return ($this->is_user_logged()) ? $this->session->userdata('logged_in') : '';
    }

    public function get_logged_user_role()
    {
        return ($this->is_user_logged()) ? $this->session->userdata('role') : '';
    }
}
?>
