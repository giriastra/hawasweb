<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends CI_Controller {

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
	}

	public function InsertPengguna(){
		$data['name']=$this->input->post('name');
		$data['username']=$this->input->post('username');
		$data['password']=$this->input->post('password');
		$data['phone']=$this->input->post('phone');
		$data['type_user']=$this->input->post('type_user');
		$data['input_lat']=$this->input->post('input_lat');
		$data['input_lng']=$this->input->post('input_lng');

		$destination_path = getcwd().DIRECTORY_SEPARATOR;
		$target_path = $destination_path . basename( $_FILES["foto_user"]["name"]);
		$lokasi_file=$_FILES['foto_user']['tmp_name'];
		$name='USER_'.strtoupper($data['username']).'_'.rand(1234567890,1000);
		$filename="".$name.".".pathinfo($_FILES['foto_user']['name'],PATHINFO_EXTENSION);
		$direktori=config_item('link_foto_user').$filename;
		move_uploaded_file($lokasi_file, $direktori);
		
		$data['foto_user']=$filename;

		$this->model_global->InsertPengguna($data);
	}

	public function UpdatePengguna(){
		$data['id_user']=$this->input->post('id_user_update');
		$data['name']=$this->input->post('name_update');
		$data['username']=$this->input->post('username_update');
		$data['password']=$this->input->post('password_update');
		$data['phone']=$this->input->post('phone_update');
		$data['type_user']=$this->input->post('type_user_update');
		
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
			echo json_encode(array('id_type_user' => $data->id_type_user,'username'=>$data->username,'pwd'=>$data->pwd,'nama'=>$data->name,'phone' => $data->phone,'foto' => $data->foto));
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
			$this->model_crud->MoveQuickcountToLive($id_quickcount);
		} else {
			$this->model_crud->RejectQuickCount($id_quickcount);
		}
		
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
		$name=strtoupper($nama_partai).'_'.rand(1234567890,1000);
		$filename="LOGO_".$name.".".pathinfo($_FILES['logo_partai']['name'],PATHINFO_EXTENSION);
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
			$name=strtoupper($nama_partai).'_'.rand(1234567890,1000);
			$filename="LOGO_".$name.".".pathinfo($_FILES['logo_partai']['name'],PATHINFO_EXTENSION);
			$direktori=config_item('link_foto_partai').$filename;
			move_uploaded_file($lokasi_file, $direktori);
		}

		

		$this->model_crud->EditPartai($nama_partai,$filename,$id);				
	}

	public function TambahSetting(){
		$kategori=$this->input->post('kategori');
		$sub_kategori=$this->input->post('sub_kategori');
		$value=$this->input->post('value');

		if ($this->input->post('type')=='IMG') {
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
		

		$this->model_crud->InsertSetting($kategori,$sub_kategori,$value,$value2);				
	}

}
