<?php
class Dashboard_admin extends CI_Controller{
    public function __construct()
	{
		parent::__construct();
    if (!$this->session->userdata('id_kasir')) {
        redirect('../');
    }
    $this->load->model('model_trade');
    $this->load->model('model_konsumen');
    $this->load->model('model_kasir');
    $this->load->model('model_trade');
}
    public function index()
    {
        $w = $this->session->userdata('id_kasir');
        $this->db->where('id_kasir=',$w);
        $data['kasi'] = $this->model_kasir->tampil_data()->result();
       
        $data['kons'] = $this->model_konsumen->tampil_data()->result();
        $data['duit'] = $this->model_trade->tampil_data()->result();
       
        $this->db->where('nama_kasir !=','Admin');
        $data['kas'] = $this->model_kasir->tampil_data()->result();

        $data['tr'] = $this->model_trade->count_trade()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates_admin/footer');
    }
}