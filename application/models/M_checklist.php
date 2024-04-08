<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_checklist extends CI_Model {


    public function input($data,$tabel){
        $this->db->insert($tabel, $data);
    }
    public function allData($tabel,$orderby){
        $this->db->select('*');
        $this->db->from($tabel)->order_by($orderby, 'ASC');
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



//    
// 
// 



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