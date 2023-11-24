<?php
class Dashboard_kasir extends CI_Controller{
    public function __construct()
	{
		parent::__construct();
    if (!$this->session->userdata('level')) {
        redirect('../kasir/kasir');
    } else
    if ($this->session->userdata('level') != 'kasir') {
        redirect('../kasir/kasir');
    }
    $this->load->model('model_kasir');
}
    public function index()
    {
        $w = $this->session->userdata('id_kasir');
        $this->db->where('id_kasir=',$w);
        $data['kas'] = $this->model_kasir->tampil_data()->result();
        $this->load->view('templates_kasir/header');
        $this->load->view('templates_kasir/sidebar');
        $this->load->view('kasir/dashboard',$data);
        $this->load->view('templates_kasir/footer');
    }
}