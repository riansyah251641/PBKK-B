<?php

class Model_trade extends CI_Model
{
    public function tampil_data()
    {
        $this->db->from('transaksi');
        $this->db->join('detail_beli','transaksi.id_transaksi=detail_beli.id_transaksi');
        $this->db->join('tb_buku', 'detail_beli.id_buku=tb_buku.id_buku', 'left');
        $this->db->join('konsumen', 'transaksi.id_konsumen=konsumen.kd_konsumen', 'left');
        $this->db->join('kasir', 'transaksi.id_kasir=kasir.id_kasir', 'left');


        return $this->db->get();
    }
    function riwayat_kon()
    {
        $this->db->from('transaksi');

        $this->db->join('konsumen', 'transaksi.id_konsumen=konsumen.kd_konsumen', 'left');

        return $this->db->get();
    }
    public function count_trade()
    {
        return $this->db->get('transaksi');
        
    }

    public function tambah_trade($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function edit_trade($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function find($id)
    {
        $result = $this->db->where('id_buku', $id)
            ->limit(1)
            ->get('tb_buku');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }

    public function tampil_barang()
    {
        return $this->db->get('tb_buku')->result();
    }

    public function search($keyword)
    {
        $this->db->like('id_buku', $keyword);


        $result = $this->db->get('tb_buku')->result();
        return $result;
    }
}
