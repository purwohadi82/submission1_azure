<?php
class Buku_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_buku_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tb_buku');
		$this->db->where('id_buku', $id);
		$query = $this->db->get();
		return $query->row(); 
    }

    /**
    * Fetch products data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_buku($buku_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('id_buku');
		$this->db->select('judul');
		$this->db->select('penulis');
		$this->db->select('penerbit');
		$this->db->select('tahun');
		$this->db->select('jenis_buku');
        $this->db->select('lokasi_rak');
        $this->db->select('isbn');
        $this->db->select('jumlah');
        $this->db->select('foto');
		$this->db->from('tb_buku');
		if($buku_id != null){
			$this->db->where('id_buku', $buku_id);
		}
		if($search_string){
			$this->db->like('judul', $search_string);
		}

		//$this->db->group_by('judul');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('judul', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_buku($buku_id=null, $search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('tb_buku');
		if($buku_id != null){
			$this->db->where('id_buku', $buku_id);
		}
		if($search_string){
			$this->db->like('judul', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id_buku', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_buku($data)
    {
		$insert = $this->db->insert('tb_buku', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_buku($id, $data)
    {
		$this->db->where('id_buku', $id);
		$this->db->update('tb_buku', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
}
?>	
