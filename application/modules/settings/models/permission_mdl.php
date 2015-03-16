<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission_mdl extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('menu');
            return $data;
    }
        
    function getdatalist($groupid, $userid)
        {
            $data = array();
            $fields = array(
                'permission_id',
                'group_name',
                'menu_name'
            );
            
            $this->db->select($fields);
            $this->db->join('user_permission','user_permission.menu_id=menu.menu_id', 'left');
            $this->db->join('user_group','user_group.user_group_id=user_permission.user_group_id', 'left');            
            $this->db->where('user_permission.user_group_id', $groupid);
            $query = $this->db->get('menu');
            //echo $this->db->last_query();
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'permission_id'         => $row->permission_id,
                    'group_name'            => $row->group_name,
                    'menu_name'            => $row->menu_name,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		
                $fields = array(
                    'user_group_id'               => $params->user_group_id,
                    'user_group_name'             => $params->user_group_name,
                );
		$this->db->set($fields);
                
		if (!empty($params->id)) {
			$this->db->where("user_group_id", $params->id);
                	$valid = $this->db->update("user_group");
                	$valid = $this->logUpdate->addLog("update", "user_group", $params);
		}
		else {
			$valid = $this->db->insert('user_group');
		        $valid = $this->logUpdate->addLog("insert", "user_group", $params);
                }
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "user_group", array("user_group_id" => $id));	
		
		if ($valid){
                    $this->db->where('user_group_id', $id);
                    $valid = $this->db->delete('user_group');
		}
		
		return $valid;		
	}
}    