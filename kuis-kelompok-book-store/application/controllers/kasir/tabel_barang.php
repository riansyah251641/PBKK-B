<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tabel_barang extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('level')) {
            redirect('../');
        } else
		if ($this->session->userdata('level') != 'kasir') {
            redirect('../');
        }

        $this->load->library('session');

        $this->load->model('model_trade');
    }
    public function index()
    {

        $data['tempe'] = $this->model_trade->tampil_barang();
        $this->load->view('templates_kasir/header');
        $this->load->view('templates_kasir/sidebar');
        $this->load->view('kasir/tabel_barang', $data);
        $this->load->view('templates_kasir/footer');
    }


    public function search()
    {

        $keyword = $this->input->post('keyword');
        $tempe = $this->model_trade->search($keyword);

        $hasil = $this->load->view('kasir/tabel_barang', array('tempe' => $tempe), true);

        $callback = array(
            'hasil' => $hasil, // Set array hasil dengan isi dari view.php yang diload tadi
        );
        echo json_encode($callback); // konversi varibael $callback menjadi JSON
    }
}
