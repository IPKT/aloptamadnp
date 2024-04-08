<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gudang extends CI_Model {
    public function detail_aloptama($jenis_aloptama, $id)  
    {
       return $this->db->get_where('tbl_'.$jenis_aloptama, array('id' => $id))->row();
    }
    public function detail_metadata($jenis_aloptama, $id_aloptama)  
    {
       return $this->db->order_by('jenis_hardware','DESC')->get_where('hardware_aloptama', "jenis_aloptama = '$jenis_aloptama' AND id_aloptama = $id_aloptama")->result();
    }
    public function jenis_hardware_yang_ada(){
        $query = $this->db->query("SELECT jenis_hardware FROM hardware_aloptama");
        return $query->result();
    }
    public function detail_hardware($jenis_aloptama , $jenis_hardware , $id_aloptama){
        $query = $this->db->query("SELECT * FROM hardware_aloptama WHERE jenis_hardware = '$jenis_hardware' AND id_aloptama = '$id_aloptama' AND jenis_aloptama = '$jenis_aloptama' ORDER BY tanggal_pemasangan DESC LIMIT 1");
        return $query->result();
    }

    public function ambil_aja($input_query){
        $query = $this->db->query($input_query);
        return $query->result();
    }

    //simpan data ke database
   public function input_metadata($data,$tabel){
    $this->db->insert($tabel, $data);
    
   }


    

 


}