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
                'menu_id',
                'menu_name'
            );
            
            $this->db->select($fields);
            $query = $this->db->get('menu');
            //echo $this->db->last_query();
            $nomor = 1;
            foreach($query->result() as $row):
                $menuid = $row->menu_id;
                
                $c = '';
                $r = '';
                $u = '';
                $d = '';
                
                $CRUD_C = $this->check_permission($menuid, $groupid, 'C');
                if ($CRUD_C){
                    $c = 'checked="checked"';
                } 
                
                $CRUD_R = $this->check_permission($menuid, $groupid, 'R');
                if ($CRUD_R){
                    $r = 'checked="checked"';
                }
                $CRUD_U = $this->check_permission($menuid, $groupid, 'U');
                if ($CRUD_U){
                    $u = 'checked="checked"';
                }
                $CRUD_D = $this->check_permission($menuid, $groupid, 'D');
                if ($CRUD_D){
                    $d = 'checked="checked"';
                }
                
                $apr = '';
                $pri = '';
                $ACT_APR = $this->check_permission($menuid, $groupid, 'A');
                if ($ACT_APR){
                    $apr = 'checked="checked"';
                }
                $ACT_PRI = $this->check_permission($menuid, $groupid, 'P');
                if ($ACT_PRI){
                    $pri = 'checked="checked"';
                }
                
                $data[] = array(
                    'nomor'             => $nomor,
                    'menu_id'           => $row->menu_id,
                    'menu_name'         => $row->menu_name,
                    'crud_act_c'        => $c,
                    'crud_act_r'        => $r,
                    'crud_act_u'        => $u,
                    'crud_act_d'        => $d,
                    'act_apr'        => $apr,
                    'act_pri'        => $pri,
                    
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function check_permission($menuid, $groupid, $act)
        {
            $fields = array(
                'crud_action',
                'other_action',
            );
            $this->db->select($fields);
            $this->db->where('user_group_id', $groupid);
            $this->db->where('menu_id', $menuid);
            $query = $this->db->get('user_permission');
            $row = $query->row();
            
            $valid = false;
            if (!empty($row->crud_action)){
                $crud_act = json_decode($row->crud_action);
                if (in_array($act, $crud_act)){
                    $valid = true;
                }
            }
            
            if (!empty($row->other_action)){
                $othe_act = json_decode($row->other_action);
                if (in_array($act, $othe_act)){
                    $valid = true;
                }
            }
                        
            return $valid;
        }
        
        public function save($params)
	{	
		//delete old permission
                $this->db->where('user_group_id', $params->user_group_id);
                $this->db->delete('user_permission');
                
                $log = $this->session->all_userdata();
		$valid = false;
		$groupid = $params->user_group_id;
                $crud   = $params->CRUD;
                $act = array();
                if (!empty(@$params->ACT)){
                    $act = $params->ACT;
                }               
                
                
                $query = $this->db->get('menu');
                foreach($query->result() as $row):
                   
                    $crud_action    = '';
                    if (array_key_exists($row->menu_id, $crud)){
                        $crud_action    = json_encode($crud[$row->menu_id]);
                    }
                    $other_action   = '';
                    if (array_key_exists($row->menu_id, $act)){
                        $other_action   = json_encode($act[$row->menu_id]);
                    } 
                    
                    $fields = array(
                        'user_group_id' => $groupid,
                        'menu_id'       => $row->menu_id,
                        'crud_action'   => $crud_action,
                        'other_action'  => $other_action,
                    );
                    $this->db->set($fields);
                    $this->db->insert('user_permission');
                    //echo $this->db->last_query()."<br>";
                endforeach;
               
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