<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_accounts_mdl extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('user');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'user_id',
                'user_login',
                'user_password',
                'user_name',
                'group_name',
                'user_is_active',
                'last_login'
            );
            
            $this->db->select($fields);
            $this->db->join('user_group', 'user_group.user_group_id=user.user_group_id', 'left');
            $query = $this->db->get('user');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'user_id'               => $row->user_id,
                    'user_login'            => $row->user_login,
                    'user_name'             => $row->user_name,
                    'group_name'            => $row->group_name,
                    'status'                => $row->user_is_active,
                    'last_login'            => $row->last_login,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'user_id',
                'user_login',
                'user_password',
                'user_name',
                'user_is_active',
                'last_login'
            );
            $this->db->select($fields);
            $this->db->where('id_pv', $id);
            $query = $this->db->get('pv_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'user_id'               => $row->user_id,
                    'user_login'            => $row->user_login,
                    'user_name'             => $row->user_name,
                    'status'                => $row->user_is_active,
                    'last_login'            => $row->last_login,
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		
                $fields = array(
                    'user_id'               => $params->user_id,
                    'user_login'            => $params->user_login,
                    'user_name'             => $params->user_name,
                    'status'                => $params->user_is_active,
                    'last_login'            => $params->last_login,   
                );
		
		if (!empty($params->id)) {
			$this->db->where("user_id", $params->id);
			$valid = $this->db->update("user");
                        
			$valid = $this->logUpdate->addLog("update", "user", $params);
		}
		else {
			$valid = $this->db->insert('user');
			
                        $valid = $this->logUpdate->addLog("insert", "user", $params);
                        
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "user", array("user_id" => $id));	
		
		if ($valid){
			$this->db->where('user_id', $id);
			$valid = $this->db->delete('user');
		}
		
		return $valid;		
	}
}    