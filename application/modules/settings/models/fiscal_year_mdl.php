<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fiscal_year_mdl extends CI_Model {
    
    function __construct() {
        parent::__construct();
        $this->load->model('logUpdate');
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('fiscal_year');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'fiscal_year_id',
                'fiscal_year_start',
                'fiscal_year_end',
                'fiscal_year_is_active',
            );
            
            $this->db->select($fields);            
            $query = $this->db->get('fiscal_year');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                     => $nomor,
                    'fiscal_year_id'            => $row->fiscal_year_id,
                    'fiscal_year_start'         => $row->fiscal_year_start,
                    'fiscal_year_end'           => $row->fiscal_year_end,
                    'fiscal_year_is_active'     => $row->fiscal_year_is_active,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'fiscal_year_id',
                'fiscal_year_start',
                'fiscal_year_end',
                'fiscal_year_is_active',
            );
            
            $this->db->select($fields);
            $query = $this->db->get('fiscal_year');
            $row = $query->row();
            $data = array(
                    'fiscal_year_id'            => $row->fiscal_year_id,
                    'fiscal_year_start'         => $row->fiscal_year_start,
                    'fiscal_year_end'           => $row->fiscal_year_end,
                    'fiscal_year_is_active'     => $row->fiscal_year_is_active,
            );
            return $data;
        }
        
        
        public function save($params)
	{	
		$fields = array(
                    'fiscal_year_start'         => $params->fiscal_year_start,
                    'fiscal_year_end'           => $params->fiscal_year_end,
                    //'fiscal_year_is_active'     => $params->fiscal_year_is_active,
                );
		$this->db->set($fields);
                $valid = $this->db->insert('fiscal_year');
		$valid = $this->logUpdate->addLog("insert", "user_group", $params);
		return true;		
	}
        
        function update($params, $id)
        {
            $fields = array(
                    'fiscal_year_start'         => $params->fiscal_year_start,
                    'fiscal_year_end'           => $params->fiscal_year_end,
                    //'fiscal_year_is_active'     => $params->fiscal_year_is_active,
            );            
            $this->db->set($fields);
            $this->db->where("fiscal_year_id", $id);
            $valid = $this->db->update("fiscal_year");
            $valid = $this->logUpdate->addLog("update", "user_group", $params);
            return true;
       }
        
        public function delete($id)
	{	
				
		$valid = $this->logUpdate->addLog("delete", "user_group", array("user_group_id" => $id));	
		
		if ($valid){
                    $this->db->where('fiscal_year_id', $id);
                    $valid = $this->db->delete('fiscal_year');
		}
		
		return $valid;		
	}
}    