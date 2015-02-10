<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - create_exam()
 * - enable_exam()
 * - get_exam_template()
 * - get_exam_template_questions()
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
        if (!empty($exam_id))
        {
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

    public function get_exam_template_questions($exam_id)
    {
        if (!empty($exam_id))
        {
            $this->db->select('question.id AS id, statement, option.id AS option_id, option.name AS option_name, type, max_points');
            $this->db->from('exam_template');
            $this->db->join('question', 'exam_template.id=question.exam_template_id', 'inner');
            $this->db->join('option', 'question.id=option.question_id', 'inner');
            $this->db->where('exam_template_id', $exam_id);
            $this->db->distinct();

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
