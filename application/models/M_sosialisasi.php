<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sosialisasi extends CI_Model {

   //ambil jumlah kunjungan sebuah site
   public function ambil_jumlah_kunjungan($id_lokasi_sosialisasi){
      return $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_sosialisasi', array('id_lokasi' => $id_lokasi_sosialisasi))->num_rows();
     }

   //ambil tanggal kunjungan terbaru sebuah site
   public function tanggal_kunjungan_terbaru($id_lokasi_sosialisasi)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_sosialisasi', array('id_lokasi' => $id_lokasi_sosialisasi))->row();
      if (isset($data))
                     {
        return $data->tanggal;
       
         }
   }

   //ambil rekomendasi terbaru site tertentu
   public function rekomendasi_kunjungan_terbaru($id_sosialisasi)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_sosialisasi', array('id_sosialisasi' => $id_sosialisasi))->row();
      if (isset($data))
                     {
        return $data;
       
         }
   }

   //ambil kerusakan terbaru site tertentu
   public function kerusakan_kunjungan_terbaru($id_sosialisasi)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_sosialisasi', array('id_sosialisasi' => $id_sosialisasi))->row();
      if (isset($data))
                     {
        return $data;
       
         }
   }

   //ambil kondisi kunjungan terbaru site tertentu
   public function kondisi_kunjungan_terbaru($id_sosialisasi)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_sosialisasi', array('id_sosialisasi' => $id_sosialisasi))->row();
      if (isset($data))
                     {
        return $data->kondisi;
       
         }
   }
   
   //ambil jumlah sosialisasi
   public function jumlah_sosialisasi(){
      return $this->db->get('tbl_sosialisasi')->num_rows();
      
      
      // return $this->db->get_where('tbl_kunjungan_sosialisasi', array('id_sosialisasi' => $id_sosialisasi))->num_rows();
     }

   //ambil jumlah off
     public function jumlah_off(){
      return $this->db->get_where('tbl_sosialisasi', array('kondisi_terkini' => 'OFF'))->num_rows();

     
     }

     //ambil jumlah on
     public function jumlah_on(){
      return $this->db->get_where('tbl_sosialisasi', array('kondisi_terkini' => 'ON'))->num_rows();

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
      $this->db->from('tbl_lokasi_sosialisasi');
      $this->db->order_by('kabupaten', 'DESC');
      return $this->db->get()->result();
      
      
   }

   //megambil data berdasarkan id lokasi
   public function detail_sosialisasi($id_lokasi_sosialisasi)  
   {
      return $this->db->get_where('tbl_lokasi_sosialisasi', array('id_lokasi' => $id_lokasi_sosialisasi))->row();
   }

   //update sosialisasi
   public function update($data,$id)
   {
      $this->db->where('id_lokasi', $id);
      $this->db->update('tbl_lokasi_sosialisasi', $data);
   }

   //delete sosialisasi
   public function delete($id){
      $this->db->where('id_lokasi', $id);
      $this->db->delete('tbl_lokasi_sosialisasi');
      // $this->db->where('id_sosialisasi', $id);
      // $this->db->delete('tbl_kunjungan_sosialisasi');
   }


   //mengambil list data kunjungan
   public function allDataKunjungan(){
      $this->db->select('*');
      $this->db->from('tbl_kunjungan_sosialisasi');
      $this->db->join('tbl_lokasi_sosialisasi', 'tbl_lokasi_sosialisasi.id_lokasi = tbl_kunjungan_sosialisasi.id_lokasi', 'left');
      $this->db->order_by('tanggal', 'DESC');
      
      return $this->db->get()->result();
      }

   //menambil kunjungan site tertentu
   public function kunjungan_site_tertentu($id_sosialisasi){
      $this->db->select('*');
      $this->db->from('tbl_kunjungan_sosialisasi');
      
      $this->db->join('tbl_lokasi_sosialisasi', 'tbl_lokasi_sosialisasi.id_lokasi = tbl_kunjungan_sosialisasi.id_lokasi', 'left');
      $this->db->where('nama_lokasi', $id_sosialisasi);
      $this->db->order_by('tanggal', 'DESC');
      
      return $this->db->get()->result();
      }

   //mengambil data detail kunjungan
   public function detail_kunjungan($id)  
   {
      return $this->db->get_where('tbl_kunjungan_sosialisasi', array('id_kunjungan' => $id))->row();
   }

   //update data kunjungan
   public function update_kunjungan($data, $id)
   {
      $this->db->where('id_kunjungan', $id);
      $this->db->update('tbl_kunjungan_sosialisasi', $data);
   }

   //delete kunjungan
   public function delete_kunjungan($id){
      $this->db->where('id_kunjungan', $id);
      $this->db->delete('tbl_kunjungan_sosialisasi');
   }

   //update kondisi terkini
   public function update_kondisi_terkini_2($kode, $kondisi_terkini){
      // $this->db->from('tbl_sosialisasi');
      // $this->db->where_in('kode', $kode);
      // $this->db->set('kondisi_terkini', $kondisi_terkini);
      // $this->db->insert('tbl_sosialisasi');
      // $this->db->update('tbl_sosialisasi', $kondisi_terkini);
      $this->db->where('kode', $kode);
      $this->db->set('kondisi_terkini', $kondisi_terkini);
      $this->db->update('tbl_sosialisasi'); 
   }

     //ambil nama author laporan kunjungan
     public function detail_user($id)  
     {
        return $this->db->get_where('users', array('id' => $id))->row();
     }


}

/* End of file M_lokasi.php */