<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_int_reis extends CI_Model {

   //ambil jumlah kunjungan sebuah site
   public function ambil_jumlah_kunjungan($id_int_reis){
      return $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_int_reis', array('id_int_reis' => $id_int_reis))->num_rows();
     }

   //ambil tanggal kunjungan terbaru sebuah site
   public function tanggal_kunjungan_terbaru($id_int_reis)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_int_reis', array('id_int_reis' => $id_int_reis))->row();
      if (isset($data))
                     {
        return $data->tanggal;
       
         }
   }

   //ambil rekomendasi terbaru site tertentu
   public function rekomendasi_kunjungan_terbaru($id_int_reis)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_int_reis', array('id_int_reis' => $id_int_reis))->row();
      if (isset($data))
                     {
        return $data;
       
         }
   }

   //ambil kerusakan terbaru site tertentu
   public function kerusakan_kunjungan_terbaru($id_int_reis)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_int_reis', array('id_int_reis' => $id_int_reis))->row();
      if (isset($data))
                     {
        return $data;
       
         }
   }

   //ambil kondisi kunjungan terbaru site tertentu
   public function kondisi_kunjungan_terbaru($id_int_reis)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_int_reis', array('id_int_reis' => $id_int_reis))->row();
      if (isset($data))
                     {
        return $data->kondisi;
       
         }
   }
   
   //ambil jumlah int_reis
   public function jumlah_int_reis(){
      return $this->db->get('tbl_int_reis')->num_rows();
      
      
      // return $this->db->get_where('tbl_kunjungan_int_reis', array('id_int_reis' => $id_int_reis))->num_rows();
     }

   //ambil jumlah off
     public function jumlah_off(){
      return $this->db->get_where('tbl_int_reis', array('kondisi_terkini' => 'OFF'))->num_rows();

     
     }

     //ambil jumlah on
     public function jumlah_on(){
      return $this->db->get_where('tbl_int_reis', array('kondisi_terkini' => 'ON'))->num_rows();

     }

///////////////////////////////////////////////////////////////////////////////////////////////////////

   //simpan data ke database
   public function input($data,$tabel){

   //  $db2 = $this->load->database('database2', TRUE);
   //  $db2->insert($tabel, $data);
    $this->db->insert($tabel, $data);
    
   }
   
   //mengambil semua data dari tabel
   public function allData(){
      $this->db->select('*');
      $this->db->from('tbl_int_reis');
      return $this->db->get()->result();
      
      
   }

   //megambil data berdasarkan id lokasi
   public function detail_int_reis($id_int_reis)  
   {
      return $this->db->get_where('tbl_int_reis', array('id_int_reis' => $id_int_reis))->row();
   }

   //update int_reis
   public function update($data,$id)
   {
      $this->db->where('id_int_reis', $id);
      $this->db->update('tbl_int_reis', $data);
   }

      //delete int_reis
      public function delete($id){
         $this->db->where('id_int_reis', $id);
         $this->db->delete('tbl_int_reis');
         $this->db->where('id_int_reis', $id);
         $this->db->delete('tbl_kunjungan_int_reis');
      }

   //mengambil list data kunjungan
   public function allDataKunjungan(){
      $this->db->select('*');
      $this->db->from('tbl_kunjungan_int_reis');
      $this->db->join('tbl_int_reis', 'tbl_int_reis.id_int_reis = tbl_kunjungan_int_reis.id_int_reis', 'left');
      $this->db->order_by('tanggal', 'DESC');
      
      return $this->db->get()->result();
      }

   //menambil kunjungan site tertentu
   public function kunjungan_site_tertentu($id_int_reis){
      $this->db->select('*');
      $this->db->from('tbl_kunjungan_int_reis');
      
      $this->db->join('tbl_int_reis', 'tbl_int_reis.id_int_reis = tbl_kunjungan_int_reis.id_int_reis', 'left');
      $this->db->where('kode', $id_int_reis);
      $this->db->order_by('tanggal', 'DESC');
      
      return $this->db->get()->result();
      }

   //mengambil data detail kunjungan
   public function detail_kunjungan($id)  
   {
      return $this->db->get_where('tbl_kunjungan_int_reis', array('id_kunjungan' => $id))->row();
   }

   //update data kunjungan
   public function update_kunjungan($data, $id)
   {
      $this->db->where('id_kunjungan', $id);
      $this->db->update('tbl_kunjungan_int_reis', $data);
   }

   //delete kunjungan
   public function delete_kunjungan($id){
      $this->db->where('id_kunjungan', $id);
      $this->db->delete('tbl_kunjungan_int_reis');
   }

   //update kondisi terkini
   public function update_kondisi_terkini_2($kode, $kondisi_terkini){
      // $this->db->from('tbl_int_reis');
      // $this->db->where_in('kode', $kode);
      // $this->db->set('kondisi_terkini', $kondisi_terkini);
      // $this->db->insert('tbl_int_reis');
      // $this->db->update('tbl_int_reis', $kondisi_terkini);
      $this->db->where('kode', $kode);
      $this->db->set('kondisi_terkini', $kondisi_terkini);
      $this->db->update('tbl_int_reis'); 
   }

   public function detail_user($id)  
   {
      return $this->db->get_where('users', array('id' => $id))->row();
   }



}

/* End of file M_lokasi.php */