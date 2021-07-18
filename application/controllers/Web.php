<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

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
		echo "h";
	}

	public function AksiLogin(){
		$usr=$this->input->post('username');
		$pwd=$this->input->post('password');

		$this->model_global->AksiLoginUser($usr,$pwd);
	}

	public function logout(){
		//$this->model_global->Offline();
		$this->session->sess_destroy();
		$this->load->view('login');
	}

	public function lnk(){
		echo base_url()."Web/logout";
	}
}