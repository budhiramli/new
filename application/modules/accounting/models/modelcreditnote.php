<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelCreditNote extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('cn_transaction');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'id_cn', 
                'id_branch',
                'cn_no',
                'transaksi_no',
                'tanggal_transaksi',
                'transaksi_type',
                'id_dept',
                'kode_vendor',
                'cp',
                'is_add_manual',
                'used_amount',
            );
            
            $this->db->select($fields);
            $query = $this->db->get('cn_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'              => $nomor,
                    'id_cn'                 => $row->id_cn, 
                    'branch'                => 'nama branch',
                    'cn_no'                 => $row->cn_no,
                    'transaksi_no'          => $row->transaksi_no,
                    'tanggal_transaksi'     => $row->tanggal_transaksi,
                    'transaksi_type'        => $row->transaksi_type,
                    'dept'                  => 'nama dept',
                    'customer'              => $row->kode_vendor,
                    'cp'                    => $row->cp,
                    'is_add_manual'         => $row->is_add_manual,
                    'used_amount'           => $row->used_amount
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'id_cn', 
                'id_branch',
                'cn_no',
                'transaksi_no',
                'tanggal_transaksi',
                'transaksi_type',
                'id_dept',
                'kode_vendor',
                'cp',
                'is_add_manual',
                'used_amount',
            );
            $this->db->select($fields);
            $this->db->where('id_cn', $id);
            $query = $this->db->get('cn_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'id_cn'                 => $row->id_cn, 
                    'branch'                => 'nama branch',
                    'cn_no'                 => $row->cn_no,
                    'transaksi_no'          => $row->transaksi_no,
                    'tanggal_transaksi'     => $row->tanggal_transaksi,
                    'transaksi_type'        => $row->transaksi_type,
                    'id_dept'               => $row->id_dept,
                    'kode_vendor'           => $row->kode_vendor,
                    'cp'                    => $row->cp,
                    'is_add_manual'         => $row->is_add_manual,
                    'used_amount'           => $row->used_amount
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		
                $fields = array(
                    'id_cn'                 => $params->id_cn, 
                    'branch'                => 'nama branch',
                    'cn_no'                 => $params->cn_no,
                    'transaksi_no'          => $params->transaksi_no,
                    'tanggal_transaksi'     => $params->tanggal_transaksi,
                    'transaksi_type'        => $params->transaksi_type,
                    'id_dept'               => $params->id_dept,
                    'kode_vendor'           => $params->kode_vendor,
                    'cp'                    => $params->cp,
                    'is_add_manual'         => $params->is_add_manual,
                    'used_amount'           => $params->used_amount         
                );
		
		if (!empty($params->id)) {
			$this->db->where("id_cn", $params->id);
			$valid = $this->db->update("cn_transaction");
                        
			$valid = $this->logUpdate->addLog("update", "cn_transaction", $params);
		}
		else {
			$valid = $this->db->insert('cn_transaction');
			
                        $valid = $this->logUpdate->addLog("insert", "cn_transaction", $params);
                        
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "dn_transaction", array("id_dn" => $id));	
		
		if ($valid){
			$this->db->where('id_dn', $id);
			$valid = $this->db->delete('dn_transaction');
		}
		
		return $valid;		
	}
    
    
}    