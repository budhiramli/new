<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coa extends CI_Controller {
    function __construct() {
        parent::__construct();   
        
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        
        $this->twiggy->title('OPSIFIN')->prepend('COA');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
    }
    
    function index()
    {
        
        $data = array();
        
         // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'COA Setting');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Configuration');
        $this->twiggy->set('LIST_TITLE', 'COA Setting');
        
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        $content .= $this->twiggy->template('content/coa')->render();
        
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
    
}   