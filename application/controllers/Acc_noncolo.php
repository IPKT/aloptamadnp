<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acc_noncolo extends CI_Controller {

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
         $this->load->model('m_acc_noncolo');
         if (
         $this->session->userdata('username') == null
         ) {
            redirect('auth');
         }
         
     }

    public function index()
	{
        $data = array(
            'judul' => 'Pemetaan Lokasi acc_noncolo',
            'page' => 'acc_noncolo/v_pemetaan_acc_noncolo',
            'acc_noncolo' => $this->m_acc_noncolo->allData(),
        );
		$this->load->view('v_template',$data,false);
	}
     public function input_page()
	{
        $data = array(
            'judul' => 'Input acc_noncolo',
            'page' => 'acc_noncolo/v_input_acc_noncolo',
            'acc_noncolo' => $this->m_acc_noncolo->allData()

        );
		$this->load->view('v_template',$data,false);
	}

    public function input_data()
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
                'judul' => 'Input acc_noncolo',
                'page' => 'acc_noncolo/v_input_acc_noncolo'
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'kode' => $this->input->post('kode'),
                'koordinat' => $this->input->post('koordinat'),
                'lokasi' => $this->input->post('lokasi'),
                'detail_lokasi' => $this->input->post('detail_lokasi'),
                'tipe' => $this->input->post('tipe'),
             
            );

            $this->m_acc_noncolo->input($data,'tbl_acc_noncolo');
            $this->session->set_flashdata('pesan', 'Data acc_noncolo berhasil Disimpan !!');
            redirect('acc_noncolo/input_page');
        }
    }

    public function input_page_kunjungan(){
        $data = array(
            'judul' => 'Input Kunjungan acc_noncolo',
            'page' => 'acc_noncolo/v_input_kunjungan_acc_noncolo',
            'site' => $this->m_acc_noncolo->allData()
        );
		$this->load->view('v_template',$data,false);
    }

    public function input_data_kunjungan()
    {
                $id_acc_noncolo = $this->input->post('id_acc_noncolo');
                $id_acc_noncolo = explode(":",$id_acc_noncolo);
                $id_acc_noncolo = $id_acc_noncolo[0];
        // $acc_noncolo = $this->m_acc_noncolo->detail_acc_noncolo($this->input->post('id_acc_noncolo'));
        $acc_noncolo = $this->m_acc_noncolo->detail_acc_noncolo($id_acc_noncolo);
        $this->form_validation->set_rules('id_acc_noncolo', 'Kode Site', 'required', array(
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
                'judul' => 'Input acc_noncolo',
                'page' => 'acc_noncolo/v_input_kunjungan_acc_noncolo'
            );
            $this->load->view('v_template',$data,false);
        }else{
            // $config['upload_path']          = './kunjungan_acc_noncolo/gambar/';
            // $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            // $config['max_size']             = 2048;
            // $this->upload->initialize($config);

            $config2['upload_path']          = './kunjungan_acc_noncolo/laporan/';
            $config2['allowed_types']        = 'pdf|doc|docx';
            $config2['max_size']             = 10000;
            $new_name = $acc_noncolo->kode.'_'.$this->input->post('tanggal');
            // $new_name = $acc_noncolo->kode.'_'.$this->input->post('tanggal').'_'.$_FILES["laporan"]['name'];
            $config2['file_name'] = $new_name;
            $this->upload->initialize($config2);
            if ( !$this->upload->do_upload('laporan'))
            {
                $this->session->set_flashdata('pesan', 'laporan GAGAL disimpan');
                redirect('acc_noncolo/input_page_kunjungan');
            } else {
                $upload_data2 = array('upload_data2' => $this->upload->data());
                
                $config2['source_file'] = './kunjungan_acc_noncolo/laporan/'.$upload_data2['upload_data2']['file_name'];
            }
            $config['upload_path']          = './kunjungan_acc_noncolo/gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            $config['max_size']             = 2048;
            $new_name = $acc_noncolo->kode.'_'.$this->input->post('tanggal');
            $config['file_name'] = $new_name;
            $this->upload->initialize($config);
            if ( !$this->upload->do_upload('gambar'))
            {
                // $this->session->set_flashdata('pesan', 'Gambar GAGAL disimpan');
                // redirect('acc_noncolo/input_page_kunjungan');
                $id_acc_noncolo = $this->input->post('id_acc_noncolo');
                $id_acc_noncolo = explode(":",$id_acc_noncolo);
                $id_acc_noncolo = $id_acc_noncolo[0];
                $acc_noncolo = $this->m_acc_noncolo->detail_acc_noncolo($id_acc_noncolo);

                //simpan data ke database
                $data = array(
                    'id_acc_noncolo' => $id_acc_noncolo,
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
    
                $this->m_acc_noncolo->input($data,'tbl_kunjungan_acc_noncolo');
                $this->session->set_flashdata('pesan', 'Data Kunjungan '.$acc_noncolo->kode .' berhasil Disimpan !!');
                redirect('acc_noncolo/input_page_kunjungan');
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './kunjungan_acc_noncolo/gambar/'.$upload_data['upload_data']['file_name'];
                $this->load->library('image_lib', $config);

            
                $id_acc_noncolo = $this->input->post('id_acc_noncolo');
                $id_acc_noncolo = explode(":",$id_acc_noncolo);
                $id_acc_noncolo = $id_acc_noncolo[0];
                $acc_noncolo = $this->m_acc_noncolo->detail_acc_noncolo($id_acc_noncolo);

                //simpan data ke database
                $data = array(
                    'id_acc_noncolo' => $id_acc_noncolo,
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
    
                $this->m_acc_noncolo->input($data,'tbl_kunjungan_acc_noncolo');
                $this->session->set_flashdata('pesan', 'Data Kunjungan '.$acc_noncolo->kode .' berhasil Disimpan !!');
                redirect('acc_noncolo/input_page_kunjungan');
            }  

        }
    }

    public function list_kunjungan()
	{
        $data = array(
            'judul' => 'List Kunjungan',
            'page' => 'acc_noncolo/v_list_kunjungan_acc_noncolo',
            'kunjungan' => $this->m_acc_noncolo->allDataKunjungan(),
        );
		$this->load->view('v_template',$data,false);
	}

    public function detail_acc_noncolo($id_acc_noncolo){
        $data = array(
            'judul' => 'Detail acc_noncolo',
            'page' => 'acc_noncolo/v_detail_acc_noncolo',
            'acc_noncolo' => $this->m_acc_noncolo->detail_acc_noncolo($id_acc_noncolo),
            'kunjungan_semua' => $this->m_acc_noncolo->allDataKunjungan(),
        );
        
        $this->load->view('v_template', $data, FALSE); 
    }

    public function input_page_kondisi_terkini(){
        $data = array(
            'judul' => 'Input Kondisi acc_noncolo',
            'page' => 'acc_noncolo/v_input_kondisi_terkini',
            'site' => $this->m_acc_noncolo->allData()
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

            $update= $this->m_acc_noncolo->update_kondisi_terkini($kode,$kondisi);
            $this->session->set_flashdata('pesan', 'Data acc_noncolo berhasil Disimpan !!');
            redirect('acc_noncolo/input_page_kondisi_terkini');
        // if ($this->form_validation->run()==FALSE) {
        //     $data = array(
        //         'judul' => 'Input Kondisi acc_noncolo',
        //         'page' => 'acc_noncolo/v_input_kondisi_terkini',
        //         'site' => $this->m_acc_noncolo->allData(),
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
        $site = $this->m_acc_noncolo->allData();
        foreach($site as $key => $value){
            $kondisi_terkini = $this->input->post($value->kode);
            if ($kondisi_terkini == NULL) {
                $kondisi_terkini = "OFF";
            }
            $update= $this->m_acc_noncolo->update_kondisi_terkini_2($value->kode,$kondisi_terkini);
            $this->session->set_flashdata('pesan', 'Data Kondisi Terkini acc_noncolo berhasil Disimpan !!');
         
        }
        // $kondisi = $this->input->post('kondisi_terkini_2');
        // $kode = $this->input->post('kode');

        // $update= $this->m_acc_noncolo->update_kondisi_terkini($kode,$kondisi);
        // $this->session->set_flashdata('pesan', 'Data acc_noncolo berhasil Disimpan !!');
        redirect('acc_noncolo/input_page_kondisi_terkini');
    }

    public function delete($id_acc_noncolo){
        $kode = $this->m_acc_noncolo->detail_acc_noncolo($id_acc_noncolo);
        $nama_lokasi = $kode->kode;
        $this->m_acc_noncolo->delete($id_acc_noncolo);
        $this->session->set_flashdata('pesan', 'Data acc_noncolo '.$nama_lokasi. ' berhasil dihapus !!');
                redirect('acc_noncolo');
    }

    public function edit($id)
    {   
        $data = array(
            'judul' => 'Edit acc_noncolo',
            'page' => 'acc_noncolo/v_edit_acc_noncolo',
            'acc_noncolo' => $this->m_acc_noncolo->detail_acc_noncolo($id) 
        );
        
        $this->load->view('v_template', $data, FALSE);
    
        
    }

    public function update_data()
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
                'judul' => 'Edit Data acc_noncolo',
                'page' => 'acc_noncolo/v_edit_acc_noncolo',
                'acc_noncolo' => $this->m_acc_noncolo->detail_acc_noncolo($id) 
            );
            $this->load->view('v_template',$data,false);
        }else{
            $data = array(
                'kode' => $this->input->post('kode'),
                'koordinat' => $this->input->post('koordinat'),
                'lokasi' => $this->input->post('lokasi'),
                'detail_lokasi' => $this->input->post('detail_lokasi'),
                'tipe' => $this->input->post('tipe'),
             
            );

            $this->m_acc_noncolo->update($data,$this->input->post('id'));
            $this->session->set_flashdata('pesan', 'Data acc_noncolo berhasil Diupdate !!');
            redirect('acc_noncolo');
        }
    }

    public function detail_kunjungan($id_lokasi){
        $data = array(
            'judul' => 'Detail Kunjungan acc_noncolometer',
            'page' => 'acc_noncolo/v_detail_kunjungan_acc_noncolo',
            'lokasi' => $this->m_acc_noncolo->detail_kunjungan($id_lokasi) 
        );
        
        $this->load->view('v_template', $data, FALSE); 
    }

    public function edit_kunjungan($id)
    {   
        $data = array(
            'judul' => 'Edit Kunjungan',
            'page' => 'acc_noncolo/v_edit_kunjungan_acc_noncolo',
            'kunjungan' => $this->m_acc_noncolo->detail_kunjungan($id) 
        );
        
        $this->load->view('v_template', $data, FALSE);
    
        
    }


    public function update_data_kunjungan()
    {
        $this->load->helper('file');
        
        $acc_noncolo = $this->m_acc_noncolo->detail_acc_noncolo($this->input->post('id_acc_noncolo'));
        // $this->form_validation->set_rules('id_acc_noncolo', 'Kode Site', 'required', array(
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
                'judul' => 'Input acc_noncolo',
                'page' => 'acc_noncolo/v_input_kunjungan_acc_noncolo'
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

            $this->m_acc_noncolo->update_kunjungan($data,$this->input->post('id_kunjungan'));

            $kun = $this->m_acc_noncolo->detail_kunjungan($this->input->post('id_kunjungan'));
            if (!empty($_FILES['laporan']['size'])) {

                unlink('./kunjungan_acc_noncolo/laporan/'.$kun->laporan);
            }
            if (!empty($_FILES['gambar']['size'])) {

                unlink('./kunjungan_acc_noncolo/gambar/'.$kun->gambar);
            }
            $config2['upload_path']          = './kunjungan_acc_noncolo/laporan/';
            $config2['allowed_types']        = 'pdf|doc|docx';
            $config2['max_size']             = 10000;
            $new_name = $acc_noncolo->kode.'_'.$this->input->post('tanggal');
            // $new_name = $acc_noncolo->kode.'_'.$this->input->post('tanggal').'_'.$_FILES["laporan"]['name'];
            $config2['file_name'] = $new_name;
            $this->upload->initialize($config2);
            if ( !$this->upload->do_upload('laporan'))
            {
                // $this->session->set_flashdata('pesan', 'laporan GAGAL disimpan');
                // redirect('acc_noncolo/input_page_kunjungan');
            } else {
                $upload_data2 = array('upload_data2' => $this->upload->data());
                $config2['source_file'] = './kunjungan_acc_noncolo/laporan/'.$upload_data2['upload_data2']['file_name'];
                $data = array(
                    'laporan' => $upload_data2['upload_data2']['file_name']
    
                );
    
                $this->m_acc_noncolo->update_kunjungan($data,$this->input->post('id_kunjungan'));

            }
            $config['upload_path']          = './kunjungan_acc_noncolo/gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';
            $config['max_size']             = 2048;
            $new_name = $acc_noncolo->kode.'_'.$this->input->post('tanggal');
            $config['file_name'] = $new_name;
            $this->upload->initialize($config);
            if ( !$this->upload->do_upload('gambar'))
            {
               
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './kunjungan_acc_noncolo/gambar/'.$upload_data['upload_data']['file_name'];

                //simpan data ke database
                $data = array(
                    'gambar' => $upload_data['upload_data']['file_name']

                );
    
                $this->m_acc_noncolo->update_kunjungan($data,$this->input->post('id_kunjungan'));
                
            }  

            $this->session->set_flashdata('pesan', 'Data Kunjungan '.$acc_noncolo->kode.' dirubah !!');
            redirect('acc_noncolo/input_page_kunjungan');

        }
    }


    public function delete_kunjungan($id_kunjungan){
        $kunjungan = $this->m_acc_noncolo->detail_kunjungan($id_kunjungan);
        $this->m_acc_noncolo->delete_kunjungan($id_kunjungan);
        $this->load->helper("file");
        $path = './kunjungan_acc_noncolo/gambar/'.$kunjungan->gambar;
        unlink($path);
        $path = './kunjungan_acc_noncolo/laporan/'.$kunjungan->laporan;
        unlink($path);

        // $this->session->set_flashdata('pesan', 'Data acc_noncolo '.$nama_lokasi. ' berhasil dihapus !!');
        redirect('acc_noncolo/list_kunjungan');
    }


}