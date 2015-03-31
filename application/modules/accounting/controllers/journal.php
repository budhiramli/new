<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Journal extends CI_Controller {
    function __construct() {
        parent::__construct();  
        $username = $this->session->userdata('username');
        if (empty($username)){
            redirect(site_url('main/index'), 'refresh');
        };
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        
        $this->twiggy->title('OPSIFIN')->prepend('DP To Supplier');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'Journal');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Accounting');
        $this->twiggy->set('LIST_TITLE', 'Journal');
    }
    
    function index()
    {
        $data = array();
        // create content page fo dp supplier
        $content = $this->twiggy->template('list/journal')->render();
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_dp_customer');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.id_dp_customer');
        $this->twiggy->set('FORM_LINK', site_url('accounting/journal/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $script_page = $this->twiggy->template('script/journal')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function form()
    {
        $data = array();        
        
        $content = $this->twiggy->template('form/form_journal')->render();
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_journal');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.id_dp_customer');
        $this->twiggy->set('FORM_LINK', site_url('accounting/journal/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $window_page = '';
        //$window_page = $this->twiggy->template('window/window_dept')->render();
        //$window_page .= $this->twiggy->template('window/window_branch')->render();
        
        // end        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/form_journal')->render();         
        //$script_page .= $this->twiggy->template('script/script_dept')->render();         
        //$script_page .= $this->twiggy->template('script/script_branch')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
        
    function save()
    {
        $this->load->model('journal_mdl');
        $params = (object) $this->input->post();   
        //print_r($params);
        $valid = $this->journal_mdl->save($params);
        //echo $this->db->last_query();
        
        if (empty($valid))
            $this->owner->alert("Please complete the form", site_url('accounting/journal/form'));
	else
            redirect(site_url("accounting/journal/form"));
        
    }   
    
    public function delete($id)
	{	
            $this->load->model('journal_mdl');
            $valid = false;
            $valid = $this->modeldpcustomer->delete($id);
		
            if ($valid)
                redirect(site_url("accounting/journal/form"));	
	}
}