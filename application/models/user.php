<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - get_user_enrolled_courses()
 * - get_user_created_exams()
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
        $logged_user_id = $this->authentication->get_logged_user_id();

        $this->db->select('course_id, name, acronym');
        $this->db->from('course');
        $this->db->join('user_course', 'user_course.course_id=course.id', 'inner');
        $this->db->where('user_id', $logged_user_id);
        $this->db->distinct();

        $query = $this->db->get();

        return $query->result();
    }

    public function get_user_created_exams()
    {
        $this->db->select('exam_template.id AS exam_template_id, exam_template.name AS exam_name, start_date, due_date, enabled, course.name AS course_name, acronym');
        $this->db->from('exam_template');
        $this->db->join('course', 'exam_template.course_id=course.id and exam_template.user_id=' . $this->authentication->get_logged_user_id(), 'inner');
        $this->db->distinct();
        $query = $this->db->get();

        return $query->result();
    }
}
?>
