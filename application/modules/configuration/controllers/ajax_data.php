<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_data extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function getrecord_currency()
    {
        $this->load->model('currency_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->currency_mdl->getdatalist();
        $data['iTotalRecords']          = $this->currency_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->currency_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_coa_class()
    {
        $this->load->model('coa_class_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->coa_class_mdl->getdatalist();
        $data['iTotalRecords']          = $this->coa_class_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->coa_class_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_coa_group()
    {
        $this->load->model('coa_group_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->coa_group_mdl->getdatalist();
        $data['iTotalRecords']          = $this->coa_group_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->coa_group_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_coa_account()
    {
        $this->load->model('coa_account_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->coa_account_mdl->getdatalist();
        $data['iTotalRecords']          = $this->coa_account_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->coa_account_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_bank_account()
    {
        $this->load->model('bank_account_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->bank_account_mdl->getdatalist();
        $data['iTotalRecords']          = $this->bank_account_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->bank_account_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_supplier()
    {
        $this->load->model('supplier_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->supplier_mdl->getdatalist();
        $data['iTotalRecords']          = $this->supplier_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->supplier_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_customer()
    {
        $this->load->model('customer_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->customer_mdl->getdatalist();
        $data['iTotalRecords']          = $this->customer_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->customer_mdl->getrecordcount();
        echo json_encode($data);
    }
}
    