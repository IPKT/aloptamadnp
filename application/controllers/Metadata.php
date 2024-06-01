<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metadata extends CI_Controller {

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
         if (
         $this->session->userdata('username') == null
         ) {
            redirect('auth');
         }
         
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

     public function wrs()
     {
         $data = array(
             'judul' => 'Metadata Hardware WRS',
             'page' => 'metadata/v_metadata',
             'jenis_aloptama' => 'wrs',
            //  'jenis_hardware' => $this->m_metadata->jenis_hardware_yang_ada(),
            //  'id_aloptama' => $id_aloptama
         );
         $this->load->view('v_template',$data,false);
     }

     public function acc_noncolo()
     {
         $data = array(
             'judul' => 'Metadata Hardware ACC Noncolo',
             'page' => 'metadata/v_metadata',
             'jenis_aloptama' => 'acc_noncolo',
            //  'jenis_hardware' => $this->m_metadata->jenis_hardware_yang_ada(),
            //  'id_aloptama' => $id_aloptama
         );
         $this->load->view('v_template',$data,false);
     }

     public function int_reis()
     {
         $data = array(
             'judul' => 'Metadata Hardware Intensity Reis',
             'page' => 'metadata/v_metadata',
             'jenis_aloptama' => 'int_reis',
            //  'jenis_hardware' => $this->m_metadata->jenis_hardware_yang_ada(),
            //  'id_aloptama' => $id_aloptama
         );
         $this->load->view('v_template',$data,false);
     }


          public function detail_metadata($jenis_aloptama, $id_aloptama, $kode)
     {
         $data = array(
             'judul' => 'Detail Metadata '.ucwords($jenis_aloptama).' '.$kode,
             'page' => 'metadata/v_detail_metadata',
             'jenis_aloptama' => $jenis_aloptama,
             'hardware' => $this->m_metadata->detail_metadata($jenis_aloptama, $id_aloptama),
             'jenis_hardware' => $this->m_metadata->jenis_hardware_yang_ada(),
             'kode' => $kode,
             'id_aloptama' => $id_aloptama,
             'aloptama' => $this->m_aloptama->detail_aloptama($jenis_aloptama,$id_aloptama)
         );
         $this->load->view('v_template',$data,false);
     }

     public function edit_hardware($id_hardware, $kode_aloptama)
     {
         $data = array(
             'judul' => 'Edit Hardware ',
             'page' => 'metadata/v_edit_hardware',
             'hardware' => $this->m_metadata->hardware($id_hardware),
             'kode'=>$kode_aloptama,
            //  'jenis_hardware' => $this->m_metadata->jenis_hardware_yang_ada(),
            //  'kode' => $kode
         );
         $this->load->view('v_template',$data,false);
     }

     public function update_hardware($id, $kode_aloptama)
     {
        $this->form_validation->set_rules('jenis_hardware', 'jenis_hardware', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('merk', 'Merk', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        // $this->form_validation->set_rules('lokasi', 'lokasi', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));
      
        // $this->form_validation->set_rules('tipe', 'Tipe', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));


        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Edit Hardware ',
                'page' => 'metadata/v_edit_hardware',
                'hardware' => $this->m_metadata->hardware($id),
                'kode'=>$kode_aloptama,
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'jenis_hardware' => $this->input->post('jenis_hardware'),
                'merk' => $this->input->post('merk'),
                'tipe' => $this->input->post('tipe'),
                'sn' => $this->input->post('sn'),
                'tanggal_pemasangan' => $this->input->post('tanggal_pemasangan'),
                'sumber' => $this->input->post('sumber')
            );
            $id_aloptama = $this->input->post('id_aloptama');
            $jenis_hardware = $this->input->post('jenis_hardware');

            $this->m_metadata->update_hardware($data,$this->input->post('id'));
            $this->session->set_flashdata('pesan', "Data $jenis_hardware Site $kode_aloptama berhasil Diupdate !!");
            redirect("metadata/detail_metadata/intensity/$id_aloptama/$kode_aloptama");
        }
     }

         //  input metadata hardware
         public function input_via_modal($jenis_aloptama,$kode)
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
                 $id_aloptama = $this->input->post('id_aloptama');
                 $jenis_hardware = $this->input->post('jenis_hardware');
     
                 $this->m_metadata->input_metadata($data,'hardware_aloptama');
                 $this->session->set_flashdata('pesan', "Data Hardware berupa $jenis_hardware berhasil Disimpan !!");
                 redirect("metadata/detail_metadata/$jenis_aloptama/$id_aloptama/$kode");
             }
         }

    public function delete_hardware($id_hardware, $kodeSite, $id_aloptama, $jenis_aloptama){
        $this->m_metadata->delete_hardware('hardware_aloptama', $id_hardware);
        $this->session->set_flashdata('pesan', "Data Hardware site $kodeSite berhasil diperbaharui !!");
        redirect("metadata/detail_metadata/$jenis_aloptama/$id_aloptama/$kodeSite");
        
    }


}