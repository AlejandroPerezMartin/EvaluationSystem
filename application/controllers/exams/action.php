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

    public function remove_question()
    {
        // Check if user can delete that question
        echo $this->db->delete('question', array('id' => $this->input->post('question_id')));
    }
}
?>
