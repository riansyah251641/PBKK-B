<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Data_konsumen extends CI_controller{
    public function __construct()
	{
		parent::__construct();
        if (!$this->session->userdata('id_kasir')) {
			redirect('../');
		}
		
		$this->load->library('session');
        $this->load->model('model_konsumen');
	}
    public function index()
    {
        $data['member'] = $this->model_konsumen->tampil_data()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/data_konsumen', $data);
        $this->load->view('templates_admin/footer');
    }
    public function tambah_aksi()
    {

       
            $config ['upload_path'] = './upload/member/';
            $config ['allowed_types'] = 'jpg|jpeg|png|gif';

            $config['encrypt_name']			= TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('foto');

            $data['nama_berkas'] = $this->upload->data("file_name");
            $nama_f = $data['nama_berkas'];
        
        
        $nama      = $this->input->post('nama');
        $jk     = $this->input->post('jk');
        $user       = $this->input->post('user');
        $pw          = $this->input->post('pw');
        $alamat           = $this->input->post('alamat');
        $nope         = $this->input->post('nope');
       
       
        $u = uniqid();
        $data = array (
            'kd_konsumen'    => $u,
            'nama_konsumen'  => $nama,
            'jk'           => $jk,
            'usernamem'    => $user,
            'passwordm'    => password_hash($pw, PASSWORD_BCRYPT),
            'alamat'       => $alamat,
            'no_hp'        => $nope,
            'foto'         => $nama_f
        );

        $this->model_konsumen->tambah_konsumen($data, 'konsumen');

        redirect('admin/data_konsumen/index');
    }
  
    public function update(){
        $ide    =  $this->input->post('ide');
        $namae      = $this->input->post('namae');
        $jke     = $this->input->post('jke');
        $usere      = $this->input->post('usere');
        $pwe          = $this->input->post('pwe');
        $alamate           = $this->input->post('alamate');
        $nopee         = $this->input->post('nopee');

        if(empty($pwe)){
            $data = array (
                'nama_konsumen'  => $namae,
                'jk'           => $jke,
                'username'    => $usere,
                'alamat'       => $alamate,
                'no_hp'        => $nopee,
            );
    
            $where = array(
                'kd_konsumen' => $ide
            );
            $this->model_konsumen->update_data($where,$data,'konsumen');
            redirect('admin/data_konsumen/index');
        }else{

        $data = array (
            'nama_konsumen'  => $namae,
            'jk'           => $jke,
            'username'    => $usere,
            'password'    => password_hash($pwe, PASSWORD_BCRYPT),
            'alamat'       => $alamate,
            'no_hp'        => $nopee,
        );

        $where = array(
            'kd_konsumen' => $ide
        );
        $this->model_konsumen->update_data($where,$data,'konsumen');
        redirect('admin/data_konsumen/index');
        }
    }
    public function hapus ($id){
        $where = array('kd_konsumen' => $id);
        $this->model_konsumenr->hapus_data($where, 'konsumen');
        redirect('admin/data_konsumen/index');
    }
}