<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($al="sdf")
	{
		$data['title']			= "Official Site | Hasta Sampurna";
		$data['description']	= "Hasta Sampurna adalah sebuah perusahaan yang menjual barang dan jasa. Kami menjual bahan kimia dengan stock gudang yang besar. Kamu menjual jasa water treatment dengan kualitas yang baik";
		$data['active']			= "home";
		$this->load->view("templates/Header",$data);
		$this->load->view("Welcome_message",$data);
		
		$this->load->view("templates/Footer",$data);
	}
	
	
}
