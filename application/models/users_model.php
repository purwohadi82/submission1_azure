<?php

class Users_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($user_name, $password)
	{
		$this->db->where('username', $user_name);
		$this->db->where('password', $password);
		$query = $this->db->get('tb_petugas');
		
		if($query->num_rows == 1)
		{
			return true;
		}		
	}
	
	/**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return array
    */
	function data_petugas($user_name, $password)
	{
		$this->db->where('username', $user_name);
		$this->db->where('password', $password);
		$query = $this->db->get('tb_petugas');
		
		return $query->row();		
	}

    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('tb_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		    $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}
	
    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	function create_petugas()
	{

		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get('tb_petugas');

        if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Username already taken";	
			echo '</strong></div>';
		}else{

			$new_member_insert_data = array(
				'ktp' => $this->input->post('ktp'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'telp' => $this->input->post('telp'),
				'hp' => $this->input->post('hp'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'tanggal_masuk' => date('Y-m-d')
			);
			$insert = $this->db->insert('tb_petugas', $new_member_insert_data);
		    return $insert;
		}
	      
	}//create_petugas
}

