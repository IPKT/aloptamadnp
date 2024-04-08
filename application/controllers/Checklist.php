<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist extends CI_Controller {

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
         $this->load->model('m_checklist');
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
     public function input_page($jenis)
     {
         $data = array(
             'judul' => 'Cheklist ',
             'page' => 'checklist/v_input_'.$jenis,
            //  'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
 
         );
         $this->load->view('v_template',$data,false);
     }


    //  input barang
     public function input($jenis)
    {
        $this->form_validation->set_rules('petugas', 'Petugas', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        // $this->form_validation->set_rules('jenis_aloptama', 'Jenis Aloptama', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));
        // $this->form_validation->set_rules('sumber', 'Sumber', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));

        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Cheklist ',
                'page' => 'checklist/v_input_'.$jenis,
               //  'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
    
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'petugas' => $this->input->post('petugas'),
                'tanggal' => $this->input->post('tanggal'),
                'hillman' => $this->input->post('hillman')
             
            );

            $this->m_checklist->input($data,'tbl_'.$jenis);
            $this->session->set_flashdata('pesan', "Data checklist $jenis berhasil Disimpan !!");
            redirect("checklist/input_page/$jenis");
        }
    }

    //verifikasi keluarkan barang
    public function verifikasi_keluar($id)
    {
        $data = array(
            'judul' => 'Verifikasi Barang Keluar ',
            'page' => 'gudang/v_verifikasi_keluar',
            'barang' => $this->m_gudang->detail_barang($id),
            'id_barang' => $id

        );
        $this->load->view('v_template',$data,false);
    }

        //  keluarkan barang
        public function keluar($id_barang)
        {
            $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required', array(
                'required' => '%s Wajib Diisi !'
            ));
            $this->form_validation->set_rules('tujuan', 'Tujuan', 'required', array(
                'required' => '%s Wajib Diisi !'
            ));
            $this->form_validation->set_rules('catatan_keluar', 'Catatan', 'required', array(
                'required' => '%s Wajib Diisi !'
            ));
    
            if ($this->form_validation->run()==FALSE) {
                $data = array(
                    'judul' => 'Verifikasi Barang Keluar ',
                    'page' => 'gudang/v_verifikasi_keluar',
                    'barang' => $this->m_gudang->detail_barang($id_barang),
                    'id_barang' => $id_barang
        
                );
                $this->load->view('v_template',$data,false);
            }else{
                $barang = $this->m_gudang->detail_barang($id_barang);
                $data = array(
                    'jenis_barang' => $barang->jenis_barang,
                    'jenis_aloptama' => $barang->jenis_aloptama,
                    'tanggal_masuk' => $barang->tanggal_masuk,
                    'merk' => $barang->merk,
                    'tipe' => $barang->tipe,
                    'sn' => $barang->sn,
                    'sumber' => $barang->sumber,
                    'kondisi' => $barang->kondisi,
                    'catatan_masuk' => $barang->catatan_masuk,
                    'tujuan' => $this->input->post('tujuan'),
                    'tanggal_keluar' => $this->input->post('tanggal_keluar'),
                    'catatan_keluar' => $this->input->post('catatan_keluar'),
                    'status' => $this->input->post('status'),
                 
                );
    
                $this->m_gudang->input($data,'tbl_barang_keluar');
                $this->session->set_flashdata('pesan', "Data Barang berupa  $barang->jenis_barang berhasil dikeluarkan !!");
                $this->m_gudang->delete('tbl_list_barang',$id_barang);
            
                redirect('gudang/');
            }
        }

    //Page Barang Keluar
    public function barang_keluar()
    {
        $data = array(
            'judul' => 'Gudang Peralatan Stageof Denpasar',
            'page' => 'gudang/v_list_barang_keluar',
            'list_barang' =>$this->m_gudang->allData('tbl_barang_keluar', 'jenis_barang')
        );
        $this->load->view('v_template',$data,false);
    }


    //Input Kembali barang yang sudah pernah keluar namun hanya sementara
    public function input_kembali($id_barang){
        $barang = $this->m_gudang->detail_barang_keluar($id_barang);
        $data = array(
            'jenis_barang' => $barang->jenis_barang,
            'jenis_aloptama' => $barang->jenis_aloptama,
            'tanggal_masuk' => $barang->tanggal_masuk,
            'merk' => $barang->merk,
            'tipe' => $barang->tipe,
            'sn' => $barang->sn,
            'sumber' => $barang->sumber,
            'kondisi' => $barang->kondisi,
            'catatan_masuk' => $barang->catatan_masuk,
        );
        $this->m_gudang->input($data,'tbl_list_barang');
        $this->session->set_flashdata('pesan', "Data Barang berupa  $barang->jenis_barang berhasil dimasukan kembali !!");  
        $this->m_gudang->delete('tbl_barang_keluar',$id_barang);
        redirect('gudang/');
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