<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Pihakpelaksana extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		if(!$this->session->userdata('level'))
		{
			redirect('login');
		}
	}

	function read_manual_book()
	{
		$where = array(
			'user'  => 'pihak_pelaksana'
		);

		$data['data_manual_book'] = $this->model_data->pilih_data($where,'data_manual_book');
		// var_dump($data['data_manual_book'][0]['file']);die();
		if($data['data_manual_book']==null){
			$this->session->set_flashdata('error', 'File PDF tidak ada ');
		}

		$this->load->view('pihakpelaksana/v_sidebar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_navbar_pihakpelaksana');
		$this->load->view('admin/v_read_manual_book' , $data);
	}

	public function index()
	{
		$data['total_data_alternatif'] = $this->model_data->get_count('data_alternatif');
		$data['total_data_kriteria'] = $this->model_data->get_count('data_kriteria');
		$data['total_data_survey_lapangan'] = $this->model_data->get_count_survey('data_lapangan');
		$data['total_data_subkriteria'] = $this->model_data->get_count('data_subkriteria');

		$data_dusun_chart = $this->model_data->data_dusun_chart()->result();
		$data['data_dusun_chart'] = json_encode($data_dusun_chart);	
		
		$this->load->view('pihakpelaksana/v_sidebar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_navbar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_dashboard_pihakpelaksana',$data);
	}

	public function data_survey_lapangan_cetak()
	{	
		//data tidak paten
		$kriteria = $this->model_data->ambil_data_kriteria('data_kriteria');
		$tampil_data_lapangan = $this->model_data->tampil_data_lapangan();
		
		$data_kriteria=[];
		$data_alternatif_lengkap=[];
		$data_alternatif_lengkap_nilai=[];
		$data_alternatif_editdelete=[];
		foreach($tampil_data_lapangan as $key => $value){
			$data_alternatif_lengkap[$key] = ($value['nik_alternatif']."-".$value['nama_alternatif']."-".$value['nama_dusun']);
			$data_alternatif_editdelete[$key]= $value['nik_alternatif'];

			$data_alternatif_lengkap_nilai[$key] = ($value['nik_alternatif']."-".$value['nama_alternatif']);
		}
			
		foreach($tampil_data_lapangan as $key => $tampil_data_lapangan){
			
			$data_kriteria[$data_alternatif_lengkap[$key]][$tampil_data_lapangan['id_kriteria']]=$tampil_data_lapangan['nama_subkriteria'];
			$data_kriteria_nilai[$data_alternatif_lengkap_nilai[$key]][$tampil_data_lapangan['id_kriteria']]=$tampil_data_lapangan['nilai_subkriteria'];
			
		}
	
		// print_r($data);x	
		$data['total_kriteria']= count($kriteria);
		$data['kriteria']= $kriteria;
		if($data_kriteria){
			$data['data_kriteria']= $data_kriteria;
			$data['data_alternatif_editdelete'] =$data_alternatif_editdelete;

			$data['data_kriteria_nilai']= $data_kriteria_nilai;
		}
		else{
			$data['data_kriteria']= null;
			$data['data_kriteria_nilai']= null;
		}

		$this->load->view('pihakpelaksana/v_sidebar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_navbar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_data_survei_longlist_cetak' ,$data);
	}
		
	//data lapangan
	public function data_survey_lapangan()
	{	
		//data tidak paten
		$kriteria = $this->model_data->ambil_data_kriteria('data_kriteria');
		$tampil_data_lapangan = $this->model_data->tampil_data_lapangan();
		
		$data_kriteria=[];
		$data_alternatif_lengkap=[];
		$data_alternatif_lengkap_nilai=[];
		$data_alternatif_editdelete=[];
		foreach($tampil_data_lapangan as $key => $value){
			$data_alternatif_lengkap[$key] = ($value['nik_alternatif']."-".$value['nama_alternatif']."-".$value['nama_dusun']."-".$value['rt']."-".$value['rw']);
			$data_alternatif_editdelete[$key]= $value['nik_alternatif'];

			$data_alternatif_lengkap_nilai[$key] = ($value['nik_alternatif']."-".$value['nama_alternatif']);
		}
			
		foreach($tampil_data_lapangan as $key => $tampil_data_lapangan){
			
			$data_kriteria[$data_alternatif_lengkap[$key]][$tampil_data_lapangan['id_kriteria']]=$tampil_data_lapangan['nama_subkriteria'];
			$data_kriteria_nilai[$data_alternatif_lengkap_nilai[$key]][$tampil_data_lapangan['id_kriteria']]=$tampil_data_lapangan['nilai_subkriteria'];
			
		}
	
		// print_r($data);x	
		$data['total_kriteria']= count($kriteria);
		$data['kriteria']= $kriteria;
		if($data_kriteria){
			$data['data_kriteria']= $data_kriteria;
			$data['data_alternatif_editdelete'] =$data_alternatif_editdelete;

			$data['data_kriteria_nilai']= $data_kriteria_nilai;
		}
		else{
			$data['data_kriteria']= null;
			$data['data_kriteria_nilai']= null;
		}

		$this->load->view('pihakpelaksana/v_sidebar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_navbar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_data_survei_longlist' ,$data);
	}

	public function tampil_tambah_data_lapangan()
	{	
		//data tidak paten
		$ambil_data['data_lapangan_nik']= $this->model_data->ambil_data_alternatif();
		$ambil_data['data_lapangan1']= $this->model_data->data_subkriteria();
		$ambil_data['data_kriteria'] = $this->model_data->tambah_data_kriteria('nama_kriteria','id_kriteria', 'data_kriteria');
		
		$this->load->view('pihakpelaksana/v_sidebar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_navbar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_tambah_data_survei_longlist',$ambil_data );
	}

	public function tambah_data_lapangan()
	{
		//data tidak paten
		$this->form_validation->set_rules('id_alternatif', 'NIK', 'is_unique[data_lapangan.id_alternatif]|required');

		if($this->form_validation->run() == false )
		{
			$this->session->set_flashdata('id_alternatif', form_error('id_alternatif'));
			redirect('c_pihakpelaksana/tampil_tambah_data_lapangan');	
		}
		else
		{
			$id_alternatif = $this->input->post('id_alternatif',true);
			$data_kriteria = $this->model_data->tambah_data_kriteria('nama_kriteria','id_kriteria','data_kriteria');

			foreach ($data_kriteria as $key => $data_kriteria) {
				
				$kode = 'c'.($key+1) ;
			
				$data_insert = array(
					'id_alternatif'  => $id_alternatif,
					'id_subkriteria'  => $this->input->post($kode,true)
				);
				$this->model_data->insert($data_insert,'data_lapangan');
			}
			$this->session->set_flashdata('success','Berhasil Menambah Data');
			redirect('c_pihakpelaksana/data_survey_lapangan');
		}
	}

	public function tampil_edit_data_lapangan()
	{
		//data tidak paten
		$nik_alternatif = $this->input->get('nik_alternatif');
		$where = array(            
            'nik_alternatif' =>  $nik_alternatif
		);
		$tampil_edit_lapangan = $this->model_data->tampil_edit_data_lapangan($nik_alternatif);
		
		foreach($tampil_edit_lapangan as $tampil_edit_lapangan){
			$data_kriteria[$tampil_edit_lapangan['id_alternatif']][$tampil_edit_lapangan['nama_kriteria']]=$tampil_edit_lapangan['id_lapangan'];
		}
		// print_r($data);
		$ambil_data['kriteria']= $this->model_data->ambil_data_kriteria('data_kriteria');
		$ambil_data['data_kriteria']= $data_kriteria;
		$ambil_data['data_lapangan1']= $this->model_data->data_subkriteria();
		$ambil_data['data_alternatif'] = $this->model_data->pilih_data($where,'data_alternatif');
		$ambil_data['ambil_id_alternatif'] = $ambil_data['data_alternatif'][0]['id_alternatif'];

        $this->load->view('pihakpelaksana/v_sidebar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_navbar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_edit_data_survei_longlist' ,$ambil_data);

	}

	public function edit_data_lapangan()
	{
		//data tidak paten
		$id_alternatif = $this->input->get('id_alternatif');
		$data_kriteria = $this->model_data->tambah_data_kriteria('nama_kriteria','id_kriteria','data_kriteria');

		foreach ($data_kriteria as $key => $data_kriteria) {
			$kode = 'c'.($key+1) ;
			$kode_dsl = 'id_dsl'.($key+1) ;
			$data_insert = array(
				'id_alternatif'  => $id_alternatif,
				'id_subkriteria'  => $this->input->post($kode,true)
			);
			$value_dsl = $this->input->post($kode_dsl,true);
			$where = array(
				'id_lapangan'=>$value_dsl,
				'id_alternatif'=>$id_alternatif
			);
			$value_id_subkriteria = $this->model_data->edit_data_lapangan('id_lapangan','data_lapangan',$where);
			$survei_lapangan = $value_id_subkriteria[0]['id_lapangan'];
				
			$where = array(
				'id_lapangan' => $survei_lapangan
			);
			$this->model_data->edit_data($where,$data_insert,'data_lapangan');
		}
		$this->session->set_flashdata('success','Berhasil Mengedit Data ');
		redirect('c_pihakpelaksana/data_survey_lapangan');
				
	}
	

	public function hapus_data_lapangan()
	{	   
		//data tidak paten
		$nik_alternatif = $this->input->get('nik_alternatif');
		$where = array(            
            'nik_alternatif' =>  $nik_alternatif
        );
		// $alternatif = $this->db->query("SELECT id_alternatif FROM data_alternatif WHERE nik_alternatif = $nik_alternatif")->result_array();
		$alternatif=$this->model_data->hapus_data_alternatif('id_alternatif','data_alternatif',$where);
        $this->model_data->delete_data($alternatif[0],'data_lapangan');
     	redirect('c_pihakpelaksana/data_survey_lapangan'); 
	}


	//alternatif/ longlist
	public function data_alternatif()
	{
		$data['data_alternatif'] = $this->model_data->data('nama_dusun','data_alternatif');
		// print($data['data_longlist'][0]['kode_longlist']);die();
		$this->load->view('pihakpelaksana/v_sidebar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_navbar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_data_alternatif_pihakpelaksana' ,$data);

	}

	//kriteria
	public function data_kriteria()
	{
		$data['data_kriteria'] = $this->model_data->data('kode_kriteria','data_kriteria');
		// print($data['data_longlist'][0]['kode_longlist']);die();
		$this->load->view('pihakpelaksana/v_sidebar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_navbar_pihakpelaksana');
		
		$this->load->view('pihakpelaksana/v_data_kriteria_pihakpelaksana' ,$data);

	}
	//sub kriteria
	public function data_subkriteria()
	{
		$data['data_subkriteria'] = $this->model_data->data_subkriteria('data_subkriteria');
		// print($data['data_longlist'][0]['kode_longlist']);die();
		$this->load->view('pihakpelaksana/v_sidebar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_navbar_pihakpelaksana');
		
		$this->load->view('pihakpelaksana/v_data_subkriteria_pihakpelaksana' ,$data);

	}

  
	//INFO DATA DIRI
	public function data_info(){
		$username = $this->session->userdata('username');
		$where = array(            
            'username' =>  $username
        );

		$data['data_info'] = $this->model_data->tampil_data_login($where);

		$this->load->view('pihakpelaksana/v_sidebar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_navbar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_tampil_data_info_pihakpelaksana', $data);
	}

	public function tambah_data_info()
	{
		$this->form_validation->set_rules('no_telepon', 'No. telepon', 'required|min_length[11]|max_length[14]');
		if($this->form_validation->run() == false )
		{
			$this->session->set_flashdata('no_telepon', form_error('no_telepon'));
			redirect('c_pihakpelaksana/data_info');	
		}
		else
		{
			$username = $this->input->get('username',true);
			$nama = $this->input->post('nama',true);
			$divisi = $this->input->post('divisi',true);
			$no_telepon = $this->input->post('no_telepon',true);

			$where_datalogin = array(
				'username' => $username
			);
			
			$data_insert = array(
				'username'=> $username,
				'nama'  => $nama,
				'divisi'  => $divisi,
				'no_telepon'     => $no_telepon  
			);
			$this->model_data->edit_data($where_datalogin,$data_insert,'data_login');
			$this->session->set_flashdata('success','Perubahan Data Sukses');
			redirect('c_pihakpelaksana/data_info');		
		}
			
	}

	//hitung mfep
	public function data_hitung_mfep()
	{	
		//data tidak paten
		$kriteria = $this->model_data->ambil_data_kriteria('data_kriteria');
		$tampil_data_lapangan = $this->model_data->tampil_data_lapangan();
		
		$data_kriteria=[];
		$data_alternatif_lengkap=[];
		$data_alternatif_lengkap_nilai=[];
		$data_alternatif_nama=[];
		foreach($tampil_data_lapangan as $key => $value){
			$data_alternatif_lengkap[$key] = ($value['nik_alternatif']."-".$value['nama_alternatif']."-".$value['nama_dusun']);
			$data_alternatif_nama[$key]= $value['nama_alternatif'];
			$data_alternatif_lengkap_nik[$key] = ($value['nik_alternatif']."-".$value['nama_alternatif']);
		}
			
		foreach($tampil_data_lapangan as $key => $tampil_data_lapangan){
			// $data_kriteria[$tampil_data_lapangan['nik_alternatif']][$tampil_data_lapangan['id_kriteria']]=$tampil_data_lapangan['nama_subkriteria'];
			// $data_kriteria_nilai[$tampil_data_lapangan['nik_alternatif']][$tampil_data_lapangan['id_kriteria']]=$tampil_data_lapangan['nilai_subkriteria'];
			
			$data_kriteria[$data_alternatif_lengkap[$key]][$tampil_data_lapangan['id_kriteria']]=$tampil_data_lapangan['nama_subkriteria'];
			$data_alternatif_nik[$data_alternatif_lengkap_nik[$key]][$tampil_data_lapangan['id_kriteria']]=$tampil_data_lapangan['nilai_subkriteria'];
			
		}
	
		// print_r($data);x	
		$data['total_kriteria']= count($kriteria);
		$data['kriteria']= $kriteria;
		if($data_kriteria){
			$data['data_kriteria']= $data_kriteria;
			$data['data_alternatif_nama'] =$data_alternatif_nama;

			$data['data_alternatif_nik']= $data_alternatif_nik;
		}
		else{
			$data['data_kriteria']= null;
			$data['data_kriteria_nilai']= null;
		}

		$data['kriteria_bobot'] = $this->model_data->data_kriteria_bobot();
		
		$this->load->view('pihakpelaksana/v_sidebar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_navbar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_data_hitung_mfep' ,$data);
	}

	public function data_hasil_laporan()
	{	
		//data tidak paten
		$kriteria = $this->model_data->ambil_data_kriteria('data_kriteria');
		$tampil_data_lapangan = $this->model_data->tampil_data_lapangan();
		
		$data_kriteria=[];
		$data_alternatif_lengkap=[];
		$data_alternatif_nama=[];
		$data_alternatif_lengkap_nik=[];

		foreach($tampil_data_lapangan as $key => $value){
			$data_alternatif_lengkap[$key] = ($value['nik_alternatif']."-".$value['nama_alternatif']."-".$value['nama_dusun']);
			$data_alternatif_nama[$key]= $value['nama_alternatif'];
			$data_alternatif_lengkap_nik[$key] = ($value['nik_alternatif']);
			$data_alternatif_nama_dsn[$key]= ($value['nama_dusun']);
			$data_alternatif_nama_rtrw[$key]= ($value['rt']."/".$value['rw']);
		}
		foreach($tampil_data_lapangan as $key => $tampil_data_lapangan){	
			$data_kriteria[$data_alternatif_lengkap[$key]][$tampil_data_lapangan['id_kriteria']]=$tampil_data_lapangan['nama_subkriteria'];
			$data_alternatif_nik[$data_alternatif_lengkap_nik[$key]][$tampil_data_lapangan['id_kriteria']]=$tampil_data_lapangan['nilai_subkriteria'];
			$data_alternatif_nama_alter[$data_alternatif_lengkap_nik[$key]]= $data_alternatif_nama[$key];
			$data_alternatif_nama_dusun[$data_alternatif_lengkap_nik[$key]]= $data_alternatif_nama_dsn[$key];
			$data_alternatif_nama_rt_rw[$data_alternatif_lengkap_nik[$key]]= $data_alternatif_nama_rtrw[$key];
		}
		
		$data['total_kriteria']= count($kriteria);
		$data['kriteria']= $kriteria;
		if($data_kriteria){
			$data['data_kriteria']= $data_kriteria;
			$data['data_alternatif_nama'] =$data_alternatif_nama;
			$data['data_alternatif_nik']= $data_alternatif_nik;
			$data['data_alternatif_nama_alter'] =$data_alternatif_nama_alter;
			$data['data_alternatif_nama_dusun'] =$data_alternatif_nama_dusun;
			$data['data_alternatif_nama_rt_rw'] =$data_alternatif_nama_rt_rw;
		}
		else{
			$data['data_kriteria']= null;
			$data['data_alternatif_nama'] = null;
			$data['data_alternatif_nik']= null;
			$data['data_alternatif_nama_alter'] =null;
			$data['data_alternatif_nama_dusun'] =null;
		}

		$data['kriteria_bobot'] = $this->model_data->data_kriteria_bobot();
		
		$this->load->view('pihakpelaksana/v_sidebar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_navbar_pihakpelaksana');
		$this->load->view('pihakpelaksana/v_data_hasil_laporan' ,$data);
	}

}
?>