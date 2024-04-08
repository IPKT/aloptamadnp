<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Sosialisasi extends CI_Model {
   //simpan data ke database
   public function input($data){
    $this->db->insert('tbl_sosialisasi', $data);
    
   }
   
   //mengambil semua data dari tabel
   public function allData(){
      $this->db->select('*');
      $this->db->from('tbl_lokasi_sosialisasi');
      return $this->db->get()->result();
      
      
   }

   public function detail($id_lokasi)  
   {
      return $this->db->get_where('tbl_sosialisasi', array('id_lokasi' => $id_lokasi))->row();
   }

   public function update($data,$id)
   {
      $this->db->where('id_lokasi', $id);
      $this->db->update('tbl_sosialisasi', $data);
   }
   public function delete($id_lokasi){
      $this->db->where('id_lokasi', $id_lokasi);
      $this->db->delete('tbl_sosialisasi');
   }

}