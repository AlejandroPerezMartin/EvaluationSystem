<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - create_exam()
 * - is_user_enrolled_in_course()
 * Classes list:
 * - Exam extends CI_Model
 */
class Exam extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('authentication');
    }

    public function create_exam($exam_data)
    {
        if (!is_array($exam_data) || empty($exam_data))
        {
            return false;
        }

        return $this->db->insert('exam_template', $exam_data);
    }

    public function is_user_enrolled_in_course($courseId)
    {
        $query = $this->db->get_where('user_course', array('course_id' => $courseId, 'user_id' => $this->authentication->get_logged_user_id()), 1);
        return !empty($query->result());
    }
}
?>
