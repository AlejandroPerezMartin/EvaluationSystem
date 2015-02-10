<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - _create_menu()
* - menu_top()
* Classes list:
* - Menu_Model extends CI_Model
*/
class Menu_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model(array('authentication', 'user'));
    }
    private function _create_menu($menu, $username)
    {
        $data = array(
            'menu'     => $menu,
            'username' => $username
        );
        return $this->load->view('_links', $data, true);
    }
    public function menu_top()
    {
        $username = $this->user->get_logged_user_name();
        $menu_logged = array(
            array(
                'title'       => 'Dashboard',
                'description' => 'Go to your dashboard',
                'icon'        => 'th-large',
                'url'         => base_url()
            ),
            array(
                'title'       => 'Logout',
                'description' => 'Close this session',
                'icon'        => 'log-out',
                'url'         => base_url() . 'index.php/logout'
            )
        );
        $menu_unlogged = array(
            array(
                'title'       => 'Login',
                'description' => 'Already registered? Log into your account',
                'url'         => base_url() . 'index.php/login'
            )
        );
        return $this->_create_menu(($this->authentication->is_user_logged() == true) ? $menu_logged : $menu_unlogged, $username);
    }
}
?>
