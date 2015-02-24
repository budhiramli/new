<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_account extends CI_Controller {
    function __construct() {
        parent::__construct();
        
        $this->twiggy->title('OPSIFIN')->prepend('Group Accounts');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'Group Accounts');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'settings');
        $this->twiggy->set('LIST_TITLE', 'group accounts');
        
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
    }
    
    function index()
    {        
        $data = array();        
        
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        //$content .= $this->twiggy->template('form/filter_dp_supplier')->render();        
        $content .= $this->twiggy->template('list/group_accounts')->render();
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_user_accounts');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.user_id');
        $this->twiggy->set('FORM_LINK', site_url('settings/group_accounts/delete'));
        $this->twiggy->set('PERMISSION_LINK', site_url('settings/user_permissions/index'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $button_crud .= $this->twiggy->template('button/btn_permission')->render();
        
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $script_page = $this->twiggy->template('script/group_accounts')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function form($id='')
    {
        
        $data = array();        
        
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        //$content .= $this->twiggy->template('form/filter_dp_supplier')->render();        
        $content .= $this->twiggy->template('form/form_group_account')->render();
        // end        
        $this->twiggy->set('content_page', $content);
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $script_page = $this->twiggy->template('script/form_group_accounts')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function save()
    {
        $params = (object) $this->input->post();
        if (!empty($_POST)){
            $this->group_accounts_mdl->save($params);
        }
        redirect(site_url(), 'refresh');
    }
}    