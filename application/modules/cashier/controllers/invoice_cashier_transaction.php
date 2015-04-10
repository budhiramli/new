<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_cashier_transaction extends CI_Controller {
    function __construct() {
        parent::__construct();
        $username = $this->session->userdata('username');
        if (empty($username)){
            redirect(site_url('main/index'), 'refresh');
        };
	        
        $this->twiggy->title('OPSIFIN')->prepend('Invoice Cashier Transaction');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        
        // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'Invoice Cashier Transaction');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Cashier');
        $this->twiggy->set('LIST_TITLE', 'Invoice Cashier Transaction');
        
        
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        $this->load->model('modelinvcashiertrans');
    }
    
    function index()
    {
        
       $data = array();
        
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        //$content .= $this->twiggy->template('form/filter_dp_supplier')->render();        
        $content .= $this->twiggy->template('list/invoice_cashier_transaction')->render();
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_invoice_cashier_transaction');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.transfer_no');
        $this->twiggy->set('FORM_LINK', site_url('cashier/invoice_cashier_transaction/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $script_page = $this->twiggy->template('script/invoice_cashier_transaction')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function form()
    {
        $data = array();
        
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        $content .= $this->twiggy->template('form/form_invoice_cashier_transaction')->render();        
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_transfer');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.transfer_detail_id');
        $this->twiggy->set('FORM_LINK', site_url('cashier/invoice_cashier_transaction/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $window_page = $this->twiggy->template('window/window_customer')->render();
        $window_page .= $this->twiggy->template('window/window_branch')->render();
        
        // end        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/form_invoice_cashier_transaction')->render();         
        $script_page .= $this->twiggy->template('script/script_customer')->render();         
        $script_page .= $this->twiggy->template('script/script_branch')->render();         
        
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
        
    function save()
    {
        $params = (object) $this->input->post();   
        
        $valid = $this->modelinvcashiertrans->save($params);

        if (empty($valid))
            $this->owner->alert("Please complete the form", site_url('cashier/invoice_cashier_transaction/index'));
	else
            redirect(site_url('cashier/invoice_cashier_transaction/index'), "refresh");
    }   
    
    public function delete($id)
	{		
		$valid = false;
		$valid = $this->modelinvcashiertrans->delete($id);
		
		if ($valid)
			redirect(site_url('cashier/invoice_cashier_transaction/index'), "refresh");	
	}
}