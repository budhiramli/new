<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelPv extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('pv_transaction');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'pv_no',
                'transaksi_no',
                'transaksi_type',
                'tanggal_transaksi',
                'due_date',
                
                'receipt_by',
                'kode_vendor',
            );
            
            $this->db->select($fields);
            $query = $this->db->get('pv_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'pv_no'                 => $row->pv_no,
                    'transaksi_no'          => $row->transaksi_no,
                    'tanggal_transaksi'     => $row->tanggal_transaksi,
                    'transaksi_type'        => $row->transaksi_type,
                    
                    'receipt_by'            => $row->receipt_by,
                    'vendor'           => $row->kode_vendor,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'id_pv', 
                'pv_no',
                'transaksi_no',
                'transaksi_type',
                'tanggal_transaksi',
                'due_date',
               
                'receipt_by',
                'id_branch',
                'kode_vendor',
            );
            $this->db->select($fields);
            $this->db->where('id_pv', $id);
            $query = $this->db->get('pv_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'id_pv'                 => $row->id_pv, 
                    'pv_no'                 => $row->pv_no,
                    'transaksi_no'          => $row->transaksi_no,
                    'tanggal_transaksi'     => $row->tanggal_transaksi,
                    'transaksi_type'        => $row->transaksi_type,
                    
                    'receipt_by'            => $row->receipt_by,
                    'kode_vendor'           => $row->kode_vendor,
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		
                $fields = array(
                    'id_pv'                 => $params->id_pv, 
                    'pv_no'                 => $params->pv_no,
                    'transaksi_no'          => $params->transaksi_no,
                    'tanggal_transaksi'     => $params->tanggal_transaksi,
                    'transaksi_type'        => $params->transaksi_type,
                    
                    'receipt_by'            => $params->receipt_by,
                    'kode_vendor'           => $params->kode_vendor,      
                );
		
		if (!empty($params->id)) {
			$this->db->where("id_cn", $params->id);
			$valid = $this->db->update("pv_transaction");
                        
			$valid = $this->logUpdate->addLog("update", "pv_transaction", $params);
		}
		else {
			$valid = $this->db->insert('pv_transaction');
			
                        $valid = $this->logUpdate->addLog("insert", "pv_transaction", $params);
                        
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "pv_transaction", array("id_dn" => $id));	
		
		if ($valid){
			$this->db->where('id_pv', $id);
			$valid = $this->db->delete('pv_transaction');
		}
		
		return $valid;		
	}
}    