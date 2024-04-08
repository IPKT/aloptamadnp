<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sosialisasi extends CI_Controller {

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
         $this->load->model('m_sosialisasi');
         if (
         $this->session->userdata('username') == null
         ) {
            redirect('auth');
         }
         
     }

    public function index()
	{
        $data = array(
            'judul' => 'Pemetaan Lokasi sosialisasi',
            'page' => 'sosialisasi/v_pemetaan_lokasi_sosialisasi',
            'lokasi_sosialisasi' => $this->m_sosialisasi->allData(),
        );
		$this->load->view('v_template',$data,false);
	}

    //input lokasi sosialisasi
     public function input_page()
	{
        $data = array(
            'judul' => 'Input Lokasi sosialisasi',
            'page' => 'sosialisasi/v_input_lokasi_sosialisasi',
            'lokasi_sosialisasi' => $this->m_sosialisasi->allData()

        );
		$this->load->view('v_template',$data,false);
	}

    public function input_data_lokasi()
    {
       
        $this->form_validation->set_rules('koordinat', 'Koordinat', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('nama_lokasi', 'nama_lokasi', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));


        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Input Lokasi Sosialisasi',
                'page' => 'sosialisasi/v_input_lokasi_sosialisasi'
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'nama_lokasi' => $this->input->post('nama_lokasi'),
                'koordinat' => $this->input->post('koordinat'),
                'jenis_lokasi' => $this->input->post('jenis_lokasi'),
                'kabupaten' => $this->input->post('kabupaten'),
                'detail_lokasi' => $this->input->post('detail_lokasi'),
             
            );

            $this->m_sosialisasi->input($data,'tbl_lokasi_sosialisasi');
            $this->session->set_flashdata('pesan', 'Data Lokasi Sosialisasi berhasil Disimpan !!');
            redirect('sosialisasi/input_page');
        }
    }

    public function input_page_kunjungan($id_lokasi=''){
        $data = array(
            'judul' => 'Input Kunjungan sosialisasi',
            'page' => 'sosialisasi/v_input_kunjungan_sosialisasi',
            'lokasi_sosialisasi' => $this->m_sosialisasi->allData(),
            'id_lokasi' => $id_lokasi
        );
		$this->load->view('v_template',$data,false);
    }

    public function input_data_kunjungan()
    {
                $id_lokasi_sosialisasi = $this->input->post('id_lokasi_sosialisasi');
                $id_lokasi_sosialisasi = explode(":",$id_lokasi_sosialisasi);
                $id_lokasi_sosialisasi = $id_lokasi_sosialisasi[0];
        // $sosialisasi = $this->m_sosialisasi->detail_sosialisasi($this->input->post('id_sosialisasi'));
        $lokasi_sosialisasi = $this->m_sosialisasi->detail_sosialisasi($id_lokasi_sosialisasi);
        $this->form_validation->set_rules('id_lokasi_sosialisasi', 'Lokasi Sosialisasi', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));


        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Input sosialisasi',
                'page' => 'sosialisasi/v_input_kunjungan_sosialisasi'
            );
            $this->load->view('v_template',$data,false);
        }else{
            // $config['upload_path']          = './kunjungan_sosialisasi/gambar/';
            // $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            // $config['max_size']             = 2048;
            // $this->upload->initialize($config);

            $config2['upload_path']          = './kunjungan_sosialisasi/laporan/';
            $config2['allowed_types']        = 'pdf|doc|docx';
            $config2['max_size']             = 10000;
            $new_name = $lokasi_sosialisasi->nama_lokasi.'_'.$this->input->post('tanggal');
            // $new_name = $sosialisasi->kode.'_'.$this->input->post('tanggal').'_'.$_FILES["laporan"]['name'];
            $config2['file_name'] = $new_name;
            $this->upload->initialize($config2);
            if ( !$this->upload->do_upload('laporan'))
            {
               
            } else {
                $upload_data2 = array('upload_data2' => $this->upload->data());
                
                $config2['source_file'] = './kunjungan_sosialisasi/laporan/'.$upload_data2['upload_data2']['file_name'];
            }
            $config['upload_path']          = './kunjungan_sosialisasi/gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            $config['max_size']             = 2048;
            $new_name = $lokasi_sosialisasi->nama_lokasi.'_'.$this->input->post('tanggal');
            $config['file_name'] = $new_name;
            $this->upload->initialize($config);
            if ( !$this->upload->do_upload('gambar'))
            {
               
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './kunjungan_sosialisasi/gambar/'.$upload_data['upload_data']['file_name'];
                $this->load->library('image_lib', $config);

            
                
            }  
                $id_lokasi_sosialisasi = $this->input->post('id_lokasi_sosialisasi');
                $id_lokasi_sosialisasi = explode(":",$id_lokasi_sosialisasi);
                $id_lokasi_sosialisasi = $id_lokasi_sosialisasi[0];
                $lokasi_sosialisasi = $this->m_sosialisasi->detail_sosialisasi($id_lokasi_sosialisasi);

                //simpan data ke database
                $data = array(
                    'id_lokasi' => $id_lokasi_sosialisasi,
                    'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
                    'tanggal' => $this->input->post('tanggal'),
                    'pelaksana' => $this->input->post('pelaksana'),
                    'jumlah_peserta' => $this->input->post('jumlah_peserta'),
                    'gambar' => $upload_data['upload_data']['file_name'],
                    'laporan' => $upload_data2['upload_data2']['file_name'],
                    'id_author' => $this->session->userdata('id_user'),
                    'catatan' => $this->input->post('catatan')

                );
    
                $this->m_sosialisasi->input($data,'tbl_kunjungan_sosialisasi');
                $this->session->set_flashdata('pesan', 'Data Kunjungan '.$lokasi_sosialisasi->nama_lokasi .' berhasil Disimpan !!');
                redirect('sosialisasi/input_page_kunjungan');
        }
    }
    public function list_kunjungan()
	{
        $data = array(
            'judul' => 'List Kunjungan',
            'page' => 'sosialisasi/v_list_kunjungan_sosialisasi',
            'kunjungan' => $this->m_sosialisasi->allDataKunjungan(),
        );
		$this->load->view('v_template',$data,false);
	}

    public function detail_sosialisasi($id_sosialisasi){
        $data = array(
            'judul' => 'Detail Lokasi Sosialisasi',
            'page' => 'sosialisasi/v_detail_lokasi_sosialisasi',
            'sosialisasi' => $this->m_sosialisasi->detail_sosialisasi($id_sosialisasi),
            'kunjungan_semua' => $this->m_sosialisasi->allDataKunjungan(),
        );
        
        $this->load->view('v_template', $data, FALSE); 
    }

    public function input_page_kondisi_terkini(){
        $data = array(
            'judul' => 'Input Kondisi sosialisasi',
            'page' => 'sosialisasi/v_input_kondisi_terkini',
            'site' => $this->m_sosialisasi->allData()
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

            $update= $this->m_sosialisasi->update_kondisi_terkini($kode,$kondisi);
            $this->session->set_flashdata('pesan', 'Data sosialisasi berhasil Disimpan !!');
            redirect('sosialisasi/input_page_kondisi_terkini');
        // if ($this->form_validation->run()==FALSE) {
        //     $data = array(
        //         'judul' => 'Input Kondisi sosialisasi',
        //         'page' => 'sosialisasi/v_input_kondisi_terkini',
        //         'site' => $this->m_sosialisasi->allData(),
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
        $site = $this->m_sosialisasi->allData();
        foreach($site as $key => $value){
            $kondisi_terkini = $this->input->post($value->kode);
            if ($kondisi_terkini == NULL) {
                $kondisi_terkini = "OFF";
            }
            $update= $this->m_sosialisasi->update_kondisi_terkini_2($value->kode,$kondisi_terkini);
            $this->session->set_flashdata('pesan', 'Data Kondisi Terkini sosialisasi berhasil Disimpan !!');
         
        }
        // $kondisi = $this->input->post('kondisi_terkini_2');
        // $kode = $this->input->post('kode');

        // $update= $this->m_sosialisasi->update_kondisi_terkini($kode,$kondisi);
        // $this->session->set_flashdata('pesan', 'Data sosialisasi berhasil Disimpan !!');
        redirect('sosialisasi/input_page_kondisi_terkini');
    }

    public function delete($id_sosialisasi){
        $lokasi_sosialisasi = $this->m_sosialisasi->detail_sosialisasi($id_sosialisasi);
        $nama_lokasi = $lokasi_sosialisasi->nama_lokasi;
        $this->m_sosialisasi->delete($id_sosialisasi);
        $this->session->set_flashdata('pesan', 'Data lokasi sosialisasi '.$nama_lokasi. ' berhasil dihapus !!');
                redirect('sosialisasi');
        
    }

    public function edit($id)
    {   
        $data = array(
            'judul' => 'Edit sosialisasi',
            'page' => 'sosialisasi/v_edit_lokasi_sosialisasi',
            'sosialisasi' => $this->m_sosialisasi->detail_sosialisasi($id) 
        );
        
        $this->load->view('v_template', $data, FALSE);
    
        
    }

    public function update_data()
    {
        $this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('koordinat', 'Koordinat', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));
      
        $this->form_validation->set_rules('jenis_lokasi', 'Janis Lokasi', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));


        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Edit Data sosialisasi',
                'page' => 'sosialisasi/v_edit_lokasi_sosialisasi',
                'sosialisasi' => $this->m_sosialisasi->detail_sosialisasi($this->input->post('id_lokasi')) 
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'nama_lokasi' => $this->input->post('nama_lokasi'),
                'koordinat' => $this->input->post('koordinat'),
                'detail_lokasi' => $this->input->post('detail_lokasi'),
                'jenis_lokasi' => $this->input->post('jenis_lokasi'),
                'kabupaten' => $this->input->post('kabupaten')
             
            );

            $this->m_sosialisasi->update($data,$this->input->post('id_lokasi'));
            $this->session->set_flashdata('pesan', 'Data sosialisasi '. $this->input->post('nama_lokasi'). ' Berhasil Diupdate !!');
            redirect('sosialisasi');
        }
    }

    public function detail_kunjungan($id_kunjungan){
        $data = array(
            'judul' => 'Detail Kunjungan Sosialisasi',
            'page' => 'sosialisasi/v_detail_kunjungan_sosialisasi',
            'kunjungan' => $this->m_sosialisasi->detail_kunjungan($id_kunjungan) 
        );
        
        $this->load->view('v_template', $data, FALSE); 
    }

    public function edit_kunjungan($id)
    {   
        $data = array(
            'judul' => 'Edit Kunjungan',
            'page' => 'sosialisasi/v_edit_kunjungan_sosialisasi',
            'kunjungan' => $this->m_sosialisasi->detail_kunjungan($id) 
        );
        
        $this->load->view('v_template', $data, FALSE);
    
        
    }


    public function update_data_kunjungan()
    {
        $this->load->helper('file');
        
        $sosialisasi = $this->m_sosialisasi->detail_sosialisasi($this->input->post('id_lokasi'));
        // $this->form_validation->set_rules('id_sosialisasi', 'Kode Site', 'required', array(
        //     'required' => '%s Wajib Diisi !'
        // ));
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));


        if ($this->form_validation->run()==FALSE) {
            $data = array(
                'judul' => 'Input sosialisasi',
                'page' => 'sosialisasi/v_input_kunjungan_sosialisasi'
            );
            $this->load->view('v_template',$data,false);
        }else{

             //simpan data ke database
             $data = array(
                'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
                'tanggal' => $this->input->post('tanggal'),
                'pelaksana' => $this->input->post('pelaksana'),
                'jumlah_peserta' => $this->input->post('jumlah_peserta'),
                'id_author' => $this->session->userdata('id_user'),
                'catatan' => $this->input->post('catatan')


            );

            $this->m_sosialisasi->update_kunjungan($data,$this->input->post('id_kunjungan'));

            $kun = $this->m_sosialisasi->detail_kunjungan($this->input->post('id_kunjungan'));
            if (!empty($_FILES['laporan']['size'])) {

                unlink('./kunjungan_sosialisasi/laporan/'.$kun->laporan);
            }
            if (!empty($_FILES['gambar']['size'])) {

                unlink('./kunjungan_sosialisasi/gambar/'.$kun->gambar);
            }
            $config2['upload_path']          = './kunjungan_sosialisasi/laporan/';
            $config2['allowed_types']        = 'pdf|doc|docx';
            $config2['max_size']             = 10000;
            $new_name = $sosialisasi->nama_lokasi.'_'.$this->input->post('tanggal');
            // $new_name = $sosialisasi->kode.'_'.$this->input->post('tanggal').'_'.$_FILES["laporan"]['name'];
            $config2['file_name'] = $new_name;
            $this->upload->initialize($config2);
            if ( !$this->upload->do_upload('laporan'))
            {
                // $this->session->set_flashdata('pesan', 'laporan GAGAL disimpan');
                // redirect('sosialisasi/input_page_kunjungan');
            } else {
                $upload_data2 = array('upload_data2' => $this->upload->data());
                $config2['source_file'] = './kunjungan_sosialisasi/laporan/'.$upload_data2['upload_data2']['file_name'];
                $data = array(
                    'laporan' => $upload_data2['upload_data2']['file_name']
    
                );
    
                $this->m_sosialisasi->update_kunjungan($data,$this->input->post('id_kunjungan'));

            }
            $config['upload_path']          = './kunjungan_sosialisasi/gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            $config['max_size']             = 2048;
            $new_name = $sosialisasi->nama_lokasi.'_'.$this->input->post('tanggal');
            $config['file_name'] = $new_name;
            $this->upload->initialize($config);
            if ( !$this->upload->do_upload('gambar'))
            {
               
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './kunjungan_sosialisasi/gambar/'.$upload_data['upload_data']['file_name'];

                //simpan data ke database
                $data = array(
                    'gambar' => $upload_data['upload_data']['file_name']

                );
    
                $this->m_sosialisasi->update_kunjungan($data,$this->input->post('id_kunjungan'));
                
            }  

            $this->session->set_flashdata('pesan', 'Data Kunjungan '.$sosialisasi->nama_lokasi.' dirubah !!');
            redirect('sosialisasi/input_page_kunjungan');

        }
    }



    public function delete_kunjungan($id_kunjungan){
        $kunjungan = $this->m_sosialisasi->detail_kunjungan($id_kunjungan);
        $this->m_sosialisasi->delete_kunjungan($id_kunjungan);
        $this->load->helper("file");
        $path = './kunjungan_sosialisasi/gambar/'.$kunjungan->gambar;
        unlink($path);
        $path = './kunjungan_sosialisasi/laporan/'.$kunjungan->laporan;
        unlink($path);

        // $this->session->set_flashdata('pesan', 'Data sosialisasi '.$nama_lokasi. ' berhasil dihapus !!');
        redirect('sosialisasi');
    }


}