<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - index()
 * Classes list:
 * - Login extends CI_Controller
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('parser', 'form_validation'));
        $this->load->model(array('authentication', 'user'));
        $this->load->helper('form');
    }

    public function index()
    {

        if ($this->authentication->is_user_logged())
        {
            redirect(base_url());
        }

        $data = array('hide_menu' => true, 'hide_footer' => true, 'page_title' => 'Login', 'page_description' => 'Description goes here!', 'styles' => array('signin'));
        // Process login
        if ($this->input->post('submit_login'))
        {

            $this->form_validation->set_rules('email', 'email', 'trim|valid_email|required|min_length[3]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]|max_length[35]|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> ', '</div>');

            if ($this->form_validation->run() == true)
            {
                if ($this->authentication->process_login($this->input->post('email'), $this->input->post('password')))
                {
                    $user_role = $this->user->get_logged_user_role();
                    switch ($user_role) {
                        case '0':
                            redirect(base_url('index.php/admin'));
                            break;
                        case '1':
                            redirect(base_url('index.php/admin'));
                            break;
                        case '2':
                            redirect(base_url('index.php/admin'));
                            break;
                        default:
                            echo "There was an error loading the interface";
                            break;
                    }
                } else
                {
                    $sub_data = array('login_failed' => 'Invalid email or password');

                    $this->parser->parse('header', $data);
                    $this->load->view('login', $sub_data);
                    $this->load->view('footer');
                }
            } else
            {
                $this->parser->parse('header', $data);
                $this->load->view('login');
                $this->load->view('footer');
            }
        }
        // Show login form
        else
        {
            $this->parser->parse('header', $data);
            $this->load->view('login');
            $this->load->view('footer');
        }
    }
}
?>
