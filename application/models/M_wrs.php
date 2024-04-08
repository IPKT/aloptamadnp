<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_wrs extends CI_Model {

   //ambil jumlah kunjungan sebuah site
   public function ambil_jumlah_kunjungan($id_wrs){
      return $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_wrs', array('id_wrs' => $id_wrs))->num_rows();
     }

   //ambil tanggal kunjungan terbaru sebuah site
   public function tanggal_kunjungan_terbaru($id_wrs)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_wrs', array('id_wrs' => $id_wrs))->row();
      if (isset($data))
                     {
        return $data->tanggal;
       
         }
   }

   //ambil rekomendasi terbaru site tertentu
   public function rekomendasi_kunjungan_terbaru($id_wrs)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_wrs', array('id_wrs' => $id_wrs))->row();
      if (isset($data))
                     {
        return $data;
       
         }
   }

   //ambil kerusakan terbaru site tertentu
   public function kerusakan_kunjungan_terbaru($id_wrs)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_wrs', array('id_wrs' => $id_wrs))->row();
      if (isset($data))
                     {
        return $data;
       
         }
   }

   //ambil kondisi kunjungan terbaru site tertentu
   public function kondisi_kunjungan_terbaru($id_wrs)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_wrs', array('id_wrs' => $id_wrs))->row();
      if (isset($data))
                     {
        return $data->kondisi;
       
         }
   }
   
   //ambil jumlah wrs
   public function jumlah_wrs(){
      return $this->db->get('tbl_wrs')->num_rows();
      
      
      // return $this->db->get_where('tbl_kunjungan_wrs', array('id_wrs' => $id_wrs))->num_rows();
     }

   //ambil jumlah off
     public function jumlah_off(){
      return $this->db->get_where('tbl_wrs', array('kondisi_terkini' => 'OFF'))->num_rows();

     
     }

     //ambil jumlah on
     public function jumlah_on(){
      return $this->db->get_where('tbl_wrs', array('kondisi_terkini' => 'ON'))->num_rows();

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
      $this->db->from('tbl_wrs');
      return $this->db->get()->result();
      
      
   }

   //megambil data berdasarkan id lokasi
   public function detail_wrs($id_wrs)  
   {
      return $this->db->get_where('tbl_wrs', array('id_wrs' => $id_wrs))->row();
   }

   //update wrs
   public function update($data,$id)
      {
         $this->db->where('id_wrs', $id);
         $this->db->update('tbl_wrs', $data);
      }


   //delete wrs
      public function delete($id){
         $this->db->where('id_wrs', $id);
         $this->db->delete('tbl_wrs');
         $this->db->where('id_wrs', $id);
         $this->db->delete('tbl_kunjungan_wrs');
      }
      
   //mengambil list data kunjungan
   public function allDataKunjungan(){
      $this->db->select('*');
      $this->db->from('tbl_kunjungan_wrs');
      $this->db->join('tbl_wrs', 'tbl_wrs.id_wrs = tbl_kunjungan_wrs.id_wrs', 'left');
      $this->db->order_by('tanggal', 'DESC');
      
      return $this->db->get()->result();
      }

   //menambil kunjungan site tertentu
   public function kunjungan_site_tertentu($nama_wrs){
      $this->db->select('*');
      $this->db->from('tbl_kunjungan_wrs');
      
      $this->db->join('tbl_wrs', 'tbl_wrs.id_wrs = tbl_kunjungan_wrs.id_wrs', 'left');
      $this->db->where('lokasi', $nama_wrs);
      $this->db->order_by('tanggal', 'DESC');
      
      return $this->db->get()->result();
      }

   //mengambil data detail kunjungan
   public function detail_kunjungan($id)  
   {
      return $this->db->get_where('tbl_kunjungan_wrs', array('id_kunjungan' => $id))->row();
   }

   //update data kunjungan
   public function update_kunjungan($data, $id)
   {
      $this->db->where('id_kunjungan', $id);
      $this->db->update('tbl_kunjungan_wrs', $data);
   }

   //delete kunjungan
   public function delete_kunjungan($id){
      $this->db->where('id_kunjungan', $id);
      $this->db->delete('tbl_kunjungan_wrs');
   }

   //update kondisi terkini
   public function update_kondisi_terkini_2($id_wrs, $kondisi_terkini){
      // $this->db->from('tbl_wrs');
      // $this->db->where_in('lokasi', $lokasi);
      // $this->db->set('kondisi_terkini', $kondisi_terkini);
      // $this->db->insert('tbl_wrs');
      // $this->db->update('tbl_wrs', $kondisi_terkini);
      $this->db->where('id_wrs', $id_wrs);
      $this->db->set('kondisi_terkini', $kondisi_terkini);
      $this->db->update('tbl_wrs'); 
   }

     //ambil nama author laporan kunjungan
     public function detail_user($id)  
     {
        return $this->db->get_where('users', array('id' => $id))->row();
     }

}

/* End of file M_lokasi.php */