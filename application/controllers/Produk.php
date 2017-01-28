<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

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
		$data['title']			= "Produk | Hasta Sampurna";
		$data['description']	= "Hasta Sampurna memiliki berbagai produk barang chemical dan jasa water treatment dan produk lain overhaul generator set dan trafo oil treatment plant";
		$data['active']			= "produk";
		$this->load->view("templates/Header",$data);
		
		$this->load->view("produk/Welcome",$data);
		$this->load->view("templates/Footer",$data);
	}
	public function daftar($produk="default"){
		$data['title']			= "Produk | Hasta Sampurna";
		$data['description']	= "Hasta Sampurna memiliki berbagai produk barang chemical dan jasa water treatment dan produk lain overhaul generator set dan trafo oil treatment plant";
		$data['active']			= "produk";
		$produk=urlType($produk);
		if($produk=="chemical"){
			$data['h2']		= "Produk Kimia";
			$data['span']	= "PT. Hasta Sampurna menyuplai berbagai bahan kimia";
			
		}
		
	
		$this->load->view("templates/Header",$data);
		$this->load->view("produk/Header",$data);
		if ($produk=="gudang") {
			$this->load->view("produk/Gudang",$data);
			
		}else{
			$this->load->view("produk/List_produk",$data);
		}
		$this->load->view("templates/Footer",$data);
	}
}
