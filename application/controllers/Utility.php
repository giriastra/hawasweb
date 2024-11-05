<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Makassar");
		$this->events='';
		$this->load->model('Model_globalAndroid');
		$this->load->model('Model_user');
		$this->load->model('Model_pilkada');
		$this->load->model('Model_pengaduan');
		$this->load->model('Model_forum');
		$this->load->helper(array('form', 'url'));
// 		error_reporting(0);
	}


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

	public function SendMessage(){
		$id_forum=$this->input->post('id_forum');
		$pesan=$this->input->post('pesan');
		$this->model_global->SendMessageForum($id_forum,$pesan);


		// Send Notif by giri
		$data					= $this->Model_user->getUserByForumId($id_forum);
		$firebase_id	= $data->firebase_id;
		$mdGlobal 		= $this->Model_globalAndroid->sendPushNotification("FORUM",$firebase_id,"Pesan Baru Forum ",$pesan,"","");

	}

	public function SendComplaint(){
		$id_forum=$this->input->post('id_complaint');
		$pesan=$this->input->post('pesan');
		$this->model_global->SendMessageComplaint($id_forum,$pesan);

		// Send Notif by aziz
		$data					= $this->Model_user->getUserByComplaintId($id_forum);
		$firebase_id	= $data->firebase_id;
		$mdGlobal 		= $this->Model_globalAndroid->sendPushNotification("COMPLAINT",$firebase_id,"Pesan Baru Forum ",$pesan,"","");

	}

	public function InsertPengguna(){
		$data['name']=$this->input->post('name');
		$data['username']=$this->input->post('username');
		$data['password']=$this->input->post('password');
		$data['phone']=$this->input->post('phone');
		$data['type_user']=$this->input->post('type_user');
		$data['input_lat']=$this->input->post('input_lat');
		$data['input_lng']=$this->input->post('input_lng');
		
			$data['id_provinsi']=$this->input->post('provinsi');	
			$data['id_kabupaten']=$this->input->post('kabupaten');	
		
		$data['foto_user']='noimage.png';
		if (isset($_FILES["foto_user"])) {
			$destination_path = getcwd().DIRECTORY_SEPARATOR;
			$target_path = $destination_path . basename( $_FILES["foto_user"]["name"]);
			$lokasi_file=$_FILES['foto_user']['tmp_name'];
			$name='USER_'.strtoupper($data['username']).'_'.rand(1234567890,1000);
			$filename="".$name.".".pathinfo($_FILES['foto_user']['name'],PATHINFO_EXTENSION);
			$direktori=config_item('link_foto_user').$filename;
			move_uploaded_file($lokasi_file, $direktori);

			$data['foto_user']=$filename;
		}
		$cekUsername=$this->model_global->getDataGlobal('tb_user','username',$data['username'])->num_rows();
		if ($cekUsername>0) {
			echo "usernameExist";
		} else {
			if (strlen($data['username'])<=5) {
				echo "min5";
			} else {
				if (preg_match("/^[\w]+$/", $data['username'])) {
					$this->model_global->InsertPengguna($data);
				} else {
					echo "spaceDetect";
				}

			}
		}

	}

	public function UpdatePengguna(){
		$data['id_user']=$this->input->post('id_user_update');
		$data['name']=$this->input->post('name_update');
		$data['username']=$this->input->post('username_update');
		$data['password']=$this->input->post('password_update');
		$data['phone']=$this->input->post('phone_update');
		$data['type_user']=$this->input->post('type_user_update');

		$data['id_provinsi']=$this->input->post('provinsi');	
		$data['id_kabupaten']=$this->input->post('kabupaten');	

		$filename='false_upload';
		if (@$_FILES['foto_user']) {
			$destination_path = getcwd().DIRECTORY_SEPARATOR;
			$target_path = $destination_path . basename( $_FILES["foto_user"]["name"]);
			$lokasi_file=$_FILES['foto_user']['tmp_name'];
			$name='USER_'.strtoupper($data['username']).'_'.rand(1234567890,1000);
			$filename="".$name.".".pathinfo($_FILES['foto_user']['name'],PATHINFO_EXTENSION);
			$direktori=config_item('link_foto_user').$filename;
			move_uploaded_file($lokasi_file, $direktori);
		}
		$data['foto_user']=$filename;

		// echo implode("-",$data);

		$this->model_crud->AksiUpdatePengguna($data);
	}

	public function HapusPengguna(){
		$id=$this->input->post('id_user');
		$this->model_crud->HapusPengguna($id);
	}

	public function UpdateDataPerusahaan(){
		$id_company=$this->input->post('id_company');
		$namaPerusahaan=$this->input->post('namaPerusahaan');
		$email=$this->input->post('email');
		$website=$this->input->post('website');
		$visi=$this->input->post('visi');
		$misi=$this->input->post('misi');
		$phone=$this->input->post('phone');
		$phone2=$this->input->post('phone2');
		$pc_name=$this->input->post('pc_name');
		$lat=$this->input->post('lat');
		$long=$this->input->post('long');
		$alamat=$this->input->post('alamat');
		$this->model_crud->UpdateDataPerusahaan($id_company,$namaPerusahaan,$email,$website,$visi,$misi,$lat,$long,$phone,$phone2,$pc_name,$alamat);
	}

	public function AksiTambahBerita(){
		$judul=$this->input->post("judul");
		$desc=$this->input->post("desc");
		$link_gmbr=$this->input->post("link_gmbr");
		$link_web=$this->input->post("link_web");
		$status=$this->input->post("status");
		$this->model_crud->AksiTambahBerita($judul,$desc,$link_gmbr,$link_web,$status);

		$mdGlobal 		= $this->Model_globalAndroid->sendPushNotification("BROADCAST","",$judul,$desc,$link_gmbr,$link_web);

	}

	public function TambahHimbauan(){
		$judul=$this->input->post("judul");
		$desc=$this->input->post("desc");
		$link_website=$this->input->post("link_website");
		$status=$this->input->post("status");
		$link_gambar='noimage.png';
		if (isset($_FILES["link_gambar"])) {
			$destination_path = getcwd().DIRECTORY_SEPARATOR;
			$target_path = $destination_path . basename( $_FILES["link_gambar"]["name"]);
			$lokasi_file=$_FILES['link_gambar']['tmp_name'];
			$name='ANNOUNCEMENT_'.rand(1234567890,1000);
			$filename="".$name.".".pathinfo($_FILES['link_gambar']['name'],PATHINFO_EXTENSION);
			$direktori=config_item('link_foto_himbauan').$filename;
			move_uploaded_file($lokasi_file, $direktori);

			$link_gambar=$filename;
		}
				$res = $this->model_crud->TambahHimbauan($judul,$desc,$link_gambar,$link_website,$status);
				$url = config_item('URL_IMG_HIMBAUAN');
				if(strlen($link_gambar)>11){
						$link_gambar = $url.$link_gambar;
				}
				$mdGlobal 		= $this->Model_globalAndroid->sendPushNotification("BROADCAST","",$judul,$desc,$link_gambar,$link_website);
				// echo $mdGlobal;

	}

	public function EditHimbauan(){
		$judul=$this->input->post("judul");
		$desc=$this->input->post("desc");
		//$link_gambar=$this->input->post("link_gambar");
		$link_website=$this->input->post("link_website");
		$status=$this->input->post("status");
		$id=$this->input->post("id");
		$filename='false_upload';
		if (isset($_FILES['link_gambar'])) {
			$destination_path = getcwd().DIRECTORY_SEPARATOR;
			$target_path = $destination_path . basename( $_FILES["link_gambar"]["name"]);
			$lokasi_file=$_FILES['link_gambar']['tmp_name'];
			$name='ANNOUNCEMENT_'.rand(1234567890,1000);
			$filename="".$name.".".pathinfo($_FILES['link_gambar']['name'],PATHINFO_EXTENSION);
			$direktori=config_item('link_foto_himbauan').$filename;
			move_uploaded_file($lokasi_file, $direktori);
		}
		$link_gambar=$filename;
		$this->model_crud->EditHimbauan($id,$judul,$desc,$link_gambar,$link_website,$status);
	}

	public function AksiEditBerita(){
		$id_news=$this->input->post("id_news");
		$judul=$this->input->post("judul");
		$desc=$this->input->post("desc");
		$link_gmbr=$this->input->post("link_gmbr");
		$link_web=$this->input->post("link_web");
		$status=$this->input->post("status");
		$this->model_crud->AksiEditBerita($judul,$desc,$link_gmbr,$link_web,$status,$id_news);
	}

	public function HapusBerita(){
		$id_news=$this->input->post('id_news');
		$q=$this->model_crud->DeleteBerita($id_news);
	}

	public function TambahKab(){
		$id_prov=$this->input->post('id_prov');
		$kab=$this->input->post('kabupaten');
		$this->model_crud->InsertKabupaten($kab,$id_prov);
	}

	public function TambahProv(){
		$prov=$this->input->post('prov');
		$this->model_crud->InsertProvinsi($prov);
	}

	public function TambahKecamatan(){
		$id_kab=$this->input->post('id_kabupaten');
		$kecamatan=$this->input->post('kecamatan');
		$this->model_crud->InsertKecamatan($kecamatan,$id_kab);
	}

	public function TambahKelurahan(){
		$id_kec=$this->input->post('id_kecamatan');
		$kelurahan=$this->input->post('kelurahan');
		$this->model_crud->InsertKelurahan($kelurahan,$id_kec);
	}

	public function EditProv(){
		$prov=$this->input->post('prov_update');
		$id_prov=$this->input->post('id_prov');
		$this->model_crud->EditProvinsi($prov,$id_prov);
	}

	public function HapusProvinsi(){
		$id_prov=$this->input->post('id_provinsi');
		$this->model_crud->DeleteGlobal('tb_provinsi','id_provinsi',$id_prov);
	}

	public function HapusKabupaten(){
		$id_prov=$this->input->post('id_kab');
		$this->model_crud->DeleteGlobal('tb_kabupaten','id_kabupaten',$id_prov);
	}

	public function HapusKecamatan(){
		$id_kec=$this->input->post('id_kec');
		$this->model_crud->DeleteGlobal('tb_kecamatan','id_kecamatan',$id_kec);
	}

	public function HapusKelurahan(){
		$id_kel=$this->input->post('id_kel');
		$this->model_crud->DeleteGlobal('tb_kelurahan','id_kelurahan',$id_kel);
	}

	public function DeleteGlobal(){
		$param=$this->input->post('id');
		$where=$this->input->post('where');
		$tb=$this->input->post('tb');
		$this->model_crud->DeleteGlobal($tb,$where,$param);
	}

	public function GetDataUpdate(){
		$menu=$this->input->post('menu');
		$tb=$this->input->post('table');
		$where=$this->input->post('where');
		$param=$this->input->post('parameter');
		$data=$this->model_global->getDataGlobal($tb,$where,$param)->row();
		if ($menu=='provinsi') {
			echo json_encode(array('provinsi' => $data->name));
		} else if ($menu=='kabupaten') {
			echo json_encode(array('kabupaten' => $data->name));
		} else if ($menu=='kecamatan') {
			echo json_encode(array('kecamatan' => $data->name));
		} else if ($menu=='kelurahan') {
			echo json_encode(array('kelurahan' => $data->name));
		} else if ($menu=='pemilihan') {
			echo json_encode(array('tgl_pem' => $data->tgl_pemilihan,'is_pilgub'=>$data->is_pilgub,'is_pilbub'=>$data->is_pilbub,'status'=>$data->status));
		}else if ($menu=='pengguna') {
			echo json_encode(array('id_type_user' => $data->id_type_user,'username'=>$data->username,'pwd'=>$data->pwd,'nama'=>$data->name,'phone' => $data->phone,'foto' => $data->foto,'id_provinsi' => $data->id_provinsi,'id_kabupaten' => $data->id_kabupaten));
		}else if ($menu=='partai') {
			echo json_encode(array('nama_partai' => $data->nama_partai,'img_logo'=>$data->img_logo));
		}else if ($menu=='berita') {
			echo json_encode(array('judul' => $data->title,'desc'=>$data->desc,'url_website'=>$data->url_website,'url_img_header'=>$data->url_img_header,'status' => $data->status));
		}else if ($menu=='calon') {
			echo json_encode(
				array('nama_calon_utama' => $data->nama_calon_utama,
					'nama_calon_wakil'=>$data->nama_calon_wakil,
					'jenis_pengusung'=>$data->jenis_pengusung,
					'foto_utama'=>$data->foto_utama,
					'foto_wakil' => $data->foto_wakil,
					'visi'=>$data->visi,
					'misi'=>$data->misi,
					'nama_paket'=>$data->nama_paket,
					'id_provinsi'=>$data->id_provinsi,
					'id_kabupaten'=>$data->id_kabupaten
				));
		}else if ($menu=='tps') {
			$tglPemilihan=$this->model_global->getDataGlobal('tb_pemilihan','id_pemilihan',$data->id_pemilihan)->row();

			if($tglPemilihan->is_pilgub=="true" &&  $tglPemilihan->is_pilbub=="true"){
				$type= "PILGUB - PILBUB";
			}else{
				if($tglPemilihan->is_pilgub=="true"){
					$type= "PILGUB";
				}else{
					$type= "PILBUB";
				}
			}
			echo json_encode(
				array('no_tps' => $data->no_tps,
						'ketua_tps'=>$data->ketua_tps,
						'id_provinsi'=>$data->id_provinsi,
						'id_kabupaten'=>$data->id_kabupaten,
						'id_kecamatan' => $data->id_kecamatan,
						'id_kelurahan'=>$data->id_kelurahan,
						'latitude'=>$data->latitude,
						'longitude'=>$data->longitude,
						'longitude'=>$data->longitude,
						'tgl_pemilihan'=>$tglPemilihan->tgl_pemilihan." ".$type,
						'id_pemilihan'=>$data->id_pemilihan
				));
		}
	}

	public function GetDataUpdate2(){
		$menu=$this->input->post('menu');
		$tb=$this->input->post('table');
		$where=$this->input->post('where');
		$param=$this->input->post('parameter');
		echo json_encode($this->model_global->getDataGlobal2($tb,$where,$param)->result_array());
	}



	public function EditKabupaten(){
		$kab_update=$this->input->post('kab_update');
		$id_kab=$this->input->post('id_kab');
		$this->model_crud->EditKabupaten($kab_update,$id_kab);
	}

	public function EditKecamatan(){
		$kec_update=$this->input->post('kec_update');
		$id_kec=$this->input->post('id_kec');
		$this->model_crud->EditKecamatan($kec_update,$id_kec);
	}

	public function EditKelurahan(){
		$kel_update=$this->input->post('kel_update');
		$id_kel=$this->input->post('id_kel');
		$this->model_crud->EditKelurahan($kel_update,$id_kel);
	}

	public function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			// $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}


	public function UploadGambarAnnouncement(){
		$lokasi_file=$_FILES['fileUpload']['tmp_name'];
		$name='ANNOUNC_'.$this->generateRandomString();
		$filename="EFORM_KTP_".$name.".".pathinfo($_FILES['fileUpload']['name'],PATHINFO_EXTENSION);
		$direktori="hawas/assets/upload".$filename;
		move_uploaded_file($lokasi_file, $direktori);
	}

	public function InsertPemilihan(){
		$is_pilbub=$this->input->post('is_pilbub');
		$is_pilgub=$this->input->post('is_pilgub');
		$status=$this->input->post('status');
		$tgl_pemilihan=$this->input->post('tgl_pemilihan');
		$this->model_crud->InsertPemilihan($is_pilbub,$is_pilgub,$status,$tgl_pemilihan);
	}

	public function EditPemilihan(){
		$id_pemilihan=$this->input->post('id_pemilihan');
		$is_pilbub=$this->input->post('is_pilbub');
		$is_pilgub=$this->input->post('is_pilgub');
		$status=$this->input->post('status');
		$tgl_pemilihan=$this->input->post('tgl_pemilihan');
		 $this->model_crud->EditPemilihan($is_pilbub,$is_pilgub,$status,$tgl_pemilihan,$id_pemilihan);
	}

	public function UploadImage(){
		$destination_path = getcwd().DIRECTORY_SEPARATOR;
		$target_path = $destination_path . basename( $_FILES["foto_utama"]["name"]);
		$lokasi_file=$_FILES['foto_utama']['tmp_name'];
		$name='CALON_'.rand(1234567890,1000);
		$filename="FOTO_UTAMA".$name.".".pathinfo($_FILES['foto_utama']['name'],PATHINFO_EXTENSION);
		$direktori="D:/xampp/htdocs/hawas/assets/upload/".$filename;
		move_uploaded_file($lokasi_file, $direktori);

		return $filename;
	}

	public function InsertCalon(){
		$c_utama=$this->input->post('c_utama');
		$c_wakil=$this->input->post('c_wakil');

		$destination_path = getcwd().DIRECTORY_SEPARATOR;
		$target_path = $destination_path . basename( $_FILES["foto_utama"]["name"]);
		$lokasi_file=$_FILES['foto_utama']['tmp_name'];
		$name=strtoupper($c_utama).'_'.rand(1234567890,1000);
		$filename="FOTO_UTAMA_".$name.".".pathinfo($_FILES['foto_utama']['name'],PATHINFO_EXTENSION);
		$direktori=config_item('link_foto_calon').$filename;
		move_uploaded_file($lokasi_file, $direktori);

		$destination_path_wakil = getcwd().DIRECTORY_SEPARATOR;
		$target_path_wakil = $destination_path_wakil . basename( $_FILES["foto_utama"]["name"]);
		$lokasi_file_wakil=$_FILES['foto_wakil']['tmp_name'];
		$name_wakil=strtoupper($c_wakil).'_'.rand(1234567890,1000);
		$filename_wakil="FOTO_WAKIL_".$name_wakil.".".pathinfo($_FILES['foto_wakil']['name'],PATHINFO_EXTENSION);
		$direktori_wakil=config_item('link_foto_calon').$filename_wakil;
		move_uploaded_file($lokasi_file_wakil, $direktori_wakil);

		// $c_utama=$this->input->post('c_utama');
		// $c_wakil=$this->input->post('c_wakil');
		$tipe_pengusung=$this->input->post('tipe_pengusung');
		$partai=$this->input->post('partai');
		$provinsi=@$this->input->post('provinsi');
		$kabupaten=@$this->input->post('kabupaten');
		$visi=$this->input->post('visi');
		$misi=$this->input->post('misi');
		$nama_paket=$this->input->post('nama_paket');
		$id_pemilihan=$this->input->post('id_pemilihan');

		$this->model_crud->InsertCalon($c_utama,$c_wakil,$tipe_pengusung,$partai,$provinsi,$kabupaten,$visi,$misi,$nama_paket,$filename,$filename_wakil,$id_pemilihan);
		// echo implode("-",$data);

		// echo $c_utama."/";
		// echo $c_wakil."/";
		// echo $tipe_pengusung."/";
		// echo $partai."/";
		// echo $provinsi."/";
		// echo $kabupaten."/";
		// echo $filename."/";
		// echo $filename_wakil."/";
		// echo $visi."/";
		// echo $misi."/";
		// echo $nama_paket."/";
	}

	public function AksiEditCalon(){
		$c_utama=$this->input->post('c_utama');
		$c_wakil=$this->input->post('c_wakil');
		$id_calon=$this->input->post('id_calon');
		$filename='false_file';
		if (@$_FILES["foto_utama"]) {
			$destination_path = getcwd().DIRECTORY_SEPARATOR;
			$target_path = $destination_path . basename( $_FILES["foto_utama"]["name"]);
			$lokasi_file=$_FILES['foto_utama']['tmp_name'];
			$name=strtoupper($c_utama).'_'.rand(1234567890,1000);
			$filename="FOTO_UTAMA_".$name.".".pathinfo($_FILES['foto_utama']['name'],PATHINFO_EXTENSION);
			$direktori=config_item('link_foto_calon').$filename;
			move_uploaded_file($lokasi_file, $direktori);
		}
		$filename_wakil='false_file';
		if (@$_FILES["foto_wakil"]) {
			$destination_path_wakil = getcwd().DIRECTORY_SEPARATOR;
			$target_path_wakil = $destination_path_wakil . basename( $_FILES["foto_utama"]["name"]);
			$lokasi_file_wakil=$_FILES['foto_wakil']['tmp_name'];
			$name_wakil=strtoupper($c_wakil).'_'.rand(1234567890,1000);
			$filename_wakil="FOTO_WAKIL_".$name_wakil.".".pathinfo($_FILES['foto_wakil']['name'],PATHINFO_EXTENSION);
			$direktori_wakil=config_item('link_foto_calon').$filename_wakil;
			move_uploaded_file($lokasi_file_wakil, $direktori_wakil);
		}

		// $c_utama=$this->input->post('c_utama');
		// $c_wakil=$this->input->post('c_wakil');
		$tipe_pengusung=$this->input->post('tipe_pengusung');
		$partai=$this->input->post('partai');
		$provinsi=@$this->input->post('provinsi');
		$kabupaten=@$this->input->post('kabupaten');
		$visi=$this->input->post('visi');
		$misi=$this->input->post('misi');
		$nama_paket=$this->input->post('nama_paket');
		$id_pemilihan=$this->input->post('id_pemilihan');

		$this->model_crud->UpdateCalon($c_utama,$c_wakil,$tipe_pengusung,$partai,$provinsi,$kabupaten,$visi,$misi,$nama_paket,$filename,$filename_wakil,$id_pemilihan,$id_calon);

	}

	public function ConfirmQuickcount(){
		$id_quickcount=$this->input->post('id');
		$mode=$this->input->post('mode');

		if ($mode=='CONFIRM') {
			$status="DI SETUJUI";
			$this->model_crud->MoveQuickcountToLive($id_quickcount);
		} else {
			$status="DI TOLAK";
			$this->model_crud->RejectQuickCount($id_quickcount);
		}


		$data					= $this->Model_user->getUserByIdTps($id_quickcount);
		$data_c1					= $this->Model_pilkada->getDataHasilTemp($id_quickcount);
		$data_tps					= $this->Model_pilkada->getDataTPSByID($data_c1->id_tps);
		$pesan="Penginputan C1 dengan KODE INPUT [".$data_c1->kode_input."] di TPS [".$data_tps->no_tps."] tanggal ".date("d-m-Y H:i", strtotime($data_c1->date_create))." ".$status;
		$firebase_id	= $data->firebase_id;
		$mdGlobal 		= $this->Model_globalAndroid->sendPushNotification("NOTIF",$firebase_id,"Penginputan C1 #Kode Input:".$data_c1->kode_input." ".$status,$pesan,"","");





	}

	public function GetPartaiChecked(){
		$id_calon=$this->input->post('id_calon');
		$data=array();
		foreach ($this->model_crud->GetPartaiPengusung($id_calon)->result_array() as $rowPartai) {
			$partai=$rowPartai;
			array_push($data, $partai);
		}
		echo json_encode($data);
	}

	public function AksiTambahPartai(){
		$nama_partai=$this->input->post('nama_partai');
		// $nama_partai=$this->input->post('logo_partai');

		$destination_path = getcwd().DIRECTORY_SEPARATOR;
		$target_path = $destination_path . basename( $_FILES["logo_partai"]["name"]);
		$lokasi_file=$_FILES['logo_partai']['tmp_name'];
		$nma=strtoupper($nama_partai).'_'.rand(1234567890,1000);
		$filename="LOGO_".$nma.".".pathinfo($_FILES['logo_partai']['name'],PATHINFO_EXTENSION);
		$direktori=config_item('link_foto_partai').$filename;
		move_uploaded_file($lokasi_file, $direktori);


		 $this->model_crud->TambahPartai($nama_partai,$filename);
	}

	public function EditPartai(){
		$id=$this->input->post('id_partai');
		$nama_partai=$this->input->post('nama_partai');
		$filename='no_upload';
		if (@$_FILES["logo_partai"]) {
			$destination_path = getcwd().DIRECTORY_SEPARATOR;
			$target_path = $destination_path . basename( $_FILES["logo_partai"]["name"]);
			$lokasi_file=$_FILES['logo_partai']['tmp_name'];
			$nma=strtoupper($nama_partai).'_'.rand(1234567890,1000);
			$filename="LOGO_".$nma.".".pathinfo($_FILES['logo_partai']['name'],PATHINFO_EXTENSION);
			$direktori=config_item('link_foto_partai').$filename;
			move_uploaded_file($lokasi_file, $direktori);
		}



		$this->model_crud->EditPartai($nama_partai,$filename,$id);
	}

	public function TambahSetting(){
		$kategori=$this->input->post('kategori');
		$sub_kategori=$this->input->post('sub_kategori');
		$value=$this->input->post('value');
		$val2_type=$this->input->post('val2_type');
		$isDelete=$this->input->post('isDelete');
		$value2='';
		if ($val2_type=='IMAGE') {
			$destination_path = getcwd().DIRECTORY_SEPARATOR;
			$target_path = $destination_path . basename( $_FILES["value2"]["name"]);
			$lokasi_file=$_FILES['value2']['tmp_name'];
			$name=strtoupper($kategori).'_'.rand(1234567890,1000);
			$filename="VALUE2_".$name.".".pathinfo($_FILES['value2']['name'],PATHINFO_EXTENSION);
			$direktori=config_item('link_foto_setting').$filename;
			move_uploaded_file($lokasi_file, $direktori);

			$value2=$filename;
		} else {
			$value2=$this->input->post('value2');
		}


		$this->model_crud->InsertSetting($kategori,$sub_kategori,$value,$value2,$val2_type,$isDelete);
	}

	public function UbahSetting(){
		$kategori=$this->input->post('kategori');
		$sub_kategori=$this->input->post('sub_kategori');
		$value=$this->input->post('value');
		$val2_type=$this->input->post('val2_type');
		$id_setting=$this->input->post('id_setting');

		if ($this->input->post('val2_type')=='IMAGE') {
			if (isset($_FILES["value2"])) {
				$destination_path = getcwd().DIRECTORY_SEPARATOR;
				$target_path = $destination_path . basename( $_FILES["value2"]["name"]);
				$lokasi_file=$_FILES['value2']['tmp_name'];
				$name=strtoupper($kategori).'_'.rand(1234567890,1000);
				$filename="VALUE2_".$name.".".pathinfo($_FILES['value2']['name'],PATHINFO_EXTENSION);
				$direktori=config_item('link_foto_setting').$filename;
				move_uploaded_file($lokasi_file, $direktori);
				$value2=$filename;
			} else {
				$value2='false_image';
			}

		} else {
			$value2=$this->input->post('value2');
		}


		$this->model_crud->EditSetting($id_setting,$kategori,$sub_kategori,$value,$value2,$val2_type);
	}

	public function TambahTps(){
		$data['no_tps']=$this->input->post('no_tps');
		$data['ketua_tps']=$this->input->post('ketua_tps');
		$data['provinsi']=$this->input->post('provinsi');
		$data['kabupaten']=$this->input->post('kabupaten');
		$data['kecamatan']=$this->input->post('kecamatan');
		$data['kelurahan']=$this->input->post('kelurahan');
		$data['latitude']=$this->input->post('latitude');
		$data['longitude']=$this->input->post('longitude');
		$data['tgl_pemilihan']=$this->input->post('tgl_pemilihan');

		$this->model_crud->TambahTps($data);
	}

	public function UbahTps(){
		$data['no_tps']=$this->input->post('no_tps');
		$data['ketua_tps']=$this->input->post('ketua_tps');
		$data['provinsi']=$this->input->post('provinsi');
		$data['kabupaten']=$this->input->post('kabupaten');
		$data['kecamatan']=$this->input->post('kecamatan');
		$data['kelurahan']=$this->input->post('kelurahan');
		$data['latitude']=$this->input->post('latitude');
		$data['longitude']=$this->input->post('longitude');
		$data['id_tps']=$this->input->post('id_tps');
		$data['tgl_pemilihan']=$this->input->post('tgl_pemilihan');

		$this->model_crud->UpdateTps($data);
	}

	public function AksiTambahPetugas(){
		$petugas=$this->input->post('petugas');
		$id_tps=$this->input->post('id_tps');

		$this->model_crud->InsertPetugas($petugas,$id_tps);
	}

	public function editPetugas(){
		$petugas=$this->input->post('petugas');
		$id_tps=$this->input->post('id_petugas_tps');

		$this->model_crud->UpdatePetugas($petugas,$id_tps);
	}

	public function TambahLokasiKantor(){
		$nama_kantor=$this->input->post('nama_kantor');
		$alamat_kantor=$this->input->post('alamat_kantor');
		$telp=$this->input->post('telp');
		$status=$this->input->post('status');
		$input_lat=$this->input->post('input_lat');
		$input_lng=$this->input->post('input_lng');
		$jenis_kantor=$this->input->post('jenis_kantor');

		$this->model_crud->InsertLokasiKantor($nama_kantor,$alamat_kantor,$telp,$status,$input_lat,$input_lng,$jenis_kantor);
	}

	public function UbahLokasiKantor(){
		$nama_kantor=$this->input->post('nama_kantor');
		$alamat_kantor=$this->input->post('alamat_kantor');
		$telp=$this->input->post('telp');
		$status=$this->input->post('status');
		$input_lat=$this->input->post('input_lat');
		$input_lng=$this->input->post('input_lng');
		$jenis_kantor=$this->input->post('jenis_kantor');
		$id_kantor=$this->input->post('id_kantor');

		$this->model_crud->UpdateLokasiKantor($nama_kantor,$alamat_kantor,$telp,$status,$input_lat,$input_lng,$jenis_kantor,$id_kantor);
	}

	public function step1FormPemilihan(){
		//$tgl_pemilihan2=date("Y-m-d", strtotime($tgl_pemilihan));
		$tgl_pemilihan=$this->input->post('tgl_pemilihan');
		//$GetTypePemilihan=$this->model_global->getDataGlobal('tb_pemilihan','tgl_pemilihan',$tgl_pemilihan)->row();

        $data=$this->model_global->getDataFormPemlihan1($tgl_pemilihan);
        if ($data->num_rows()>0) {
        	echo json_encode($data->result_array());
        } else {
        	echo json_encode(array('status' => 'gagal'));
        }
	}

	public function SyncDataBC(){
		$jenis_broadcast=$this->input->post('jenis_broadcast');
		$judul_bc=$this->input->post('judul_bc');
		$urlGambar_bc=$this->input->post('urlGambar_bc');
		$urlWeb_bc=$this->input->post('urlWeb_bc');
		$pesan_bc=$this->input->post('pesan_bc');

		$this->model_global->SyncDataBroadcast($jenis_broadcast,$judul_bc,$urlGambar_bc,$urlWeb_bc,$pesan_bc);
	}

	public function ShowdataBc(){
		$jenis_broadcast=$this->input->post('jenis_broadcast');

		$d['dataSql']=$this->model_global->ShowMessageBC($jenis_broadcast);
		$this->load->view('utility/show_data_bc',$d);
	}

	public function FilterForum(){
		$d['tgl_dibuat']=$this->input->post('tgl_dibuat');
		$d['tgl_tutup']=$this->input->post('tgl_tutup');
		$d['status']=$this->input->post('status');
		$d['petugas']=$this->input->post('petugas');
		$tglStart=date("Y-m-d", strtotime($d['tgl_dibuat']));
		$tglClose=date("Y-m-d", strtotime($d['tgl_tutup']));
		// echo $d['status']."/";
		// echo $d['petugas']."/";
		// echo $tglStart."/";
		// echo $tglClose."/";
		$d['SQLfilterForum']=$this->model_global->getFilteredForum($d);
		$this->load->view('utility/filter_forum',$d);
	}

	public function FilterComplaint(){
		$d['tgl_dibuat']=$this->input->post('tgl_dibuat');
		$d['tgl_tutup']=$this->input->post('tgl_tutup');
		$d['status']=$this->input->post('status');
		$d['petugas']=$this->input->post('petugas');
		$d['SQLfilterComplaint']=$this->model_global->getFilteredComplaint($d);
		$this->load->view('utility/filter_complaint',$d);
	}

	public function SendBroadCast(){

		$jenis_broadcast=$this->input->post('jenis_broadcast');
		$namaBC='BROADCAST_'.$jenis_broadcast;
		$data=$this->model_global->GetdataToSend($jenis_broadcast)->row();
		// $sendBC=$this->Model_globalAndroid->sendPushNotification($namaBC,$data->firebase_id,$data->judul,$data->pesan,$data->url_img,$data->url_web);
		$idBC=$data->id_broadcast;
			// //API URL
			$url = 'http://hawasapp.com/global';
			//create a new cURL resource
			$ch = curl_init($url);
			//setup request to send json via POST
			$data = array(
					  'firebase_id' => $data->firebase_id,
					  'title' => $data->judul,
					  'msg' => $data->pesan,
					  'url_img' => $data->url_img,
					  'url_web' => $data->url_web,
					  'Func' => 'sendNotifFirebaseBroadcast'
			);
			$payload = json_encode($data);
			 //echo $payload;
			//attach encoded JSON string to the POST fields
			curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			//set the content type to application/json
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			//return response instead of outputting
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//execute the POST request
			$result = curl_exec($ch);
			//close cURL resource
			curl_close($ch);
			//Output response
			//get response
			//echo $result;
			$dataResult=json_decode($result,true);
			$messageArray=$dataResult['message'];
			$resultArray=$dataResult['status'];
			if ($resultArray=='true') {
				$valUpdate = array(
				    'status' => 'Y',
				    'change_date' => date('Y-m-d H:i:s')
				);
				$this->db->where('id_broadcast', $idBC);
				$this->db->update('tb_data_broadcast', $valUpdate);
			} else {
				$valUpdate = array(
				    'status' => 'N',
				    'change_date' => date('Y-m-d H:i:s')
				);
				$this->db->where('id_broadcast', $idBC);
				$this->db->update('tb_data_broadcast', $valUpdate);

			}
			echo json_encode(array('status' => $resultArray,'pesan'=>$messageArray,'id_bc'=>$idBC));

			//{"status":"false","message":"Function not found."}


	}

	public function CountBC(){
		$data=$this->model_global->CountBC($this->input->post('jenis_broadcast'));
	}

	public function GetdataProvinsi(){
		$tgl_pemilihan=$this->input->post('tgl_pemilihan');
		$type=$this->input->post('type');
		$data=$this->model_global->GetProvORKabFromPemilihan($type,$tgl_pemilihan)->result_array();
		echo json_encode($data);
	}

	public function GetSuaraProvinsi(){
		$id_prov=$this->input->post('id_prov');
	}

	public function FilterSemuaPetugas(){
		$d['status']=$this->input->post('filter_status');
		$d['dataSql']=$this->model_global->getFilteredPetugas($d['status']);
		$this->load->view('utility/filtered_petugas',$d);

	}

	public function FilterTPS(){
		$d['provinsi']=$this->input->post('provinsi');
		$d['kabupaten']=$this->input->post('kabupaten');
		$d['kecamatan']=$this->input->post('kecamatan');
		$d['kelurahan']=$this->input->post('kelurahan');
		$d['dataSql']=$this->model_global->getFilteredTPS($d);
		$this->load->view('utility/filtered_tps',$d);

	}

	public function FilteredPengguna(){
		$d['type_user']=$this->input->post('type_user');
		$d['id_provinsi']=$this->input->post('id_provinsi');
		$d['id_kabupaten']=$this->input->post('id_kabupaten');
		$d['dataSql']=$this->model_global->getFilteredPengguna($d);
		$this->load->view('utility/filtered_pengguna',$d);
	}

	public function UpdatePemilihanGlobal(){
		$id_provinsi=$this->input->post('id_provinsi');
		$id_kabupaten=$this->input->post('id_kabupaten');
		$id_pemilihan=$this->input->post('id_pemilihan');
		$this->model_crud->UpdatePemilihanGlobal($id_provinsi,$id_kabupaten,$id_pemilihan);
	}

	public function GetDataKabupatenInTps(){
		$id_provinsi=$this->input->post('id_provinsi');

		echo json_encode($this->model_global->getIdKabInTPS($id_provinsi)->result_array());
	}

	public function updateTrackStatus(){
			$data=array(
				'ischeked'=>$this->input->post('status'),
				'change_date'=>date('Y-m-d h:i:s'),
				'change_who'=>$this->session->userdata('username'),
			);
			$this->db->where('id', $this->input->post('id'));
			$q = $this->db->update('tb_complaint_track_status',$data);
			if($q){
				echo 'sukses';
			}else{
				echo 'gagal';
			}

			

	}

}
