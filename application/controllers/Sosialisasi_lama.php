<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sosialisasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_sosialisasi');
        
    }
	public function index()
	{
        $data = array(
            'judul' => 'Pemetaan Lokasi Sosialisasi',
            'page' => 'sosialisasi/v_pemetaan_sosialisasi',
            'sosialisasi' => $this->m_sosialisasi->allData(),
        );
		$this->load->view('v_template',$data,false);
	}
    
    public function input_page()
    {   
        $data = array(
            'judul' => 'Input Lokasi Sosialisasi',
            'page' => 'sosialisasi/v_input_sosialisasi'
        );
        
        $this->load->view('v_template', $data, FALSE);
        
    }

    public function input_data()
    {
        $this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('koordinat', 'Latitude', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('jenis_kegiatan', 'Jenis Kegiatan', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('detail_lokasi', 'Detail Lokasi', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('pelaksana', 'Pelaksana', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('jumlah_peserta', 'Jumlah Peserta', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));


        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Input Sosialisasi',
                'page' => 'sosialisasi/v_input_sosialisasi'
            );
            $this->load->view('v_template',$data,false);
        }else{

            $config['upload_path']          = './gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            $config['max_size']             = 2048;
            $this->upload->initialize($config);
            if ( !$this->upload->do_upload('gambar'))
            {
                $this->session->set_flashdata('pesan', 'Gambar GAGAL disimpan');
                redirect('sosialisasi/input_page');
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './gambar/'.$upload_data['upload_data']['file_name'];
                $this->load->library('image_lib', $config);
                //simpan data ke database
                $data = array(
                    'nama_lokasi' => $this->input->post('nama_lokasi'),
                    'koordinat' => $this->input->post('koordinat'),
                    'tanggal' => $this->input->post('tanggal'),
                    'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
                    'detail_lokasi' => $this->input->post('detail_lokasi'),
                    'pelaksana' => $this->input->post('pelaksana'),
                    'jumlah_peserta' => $this->input->post('jumlah_peserta'),
                    'gambar' => $upload_data['upload_data']['file_name']
                );
    
                $this->m_sosialisasi->input($data);
                $this->session->set_flashdata('pesan', 'Data Sosialisasi berhasil Disimpan !!');
                redirect('sosialisasi/input_page');
            }  

        }

       
        
     
    }

    public function edit($id_lokasi)
    {   
        $data = array(
            'judul' => 'Edit Lokasi Sosialisasi',
            'page' => 'sosialisasi/v_edit_sosialisasi',
            'lokasi' => $this->m_sosialisasi->detail($id_lokasi) 
        );
        
        $this->load->view('v_template', $data, FALSE);
        
    }

    public function update($id_lokasi)
    {
        $this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('koordinat', 'Latitude', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('jenis_kegiatan', 'Jenis Kegiatan', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('detail_lokasi', 'Detail Lokasi', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('pelaksana', 'Pelaksana', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('jumlah_peserta', 'Jumlah Peserta', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));


        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Edit Lokasi Sosialisasi',
                'page' => 'sosialisasi/v_edit_sosialisasi',
                'lokasi' => $this->m_sosialisasi->detail($id_lokasi) 
            );
            
            $this->load->view('v_template', $data, FALSE);
        }else{

            $config['upload_path']          = './gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            $config['max_size']             = 2048;
            $this->upload->initialize($config);
            if ( !$this->upload->do_upload('gambar'))
            {
                // $this->session->set_flashdata('pesan', 'Gambar GAGAL disimpan');
                // redirect('sosialisasi/edit/'.$this->input->post('id_lokasi'));

                $data = array(
                    'nama_lokasi' => $this->input->post('nama_lokasi'),
                    'koordinat' => $this->input->post('koordinat'),
                    'tanggal' => $this->input->post('tanggal'),
                    'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
                    'detail_lokasi' => $this->input->post('detail_lokasi'),
                    'pelaksana' => $this->input->post('pelaksana'),
                    'jumlah_peserta' => $this->input->post('jumlah_peserta')
                );
                
                $this->m_sosialisasi->update($data,$this->input->post('id_lokasi'));
                $this->session->set_flashdata('pesan', 'Data Sosialisasi '.$this->input->post('nama_lokasi'). ' berhasil diedit !!');
                redirect('sosialisasi');
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './gambar/'.$upload_data['upload_data']['file_name'];
                $this->load->library('image_lib', $config);
                //simpan data ke database
                $data = array(
                    'nama_lokasi' => $this->input->post('nama_lokasi'),
                    'koordinat' => $this->input->post('koordinat'),
                    'tanggal' => $this->input->post('tanggal'),
                    'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
                    'detail_lokasi' => $this->input->post('detail_lokasi'),
                    'pelaksana' => $this->input->post('pelaksana'),
                    'jumlah_peserta' => $this->input->post('jumlah_peserta'),
                    'gambar' => $upload_data['upload_data']['file_name']
                );
                
                $this->m_sosialisasi->update($data,$this->input->post('id_lokasi'));
                $this->session->set_flashdata('pesan', 'Data Sosialisasi '.$this->input->post('nama_lokasi'). ' berhasil diedit !!');
                redirect('sosialisasi');
            }  

        }
    }

    public function listlokasi()
	{
        $data = array(
            'judul' => 'List Lokasi',
            'page' => 'sosialisasi/v_list_sosialisasi',
            'sosialisasi' => $this->m_sosialisasi->allData(),
        );
		$this->load->view('v_template',$data,false);
	}

    public function detail($id_lokasi){
        $data = array(
            'judul' => 'Detail Sosialisasi',
            'page' => 'sosialisasi/v_detail_sosialisasi',
            'lokasi' => $this->m_sosialisasi->detail($id_lokasi) 
        );
        
        $this->load->view('v_template', $data, FALSE); 
    }

    public function delete($id_lokasi){
        $lokasi = $this->m_sosialisasi->detail($id_lokasi);
        $nama_lokasi = $lokasi->nama_lokasi;
        $this->m_sosialisasi->delete($id_lokasi);
        $this->session->set_flashdata('pesan', 'Data Sosialisasi '.$nama_lokasi. ' berhasil dihapus !!');
                redirect('sosialisasi');
    }
}
