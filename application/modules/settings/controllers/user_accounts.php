<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_accounts extends CI_Controller {
    function __construct() {
        parent::__construct();
        $username = $this->session->userdata('username');
        if (empty($username)){
            redirect(site_url('main/index'), 'refresh');
        };
        $this->twiggy->title('OPSIFIN')->prepend('User Accounts');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'User Accounts');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'settings');
        $this->twiggy->set('LIST_TITLE', 'user accounts');
        
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        $this->load->model('user_accounts_mdl');
    }
    
    function index()
    {        
        $data = array();        
        
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        //$content .= $this->twiggy->template('form/filter_dp_supplier')->render();        
        $content .= $this->twiggy->template('list/user_accounts')->render();
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_user_accounts');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.user_id');
        $this->twiggy->set('FORM_LINK', site_url('settings/user_accounts/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $script_page = $this->twiggy->template('script/user_accounts')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
        $this->load->model('user_accounts_mdl');
    }
    
    function form($id='')
    {
        $data = array(); 
        if (!empty($id)){
            $this->load->model('user_accounts_mdl');
            $data = $this->user_accounts_mdl->getdataid($id);
            $this->twiggy->set('edit', $data); 
        };
        
        $content = $this->twiggy->template('form/form_user_account')->render();
        $this->twiggy->set('content_page', $content);
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $window_page = $this->twiggy->template('window/window_user_group')->render();      
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/form_user_accounts')->render();         
        $script_page .= $this->twiggy->template('script/script_user_group')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function save()
    {
        $params = (object) $this->input->post();
        if (!empty($_POST)){
            $this->user_accounts_mdl->save($params);        }
        
        redirect(site_url('settings/user_accounts/index'), 'refresh');
    }
    
    function delete($id)
    {
        //echo 'test';
	$valid = false;
	$valid = $this->user_accounts_mdl->delete($id);
	//echo $this->db->last_query();	
	if ($valid)
            redirect(site_url('settings/user_accounts/index'), "refresh");	
    }
}    