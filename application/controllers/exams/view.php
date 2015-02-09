<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - index()
* - _remap()
* Classes list:
* - View extends CI_Controller
*/
if (!defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('parser', 'form_validation'));
        $this->load->model(array('authentication', 'exam'));
        $this->load->helper('form');
    }

    public function index($exam_id)
    {
        if (empty($exam_id) || !$this->authentication->is_user_logged() || $this->authentication->get_logged_user_role() != 1)
        {
            redirect(base_url());
        }

        $exam_request_result = $this->exam->get_exam_template($exam_id);
        $exam_data = ($exam_request_result) ? $exam_request_result[0] : NULL;

        if ($exam_data == NULL) {
            redirect(base_url());
        }

        $data = array('page_title' => 'Create exam', 'page_description' => 'Description goes here!');

        $this->parser->parse('header', $data);
        $this->parser->parse('exam_view', get_object_vars($exam_data));
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