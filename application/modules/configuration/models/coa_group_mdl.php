<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class coa_group_mdl extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     function getrecordcount()
    {
            $data = $this->db->count_all_results('coa_class_group');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'a.coa_group_id', 
                'a.coa_group_name',
                'a.coa_parent_id',
                'a.class_id',
                'b.coa_group_name as coa_parent_name',
                'class_name'
            );
            
            $this->db->select($fields);
            $this->db->join('coa_class', 'coa_class.class_id=a.class_id', 'left');
            $this->db->join('coa_class_group b', 'b.coa_group_id=a.coa_parent_id', 'left');
            $this->db->order_by('coa_group_id asc');
            $query = $this->db->get('coa_class_group a');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                => $nomor,
                    'coa_group_id'         => $row->coa_group_id,
                    'coa_group_name'       => $row->coa_group_name,
                    'coa_parent_id'        => $row->coa_parent_id,
                    'coa_parent_name'        => $row->coa_parent_name,                    
                    'class_id'             => $row->class_id,
                    'class_name'             => $row->class_name,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'a.coa_group_id', 
                'a.coa_group_name',
                'a.coa_parent_id',
                'a.class_id',
                'b.coa_group_name as coa_parent_name',
                'class_name',
                'a.coa_group_is_active'
            );
            
            $this->db->select($fields);
            $this->db->join('coa_class', 'coa_class.class_id=a.class_id', 'left');
            $this->db->join('coa_class_group b', 'b.coa_group_id=a.coa_parent_id', 'left');
            
            $this->db->where('a.coa_group_id', $id);
            $query = $this->db->get('coa_class_group a');
            if ($query->num_rows() > 0){
                $row = $query->row();
                $status = '';
                if ($row->coa_group_is_active == 'TRUE'){
                    $status = 'checked="checked"';
                }
                    $data = array(
                        'coa_group_id'         => $row->coa_group_id,
                        'coa_group_name'       => $row->coa_group_name,
                        'coa_parent_id'        => $row->coa_parent_name,
                        'class_id'             => $row->class_name,
                        'status'               => $status,
                    );
            }
            return $data;
        }
        
        function add($params)
        {
            $coagroupid = $this->getcoagroupid($params->coa_parent_id);
            $coaclassid = $this->getclassid($params->class_id);
            
            $status = 'FALSE';
            if (!empty($params->coa_group_is_active)){
                $status = 'TRUE';
            }
            
            $fields = array(
                'coa_group_id'      => $params->coa_group_id, 
                'coa_group_name'    => $params->coa_group_name,
                'coa_parent_id'     => $coagroupid,
                'class_id'          => $coaclassid,
                'coa_group_is_active'     => $status
            );
            $this->db->set($fields);
            $this->db->insert('coa_class_group');
            return true;
        }
        
        function getclassid($name)
        {
            $this->db->where('UPPER(class_name)', strtoupper(trim($name)));
            $query = $this->db->get('coa_class');
            $id = '';
            if ($query->num_rows()>0){
                $row = $query->row();
                $id = $row->class_id;
            }
            return $id;
        }
        
        function getcoagroupid($name)
        {
            $this->db->where('UPPER(coa_group_name)', strtoupper(trim($name)));
            $query = $this->db->get('coa_class_group');
            $id = '';
            if ($query->num_rows()>0){
                $row = $query->row();
                $id = $row->coa_group_id;
            }
            return $id;
        }
        
        function update($params, $id)
        {
            //print_r($params);
            
            $coagroupid = $this->getcoagroupid($params->coa_parent_id);
            $coaclassid = $this->getclassid($params->class_id);
            
            $status = 'FALSE';
            if (!empty($params->coa_group_is_active)){
                $status = 'TRUE';
            }
            
            $fields = array(
                'coa_group_id'      => $params->coa_group_id, 
                'coa_group_name'    => $params->coa_group_name,
                'coa_parent_id'     => $coagroupid,
                'class_id'          => $coaclassid,
                'coa_group_is_active'     => $status
            );
            $this->db->set($fields);
            $this->db->where('coa_group_id', $id);            
            $this->db->update('coa_class_group');
            return true;
        }
        
        function delete($id)
        {
            $this->db->where('coa_group_id', $id);            
            $this->db->delete('coa_class_group');
            return true;
        }
}        