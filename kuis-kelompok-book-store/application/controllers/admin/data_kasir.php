<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Data_kasir extends CI_controller{
    public function __construct()
	{
		parent::__construct();
        if (!$this->session->userdata('id_kasir')) {
			redirect('../');
		}
		
		$this->load->library('session');
        $this->load->model('model_kasir');
	}
    public function index()
    {
        $data['karyawan'] = $this->model_kasir->tampil_data()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/data_kasir', $data);
        $this->load->view('templates_admin/footer');
    }
    public function tambah_aksi()
    {


        
        $nama      = $this->input->post('nama');
        $alamat       = $this->input->post('alamat');
        $user = $this->input->post('user');
        $pass= $this->input->post('pass');
        $nope         = $this->input->post('nope');
       
       
        $u = uniqid();
        $data = array (
            'id_kasir'    => $u,
            'nama_kasir'  => $nama,
            'username'    => $user,
            'password'    => $pass,
            'alamat'      => $alamat,
            'no_hp'       => $nope
            
        );

        $this->model_kasir->tambah_kasir($data, 'kasir');

        redirect('admin/data_kasir/index');
    }
  
    public function update(){
        $namae      = $this->input->post('namae');
        $alamate       = $this->input->post('alamate');
       $ide = $this->input->post('ide');
        $nopee         = $this->input->post('nopee');
        $user = $this->input->post('user');
        $pass = $this->input->post('pass');

      if(empty($pass)){
            $data = array (
                'nama_kasir'  => $namae,
                'username'     => $user,
                'alamat'           => $alamate,
                'no_hp'    => $nopee
            );
    
            $where = array(
                'id_kasir' => $ide
            );
            $this->model_kasir->update_data($where,$data,'kasir');
            redirect('admin/data_kasir/index');
        }else{
            $data = array (
                'nama_kasir'  => $namae,
                'username'     => $user,
                'password'     => password_hash($pass , PASSWORD_BCRYPT),
                'alamat'           => $alamate,
                'no_hp'    => $nopee
            );
    
            $where = array(
                'id_kasir' => $ide
            );
            $this->model_kasir->update_data($where,$data,'kasir');
            redirect('admin/data_kasir/index');
        }
    }
    public function hapus ($id){
        $where = array('id_kasir' => $id);
        $this->model_kasir->hapus_data($where, 'kasir');
        redirect('admin/data_kasir/index');
    }
}