<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_permissions extends CI_Controller {
    function __construct() {
        parent::__construct();
        $username = $this->session->userdata('username');
        if (empty($username)){
            redirect(site_url('main/index'), 'refresh');
        };
        $this->twiggy->title('OPSIFIN')->prepend('User Permission');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'User Permission');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'settings');
        $this->twiggy->set('LIST_TITLE', 'user permission');
        
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
    }
    
    function index()
    {        
        $data = array();        
        $userid     = $this->session->userdata('user_id');
        $groupid    = $this->session->userdata('group_id');
        $this->load->model('permission_mdl');
        $permission = $this->permission_mdl->getdatalist($groupid, $userid);
        $this->twiggy->set('permission', $permission);
        
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        //$content .= $this->twiggy->template('form/filter_dp_supplier')->render();        
        $content .= $this->twiggy->template('form/form_user_permissions')->render();
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_user_accounts');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.user_id');
        $this->twiggy->set('FORM_LINK', site_url('settings/group_accounts/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $button_crud .= $this->twiggy->template('button/btn_permission')->render();
        
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        //$script_page = $this->twiggy->template('script/group_accounts')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        //$this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
}    