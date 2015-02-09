<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - get_user_courses()
 * - is_user_enrolled_in_course()
 * Classes list:
 * - User extends CI_Model
 */
class User extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('authentication');
    }

    public function get_user_enrolled_courses()
    {
        $logged_user_id = intval($this->authentication->get_logged_user_id());

        $this->db->select('course_id, name, acronym');
        $this->db->from('course');
        $this->db->join('user_course', 'user_course.course_id=course.id', 'inner');
        $this->db->where('user_id', $logged_user_id);
        $this->db->distinct();

        $query = $this->db->get();

        return $query->result();
    }

    public function get_logged_user_role()
    {
        $this->db->select('role');
        $this->db->from('user');
        $this->db->where('id', $this->authentication->get_logged_user_id());
        $this->db->limit(1);

        $query = $this->db->get();
        $query = $query->result();

        return $query[0]->role;
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

    public function is_user_enrolled_in_course($courseId)
    {
        $query = $this->db->get_where('user_course', array('course_id' => $courseId, 'user_id' => $this->authentication->get_logged_user_id()), 1);
        return !empty($query->result());
    }
}
?>
