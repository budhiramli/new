<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coa_class extends CI_Controller {
    function __construct() {
        parent::__construct();   
        $username = $this->session->userdata('username');
        if (empty($username)){
            redirect(site_url('main/index'), 'refresh');
        };
        $this->load->library('menu');
        
        $menu = $this->menu->set_menu();
        $this->twiggy->set('menu_navigasi', $menu);
        
        $this->twiggy->title('OPSIFIN')->prepend('COA Class');;
        $this->twiggy->meta('keywords', 'twiggy, twig, template, layout, codeigniter');
        $this->twiggy->meta('description', 'Twiggy is an implementation of Twig template engine for CI');
        
         // create content page fo dp supplier
        $this->twiggy->set('BREADCRUMBS_TITLE', 'COA Class');
        $this->twiggy->set('BREADCRUMBS_MAIN_TITLE', 'Configuration');
        $this->twiggy->set('LIST_TITLE', 'COA Class');
        
    }
    
    function index()
    {
        $data = array();
        
        // create content page fo dp supplier
        $content = $this->twiggy->template('breadcrumbs')->render();
        $content .= $this->twiggy->template('list/coa_class')->render();
        
        // end        
        $this->twiggy->set('content_page', $content);
        
        $this->twiggy->set('FORM_NAME', 'form_coa_class');
        $this->twiggy->set('FORM_EDIT_IDKEY', 'data-edit-id');
        $this->twiggy->set('FORM_DELETE_IDKEY', 'data-delete-id');        
        $this->twiggy->set('FORM_IDKEY', 'full.class_id');
        $this->twiggy->set('FORM_LINK', site_url('settings/coa_class/delete'));
        
        $button_crud = $this->twiggy->template('button/btn_edit')->render();         
        $button_crud .= $this->twiggy->template('button/btn_del')->render();
        $this->twiggy->set('BUTTON_CRUD', $button_crud);
        
        $window_page = $this->twiggy->template('window/window_class_type')->render();
        
        // end        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/coa_class')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function form($id='')
    {
        $data = array();
        
        if (!empty($id)){
            $this->load->model('coa_class_mdl');
            $data = $this->coa_class_mdl->getdataid($id);
            $this->twiggy->set('edit', $data); 
        };
        
        
        // create content page fo dp supplier
        $content = $this->twiggy->template('form/form_coa_class')->render();
        
        // end        
        $this->twiggy->set('content_page', $content);
        
        $window_page = $this->twiggy->template('window/window_class_type')->render();
        // end        
        $this->twiggy->set('window_page', $window_page);
        
        $script_page = $this->twiggy->template('script/form_coa_class')->render();         
        //$script_page .= $this->twiggy->template('script/script_all')->render();         
        
        $this->twiggy->set('SCRIPTS', $script_page);
        $output = $this->twiggy->template('dashboard')->render();
        $this->output->set_output($output);
    }
    
    function save()
    {
        $this->load->model('coa_class_mdl');
        $params = (object) $this->input->post();
        
        $btnsave = $this->input->post('btnsave');
        if (!empty($btnsave)){
            $this->coa_class_mdl->add($params);
        }
        
        $btnedit = $this->input->post('btnedit');
        if (!empty($btnedit)){
            $id = $this->input->post('class_id');
            $this->coa_class_mdl->update($params, $id);
        }
        //echo $this->db->last_query();
        redirect(site_url('configuration/coa_class/index'), 'refresh');
    }
    
    function delete($id)
    {
        $this->load->model('coa_class_mdl');
        $this->coa_class_mdl->del($id);
        redirect(site_url('configuration/coa_class/index'), 'refresh');
    }
}    