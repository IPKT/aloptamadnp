<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_aloptama extends CI_Model {
   //simpan data ke database
   public function input($data,$tabel){
    $this->db->insert($tabel, $data);
    
   }
   
   
   //mengambil semua data dari tabel
   public function allData($jenis_aloptama){
      $this->db->select('*');
      $this->db->from('tbl_'.$jenis_aloptama)->order_by('kode', 'ASC');
      return $this->db->get()->result();
      
      
   }

   public function detail_aloptama($jenis_aloptama, $id)  
   {
      return $this->db->get_where('tbl_'.$jenis_aloptama, array('id' => $id))->row();
   }

   public function detail_intensity_bykode($kode)  
   {
      return $this->db->get_where('tbl_intensity', array('kode' => $kode))->row();
   }

   public function allDataKunjungan($jenis_aloptama){
    $this->db->select('*');
    $this->db->from('tbl_kunjungan_'.$jenis_aloptama);
    $this->db->join('tbl_'.$jenis_aloptama, "tbl_$jenis_aloptama.id = tbl_kunjungan_$jenis_aloptama.id_$jenis_aloptama", 'left');
    $this->db->order_by('tanggal', 'DESC');
    
    return $this->db->get()->result();
    }

    public function kondisi_kunjungan_terbaru($jenis_aloptama,$id_intensity)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_'.$jenis_aloptama, array('id_'.$jenis_aloptama => $id_intensity))->row();
      if (isset($data))
                     {
        return $data->kondisi;
       
         }
   }
   public function tanggal_kunjungan_terbaru($jenis_aloptama, $id)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_'.$jenis_aloptama, array('id_'.$jenis_aloptama => $id))->row();
      if (isset($data))
                     {
        return $data->tanggal;
       
         }
   }

   public function ambil_jumlah_kunjungan($jenis_aloptama,$id){
      $where = "tanggal >= '2024-01-01' AND id_$jenis_aloptama = $id";
       // return $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_intensity', array('id' => $id_intensity, year('tanggal') => '2024')->num_rows();
      return $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_'.$jenis_aloptama,$where)->num_rows();
   }

   public function rekomendasi_kunjungan_terbaru($jenis_aloptama,$id)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_'.$jenis_aloptama, array('id_'.$jenis_aloptama => $id))->row();
      if (isset($data))
                     {
        return $data;
       
         }
   }

   public function kerusakan_kunjungan_terbaru($jenis_aloptama,$id)  
   {
      $data = $this->db->order_by('tanggal', 'DESC')->get_where('tbl_kunjungan_'.$jenis_aloptama, array('id_'.$jenis_aloptama => $id))->row();
      if (isset($data))
                     {
        return $data;
       
         }
   }

   public function kunjungan_site_tertentu($jenis_aloptama, $kode){
      $this->db->select('*');
      $this->db->from('tbl_kunjungan_'.$jenis_aloptama);
      
      $this->db->join('tbl_'.$jenis_aloptama, "tbl_$jenis_aloptama.id = tbl_kunjungan_$jenis_aloptama.id_$jenis_aloptama", 'left');
      $this->db->where('kode', $kode);
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

      public function delete_aloptama($jenis_aloptama, $id){
         $this->db->where('id', $id);
         $this->db->delete('tbl_'.$jenis_aloptama);
         // $this->db->where('id', $id);
         // $this->db->delete('tbl_kunjungan_'.$jenis_aloptama);
      }

      public function update($jenis_aloptama, $data,$id)
      {
         $this->db->where('id', $id);
         $this->db->update('tbl_'.$jenis_aloptama, $data);
      }

      public function delete_kunjungan($jenis_aloptama , $id){
         $this->db->where('id_kunjungan', $id);
         $this->db->delete('tbl_kunjungan_'.$jenis_aloptama);
      }
      
      public function detail_kunjungan($jenis_aloptama, $id_kunjungan)  
   {
      return $this->db->get_where('tbl_kunjungan_'.$jenis_aloptama, array('id_kunjungan' => $id_kunjungan))->row();
   }

   public function jumlah_aloptama($jenis_aloptama){
      return $this->db->get('tbl_'.$jenis_aloptama)->num_rows();
      
      
      // return $this->db->get_where('tbl_kunjungan_intensity', array('id' => $id_intensity))->num_rows();
     }

     public function jumlah_off($jenis_aloptama){
      return $this->db->get_where('tbl_'.$jenis_aloptama, array('kondisi_terkini' => 'OFF'))->num_rows();

     
     }
     
     public function jumlah_on($jenis_aloptama){
      return $this->db->get_where('tbl_'.$jenis_aloptama, array('kondisi_terkini' => 'ON'))->num_rows();

     }

     public function update_kunjungan($jenis_aloptama , $data, $id)
     {
        $this->db->where('id_kunjungan', $id);
        $this->db->update('tbl_kunjungan_'.$jenis_aloptama, $data);
     }
   
     //ambil jumlah total kunjungan
     public function total_kunjungan($jenis_aloptama){
      
      $this->db->select('*');
      $this->db->from('tbl_kunjungan_'.$jenis_aloptama);
      $this->db->where("tanggal >= '2024-01-01'")->order_by('id_kunjungan', 'ASC');
      return $this->db->get()->num_rows();
     }

       //ambil nama author laporan kunjungan
   public function detail_user($id)  
   {
      return $this->db->get_where('users', array('id' => $id))->row();
   }

}