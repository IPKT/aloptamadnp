<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gis extends CI_Controller {
	public function index()
	{
        $data = array(
            'judul' => 'Home',
            'page' => 'v_home'
        );
		$this->load->view('v_template',$data,false);
	}

    public function viewmap()
	{
        $data = array(
            'judul' => 'View Map',
            'page' => 'v_view_map'
        );
		$this->load->view('v_template',$data,false);
	}

    public function viewbasemap()
	{
        $data = array(
            'judul' => 'Base Map',
            'page' => 'v_base_map'
        );
		$this->load->view('v_template',$data,false);
	}

    public function marker()
	{
        $data = array(
            'judul' => 'Marker',
            'page' => 'v_marker'
        );
		$this->load->view('v_template',$data,false);
	}

    public function geojson()
	{
        $data = array(
            'judul' => 'GeoJSON',
            'page' => 'v_geojson'
        );
		$this->load->view('v_template',$data,false);
	}

    public function getcoordinat()
	{
        $data = array(
            'judul' => 'Get koordinat',
            'page' => 'v_get_coordinat'
        );
		$this->load->view('v_template',$data,false);
	}
}
 