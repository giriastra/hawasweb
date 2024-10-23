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


	 public function __construct(){
 		parent::__construct();
 		$this->load->model('Model_pengaduan');
		$this->load->helper(array('form', 'url'));
 	}


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

		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {

			$name_uri=$this->uri->segment(1);
			$page_name_db=$this->model_global->daftar_menu($name_uri)->row()->nama_menu;
			$d['page']='page/'.$name_uri;
			$d['page_name']=$page_name_db;
			$this->load->view('home',$d);
		}

	}

	public function Beranda(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['page']='page/dashboard';
			$this->load->view('home',$d);
		}
	}

	public function privacy(){
		$d['page']='privacy_policy';
		$this->load->view('privacy_policy',$d);
	}
	
	public function privacyPetugas(){
		$d['page']='privacy-policy-hawas-petugas';
		$this->load->view('privacy_policy_hawas_petugas',$d);
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

	public function ComplaintDetail(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['page']='page/complaint_detail';
			$d['page_name']='Complaint';
			$this->load->view('home',$d);
		}
	}

	public function TrackingStatus(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['page']='page/tracking_status';
			$d['page_name']='Tracking Penyelesaian Laporan';
			$d['dt_complaint']= $this->Model_pengaduan->getPengaduanById($this->uri->segment(2));
		

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
			if($this->session->userdata('level_akses')=='5'){
				if ($this->uri->segment(1)=='kecamatan') {
					$name_uri='kecamatan';
				} else {
					$name_uri='kelurahan';
				}

				$judul=array(
					'kabupaten'=>'Kabupaten',
					'kecamatan'=>'Kecamatan',
					'kelurahan'=>'Kelurahan',
				);
				$d['id_parent']=$this->uri->segment(2);
				$d['page']='page/'.$name_uri;
				$d['page_name']=$judul[$name_uri];
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
			}

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
			if($this->session->userdata('level_akses')=='5'){
				$d['page']='page/kecamatan';
				$d['page_name']='Kecamatan';
				$d['id_parent']=$this->session->userdata('id_kabupaten');
				$this->load->view('home',$d);
			} else {
				$d['page']='page/provinsi';
				$d['page_name']='Provinsi';
				$this->load->view('home',$d);
			}
		}
	}

	public function PetugasTps(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['page']='page/petugas_tps';
			$d['id_tps']=$this->uri->segment(2);
			$d['page_name']='Petugas TPS';
			$this->load->view('home',$d);
		}
	}

	public function MapsTPS(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {

			$zoom = 6;
			if (strlen($this->uri->segment(2))>0) {
				$zoom = 14;
				$sqlData=$this->model_global->getDataGlobal('tb_tps','id_tps',$this->uri->segment(2));
			} else {
				if($this->session->userdata('level_akses')==5){
					$zoom = 10;
					$sqlData=$this->model_global->getDataGlobal('tb_tps','id_kabupaten',($this->session->userdata('id_kabupaten')));
				}else{
					$sqlData=$this->model_global->getDataGlobal('tb_tps');
				}

			}
			$getDataMark=array();
			foreach ($sqlData->result_array() as $rowMark) {
				$getDataMark[]=$rowMark;
			}


			$dataCompany=$this->model_global->getCompanyProfile()->row();
			if($dataCompany->latitude=="0"){
				$d['lat']=config_item('LAT_OFFICE');
				$d['long']=config_item('LONG_OFFICE');
			}else{
				$d['lat']=$dataCompany->latitude;
				$d['long']=$dataCompany->longitude;
			}


			$d['resultMark']=json_encode($getDataMark);
			$d['page']='page/map_tps';
			$d['tipe_view']='page/map_tps';
			$d['id_tps']=$this->uri->segment(2);
			$d['page_name']='MAPS TPS';
			$d['zoom']=$zoom;
			$this->load->view('home',$d);
		}
	}

	public function HitungCepat(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['type_pemilihan']=$_GET['type_pemilihan'];
			if ($d['type_pemilihan']=='pilgub') {
				$d['id_prov']=$_GET['provinsi'];
				$d['dataQuickcount']=$this->model_global->GetdataQuickcount($d['id_prov'],$d['type_pemilihan']);
				$d['querydataQuick']=$this->model_global->GetTotalSuara($d['id_prov'],$d['type_pemilihan']);
				$getDataQuick=array();
				$getDataQuick2=array();
				foreach ($this->model_global->GetTotalSuara($d['id_prov'],$d['type_pemilihan'])->result_array() as $rowQuick) {
					$getDataQuick[]=(int)$rowQuick['total_suara'];
					$getDataQuick2[]=$rowQuick['nama_paket'];
				}
				$d['resultDataQuick']=json_encode($getDataQuick);
				$d['NamaPaket']=json_encode($getDataQuick2);
			} else {
				$d['id_kab']=$_GET['kabupaten'];
				$d['dataQuickcount']=$this->model_global->GetdataQuickcount($d['id_kab'],$d['type_pemilihan']);
				$d['querydataQuick']=$this->model_global->GetTotalSuara($d['id_kab'],$d['type_pemilihan']);
				$getDataQuick=array();
				$getDataQuick2=array();
				foreach ($this->model_global->GetTotalSuara($d['id_kab'],$d['type_pemilihan'])->result_array() as $rowQuick) {
					$getDataQuick[]=(int)$rowQuick['total_suara'];
					$getDataQuick2[]=$rowQuick['nama_paket'];
				}
				$d['resultDataQuick']=json_encode($getDataQuick);
				$d['NamaPaket']=json_encode($getDataQuick2);
			}
			$d['page']='page/hitungcepat';
			$d['page_name']='Quickcount';
			$this->load->view('home',$d);
		}
	}

	public function LokasiPetugas(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {

				$d['status_online']='';
						$d['page']='utility/map_petugas';
			$d['name']=$this->model_global->getDataGlobal('tb_user','id_user',$this->uri->segment(2))->row()->name;
			$d['lat']=$this->uri->segment(3);
			$d['long']=$this->uri->segment(4);
			$d['zoom']=10;
			$lokasiPetugas=array();
			$arrayLokasi=array('nama_petugas' => $d['name'],'latitude' => $d['lat'],'longitude' => $d['long'],'status_online'=>$d['status_online']);
			$lokasiPetugas[]=$arrayLokasi;
			$d['LokasiTerkiniPetugas']= json_encode($lokasiPetugas);

			$d['page_name']='Lokasi Petugas';
			$this->load->view('home',$d);
		}
	}

	public function LokasiSemuaPetugasOnline(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$sqlDataPetugas=$this->model_global->ShowPetugasOnlineForMaps();
			$lokasiPetugas=array();
			foreach ($sqlDataPetugas->result_array() as $rowMarker) {
				$lokasiPetugas[]=$rowMarker;
			}
			$dataCompany=$this->model_global->getCompanyProfile()->row();
			if($dataCompany->latitude=="0"){
				$d['lat']=config_item('LAT_OFFICE');
				$d['long']=config_item('LONG_OFFICE');
			}else{
				$d['lat']=$dataCompany->latitude;
				$d['long']=$dataCompany->longitude;
			}
			$d['page']='utility/map_petugas';
			$d['zoom']=5;
			$d['LokasiTerkiniPetugas']= json_encode($lokasiPetugas);
			$d['page_name']='Lokasi Seluruh Petugas Online';
			$this->load->view('home',$d);
		}
	}

	public function RiwayatLokasiPetugas(){
		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['id_petugas']=$this->uri->segment(2);
			$d['SqlRiwayatLokasiPetugas']=$this->model_global->RiwayatLokasiPetugas($d['id_petugas']);
			$d['page_name']='Riwayat lokasi Petugas';
			$d['page']='page/riwayat_lokasi_petugas';
			$this->load->view('home',$d);
		}
	}

	public function GetDataSuaraPeilihan(){
			$d['id_provinsi']=@$_GET['id_provinsi'];
			$d['id_kabupaten']=@$_GET['id_kabupaten'];
			$d['id_kecamatan']=@$_GET['id_kecamatan'];
			$d['id_kelurahan']=@$_GET['id_kelurahan'];
			$d['id_pemilihan']=$_GET['id_pemilihan'];
			$type=$_GET['type_pemilihan'];
			$start_form = @$_GET['start_form'];
			$d['start_form']=@$_GET['start_form'];

			if ($type=='pilgub') {
				$d['label_name']='Perhitungan Tingkat Provinsi';
				$d['label_tabel']='Suara Live per Kabupaten';
				$d['dataTabelSuara']=$this->model_global->GetDataTableSuara($start_form,'get_provinsi',$d['id_pemilihan'],$d['id_provinsi']);
				$d['dataCartSuara']=$this->model_global->GetDataSuaraPerProvinsi($start_form,'get_provinsi',$d['id_pemilihan'],$d['id_provinsi']);
				$d['type_pemilihan_now']='In_provinsi';
				$d['type_pemilihan_next']='pilbub';
			} else if ($type=='pilbub') {
				$d['label_name']='Perhitungan Tingkat Kabupaten';
				$d['label_tabel']='Suara Live per Kecamatan';
				$getIDProv=$this->model_global->getDataGlobal('tb_kabupaten','id_kabupaten',$d['id_kabupaten'])->row()->id_provinsi;
				$d['dataTabelSuara']=$this->model_global->GetDataTableSuara($start_form,'get_kabupaten',$d['id_pemilihan'],$getIDProv,$d['id_kabupaten']);
				$d['dataCartSuara']=$this->model_global->GetDataSuaraPerProvinsi($start_form,'get_kabupaten',$d['id_pemilihan'],$getIDProv,$d['id_kabupaten']);
				$d['type_pemilihan_now']='In_kabupaten';
				$d['type_pemilihan_next']='kecamatan';
			} else if ($type=='kecamatan') {
				$d['label_name']='Perhitungan Tingkat Kecamatan';
				$d['label_tabel']='Suara Live per Kelurahan';
				$getIDProv=$this->model_global->getDataGlobal('tb_kabupaten','id_kabupaten',$d['id_kabupaten'])->row()->id_provinsi;
				$d['dataTabelSuara']=$this->model_global->GetDataTableSuara($start_form,'get_kecamatan',$d['id_pemilihan'],$getIDProv,$d['id_kabupaten'],$d['id_kecamatan']);
				$d['dataCartSuara']=$this->model_global->GetDataSuaraPerProvinsi($start_form,'get_kecamatan',$d['id_pemilihan'],$getIDProv,$d['id_kabupaten'],$d['id_kecamatan']);
				$d['type_pemilihan_now']='In_kecamatan';
				$d['type_pemilihan_next']='kelurahan';
			} else if ($type=='kelurahan') {
				$d['label_name']='Perhitungan Tingkat Kelurahan';
				$d['label_tabel']='Suara Live per TPS';
				$getIDProv=$this->model_global->getDataGlobal('tb_kabupaten','id_kabupaten',$d['id_kabupaten'])->row()->id_provinsi;
				$d['dataTabelSuara']=$this->model_global->GetDataTableSuara($start_form,'get_kelurahan',$d['id_pemilihan'],$getIDProv,$d['id_kabupaten'],$d['id_kecamatan'],$d['id_kelurahan']);
				$d['dataCartSuara']=$this->model_global->GetDataSuaraPerProvinsi($start_form,'get_kelurahan',$d['id_pemilihan'],$getIDProv,$d['id_kabupaten'],$d['id_kecamatan'],$d['id_kelurahan']);
				$d['type_pemilihan_now']='In_kelurahan';
				$d['type_pemilihan_next']='TPS';
			}

			$dataSuaraCart=array();
			$dataNamaCart=array();
			$dataPersen=array();

			$total="";
			foreach ($d['dataCartSuara']->result_array() as $rows) {
				$total+= $rows['jumlah_suara'];
			}

			foreach ($d['dataCartSuara']->result_array() as $rowQuick) {
				$dataSuaraCart[]=(int)$rowQuick['jumlah_suara'];
				$dataNamaCart[]=$rowQuick['nama_calon']." = ".number_format($rowQuick['jumlah_suara'],0,",",".") ;
				$dataPersen[]=round( ((float) $rowQuick['jumlah_suara']/$total)*100,2);
			}

			$d['resultDataQuick']=json_encode($dataPersen);
			$d['NamaPaket']=json_encode($dataNamaCart);
			$d['start_form']=@$_GET['start_form'];
			$d['page']='page/hitungcepat';
			$d['page_name']='Quickcount';
			$this->load->view('home',$d);

	}


	public function DaftarSemuaPetugas(){

		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['page']='page/semua_petugas';
			$d['page_name']='Semua petugas';
			$this->load->view('home',$d);
		}
	}


	public function RiwayatPengaduan(){

		if(!$this->session->userdata('islogin')){
			redirect('Login','refresh');
		} else {
			$d['id_petugas']=$this->uri->segment(2);
			$d['page']='page/riwayat_pengaduan_petugas';
			$d['page_name']='Riwayat Pengaduan petugas';
			$this->load->view('home',$d);
		}
	}

	public function SampleMap(){

		$d['id_petugas']=$this->uri->segment(2);
		$d['page']='page/sample_map';
		$d['page_name']='Riwayat Pengaduan petugas';
		$this->load->view('home',$d);
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
