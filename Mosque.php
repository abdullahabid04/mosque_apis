<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Mosque extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MosqueModel', 'mm');
    }

	public function index()
	{
		$this->load->view('welcome_message');
	}

    public function registeradmin($admin_name, $mobile_no, $password)
	{
		$data = array(
            'admin_name' => $admin_name,
            'mobile_no' => $mobile_no,
            'password' => $password
        );
        
        $response = $this->mm->admin_register($data);
        
        if($response)
        {
            $json_response = array(
                'status' => $response,
                'message' => 'Registration Successful'
            );
        }
        else
        {
            $json_response = array(
                'status' => $response,
                'message' => 'Mosque admin already exists'
            );
        }
        
        echo json_encode($json_response);
	}

    public function registermosque($mosque_name, $admin_phone, $latitude, $longitude)
    {
        $mosque_id = $mosque_name . '-' . $admin_phone;
        $response = $this->mm->mosque_register($mosque_id, $mosque_name, $admin_phone, $latitude, $longitude);
            
        if($response)
        {
            $json_response = array(
                'status' => $response,
                'message' => 'Registration Successful'
            );
        }
        else
        {
            $json_response = array(
                'status' => $response,
                'message' => 'Mosque already exists'
            );
        }

        echo json_encode($json_response);
    }
    
    public function settimings($admin_phone, $prayer_name, $prayer_time)
    {
        $response = $this->mm->mosque_timings($admin_phone, $prayer_name, $prayer_time);
            
        if($response)
        {
            $json_response = array(
                'status' => $response,
                'message' => 'Timing successfully set'
            );
        }
        else
        {
            $json_response = array(
                'status' => $response,
                'message' => 'Something went wrong'
            );
        }

        echo json_encode($json_response);
    }
}

?>
