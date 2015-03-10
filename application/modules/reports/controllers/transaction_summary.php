<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class transaction_summary extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('Authentication');
	}
	
	public function index(){		
            $this->load->library('menu');
            $menu = $this->menu->set_menu();
            $this->twiggy->set('menu_navigasi', $menu);
            $this->twiggy->set('BREADCRUMBS_TITLE', 'DP To Supplier');
            $this->twiggy->title('OPSIFIN')->prepend('Login');;
            $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
            $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
            $data = array();
            
            $window_page = $this->twiggy->template('window/window_branch')->render();
            $window_page .= $this->twiggy->template('window/window_user')->render();

            // end        
            $this->twiggy->set('window_page', $window_page);

            $content = $this->twiggy->template('reports/transaction_summary')->render();                
            $this->twiggy->set('content_page', $content);
            
            $script_page = $this->twiggy->template('script/transaction_summary')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);

            $output = $this->twiggy->template('dashboard')->render();
            $this->output->set_output($output);
	}
        
        public function home(){		
            $this->load->library('menu');
            $menu = $this->menu->set_menu();
            $this->twiggy->set('menu_navigasi', $menu);
            $this->twiggy->set('BREADCRUMBS_TITLE', 'DP To Supplier');
            $this->twiggy->title('OPSIFIN')->prepend('Login');;
            $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
            $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
            $data = array();
            
            $window_page = $this->twiggy->template('window/window_branch')->render();
            $window_page .= $this->twiggy->template('window/window_user')->render();

            // end        
            $this->twiggy->set('window_page', $window_page);

            $content = $this->twiggy->template('list/transaction_summary')->render();                
            $this->twiggy->set('content_page', $content);
            
            $script_page = $this->twiggy->template('script/transaction_summary')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);

            $output = $this->twiggy->template('dashboard')->render();
            $this->output->set_output($output);
	}
}