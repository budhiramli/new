<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modeldpsupplier extends CI_Model {
	
	public function __construct(){
            parent::__construct();
            $this->load->model('logUpdate');
	}
        
        function getrecordcount()
        {
            $data = $this->db->count_all_results('dp_supplier');
            return $data;
        }
        
        function getdatalist()
        {
            $fields = array(
                'ds_transaction_id',
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
            $this->db->join('supplier', 'supplier.supplier_code=dp_supplier.supplier_code', 'left');
            $this->db->order_by('ds_transaction_id desc');
            $query = $this->db->get('dp_supplier');
            //echo $this->db->last_query();
            $nomor = 1;
            $data = array();
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'DT_RowId'              => $row->ds_transaction_id,
                    'ds_transaction_id'     => $row->ds_transaction_id,
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
            
            $fields = array(
                'ds_no'                 => trim($params->ds_no),
                'transaction_no'        => trim($params->transaction_no),
                'transaction_date'      => $params->transaction_date,
                'dept_id'               => $params->dept_id,
                'supplier_code'         => trim($params->supplier_code),
                'cp'                    => $params->cp,
                'lg_no'                 => $params->lg_no,
                'currency'              => trim($params->currency),
                'amount'                => $amount,
                'used_amount'           => $used_amount,
                'note'                  => $params->note,
            );
            
            $this->db->set($fields);
            if (!empty($params->btnsave)){
                $valid = $this->db->insert('dp_supplier');
                $id = $this->db->insert_id();
            }
            
            if (!empty($params->btnupdate)){
                $id = $params->ds_transaction_id;
                $this->db->where('ds_transaction_id', $id);
                $valid = $this->db->update('dp_supplier');
            }
            return $valid;
        }
        
        function delete($id)
        {
            // remove detail transaksi 1
            $this->db->where('ds_transaction_id', $id);
            $valid = $this->db->delete('dp_supplier_detail');
            if ($valid) {
                $this->db->where('ds_transaction_id', $id);
                $valid = $this->db->delete('dp_supplier');
            }
            return $valid;
        }
}	