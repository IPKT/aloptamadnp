<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_seismo extends CI_Model {

   //ambil jumlah kunjungan sebuah site
   public function ambil_jumlah_kunjungan($id_seismo){
      return $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_seismo', array('id_seismo' => $id_seismo))->num_rows();
     }

   //ambil tanggal kunjungan terbaru sebuah site
   public function tanggal_kunjungan_terbaru($id_seismo)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_seismo', array('id_seismo' => $id_seismo))->row();
      if (isset($data))
                     {
        return $data->tanggal;
       
         }
   }

   //ambil rekomendasi terbaru site tertentu
   public function rekomendasi_kunjungan_terbaru($id_seismo)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_seismo', array('id_seismo' => $id_seismo))->row();
      if (isset($data))
                     {
        return $data;
       
         }
   }

   //ambil kerusakan terbaru site tertentu
   public function kerusakan_kunjungan_terbaru($id_seismo)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_seismo', array('id_seismo' => $id_seismo))->row();
      if (isset($data))
                     {
        return $data;
       
         }
   }

   //ambil kondisi kunjungan terbaru site tertentu
   public function kondisi_kunjungan_terbaru($id_seismo)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_seismo', array('id_seismo' => $id_seismo))->row();
      if (isset($data))
                     {
        return $data->kondisi;
       
         }
   }
   
   //ambil jumlah seismo
   public function jumlah_seismo(){
      return $this->db->get('tbl_seismo')->num_rows();
      
      
      // return $this->db->get_where('tbl_kunjungan_seismo', array('id_seismo' => $id_seismo))->num_rows();
     }

   //ambil jumlah off
     public function jumlah_off(){
      return $this->db->get_where('tbl_seismo', array('kondisi_terkini' => 'OFF'))->num_rows();

     
     }

     //ambil jumlah on
     public function jumlah_on(){
      return $this->db->get_where('tbl_seismo', array('kondisi_terkini' => 'ON'))->num_rows();

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
      $this->db->from('tbl_seismo');
      return $this->db->get()->result();
      
      
   }

   //megambil data berdasarkan id lokasi
   public function detail_seismo($id_seismo)  
   {
      return $this->db->get_where('tbl_seismo', array('id_seismo' => $id_seismo))->row();
   }

   //update seismo
   public function update($data,$id)
   {
      $this->db->where('id_seismo', $id);
      $this->db->update('tbl_seismo', $data);
   }

   //delete seismo
   public function delete($id){
      $this->db->where('id_seismo', $id);
      $this->db->delete('tbl_seismo');
      $this->db->where('id_seismo', $id);
      $this->db->delete('tbl_kunjungan_seismo');
   }


   //mengambil list data kunjungan
   public function allDataKunjungan(){
      $this->db->select('*');
      $this->db->from('tbl_kunjungan_seismo');
      $this->db->join('tbl_seismo', 'tbl_seismo.id_seismo = tbl_kunjungan_seismo.id_seismo', 'left');
      $this->db->order_by('tanggal', 'DESC');
      
      return $this->db->get()->result();
      }

   //menambil kunjungan site tertentu
   public function kunjungan_site_tertentu($id_seismo){
      $this->db->select('*');
      $this->db->from('tbl_kunjungan_seismo');
      
      $this->db->join('tbl_seismo', 'tbl_seismo.id_seismo = tbl_kunjungan_seismo.id_seismo', 'left');
      $this->db->where('kode', $id_seismo);
      $this->db->order_by('tanggal', 'DESC');
      
      return $this->db->get()->result();
      }

   //mengambil data detail kunjungan
   public function detail_kunjungan($id)  
   {
      return $this->db->get_where('tbl_kunjungan_seismo', array('id_kunjungan' => $id))->row();
   }

   //update data kunjungan
   public function update_kunjungan($data, $id)
   {
      $this->db->where('id_kunjungan', $id);
      $this->db->update('tbl_kunjungan_seismo', $data);
   }

   //delete kunjungan
   public function delete_kunjungan($id){
      $this->db->where('id_kunjungan', $id);
      $this->db->delete('tbl_kunjungan_seismo');
   }

   //update kondisi terkini
   public function update_kondisi_terkini_2($kode, $kondisi_terkini){
      // $this->db->from('tbl_seismo');
      // $this->db->where_in('kode', $kode);
      // $this->db->set('kondisi_terkini', $kondisi_terkini);
      // $this->db->insert('tbl_seismo');
      // $this->db->update('tbl_seismo', $kondisi_terkini);
      $this->db->where('kode', $kode);
      $this->db->set('kondisi_terkini', $kondisi_terkini);
      $this->db->update('tbl_seismo'); 
   }

     //ambil nama author laporan kunjungan
     public function detail_user($id)  
     {
        return $this->db->get_where('users', array('id' => $id))->row();
     }


}

/* End of file M_lokasi.php */