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

    public function get_user_courses()
    {
        $query = $this->db->get_where('user_course', array('user_id' => $this->authentication->get_logged_user_id()));

        $courses_id = array();

        if (!empty($query->result()))
        {
            foreach ($query->result() as $course)
            {
                array_push($courses_id, $course->course_id);
            }

            $this->db->select('*');
            $this->db->from('course');
            $this->db->where_in('id', $courses_id);
            $query = $this->db->get();

            return $query->result();
        }

        return false;
    }

    public function is_user_enrolled_in_course($courseId)
    {
        $query = $this->db->get_where('user_course', array('course_id' => $courseId, 'user_id' => $this->authentication->get_logged_user_id()), 1);
        return !empty($query->result());
    }
}
?>
