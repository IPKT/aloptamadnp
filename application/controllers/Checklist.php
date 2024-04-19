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
             'aloptama_kantor' =>$this->m_checklist->dataTerbaru('tbl_aloptama_kantor'),
             'sp' =>$this->m_checklist->dataTerbaru('tbl_sistem_processing'),
             'ji' =>$this->m_checklist->dataTerbaru('tbl_jaringan_internet'),
         );
         $this->load->view('v_template',$data,false);
     }


     //input page checklist
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
                'tdq' => $this->input->post('tdq'),
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

        //  input checklist sistem processing
        public function input_sp()
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
                    'judul' => 'Cheklist Sistem Processing',
                    'page' => 'checklist/v_input_sistem_processing',
                   //  'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
        
                );
                $this->load->view('v_template',$data,false);
            }else{
                $data = array(
                    'petugas' => $this->input->post('petugas'),
                    'tanggal' => $this->input->post('tanggal'),
                    'shift' => $this->input->post('shift'),
                    'waktu' => $this->input->post('waktu'),
                    'sc_seismo_server' => $this->input->post('sc_seismo_server'),
                    'sc_seismo_client' => $this->input->post('sc_seismo_client'),
                    'sc_acc_server' => $this->input->post('sc_acc_server'),
                    'sc_acc_pusat' => $this->input->post('sc_acc_pusat'),
                    'sc_acc_regional' => $this->input->post('sc_acc_regional'),
                    'anemometer' => $this->input->post('anemometer'),
                    'petir' => $this->input->post('petir'),
                    'catatan' => $this->input->post('catatan'),
                 
                );
    
                $this->m_checklist->input($data,'tbl_sistem_processing');
                $this->session->set_flashdata('pesan', "Data checklist Sistem Processing berhasil Disimpan !!");
                redirect("checklist/input_page/sistem_processing");
            }
        }

        //  input checklist jaringan internet
        public function input_jaringan_internet()
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
                    'judul' => 'Cheklist Sistem Processing',
                    'page' => 'checklist/v_input_jaringan_internet',
                    //  'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
        
                );
                $this->load->view('v_template',$data,false);
            }else{
                $data = array(
                    'petugas' => $this->input->post('petugas'),
                    'tanggal' => $this->input->post('tanggal'),
                    'shift' => $this->input->post('shift'),
                    'waktu' => $this->input->post('waktu'),
                    'lintas' => $this->input->post('lintas'),
                    'catatan_lintas' => $this->input->post('catatan_lintas'),
                    'indihome' => $this->input->post('indihome'),
                    'catatan_indihome' => $this->input->post('catatan_indihome'),
                    'biznet' => $this->input->post('biznet'),
                    'catatan_biznet' => $this->input->post('catatan_biznet'),
                    'catatan' => $this->input->post('catatan'),
                
                );
    
                $this->m_checklist->input($data,'tbl_jaringan_internet');
                $this->session->set_flashdata('pesan', "Data checklist Jaringan Internet berhasil Disimpan !!");
                redirect("checklist/input_page/jaringan_internet");
            }
        }

    //pilih tanggal hasil checklist
    public function pilih_tanggal()
    {  
        $data = array(
            'judul' => 'Silahkan Pilih',
            'page' => 'checklist/v_pilih_tanggal_checklist',
        //  'aloptama' => $this->m_aloptama->allData($jenis_aloptama)

        );
        $this->load->view('v_template',$data,false);
    }

    //  check ketersediaan checklist
    public function check_hasil()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('shift', 'Shift', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Silahkan Pilih',
                'page' => 'checklist/v_pilih_tanggal_checklist',
            //  'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
    
            );
            $this->load->view('v_template',$data,false);
        }else{
            // $data = array(
            //     'petugas' => $this->input->post('petugas'),
            //     'tanggal' => $this->input->post('tanggal'),
            //     'shift' => $this->input->post('shift'),
            //     'waktu' => $this->input->post('waktu'),
            //     'lintas' => $this->input->post('lintas'),
            //     'catatan_lintas' => $this->input->post('catatan_lintas'),
            //     'indihome' => $this->input->post('indihome'),
            //     'catatan_indihome' => $this->input->post('catatan_indihome'),
            //     'biznet' => $this->input->post('biznet'),
            //     'catatan_biznet' => $this->input->post('catatan_biznet'),
            //     'catatan' => $this->input->post('catatan'),
            
            // );

            $tanggal = $this->input->post('tanggal');
            $shift = $this->input->post('shift');
            $ta = $this->m_checklist->detail_checklist('tbl_taman_alat',$tanggal,$shift);
            $ak = $this->m_checklist->detail_checklist('tbl_aloptama_kantor',$tanggal,$shift);
            $sp = $this->m_checklist->detail_checklist('tbl_sistem_processing',$tanggal,$shift);
            $ji = $this->m_checklist->detail_checklist('tbl_jaringan_internet',$tanggal,$shift);
            $kosong = "";

            if ($ta == null) {
                $kosong = $kosong."Taman Alat, ";
            }
            if ($ak == null) {
                $kosong = $kosong."Aloptama Kantor, ";
            }
            if ($sp == null) {
                $kosong = $kosong."Sistem Processing, ";
            }
            if ($ji == null) {
                $kosong = $kosong."Jaringan Internet ";
            }

            if ($ta != null && $ak != null && $sp != null && $ji != null ) {
                $data = array(
                    'judul' => 'Kondisi Peralatan Tanggal '.$tanggal,
                    'page' => 'checklist/v_kondisi_peralatan',
                    'taman_alat' =>$this->m_checklist->detail_checklist('tbl_taman_alat',$tanggal,$shift),
                    'aloptama_kantor' =>$this->m_checklist->detail_checklist('tbl_aloptama_kantor',$tanggal,$shift),
                    'sp' =>$this->m_checklist->detail_checklist('tbl_sistem_processing',$tanggal,$shift),
                    'ji' =>$this->m_checklist->detail_checklist('tbl_jaringan_internet',$tanggal,$shift),
                );
                $this->load->view('v_template',$data,false);
            } else {
                $this->session->set_flashdata('pesan', "Data Checklist $kosong tidak tersedia pada $tanggal Shift $shift");
                redirect("checklist/pilih_tanggal");
            }
      
            
        }
    }

    //JHistory Checklist
    public function history()
    {
        $data = array(
            'judul' => 'History Checklist',
            'page' => 'checklist/v_history_checklist',
            'ta' =>$this->m_checklist->allData('tbl_taman_alat','tanggal'),
            'ak' =>$this->m_checklist->allData('tbl_aloptama_kantor','tanggal'),
            'sp' =>$this->m_checklist->allData('tbl_sistem_processing','tanggal'),
            'ji' =>$this->m_checklist->allData('tbl_jaringan_internet','tanggal'),
            // 'aloptama_kantor' =>$this->m_checklist->dataTerbaru('tbl_aloptama_kantor'),
            // 'sp' =>$this->m_checklist->dataTerbaru('tbl_sistem_processing'),
            // 'ji' =>$this->m_checklist->dataTerbaru('tbl_jaringan_internet'),
        );
        $this->load->view('v_template',$data,false);
    }

    //delete checklist
    public function delete_checklist($tabel , $id){
        $this->m_checklist->delete($tabel, $id);
        $this->session->set_flashdata('pesan', 'Data Checklist berhasil dihapus !!');
        redirect('checklist/history');
    }



        
    
    
}