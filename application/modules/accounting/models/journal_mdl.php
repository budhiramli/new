<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Journal_mdl extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function get_journalno()
        {
            $tahun = date('Y');
            //check first from counter_log
            $this->db->where('counter_code', 'journal_no');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $dsno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'journal_no');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $dsno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $dsno = 1;
                $fields = array(
                    'counter_code'  => 'journal_no',
                    'counter_year'  => $tahun,
                    'counter_no'    => $dsno,    
                );
                $this->db->set($fields);
                $this->db->insert('counter_log');
                
            }
            $pnj = strlen($dsno);
            $panjang = ($pnj*-1);
            $dsno = substr('00000', 0, $panjang) . $dsno;
            return $dsno;
        }
        
        function get_transno()
        {
            $tahun = date('Y');
            //check first from counter_log
            $this->db->where('counter_code', 'journal_transno');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $transno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'journal_transno');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $transno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $transno = 1;
                $fields = array(
                    'counter_code'  => 'journal_transno',
                    'counter_year'  => $tahun,
                    'counter_no'    => $transno,    
                );
                $this->db->set($fields);
                $this->db->insert('counter_log');                
            }
            $pnj = strlen($transno);
            $panjang = ($pnj*-1);
            $transno = substr('00000', 0, $panjang) . $transno;
            return $transno;
        }
    
    
    function save($params)
    {
        $journal_no = $this->get_journalno();
        $trans_no = $this->get_transno();
        
        $fields = array(
            'journal_no'        => $journal_no,
            'transaction_no'    => $trans_no,
            'transaction_date'  => $params->transaction_date,
            'dept_id'           => $params->dept_id,
            'journal_desc'      => $params->journal_desc,
            'amount_db'         => $params->amount_db,
            'amount_credit'     => $params->amount_cr,
            'branch_id'         => $params->branch_id
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
