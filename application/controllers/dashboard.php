<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - index()
 * Classes list:
 * - Dashboard extends CI_Controller
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('parser', 'form_validation'));
        $this->load->model(array('authentication', 'exam', 'user', 'menu_model'));
        $this->load->helper('form');
    }

    public function index()
    {
        // Only editable by professors
        if (!$this->authentication->is_user_logged())
        {
            redirect(base_url() . 'index.php/login');
        }

        if ($this->authentication->get_logged_user_role() != 1)
        {
            redirect(base_url());
        }

        $exam_request_result = $this->user->get_user_created_exams();

        $exam_data = array('exams' => $exam_request_result);

        $data = array('page_title' => 'Edit exam', 'page_description' => 'Description goes here!', 'menu' => $this->menu_model->menu_top());

        $this->parser->parse('header', $data);
        $this->load->view('professor/dashboard', $exam_data);
        $this->load->view('footer');
    }
}
?>
