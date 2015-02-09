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
        if (is_array($exam_data) && !empty($exam_data))
        {
            $this->db->insert('exam_template', $exam_data);
            return $this->db->insert_id();
        }

        return false;
    }

    public function enable_exam($exam_id)
    {
        if (!empty($exam_id)) {
            $data = array('enabled' => 1);
            return $this->db->update('exam_template', $data, array('id' => $exam_id, 'user_id' => $this->authentication->get_logged_user_id()));
        }

        return false;
    }

    public function get_exam_template($exam_id)
    {
        $query = $this->db->get_where('exam_template', array('id' => $exam_id), 1);
        return $query->result();
    }

    public function is_user_enrolled_in_course($courseId)
    {
        $query = $this->db->get_where('user_course', array('course_id' => $courseId, 'user_id' => $this->authentication->get_logged_user_id()), 1);
        return !empty($query->result());
    }

}

?>
