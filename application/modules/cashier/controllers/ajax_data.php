<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_data extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    
    
    function getrecord_dpsupplier()
    {
        $this->load->model('modeldpsupplier');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->modeldpsupplier->getdatalist();
        $data['iTotalRecords']          = $this->modeldpsupplier->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->modeldpsupplier->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_dpsupplier_detail($id="")
    {
        $this->load->model('modeldpsupplierdetail');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => 0,
            'iTotalDisplayRecords'  => 0,
        );        
        //find total record 
        if (!empty($id)){
            $data['aaData']                 = $this->modeldpsupplierdetail->getdatalist($id);
            $data['iTotalRecords']          = $this->modeldpsupplierdetail->getrecordcount($id);
            $data['iTotalDisplayRecords']   = $this->modeldpsupplierdetail->getrecordcount($id);
        }
        echo json_encode($data);
    }
    
    function getrecord_dpcustomer()
    {
        $this->load->model('modeldpcustomer');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->modeldpcustomer->getdatalist();
        $data['iTotalRecords']          = $this->modeldpcustomer->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->modeldpcustomer->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_dpcustomer_detail($id="")
    {
        $this->load->model('modeldpcustomerdetail');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => 0,
            'iTotalDisplayRecords'  => 0,
        );        
        //find total record 
        if (!empty($id)){
            $data['aaData']                 = $this->modeldpcustomerdetail->getdatalist($id);
            $data['iTotalRecords']          = $this->modeldpcustomerdetail->getrecordcount($id);
            $data['iTotalDisplayRecords']   = $this->modeldpcustomerdetail->getrecordcount($id);
        }
        echo json_encode($data);
    }
    
    function getrecord_creditcard()
    {
        $this->load->model('modelcc');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->modelcc->getdatalist();
        $data['iTotalRecords']          = $this->modelcc->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->modelcc->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_creditcard_detail($id="")
    {
        $this->load->model('modelccdetail');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => 0,
            'iTotalDisplayRecords'  => 0,
        );        
        //find total record 
        if (!empty($id)){
            $data['aaData']                 = $this->modelccdetail->getdatalist($id);
            $data['iTotalRecords']          = $this->modelccdetail->getrecordcount($id);
            $data['iTotalDisplayRecords']   = $this->modelccdetail->getrecordcount($id);
        }
        echo json_encode($data);
    }
    
    function getrecord_cheque()
    {
        $this->load->model('modelcheque');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->modelcheque->getdatalist();
        $data['iTotalRecords']          = $this->modelcheque->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->modelcheque->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_cheque_detail($id="")
    {
        $this->load->model('modelchequedetail');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => 0,
            'iTotalDisplayRecords'  => 0,
        );        
        //find total record 
        if (!empty($id)){
            $data['aaData']                 = $this->modelchequedetail->getdatalist($id);
            $data['iTotalRecords']          = $this->modelchequedetail->getrecordcount($id);
            $data['iTotalDisplayRecords']   = $this->modelchequedetail->getrecordcount($id);
        }
        echo json_encode($data);
    }
}    