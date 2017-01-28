<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	public function index()
	{
		if(decodeMemory("session","username")){
			redirect(base_url()."admin/edit");
		}
		$post 		= $this->input->post();
		if(isset($post['username'])){
			if($post['username'] == "admin" && $post['password']=="patricia"){
				unset($post['password']);
				setEncodeMemory("session",$post);
				redirect(base_url()."admin/edit");
			}else{
				$data['notification'] = array("tipe"=>"bad","messege"=>"Login invalid");
				
			}
		}
		
		$data['title']			= "Produk | Hasta Sampurna";
		$data['description']	= "Hasta Sampurna memiliki berbagai produk barang chemical dan jasa water treatment dan produk lain overhaul generator set dan trafo oil treatment plant";
		$data['active']			= "produk";
		$data['script']			= "<link rel='Stylesheet' type='text/css' href='".base_url()."plugin/jHtmlArea/style/jHtmlArea.css' />
  									<script type='text/javascript' src='".base_url()."plugin/jHtmlArea/scripts/jHtmlArea-0.8.js'></script>";	
		$data['noTop']			= "";
		$this->load->view("templates/Header",$data);
		
		$this->load->view("admin/Welcome",$data);
		$this->load->view("templates/Footer",$data);
	}
	public function edit($produk="",$jenis="")
		{
			
			if(!decodeMemory("session","username")){
				redirect(base_url()."admin");
			}
			$view				= "admin/Kategori";
			if($produk==""){
				$data['fetch'] 	= $this->Tablesmodel->getAll("produk");
				
			}elseif($produk!=""){
				$id = $this->Tablesmodel->getWhere("produk",array("nama"=>fromUrlType($produk)))->row()->id;
				//continue
				//$data['fetch']	= $this->Tablesmodel->getWhere("jenisProduk")
			}
			
			$data['nama_produk']			= $produk;
			$data['nama_jenis']			= $jenis;
			$data['title']			= "Produk | Hasta Sampurna";
			$data['description']	= "Hasta Sampurna memiliki berbagai produk barang chemical dan jasa water treatment dan produk lain overhaul generator set dan trafo oil treatment plant";
			$data['active']			= "produk";
			$data['script']			= "<link rel='Stylesheet' type='text/css' href='".base_url()."plugin/jHtmlArea/style/jHtmlArea.css' />
	  									<script type='text/javascript' src='".base_url()."plugin/jHtmlArea/scripts/jHtmlArea-0.8.js'></script>";	
			$data['noTop']			= "";
			$this->load->view("templates/Header",$data);
			$this->load->view($view,$data);
			$this->load->view("templates/Footer",$data);
		}
}
?>
