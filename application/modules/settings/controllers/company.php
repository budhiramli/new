<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {
    function __construct() {
        parent::__construct();
        $username = $this->session->userdata('username');
        if (empty($username)){
            redirect(site_url('main/index'), 'refresh');
        };
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        
        $this->twiggy->title('OPSIFIN')->prepend('Company');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        $this->load->model('setting_mdl');
    }
    
    function index()
    {
        $data = array();
        
         // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'Company Setting');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Configuration');
        $this->twiggy->set('LIST_TITLE', 'Company Setting');
        $data = $this->setting_mdl->get_set();
        $this->twiggy->set('edit', $data);
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        $content .= $this->twiggy->template('form/form_company')->render();
        
        // end        
        $this->twiggy->set('content_page', $content);
        
        $window_page = $this->twiggy->template('window/window_currency')->render();
        $window_page .= $this->twiggy->template('window/window_dept')->render();
        $window_page .= $this->twiggy->template('window/window_vendor')->render();
        $window_page .= $this->twiggy->template('window/window_lg')->render();
        
        // end        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/form_company')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function save()
    {
        $params = (object) $this->input->post();
        if (!empty($_POST)){
            $this->setting_mdl->save_set($params);
        }
        redirect(site_url('settings/company'), 'refresh');
    }
    
    
}    
    