<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_mdl extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function get_set()
    {
        $this->db->where('setting_id', 1);
        $query = $this->db->get('setting');
        $row = $query->row();
        //print_r($row);
        $get_data = $row->setting_data;
        $data = json_decode($get_data);
        return $data;
    }
    
    function save_set($params)
    {
        $set_data = array(
            'company_name'  => strtoupper($params->company_name),            
            'director'      => strtoupper($params->director),
            'address'       => strtoupper($params->address),
            'address2'      => strtoupper($params->address2),
            'zip_code'      => strtoupper($params->zip_code),
            'country'       => strtoupper($params->country),
            'state'         => strtoupper($params->state),
            'city'          => strtoupper($params->city),
            'phone'         => strtoupper($params->phone),
            'fax'           => strtoupper($params->fax),
            'email'         => strtoupper($params->email),
            'npwp'          => strtoupper($params->npwp)
        );
        
        $data = json_encode($set_data);
        $fields = array(
            'company_name'  => strtoupper($params->company_name),
            'setting_data'  => $data,
            'setting_created_date'  => date('Y-m-d'),
        );
        if (!empty($params->btnupdate)){
            $this->db->set($fields); 
            $this->db->where('setting_id', 1);
            $valid = $this->db->update('setting');
        }
        return $valid;
    }
    
}    
    