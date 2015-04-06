<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debit_note extends CI_Controller {
    function __construct() {
        parent::__construct();
        $username = $this->session->userdata('username');
        if (empty($username)){
            redirect(site_url('main/index'), 'refresh');
        };
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        
        $this->twiggy->title('OPSIFIN')->prepend('Debit Note');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        
        // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'Debit Note');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Accounting');
        $this->twiggy->set('LIST_TITLE', 'Debit Note');
        $this->load->model('modeldebitnote');
    }
    
    function index()
    {
        
        $data = array();
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        //$content .= $this->twiggy->template('form/filter_dp_supplier')->render();        
        $content .= $this->twiggy->template('list/debitnote')->render();
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_dp_customer');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.dn_no');
        $this->twiggy->set('FORM_LINK', site_url('accounting/debit_note/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $script_page = $this->twiggy->template('script/debitnote')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function form($id='')
    {
        $data = array();
        if (!empty($id)){
            $this->load->model('modeldebitnote');
            $data = $this->modeldn->getdataid($id);
            
            $this->twiggy->set('edit', $data); 
        };
        $content = $this->twiggy->template('form/form_debit_note')->render();        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_dp_customer');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.dn_no');
        $this->twiggy->set('FORM_LINK', site_url('accounting/debit_note/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $window_page = $this->twiggy->template('window/window_dept')->render();
        $window_page .= $this->twiggy->template('window/window_branch')->render();        
        $window_page .= $this->twiggy->template('window/window_vendor')->render();
        
        // end        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/form_debit_note')->render();
        $script_page .= $this->twiggy->template('script/script_branch')->render();                 
        $script_page .= $this->twiggy->template('script/script_dept')->render();         
        $script_page .= $this->twiggy->template('script/script_supplier')->render();         
        
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
        
    function save()
    {
        $params = (object) $this->input->post();   
        
        $valid = $this->modeldebitnote->save($params);
        echo $this->db->last_query();
        
        die();
        if (empty($valid))
            $this->owner->alert("Please complete the form", "../index.php/accounting/debit_note/form");
	else
            redirect(site_url('accounting/debit_note/index'), "refresh");
    }   
    
    public function delete()
	{		
		$valid = false;
		$id = $this->input->get('dn_no');
		$valid = $this->modeldebitnote->delete($id);
		
		if ($valid)
			redirect(site_url('accounting/debit_note/index'), "refresh");
	}
}