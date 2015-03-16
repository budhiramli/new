<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_data extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function getrecord_useraccount()
    {
        $this->load->model('user_accounts_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->user_accounts_mdl->getdatalist();
        $data['iTotalRecords']          = $this->user_accounts_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->user_accounts_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_groupaccount()
    {
        $this->load->model('group_accounts_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->group_accounts_mdl->getdatalist();
        $data['iTotalRecords']          = $this->group_accounts_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->group_accounts_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_fiscal_year()
    {
        $this->load->model('fiscal_year_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->fiscal_year_mdl->getdatalist();
        $data['iTotalRecords']          = $this->fiscal_year_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->fiscal_year_mdl->getrecordcount();
        echo json_encode($data);
    }
    
}    