<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dp_customer extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        
        $this->twiggy->title('OPSIFIN')->prepend('DP From Customer');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        
        // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'DP From Customer');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Cashier');
        $this->twiggy->set('LIST_TITLE', 'DP From Customer');
    }
    
    function index()
    {        
        $data = array();
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        //$content .= $this->twiggy->template('form/filter_dp_supplier')->render();        
        $content .= $this->twiggy->template('list/dp_customer')->render();
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_dp_customer');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.dc_transaction_id');
        $this->twiggy->set('FORM_LINK', site_url('cashier/dp_customer/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $script_page = $this->twiggy->template('script/dp_customer')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function form($id='')
    {
        $data = array();
        if (!empty($id)){
            $this->load->model('modeldpcustomer');
            $data = $this->modeldpcustomer->getdataid($id);
            $this->twiggy->set('edit', $data); 
        };
        
        // create content page fo dp supplier
        //$content = $this->twiggy->template('breadcrumbs')->render();
        $content = $this->twiggy->template('form/form_dp_customer')->render();        
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_dp_customer');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.id_dp_customer');
        $this->twiggy->set('FORM_LINK', site_url('cashier/dp_customer/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $window_page = $this->twiggy->template('window/window_currency')->render();
        $window_page .= $this->twiggy->template('window/window_dept')->render();
        $window_page .= $this->twiggy->template('window/window_customer')->render();
        $window_page .= $this->twiggy->template('window/window_lg')->render();
        
        // end        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/form_dp_customer')->render();         
        $script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
        
    function save()
    {
        $this->load->model('modeldpcustomer');
        $params = (object) $this->input->post();   
        $valid = $this->modeldpcustomer->save($params);
        
        if (empty($valid))
            $this->owner->alert("Please complete the form", site_url('cashier/dp_customer/form'));
	else
            redirect(site_url('cashier/dp_customer/'), "refresh");
    }   
    
    public function delete($id)
	{	
                $this->load->model('modeldpcustomer');
		$valid = false;
		$valid = $this->modeldpcustomer->delete($id);
		
		if ($valid)
			redirect(site_url("cashier/dp_customer/index"), "refresh");	
	}
}