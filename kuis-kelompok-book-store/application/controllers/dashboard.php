<?php

class Dashboard extends CI_controller{

    public function index()
    {
        $this->load->model('model_kategori');
        $a=$this->uri->segment(2);
        if(empty($a)){
            $this->db->where('tb_buku.keterangan !=','');
            $data['barang'] = $this->model_barang->tampil_data()->result();
       
        }else{
            $this->db->where('tb_buku.kategori=' , $a);
            $this->db->where('tb_buku.keterangan !=','');
            $data['barang'] = $this->model_barang->tampil_data()->result();
        }
        $this->load->model('model_konsumen');
        $k= $this->session->userdata('id_konsumen');
        $this->db->where('konsumen.kd_konsumen=',$k);
        $data['us'] = $this->model_konsumen->tampil_data()->result();
        $data['kat'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar',$data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    
    }
    public function menuu()
    {
        $this->load->model('model_trade');
        $this->load->model('model_kategori');
        $a=$this->uri->segment(2);
        if(empty($a)){
            $this->db->where('tb_buku.keterangan !=','');
            $data['barang'] = $this->model_barang->tampil_data()->result();
       
        }else{
            $this->db->where('tb_buku.kategori=' , $a);
            $this->db->where('tb_buku.keterangan !=','');
            $data['barang'] = $this->model_barang->tampil_data()->result();
        }
        $this->load->model('model_konsumen');
        $k= $this->session->userdata('id_konsumen');
        $this->db->where('konsumen.kd_konsumen=',$k);
        $data['us'] = $this->model_konsumen->tampil_data()->result();
        $data['kat'] = $this->model_kategori->tampil_data()->result();

    
        $this->db->where('transaksi.id_konsumen=',$k);
        $data['riw'] = $this->model_trade->riwayat_kon()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar',$data);
        $this->load->view('riwayat', $data);
        $this->load->view('templates/footer');
    
    }
    public function tambah_ke_keranjang($id){
        $this->load->model('model_trade');
        $st = $this->input->post('st');
        $jb=$this->input->post('jb');
        $barang = $this->model_barang->find($id);
        $data = array(
            'id'      => $barang->id_buku,
            'qty'     => $jb,
            'price'   => $barang->harga,
            'name'    => $barang->judul_buku,
            
    );
    $hasil = $st - $jb;
    $data2 = array(
        'stok' => $hasil
    );
    $wr = array('id_buku' => $barang->id_buku);
    $this->model_trade->update_data($wr , $data2 , 'tb_buku');
    $this->cart->insert($data);
    redirect('dashboard');
    }
    public function detail_keranjang(){
        $this->load->model('model_kategori');
        $a=$this->uri->segment(2);
        if(empty($a)){
            $this->db->where('tb_buku.keterangan !=','');
            $data['barang'] = $this->model_barang->tampil_data()->result();
       
        }else{
            $this->db->where('tb_buku.kategori=' , $a);
            $this->db->where('tb_buku.keterangan !=','');
            $data['barang'] = $this->model_barang->tampil_data()->result();
        }
        $this->load->model('model_konsumen');
        $k= $this->session->userdata('id_konsumen');
        $this->db->where('konsumen.kd_konsumen=',$k);
        $data['us'] = $this->model_konsumen->tampil_data()->result();
        $data['kat'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar',$data);
        $this->load->view('keranjang',$data);
        $this->load->view('templates/footer');
    }
    public function hapus_keranjang(){
        $this->cart->destroy();
        redirect(base_url());
    }
    public function pembayaran(){
        $this->load->model('model_kategori');
        $this->load->model('model_trade');
        $a=$this->uri->segment(2);
        if(empty($a)){
            $this->db->where('tb_buku.keterangan !=','');
            $data['barang'] = $this->model_barang->tampil_data()->result();
       
        }else{
            $this->db->where('tb_buku.kategori=' , $a);
            $this->db->where('tb_buku.keterangan !=','');
            $data['barang'] = $this->model_barang->tampil_data()->result();
        }

        $kdd=$this->input->post('kdd');
        $kon=$this->input->post('id_kon');
        $tgl=$this->input->post('tgl');
        $by=$this->input->post('bayar');
        $id_b = $this->input->post('id_buku');
        $jb=$this->input->post('jb');
        $sub = $this->input->post('sub');

        //$dt = $this->db->query("SELECT * FROM tb_buku WHERE id_buku = '$id_b'")->row_array();

        $data = array(
            'id_transaksi'  => $kdd,
            'id_konsumen'   => $kon,
            'id_kasir'      => '-',
            'tgl_belii'      => $tgl,
            'bayar'         => '-'
        );
        //var_dump($id_b);
        
        $result = array();
        
      	$hitung=0;
          foreach($id_b as $i){
            $u[$hitung] = uniqid();
            array_push($result, array(
            'id_detail' => $u[$hitung],
            'id_buku'    => $i,
            'jumlah_belii'  => $jb[$hitung],
            'total'         => $sub[$hitung],
            'id_transaksi'  => $kdd
            ));
            $hitung++;

        }
        $this->db->insert_batch('detail_beli', $result);
        $this->model_trade->tambah_trade($data,'transaksi');

        $data['idx'] = $kdd;
        $this->load->model('model_konsumen');
        $k= $this->session->userdata('id_konsumen');
        $this->db->where('konsumen.kd_konsumen=',$k);
        $data['us'] = $this->model_konsumen->tampil_data()->result();
        $data['kat'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar',$data);
        $this->load->view('pembayaran',$data);
        $this->load->view('templates/footer');
    }
    public function proses_pesanan(){
        $this->load->model('model_trade');
        $this->load->model('model_kategori');
        $a=$this->uri->segment(2);
        if(empty($a)){
            $this->db->where('tb_buku.keterangan !=','');
            $data['barang'] = $this->model_barang->tampil_data()->result();
       
        }else{
            $this->db->where('tb_buku.kategori=' , $a);
            $this->db->where('tb_buku.keterangan !=','');
            $data['barang'] = $this->model_barang->tampil_data()->result();
        }
        $this->load->model('model_konsumen');
        $k= $this->session->userdata('id_konsumen');
        $this->db->where('konsumen.kd_konsumen=',$k);
        $data['us'] = $this->model_konsumen->tampil_data()->result();
        $data['kat'] = $this->model_kategori->tampil_data()->result();

      
        $param = $this->input->post('param');
        $tot = $this->input->post('tot');
        $met = $this->input->post('mp');
        $kur = $this->input->post('jasa');
        $alamat = $this->input->post('alamat');


        $data = array(
            'alamat_kirim'      => $alamat,
            'bayar' => $tot,
            'metode_pembayaran' =>  $met,
            'kurir'             => $kur
        );

        $wh = array('id_transaksi' => $param);
        $this->model_trade->update_data($wh,$data,'transaksi');

        $this->load->model('model_kategori');
        $a=$this->uri->segment(2);
        if(empty($a)){
            $this->db->where('tb_buku.keterangan !=','');
            $data['barang'] = $this->model_barang->tampil_data()->result();
       
        }else{
            $this->db->where('tb_buku.kategori=' , $a);
            $this->db->where('tb_buku.keterangan !=','');
            $data['barang'] = $this->model_barang->tampil_data()->result();
        }
        $this->load->model('model_konsumen');
        $k= $this->session->userdata('id_konsumen');
        $this->db->where('konsumen.kd_konsumen=',$k);
        $data['us'] = $this->model_konsumen->tampil_data()->result();
        $data['kat'] = $this->model_kategori->tampil_data()->result();

        $this->cart->destroy();
        echo "<script>alert('Terima kasih sudah berbelanja , Silahkan upload Struk pembayaran');location='menuu'</script>";
    }
    function struk()
    {
        $this->load->model('model_trade');
        $config['upload_path'] = './upload/struk/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';

        $config['encrypt_name']            = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('struk');

        $data['nama_berkas'] = $this->upload->data("file_name");
        $nama_f = $data['nama_berkas'];

        $id = $this->input->post('id');

        $data = array(
            'bukti' => $nama_f
        );
        
        $where = array('id_transaksi' => $id);
        $this->model_trade->update_data($where, $data, 'transaksi');
        echo "<script>alert('Struk Pembayaran Berhasil Diupload , Terima kasih');location='menuu'</script>";
    }
}