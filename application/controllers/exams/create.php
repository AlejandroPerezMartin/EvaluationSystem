<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - create_exam()
 * - index()
 * Classes list:
 * - Create extends CI_Controller
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Create extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('parser', 'form_validation'));
        $this->load->model(array('authentication', 'exam', 'user', 'menu_model'));
        $this->load->helper('form');
    }

    public function create_exam()
    {
        return $this->load->view('login', true);
    }

    public function index()
    {
        // If user is not a professor or its not logged, redirect him to main page
        if (!$this->authentication->is_user_logged() || $this->authentication->get_logged_user_role() != 1)
        {
            redirect(base_url());
        }

        $data = array('page_title' => 'Create exam', 'page_description' => 'Description goes here!', 'menu' => $this->menu_model->menu_top());
        $courses_data = array('user_courses' => $this->user->get_user_enrolled_courses());

        if ($this->input->post('submit_create_exam'))
        {
            $this->form_validation->set_rules('exam-name', 'Exam name', 'trim|required|min_length[5]|xss_clean');
            $this->form_validation->set_rules('user-courses', 'Course', 'trim|required|xss_clean');
            $this->form_validation->set_rules('start-date', 'Start date', 'trim|required|exact_length[10]|xss_clean');
            $this->form_validation->set_rules('due-date', 'Due date', 'trim|exact_length[10]|xss_clean');

            $exam_data = array('name' => $this->input->post('exam-name'), 'course_id' => $this->input->post('user-courses'), 'start_date' => $this->input->post('start-date'), 'due_date' => $this->input->post('due-date'), 'user_id' => $this->authentication->get_logged_user_id());

            if ($this->form_validation->run() == true)
            {
                $created_exam_id = $this->exam->create_exam($exam_data);

                if ($created_exam_id)
                {
                    $success_message = '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> The exam was successfully created</div>';
                    $this->session->set_flashdata('message', $success_message);
                    redirect(base_url() . 'index.php/exams/edit/' . $created_exam_id);
                } else
                {
                    $info = array('message' => '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> There was an error creating the exam. Please try again.</div>');
                }

                $this->parser->parse('header', $data);
                $this->load->view('professor/create_exam', $info);
                $this->load->view('footer');
            } else
            {
                $this->parser->parse('header', $data);
                $this->load->view('professor/create_exam', $courses_data);
                $this->load->view('footer');
            }
        }
        // Show login form
        else
        {
            $this->parser->parse('header', $data);
            $this->load->view('professor/create_exam', $courses_data);
            $this->load->view('footer');
        }
    }
}
?>
