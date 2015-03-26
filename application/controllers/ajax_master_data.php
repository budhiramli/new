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
    
    
    function supplier()
    {
        //$this->db->like('currency', $currency);
        $this->db->order_by('supplier_name asc');
        $query = $this->db->get('mst_supplier');
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
    
    
    function user_group()
    {
        //$this->db->like('currency', $currency);
        $this->db->order_by('group_name asc');
        $query = $this->db->get('user_group');
        foreach($query->result() as $row):
            $data[] = $row->user_group_id . ' ' . $row->group_name; 
        endforeach;
        
        echo json_encode($data);
    }
    
    function get_user_group()
    {
        $this->load->model('user_group_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->user_group_mdl->getdatalist();
        $data['iTotalRecords']          = $this->user_group_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->user_group_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    
    function lgno()
    {
        $this->db->order_by('lg_no asc');
        $query = $this->db->get('lg');
        foreach($query->result() as $row):
            $data[] = $row->lg_no; 
        endforeach;
        
        echo json_encode($data);
    }
    
    function get_lgno()
    {
        $this->load->model('lg');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->lg_mdl->getdatalist();
        $data['iTotalRecords']          = $this->lg_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->lg_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    
    function branch()
    {
        $this->db->order_by('company_name asc');
        $query = $this->db->get('mst_company');
        foreach($query->result() as $row):
            $data[] = $row->company_code . ' ' . $row->company_name; 
        endforeach;
        
        echo json_encode($data);
    }
    
    function get_branch()
    {
        $this->load->model('branch_all_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->branch_all_mdl->getdatalist();
        $data['iTotalRecords']          = $this->branch_all_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->branch_all_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function bank()
    {
        $this->db->order_by('bank_name asc');
        $query = $this->db->get('mst_bank');
        foreach($query->result() as $row):
            $data[] = $row->bank_name; 
        endforeach;
        
        echo json_encode($data);
    }
    
    function get_bank()
    {
        $this->load->model('bank_all_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->bank_all_mdl->getdatalist();
        $data['iTotalRecords']          = $this->bank_all_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->bank_all_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    
    function class_type()
    {
        $this->db->order_by('class_type_name asc');
        $query = $this->db->get('coa_class_type');
        foreach($query->result() as $row):
            $data[] = $row->bank_name; 
        endforeach;
        
        echo json_encode($data);
    }
    
    function get_class_type()
    {
        $this->load->model('classtype_all_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->classtype_all_mdl->getdatalist();
        $data['iTotalRecords']          = $this->classtype_all_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->classtype_all_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function coa_class_group()
    {
        $this->db->order_by('coa_group_name asc');
        $query = $this->db->get('coa_class_group');
        foreach($query->result() as $row):
            $data[] = $row->coa_group_name; 
        endforeach;
        
        echo json_encode($data);
    }
    
    function get_coa_class_group()
    {
        $this->load->model('coaclassgroup_all_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->coaclassgroup_all_mdl->getdatalist();
        $data['iTotalRecords']          = $this->coaclassgroup_all_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->coaclassgroup_all_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function coa_class()
    {
        $this->db->order_by('class_name asc');
        $query = $this->db->get('coa_class');
        foreach($query->result() as $row):
            $data[] = $row->class_name; 
        endforeach;
        
        echo json_encode($data);
    }
    
    function get_coa_class()
    {
        $this->load->model('coaclass_all_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->coaclass_all_mdl->getdatalist();
        $data['iTotalRecords']          = $this->coaclass_all_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->coaclass_all_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    
    function bank_account_type()
    {
        $this->db->order_by('bank_account_type_name asc');
        $query = $this->db->get('bank_account_type');
        foreach($query->result() as $row):
            $data[] = $row->class_name; 
        endforeach;
        
        echo json_encode($data);
    }
    
    function get_bank_account_type()
    {
        $this->load->model('bank_account_type_all_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->bank_account_type_all_mdl->getdatalist();
        $data['iTotalRecords']          = $this->bank_account_type_all_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->bank_account_type_all_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    
    function account_coa()
    {
        $this->db->order_by('account_name asc');
        $query = $this->db->get('coa_account');
        foreach($query->result() as $row):
            $data[] = $row->account_name; 
        endforeach;
        
        echo json_encode($data);
    }
    
    function get_account_coa()
    {
        $this->load->model('coa_account_all_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->coa_account_all_mdl->getdatalist();
        $data['iTotalRecords']          = $this->coa_account_all_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->coa_account_all_mdl->getrecordcount();
        echo json_encode($data);
    }
    
}    
    
    