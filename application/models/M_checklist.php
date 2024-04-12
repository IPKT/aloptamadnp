<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_checklist extends CI_Model {


    public function input($data,$tabel){
        $this->db->insert($tabel, $data);
    }

    public function dataTerbaru($tabel){
        $this->db->select('*');
        $this->db->from($tabel)->order_by('tanggal', 'ASC');
        $this->db->limit(1);
        return $this->db->get()->row();

    }
    public function detail_checklist($tabel,$tanggal,$shift){
        return $this->db->get_where($tabel, array('tanggal' => $tanggal , 'shift'=>$shift))->row();
    }



    public function allData($tabel,$orderby){
        $this->db->select('*');
        $this->db->from($tabel)->order_by($orderby, 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result();
        }
    public function detail_barang($id){
        return $this->db->get_where('tbl_list_barang', array('id' => $id))->row();
    }
    public function delete($tabel, $id){
        $this->db->where('id', $id);
        $this->db->delete($tabel);
     }
     public function detail_barang_keluar($id){
        return $this->db->get_where('tbl_barang_keluar', array('id' => $id))->row();
    }



    public function ambil_aja($input_query){
        $query = $this->db->query($input_query);
        return $query->result();
    }

}