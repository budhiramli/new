<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dp_supplier extends CI_Controller {
    function __construct() {
        parent::__construct(); 
        $username = $this->session->userdata('username');
            
        if (empty($username)){
                redirect(site_url('main/index'), 'refresh');
        }      
        
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        
        $this->twiggy->title('OPSIFIN')->prepend('DP To Supplier');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        
        // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'DP To Supplier');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Cashier');
        $this->twiggy->set('LIST_TITLE', 'DP To Supplier');
    }   
    
    function index()
    {
        $data = array();
        
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        //$content .= $this->twiggy->template('form/filter_dp_supplier')->render();        
        $content .= $this->twiggy->template('list/dp_supplier')->render();
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_dp_supplier');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.ds_transaction_id');
        $this->twiggy->set('FORM_LINK', site_url('cashier/dp_supplier/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $script_page = $this->twiggy->template('script/dp_supplier')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function form($id='')
    {
        if (!empty($id)){
            $this->load->model('modeldpsupplier');
            $data = $this->modeldpsupplier->getdataid($id);
            $this->twiggy->set('edit', $data); 
        };
        
        $data = array();
        
        // create content page fo dp supplier
        //$content = $this->twiggy->template('breadcrumbs')->render();
        $content = $this->twiggy->template('form/form_dp_supplier')->render();        
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_dp_supplier');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.id_dp_supplier');
        $this->twiggy->set('FORM_LINK', site_url('cashier/dp_supplier/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $window_page = $this->twiggy->template('window/window_currency')->render();
        $window_page .= $this->twiggy->template('window/window_dept')->render();
        $window_page .= $this->twiggy->template('window/window_vendor')->render();
        $window_page .= $this->twiggy->template('window/window_lg')->render();
        
        // end        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/form_dp_supplier')->render();         
        $script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function save()
    {
        $this->load->model('modeldpsupplier');
        $this->load->model('modeldpsupplierdetail');
        $params = (object) $this->input->post();
        $valid = $this->modeldpsupplier->save($params);	       
        //print_r($params);
        //echo $this->db->last_query();
        redirect(site_url('cashier/dp_supplier/index'), 'refresh');
    }   
    
    public function delete($id)
    {	
        //echo 'test';
        $this->load->model('modeldpsupplier');
        $this->load->model('modeldpsupplierdetail');
	$valid = false;
	
	$valid = $this->modeldpsupplier->delete($id);
	//echo $this->db->last_query();	
	if ($valid)
            redirect(site_url('cashier/dp_supplier/index'), "refresh");	
    }
        
    public function delete_detail()
	{	
            $this->load->model('modeldpsupplier');
            $this->load->model('modeldpsupplierdetail');
        
		$valid = false;
		$id = $this->input->get('id');                
                $detail = $this->input->get('detail');
                
		$valid = $this->modeldpsupplierdetail->delete_detail($id, $detail);
		
		if ($valid)
			redirect("../index.php/cashier/dp_supplier/form/?id=$id");	
	}    
}