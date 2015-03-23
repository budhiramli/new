<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
        
    function __construct() {
        parent::__construct();
        $this->load->model('user_mdl');
    }
    
    public function index()
    {
        if (!empty($_POST)){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data = $this->user_mdl->checklogin($username, $password);
            if ($data['valid']){
                $this->session->set_userdata($data);
                redirect(site_url('dashboard/main/index'), 'refresh');
            }
        }
        $this->twiggy->title('OPSIFIN')->prepend('Login');;
        $this->twiggy->meta('keywords', 'OPSIFin ');
        $this->twiggy->meta('description', 'OPSIFin');

        $output = $this->twiggy->template('login')->render();
        $this->output->set_output($output);
    }
    
    function logout()
    {
        $data = array(
            'valid'     => '',
            'username'      => '',
            'nama_lengkap'  => '',
            'level'         => '',
            'status'        => '',
            'user_group_id'      => '',                
        );
        $this->session->unset_userdata($data);
        redirect(site_url('main/index'), 'false');
    }
    
}