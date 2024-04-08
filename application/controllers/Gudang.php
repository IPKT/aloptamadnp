<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	
     public function __construct()
     {
         parent::__construct();
         $this->load->model('m_aloptama');
         $this->load->model('m_metadata');
         $this->load->model('m_gudang');
         if (
         $this->session->userdata('username') == null
         ) {
            redirect('auth');
         }
         
     }

     //Halaman awal
     public function index()
     {
         $data = array(
             'judul' => 'Gudang Peralatan Stageof Denpasar',
             'page' => 'gudang/v_list_barang',
             'list_barang' =>$this->m_gudang->allData('tbl_list_barang', 'jenis_barang')
         );
         $this->load->view('v_template',$data,false);
     }


     //input page barang masuk
     public function input_page()
     {
         $data = array(
             'judul' => 'Input Barang ',
             'page' => 'gudang/v_input_barang',
            //  'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
 
         );
         $this->load->view('v_template',$data,false);
     }


    //  input barang
     public function input()
    {
        $this->form_validation->set_rules('jenis_barang', 'Jenis Barang', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('jenis_aloptama', 'Jenis Aloptama', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('sumber', 'Sumber', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Input Barang ',
                'page' => 'gudang/v_input_barang'    
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'jenis_barang' => $this->input->post('jenis_barang'),
                'jenis_aloptama' => $this->input->post('jenis_aloptama'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                'merk' => $this->input->post('merk'),
                'tipe' => $this->input->post('tipe'),
                'sn' => $this->input->post('sn'),
                'sumber' => $this->input->post('sumber'),
                'status' => $this->input->post('status'),
                'catatan' => $this->input->post('catatan')
             
            );
            $jenis_barang = $this->input->post('jenis_barang');

            $this->m_gudang->input($data,'tbl_list_barang');
            $this->session->set_flashdata('pesan', "Data Barang berupa  $jenis_barang berhasil Disimpan !!");
            redirect('gudang/input_page/');
        }
    }

    //verifikasi keluarkan barang
    public function verifikasi_keluar($id)
    {
        $data = array(
            'judul' => 'Verifikasi Barang yang akan dikeluarkan ',
            'page' => 'gudang/v_verifikasi_keluar',
            'barang' => $this->m_gudang->detail_barang($id),
            'id_barang' => $id

        );
        $this->load->view('v_template',$data,false);
    }





    public function intensity()
     {
         $data = array(
             'judul' => 'Metadata Hardware Intensity',
             'page' => 'metadata/v_metadata',
             'jenis_aloptama' => 'intensity',
            //  'jenis_hardware' => $this->m_metadata->jenis_hardware_yang_ada(),
            //  'id_aloptama' => $id_aloptama
         );
         $this->load->view('v_template',$data,false);
     }

     public function seismo()
     {
         $data = array(
             'judul' => 'Metadata Hardware Seismo',
             'page' => 'metadata/v_metadata',
             'jenis_aloptama' => 'seismo',
            //  'jenis_hardware' => $this->m_metadata->jenis_hardware_yang_ada(),
            //  'id_aloptama' => $id_aloptama
         );
         $this->load->view('v_template',$data,false);
     }

          public function detail_metadata($jenis_aloptama, $id_aloptama, $kode)
     {
         $data = array(
             'judul' => 'Detail Metadata '.$jenis_aloptama.' '.$kode,
             'page' => 'metadata/v_detail_metadata',
             'jenis_aloptama' => $jenis_aloptama,
             'hardware' => $this->m_metadata->detail_metadata($jenis_aloptama, $id_aloptama),
             'jenis_hardware' => $this->m_metadata->jenis_hardware_yang_ada(),
             'kode' => $kode
         );
         $this->load->view('v_template',$data,false);
     }


}