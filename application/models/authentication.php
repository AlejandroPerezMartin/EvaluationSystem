<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - process_login()
 * - is_user_logged()
 * - get_logged_user_id()
 * - get_logged_user_role()
 * - is_logged_user_admin()
 * - is_logged_user_professor()
 * - is_logged_user_student()
 * - get_logged_user_name()
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
        $this->db->select('id, name, email, password, role');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->where('password', $this->encrypt->sha1(md5($password)));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1)
        {
            foreach ($query->result() as $row)
            {
                // if user and password match, add to session data
                $this->session->set_userdata(array('id' => $row->id, 'name' => $row->name, 'role' => $row->role, 'logged_in' => true));
                return true;
            }
        } else
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
        return ($this->is_user_logged()) ? $this->session->userdata('id') : '';
    }
    /*
     * User roles: admin (0), professor (1), student (2)
    */
    public function get_logged_user_role()
    {
        return ($this->is_user_logged()) ? $this->session->userdata('role') : '';
    }

    public function is_logged_user_admin()
    {
        return $this->get_logged_user_role() == 0;
    }

    public function is_logged_user_professor()
    {
        return $this->get_logged_user_role() == 1;
    }

    public function is_logged_user_student()
    {
        return $this->get_logged_user_role() == 2;
    }

    public function get_logged_user_name()
    {
        return ($this->is_user_logged()) ? $this->session->userdata('name') : '';
    }
}
?>
