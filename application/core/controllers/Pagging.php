<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagging extends CI_Controller {

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
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['page']='page/dashboard';
			$this->load->view('home',$d);
		}
	}

	public function Login(){
		$this->load->view('login');
	}

	public function PaggingGlobal(){
		$name_uri=$this->uri->segment(1);
		$page_name_db=$this->model_global->daftar_menu($name_uri)->row()->nama_menu;
		$d['page']='page/'.$name_uri;				
		$d['page_name']=$page_name_db;
		$this->load->view('home',$d);		
	}

	public function Beranda(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['page']='page/dashboard';
			$this->load->view('home',$d);
		}
	}



	public function ChatForum(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['page']='page/chat_forum';
			$d['page_name']='Chat Room';
			$this->load->view('home',$d);
		}
	}		

	public function newsComment(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['page']='page/news_comment';
			$d['page_name']='Komen Berita';
			$this->load->view('home',$d);
		}
	}	


	public function partial_daerah(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$name_uri=$this->uri->segment(1);
			$judul=array(
				'kabupaten'=>'Kabupaten',
				'kecamatan'=>'Kecamatan',
				'kelurahan'=>'Kelurahan',
			);				
			$d['id_parent']=$this->uri->segment(2);
			$d['page']='page/'.$name_uri;
			$d['page_name']=$judul[$name_uri];
			$this->load->view('home',$d);
		}
	}	

	public function partial_pemilihan(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$name_uri=$this->uri->segment(1);
			$judul=array(
				'calon'=>'Calon',				
			);				
			$d['id_parent']=$this->uri->segment(2);
			$d['page']='page/'.$name_uri;
			$d['page_name']=$judul[$name_uri];
			$this->load->view('home',$d);
		}
	}

	public function daerah(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['page']='page/provinsi';
			$d['page_name']='Provinsi';
			$this->load->view('home',$d);
		}
	}	






























	// public function Pageforum(){
	// 	if(!$this->session->userdata('islogin')){
	// 		redirect('Login','refresh');
	// 	} else {
	// 		$d['page']='page/forum';
	// 		$d['page_name']='Forum';
	// 		$this->load->view('home',$d);
	// 	}
	// }	
 
	// public function Pengguna(){
	// 	if(!$this->session->userdata('islogin')){
	// 		redirect('Login','refresh');
	// 	} else {
	// 		$d['page']='page/pengguna';
	// 		$d['page_name']='Pengguna';
	// 		$this->load->view('home',$d);
	// 	}
	// }	

	// public function Company(){
	// 	if(!$this->session->userdata('islogin')){
	// 		redirect('Login','refresh');
	// 	} else {
	// 		$d['page']='page/Company';
	// 		$d['page_name']='Data Perusahaan';
	// 		$this->load->view('home',$d);
	// 	}
	// }

	// public function Berita(){
	// 	if(!$this->session->userdata('islogin')){
	// 		redirect('Login','refresh');
	// 	} else {
	// 		$d['page']='page/Berita';
	// 		$d['page_name']='berita';
	// 		$this->load->view('home',$d);
	// 	}
	// }	



}
