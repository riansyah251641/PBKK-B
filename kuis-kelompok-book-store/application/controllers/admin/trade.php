<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Trade extends CI_controller
{
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
        $this->load->model('model_trade');
    }
    public function index()
    {
        $this->db->where('transaksi.bayar=','-');
        $data['trade'] = $this->model_trade->tampil_data()->result();
        $data['tempe'] = $this->model_trade->tampil_barang();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/trade', $data);
       // $this->load->view('admin/tabel_barang', $data);
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
        $data = array(
            'id_transaksi'     => $u,
            'id_buku'            => $namab,
            'id_kasir'   => $ks,
            'id_konsumen'    => $namak,
            'tgl_pembelian'    => $tb,
            'jumlah_beli'    => $jb

        );


        $this->model_transaksi->tambah_trade($data, 'transaksi_konsumen');

        redirect('admin/trade/index');
    }
    
    function tb_temp()
    {
        $id_buku=$this->input->post('id_buku');
        $jum=$this->input->post('jum');
        $id_k=$this->input->post('id_k');
        $tgl=$this->input->post('tgl');
        $t=$this->input->post('tot')*$jum;
        $kdd = $this->input->post('kdd');
        $par = $this->input->post('par');

        $z=$this->db->query("SELECT * FROM transaksi WHERE id_transaksi='$par'")->row_array();
        if(empty($z)){

        $dt = $this->db->query("SELECT * FROM tb_buku WHERE id_buku = '$id_buku'")->row_array();

        $h=$dt['stok']-$jum;

            $uz = uniqid();
            $data = array(
                'id_transaksi'       => $kdd,
                
                'id_kasir'      => $id_k,
                'tgl_belii'     => $tgl,
                'bayar'          => '-'
            );
            $data2 = array(
                'id_detail'     => $uz,
                'id_buku'        => $id_buku,
                'jumlah_belii'  => $jum,
                'total'         => $t,
                'id_transaksi'       => $kdd,
            );
            $datau = array(
                'stok' => $h
            );

            $wr = array('id_buku' => $id_buku);
            $this->model_trade->tambah_trade($data, 'transaksi');
            $this->model_trade->tambah_trade($data2, 'detail_beli');
            $this->model_trade->update_data($wr , $datau , 'tb_buku');
    
            redirect('../admin/trade');

        }else{

        $isi = $z['id_transaksi'];
        $dt = $this->db->query("SELECT * FROM tb_buku WHERE id_buku = '$id_buku'")->row_array();

        $h=$dt['stok']-$jum;
       

        $uz = uniqid();
     
        $data2 = array(
            'id_detail'     => $uz,
            'id_buku'        => $id_buku,
            'jumlah_belii'  => $jum,
            'total'         => $t,
            'id_transaksi'       => $isi,
        );
        $datau = array(
            'stok' => $h
        );
        $wr = array('id_buku' => $id_buku);
        $this->model_trade->tambah_trade($data2, 'detail_beli');
        $this->model_trade->update_data($wr , $datau , 'tb_buku');


        redirect('../admin/trade');
    }
}

function tb_nota()
{
   
    $kdd = $this->input->post('kdd');
    $by=$this->input->post('by');
    $kb=$this->input->post('kb');
    $id_kon = $this->input->post('id_kon');

  

   
       // $uz = uniqid();
        $data = array(
            'id_konsumen' => $id_kon,
            'bayar'       => $by,
            'bukti'       => '-'
            
        );
       

       $wt = array('id_transaksi' => $kdd);
        $this->model_trade->update_data($wt,$data,'transaksi');

        redirect('../admin/trade/print_nota/'.$kdd.'/'.$by.'/'.$kb);

  
}

    // public function update()
    // {
    //     $namak       = $this->input->post('namak');
    //     $namab      = $this->input->post('namab');
    //     $jb         = $this->input->post('jb');
    //     $tb        = $this->input->post('tb');
    //     $ks         = $this->input->post('ks');


    //     $data = array(

    //         'id_buku'            => $namab,
    //         'id_kasir'   => $ks,
    //         'id_konsumen'    => $namak,
    //         'tgl_pembelian'    => $tb,
    //         'jumlah_beli'    => $jb

    //     );

    //     $this->model_belanja->update_data($where, $data, 'transaksi_konsumen');
    //     redirect('admin/transaksi_konsumen/index');
    // }
    public function hapus($id)
    {
        
        $where = array('id_detail' => $id);
        $z=$this->db->query("SELECT * FROM detail_beli WHERE id_detail = '$id'")->row_array();
        $z1=$this->db->query("SELECT * FROM tb_buku WHERE id_buku = '$z[id_buku]'")->row_array();
        $hh = $z['jumlah_belii']+$z1['stok'];

        $ww=array('id_buku' => $z['id_buku']);
        $dataa=array('stok' => $hh);

        $this->model_trade->update_data($ww,$dataa,'tb_buku');
        $this->model_trade->hapus_data($where, 'detail_beli');
        redirect('../admin/trade');
    }
    public function hapus_all($id)
    {
        $where = array('id_transaksi' => $id);
        $where2 = array('id_transaksi' => $id);
        $this->model_trade->hapus_data($where, 'transaksi');
        $this->model_trade->hapus_data($where2, 'detail_beli');
        redirect('../admin/trade');
    }

    function print_nota()
    {
        $w = $this->uri->segment(4);
        $this->db->where(array('transaksi.bayar !=' => null));
        $this->db->where('transaksi.id_transaksi=',$w);
        $data['nota'] = $this->model_trade->tampil_data()->result();
        $this->load->view('admin/nota',$data);
    }
}
