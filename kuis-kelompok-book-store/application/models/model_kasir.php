<?php

class Model_kasir extends CI_Model{
    public function tampil_data(){
        return $this->db->get('kasir');
    }
    public function tambah_kasir($data,$table){
        $this->db->insert($table,$data);
    }
    public function edit_kasir($where,$table){
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