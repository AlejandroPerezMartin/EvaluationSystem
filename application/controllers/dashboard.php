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
        $this->load->model(array('authentication', 'user', 'course', 'menu_model'));
        $this->load->helper('form');
    }

    public function index()
    {
        // Only editable by professors
        if (!$this->authentication->is_user_logged())
        {
            redirect(base_url() . 'index.php/login');
        }

        // User is professor
        if ($this->authentication->get_logged_user_role() == 1)
        {
            $professor_created_exams = $this->user->get_user_created_exams();

            $courses_data = array('exams' => $professor_created_exams);

            $data = array('page_title' => 'Dashboard', 'page_description' => 'Description goes here!', 'menu' => $this->menu_model->menu_top());

            $this->parser->parse('header', $data);
            $this->load->view('professor/dashboard', $courses_data);
            $this->load->view('footer');
        }
        // User is admin
        else if ($this->authentication->get_logged_user_role() == 0)
        {
            $all_courses = $this->course->get_all_courses();

            $courses_data = array('courses' => $all_courses);

            $data = array('page_title' => 'Dashboard', 'page_description' => 'Description goes here!', 'menu' => $this->menu_model->menu_top());

            $this->parser->parse('header', $data);
            $this->load->view('admin/dashboard', $courses_data);
            $this->load->view('footer');
        }
        else
        {
            redirect(base_url());
        }

    }
}
?>
