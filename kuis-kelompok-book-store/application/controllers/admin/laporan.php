<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Laporan extends CI_controller{
    public function __construct()
	{
		parent::__construct();
        if (!$this->session->userdata('id_kasir')) {
			redirect('../');
		}
		
		$this->load->library('session');
        $this->load->model('model_belanja');
        $this->load->model('model_trade');
        $this->load->model('model_barang');
	}

    function laporan_belanja()
    {
       
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/pil_b');
        $this->load->view('templates_admin/footer');
    }
    function cetak_belanja()
    {
        $bln = $this->input->post('bln');
        $th = $this->input->post('th');
        $this->db->where("MONTH(tgl_belanja)",$bln);
        $this->db->where("YEAR(tgl_belanja)",$th);
        $data['belanja'] = $this->model_belanja->tampil_data()->result();
        if(empty($data['belanja'])){
            echo"<script>alert('Data laporan untuk bulan dan tahun terpilih tidak ada');location='laporan_belanja'</script>";
        }else{
        $this->load->view('admin/lpb',$data);
        }
    }
    function laporan_penjualan()
    {
        
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/pil_p');
        $this->load->view('templates_admin/footer');

    }
    function cetak_penjualan()
    {   
        $bln = $this->input->post('bln');
        $th = $this->input->post('th');
        $this->db->where("MONTH(tgl_belanja)",$bln);
        $this->db->where("YEAR(tgl_belanja)",$th);
        $data['belanja'] = $this->model_belanja->tampil_data()->result();


        $this->load->model('model_transaksi');
        $bln = $this->input->post('bln');
        $th = $this->input->post('th');
        $this->db->where("MONTH(transaksi.tgl_belii)",$bln);
        $this->db->where("YEAR(transaksi.tgl_belii)",$th);
        $data['trade'] = $this->model_transaksi->tampil_data()->result();
        if(empty($data['trade'])){
            echo"<script>alert('Data laporan untuk bulan dan tahun terpilih tidak ada');location='laporan_penjualan'</script>";
        }else{
        $this->load->view('admin/lpp',$data);
        }
    }
}