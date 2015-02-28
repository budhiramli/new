<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval extends CI_Controller {
    function __construct() {
        parent::__construct();    
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        
        $this->twiggy->title('OPSIFIN')->prepend('DP To Supplier');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        
        $this->twiggy->set('BREADCRUMBS_TITLE', 'Approval PV/RV');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Accounting');
        $this->twiggy->set('LIST_TITLE', 'Approval PV/RV');
        
    }   
    
    function index()
    {
        
        $data = array();
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        //$content .= $this->twiggy->template('form/filter_dp_supplier')->render();        
        $content .= $this->twiggy->template('list/approval')->render();
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
        
        $script_page = $this->twiggy->template('script/approval')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function form()
    {
        $this->twiggy->title('OPSIFIN')->prepend('DP From Customer');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        $data = array();
        
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        $content .= $this->twiggy->template('form/form_dp_customer')->render();        
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
        $window_page .= $this->twiggy->template('window/window_vendor')->render();
        $window_page .= $this->twiggy->template('window/window_lg')->render();
        
        // end        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/form_dp_customer')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
        
    function save()
    {
        $params = (object) $this->input->post();   
        
        $valid = $this->modeldpcustomer->save($params);
        echo $this->db->last_query();
        
        die();
        if (empty($valid))
            $this->owner->alert("Please complete the form", "../index.php/cashier/dp_customer/form");
	else
            redirect("../index.php/cashier/dp_customer/form");
    }   
    
    public function delete()
	{		
		$valid = false;
		$id = $this->input->get('id');
		$valid = $this->modeldpcustomer->delete($id);
		
		if ($valid)
			redirect("../index.php/cashier/dp_customer/form");	
	}
}