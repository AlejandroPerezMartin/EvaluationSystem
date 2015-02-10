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
        $this->load->model(array('authentication', 'exam', 'user'));
    }

    public function add_option()
    {
        $option_data = array(
             'question_id' => $this->input->post('question_id'),
             'name' => '',
             'is_correct' => 0
        );
        $this->db->insert('option', $option_data);
        echo $this->db->insert_id();
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
