<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wrs extends CI_Controller {

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
        $this->load->model('m_seismo');
        if (
        $this->session->userdata('username') == null
        ) {
           redirect('auth');
        }
        $this->load->model('m_wrs');
        
    }
    
     public function index()
	{
        $data = array(
            'judul' => 'Peta WRS',
            'page' => 'wrs/v_pemetaan_wrs',
            'wrs'   => $this->m_wrs->allData()
        );
		$this->load->view('v_template',$data,false);
	}

    // PAGE INPUT 
    public function input_page()
	{
        $data = array(
            'judul' => 'Input Lokasi WRS',
            'page' => 'wrs/v_input_wrs',
            'wrs' => $this->m_wrs->allData()
        );
		$this->load->view('v_template',$data,false);
	}

    public function input_data()
    {
        $this->form_validation->set_rules('koordinat', 'Koordinat', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('lokasi', 'lokasi', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
      
        $this->form_validation->set_rules('tipe', 'Tipe', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));


        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Input Lokasi WRS',
                'page' => 'wrs/v_input_wrs'
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'koordinat' => $this->input->post('koordinat'),
                'lokasi' => $this->input->post('lokasi'),
                'detail_lokasi' => $this->input->post('detail_lokasi'),
                'tipe' => $this->input->post('tipe'),
             
            );

            $this->m_wrs->input($data,'tbl_wrs');
            $this->session->set_flashdata('pesan', 'Data WRS berhasil Disimpan !!');
            redirect('wrs/input_page');
        }
    }

    //Menampilkan detail wrs
    public function detail_wrs($id_wrs){
        $data = array(
            'judul' => 'Detail wrs',
            'page' => 'wrs/v_detail_wrs',
            'wrs' => $this->m_wrs->detail_wrs($id_wrs),
            'kunjungan_semua' => $this->m_wrs->allDataKunjungan(),
        );
        
        $this->load->view('v_template', $data, FALSE); 
    }

    //edit WRS
    public function edit($id)
    {   
        $data = array(
            'judul' => 'Edit wrs',
            'page' => 'wrs/v_edit_wrs',
            'wrs' => $this->m_wrs->detail_wrs($id) 
        );
        
        $this->load->view('v_template', $data, FALSE);
    
    
    }

    //update data wrs
    public function update_data()
    {
        $this->form_validation->set_rules('kode', 'Kode Site', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('koordinat', 'Koordinat', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        // $this->form_validation->set_rules('detail_lokasi', 'Detail lokasi', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));
      
        $this->form_validation->set_rules('tipe', 'Tipe', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));


        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Edit Data wrs',
                'page' => 'wrs/v_edit_wrs',
                'wrs' => $this->m_wrs->detail_wrs($id) 
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'lokasi' => $this->input->post('kode'),
                'koordinat' => $this->input->post('koordinat'),
                'detail_lokasi' => $this->input->post('detail_lokasi'),
                'tipe' => $this->input->post('tipe'),
             
            );

            $this->m_wrs->update($data,$this->input->post('id'));
            $this->session->set_flashdata('pesan', 'Data wrs '.$this->input->post('kode').' berhasil Diupdate !!');
            redirect('wrs');
        }
    }

    // Menampilkan Halaman Input Kunjungan
    public function input_page_kunjungan(){
        $data = array(
            'judul' => 'Input Kunjungan WRS',
            'page' => 'wrs/v_input_kunjungan_wrs',
            'site' => $this->m_wrs->allData()
        );
		$this->load->view('v_template',$data,false);
    }

    // Input data kunjungan ke database
    public function input_data_kunjungan()
    {
                $id_wrs = $this->input->post('id_wrs');
                $id_wrs = explode(":",$id_wrs);
                $id_wrs = $id_wrs[0];
        // $wrs = $this->m_wrs->detail_wrs($this->input->post('id_wrs'));
        $wrs = $this->m_wrs->detail_wrs($id_wrs);
        $this->form_validation->set_rules('id_wrs', 'Kode Site', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('kondisi', 'kondisi', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));


        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Input wrs',
                'page' => 'wrs/v_input_kunjungan_wrs'
            );
            $this->load->view('v_template',$data,false);
        }else{
            // $config['upload_path']          = './kunjungan_wrs/gambar/';
            // $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            // $config['max_size']             = 2048;
            // $this->upload->initialize($config);

            $config2['upload_path']          = './kunjungan_wrs/laporan/';
            $config2['allowed_types']        = 'pdf|doc|docx';
            $config2['max_size']             = 10000;
            $new_name = $wrs->lokasi.'_'.$this->input->post('tanggal');
            // $new_name = $wrs->kode.'_'.$this->input->post('tanggal').'_'.$_FILES["laporan"]['name'];
            $config2['file_name'] = $new_name;
            $this->upload->initialize($config2);
            if ( !$this->upload->do_upload('laporan'))
            {
                $this->session->set_flashdata('pesan', 'laporan GAGAL disimpan');
                redirect('wrs/input_page_kunjungan');
            } else {
                $upload_data2 = array('upload_data2' => $this->upload->data());
                
                $config2['source_file'] = './kunjungan_wrs/laporan/'.$upload_data2['upload_data2']['file_name'];
            }
            $config['upload_path']          = './kunjungan_wrs/gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            $config['max_size']             = 2048;
            $new_name = $wrs->lokasi.'_'.$this->input->post('tanggal');
            $config['file_name'] = $new_name;
            $this->upload->initialize($config);
            if ( !$this->upload->do_upload('gambar'))
            {
                // $this->session->set_flashdata('pesan', 'Gambar GAGAL disimpan');
                // redirect('wrs/input_page_kunjungan');
                $id_wrs = $this->input->post('id_wrs');
                $id_wrs = explode(":",$id_wrs);
                $id_wrs = $id_wrs[0];
                $wrs = $this->m_wrs->detail_wrs($id_wrs);

                //simpan data ke database
                $data = array(
                    'id_wrs' => $id_wrs,
                    'jenis' => $this->input->post('jenis'),
                    'kondisi' => $this->input->post('kondisi'),
                    'tanggal' => $this->input->post('tanggal'),
                    'kerusakan' => $this->input->post('kerusakan'),
                    'rekomendasi' => $this->input->post('rekomendasi'),
                    'pelaksana' => $this->input->post('pelaksana'),
                    'text_wa' => $this->input->post('text_wa'),
                    'gambar' => $upload_data['upload_data']['file_name'],
                    'laporan' => $upload_data2['upload_data2']['file_name'],
                    'id_author' => $this->session->userdata('id_user')

                );
    
                $this->m_wrs->input($data,'tbl_kunjungan_wrs');
                $this->session->set_flashdata('pesan', 'Data Kunjungan '.$wrs->lokasi .' berhasil Disimpan !!');
                redirect('wrs/input_page_kunjungan');
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './kunjungan_wrs/gambar/'.$upload_data['upload_data']['file_name'];
                $this->load->library('image_lib', $config);

            
                $id_wrs = $this->input->post('id_wrs');
                $id_wrs = explode(":",$id_wrs);
                $id_wrs = $id_wrs[0];
                $wrs = $this->m_wrs->detail_wrs($id_wrs);

                //simpan data ke database
                $data = array(
                    'id_wrs' => $id_wrs,
                    'jenis' => $this->input->post('jenis'),
                    'kondisi' => $this->input->post('kondisi'),
                    'tanggal' => $this->input->post('tanggal'),
                    'kerusakan' => $this->input->post('kerusakan'),
                    'rekomendasi' => $this->input->post('rekomendasi'),
                    'pelaksana' => $this->input->post('pelaksana'),
                    'text_wa' => $this->input->post('text_wa'),
                    'gambar' => $upload_data['upload_data']['file_name'],
                    'laporan' => $upload_data2['upload_data2']['file_name'],
                    'id_author' => $this->session->userdata('id_user')

                );
    
                $this->m_wrs->input($data,'tbl_kunjungan_wrs');
                $this->session->set_flashdata('pesan', 'Data Kunjungan '.$wrs->lokasi .' berhasil Disimpan !!');
                redirect('wrs/input_page_kunjungan');
            }  

        }
    }

    //Menampilkan Page List Kunjungan WRS
    public function list_kunjungan()
	{
        $data = array(
            'judul' => 'List Kunjungan',
            'page' => 'wrs/v_list_kunjungan_wrs',
            'kunjungan' => $this->m_wrs->allDataKunjungan(),
        );
		$this->load->view('v_template',$data,false);
	}

    //Menampilkan Detail Kunjungan WRS
    public function detail_kunjungan($id_lokasi){
        $data = array(
            'judul' => 'Detail Kunjungan WRS',
            'page' => 'wrs/v_detail_kunjungan_wrs',
            'lokasi' => $this->m_wrs->detail_kunjungan($id_lokasi) 
        );
        
        $this->load->view('v_template', $data, FALSE); 
    }

    //Edit Kunjungan
    public function edit_kunjungan($id)
    {   
        $data = array(
            'judul' => 'Edit Kunjungan',
            'page' => 'wrs/v_edit_kunjungan_wrs',
            'kunjungan' => $this->m_wrs->detail_kunjungan($id) 
        );
        
        $this->load->view('v_template', $data, FALSE);
    
        
    }

    //update data kunjungan
    public function update_data_kunjungan()
    {
        $this->load->helper('file');
        
        $wrs = $this->m_wrs->detail_wrs($this->input->post('id_wrs'));
        // $this->form_validation->set_rules('id_wrs', 'Kode Site', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));
        $this->form_validation->set_rules('kondisi', 'kondisi', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));


        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Input wrs',
                'page' => 'wrs/v_input_kunjungan_wrs'
            );
            $this->load->view('v_template',$data,false);
        }else{

             //simpan data ke database
             $data = array(
                'jenis' => $this->input->post('jenis'),
                'kondisi' => $this->input->post('kondisi'),
                'tanggal' => $this->input->post('tanggal'),
                'kerusakan' => $this->input->post('kerusakan'),
                'rekomendasi' => $this->input->post('rekomendasi'),
                'pelaksana' => $this->input->post('pelaksana'),
                'text_wa' => $this->input->post('text_wa')

            );

            $this->m_wrs->update_kunjungan($data,$this->input->post('id_kunjungan'));

            $kun = $this->m_wrs->detail_kunjungan($this->input->post('id_kunjungan'));
            if (!empty($_FILES['laporan']['size'])) {

                unlink('./kunjungan_wrs/laporan/'.$kun->laporan);
            }
            if (!empty($_FILES['gambar']['size'])) {

                unlink('./kunjungan_wrs/gambar/'.$kun->gambar);
            }
            $config2['upload_path']          = './kunjungan_wrs/laporan/';
            $config2['allowed_types']        = 'pdf|doc|docx';
            $config2['max_size']             = 10000;
            $new_name = $wrs->kode.'_'.$this->input->post('tanggal');
            // $new_name = $wrs->kode.'_'.$this->input->post('tanggal').'_'.$_FILES["laporan"]['name'];
            $config2['file_name'] = $new_name;
            $this->upload->initialize($config2);
            if ( !$this->upload->do_upload('laporan'))
            {
                // $this->session->set_flashdata('pesan', 'laporan GAGAL disimpan');
                // redirect('wrs/input_page_kunjungan');
            } else {
                $upload_data2 = array('upload_data2' => $this->upload->data());
                $config2['source_file'] = './kunjungan_wrs/laporan/'.$upload_data2['upload_data2']['file_name'];
                $data = array(
                    'laporan' => $upload_data2['upload_data2']['file_name']
    
                );
    
                $this->m_wrs->update_kunjungan($data,$this->input->post('id_kunjungan'));

            }
            $config['upload_path']          = './kunjungan_wrs/gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            $config['max_size']             = 2048;
            $new_name = $wrs->kode.'_'.$this->input->post('tanggal');
            $config['file_name'] = $new_name;
            $this->upload->initialize($config);
            if ( !$this->upload->do_upload('gambar'))
            {
               
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './kunjungan_wrs/gambar/'.$upload_data['upload_data']['file_name'];

                //simpan data ke database
                $data = array(
                    'gambar' => $upload_data['upload_data']['file_name']

                );
    
                $this->m_wrs->update_kunjungan($data,$this->input->post('id_kunjungan'));
                
            }  

            $this->session->set_flashdata('pesan', 'Data Kunjungan '.$wrs->kode.' dirubah !!');
            redirect('wrs/input_page_kunjungan');

        }
    }

    //delete kunjungan
    public function delete_kunjungan($id_kunjungan){
        $kunjungan = $this->m_wrs->detail_kunjungan($id_kunjungan);
        $this->m_wrs->delete_kunjungan($id_kunjungan);
        $this->load->helper("file");
        $path1 = './kunjungan_wrs/gambar/'.$kunjungan->gambar;
            unlink('./kunjungan_wrs/gambar/'.$kunjungan->gambar);
            $path2 = './kunjungan_wrs/laporan/'.$kunjungan->laporan;
            unlink('./kunjungan_wrs/laporan/'.$kunjungan->laporan);
        
        

        // $this->session->set_flashdata('pesan', 'Data wrs '.$nama_lokasi. ' berhasil dihapus !!');
        redirect('wrs/list_kunjungan');
    }

    //menampilkan page input kondisi terkini
    public function input_page_kondisi_terkini(){
        $data = array(
            'judul' => 'Input Kondisi wrs',
            'page' => 'wrs/v_input_kondisi_terkini',
            'site' => $this->m_wrs->allData()
        );
		$this->load->view('v_template',$data,false);
    }

    //update kondisi terkini
    public function input_kondisi_terkini_2(){
        $site = $this->m_wrs->allData();
        foreach($site as $key => $value){
            $kondisi_terkini = $this->input->post('wrs_'.$value->id_wrs);
            if ($kondisi_terkini == NULL) {
                $kondisi_terkini = "OFF";
            }
            $update= $this->m_wrs->update_kondisi_terkini_2($value->id_wrs,$kondisi_terkini);
            $this->session->set_flashdata('pesan', 'Data Kondisi Terkini wrs berhasil Disimpan !!');
         
        }
        // $kondisi = $this->input->post('kondisi_terkini_2');
        // $kode = $this->input->post('kode');

        // $update= $this->m_wrs->update_kondisi_terkini($kode,$kondisi);
        // $this->session->set_flashdata('pesan', 'Data wrs berhasil Disimpan !!');
        redirect('wrs/input_page_kondisi_terkini');
    }


}