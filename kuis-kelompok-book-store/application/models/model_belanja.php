<?php

class Model_belanja extends CI_Model{
    public function tampil_data(){
         $this->db->from('belanja_stok');
         $this->db->join('kasir','belanja_stok.id_kasir=kasir.id_kasir','left');
         $this->db->join('supplier','belanja_stok.id_supplier=supplier.id_supplier','left');
        

         return $this->db->get();
    }

    public function tambah_belanja($data,$table){
        $this->db->insert($table,$data);
    }
    public function edit_belanja($where,$table){
        return $this->db->get_where($table,$where);
    }
    public function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    public function hapus_data($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function find($id){
        $result = $this->db->where('id_buku', $id)
                            ->limit(1)
                            ->get('tb_buku');
        if($result->num_rows() > 0){
            return $result->row();
        }else{
            return array();
        }
    }
}