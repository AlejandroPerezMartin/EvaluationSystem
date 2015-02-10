<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - index()
 * Classes list:
 * - Logout extends CI_Controller
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'index.php/login');
    }
}
