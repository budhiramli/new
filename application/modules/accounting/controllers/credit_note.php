<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Credit_note extends CI_Controller {
    function __construct() {
        parent::__construct();
        $username = $this->session->userdata('username');
        if (empty($username)){
            redirect(site_url('main/index'), 'refresh');
        };
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        
        $this->twiggy->title('OPSIFIN')->prepend('Credit Note');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'Credit Note');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Accounting');
        $this->twiggy->set('LIST_TITLE', 'Credit Note');
        $this->load->model('modelcreditnote');
    }
    
    function index()
    {
        $data = array();
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        //$content .= $this->twiggy->template('form/filter_dp_supplier')->render();        
        $content .= $this->twiggy->template('list/creditnote')->render();
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_dp_customer');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.id_dp_customer');
        $this->twiggy->set('FORM_LINK', site_url('accounting/credit_note/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $script_page = $this->twiggy->template('script/creditnote')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function form($id='')
    {
        $data = array();
        if (!empty($id)){
            $this->load->model('modelcreditnote');
            $data = $this->modelcreditnote->getdataid($id);
            
            $this->twiggy->set('edit', $data); 
        };
        // create content page fo dp supplier
        $content = $this->twiggy->template('form/form_credit_note')->render();        
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_credit_note');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.cn_no');
        $this->twiggy->set('FORM_LINK', site_url('accounting/credit_note/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $window_page = $this->twiggy->template('window/window_branch')->render();
        $window_page .= $this->twiggy->template('window/window_dept')->render();
        $window_page .= $this->twiggy->template('window/window_customer')->render();
        
        // end        
        $this->twiggy->set('window_page', $window_page);        
        $script_page = $this->twiggy->template('script/form_credit_note')->render();         
        $script_page .= $this->twiggy->template('script/script_branch')->render();         
        $script_page .= $this->twiggy->template('script/script_dept')->render();         
        $script_page .= $this->twiggy->template('script/script_customer')->render();         
        
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
        
    function save()
    {
        $params = (object) $this->input->post();
        $valid = $this->modelcreditnote->save($params);
        if (empty($valid))
            $this->owner->alert("Please complete the form", site_url('accounting/credit_note/form'));
	else
            redirect(site_url('accounting/credit_note/index'), "refresh");
    }   
    
    public function delete()
	{		
		$valid = false;
		$id = $this->input->get('id');
		$valid = $this->modelcreditnote->delete($id);
		
		if ($valid)
			redirect(site_url('accounting/credit_note/index'), "refresh");	
	}
}