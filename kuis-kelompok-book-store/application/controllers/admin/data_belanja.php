<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Data_belanja extends CI_controller{
    public function __construct()
	{
		parent::__construct();
        if (!$this->session->userdata('id_kasir')) {
			redirect('../');
		}
		
		$this->load->library('session');
        $this->load->model('model_belanja');
        $this->load->model('model_supplier');
        $this->load->model('model_barang');
	}
    public function index()
    {   
        $data['brg'] = $this->model_barang->tampil_data()->result();
        $data['sup'] = $this->model_supplier->tampil_data()->result();
        $data['belanja'] = $this->model_belanja->tampil_data()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/data_belanja', $data);
        $this->load->view('templates_admin/footer');
    }
    function tb_stokk()
    {
        $idx = $this->input->post('idx');
        $jk =   $this->input->post('jk');
        $stk = $this->input->post('stk');
        $ha = $stk+$jk;
        $nm = $this->input->post('nm');
        $img =  $this->input->post('img');
        $tgl = $this->input->post('tgl_belanja');
        $idk = $this->input->post('id_kasir');
        $sup = $this->input->post('sup');
        $harga_beli = $this->input->post('harga_beli');

        $d = array(
            'id_belanja'    => uniqid(),
            'nama_barangb'  => $nm,
            'img'   =>  $img,
            'tgl_belanja'   => $tgl,
            'id_kasir'      =>  $idk,
            'id_supplier'   => $sup,  
            'jumlah_belanja'=> $jk,
            'harga_beli'    =>$harga_beli
            
        );
        $data = array(
            'stok' => $ha,
        );

        $we= array('id_buku' => $idx);
        $this->model_barang->update_data($we , $data , 'tb_buku');
        $this->model_belanja->tambah_belanja($d , 'belanja_stok');
        echo "<script>alert('Sukses Tambah Stok');location='../data_belanja'</script>";
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
        $hb         = $this->input->post('hb');
        
        $z=$this->db->query("SELECT * FROM supplier WHERE id_supplier='$sup'")->row_array();
        $sp = $z['nama_penerbit'];
       
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
            'jumlah_belanja' => $jb,
            'harga_beli'     => $hb
            
        );
        //$uu = uniqid();
            $data2 = array (
                'id_buku'    => $u,
                'judul_buku'  => $nama,
                'nama_penerbit'=> $sp,
                'harga_stok'   => $hb,
                'stok'      => $jb,
                'gambar'    => $nama_f,
                'qrcode'    => $image_name
            );
        
        $this->model_barang->tambah_barang($data2, 'tb_buku');
        $this->model_belanja->tambah_belanja($data, 'belanja_stok');

        redirect('admin/data_belanja/index');
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
                'id_buku'    => $uu,
                'judul_buku'  => $nama,
                'stok'      => $jb,
                'gambar'    => $img
            );
            $where = array(
                'id_belanja' => $ide
            );
            $this->model_barang->tambah_barang($data2, 'tb_buku');
            $this->model_belanja->update_data($where,$data,'belanja_stok');
            redirect('admin/data_belanja/index');
       
    }
    public function hapus ($id){
        $where = array('id_belanja' => $id);
        $this->model_belanja->hapus_data($where, 'belanja_stok');
        redirect('admin/data_belanja/index');
    }
}