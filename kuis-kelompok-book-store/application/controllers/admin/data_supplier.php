<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Data_supplier extends CI_controller{
    public function __construct()
	{
		parent::__construct();
        if (!$this->session->userdata('id_kasir')) {
			redirect('../');
		}
		
		$this->load->library('session');
        $this->load->model('model_supplier');
	}
    public function index()
    {
        $data['supplier'] = $this->model_supplier->tampil_data()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/data_supplier', $data);
        $this->load->view('templates_admin/footer');
    }
    public function tambah_aksi()
    {


        
        $nama      = $this->input->post('nama');
        $np       = $this->input->post('np');
       
        $nope         = $this->input->post('nope');
       
       
        $u = uniqid();
        $data = array (
            'id_supplier'    => $u,
            'nama_supplier'  => $nama,
            'nama_perusahaan'           => $np,
            'no_hp' => $nope
            
        );

        $this->model_supplier->tambah_supplier($data, 'supplier');

        redirect('admin/data_supplier/index');
    }
  
    public function update(){
        $namae      = $this->input->post('namae');
        $npe       = $this->input->post('npe');
       $ide = $this->input->post('ide');
        $nopee         = $this->input->post('nopee');

      
            $data = array (
                'nama_supplier'  => $namae,
                'nama_perusahaan'           => $npe,
                'no_hp'    => $nopee
            );
    
            $where = array(
                'id_supplier' => $ide
            );
            $this->model_supplier->update_data($where,$data,'supplier');
            redirect('admin/data_supplier/index');
       
    }
    public function hapus ($id){
        $where = array('id_supplier' => $id);
        $this->model_supplier->hapus_data($where, 'supplier');
        redirect('admin/data_supplier/index');
    }
}