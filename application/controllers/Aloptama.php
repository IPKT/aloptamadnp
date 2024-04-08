<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aloptama extends CI_Controller {

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
         if (
         $this->session->userdata('username') == null
         ) {
            redirect('auth');
         }
         
     }

    // public function index()
	// {
    //     $data = array(
    //         'judul' => 'Pemetaan Lokasi Intensity',
    //         'page' => 'aloptama/v_pemetaan',
    //         'intensity' => $this->m_aloptama->allData('intensity'),
    //     );
	// 	$this->load->view('v_template',$data,false);
	// }

    public function home($jenis_aloptama)
	{
        $data = array(
            'judul' => 'Pemetaan Lokasi '.ucwords($jenis_aloptama),
            'page' => 'aloptama/v_pemetaan',
            'jenis_aloptama' => $jenis_aloptama,
            'aloptama' => $this->m_aloptama->allData($jenis_aloptama),
        );
		$this->load->view('v_template',$data,false);
	}
     public function input_page($jenis_aloptama)
	{
        $data = array(
            'judul' => 'Input Lokasi Baru '.ucwords($jenis_aloptama),
            'page' => 'aloptama/v_input',
            'jenis_aloptama' => $jenis_aloptama,
            'aloptama' => $this->m_aloptama->allData($jenis_aloptama)

        );
		$this->load->view('v_template',$data,false);
	}

    public function input_data($jenis_aloptama)
    {
        $this->form_validation->set_rules('kode', 'Kode Site', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
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
                'judul' => 'Input '.$jenis_aloptama,
                'page' => 'aloptama/v_input'
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'kode' => $this->input->post('kode'),
                'koordinat' => $this->input->post('koordinat'),
                'lokasi' => $this->input->post('lokasi'),
                'detail_lokasi' => $this->input->post('detail_lokasi'),
                'tipe' => $this->input->post('tipe'),
                'nama_pic' => $this->input->post('nama_pic'),
                'jabatan_pic' => $this->input->post('jabatan_pic'),
                'kontak_pic' => $this->input->post('kontak_pic')
             
            );

            $this->m_aloptama->input($data,'tbl_'.$jenis_aloptama);
            $this->session->set_flashdata('pesan', "Data $jenis_aloptama berhasil Disimpan !!");
            redirect('aloptama/home/'.$jenis_aloptama);
        }
    }

    public function input_page_kunjungan($jenis_aloptama){
        $data = array(
            'judul' => 'Input Kunjungan '.ucwords($jenis_aloptama),
            'page' => 'aloptama/v_input_kunjungan',
            'jenis_aloptama' => $jenis_aloptama,
            'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
        );
		$this->load->view('v_template',$data,false);
    }

    public function input_data_kunjungan_lama()
    {
                $id_intensity = $this->input->post('id_intensity');
                $id_intensity = explode(":",$id_intensity);
                $id_intensity = $id_intensity[0];
        // $intensity = $this->m_intensity->detail_intensity($this->input->post('id_intensity'));
        $intensity = $this->m_intensity->detail_intensity($id_intensity);
        $this->form_validation->set_rules('id_intensity', 'Kode Site', 'required', array(
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
                'judul' => 'Input Intensity',
                'page' => 'intensity/v_input_kunjungan_intensity'
            );
            $this->load->view('v_template',$data,false);
        }else{
            // $config['upload_path']          = './kunjungan_intensity/gambar/';
            // $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            // $config['max_size']             = 2048;
            // $this->upload->initialize($config);

            $config2['upload_path']          = './kunjungan_intensity/laporan/';
            $config2['allowed_types']        = 'pdf|doc|docx';
            $config2['max_size']             = 10000;
            $new_name = $intensity->kode.'_'.$this->input->post('tanggal');
            // $new_name = $intensity->kode.'_'.$this->input->post('tanggal').'_'.$_FILES["laporan"]['name'];
            $config2['file_name'] = $new_name;
            $this->upload->initialize($config2);
            if ( !$this->upload->do_upload('laporan'))
            {
                $this->session->set_flashdata('pesan', 'laporan GAGAL disimpan');
                redirect('intensity/input_page_kunjungan');
            } else {
                $upload_data2 = array('upload_data2' => $this->upload->data());
                
                $config2['source_file'] = './kunjungan_intensity/laporan/'.$upload_data2['upload_data2']['file_name'];
            }
            $config['upload_path']          = './kunjungan_intensity/gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            $config['max_size']             = 2048;
            $new_name = $intensity->kode.'_'.$this->input->post('tanggal');
            $config['file_name'] = $new_name;
            $this->upload->initialize($config);
            if ( !$this->upload->do_upload('gambar'))
            {
                // $this->session->set_flashdata('pesan', 'Gambar GAGAL disimpan');
                // redirect('intensity/input_page_kunjungan');
                $id_intensity = $this->input->post('id_intensity');
                $id_intensity = explode(":",$id_intensity);
                $id_intensity = $id_intensity[0];
                $intensity = $this->m_intensity->detail_intensity($id_intensity);

                //simpan data ke database
                $data = array(
                    'id_intensity' => $id_intensity,
                    'jenis' => $this->input->post('jenis'),
                    'kondisi' => $this->input->post('kondisi'),
                    'tanggal' => $this->input->post('tanggal'),
                    'kerusakan' => $this->input->post('kerusakan'),
                    'rekomendasi' => $this->input->post('rekomendasi'),
                    'pelaksana' => $this->input->post('pelaksana'),
                    'text_wa' => $this->input->post('text_wa'),
                    'gambar' => $upload_data['upload_data']['file_name'],
                    'laporan' => $upload_data2['upload_data2']['file_name'],
                    'id_author' => $this->session->userdata('id_user'),
                    'catatan_kunjungan' => $this->input->post('catatan_kunjungan')

                );
    
                $this->m_intensity->input($data,'tbl_kunjungan_intensity');
                $this->session->set_flashdata('pesan', 'Data Kunjungan '.$intensity->kode .' berhasil Disimpan !!');
                redirect('intensity/input_page_kunjungan');
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './kunjungan_intensity/gambar/'.$upload_data['upload_data']['file_name'];
                $this->load->library('image_lib', $config);

            
                $id_intensity = $this->input->post('id_intensity');
                $id_intensity = explode(":",$id_intensity);
                $id_intensity = $id_intensity[0];
                $intensity = $this->m_intensity->detail_intensity($id_intensity);

                //simpan data ke database
                $data = array(
                    'id_intensity' => $id_intensity,
                    'jenis' => $this->input->post('jenis'),
                    'kondisi' => $this->input->post('kondisi'),
                    'tanggal' => $this->input->post('tanggal'),
                    'kerusakan' => $this->input->post('kerusakan'),
                    'rekomendasi' => $this->input->post('rekomendasi'),
                    'pelaksana' => $this->input->post('pelaksana'),
                    'text_wa' => $this->input->post('text_wa'),
                    'gambar' => $upload_data['upload_data']['file_name'],
                    'laporan' => $upload_data2['upload_data2']['file_name'],
                    'id_author' => $this->session->userdata('id_user'),
                    'catatan_kunjungan' => $this->input->post('catatan_kunjungan')

                );
    
                $this->m_intensity->input($data,'tbl_kunjungan_intensity');
                $this->session->set_flashdata('pesan', 'Data Kunjungan '.$intensity->kode .' berhasil Disimpan !!');
                redirect('intensity/input_page_kunjungan');
            }  

        }
    }


    public function input_data_kunjungan($jenis_aloptama)
    {
                $id = $this->input->post('id');
                $id = explode(":",$id);
                $id = $id[0];
        $aloptama = $this->m_aloptama->detail_aloptama($jenis_aloptama,$id);
        $this->form_validation->set_rules('id', 'Kode Site', 'required', array(
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
                'judul' => 'Input Kunjungan '.$jenis_aloptama,
                'page' => 'aloptama/v_input_kunjungan',
                'aloptama' => $this->m_aloptama->allData($jenis_aloptama)
            );
            $this->load->view('v_template',$data,false);
        }else{
            
            $config3['upload_path']          = "./kunjungan_$jenis_aloptama/laporan/";
            $config3['allowed_types']        = 'pdf|doc|docx';
            $config3['max_size']             = 10000;
            $new_name = $aloptama->kode.'_'.$this->input->post('tanggal').'_laporan2';
            // $new_name = $seismo->kode.'_'.$this->input->post('tanggal').'_'.$_FILES["laporan"]['name'];
            $config3['file_name'] = $new_name;
            $this->upload->initialize($config3);
            if ( !$this->upload->do_upload('laporan2'))
            {

            } else {
                $upload_data3 = array('upload_data3' => $this->upload->data());
                $config3['source_file'] = "./kunjungan_$jenis_aloptama/laporan/".$upload_data3['upload_data3']['file_name'];
            }
            
            
            
            // $config['upload_path']          = './kunjungan_seismo/gambar/';
            // $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            // $config['max_size']             = 2048;
            // $this->upload->initialize($config);

            $config2['upload_path']          = "./kunjungan_$jenis_aloptama/laporan/";
            $config2['allowed_types']        = 'pdf|doc|docx';
            $config2['max_size']             = 10000;
            $new_name = $aloptama->kode.'_'.$this->input->post('tanggal');
            // $new_name = $seismo->kode.'_'.$this->input->post('tanggal').'_'.$_FILES["laporan"]['name'];
            $config2['file_name'] = $new_name;
            $this->upload->initialize($config2);
            if ( !$this->upload->do_upload('laporan'))
            {
                $this->session->set_flashdata('pesan', 'laporan GAGAL disimpan');
                redirect("aloptama/input_page_kunjungan/$jenis_aloptama");
            } else {
                $upload_data2 = array('upload_data2' => $this->upload->data());
                
                $config2['source_file'] = "./kunjungan_$jenis_aloptama/laporan/".$upload_data2['upload_data2']['file_name'];
            }
            $config['upload_path']          = "./kunjungan_$jenis_aloptama/gambar/";
            $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            $config['max_size']             = 2048;
            $new_name = $aloptama->kode.'_'.$this->input->post('tanggal');
            $config['file_name'] = $new_name;
            $this->upload->initialize($config);
            if ( !$this->upload->do_upload('gambar'))
            {
                // $this->session->set_flashdata('pesan', 'Gambar GAGAL disimpan');
                // redirect('seismo/input_page_kunjungan');
                $id = $this->input->post('id');
                $id = explode(":",$id);
                $id = $id[0];
                $aloptama = $this->m_aloptama->detail_aloptama($jenis_aloptama,$id);

                //simpan data ke database
                $data = array(
                    'id_'.$jenis_aloptama => $id,
                    'jenis' => $this->input->post('jenis'),
                    'kondisi' => $this->input->post('kondisi'),
                    'tanggal' => $this->input->post('tanggal'),
                    'kerusakan' => $this->input->post('kerusakan'),
                    'rekomendasi' => $this->input->post('rekomendasi'),
                    'pelaksana' => $this->input->post('pelaksana'),
                    'catatan_kunjungan' => $this->input->post('catatan_kunjungan'),
                    'text_wa' => $this->input->post('text_wa'),
                    'gambar' => $upload_data['upload_data']['file_name'],
                    'laporan' => $upload_data2['upload_data2']['file_name'],
                    'laporan2' => $upload_data3['upload_data3']['file_name'],
                    'id_author' => $this->session->userdata('id_user')

                );
    
                $this->m_aloptama->input($data,'tbl_kunjungan_'.$jenis_aloptama);
                $this->session->set_flashdata('pesan', 'Data Kunjungan '.$aloptama->kode .' berhasil Disimpan !!');
                redirect('aloptama/input_page_kunjungan/'.$jenis_aloptama);
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = "./kunjungan_$jenis_aloptama/gambar/".$upload_data['upload_data']['file_name'];
                $this->load->library('image_lib', $config);

            
                $id = $this->input->post('id');
                $id = explode(":",$id);
                $id = $id[0];
                $aloptama = $this->m_aloptama->detail_aloptama($jenis_aloptama,$id);

                //simpan data ke database
                $data = array(
                    'id_'.$jenis_aloptama => $id,
                    'jenis' => $this->input->post('jenis'),
                    'kondisi' => $this->input->post('kondisi'),
                    'tanggal' => $this->input->post('tanggal'),
                    'kerusakan' => $this->input->post('kerusakan'),
                    'rekomendasi' => $this->input->post('rekomendasi'),
                    'pelaksana' => $this->input->post('pelaksana'),
                    'catatan_kunjungan' => $this->input->post('catatan_kunjungan'),
                    'text_wa' => $this->input->post('text_wa'),
                    'gambar' => $upload_data['upload_data']['file_name'],
                    'laporan' => $upload_data2['upload_data2']['file_name'],
                    'laporan2' => $upload_data3['upload_data3']['file_name'],
                    'id_author' => $this->session->userdata('id_user')

                );
    
                $this->m_aloptama->input($data,'tbl_kunjungan_'.$jenis_aloptama);
                $this->session->set_flashdata('pesan', 'Data Kunjungan '.$aloptama->kode .' berhasil Disimpan !!');
                redirect("aloptama/input_page_kunjungan/$jenis_aloptama");
            }
            
       



        }
    }



    public function list_kunjungan($jenis_aloptama)
	{
        $data = array(
            'judul' => 'List Kunjungan '.ucwords($jenis_aloptama),
            'page' => 'aloptama/v_list_kunjungan',
            'kunjungan' => $this->m_aloptama->allDataKunjungan($jenis_aloptama),
            'jenis_aloptama' =>$jenis_aloptama
        );
		$this->load->view('v_template',$data,false);
	}

    public function detail_aloptama($jenis_aloptama, $id){
        $data = array(
            'judul' => 'Detail '.$jenis_aloptama,
            'page' => 'aloptama/v_detail',
            'aloptama' => $this->m_aloptama->detail_aloptama($jenis_aloptama,$id),
            'kunjungan_semua' => $this->m_aloptama->allDataKunjungan($jenis_aloptama),
            'jenis_aloptama' =>$jenis_aloptama
        );
        
        $this->load->view('v_template', $data, FALSE); 
    }

    public function input_page_kondisi_terkini(){
        $data = array(
            'judul' => 'Input Kondisi Intensity',
            'page' => 'intensity/v_input_kondisi_terkini',
            'site' => $this->m_intensity->allData()
        );
		$this->load->view('v_template',$data,false);
    }

    public function input_kondisi_terkini()
    {
        // $this->form_validation->set_rules('kode', 'Kode Site', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));
        // $this->form_validation->set_rules('koordinat', 'Koordinat', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));
        // $this->form_validation->set_rules('lokasi', 'lokasi', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));
        // $this->form_validation->set_rules('detail_lokasi', 'Detail lokasi', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));
        // $this->form_validation->set_rules('tipe', 'Tipe', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));

            $kondisi = $this->input->post('kondisi_terkini');
            $kode = $this->input->post('kode');

            $update= $this->m_intensity->update_kondisi_terkini($kode,$kondisi);
            $this->session->set_flashdata('pesan', 'Data Intensity berhasil Disimpan !!');
            redirect('intensity/input_page_kondisi_terkini');
        // if ($this->form_validation->run()==FALSE) {
        //     $data = array(
        //         'judul' => 'Input Kondisi Intensity',
        //         'page' => 'intensity/v_input_kondisi_terkini',
        //         'site' => $this->m_intensity->allData(),
        //     );
        //     $this->session->set_flashdata('pesan', 'Data terkini gagal disimpan !!');
        //     $this->load->view('v_template',$data,false);
        // }else{
        //     // $data = array(
        //     //     'kode' => $this->input->post('kode'),
        //     //     'koordinat' => $this->input->post('koordinat'),
        //     //     'lokasi' => $this->input->post('lokasi'),
        //     //     'detail_lokasi' => $this->input->post('lokasi'),
        //     //     'tipe' => $this->input->post('tipe'),
             
        //     // );

            
        // }
    }


    public function input_kondisi_terkini_2(){
        $site = $this->m_intensity->allData();
        foreach($site as $key => $value){
            $kondisi_terkini = $this->input->post($value->kode);
            if ($kondisi_terkini == NULL) {
                $kondisi_terkini = "OFF";
            }
            $update= $this->m_intensity->update_kondisi_terkini_2($value->kode,$kondisi_terkini);
            $this->session->set_flashdata('pesan', 'Data Kondisi Terkini Intensity berhasil Disimpan !!');
         
        }
        // $kondisi = $this->input->post('kondisi_terkini_2');
        // $kode = $this->input->post('kode');

        // $update= $this->m_intensity->update_kondisi_terkini($kode,$kondisi);
        // $this->session->set_flashdata('pesan', 'Data Intensity berhasil Disimpan !!');
        redirect('intensity/input_page_kondisi_terkini');
    }

    public function delete_aloptama($jenis_aloptama, $id){
        // $aloptama = $this->m_aloptama->detail_aloptama($id);
        // $this->m_aloptama->delete_aloptama($jenis_aloptama , $id);
        // $kunjungan = $this->m_aloptama->ambil_aja("SELECT * FROM tbl_kunjungan_$jenis_aloptama WHERE id_$jenis_aloptama = $id");
        // foreach($kunjungan as $key => $k){
        //     $this->delete_kunjungan($jenis_aloptama, $k->id_kunjungan);
        // }
        // $this->session->set_flashdata('pesan', 'Data '.ucwords($jenis_aloptama).' '.$aloptama->kode. ' berhasil dihapus !!');
        // redirect('aloptama/home/'.$jenis_aloptama);
    }

    public function edit($jenis_aloptama, $id_aloptama)
    {   
        $data = array(
            'judul' => 'Edit '.$jenis_aloptama,
            'page' => 'aloptama/v_edit',
            'aloptama' => $this->m_aloptama->detail_aloptama($jenis_aloptama, $id_aloptama),
            'jenis_aloptama' => $jenis_aloptama 
        );
        
        $this->load->view('v_template', $data, FALSE);
    
        
    }

    public function update_data($jenis_aloptama, $id_aloptama)
    {
        $this->form_validation->set_rules('kode', 'Kode Site', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
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
                'judul' => 'Edit '.$jenis_aloptama,
                'page' => 'aloptama/v_edit',
                'aloptama' => $this->m_aloptama->detail_aloptama($jenis_aloptama, $id_aloptama),
                'jenis_aloptama' => $jenis_aloptama 
            );
            
            $this->load->view('v_template', $data, FALSE);
        }else{
            $data = array(
                'kode' => $this->input->post('kode'),
                'koordinat' => $this->input->post('koordinat'),
                'lokasi' => $this->input->post('lokasi'),
                'detail_lokasi' => $this->input->post('detail_lokasi'),
                'tipe' => $this->input->post('tipe'),
                'nama_pic' => $this->input->post('nama_pic'),
                'jabatan_pic' => $this->input->post('jabatan_pic'),
                'kontak_pic' => $this->input->post('kontak_pic'),
                'catatan' => $this->input->post('catatan')
             
            );

            $kode = $this->input->post('kode');

            $this->m_aloptama->update($jenis_aloptama ,$data,$this->input->post('id'));
            $this->session->set_flashdata('pesan', "Data $jenis_aloptama site $kode berhasil Diupdate !!");
            redirect("aloptama/home/$jenis_aloptama");
        }
    }

    public function detail_kunjungan($jenis_aloptama, $id_kunjungan){
        $data = array(
            'judul' => 'Detail Kunjungan '.$jenis_aloptama,
            'page' => 'aloptama/v_detail_kunjungan',
            'kunjungan' => $this->m_aloptama->detail_kunjungan($jenis_aloptama,$id_kunjungan),
            // 'kunjungan_semua' => $this->m_aloptama->allDataKunjungan($jenis_aloptama),
            'jenis_aloptama' =>$jenis_aloptama
        );
        
        $this->load->view('v_template', $data, FALSE); 

    }

    public function edit_kunjungan($jenis_aloptama, $id_kunjungan)
    {   
        $data = array(
            'judul' => 'Edit Kunjungan '.$jenis_aloptama,
            'page' => 'aloptama/v_edit_kunjungan',
            'kunjungan' => $this->m_aloptama->detail_kunjungan($jenis_aloptama, $id_kunjungan),
            'jenis_aloptama' => $jenis_aloptama 
        );
        
        $this->load->view('v_template', $data, FALSE);
    
        
    }


    // public function update_data_kunjungan()
    // {
    //     $this->load->helper('file');
        
    //     $intensity = $this->m_intensity->detail_intensity($this->input->post('id_intensity'));
    //     // $this->form_validation->set_rules('id_intensity', 'Kode Site', 'required', array(
    //     //     'required' => '%s Wajib Diisi !'
    //     // ));
    //     $this->form_validation->set_rules('kondisi', 'kondisi', 'required', array(
    //         'required' => '%s Wajib Diisi !'
    //     ));
    //     $this->form_validation->set_rules('tanggal', 'tanggal', 'required', array(
    //         'required' => '%s Wajib Diisi !'
    //     ));


    //     if ($this->form_validation->run()==FALSE) {
    //         $data = array(
    //             'judul' => 'Input Intensity',
    //             'page' => 'intensity/v_input_kunjungan_intensity'
    //         );
    //         $this->load->view('v_template',$data,false);
    //     }else{

    //          //simpan data ke database
    //          $data = array(
    //             'jenis' => $this->input->post('jenis'),
    //             'kondisi' => $this->input->post('kondisi'),
    //             'tanggal' => $this->input->post('tanggal'),
    //             'kerusakan' => $this->input->post('kerusakan'),
    //             'rekomendasi' => $this->input->post('rekomendasi'),
    //             'pelaksana' => $this->input->post('pelaksana'),
    //             'text_wa' => $this->input->post('text_wa'),
    //             'catatan_kunjungan' => $this->input->post('catatan_kunjungan')


    //         );

    //         $this->m_intensity->update_kunjungan($data,$this->input->post('id_kunjungan'));

    //         $kun = $this->m_intensity->detail_kunjungan($this->input->post('id_kunjungan'));
    //         if (!empty($_FILES['laporan']['size'])) {

    //             unlink('./kunjungan_intensity/laporan/'.$kun->laporan);
    //         }
    //         if (!empty($_FILES['gambar']['size'])) {

    //             unlink('./kunjungan_intensity/gambar/'.$kun->gambar);
    //         }
    //         $config2['upload_path']          = './kunjungan_intensity/laporan/';
    //         $config2['allowed_types']        = 'pdf|doc|docx';
    //         $config2['max_size']             = 10000;
    //         $new_name = $intensity->kode.'_'.$this->input->post('tanggal');
    //         // $new_name = $intensity->kode.'_'.$this->input->post('tanggal').'_'.$_FILES["laporan"]['name'];
    //         $config2['file_name'] = $new_name;
    //         $this->upload->initialize($config2);
    //         if ( !$this->upload->do_upload('laporan'))
    //         {
    //             // $this->session->set_flashdata('pesan', 'laporan GAGAL disimpan');
    //             // redirect('intensity/input_page_kunjungan');
    //         } else {
    //             $upload_data2 = array('upload_data2' => $this->upload->data());
    //             $config2['source_file'] = './kunjungan_intensity/laporan/'.$upload_data2['upload_data2']['file_name'];
    //             $data = array(
    //                 'laporan' => $upload_data2['upload_data2']['file_name']
    
    //             );
    
    //             $this->m_intensity->update_kunjungan($data,$this->input->post('id_kunjungan'));

    //         }
    //         $config['upload_path']          = './kunjungan_intensity/gambar/';
    //         $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
    //         $config['max_size']             = 2048;
    //         $new_name = $intensity->kode.'_'.$this->input->post('tanggal');
    //         $config['file_name'] = $new_name;
    //         $this->upload->initialize($config);
    //         if ( !$this->upload->do_upload('gambar'))
    //         {
               
    //         } else {
    //             $upload_data = array('upload_data' => $this->upload->data());
    //             $config['image_library'] = 'gd2';
    //             $config['source_image'] = './kunjungan_intensity/gambar/'.$upload_data['upload_data']['file_name'];

    //             //simpan data ke database
    //             $data = array(
    //                 'gambar' => $upload_data['upload_data']['file_name']

    //             );
    
    //             $this->m_intensity->update_kunjungan($data,$this->input->post('id_kunjungan'));
                
    //         }  

    //         $this->session->set_flashdata('pesan', 'Data Kunjungan '.$intensity->kode.' dirubah !!');
    //         redirect('intensity/input_page_kunjungan');

    //     }
    // }




    public function update_data_kunjungan($jenis_aloptama , $id_kunjungan)
    {
        $this->load->helper('file');
        $aloptama = $this->m_aloptama->detail_aloptama($jenis_aloptama, $this->input->post('id_aloptama'));
        // $this->form_validation->set_rules('id_seismo', 'Kode Site', 'required', array(
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
                'judul' => 'Edit Kunjungan '.$jenis_aloptama,
                'page' => 'aloptama/v_edit_kunjungan',
                'kunjungan' => $this->m_aloptama->detail_kunjungan($jenis_aloptama, $id_kunjungan),
                'jenis_aloptama' => $jenis_aloptama 
            );
            
            $this->load->view('v_template', $data, FALSE);
        }else{

             //simpan data ke database
             $data = array(
                'jenis' => $this->input->post('jenis'),
                'kondisi' => $this->input->post('kondisi'),
                'tanggal' => $this->input->post('tanggal'),
                'kerusakan' => $this->input->post('kerusakan'),
                'rekomendasi' => $this->input->post('rekomendasi'),
                'pelaksana' => $this->input->post('pelaksana'),
                'catatan_kunjungan' => $this->input->post('catatan_kunjungan'),
                'text_wa' => $this->input->post('text_wa')

            );

            $this->m_aloptama->update_kunjungan($jenis_aloptama , $data,$id_kunjungan);

            $kun = $this->m_aloptama->detail_kunjungan($jenis_aloptama , $id_kunjungan);
            if (!empty($_FILES['laporan']['size'])) {

                unlink("./kunjungan_$jenis_aloptama/laporan/$kun->laporan");
            }
            if (!empty($_FILES['gambar']['size'])) {

                unlink("./kunjungan_$jenis_aloptama/gambar/$kun->gambar");
            }
            if (!empty($_FILES['laporan2']['size'])) {

                unlink('./kunjungan_'.$jenis_aloptama.'/'.'laporan/'.$kun->laporan2);
            }
            $config2['upload_path']          = "./kunjungan_$jenis_aloptama/laporan/";
            $config2['allowed_types']        = 'pdf|doc|docx';
            $config2['max_size']             = 10000;
            $new_name = $aloptama->kode.'_'.$this->input->post('tanggal');
            // $new_name = $seismo->kode.'_'.$this->input->post('tanggal').'_'.$_FILES["laporan"]['name'];
            $config2['file_name'] = $new_name;
            $this->upload->initialize($config2);
            if ( !$this->upload->do_upload('laporan'))
            {
                // $this->session->set_flashdata('pesan', 'laporan GAGAL disimpan');
                // redirect('seismo/input_page_kunjungan');
            } else {
                $upload_data2 = array('upload_data2' => $this->upload->data());
                $config2['source_file'] = './kunjungan_'.$jenis_aloptama.'/'.'laporan/'.$upload_data2['upload_data2']['file_name'];
                $data = array(
                    'laporan' => $upload_data2['upload_data2']['file_name']
    
                );
    
                $this->m_aloptama->update_kunjungan($jenis_aloptama , $data,$id_kunjungan);

            }

            // UPLOAD LAPORAN 2
            $config3['upload_path']          = "./kunjungan_$jenis_aloptama/laporan/";
            $config3['allowed_types']        = 'pdf|doc|docx';
            $config3['max_size']             = 10000;
            $new_name = $aloptama->kode.'_'.$this->input->post('tanggal').'_laporan2';
            // $new_name = $seismo->kode.'_'.$this->input->post('tanggal').'_'.$_FILES["laporan"]['name'];
            $config3['file_name'] = $new_name;
            $this->upload->initialize($config3);
            if ( !$this->upload->do_upload('laporan2'))
            {
                // $this->session->set_flashdata('pesan', 'laporan GAGAL disimpan');
                // redirect('seismo/input_page_kunjungan');
            } else {
                $upload_data3 = array('upload_data3' => $this->upload->data());
                $config3['source_file'] = './kunjungan_'.$jenis_aloptama.'/'.'laporan/'.$upload_data3['upload_data3']['file_name'];
                $data = array(
                    'laporan2' => $upload_data3['upload_data3']['file_name']
    
                );
    
                $this->m_aloptama->update_kunjungan($jenis_aloptama , $data,$id_kunjungan);

            }


            $config['upload_path']          = "./kunjungan_$jenis_aloptama/gambar/";
            $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            $config['max_size']             = 2048;
            $new_name = $aloptama->kode.'_'.$this->input->post('tanggal');
            $config['file_name'] = $new_name;
            $this->upload->initialize($config);
            if ( !$this->upload->do_upload('gambar'))
            {
               
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './kunjungan_'.$jenis_aloptama.'/'.'gambar/'.$upload_data['upload_data']['file_name'];

                //simpan data ke database
                $data = array(
                    'gambar' => $upload_data['upload_data']['file_name']

                );
    
                $this->m_aloptama->update_kunjungan($jenis_aloptama , $data,$id_kunjungan);
                
            }  

            $this->session->set_flashdata('pesan', 'Data Kunjungan '.$aloptama->kode.' dirubah !!');
            redirect("aloptama/detail_aloptama/$jenis_aloptama/$aloptama->id");

        }
    }


    public function delete_kunjungan($jenis_aloptama, $id_kunjungan){
        $kunjungan = $this->m_aloptama->detail_kunjungan($jenis_aloptama, $id_kunjungan);
        $this->m_aloptama->delete_kunjungan($jenis_aloptama , $id_kunjungan);
        $this->load->helper("file");
        $path = "./kunjungan_$jenis_aloptama/gambar/$kunjungan->gambar";
        unlink($path);
        $path1 = "./kunjungan_$jenis_aloptama/laporan/$kunjungan->laporan";
        unlink($path1);
        $path2 = "./kunjungan_$jenis_aloptama/laporan/$kunjungan->laporan2";
        unlink($path2);

        $this->session->set_flashdata('pesan', 'Data Kunjungan '.$jenis_aloptama. ' berhasil dihapus !!');
        redirect('aloptama/list_kunjungan/'.$jenis_aloptama);
    }


}