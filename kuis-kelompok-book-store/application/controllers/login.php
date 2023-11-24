<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_controller{
    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
	}
    public function index()
	{
			$this->form_validation->set_rules('user', 'username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pass', 'password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('login');
		} else {

			$this->login();
		}
	}



	 function login()
	{
		$username = addslashes($this->input->post('user'));
		$password = $this->input->post('pass');

		$auth = $this->db->get_where('kasir', ['username' => $username])->row_array();
        
		if(!empty($auth)){
		if (password_verify($password, $auth['password']) && $auth) {

	
				$sesi = [
					'id_kasir' => $auth['id_kasir'],
					'username' => $auth['username'],
					'nama_kasir' => $auth['nama_kasir'],
					'level' => $auth['level']
				];

				$this->session->set_userdata($sesi);
				redirect('admin/dashboard_admin');
			}
		} else {
			echo "<script>alert('username atau password anda salah');location='../login'</script>";
			//redirect('auth');
		}
	
	}
	function login2()
	{
		$username = addslashes($this->input->post('username'));
		$password = $this->input->post('pw');

		$auth = $this->db->get_where('konsumen', ['username' => $username])->row_array();
        
		
		if (password_verify($password, $auth['password']) && $auth) {
			if ($auth['level'] == 'konsumen') {
				$sesi = [
					'id_konsumen'=> $auth['kd_konsumen'],
					'username' => $auth['username'],
					'level' => $auth['level']
				];

				$this->session->set_userdata($sesi);
				redirect(base_url());
			} else	{

				
				echo "<script>alert('username atau password anda salah');location='../../'</script>";
				
			}
		} else {
			echo "<script>alert('username atau password anda salah');location='../'</script>";
			
		}
	
	}
	function daftar()
	{
		$this->load->model('model_konsumen');
		   
		$config ['upload_path'] = './upload/member/';
		$config ['allowed_types'] = 'jpg|jpeg|png|gif';

		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload('foto');

		$data['nama_berkas'] = $this->upload->data("file_name");
		$nama_f = $data['nama_berkas'];

		$user =  $this->input->post('user');
		$pass = $this->input->post('pass');
		$nama =	$this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$jk =	$this->input->post('jk');
		$nope = $this->input->post('nope');

		$data = array(
			'kd_konsumen'	=> uniqid(),
			'nama_konsumen'	=> $nama,
			'jk'			=> $jk,
			'username'		=> $user,
			'password'		=> password_hash($pass , PASSWORD_BCRYPT),
			'alamat'		=> $alamat,
			'no_hp'			=> $nope,
			'foto'			=> $nama_f,
			'level'			=> 'konsumen'

		);
		$this->model_konsumen->tambah_konsumen($data, 'konsumen');

        redirect(base_url());
	}

	public function logout()
	{
        $this->session->unset_userdata('id_login');
		$this->session->unset_userdata('id_konsumen');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		

		redirect(base_url('dashboard/hapus_keranjang'));
	}
}