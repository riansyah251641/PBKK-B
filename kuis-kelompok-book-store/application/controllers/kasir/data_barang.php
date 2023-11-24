<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Data_barang extends CI_controller
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
        $this->load->model('model_kategori');
    }
    public function index()
    {
        $data['barang'] = $this->model_barang->tampil_data()->result();
        $data['kat'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates_kasir/header');
        $this->load->view('templates_kasir/sidebar');
        $this->load->view('kasir/data_barang', $data);
        $this->load->view('templates_kasir/footer');
    }
    public function tambah_aksi()
    {


        $config['upload_path'] = './upload/book/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';

        $config['encrypt_name']            = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('berkas');

        $data['nama_berkas'] = $this->upload->data("file_name");
        $nama_f = $data['nama_berkas'];


        $nama_brg       = $this->input->post('nama_brg');
        $keterangan     = $this->input->post('keterangan');
        $kategori       = $this->input->post('kategori');
        $harga          = $this->input->post('harga');
        $stok           = $this->input->post('stok');
        //$gambar         = $this->input->post('berkas');
        $u = uniqid();
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $u . '.png'; //buat name dari qr code sesuai dengan u

        $params['data'] = $u; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE


        $data = array(
            'id_brg'        => $u,
            'nama_brg'      => $nama_brg,
            'keterangan'    => $keterangan,
            'kategori'      => $kategori,
            'harga'         => $harga,
            'stok'          => $stok,
            'gambar'        => $nama_f,
            'qrcode'        => $image_name
        );

        $this->model_barang->tambah_barang($data, 'tb_barang');

        redirect('kasir/data_barang/index');
    }
    public function edit($id)
    {
        $where = array('id_brg' => $id);
        $data['barang'] = $this->model_barang->edit_barang($where, 'tb_barang')->result();
        $this->load->view('templates_kasir/header');
        $this->load->view('templates_kasir/sidebar');
        $this->load->view('kasir/edit_barang', $data);
        $this->load->view('templates_kasir/footer');
    }
    public function update()
    {
        $id             = $this->input->post('id_brg');
        $nama_brg       = $this->input->post('nama_brg');
        $keterangan     = $this->input->post('keterangan');
        $kategori       = $this->input->post('kategori');
        $harga          = $this->input->post('harga');
        $stok           = $this->input->post('stok');

        $data = array(
            'nama_brg'      => $nama_brg,
            'keterangan'    => $keterangan,
            'kategori'      => $kategori,
            'harga'         => $harga,
            'stok'          => $stok
        );

        $where = array(
            'id_brg' => $id
        );
        $this->model_barang->update_data($where, $data, 'tb_barang');
        redirect('kasir/data_barang/index');
    }
    public function hapus($id)
    {
        $where = array('id_brg' => $id);
        $this->model_barang->hapus_data($where, 'tb_barang');
        redirect('kasir/data_barang/index');
    }
}
