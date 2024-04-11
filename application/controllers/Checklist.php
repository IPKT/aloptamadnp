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
        //  if (
        //  $this->session->userdata('username') == null
        //  ) {
        //     redirect('auth');
        //  }
         
     }

     //Halaman awal
     public function index()
     {
         $data = array(
             'judul' => 'Kondisi Terbaru Peralatan',
             'page' => 'checklist/v_kondisi_peralatan',
             'taman_alat' =>$this->m_checklist->dataTerbaru('tbl_taman_alat'),
             'aloptama_kantor' =>$this->m_checklist->dataTerbaru('tbl_aloptama_kantor')
         );
         $this->load->view('v_template',$data,false);
     }


     //input page barang masuk
     public function input_page($jenis)
     {  
         $data = array(
             'judul' => 'Cheklist '.ucwords(str_replace("_"," ",$jenis)),
             'page' => 'checklist/v_input_'.$jenis,
            //  'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
 
         );
         $this->load->view('v_template',$data,false);
     }


    //  input checklist taman alat
     public function input_taman_alat()
    {
        $this->form_validation->set_rules('petugas', 'Petugas', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('shift', 'Shift', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Cheklist Taman Alat',
                'page' => 'checklist/v_input_taman_alat',
               //  'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
    
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'petugas' => $this->input->post('petugas'),
                'tanggal' => $this->input->post('tanggal'),
                'shift' => $this->input->post('shift'),
                'waktu' => $this->input->post('waktu'),
                'sangkar_meteo' => $this->input->post('sangkar_meteo'),
                'anemometer' => $this->input->post('anemometer'),
                'panci_penguapan' => $this->input->post('panci_penguapan'),
                'campbell' => $this->input->post('campbell'),
                'penakar_hujan' => $this->input->post('penakar_hujan'),
                'hillman' => $this->input->post('hillman'),
                'arg' => $this->input->post('arg'),
                'catatan' => $this->input->post('catatan'),
             
            );

            $this->m_checklist->input($data,'tbl_taman_alat');
            $this->session->set_flashdata('pesan', "Data checklist Taman Alat berhasil Disimpan !!");
            redirect("checklist/input_page/taman_alat");
        }
    }


    //  input checklist aloptama kantor
    public function input_aloptama_kantor()
    {
        $this->form_validation->set_rules('petugas', 'Petugas', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('shift', 'Shift', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Cheklist Aloptama Kantor',
                'page' => 'checklist/v_input_aloptama_kantor',
               //  'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
    
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'petugas' => $this->input->post('petugas'),
                'tanggal' => $this->input->post('tanggal'),
                'shift' => $this->input->post('shift'),
                'waktu' => $this->input->post('waktu'),
                'seismo' => $this->input->post('seismo'),
                'radio_broadcaster' => $this->input->post('radio_broadcaster'),
                'wrs' => $this->input->post('wrs'),
                'intensity_realshake' => $this->input->post('intensity_realshake'),
                'petir' => $this->input->post('petir'),
                'catatan' => $this->input->post('catatan'),
             
            );

            $this->m_checklist->input($data,'tbl_aloptama_kantor');
            $this->session->set_flashdata('pesan', "Data checklist Aloptama Kantor berhasil Disimpan !!");
            redirect("checklist/input_page/aloptama_kantor");
        }
    }
    
}