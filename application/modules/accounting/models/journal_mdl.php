<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Journal_mdl extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function save($params)
    {
        $fields = array(
            'journal_no'        => $params->journal_no,
            //'transaction_no'    => $params->transaction_no,
            //'transaction_date'  => $params->transaction_date,
            //'dept_id'           => $params->dept_id,
            //'journal_desc'      => $params->journal_desc,
            //'amount_db'         => $params->amount_db,
            //'amount_credit'     => $params->amount_cr,
            //'branch_id'         => $params->branch_id
        );
        $this->db->set($fields);
        if (!empty($params->btnsave)){
            $this->db->insert('journal_transaction');
        }
        
        
        if (!empty($params->btnedit)){
            $this->db->where('journal_no', $params->journal_no);
            $this->db->insert('journal_transaction');
        }
        return true;
    }
    
    
}    
