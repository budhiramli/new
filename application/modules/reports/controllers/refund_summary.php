<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class refund_summary extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('Authentication');
	}
	
	public function index(){		
            $this->load->library('menu');
            $menu = $this->menu->set_menu();
            $this->twiggy->set('menu_navigasi', $menu);

            $this->twiggy->title('OPSIFIN')->prepend('Login');;
            $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
            $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
            $data = array();

            $content = $this->twiggy->template('reports/refund_summary')->render();                
            $this->twiggy->set('content_page', $content);

            $output = $this->twiggy->template('dashboard')->render();
            $this->output->set_output($output);
	}
}