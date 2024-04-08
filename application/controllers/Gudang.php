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
         );
         $this->load->view('v_template',$data,false);
     }

     public function input_page_barang()
     {
         $data = array(
             'judul' => 'Input Barang ',
             'page' => 'gudang/v_input_barang',
            //  'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
 
         );
         $this->load->view('v_template',$data,false);
     }












     public function aloptama($jenis_aloptama)
     {
         $data = array(
             'judul' => 'Pemetaan Lokasi '.$jenis_aloptama,
             'page' => 'metadata/v_aloptama',
             'jenis_aloptama' => $jenis_aloptama,
             'aloptama' => $this->m_aloptama->allData($jenis_aloptama),
         );
         $this->load->view('v_template',$data,false);
     }

    //  public function detail_metadata1($jenis_aloptama, $id_aloptama)
    //  {
    //      $data = array(
    //          'judul' => 'Detail Metadata '.$jenis_aloptama,
    //          'page' => 'metadata/v_detail_metadata',
    //          'jenis_aloptama' => $jenis_aloptama,
    //          'hardware' => $this->m_metadata->detail_metadata($jenis_aloptama, $id_aloptama),
    //      );
    //      $this->load->view('v_template',$data,false);
    //  }


    //  public function detail_metadata2($jenis_aloptama, $id_aloptama)
    //  {
    //      $data = array(
    //          'judul' => 'Detail Metadata '.$jenis_aloptama,
    //          'page' => 'metadata/v_detail_metadata2',
    //          'jenis_aloptama' => $jenis_aloptama,
    //          'hardware' => $this->m_metadata->detail_metadata($jenis_aloptama, $id_aloptama),
    //          'jenis_hardware' => $this->m_metadata->jenis_hardware_yang_ada(),
    //          'id_aloptama' => $id_aloptama
    //      );
    //      $this->load->view('v_template',$data,false);
    //  }

    //  public function detail_metadata3($jenis_aloptama, $id_aloptama)
    //  {
    //      $data = array(
    //          'judul' => 'Detail Metadata '.$jenis_aloptama,
    //          'page' => 'metadata/v_detail_metadata3',
    //          'jenis_aloptama' => $jenis_aloptama,
    //          'hardware' => $this->m_metadata->detail_metadata($jenis_aloptama, $id_aloptama),
    //          'jenis_hardware' => $this->m_metadata->jenis_hardware_yang_ada(),
    //          'id_aloptama' => $id_aloptama
    //      );
    //      $this->load->view('v_template',$data,false);
    //  }

    //  public function detail_metadata($jenis_aloptama, $id_aloptama)
    //  {
    //      $data = array(
    //          'judul' => 'Detail Metadata '.$jenis_aloptama,
    //          'page' => 'metadata/v_detail_metadata',
    //          'jenis_aloptama' => $jenis_aloptama,
    //          'hardware' => $this->m_metadata->detail_metadata($jenis_aloptama, $id_aloptama),
    //          'jenis_hardware' => $this->m_metadata->jenis_hardware_yang_ada(),
    //          'id_aloptama' => $id_aloptama
    //      );
    //      $this->load->view('v_template',$data,false);
    //  }

     public function input_page($jenis_aloptama)
     {
         $data = array(
             'judul' => 'Input Metadata Hardware '.$jenis_aloptama,
             'page' => 'metadata/v_input_metadata',
             'jenis_aloptama' => $jenis_aloptama,
             'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
 
         );
         $this->load->view('v_template',$data,false);
     }

    //  input metadata hardware
     public function input($jenis_aloptama)
    {
        $this->form_validation->set_rules('jenis_hardware', 'Jenis Hardware', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('merk', 'Merk', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('tipe', 'Tipe', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
      
        // $this->form_validation->set_rules('tanggal_pemasangan', 'Tanggal Pemasangan', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));


        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Input Metadata Hardware'.$jenis_aloptama,
                'page' => 'metadata/v_input_metadata',
                'jenis_aloptama' => $jenis_aloptama,
                'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'id_aloptama' => $this->input->post('id_aloptama'),
                'jenis_aloptama' => $jenis_aloptama,
                'jenis_hardware' => $this->input->post('jenis_hardware'),
                'merk' => $this->input->post('merk'),
                'tipe' => $this->input->post('tipe'),
                'sn' => $this->input->post('sn'),
                'tanggal_pemasangan' => $this->input->post('tanggal_pemasangan'),
                'sumber' => $this->input->post('sumber')
             
            );

            $this->m_metadata->input_metadata($data,'hardware_aloptama');
            $this->session->set_flashdata('pesan', "Data Hardware $jenis_aloptama berhasil Disimpan !!");
            redirect('metadata/input_page/'.$jenis_aloptama);
        }
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