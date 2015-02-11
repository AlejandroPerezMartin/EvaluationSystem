<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - index()
* - students()
* Classes list:
* - Manage extends CI_Controller
*/
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->model(array('authentication', 'exam', 'user', 'menu_model'));
    }

    public function index()
    {
        redirect(base_url());
    }

    public function students($course_id)
    {
        if (!$this->authentication->is_user_logged() || $this->authentication->get_logged_user_role() != 0)
        {
            redirect(base_url());
        }

        $users_in_course = $this->user->get_users_in_course($course_id);
        $users_not_in_course = $this->user->get_all_users_not_in_course($course_id);

        $users_data = array('users_in_course' => $users_in_course, 'users_not_in_course' => $users_not_in_course);

        $data = array('page_title' => 'Dashboard', 'page_description' => 'Description goes here!', 'menu' => $this->menu_model->menu_top());

        $this->parser->parse('header', $data);
        $this->load->view('admin/manage_students', $users_data);
        $this->load->view('footer');
    }

    public function enroll()
    {
        foreach ($this->input->post('user_id') as $key => $id) {
            $this->user->enroll_student_in_course($id, $this->input->post('course_id'));
        }
        echo "false";
    }

    public function unenroll()
    {
        foreach ($this->input->post('user_id') as $key => $id) {
            $this->user->unenroll_student_from_course($id, $this->input->post('course_id'));
        }
        echo "false";
    }

}
