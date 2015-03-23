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
                'user_group_id',
                'last_login'
            );
            $this->db->select($fields);
            $this->db->where('user_id', $id);
            $query = $this->db->get('user');
            if ($query->num_rows>0){
                $row = $query->row();
                $status = '';
                if ($row->user_is_active == 'TRUE'){
                    $status = 'checked';
                }
                
                $data = array(
                    'user_id'               => $row->user_id,
                    'user_login'            => $row->user_login,
                    'user_name'             => $row->user_name,
                    'user_password'         => $row->user_password,                    
                    'user_is_active'        => $row->user_is_active,
                    'user_group_id'         => $row->user_group_id,
                    'status'                => $status,
                    'last_login'            => $row->last_login,
                );
            }
            return $data;
        }
        
        function save($params)
	{	
                
		$log = $this->session->all_userdata();
		$valid = false;
                $aktif = 'FALSE';
                $isactive = @$params->user_is_active;
                if ($isactive){
                    $aktif = 'TRUE';
                }   
                
                //check password first
                if ($params->user_password == $params->old_password){
                    $password = $params->user_password;
                }
                else {
                    $password = md5($params->user_password);
                }
                
                $fields = array(
                    'user_login'            => $params->user_login,
                    'user_name'             => $params->user_name,
                    'user_password'         => $password,
                    'user_group_id'         => $params->user_group_id,
                    'user_is_active'        => $aktif,
                    'updated_date'            => date('Y-m-d H:i:s'),   
                    'updated_by'            => $this->session->userdata('username'),
                );
                
		if (!empty($params->btnupdate)) {
                        
                        $this->db->set($fields);
						$this->db->where("user_id", $params->user_id);
						$valid = $this->db->update("user");
                        $valid = $this->logUpdate->addLog("update", "user", $params);
                        						
		}
		else {
                    // check first
                    $this->db->set('created_date', date('Y-m-d H:i:s'));
                    $this->db->set('created_by', $this->session->userdata('username'));                    
                    $this->db->set($fields);
                    $valid = $this->db->insert('user');

					$valid = $this->logUpdate->addLog("insert", "user", $params);
                    		
                                            
		}
		//echo $this->db->last_query();
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