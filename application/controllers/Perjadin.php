<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perjadin extends CI_Controller {

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
             'judul' => 'List Perjadin Stageof Denpasar',
             'page' => 'perjadin/v_list_perjadin',
            //  'list_barang' =>$this->m_gudang->allData('tbl_list_barang', 'jenis_barang')
         );
         $this->load->view('v_template',$data,false);
     }


     //input page barang masuk
     public function input_page()
     {
         $data = array(
             'judul' => 'Input Perjadin',
             'page' => 'perjadin/v_input_perjadin',
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
                'kondisi' => $this->input->post('kondisi'),
                'catatan_masuk' => $this->input->post('catatan_masuk')
             
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
            // $this->form_validation->set_rules('catatan_keluar', 'Catatan', 'required', array(
            //     'required' => '%s Wajib Diisi !'
            // ));
    
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
                    'petugas' => $this->input->post('petugas'),
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
            'judul' => 'List Barang Keluar',
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



    //Edit Page Barang
    public function edit_page_barang($id)
    {
        $data = array(
            'judul' => 'Edit Barang',
            'page' => 'gudang/v_edit_barang',
            'barang' => $this->m_gudang->detail_barang($id),
            'id_barang' => $id

        );
        $this->load->view('v_template',$data,false);
    }


    //  edit barang
    public function update($id_barang)
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
                'judul' => 'Edit Barang',
                'page' => 'gudang/v_edit_barang',
                'barang' => $this->m_gudang->detail_barang($id_barang),
                'id_barang' => $id_barang
    
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
                'kondisi' => $this->input->post('kondisi'),
                'catatan_masuk' => $this->input->post('catatan_masuk')
             
            );
            $jenis_barang = $this->input->post('jenis_barang');

            $this->m_gudang->update('tbl_list_barang' , $data , $id_barang);
            $this->session->set_flashdata('pesan', "Data Barang berupa  $jenis_barang berhasil diupdate !!");
            redirect('gudang/');
        }
    }

    // delete list barang

    public function delete($id_barang, $jenis_barang){
        $this->m_gudang->delete('tbl_list_barang',$id_barang);
        $this->session->set_flashdata('pesan', "Data Barang berupa  $jenis_barang berhasil dihapus !!");
        redirect('gudang/');
    }






    public function intensity()
     {
         $data = array(
             'judul' => 'Daftar Barang Intensitymeter Realshake',
             'page' => 'gudang/v_list_barang',
             'list_barang'=>$this->m_gudang->barangBerdasarkanJenis('tbl_list_barang', 'Intensity Realshake')
         );
         $this->load->view('v_template',$data,false);
     }

     public function accelero()
     {
         $data = array(
             'judul' => 'Daftar Barang Accelero NonColo',
             'page' => 'gudang/v_list_barang',
             'list_barang'=>$this->m_gudang->barangBerdasarkanJenis('tbl_list_barang', 'Accelero')
         );
         $this->load->view('v_template',$data,false);
     }

     public function seismo()
     {
         $data = array(
             'judul' => 'Daftar Barang Seismometer',
             'page' => 'gudang/v_list_barang',
             'list_barang'=>$this->m_gudang->barangBerdasarkanJenis('tbl_list_barang', 'Seismo')
         );
         $this->load->view('v_template',$data,false);
     }

     public function int_reis()
     {
         $data = array(
             'judul' => 'Daftar Barang Intensity Reis',
             'page' => 'gudang/v_list_barang',
             'list_barang'=>$this->m_gudang->barangBerdasarkanJenis('tbl_list_barang', 'Intensity Reis')
         );
         $this->load->view('v_template',$data,false);
     }
     public function wrs()
     {
         $data = array(
             'judul' => 'Daftar Barang WRS',
             'page' => 'gudang/v_list_barang',
             'list_barang'=>$this->m_gudang->barangBerdasarkanJenis('tbl_list_barang', 'WRS')
         );
         $this->load->view('v_template',$data,false);
     }
     public function peralatan_kantor()
     {
         $data = array(
             'judul' => 'Daftar Barang Peralatan Kantor',
             'page' => 'gudang/v_list_barang',
             'list_barang'=>$this->m_gudang->barangBerdasarkanJenis('tbl_list_barang', 'Peralatan Kantor')
         );
         $this->load->view('v_template',$data,false);
     }


}