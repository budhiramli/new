<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_master_data extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function get_currency()
    {
        $this->load->model('currency_all_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->currency_all_mdl->getdatalist();
        $data['iTotalRecords']          = $this->currency_all_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->currency_all_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function get_dept()
    {
        $this->load->model('dept_all_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->dept_all_mdl->getdatalist();
        $data['iTotalRecords']          = $this->dept_all_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->dept_all_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function get_supplier()
    {
        $this->load->model('supplier_all_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->supplier_all_mdl->getdatalist();
        $data['iTotalRecords']          = $this->supplier_all_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->supplier_all_mdl->getrecordcount();
        echo json_encode($data);
    }
}    
    
    