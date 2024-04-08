<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_lokasi extends CI_Model {
   //simpan data ke database
   public function input($data){
    $this->db->insert('tbl_lokasi', $data);
    
   }
   
   //mengambil semua data dari tabel
   public function allData(){
      $this->db->select('*');
      $this->db->from('tbl_lokasi');
      return $this->db->get()->result();
      
      
   }

   //megambil data berdasarkan id lokasi

   public function detail($id_lokasi)
   {
      return $this->db->get_where('tbl_lokasi', array('id_lokasi' => $id_lokasi))->row();
      // $this->db->from('tbl_lokasi');
      // $this->db->where('id_lokasi', $id_lokasi);
      // return $this->db->get()->result();
      
   }

}

/* End of file M_lokasi.php */
