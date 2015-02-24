<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modelcc extends CI_Model {
	
	public function __construct(){
            parent::__construct();
            $this->load->model('logUpdate');
	}
        
        function getrecordcount()
        {
            $data = $this->db->count_all_results('cc_transaction');
            return $data;
        }
        
        function getdatalist()
        {
            $data = array();
            $fields = array(
                'id_cc', 
                'ref_no', 
                'transaksi_no', 
                'tanggal_transaksi', 
                'id_customer', 
                'cp', 
                'nama_bank', 
                'currency',
                'amount', 
                'charges_currency', 
                'charges_amount', 
                'note',
            );
            
            $this->db->select($fields);
            $query = $this->db->get('cc_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'              => $nomor,
                    'id_cc'             => $row->id_cc,
                    'branch'            => 'nama_cabang',
                    'ref_no'            => $row->ref_no, 
                    'transaksi_no'      => $row->transaksi_no, 
                    'tanggal_transaksi' => $row->tanggal_transaksi, 
                    'customer'          => 'nama_customer', 
                    'cp'                => $row->cp, 
                    'nama_bank'         => $row->nama_bank,
                    'currency'          => $row->currency,
                    'amount'            => $row->amount, 
                    'charges_currency'  => $row->charges_currency, 
                    'charges'           => $row->charges_amount, 
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
                'id_cc', 
                'ref_no', 
                'transaksi_no', 
                'tanggal_transaksi', 
                'id_customer', 
                'cp', 
                'nama_bank', 
                'currency',
                'amount', 
                'charges_currency', 
                'charges_amount', 
                'note',
            );
            $this->db->select($fields);
            $this->db->where('id_cc', $id);
            $query = $this->db->get('cc_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'id_cc'             => $row->id_cc,
                    'branch'            => 'nama_cabang',
                    'ref_no'            => $row->ref_no, 
                    'transaksi_no'      => $row->transaksi_no, 
                    'tanggal_transaksi' => $row->tanggal_transaksi, 
                    'customer'          => 'nama_customer', 
                    'cp'                => $row->cp, 
                    'nama_bank'         => $row->nama_bank,
                    'currency'          => $row->currency,
                    'amount'            => $row->amount, 
                    'charges_currency'  => $row->charges_currency, 
                    'charges'           => $row->charges_amount, 
                    'note'              => $row->note,
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		
                $fields = array(
                    "id_cabang"         => $params->id_cabang,
                    "ref_no"            => $params->ref_no,
                    "transaksi_no"      => $params->transaksi_no,
                    "tanggal_transaksi" => $params->tanggal_transaksi,		
                    "id_customer"       => $params->id_customer,
                    "cp"                => $params->cp,
                    "nama_bank"         => $params->nama_bank,
                    "currency"          => $params->currency,                    
                    "amount"            => $params->amount,
                    "charges_currency"  => $params->currency,                    
                    "charges_amount"    => $params->amount,                    
                    "note"              => $params->note,                
                );
		
		if (!empty($params->id)) {
			$this->db->where("id_cc", $params->id);
			$valid = $this->db->update("cc_transaction");
                        
			$valid = $this->logUpdate->addLog("update", "cc_transaction", $params);
		}
		else {
			$valid = $this->db->insert('cc_transaction');
			
                        $valid = $this->logUpdate->addLog("insert", "cc_transaction", $params);
                        
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "cc_transaction", array("id_cc" => $id));	
		
		if ($valid){
			$this->db->where('id_cc', $id);
			$valid = $this->db->delete('cc_transaction');
		}
		
		return $valid;		
	}
}	