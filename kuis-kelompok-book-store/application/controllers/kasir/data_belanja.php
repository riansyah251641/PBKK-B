<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Data_belanja extends CI_controller{
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
        $this->load->model('model_belanja');
        $this->load->model('model_supplier');
        $this->load->model('model_barang');
	}
    public function index()
    {   
        $data['sup'] = $this->model_supplier->tampil_data()->result();
        $data['belanja'] = $this->model_belanja->tampil_data()->result();
        $this->load->view('templates_kasir/header');
        $this->load->view('templates_kasir/sidebar');
        $this->load->view('kasir/data_belanja', $data);
        $this->load->view('templates_kasir/footer');
    }
    public function tambah_aksi()
    {

        $config ['upload_path'] = './upload/book/';
        $config ['allowed_types'] = 'jpg|jpeg|png|gif';

        $config['encrypt_name']			= TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('foto');

        $data['nama_berkas'] = $this->upload->data("file_name");
        $nama_f = $data['nama_berkas'];
        
        $nama       = $this->input->post('nama');
        $jb         = $this->input->post('jb');
        $tgl        = $this->input->post('tgl');
        $pj         = $this->input->post('pj');
        $sup        = $this->input->post('sup');
       
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

        $data = array (
            'id_belanja'     => $u,
            'img'            => $nama_f,
            'nama_barangb'   => $nama,
            'tgl_belanja'    => $tgl,
            'id_kasir'    => $pj,
            'id_supplier'    => $sup,
            'jumlah_belanja' => $jb
            
        );
        //$uu = uniqid();
            $data2 = array (
                'id_brg'    => $u,
                'nama_brg'  => $nama,
                'stok'      => $jb,
                'gambar'    => $nama_f,
                'qrcode'    => $image_name
            );
        
        $this->model_barang->tambah_barang($data2, 'tb_barang');
        $this->model_belanja->tambah_belanja($data, 'belanja_stok');

        redirect('kasir/data_belanja/index');
    }
  
    public function update(){
        $ide        = $this->input->post('ide');
        $nama       = $this->input->post('namae');
        $jb         = $this->input->post('jbe');
        $tgl        = $this->input->post('tgle');
        $pj         = $this->input->post('pje');
        $sup        = $this->input->post('supe');
        $img        = $this->input->post('imge');

 
            $data = array (
          
                'nama_barangb'   => $nama,
                'tgl_belanja'    => $tgl,
                'id_kasir'    => $pj,
                'id_supplier'    => $sup,
                'jumlah_belanja' => $jb
                
            );
            $uu = uniqid();
            $data2 = array (
                'id_brg'    => $uu,
                'nama_brg'  => $nama,
                'stok'      => $jb,
                'gambar'    => $img
            );
            $where = array(
                'id_belanja' => $ide
            );
            $this->model_barang->tambah_barang($data2, 'tb_barang');
            $this->model_belanja->update_data($where,$data,'belanja_stok');
            redirect('kasir/data_belanja/index');
       
    }
    public function hapus ($id){
        $where = array('id_belanja' => $id);
        $this->model_belanja->hapus_data($where, 'belanja_stok');
        redirect('kasir/data_belanja/index');
    }
}