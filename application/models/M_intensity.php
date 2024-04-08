<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_intensity extends CI_Model {
   //simpan data ke database
   public function input($data,$tabel){
    $this->db->insert($tabel, $data);
    
   }
   
   
   //mengambil semua data dari tabel
   public function allData(){
      $this->db->select('*');
      $this->db->from('tbl_intensity')->order_by('kode', 'ASC');
      return $this->db->get()->result();
      
      
   }

   public function detail_intensity($id_intensity)  
   {
      return $this->db->get_where('tbl_intensity', array('id_intensity' => $id_intensity))->row();
   }

   public function detail_intensity_bykode($kode)  
   {
      return $this->db->get_where('tbl_intensity', array('kode' => $kode))->row();
   }

   public function allDataKunjungan(){
    $this->db->select('*');
    $this->db->from('tbl_kunjungan_intensity');
    $this->db->join('tbl_intensity', 'tbl_intensity.id_intensity = tbl_kunjungan_intensity.id_intensity', 'left');
    $this->db->order_by('tanggal', 'DESC');
    
    return $this->db->get()->result();
    }

    public function kondisi_kunjungan_terbaru($id_intensity)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_intensity', array('id_intensity' => $id_intensity))->row();
      if (isset($data))
                     {
        return $data->kondisi;
       
         }
   }
   public function tanggal_kunjungan_terbaru($id_intensity)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_intensity', array('id_intensity' => $id_intensity))->row();
      if (isset($data))
                     {
        return $data->tanggal;
       
         }
   }

   public function ambil_jumlah_kunjungan($id_intensity){
      $where = "tanggal >= '2024-01-01' AND id_intensity = $id_intensity";
       // return $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_intensity', array('id_intensity' => $id_intensity, year('tanggal') => '2024')->num_rows();
      return $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_intensity',$where)->num_rows();
   }

   public function rekomendasi_kunjungan_terbaru($id_intensity)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_intensity', array('id_intensity' => $id_intensity))->row();
      if (isset($data))
                     {
        return $data;
       
         }
   }

   public function kerusakan_kunjungan_terbaru($id_intensity)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_intensity', array('id_intensity' => $id_intensity))->row();
      if (isset($data))
                     {
        return $data;
       
         }
   }

   public function kunjungan_site_tertentu($id_intensity){
      $this->db->select('*');
      $this->db->from('tbl_kunjungan_intensity');
      
      $this->db->join('tbl_intensity', 'tbl_intensity.id_intensity = tbl_kunjungan_intensity.id_intensity', 'left');
      $this->db->where('kode', $id_intensity);
      $this->db->order_by('tanggal', 'DESC');
      
      return $this->db->get()->result();
      }



      public function update_kondisi_terkini($kodes, $kondisi_terkini){
         // $this->db->from('tbl_intensity');
         // $this->db->where_in('kode', $kode);
         // $this->db->set('kondisi_terkini', $kondisi_terkini);
         // $this->db->insert('tbl_intensity');
         // $this->db->update('tbl_intensity', $kondisi_terkini);
         $no = 0;
         foreach($kodes as $kode){
            $this->db->where('kode', $kode);
            $this->db->set('kondisi_terkini', $kondisi_terkini[$no]);
            $this->db->update('tbl_intensity');
            $no++;
         }

         return 0;
         
      }

      public function update_kondisi_terkini_2($kode, $kondisi_terkini){
         // $this->db->from('tbl_intensity');
         // $this->db->where_in('kode', $kode);
         // $this->db->set('kondisi_terkini', $kondisi_terkini);
         // $this->db->insert('tbl_intensity');
         // $this->db->update('tbl_intensity', $kondisi_terkini);
         $this->db->where('kode', $kode);
         $this->db->set('kondisi_terkini', $kondisi_terkini);
         $this->db->update('tbl_intensity'); 
      }

      public function delete($id){
         $this->db->where('id_intensity', $id);
         $this->db->delete('tbl_intensity');
         $this->db->where('id_intensity', $id);
         $this->db->delete('tbl_kunjungan_intensity');
      }

      public function update($data,$id)
      {
         $this->db->where('id_intensity', $id);
         $this->db->update('tbl_intensity', $data);
      }

      public function delete_kunjungan($id){
         $this->db->where('id_kunjungan', $id);
         $this->db->delete('tbl_kunjungan_intensity');
      }
      
      public function detail_kunjungan($id)  
   {
      return $this->db->get_where('tbl_kunjungan_intensity', array('id_kunjungan' => $id))->row();
   }

   public function jumlah_intensity(){
      return $this->db->get('tbl_intensity')->num_rows();
      
      
      // return $this->db->get_where('tbl_kunjungan_intensity', array('id_intensity' => $id_intensity))->num_rows();
     }

     public function jumlah_off(){
      return $this->db->get_where('tbl_intensity', array('kondisi_terkini' => 'OFF'))->num_rows();

     
     }
     
     public function jumlah_on(){
      return $this->db->get_where('tbl_intensity', array('kondisi_terkini' => 'ON'))->num_rows();

     }

     public function update_kunjungan($data, $id)
     {
        $this->db->where('id_kunjungan', $id);
        $this->db->update('tbl_kunjungan_intensity', $data);
     }
   
     //ambil jumlah total kunjungan
     public function total_kunjungan(){
      
      $this->db->select('*');
      $this->db->from('tbl_kunjungan_intensity');
      $this->db->where("tanggal >= '2024-01-01'")->order_by('id_kunjungan', 'ASC');
      return $this->db->get()->num_rows();
     }

       //ambil nama author laporan kunjungan
   public function detail_user($id)  
   {
      return $this->db->get_where('users', array('id' => $id))->row();
   }

}