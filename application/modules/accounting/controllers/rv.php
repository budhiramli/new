<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rv extends CI_Controller {
    function __construct() {
        parent::__construct();  
        $username = $this->session->userdata('username');
        if (empty($username)){
            redirect(site_url('main/index'), 'refresh');
        };
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        
        $this->twiggy->title('OPSIFIN')->prepend('Receipt Voucher');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        
        // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'Receipt Voucher');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Accounting');
        $this->twiggy->set('LIST_TITLE', 'Receipt Voucher');
        $this->load->model('modelrv');
        
    }
    
    function index()
    {
        $data = array();
        
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        //$content .= $this->twiggy->template('form/filter_dp_supplier')->render();        
        $content .= $this->twiggy->template('list/rv')->render();
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_rv');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.rv_no');
        $this->twiggy->set('FORM_LINK', site_url('accounting/rv/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $script_page = $this->twiggy->template('script/rv')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function form($id='')
    {
        $data = array();
        if (!empty($id)){
            $this->load->model('modelrv');
            $data = $this->modelrv->getdataid($id);
            
            $this->twiggy->set('edit', $data); 
        };
        // create content page fo dp supplier
        $content = $this->twiggy->template('form/form_rv')->render();        
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_rv');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.rv_detail_id');
        $this->twiggy->set('FORM_LINK', site_url('accounting/rv/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $window_page = $this->twiggy->template('window/window_dept')->render();
        $window_page .= $this->twiggy->template('window/window_branch')->render();
        
        // end        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/form_rv')->render();         
        $script_page .= $this->twiggy->template('script/script_dept')->render();
        $script_page .= $this->twiggy->template('script/script_branch')->render();
        
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
        
    function save()
    {
        $params = (object) $this->input->post();   
        
        $valid = $this->modelrv->save($params);
        echo $this->db->last_query();
        
        if (empty($valid))
            $this->owner->alert("Please complete the form", site_url('accounting/rv/index'));
	else
            redirect(site_url('accounting/rv/index'), 'refresh');
    }   
    
    public function delete($id)
	{		
		$valid = false;
		$valid = $this->modelrv->delete($id);
		
		if ($valid)
			redirect(site_url('accounting/rv/index'), 'refresh');	
	}
}