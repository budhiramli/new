<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fiscal_year extends CI_Controller {
    function __construct() {
        parent::__construct();
        $username = $this->session->userdata('username');
        if (empty($username)){
            redirect(site_url('main/index'), 'refresh');
        };
        $this->load->library('menu');
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        
        $this->twiggy->title('OPSIFIN')->prepend('Fiscal Year');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        
        $this->twiggy->set('BREADCRUMBS_TITLE', 'Fiscal Year');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Settings');
        $this->twiggy->set('LIST_TITLE', 'Fiscal Year');
        
    }
    
    function index()
    {
        $data = array();
        // create content page fo dp supplier
        
        $content = $this->twiggy->template('breadcrumbs')->render();
        $content .= $this->twiggy->template('list/fiscal_year')->render();
        
        // end        
        $this->twiggy->set('content_page', $content);
        
        $window_page = $this->twiggy->template('window/window_currency')->render();
        $window_page .= $this->twiggy->template('window/window_dept')->render();
        $window_page .= $this->twiggy->template('window/window_vendor')->render();
        $window_page .= $this->twiggy->template('window/window_lg')->render();
        
        $this->twiggy->set('FORM_NAME', 'form_fiscal_year');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.fiscal_year_id');
        $this->twiggy->set('FORM_LINK', site_url('settings/fiscal_year/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        
        // end        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/fiscal_year')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function form($id='')
    {
        $data = array();    
        if (!empty($id)){
            $this->load->model('fiscal_year_mdl');
            $data = $this->fiscal_year_mdl->getdataid($id);
            $this->twiggy->set('edit', $data); 
        };
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        $content .= $this->twiggy->template('form/form_fiscal_year')->render();
        
        // end        
        $this->twiggy->set('content_page', $content);
        
        $window_page = $this->twiggy->template('window/window_currency')->render();
        $window_page .= $this->twiggy->template('window/window_dept')->render();
        $window_page .= $this->twiggy->template('window/window_vendor')->render();
        $window_page .= $this->twiggy->template('window/window_lg')->render();
        
        // end        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/form_fiscal_year')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function save()
    {
        $this->load->model('fiscal_year_mdl');
        $params = (object) $this->input->post();
        $this->fiscal_year_mdl->save($params);            
               
        redirect(site_url('settings/fiscal_year/index'), 'refresh');
    }
    
    function delete($id)
    {
        $this->load->model('fiscal_year_mdl');
        $this->fiscal_year_mdl->delete($id);
        redirect(site_url('settings/fiscal_year/index'), 'refresh');
    }
}    
    