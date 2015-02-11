<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - get_all_courses()
 * - get_users_in_course()
 * - get_all_users_not_in_course()
 * - enroll_student_in_course()
 * - unenroll_student_from_course()
 * Classes list:
 * - Course extends CI_Model
 */
class Course extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('authentication');
    }

    public function get_all_courses()
    {
        if ($this->authentication->is_logged_user_admin())
        {
            $query = $this->db->get('course');
            return $query->result();
        }
        return false;
    }

    public function get_users_in_course($course_id)
    {
        $query = $this->db->query('SELECT `user_id`, `course_id`, `name` FROM (`user_course`, `user`) WHERE `user_course`.`user_id` = `id` AND `user`.`role` = 2 AND `user_course`.`course_id` = ? ORDER BY (`id`)', array($course_id));
        return $query->result();
    }

    public function get_all_users_not_in_course($course_id)
    {
        $query = $this->db->query('SELECT * FROM `user` WHERE id NOT IN (SELECT user_id FROM user_course WHERE course_id=?) AND role=2', array($course_id));
        return $query->result();
    }

    public function get_course_name($course_id)
    {
        $query = $this->db->get_where('course', array('id' => $course_id), 1);
        return $query->result()[0]->name;
    }

    public function enroll_student_in_course($student_id, $course_id)
    {
        $this->db->insert('user_course', array('user_id' => $student_id, 'course_id' => $course_id));
    }

    public function unenroll_student_from_course($student_id, $course_id)
    {
        $this->db->delete('user_course', array('user_id' => $student_id, 'course_id' => $course_id));
    }
}
?>
