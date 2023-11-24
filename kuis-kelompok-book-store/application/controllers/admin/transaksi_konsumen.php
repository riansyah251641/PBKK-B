<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaksi_konsumen extends CI_controller{
    public function __construct()
	{
		parent::__construct();
        if (!$this->session->userdata('id_kasir')) {
			redirect('../');
		}
		
		$this->load->library('session');
        $this->load->model('model_belanja');
        $this->load->model('model_kasir');
        $this->load->model('model_supplier');
        $this->load->model('model_barang');
        $this->load->model('model_transaksi');
	}
    public function index()
    {   
        
        $data['trade'] = $this->model_transaksi->tampil_data()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/transaksi_konsumen', $data);
        $this->load->view('templates_admin/footer');
    }
    public function tambah_aksi()
    {

        
        $namak       = $this->input->post('namak');
        $namab      = $this->input->post('namab');
        $jb         = $this->input->post('jb');
        $tb        = $this->input->post('tb');
        $ks         = $this->input->post('ks');
       
        $u = uniqid();
        $data = array (
            'id_transaksi'     => $u,
            'id_buku'            => $namab,
            'id_kasir'   => $ks,
            'id_konsumen'    => $namak,
            'tgl_pembelian'    => $tb,
            'jumlah_beli'    => $jb
            
        );
        
        
        $this->model_transaksi->tambah_trade($data, 'transaksi_konsumen');

        redirect('admin/transaksi_konsumen/index');
    }
  
    public function update(){
        $namak       = $this->input->post('namak');
        $namab      = $this->input->post('namab');
        $jb         = $this->input->post('jb');
        $tb        = $this->input->post('tb');
        $ks         = $this->input->post('ks');

 
            $data = array (
          
                'id_buku'            => $namab,
            'id_kasir'   => $ks,
            'id_konsumen'    => $namak,
            'tgl_pembelian'    => $tb,
            'jumlah_beli'    => $jb
                
            );
           
            $this->model_belanja->update_data($where,$data,'transaksi_konsumen');
            redirect('admin/transaksi_konsumen/index');
       
    }
    public function hapus ($id){
        $where = array('id_transaksi' => $id);
        $this->model_transaksi->hapus_data($where, 'transaksi_konsumen');
        redirect('admin/transaksi_konsumen/index');
    }
}