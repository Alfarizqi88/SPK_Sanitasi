<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('level'))
		{
			redirect('login');
		}
	}

	public function index()
	{
		$data['total_data_kriteria'] = $this->model_data->get_count('data_kriteria');
		$data['total_data_login'] = $this->model_data->get_count('data_login');
		$data['total_data_alternatif'] = $this->model_data->get_count('data_alternatif');

		//chart
		$data_chart = $this->model_data->data_kriteria_bobot_chart()->result();
		$data['data_chart'] = json_encode($data_chart);	
		
		$data_dusun_chart = $this->model_data->data_dusun_chart()->result();
		$data['data_dusun_chart'] = json_encode($data_dusun_chart);	
				

		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		
		$this->load->view('admin/v_dashboard',$data);
		
	}

	public function upload_manual_book()
	{
		$data['data_manual_book'] = $this->model_data->data('user','data_manual_book');
		$data['jumlah_upload'] = count($data['data_manual_book']);

		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_upload_manual_book' , $data);
	}

	public function do_upload()
	{
		// setting konfigurasi upload
           
		$config['upload_path'] = "./uploads";  
		// print_r($config['upload_path']);die();
				
		
		// $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']=0;
		//setting max size php.ini (apache xampp) cari yang mb
		

		//proses upload
		$this->upload->initialize($config);

		// print_r($this->upload->initialize($config));die();
		
		if (!$this->upload->do_upload('file')) {
			$error = array('error' =>  $this->upload->display_errors());
			// menampilkan pesan error
			$this->session->set_flashdata('error', 'file tidak sesuai ketentuan , HARUS PDF!!');
			redirect('c_admin/upload_manual_book');
			// $this->load->view('v_upload',$error);
			//  print_r($error);
		} else {
			$this->session->set_flashdata('success', 'berhasil di upload');
			$result = $this->upload->data();
            $list_user = $this->input->post('list_user');

			$data_insert = array(
				'user'  => $list_user,
				'file' => $result['file_name']
			);
			
			$this->model_data->insert($data_insert,'data_manual_book');
			redirect('c_admin/upload_manual_book');

		}
	}

	public function hapus_manual_book()
	{
		$id_manual_book = $this->input->get('id_manual_book');

		$where = array(            
            'id_manual_book' =>  $id_manual_book
        );
        $this->model_data->delete_data($where,'data_manual_book');
     	redirect('c_admin/upload_manual_book');		   
	}

	function read_manual_book()
	{
		$where = array(
			'user'  => 'admin'
		);

		$data['data_manual_book'] = $this->model_data->pilih_data($where,'data_manual_book');
		if($data['data_manual_book']==null){
			$this->session->set_flashdata('error', 'File PDF tidak ada ');
		}
		// var_dump($data['data_manual_book'][0]['file']);die();
		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_read_manual_book' , $data);
	}
	
	//data alternatif/masyarakat
	public function data_alternatif()
	{
		$data['data_alternatif'] = $this->model_data->data('nama_dusun','data_alternatif');

		if($this->session->flashdata('pesan_error') != 0)
		{
			$data['pesan_error'] = $this->session->flashdata('pesan_error');
		}
		else
		{
			$data['pesan_error'] = 0;
		}

		// print($this->session->flashdata('pesan_error'));die();

		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_data_alternatif' ,$data);
	}

	public function tampil_tambah_alternatif()
	{
		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_tambah_data_alternatif' );		
	}

	public function tambah_data_alternatif()
	{
		$this->form_validation->set_rules('nik_alternatif', 'NIK', 'is_unique[data_alternatif.nik_alternatif]|required|min_length[16]|max_length[16]required');
		if($this->form_validation->run() == false )
		{
			$this->session->set_flashdata('nik_alternatif', form_error('nik_alternatif'));
			redirect('c_admin/tampil_tambah_alternatif');	
		}
		else
		{
			$nik_alternatif = $this->input->post('nik_alternatif',true);
			$nama_alternatif = $this->input->post('nama_alternatif',true);
			$nama_dusun = $this->input->post('nama_dusun',true);
			$rt = $this->input->post('rt',true);
			$rw = $this->input->post('rw',true);

			$data_insert = array(
				'nik_alternatif'  => $nik_alternatif,
				'nama_alternatif'     => $nama_alternatif,
				'nama_dusun' => $nama_dusun,
				'rt'     => $rt,
				'rw' => $rw
			);
			
			$this->model_data->insert($data_insert,'data_alternatif');
			$this->session->set_flashdata('success','Berhasil Menambah Data');
			redirect('c_admin/data_alternatif');
		}
				
	}

	public function hapus_data_alternatif()
	{
		$id_alternatif = $this->input->get('id_alternatif');
			$where = array(            
				'id_alternatif' =>  $id_alternatif
			);

		$cek = $this->model_data->cek_data_alternatif($id_alternatif);

		if(!empty($cek))
		{
			$pesan_error = 1;
						
			$this->session->set_flashdata('pesan_error',$pesan_error);
			redirect('c_admin/data_alternatif' , $data);
		}
		else
		{
			$this->model_data->delete_data($where,'data_alternatif');
			$pesan_error  = 2;
			$this->session->set_flashdata('pesan_error',$pesan_error);
			
			redirect('c_admin/data_alternatif' , $data);			
		}				   
	}

	public function tampil_edit_data_alternatif()
	{
		$id_alternatif = $this->input->get('id_alternatif');
		$where = array(            
            'id_alternatif' =>  $id_alternatif
        );
        $data['data_alternatif'] = $this->model_data->pilih_data($where ,'data_alternatif');
        $this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_edit_data_alternatif' ,$data);
	}

	public function edit_data_alternatif()
	{
		$id_alternatif_get = $this->input->get('id_alternatif');
		$this->form_validation->set_rules('nik_alternatif', 'NIK', 'callback_check_nik|required|min_length[16]|max_length[16]');
		if($this->form_validation->run() == false )
		{
			$this->session->set_flashdata('nik_alternatif', form_error('nik_alternatif'));
			redirect('c_admin/tampil_edit_data_alternatif?id_alternatif='.$id_alternatif_get.'');	
		}
		else
		{
			$id_alternatif = $this->input->post('id_alternatif',true);
			// $kode_longlist = $this->input->post('kode_longlist');
			$nik_alternatif = $this->input->post('nik_alternatif',true);
			$nama_alternatif = $this->input->post('nama_alternatif',true);
			$nama_dusun = $this->input->post('nama_dusun',true);
			$rt = $this->input->post('rt',true);
			$rw = $this->input->post('rw',true);

			$where = array(
				'id_alternatif' => $id_alternatif
			);

			$data = array(
				// 'kode_longlist' => $kode_longlist,
				'nik_alternatif' => $nik_alternatif,
				'nama_alternatif' => $nama_alternatif,
				'nama_dusun' => $nama_dusun,
				'rt' => $rt,
				'rw' => $rw
			);
			$this->model_data->edit_data($where,$data,'data_alternatif');
			$this->session->set_flashdata('success','Berhasil Mengedit Data '. $nama_alternatif);
			redirect('c_admin/data_alternatif');	
		}	
	}

	function check_nik($nik_alternatif) {        
		if($this->input->post('id_alternatif'))
			$id_alternatif = $this->input->post('id_alternatif');
		else
			$id_alternatif = '';
			$result = $this->model_data->check_unique_nik($id_alternatif, $nik_alternatif);
		if($result == 0)
			$response = true;
		else {
			$this->form_validation->set_message('check_nik', 'NIK must be unique');
			$response = false;
		}
		return $response;
	}


	//data login
	public function data_login()
	{	
		$data['data_login'] = $this->model_data->data('level','data_login');
		// print($data['data_longlist'][0]['kode_longlist']);die();
		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_data_login',$data);
	}

	public function tampil_tambah_data_login()
	{
		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_tambah_data_login' );		
	}

	public function tambah_data_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'is_unique[data_login.username]|required');
		if($this->form_validation->run() == false )
		{
			$this->session->set_flashdata('error_username', form_error('username'));
			redirect('c_admin/tampil_tambah_data_login');	
		}
		else{
			$nama = $this->input->post('nama',true);
			$divisi = $this->input->post('divisi',true);
			$no_telepon = $this->input->post('no_telepon',true);
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);
			$level = $this->input->post('level',true);
			
			$data_insert = array(
				// 'id_login'=> $id_login,
				'nama'  => "kosong",
				'divisi'  => "kosong",
				'no_telepon'     => 0,
				'username'  => $username,
				'password'  => $password,
				'level' => $level
			);
			$this->model_data->insert($data_insert,'data_login');
			$this->session->set_flashdata('success','Berhasil Menambah Data');
			redirect('c_admin/data_login');
		}
	}

	public function hapus_data_login()
	{
		$id_datalogin = $this->input->get('id_datalogin');

		$where = array(            
            'id_datalogin' =>  $id_datalogin
        );
        $this->model_data->delete_data($where,'data_login');
     	redirect('c_admin/data_login');		   
	}

	public function tampil_edit_data_login()
	{
		$id_datalogin = $this->input->get('id_datalogin');
		$where = array(            
            'id_datalogin' =>  $id_datalogin
        );
		$data['data_login'] = $this->model_data->pilih_data($where,'data_login');
        $this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_edit_data_login' ,$data);

	}

	public function edit_data_login()
	{
		$id_datalogin_get = $this->input->get('id_datalogin');
		$this->form_validation->set_rules('username', 'Username', 'callback_check_username|required');
		if($this->form_validation->run() == false )
		{
			$this->session->set_flashdata('error_username', form_error('username'));
			redirect('c_admin/tampil_edit_data_login?id_datalogin='.$id_datalogin_get.'');	
		}
		else
		{
			$id_datalogin = $this->input->post('id_datalogin',true);
			$nama = $this->input->post('nama',true);
			$divisi = $this->input->post('divisi',true);
			$no_telepon = $this->input->post('no_telepon',true);
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);
			$level = $this->input->post('level',true);
			
			$where = array(
				'id_datalogin' => $id_datalogin
			);
			$data_login = array(
				'username'  => $username,
				'password'  => $password,
				'level' => $level
			);
			$this->model_data->edit_data($where,$data_login,'data_login');
			$this->session->set_flashdata('success','Berhasil Mengedit Data ');
			redirect('c_admin/data_login');	
		}		
	}
	
	function check_username($username) {        
		if($this->input->post('id_datalogin'))
			$id_datalogin = $this->input->post('id_datalogin');
		else
			$id_datalogin = '';
			$result = $this->model_data->check_unique_username($id_datalogin, $username);
		if($result == 0)
			$response = true;
		else {
			$this->form_validation->set_message('check_username', 'Username must be unique');
			$response = false;
		}
		return $response;
	}


	//INFO DATA DIRI
	public function data_info(){
		$username = $this->session->userdata('username');
		$where = array(            
            'username' =>  $username
        );

		$data['data_info'] = $this->model_data->tampil_data_login($where);
		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		
		$this->load->view('admin/v_tampil_data_info', $data);
	}

	public function tambah_data_info()
	{
		$this->form_validation->set_rules('no_telepon', 'No. telepon', 'required|min_length[11]|max_length[14]');
		if($this->form_validation->run() == false )
		{
			$this->session->set_flashdata('no_telepon', form_error('no_telepon'));
			redirect('c_admin/data_info');	
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
			redirect('c_admin/data_info');	
		}
			
	}


	//PERHITUNGAN AHP
	public function analisa_kriteria()
	{
		$data['data_kriteria'] = $this->model_data->data('kode_kriteria','data_kriteria');	
		$n = count($this->model_data->ambil_data_kriteria('data_kriteria'));
		// var_dump($n);die();
		$data['jumlah_n'] = $n;		

		// print($data['data_kriteria'][0]['kode_kriteria']);die();
		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_analisa_kriteria' ,$data);

	}
	
	public function tambah_perbandingan()
	{
		$matrik = array();
		$urut 	= 0;
		// $n = 6;
		$n = count($this->model_data->ambil_data_kriteria('data_kriteria'));
		// var_dump($n);die();
		$data['jumlah_n'] = $n;
		$data['data_kriteria'] = $this->model_data->data('kode_kriteria','data_kriteria');
		$data['data_kriteria1'] = $this->model_data->data('kode_kriteria','data_kriteria');
		$data['data_kriteria2'] = $this->model_data->data('kode_kriteria','data_kriteria');
		
		// looping hitung matrik awal
		for ($x=0; $x <= ($n-2) ; $x++) {
			for ($y=($x+1); $y <= ($n-1) ; $y++) {
				$urut++;
				$pilih	= $this->input->post('penting'.$urut);				
				$bobot 	= $this->input->post('nilai'.$urut);
				if ($pilih == 1) {
					$matrik[$x][$y] = $bobot;
					$matrik[$y][$x] = 1 / $bobot;
				} else {
					$matrik[$x][$y] = 1 / $bobot;
					$matrik[$y][$x] = $bobot;
				}
			}
		}

		// diagonal --> bernilai 1
		for ($i = 0; $i <= ($n-1); $i++) {
			$matrik[$i][$i] = 1;
		}

		// inisialisasi jumlah tiap kolom dan baris kriteria
		$jmlmnk = array();
		$jmlmpb = array();
		$jmlkp = array();
		for ($i=0; $i <= ($n-1); $i++) {
			$jmlmpb[$i] = 0;
			$jmlmnk[$i] = 0;
			$jmlkp[$i] = 0;
		}

		// menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
		for ($x=0; $x <= ($n-1) ; $x++) {
			for ($y=0; $y <= ($n-1) ; $y++) {
				$value		= $matrik[$x][$y];
				$jmlmpb[$y] += $value;
			}
		}

		$data_awal = array();
		for ($x=0; $x <= ($n-1); $x++) { 
			for ($y=0; $y <= ($n-1); $y++) { 
				$data_awal[$x][$y] = round($matrik[$x][$y],5);
			}
		}
		$data['awal'] = $data_awal;
		

		for ($i=0; $i <= ($n-1); $i++) { 
			$data_jumlah[$i] = round($jmlmpb[$i],5);
		}
		$data['jumlah'] = $data_jumlah;

		//inilisasi
		for ($x=0; $x <= ($n-1) ; $x++) {
			for ($y=0; $y <= ($n-1) ; $y++) {
				$value		= $matrik[$x][$y];
				$jmlmpb[$y] += $value;
			}
		}
		
		
		//hapus
		//matrikb=matrik bobot
		for ($x=0; $x <= ($n-1) ; $x++) {
			for ($y=0; $y <= ($n-1) ; $y++) {
				$matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
				$value	= $matrikb[$x][$y];
				$jmlmnk[$x] += $value;
			}
			$pv[$x]	 = $jmlmnk[$x] / $n;
			$where = array(			
				'status' => 0			
			);
			$this->model_data->delete_data($where,'kriteria_bobot');
		}

		//tambah
		for ($x=0; $x <= ($n-1) ; $x++) {
			for ($y=0; $y <= ($n-1) ; $y++) {
				$matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
				$value	= $matrikb[$x][$y];
				$jmlmnk[$x] += $value;
			}
			$pv[$x]	 = $jmlmnk[$x] / $n;
			$data_insert = array(
				'nilai_bobot'  => $pv[$x],
				'status' => 0			
			);
			$this->model_data->insert($data_insert,'kriteria_bobot');
		}

		for ($x=0; $x <= ($n-1) ; $x++) {
			for ($y=0; $y <= ($n-1) ; $y++) {
				$matrikp[$x][$y] = $matrik[$x][$y] * $pv[$y];
				$value	= $matrikp[$x][$y];
				$jmlkp[$x] += $value;
			}			
		}

		$nilai = 0;
		for($x=0; $x<$n; $x++){
			$lamda[$x] = $jmlkp[$x] / $pv[$x];
			$nilai = $nilai + $lamda[$x];
		}
		
		$nilai = $nilai/$n;
		$ir = 1.24;
		$ci = ($nilai-$n)/($n-1);
		//dibawah 0.01 konsiSten , diatas  tidak konsisten
		$cr = $ci/$ir;
			

		$data['jmlmnk'] = $jmlmnk;
		$data['jmlkp'] = $jmlkp;
		$data['matrikb'] = $matrikb;
		$data['matrikp'] = $matrikp;
		$data['pv'] = $pv;
		$data['nilai'] = $nilai;
		$data['ci'] = $ci;
		$data['cr'] = $cr;
		

		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_ahp_proses' ,$data );
	}


	//kriteria
	public function data_kriteria()
	{
		$data['data_kriteria'] = $this->model_data->data('kode_kriteria','data_kriteria');
		$n = count($this->model_data->ambil_data_kriteria('data_kriteria'));
		// var_dump($n);die();
		$data['jumlah_n'] = $n + 1;	

		if($this->session->flashdata('pesan_error') != 0)
		{
			$data['pesan_error'] = $this->session->flashdata('pesan_error');
		}
		else
		{
			$data['pesan_error'] = 0;
		}

		// print($data['data_longlist'][0]['kode_longlist']);die();
		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_data_kriteria' ,$data);

	}

	public function tampil_tambah_kriteria()
	{

		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_tambah_data_kriteria' );		
	}

	public function tambah_data_kriteria()
	{
		$this->form_validation->set_rules('kode_kriteria', 'Kode Kriteria', 'is_unique[data_kriteria.kode_kriteria]|required|min_length[2]');
		if($this->form_validation->run() == false )
		{
			$this->session->set_flashdata('kode_kriteria', form_error('kode_kriteria'));
			redirect('c_admin/tampil_tambah_kriteria');	
		}
		else
		{
			$kode_kriteria = $this->input->post('kode_kriteria');		
			$nama_kriteria = $this->input->post('nama_kriteria');
		
			$data_insert = array(
				'kode_kriteria'  => $kode_kriteria,
				'nama_kriteria'  => $nama_kriteria
			);
			$this->model_data->insert($data_insert,'data_kriteria');
			$this->session->set_flashdata('success','Berhasil Menambah Data');
			redirect('c_admin/data_kriteria');
		}
	}

	public function hapus_data_kriteria()
	{
		$id_kriteria = $this->input->get('id_kriteria');
		$where = array(            
            'id_kriteria' =>  $id_kriteria
        );
		$cek = $this->model_data->cek_data_kriteria($id_kriteria);

		if(!empty($cek))
		{
			$pesan_error = 1;
						
			$this->session->set_flashdata('pesan_error',$pesan_error);
			redirect('c_admin/data_kriteria');
		}
		else
		{
			$this->model_data->delete_data($where,'data_kriteria');
			$pesan_error  = 2;
			$this->session->set_flashdata('pesan_error',$pesan_error);
			redirect('c_admin/data_kriteria');			
		}	    
	}

	public function tampil_edit_data_kriteria()
	{
		$id_kriteria = $this->input->get('id_kriteria');
		$where = array(            
            'id_kriteria' =>  $id_kriteria
        );

        $data['data_kriteria'] = $this->model_data->pilih_data($where ,'data_kriteria');
        // print($data['data_kriteria'][0]['kode_kriteria']);die();

        $this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		
		$this->load->view('admin/v_edit_data_kriteria' ,$data);

	}

	public function edit_data_kriteria()
	{
		$id_kriteria_get = $this->input->get('id_kriteria');
		$this->form_validation->set_rules('kode_kriteria', 'Kode Kriteria', 'callback_check_kode_kriteria|required|min_length[2]');
		if($this->form_validation->run() == false )
		{
			$this->session->set_flashdata('kode_kriteria', form_error('kode_kriteria'));
			redirect('c_admin/tampil_edit_data_kriteria?id_kriteria='.$id_kriteria_get.'');	
		}
		else
		{
			$id_kriteria = $this->input->get('id_kriteria');
			$kode_kriteria = $this->input->post('kode_kriteria');		
			$nama_kriteria = $this->input->post('nama_kriteria');
		
			$where = array(
				'id_kriteria' => $id_kriteria
			);
			$data = array(
				'kode_kriteria'  => $kode_kriteria,
				'nama_kriteria'  => $nama_kriteria
			);
			$this->model_data->edit_data($where,$data,'data_kriteria');
			$this->session->set_flashdata('success','Penyimpanan Data Berhasil ');
			redirect('c_admin/data_kriteria	');		
		}		
	}
	function check_kode_kriteria($kode_kriteria) {        
		if($this->input->post('id_kriteria'))
			$id_kriteria = $this->input->post('id_kriteria');
		else
			$id_kriteria = '';
			$result = $this->model_data->check_unique_kode_kriteria($id_kriteria, $kode_kriteria);
		if($result == 0)
			$response = true;
		else {
			$this->form_validation->set_message('check_kode_kriteria', 'Kode Kriteria must be unique');
			$response = false;
		}
		return $response;
	}

	
	//SUB KRITERIA
	public function data_subkriteria()
	{
		$data['data_subkriteria'] = $this->model_data->data_subkriteria('data_subkriteria');
		
		if($this->session->flashdata('pesan_error') != 0)
		{
			$data['pesan_error'] = $this->session->flashdata('pesan_error');
		}
		else
		{
			$data['pesan_error'] = 0;
		}

		// print($data['data_longlist'][0]['kode_longlist']);die();
		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		
		$this->load->view('admin/v_data_subkriteria' ,$data);

	}

	public function tampil_tambah_subkriteria()
	{
		$ambil_data['data_kriteria'] = $this->model_data->data('kode_kriteria','data_kriteria');

		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_tambah_data_subkriteria'  , $ambil_data);		
	}

	public function tambah_subkriteria()
	{
		$this->form_validation->set_rules('kode_subkriteria', 'Kode Sub Kriteria', 'is_unique[data_subkriteria.kode_subkriteria]|required|min_length[3]');
		if($this->form_validation->run() == false )
		{
			$this->session->set_flashdata('kode_subkriteria', form_error('kode_subkriteria'));
			redirect('c_admin/tampil_tambah_subkriteria');	
		}
		else
		{
			$list_id_kriteria = $this->input->post('list_id_kriteria',true);		
			$kode_subkriteria = $this->input->post('kode_subkriteria',true);		
			$nama_subkriteria = $this->input->post('nama_subkriteria',true);
			$nilai_subkriteria = $this->input->post('nilai_subkriteria',true);
			
			$data_insert = array(
				'id_kriteria' => $list_id_kriteria,
				'kode_subkriteria'  => $kode_subkriteria,
				'nama_subkriteria'  => $nama_subkriteria,
				'nilai_subkriteria' => $nilai_subkriteria
			);

			$this->model_data->insert($data_insert,'data_subkriteria');
			redirect('c_admin/data_subkriteria');	
		}	
	}

	public function hapus_data_subkriteria()
	{
		$id_subkriteria = $this->input->get('id_subkriteria');
		$where = array(            
            'id_subkriteria' =>  $id_subkriteria
        );
		$cek = $this->model_data->cek_data_subkriteria($id_subkriteria);

		if(!empty($cek))
		{
			$pesan_error = 1;
						
			$this->session->set_flashdata('pesan_error',$pesan_error);
			redirect('c_admin/data_subkriteria');
		}
		else
		{
			$this->model_data->delete_data($where,'data_subkriteria');
			$pesan_error  = 2;
			$this->session->set_flashdata('pesan_error',$pesan_error);
			
			redirect('c_admin/data_subkriteria');
		}				   	   
	}
 
	public function tampil_edit_data_subkriteria()
	{
		$id_subkriteria = $this->input->get('id_subkriteria');
		$where = array(            
            'id_subkriteria' =>  $id_subkriteria
        );
        
        $data['data_subkriteria'] = $this->model_data->data_subkriteria_where($where);
        $data['data_kriteria'] = $this->model_data->data('kode_kriteria','data_kriteria');
        // print($data['data_kriteria'][0]['kode_kriteria']);die();

        $this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_edit_data_subkriteria' ,$data);

	}

	public function edit_data_subkriteria()
	{
		$id_subkriteria_get = $this->input->get('id_subkriteria');
		$this->form_validation->set_rules('kode_subkriteria', 'Kode Sub Kriteria', 'callback_check_kode_subkriteria|required|min_length[3]');
		if($this->form_validation->run() == false )
		{
			$this->session->set_flashdata('kode_subkriteria', form_error('kode_subkriteria'));
			redirect('c_admin/tampil_edit_data_subkriteria?id_subkriteria='.$id_subkriteria_get.'');	
		}
		else
		{
			$id_subkriteria = $this->input->get('id_subkriteria');
			$list_id_kriteria = $this->input->post('list_id_kriteria');		
			$kode_subkriteria = $this->input->post('kode_subkriteria');		
			$nama_subkriteria = $this->input->post('nama_subkriteria');
			$nilai_subkriteria = $this->input->post('nilai_subkriteria');
			
			$where = array(
				'id_subkriteria' => $id_subkriteria
			);

			$data = array(
				'id_kriteria' => $list_id_kriteria,
				'kode_subkriteria'  => $kode_subkriteria,
				'nama_subkriteria'  => $nama_subkriteria,
				'nilai_subkriteria' => $nilai_subkriteria
			);
			$this->model_data->edit_data($where,$data,'data_subkriteria');
			$this->session->set_flashdata('success','Berhasil Mengedit Data ');
			redirect('c_admin/data_subkriteria	');	
		}		
	}
	
	function check_kode_subkriteria($kode_subkriteria) {        
		if($this->input->post('id_subkriteria'))
			$id_subkriteria = $this->input->post('id_subkriteria');
		else
			$id_subkriteria = '';
			$result = $this->model_data->check_unique_kode_subkriteria($id_subkriteria, $kode_subkriteria);
		if($result == 0)
			$response = true;
		else {
			$this->form_validation->set_message('check_kode_subkriteria', 'Kode Sub Kriteria must be unique');
			$response = false;
		}
		return $response;
	}

	// DATA SURVEI ADMIN
	public function data_survey_lapangan()
	{
		
		$kriteria = $this->model_data->ambil_data_kriteria('data_kriteria');
		$tampil_data_lapangan = $this->model_data->tampil_data_lapangan();
		
		$data_kriteria=[];
		$data_alternatif_lengkap=[];
		$data_alternatif_nama=[];
		$data_alternatif_lengkap_nik=[];

		foreach($tampil_data_lapangan as $key => $value){
			$data_alternatif_lengkap[$key] = ($value['nik_alternatif']."-".$value['nama_alternatif']."-".$value['nama_dusun']);
			$data_alternatif_nama[$key]= $value['nama_alternatif'];
			$data_alternatif_lengkap_nik[$key] = ($value['nik_alternatif']."-".$value['nama_alternatif']);
		}
			
		foreach($tampil_data_lapangan as $key => $tampil_data_lapangan){	
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
			$data['data_alternatif_nama'] = null;
			$data['data_alternatif_nik']= null;
		}

		// print($data['data_longlist'][0]['kode_longlist']);die();
		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_data_survei_longlist_admin' ,$data);
	}

	// DATA HASIL LAPORAN	
	public function data_hasil_laporan()
	{	
		//data tidak paten
		$kriteria = $this->model_data->ambil_data_kriteria('data_kriteria');
		$tampil_data_lapangan = $this->model_data->tampil_data_lapangan();
		$lapangan = $this->model_data->count_data_lapangan(); 
		$i=0;
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
	
		// print_r($data);x	
		$data['total_kriteria']= count($kriteria);
		$data['kriteria']= $kriteria;
		$data['lapangan']= $lapangan;
		
		foreach($lapangan as $key => $lap){
			
			if($lap["total_sub"] < count($kriteria)){
				$i++;
				// var_dump($lap);die();
			}
		}
		$data['i']= $i;
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
		
		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_data_hasil_laporan_admin' ,$data);
	}

	// DATA HASIL MFEP
	public function data_hitung_mfep()
	{	
		//data tidak paten
		$kriteria = $this->model_data->ambil_data_kriteria('data_kriteria');
		$tampil_data_lapangan = $this->model_data->tampil_data_lapangan();
		$lapangan = $this->model_data->count_data_lapangan(); 
		$i=0;
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
		$data['lapangan']= $lapangan;
		
		foreach($lapangan as $key => $lap){
			
			if($lap["total_sub"] < count($kriteria)){
				$i++;
				// var_dump($lap);die();
			}
		}
		$data['i']= $i;

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
		
		$this->load->view('admin/v_side_bar');
		$this->load->view('admin/v_navbar');
		$this->load->view('admin/v_data_hitung_mfep' ,$data);
	}
}
?>