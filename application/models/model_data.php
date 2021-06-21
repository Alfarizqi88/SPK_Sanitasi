<?php

class Model_data extends CI_Model
{
	
// cek unique - admin
	// data login
	function check_unique_username($id_datalogin = '', $username) {
        $this->db->where('username', $username);
        if($id_datalogin) {
            $this->db->where_not_in('id_datalogin', $id_datalogin);
        }
        return $this->db->get('data_login')->num_rows();
    }
	// data alternatif
	function check_unique_nik($id_alternatif = '', $nik_alternatif) {
        $this->db->where('nik_alternatif', $nik_alternatif);
        if($id_alternatif) {
            $this->db->where_not_in('id_alternatif', $id_alternatif);
        }
        return $this->db->get('data_alternatif')->num_rows();
    }
	// data kriteria
	function check_unique_kode_kriteria($id_kriteria = '', $kode_kriteria) {
        $this->db->where('kode_kriteria', $kode_kriteria);
        if($id_kriteria) {
            $this->db->where_not_in('id_kriteria', $id_kriteria);
        }
        return $this->db->get('data_kriteria')->num_rows();
    }
	// data sub kriteria
	function check_unique_kode_subkriteria($id_subkriteria = '', $kode_subkriteria) {
        $this->db->where('kode_subkriteria', $kode_subkriteria);
        if($id_subkriteria) {
            $this->db->where_not_in('id_subkriteria', $id_subkriteria);
        }
        return $this->db->get('data_subkriteria')->num_rows();
    }


// Cek insert
	function insert($data,$table)
	{
		return $this->db->insert($table,$data);
	}

	function cek($where,$table)
	{
		$query = $this->db->get_where($table,$where);
		return $query->row_array();
    }
    function ambil_user($where,$table)
	{
		$query = $this->db->get_where($table,$where);
		return $query->row_array();
	}
// cek Ascending data
	function data($namakolom, $table)
	{
		$this->db->order_by($namakolom, 'ASC');
		$query = $this->db->get($table);
		// print_r($this->db->last_query()); 
		return $query->result_array();		
	}

	// Delete data
	function delete_data($where,$table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
	function delete($table)
	{		
		$this->db->delete($table);
	}

	function pilih_data($where , $table)
	{
		$this->db->select('*');
		$this->db->from($table);			
		$this->db->where($where);
		$query=$this->db->get();			
		$data= $query->result_array();
			 
		return $data;
	}

	// insert data nilai bobot kriteria
	function data_kriteria_bobot()
	{
		$this->db->select('*');
		$this->db->from('kriteria_bobot');					
		$query=$this->db->get();			
		$data= $query->result_array();
			 
		return $data;
	}
	// get data chart insert
	function data_dusun_chart()
	{
		$this->db->select('count(nama_dusun) as Jumlah , nama_dusun ');
		$this->db->from('data_alternatif');	
		$this->db->group_by('nama_dusun');
		$query=$this->db->get();
		return $query;
	}

	function data_kriteria_bobot_chart()
	{
		$this->db->select('*');
		$this->db->from('kriteria_bobot');					
		$query=$this->db->get();
		return $query;
	}

	// Ambil total data sub kriteria
	function data_subkriteria()
	{
		$this->db->select('*');
		$this->db->from('data_subkriteria');	
		$this->db->join('data_kriteria','data_kriteria.id_kriteria=data_subkriteria.id_kriteria');					
		$query=$this->db->get();			
		$data= $query->result_array();
		// print_r($this->db->last_query()); 
		return $data;
	}
	function data_subkriteria_where($where)
	{
		$this->db->select('*');
		$this->db->from('data_subkriteria');	
		$this->db->join('data_kriteria','data_kriteria.id_kriteria=data_subkriteria.id_kriteria');	
		$this->db->where($where);				
		$query=$this->db->get();			
		$data= $query->result_array();
		
		return $data;
	}

// edit data
	function edit_data($where,$data,$table)
	{		
		$this->db->where($where);
		$this->db->update($table,$data);
			
	}

	// ambil nilai count
	function get_count($table)
	{
		$query = $this->db->query("SELECT * FROM $table");
		$data = $query->num_rows();
		return $data;
	}

	function get_count_survey($table)
	{
		$query = $this->db->query("SELECT *, COUNT( * ) AS total FROM $table GROUP BY id_alternatif");
		$data = $query->num_rows();
		return $data;
	}

	// tampil total data login
	function tampil_data_login($where)
	{
		$this->db->select('*');
		$this->db->from('data_login');	
		$this->db->where($where);
					
		$query=$this->db->get();			
		$data= $query->result_array();
		
		return $data;
	}

	// Mengecek data foreign key yang akan dihapus
	function cek_data_alternatif($where)
	{
		$this->db->select('*');
		$this->db->from('data_lapangan');	
		$this->db->join('data_alternatif','data_alternatif.id_alternatif=data_lapangan.id_alternatif');	
		$this->db->where('data_lapangan.id_alternatif', $where);				
		$query=$this->db->get();			
		$data= $query->row();
		// print_r($this->db->last_query()); 
		return $data;
	}

	function cek_data_kriteria($where)
	{
		$this->db->select('*');
		$this->db->from('data_subkriteria');	
		$this->db->join('data_kriteria','data_kriteria.id_kriteria=data_subkriteria.id_kriteria');	
		$this->db->where('data_subkriteria.id_kriteria', $where);	
		$query=$this->db->get();			
		$data= $query->row();
		// print_r($this->db->last_query()); 
		return $data;
	}
	function cek_data_subkriteria($where)
	{
		$this->db->select('*');
		$this->db->from('data_lapangan');	
		$this->db->join('data_subkriteria','data_subkriteria.id_subkriteria=data_lapangan.id_subkriteria');	
		$this->db->where('data_lapangan.id_subkriteria', $where);				
		$query=$this->db->get();			
		$data= $query->row();
		// print_r($this->db->last_query()); 
		return $data;
	}



	//pihakpelaksana
	// check unique pihakpelaksana
	function check_unique_nik_pihak($id_survei_longlist = '', $id_alternatif) {
        $this->db->where('id_alternatif', $id_alternatif);
        if($id_survei_longlist) {
            $this->db->where_not_in('id_survei_longlist', $id_survei_longlist);
        }
        return $this->db->get('data_survey_lapangan')->num_rows();
    }

	function ambil_data_alternatif()
	{
		$this->db->select('*');
		$this->db->from('data_alternatif');					
		$query=$this->db->get();			
		$data= $query->result_array();
		// print_r($this->db->last_query()); 
		return $data;
	}
	function ambil_data_kriteria($table){
		$this->db->select('*');
		$this->db->from($table);				
		$query=$this->db->get();			
		$data= $query->result_array();
		return $data;
	}


	// function data_survei_lapangan_where($where)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('data_survey_lapangan');	
	// 	$this->db->where($where);				
	// 	$query=$this->db->get();			
	// 	$data= $query->result_array();
	// 	return $data;
	// }    

	// Ambil data total lapangan
	function data_lapangan()
	{
		$this->db->select('*');
		$this->db->from('data_lapangan');	
		$this->db->join('data_alternatif','data_alternatif.id_alternatif=data_lapangan.id_alternatif');					
		$query=$this->db->get();			
		$data= $query->result_array();
		// print_r($this->db->last_query()); 
		return $data;
	}

	function count_data_lapangan(){			
		$query=$this->db->query("SELECT count(id_subkriteria) as total_sub FROM data_lapangan group by id_alternatif");
		$data= $query->result_array();
		// print_r($this->db->last_query()); 
		return $data;
	}
	


	//crud data survei
	
	function tampil_data_lapangan(){
		$query = $this->db->query("SELECT b.*,c.nama_subkriteria, c.id_subkriteria,c.nilai_subkriteria, c.id_kriteria
        FROM
        	data_lapangan a
        JOIN
            data_alternatif b ON a.id_alternatif = b.id_alternatif
        JOIN
			data_subkriteria c ON a.id_subkriteria = c.id_subkriteria
		GROUP BY 	a.id_alternatif, a.id_subkriteria");
		$data=$query->result_array();
		return $data;
	}
	//fungsi tambah
	function tambah_data_kriteria($namakolom1,$namakolom2,$table){
		$query = $this->db->query("SELECT $namakolom1,$namakolom2 FROM $table");
		$data=$query->result_array();
		return $data;
	}
	//fungsi hapus
	function hapus_data_alternatif($namakolom1,$table,$where){
		// $query = $this->db->query("SELECT $namakolom1 FROM $table WHERE $where");
		$this->db->select($namakolom1);
		$this->db->from($table);			
		$this->db->where($where);
		$query=$this->db->get();			
		$data= $query->result_array();
		return $data;
	}
	//fungsi edit
	function tampil_edit_data_lapangan($nik_alternatif){
		$query = $this->db->query("SELECT b.*, d.nama_kriteria, a.id_lapangan, c.nama_subkriteria, c.id_subkriteria,c.nilai_subkriteria, c.id_kriteria
        FROM
        	data_lapangan a
        JOIN
            data_alternatif b ON a.id_alternatif = b.id_alternatif
        JOIN
			data_subkriteria c ON a.id_subkriteria = c.id_subkriteria
		JOIN
			data_kriteria d ON c.id_kriteria = d.id_kriteria WHERE b.nik_alternatif = $nik_alternatif");
		$data=$query->result_array();
		return $data;
	}
	function edit_data_lapangan($namakolom1,$table,$where){
		// $query = $this->db->query("SELECT $namakolom1 FROM $table WHERE $where");
		$this->db->select($namakolom1);
		$this->db->from($table);			
		$this->db->where($where);
		$query=$this->db->get();			
		$data= $query->result_array();
		return $data;
	}

}

?>