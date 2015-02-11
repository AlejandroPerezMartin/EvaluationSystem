<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - remove_question()
 * Classes list:
 * - Action extends CI_Controller
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('authentication'));
    }

    public function add_option()
    {
        $option_data = array(
             'name' => '',
             'is_correct' => 0,
             'question_id' => $this->input->post('question_id'),
        );
        $this->db->insert('option', $option_data);
        echo $this->db->insert_id();
    }

    public function add_closed_question()
    {

        $question_data = array(
             'statement' => '',
             'max_points' => 0,
             'type' => 0,
             'exam_template_id' => $this->input->post('exam_template_id')
        );

        $this->db->insert('question', $question_data);

        $question_id = $this->db->insert_id();

        $option_data = array(
             'name' => '',
             'is_correct' => 0,
             'question_id' => $question_id,
        );

        $this->db->insert('option', $option_data);
        $this->db->insert('option', $option_data);

        echo $question_id;
    }

    public function remove_question()
    {
        // Check if user can delete that question
        echo $this->db->delete('question', array('id' => $this->input->post('question_id')));
    }


    public function remove_option()
    {
        // Check if user can delete that question
        echo $this->db->delete('option', array('id' => $this->input->post('option_id')));
    }
}
?>
