<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_data extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    
    function getrecord_journal_detail()
    {
        $this->load->model('journal_detail_mdl');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->journal_detail_mdl->getdatalist();
        $data['iTotalRecords']          = $this->journal_detail_mdl->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->journal_detail_mdl->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_pv()
    {
        $this->load->model('modelpv');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->modelpv->getdatalist();
        $data['iTotalRecords']          = $this->modelpv->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->modelpv->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_rv()
    {
        $this->load->model('modelrv');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->modelrv->getdatalist();
        $data['iTotalRecords']          = $this->modelrv->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->modelrv->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_refund()
    {
        $this->load->model('modelrefund');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->modelrefund->getdatalist();
        $data['iTotalRecords']          = $this->modelrefund->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->modelrefund->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_debitnote()
    {
        $this->load->model('modeldebitnote');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->modeldebitnote->getdatalist();
        $data['iTotalRecords']          = $this->modeldebitnote->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->modeldebitnote->getrecordcount();
        echo json_encode($data);
    }
    
    function getrecord_creditnote()
    {
        $this->load->model('modelcreditnote');
        $data = array(
            'aaData'                => array(),
            'sEcho'                 => 0,
            'iTotalRecords'         => '',
            'iTotalDisplayRecords'  => '',
        );        
        //find total record 
        $data['aaData']                 = $this->modelcreditnote->getdatalist();
        $data['iTotalRecords']          = $this->modelcreditnote->getrecordcount();
        $data['iTotalDisplayRecords']   = $this->modelcreditnote->getrecordcount();
        echo json_encode($data);
    }
}    