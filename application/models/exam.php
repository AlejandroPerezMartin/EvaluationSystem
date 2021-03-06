<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - create_exam()
 * - enable_exam()
 * - remove_exam()
 * - get_exam_template()
 * - exam_exists()
 * - get_exam_template_questions()
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

    public function remove_exam($exam_id)
    {
        $this->db->delete('exam_template', array('id' => $exam_id, 'user_id' => $this->authentication->get_logged_user_id()));
    }

    public function get_exam_template($exam_id)
    {
        $query = $this->db->get_where('exam_template', array('id' => $exam_id), 1);
        return $query->result();
    }

    public function exam_exists($exam_id)
    {
        $query = $this->db->get_where('exam_template', array('id' => $exam_id, 'user_id' => $this->authentication->get_logged_user_id()), 1);
        return $query->result();
    }

    public function get_exam_template_questions($exam_id)
    {
        if (!empty($exam_id))
        {
            $this->db->select('exam_template.user_id, exam_template.id AS exam_template_id, exam_template.name AS exam_name, start_date, due_date, enabled, duration, course_id, question.id AS question_id, statement, option.id AS option_id, option.name AS option_name, type, max_points');
            $this->db->from('exam_template');
            $this->db->join('question', 'exam_template.id=question.exam_template_id', 'inner');
            $this->db->join('option', 'question.id=option.question_id', 'inner');
            $this->db->where('exam_template_id', $exam_id);
            $this->db->where('exam_template.user_id', $this->authentication->get_logged_user_id());
            $this->db->distinct();

            $query = $this->db->get();
            $result = $query->result();

            $exam_questions = array();
            foreach ($result as $key => $value)
            {
                if (!isset($previous_question_id) || $previous_question_id != $value->question_id)
                {
                    $exam_questions[$value->question_id] = array();
                    $exam_questions[$value->question_id]['statement'] = $value->statement;
                    $exam_questions[$value->question_id]['type'] = $value->type;
                    $exam_questions[$value->question_id]['options'] = array();
                }
                $exam_questions[$value->question_id]['options'][$value->option_id] = $value->option_name;
                $previous_question_id = $value->question_id;
            }

            return $exam_questions;
        }
        return false;
    }
}
?>
