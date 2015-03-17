<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_accounts_mdl extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('user_group');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'user_group_id',
                'group_name',
                
            );
            
            $this->db->select($fields);
            $query = $this->db->get('user_group');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'user_group_id'         => $row->user_group_id,
                    'group_name'            => $row->group_name,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'user_group_id',
                'group_name',
            );
            $this->db->select($fields);
            $this->db->where('user_group_id', $id);
            $query = $this->db->get('user_group');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'user_group_id'          => $row->user_group_id,
                    'group_name'             => $row->group_name,
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		print_r($params);
                $fields = array(
                    'group_name'             => $params->group_name,
                );
		$this->db->set($fields);
                $btnupdate = $params->btnupdate;
                
		if (!empty($btnupdate)) {
			$this->db->where("user_group_id", $params->user_group_id);
                	$valid = $this->db->update("user_group");                        
                	$valid = $this->logUpdate->addLog("update", "user_group", $params);
		}
		else {
			$valid = $this->db->insert('user_group');                        
		        $valid = $this->logUpdate->addLog("insert", "user_group", $params);
                }
                echo $this->db->last_query();
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "user_group", array("user_group_id" => $id));	
		
		if ($valid){
                    //delete permision first
                    $this->db->where('user_group_id', $id);
                    $this->db->delete('user_permission');
                    
                    $this->db->where('user_group_id', $id);
                    $valid = $this->db->delete('user_group');
		}
		
		return $valid;		
	}
}    