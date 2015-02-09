<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - index()
 * - _remap()
 * Classes list:
 * - Edit extends CI_Controller
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('parser', 'form_validation'));
        $this->load->model(array('authentication', 'exam', 'user'));
        $this->load->helper('form');
    }

    public function index($exam_id)
    {
        // Only editable by professors
        if (empty($exam_id) || !$this->authentication->is_user_logged() || $this->authentication->get_logged_user_role() != 1)
        {
            redirect(base_url());
        }

        $exam_request_result = $this->exam->get_exam_template_questions($exam_id);

        if (!$exam_request_result)
        {
            redirect(base_url());
        }

        $exam_data = array('exam' => $exam_request_result);

        $data = array('page_title' => 'Edit exam', 'page_description' => 'Description goes here!');

        $this->parser->parse('header', $data);
        $this->load->view('professor/edit_exam', $exam_data);
        $this->load->view('footer');
    }

    public function _remap($method, $args)
    {
        if (method_exists($this, $method))
        {
            $this->$method($args);
        } else
        {
            $this->index($method, $args);
        }
    }
}
?>
