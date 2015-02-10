<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - index()
 * - _remap()
 * Classes list:
 * - Delete extends CI_Controller
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Remove extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('authentication', 'exam'));
    }

    public function index($exam_id)
    {
        $this->exam->remove_exam($exam_id);

        $success_message = '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> The exam was successfully removed</div>';
        $this->session->set_flashdata('message', $success_message);

        redirect(base_url());
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
