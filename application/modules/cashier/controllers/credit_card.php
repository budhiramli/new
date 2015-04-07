<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Credit_card extends CI_Controller {
    function __construct() {
        parent::__construct();
        $username = $this->session->userdata('username');
        if (empty($username)){
            redirect(site_url('main/index'), 'refresh');
        };
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        $this->twiggy->title('OPSIFIN')->prepend('Credit Card');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        $data = array();
        
        // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'Credit Card');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Cashier');
        $this->twiggy->set('LIST_TITLE', 'Credit Card');
        $this->load->model('modelcc');
    }
    
    function index()
    {
        $data = array();
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        //$content .= $this->twiggy->template('form/filter_dp_supplier')->render();        
        $content .= $this->twiggy->template('list/credit_card')->render();
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_credit_card');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.cc_id');
        $this->twiggy->set('FORM_LINK', site_url('cashier/credit_card/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $script_page = $this->twiggy->template('script/credit_card')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function form($id='')
    {
        $data = array();        
        if (!empty($id)){
            $this->load->model('modelcc');
            $data = $this->modelcc->getdataid($id);
            $this->twiggy->set('edit', $data); 
        };        
        
        $content = $this->twiggy->template('form/form_credit_card')->render();        
        $this->twiggy->set('content_page', $content);
        $this->twiggy->set('FORM_NAME', 'form_credit_card');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.cc_detail_id');
        $this->twiggy->set('FORM_LINK', site_url('cashier/credit_card/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $window_page = $this->twiggy->template('window/window_branch')->render();
        $window_page .= $this->twiggy->template('window/window_customer')->render();
        $window_page .= $this->twiggy->template('window/window_bank')->render();
        $window_page .= $this->twiggy->template('window/window_currency')->render();
        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/form_credit_card')->render();         
        $script_page .= $this->twiggy->template('script/script_branch')->render(); 
        $script_page .= $this->twiggy->template('script/script_customer')->render(); 
        $script_page .= $this->twiggy->template('script/script_bank')->render(); 
        $script_page .= $this->twiggy->template('script/script_currency')->render(); 
        
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
        
    function save()
    {
        $this->load->model('modelcc');
        $params = (object) $this->input->post();   
        
        $valid = $this->modelcc->save($params);
        
        if (empty($valid))
            $this->owner->alert("Please complete the form", site_url("cashier/credit_card/index"));
	else
            redirect(site_url("cashier/credit_card/index"), 'refresh');
    }   
    
    public function delete($id)
	{		
		$valid = false;
		$valid = $this->modelcc->delete($id);
		
		if ($valid)
                    redirect(site_url("cashier/credit_card/index"), 'refresh');
	}
}