<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_master_data extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    
    function currency()
    {
        //$this->db->like('currency', $currency);
        $this->db->order_by('currency asc');
        $query = $this->db->get('mst_currency');
        foreach($query->result() as $row):
            $data[] = $row->currency; 
        endforeach;
        
        echo json_encode($data);
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
    
       
    function dept()
    {
        //$this->db->like('currency', $currency);
        $this->db->order_by('dept_name asc');
        $query = $this->db->get('mst_dept');
        foreach($query->result() as $row):
            $data[] = $row->dept_name; 
        endforeach;
        
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
    
    
    function vendor()
    {
        //$this->db->like('currency', $currency);
        $this->db->order_by('supplier_name asc');
        $query = $this->db->get('supplier');
        foreach($query->result() as $row):
            $data[] = $row->supplier_code . ' ' . $row->supplier_name; 
        endforeach;
        
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
    
    
    function customer()
    {
        //$this->db->like('currency', $currency);
        $this->db->order_by('company_name asc');
        $query = $this->db->get('mst_company');
        foreach($query->result() as $row):
            $data[] = $row->company_code . ' ' . $row->company_name; 
        endforeach;
        
        echo json_encode($data);
    }
    
    function get_customer()
    {
        $this->load->model('customer_all_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->customer_all_mdl->getdatalist();
        $data['iTotalRecords']          = $this->customer_all_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->customer_all_mdl->getrecordcount();
        echo json_encode($data);
    }
}    
    
    