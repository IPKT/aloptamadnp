<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == null) {
               redirect('auth');}
        $this->load->model('m_lokasi');
        $this->load->model('m_intensity');
        $this->load->model('m_seismo');
        $this->load->model('m_wrs');
        $this->load->model('m_acc_noncolo');
        $this->load->model('m_int_reis');
        
        
    }
    public function index(){
        $data = array(
            'judul' => 'ALOPTAMA STAGEOF DNP',
            'page' => 'lokasi/v_pemetaan_lokasi',
            'lokasi' => $this->m_lokasi->allData(),
            'intensity' => $this->m_intensity->allData(),
            'seismo' => $this->m_seismo->allData(),
            'wrs' => $this->m_wrs->allData(),
            'acc_noncolo' => $this->m_acc_noncolo->allData(),
            'int_reis' => $this->m_int_reis->allData(),
        );
		$this->load->view('v_template',$data,false);
    }

	public function input()
	{
        $this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('latitude', 'Latitude', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('longitude', 'Longitude', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('status_pm', 'Status PM', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Input Lokasi',
                'page' => 'lokasi/v_input_lokasi'
            );
            $this->load->view('v_template',$data,false);
        } else {
            //simpan data ke database
            $data = array(
                'nama_lokasi' => $this->input->post('nama_lokasi'),
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
                'status_pm' => $this->input->post('status_pm')
            );

            $this->m_lokasi->input($data);
            $this->session->set_flashdata('pesan', 'Data Lokasi berhasil Disimpan !!');
            redirect('lokasi/input');
            
        }
        
     
	}

    public function edit($id_lokasi) 
    {
        $data = array(
            'judul' => 'Pemetaan Kordinat',
            'page' => 'lokasi/v_edit_lokasi',
            'lokasi' => $this->m_lokasi->detail($id_lokasi),
        );
		$this->load->view('v_template',$data,false);
    }
}