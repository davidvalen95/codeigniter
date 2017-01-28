<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class fungsi extends CI_Controller{
	
	public function index(){
		debug();
	}

	public function setmemory	(){
		
		if(!$this->input->post()){
			return;
		}
		$post 	= $this->input->post();
		
		$set	= $post['set'];
		unset($post['set']);	
		
		if($post['tipe'] == "login"){
			unset($post['tipe']);
			if(isset ($post['email'])){
				$this->load->model('Tablesmodel');
				
				$post['password'] = md5($post['password']);
				$post['aktivasi'] = 'aktivasi';
				$query = $this->Tablesmodel->getWhere("user",$post);
				
			}
			//debug($post);
			unset($post);
			$rowQuery = $query->row();
			
			if(isset($rowQuery)){
				
				$post['nama'] 		= $rowQuery->nama;
				$post['idUser'] 	= $rowQuery->id;	
				$post['tipeUser'] 	= $rowQuery->tipeUser;
			}
			$messege = 'Selamat Datang '.$post['nama'];
		}
		
		
		foreach($post as $key=>$value){
			$post[$key] = $this->encryption->encrypt($value);
		}
		if($set == 'session')
				$this->session->set_userdata($post);
		elseif($set =='cookie'){
			
			foreach($post as $key=>$value){
				
				set_cookie("arsb_".$key,$value,172800);
				//debug(get_cookie($key));
			}
		}
		if(isset($messege)){
			$data		= array(
				'tipe'	=> 'good',
				'messege' => $messege
			);
			$this->session->set_flashdata($data);
		}
		
		redirect(base_url());
	}
	
	
	
	public function logout(){
		$message		= 'Logout berhasil';
		$this->session->unset_userdata('nama');
		delete_cookie('arsb_nama');
		$this->session->unset_userdata('idUser');
		delete_cookie('arsb_idUser');
		$this->session->unset_userdata('tipeUser');
		delete_cookie('arsb_tipeUser');
		
		if(isset($message)){
			$data		= array(
				'tipe'	=> 'good',
				'messege' => $message
			);
			$this->session->set_flashdata($data);
		}
		
		redirect(base_url());
		
		
	}
	public function getcaptcha(){
		$this->load->helper('captcha');
		$vals = array(
		        'img_path'      => './image/captcha/',
		        'img_url'       => base_url().'image/captcha/',
		        'pool'          => '3456789abcdefhkmnrtuvxy',
		);
		$cap = create_captcha($vals);
		$data = array(
		        'captcha_time'  => $cap['time'],
		        'ip_address'    => "::1",
		        'word'          => $cap['word']
		);
		//debug( phpinfo());
		$this->Tablesmodel->insert('captcha',$data);
		
		
		//output berupa <img>
		echo $cap['image'];
		
		// Two hour limit
		$expiration = time() - 7200; 
		$this->db->where('captcha_time < ', $expiration)->delete('captcha');
		
		/*
		
				$customWhere = array(
						'word=' 			=> 'diRk9J9h',
						"ip_address=" 		=>  $this->input->ip_address(),
						'captcha_time >'	=> '7200'
						
						);
				$query = $this->Tablesmodel->getCustomWhere('captcha',$customWhere);
				debug($query->result());*/
		
	}
	

	
	public function aktivasi(){
		$messege 	= "Kode aktivasi salah";
		$tipe		= 'bad';
		
		
		$encrypt = "aktivasi";
		$encrypt = $this->encryption->encrypt($encrypt);
		//debug($encrypt);
		$code = $this->input->get();
		$code = $code['code'];
		//debug($code);
		
		//var_dump($code);
		//var_dump($encrypt);
		//debug($code);
		if($code){
			//mendapatkan id
			$row = $this->Tablesmodel->getWhere('user',array("aktivasi"=>$code))->row();
			
			//update id
			if($row){
				$data['id'][]		= $row->id;
				$data['row'][]		= 'aktivasi';
				$this->Tablesmodel->updateMultipleOneColumn('user','aktivasi',$data);
				$messege			= 'Email anda telah aktif';
				$tipe				= 'good';
			}
		}
		if(isset($messege)){
			$data		= array(
				'tipe'	=> $tipe,
				'messege' => $messege
			);
			$this->session->set_flashdata($data);
		}
		redirect(base_url());
	}
	public function sentmail(){
		/*
		 *	wajib:
		 * 		to: [comma delimiter],[one email],[blank for sent to all]
		 * 		subject
		 * 		content
		 */
		$messege	= "Email terkirim";
		$post 		= $this->input->post();
		$query		= $this->Tablesmodel->getAll('user')->result();
		$to			= $post['to'];
		unset($post['to']);
		
		$redirect	= $post['redirect'];
		unset($post['redirect']);
		
		if($to == '')
		{		
			foreach($query as $row){
				$konten 		= $post['konten'];
				$konten			= str_replace("{nama}", $row->nama, $konten);
				sentMail($row->email,$post['subject'],$konten);
			}
		}else{
			$to 			= explode(',', $to);
			foreach($to as $email){
				sentMail($email,$post['subject'],$post['konten']);
			}	
		}
		//debug($to);
		
		
		
		
		if($redirect){
			$data		= array(
				'tipe'	=> 'good',
				'messege' => $messege
			);
			$this->session->set_flashdata($data);
			redirect($redirect);
		}
	}
	
	public function upload(){
		$path							= 'image/iklan/';
		//chmod('D:/David/Program/xampp/tmp',777);
		//die(ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir());
		if (!file_exists($path))
		{
		    mkdir($path, 777, true);
		}
		
		$config['upload_path']          = $path;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 5012;
		$config['max_width']            = 2000;
		$config['max_height']           = 2000;
	
		
		$this->load->library('upload', $config);
		//debug($_FILES);
		if ( ! $this->upload->do_upload('userfile'))
		{
		        $error = array('error' => $this->upload->display_errors());
		
		    debug($error);
		}
		else
		{
		        $data = array('upload_data' => $this->upload->data());
			redirect();
		    debug();
		}
	}

}

?>
