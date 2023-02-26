<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MosqueModel extends CI_Model {
    
    public function admin_register($data)
    {
        $this->db->insert('mosque_admin', $data);
        return ($this->db->affected_rows() != 1) ? 0 : 1;
    }

    public function mosque_register($mosque_id, $mosque_name, $admin_phone, $latitude, $longitude)
    {
        $query = "SELECT `admin_name`, `mobile_no` FROM `mosque_admin` WHERE `mobile_no` = '$admin_phone'";
        $result = $this->db->query($query);
        
        $data = array(
            'mosque_id' => $mosque_id,
            'mosque_name' => $mosque_name,
            'admin_phone' => $admin_phone,
            'latitude' => $latitude,
            'longitude' => $longitude
        );
        
        if($result->num_rows == 1)
        {
            $this->db->insert('mosque_registration', $data);
            return ($this->db->affected_rows() != 1) ? 0 : 1;
        }
        else
        {
            return ($this->db->affected_rows() != 1) ? 0 : 1;
        }
    }
    
    public function mosque_timings($admin_phone, $prayer_name, $prayer_time)
    {
        $get_mosque_id = "SELECT `mosque_id` FROM `mosque_registration` WHERE `admin_phone` = '$admin_phone'";
        $exec_query = $this->db->query($get_mosque_id);
        
        if($exec_query->num_rows == 1)
        {
            $mosque_id = $exec_query->result()[0]->mosque_id;
            
            $query = "UPDATE `mosque_timings` SET `$prayer_name` = '$prayer_time' WHERE `mosque_id` = '$mosque_id'";
            $result = $this->db->query($query);
            return ($this->db->affected_rows() != 1) ? 0 : 1;
        }
        else
        {
           return ($this->db->affected_rows() != 1) ? 0 : 1;
        }
    }
}

?>
