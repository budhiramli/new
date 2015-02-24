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
}
    