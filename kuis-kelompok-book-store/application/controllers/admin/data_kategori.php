<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Data_kategori extends CI_controller{
    public function __construct()
	{
		parent::__construct();
        if (!$this->session->userdata('id_kasir')) {
			redirect('../');
		}
		
		$this->load->library('session');
        $this->load->model('model_kategori');
	}
    public function index()
    {
        $data['kategori'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/data_kategori', $data);
        $this->load->view('templates_admin/footer');
    }
    public function tambah_aksi()
    {
        $u = uniqid();
        $nama_kat       = $this->input->post('nama_kat');
       
       
        $u = uniqid();
        $data = array (
            'id'        => $u,
            'nama_kategori'      => $nama_kat
            
        );

        $this->model_kategori->tambah_kategori($data, 'kategori');

        redirect('admin/data_kategori/index');
    }

    public function update(){
        $id = $this->input->post('id');
        $nama_kat       = $this->input->post('nama_kat');

        $data = array(
            'nama_kategori'      => $nama_kat
        );

        $where = array(
            'id' => $id
        );
        $this->model_barang->update_data($where,$data,'kategori');
        redirect('admin/data_kategori/index');
    }
    public function hapus ($id){
        $where = array('id' => $id);
        $this->model_barang->hapus_data($where, 'kategori');
        redirect('admin/data_kategori/index');
    }
}