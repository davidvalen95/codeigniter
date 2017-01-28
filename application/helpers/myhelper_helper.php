<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function debug($name ="hehe"){
		die(var_dump($name));
	}
	
	
	function decodeMemory($set,$nama){
		 $CI = get_instance();
		//mendapatkan nilai decoded ddari sebuah session
		//
		if($set =='session'){
			return $CI->encryption->decrypt($CI->session->userdata($nama));
		}elseif ($set =='cookie'){
			
			return $CI->encryption->decrypt(get_cookie("arsb_".$nama));
			
		}
			
	}
	function setEncodeMemory($set,$post){
		//debug($post);
		$CI = get_instance();
		foreach($post as $key=>$value){
			$post[$key] = $CI->encryption->encrypt($value);
		}
		if($set=="session"){
			$CI->session->set_userdata($post);
		}
		elseif ($set="cookie") {
			foreach($post as $key=>$value){
				
				set_cookie("arsb_".$key,$value,172800);
				//debug(get_cookie($key));
			}
		}
	}
	function getLastUri(){
		$CI = get_instance();
		//array of segment
		$segment =$CI->uri->segment_array();
		//mendapatkan last agar tidak passing by reference
		$last= end($segment);
		
		//jika index pasti kosong
		$name= ($last===false||$last===true?"home":$last);
		return $name;
	}
	function thousand($param){
		return number_format($param,0,",","."); 
	}
	
	function sentMail($to,$subject,$konten){
		
		$CI = get_instance();
		
		/*$config = Array(         'mailtype'  => 'html');*/
		$config			= array();
		$CI->load->library('email',$config);
		$CI->email->clear();
		$CI->email->from('admin@prodela.co', 'Prodela');
		$CI->email->to($to);
		/*
		$CI->email->cc('another@another-example.com');
				$CI->email->bcc('them@their-example.com');*/
		$CI->email->subject($subject);
		/*
		$body ="
					<html>
						<head>
							<meta charset='utf-8' />
							<title>Anil Labs - Codeigniter mail templates</title>
							<meta name='viewport' content='width=device-width, initial-scale=1.0' />
						</head>
						<body>
							$konten
							
						</body>
					</html>
				
				";*/
		$body 	= $konten;
		$CI->email->message($body);
		$CI->email->send();
	}
	function urlType($parameter){
		//mendapatkan nilai url dari sebuah parameter
		$parameter = strtolower($parameter);
		$parameter = str_replace(' ','-',$parameter);
		return $parameter;
	}
	function fromUrlType($parameter){
		$parameter = str_replace('-',' ',$parameter);
		$parameter = ucwords($parameter);
		
		return $parameter;
	}
	
	function pagination($table,$baseUrl,$current){
		/*
		 * totalData	: data dari table
		 * fetch		: data per page
		 * threshold	: deretan pagination
		 * last			: pagination terakhir
		 * 
		 * start	: terawal dari current
		 * end		: terjuh dari pagination
		 * 
		 * 
		 */
		$CI = get_instance();
		
		
		
		$totalData	 		= $CI->Tablesmodel->countOne($table,array());
		$fetch	 			= FETCH;
		$threshold			= 3;
		$last				= ceil($totalData / $fetch);
		
		
		$start				= ($current-$threshold >= $threshold?$current-$threshold:1);
		$end				= ($current+$threshold >= $last?$last:$current+$threshold);
		//debug(ceil($pagination / $fetch));
		$list 				= "
					<ul class='pagination'>
						<a href='$baseUrl?pagination=1'><li>First</li></a>			
		";
		for($i=$start;$i<=$end;$i++){
			$href    		= ($i==$current?"":"href='$baseUrl?pagination=$i'");
			$active  		= ($i==$current?"active":"");
			
			
			$list	.= "<a $href class='$active'><li>$i</li></a>";
		}
			
		$list				.= "<a href='$baseUrl?pagination=$last'><li>Last</li></a>		</ul>";
		return $list;
	}

	function formatNama($param){
		
		$param = preg_replace('/([^A-Za-z ])+/', '', $param);
		$param = preg_replace('/(\s{2,})+/', ' ', $param);
		$param = strtolower($param);
		$param = ucwords($param);
			
		return $param;
	}
	function myRedirect($redirect='',$tipe='good',$messege=''){
		$CI			= get_instance();	
		$redirect	=(''?base_url:$redirect);
		
		$data		= array(
			'tipe'	=> $tipe,
			'messege' => $messege
		);
		$CI->session->set_flashdata($data);
		
		redirect($redirect);
		
	}
?>