<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modeldpsupplier extends CI_Model {
	
	public function __construct(){
            parent::__construct();
            $this->load->model('logUpdate');
	}
        
        function get_dsno()
        {
            $tahun = date('Y');
            //check first from counter_log
            $this->db->where('counter_code', 'dp_supplier');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $dsno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'dp_supplier');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $dsno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $dsno = 1;
                $fields = array(
                    'counter_code'  => 'dp_supplier',
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
            $this->db->where('counter_code', 'dp_transno');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $transno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'dp_transno');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $transno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $transno = 1;
                $fields = array(
                    'counter_code'  => 'dp_transno',
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
        
        function getrecordcount()
        {
            $data = $this->db->count_all_results('dp_supplier');
            return $data;
        }
        
        function getdatalist()
        {
            $fields = array(
                'ds_no',
                'transaction_no',
                "(DATE_FORMAT(transaction_date, '%d-%m-%Y')) as transaction_date",
                'dp_supplier.supplier_code',
                'supplier_name',
                'cp',
                'lg_no',
                'currency',
                '(FORMAT(amount, 2)) as amount',
                'note',
            );
            $this->db->select($fields);
            $this->db->join('mst_supplier', 'mst_supplier.supplier_code=dp_supplier.supplier_code', 'left');
            $this->db->order_by('ds_no desc');
            $query = $this->db->get('dp_supplier');
            //echo $this->db->last_query();
            $nomor = 1;
            $data = array();
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'DT_RowId'              => $row->ds_no,
                    'ds_no'                 => $row->ds_no,
                    'transaction_no'        => $row->transaction_no,
                    'transaction_date'      => $row->transaction_date,
                    'supplier_code'         => $row->supplier_name,
                    'cp'                    => $row->cp,
                    'lg_no'             => $row->lg_no,
                    'currency'            => $row->currency,                    
                    'amount'            => $row->amount,
                    'note'              => $row->note,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'ds_transaction_id',
                'ds_no',
                'dept_id',
                'transaction_no',
                'transaction_date',
                'supplier_code',
                'cp',
                'lg_no',
                'currency',
                'amount',
                'note',
            );
            $this->db->select($fields);
            $this->db->where('ds_transaction_id', $id);
            $query = $this->db->get('dp_supplier');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'ds_transaction_id'     => $row->ds_transaction_id,
                    'ds_no'                 => $row->ds_no,
                    'dept_id'               => $row->dept_id,
                    'transaction_no'        => $row->transaction_no,
                    'transaction_date'      => $row->transaction_date,
                    'supplier_code'         => $row->supplier_code,
                    'cp'                    => $row->cp,
                    'lg_no'                 => $row->lg_no,
                    'currency'              => $row->currency,                    
                    'amount'                => $row->amount,
                    'note'                  => $row->note,
                );
            }
            return $data;
        }
        
        function save($params)
        {
            $valid = true;
            $amount = str_replace(',','', $params->amount);            
            $used_amount = str_replace(',','', $params->used_amount);
            $supplier_code = explode(' ',trim($params->supplier_code));
            $fields = array(
                'transaction_date'      => date('Y-m-d', strtotime($params->transaction_date)),
                'dept_id'               => $params->dept_id,
                'supplier_code'         => $supplier_code[0],
                'cp'                    => strtoupper($params->cp),
                'lg_no'                 => strtoupper($params->lg_no),
                'currency'              => trim($params->currency),
                'amount'                => $amount,
                'used_amount'           => $used_amount,
                'note'                  => strtoupper(strip_tags($params->note)),
            );
            
            if (!empty($params->btnsave)){
                $fields['ds_no']            = $this->get_dsno();
                $fields['transaction_no']   = $this->get_transno();
                
                $this->db->set($fields);            
                $valid = $this->db->insert('dp_supplier');
                $id = $this->db->insert_id();
            }
            
            if (!empty($params->btnupdate)){
                $this->db->set($fields);            
                $id = $params->ds_transaction_id;
                $this->db->where('ds_transaction_id', $id);
                $valid = $this->db->update('dp_supplier');
            }
            return $valid;
        }
        
        function delete($id)
        {
            // remove detail transaksi 1
            $this->db->where('ds_no', $id);
            $valid = $this->db->delete('dp_supplier_detail');
            if ($valid) {
                $this->db->where('ds_no', $id);
                $valid = $this->db->delete('dp_supplier');
            }
            return $valid;
        }
}	