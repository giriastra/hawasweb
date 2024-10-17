<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pilkada extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Makassar");
		$this->events='';
		$this->load->model('Model_globalAndroid');
		$this->load->model('Model_user');
		$this->load->model('Model_pilkada');
		$this->load->model('Model_mcrypt');
		$this->load->helper(array('form', 'url'));
	}


	public function index(){
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
				echo "You do not have authorization.";
				header('HTTP/1.1 400 Only POST method allowed');
				exit;
		}

			$body = file_get_contents('php://input');
			$this->events 	= json_decode($body);
			$this->Model_globalAndroid->InsertAddLog($body,$this->events->Func,"IN","user/Pilkada",@$this->events->id_user);


			 if(method_exists($this,$this->events->Func)){
					$this->{$this->events->Func}();
				}else{
					// $data = $this->Model_globalAndroid->get_sampledata();
					// $Data=array('status'=>'false','message'=>'Function not found.','data'=>$data);
					$Data=array('status'=>'false','message'=>'Function not found.');
					$Data=json_encode($Data);
					$this->ReturnReponse($Data);
				}

	}


	private function ReturnReponse($msg='',$type='OUT'){
			echo ($msg);
			$this->Model_globalAndroid->InsertAddLog($msg,@$this->events->Func,$type,"user/Pilkada");
	}


	public function getMainEventPilkada(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){
				$result = $this->Model_pilkada->getMainEventPilkada();

				if($result->num_rows()>0){

					$data_=array();
					$data_partai=array();
					foreach($result->result() as $rows)
					{
							$result_calon[$rows->id_pemilihan] = $this->Model_pilkada->getMainCalon($rows->id_pemilihan);
							$data_[$rows->id_pemilihan] = $result_calon[$rows->id_pemilihan]->result();
					}



												//$result_partai = $this->Model_pilkada->getPartaiPengusung();
												// echo $data_[$rows->id_pemilihan]->id_calon;


					$result_calon_=array( 'status'=>'true','message'=>'','data'=>$data_);
					$Data=array('status'=>'true','message'=>'Ada Data','event_pilkada'=>$result->result(),'calon'=>$result_calon_);
				}else{
					$Data=array('status'=>'false','message'=>'Belum ada data forum');
				}
		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}

	public function getPartaiPengusung(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){
				$result = $this->Model_pilkada->getPartaiPengusung($this->events->id_calon);
				if($result->num_rows()>0){
					$Data=array('status'=>'true','message'=>'Ada Data','data'=>$result->result());
				}else{
					$Data=array('status'=>'false','message'=>'Belum ada data partai pengusung');
				}
		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}


	public function getCalonPersebaranWilayah(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){
				$result = $this->Model_pilkada->getCalonPersebaranWilayah($this->events->id_pemilihan);
				if($result->num_rows()>0){
					$Data=array('status'=>'true','message'=>'Ada Data','data'=>$result->result());
				}else{
					$Data=array('status'=>'false','message'=>'Belum ada data partai pengusung');
				}
		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}


	public function getMainCalonByLokasi(){

		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){
				$result = $this->Model_pilkada->getMainCalonByLokasi($this->events->id_pemilihan,$this->events->id_lokasi,$this->events->jenis);
				if($result->num_rows()>0){
					$Data=array('status'=>'true','message'=>'Ada Data','data'=>$result->result());
				}else{
					$Data=array('status'=>'false','message'=>'Belum ada data partai pengusung ');
				}
		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}
	public function getDataTPSbyIdPetugas(){

		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){
				$result = $this->Model_pilkada->getDataTPSbyIdPetugas($this->events->id_user);
				if($result->num_rows()>0){
					$Data=array('status'=>'true','message'=>'Ada Data','data'=>$result->result());
				}else{
					$Data=array('status'=>'false','message'=>'Anda Belum Memiliki Tempat Penugasan Di TPS Manapun');
				}
		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}


	public function getDataC1byIdPetugas(){

		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){

				$data_tps = $this->Model_pilkada->getDataTPSbyIdPetugasPemilihan($this->events->id_user);
				if($data_tps->num_rows()>0){
					$data_detail_tps=array('status'=>'true','message'=>'Ada Data','data'=>$data_tps->result());
				}else{
					$data_detail_tps=array('status'=>'false','message'=>'Anda Belum Memiliki Tempat Penugasan Di TPS Manapun');
				}



				if($this->events->mode=="temp"){
					$result_temp = $this->Model_pilkada->getDataC1TempbyIdPetugas($this->events->id_user);
				}else if($this->events->mode=="live"){
					$result_live = $this->Model_pilkada->getDataC1LivebyIdPetugas($this->events->id_user);
				}else{
					$result_temp = $this->Model_pilkada->getDataC1TempbyIdPetugas($this->events->id_user);
					$result_live = $this->Model_pilkada->getDataC1LivebyIdPetugas($this->events->id_user);
				}


				if($this->events->mode=="temp"){
						if($result_temp->num_rows()>0){
							$Data_temp=array('status'=>'true','message'=>'Ada Data','data'=>$result_temp->result());
						}else{
							$Data_temp=array('status'=>'false','message'=>'Belum Ada Data Pengajuan C1');
						}

						$Data=array(
								'data_temp'=>$Data_temp,
								'data_detail_tps'=>$data_detail_tps
						);
				}else if($this->events->mode=="live"){
						if($result_live->num_rows()>0){
							$Data_live=array('status'=>'true','message'=>'Ada Data','data'=>$result_live->result());
						}else{
							$Data_live=array('status'=>'false','message'=>'Belum Ada Data C1 Terkonfirmasi');
						}

						$Data=array(
								'data_live'=>$Data_live,
								'data_detail_tps'=>$data_detail_tps
						);
				}else{
						if($result_temp->num_rows()>0){
							$Data_temp=array('status'=>'true','message'=>'Ada Data','data'=>$result_temp->result());
						}else{
							$Data_temp=array('status'=>'false','message'=>'Belum Ada Data Pengajuan C1');
						}

						if($result_live->num_rows()>0){
							$Data_live=array('status'=>'true','message'=>'Ada Data','data'=>$result_live->result());
						}else{
							$Data_live=array('status'=>'false','message'=>'Belum Ada Data C1 Terkonfirmasi');
						}

						$Data=array(
								'data_temp'=>$Data_temp,
								'data_live'=>$Data_live,
								'data_detail_tps'=>$data_detail_tps
						);
				}

		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}


	public function getCalonByIdTpsAndPetugas(){

		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){
				$result = $this->Model_pilkada->getCalonByIdTpsAndPetugas($this->events->id_tps,$this->events->id_user);
				if($result->num_rows()>0){
					$Data=array('status'=>'true','message'=>'Ada Data','data'=>$result->result());
				}else{
					$Data=array('status'=>'false','message'=>'Belum Ada Calon Yang Terdaftar Pada TPS Anda');
				}
		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}

	public function inputSuaraCalon(){

		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){

			$kode_input_pilgub = $this->Model_globalAndroid->generateRandomString().rand(1000,9999);
			$kode_input_pilbub = $this->Model_globalAndroid->generateRandomString().rand(1000,9999);
			$result_tps = $this->Model_pilkada->getDataTPSByID($this->events->id_tps);

			$resPhoto = $this->Model_globalAndroid->getPhotoNameFromLogPhoto($this->events->uuid)->row();

			$today = date('Y-m-d H:i:s');
			if($this->events->is_pulgub=="true"){
						$dataSuaraTempGub=array(
								'id_tps'=>$this->events->id_tps,
								'id_pemilihan'=>$result_tps->id_pemilihan,
								'suara_valid'=>$this->events->suara_valid_pilgub,
								'suara_invalid'=>$this->events->suara_invalid_pilgub,
								'total_suara'=>$this->events->total_suara_pilgub,
								'foto_c1'=>$resPhoto->name,
								'note'=>$this->events->note,
								'date_create'=>date('Y-m-d H:i:s'),
								'status'=>"OPEN",
								'kode_input'=>$kode_input_pilgub,
								'jenis_pemilihan'=>"PILGUB",
						);
						$result_ = $this->Model_pilkada->inputHasilTemp($dataSuaraTempGub);
			}

			if($this->events->is_pulbub=="true"){
						$dataSuaraTempBub=array(
								'id_tps'=>$this->events->id_tps,
								'id_pemilihan'=>$result_tps->id_pemilihan,
								'suara_valid'=>$this->events->suara_valid_pilbub,
								'suara_invalid'=>$this->events->suara_invalid_pilbub,
								'total_suara'=>$this->events->total_suara_pilbub,
								'foto_c1'=>$resPhoto->name,
								'note'=>$this->events->note,
								'date_create'=>date('Y-m-d H:i:s'),
								'status'=>"OPEN",
								'kode_input'=>$kode_input_pilbub,
								'jenis_pemilihan'=>"PILBUB",
						);

						$result_ = $this->Model_pilkada->inputHasilTemp($dataSuaraTempBub);
			}

				if($result_){
					   $data_hasil_calon=json_decode($this->events->data_json,false);
						 $kode_input="";
						 foreach ($data_hasil_calon->SuaraCalon as $value) {

							 				if($value->tipeCalon=="PILGUB"){
													$kode_input=$kode_input_pilgub;
											}else{
													$kode_input=$kode_input_pilbub;
											}
											$dataSuaraCalon=array(
												 'id_tps'=>$value->idtps,
												 'id_calon'=>$value->idcalon,
												 'suara'=>$value->jmlSuara,
												 'date'=>$today,
												 'kode_input'=>$kode_input
											 );
										 $result_temp = $this->Model_pilkada->inputHasilCalon($dataSuaraCalon);
							}

							$data					= $this->Model_user->getUserByIdUser($this->events->id_user);
							$data_tps					= $this->Model_pilkada->getDataTPSByID($this->events->id_tps);
							$pesan="Penginputan C1 PLANO di TPS [".$data_tps->no_tps."] tanggal ".date("d-m-Y H:i", strtotime($today))." Berhasil DIAJUKAN";

							$firebase_id	= $data->firebase_id;
							$mdGlobal 		= $this->Model_globalAndroid->sendPushNotification("NOTIF",$firebase_id,"Penginputan C1 di TPS [".$data_tps->no_tps."]",$pesan,"","0");
							//($mode,$firebase_id,$title,$msg,$url_img,$url_web,$data_pesan="0") {

					$Data=array('status'=>'true','message'=>'Data berhasil di simpan');
				}else{
					$Data=array('status'=>'gagal','message'=>'Data gagal di simpan');
				}

		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}




	public function InputC1(){

		$uuid			=$this->Model_mcrypt->decrypt($this->input->post('uuid'));
		$uuid_awal=$this->Model_mcrypt->decrypt($this->input->post('uuid_awal'));
		// $uuid_awal=$this->input->post('uuid_awal');

		$new_foto=$uuid_awal.".".pathinfo($_FILES["image"]['name'], PATHINFO_EXTENSION);
		$config = array(
			'file_name' => $new_foto,
			'upload_path' => "./assets/upload/doc_c1/",
			'allowed_types' => "jpg|png|jpeg",
			'overwrite' => TRUE,
			'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
			// 'max_height' => "768",
			// 'max_width' => "1024"
			);

			$resPhoto = $this->Model_globalAndroid->getPhotoNameFromLogPhoto($uuid_awal);
			$row_foto = $resPhoto->num_rows();

			if($row_foto>0){
					$resPhoto = $resPhoto->row();
					if( strlen($resPhoto->uuid)>10 && strlen($resPhoto->name)>5){
							$file = "./assets/upload/doc_c1/".$resPhoto->name;
							if (file_exists($file) )
							{
								 unlink($file);
							}
					}
			}


			$this->load->library('upload', $config);
			if($this->upload->do_upload("image"))
			{
				$data = array('upload_data' => $this->upload->data());
				$res = $this->upload->data();

				if($row_foto>0){
						if(strlen($resPhoto->uuid)>10 && strlen($resPhoto->name)>5){
							$resUser = $this->Model_globalAndroid->update($resPhoto->id,$new_foto);
						}else{
							$resUser = $this->Model_globalAndroid->addLogFoto($uuid_awal,$new_foto);
						}
				}else{
					$resUser = $this->Model_globalAndroid->addLogFoto($uuid_awal,$new_foto);
				}


				$Data=json_encode($data);
				$this->ReturnReponse($Data);
			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				echo 	json_encode($error);
			}


	}
	public function tesUpload(){

		// $uuid			=$this->Model_mcrypt->decrypt($this->input->post('uuid'));
		$uuid_awal=$this->input->post('uuid');

		$new_foto=$uuid_awal.".".pathinfo($_FILES["image"]['name'], PATHINFO_EXTENSION);
		$config = array(
			'file_name' => $new_foto,
			'upload_path' => "./assets/upload/doc_c1/",
			'allowed_types' => "jpg|png|jpeg",
			'overwrite' => TRUE,
			'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
			// 'max_height' => "768",
			// 'max_width' => "1024"
			);

			$resPhoto = $this->Model_globalAndroid->getPhotoNameFromLogPhoto($uuid_awal);
			$row_foto = $resPhoto->num_rows();

			if($row_foto>0){
					$resPhoto = $resPhoto->row();
					if( strlen($resPhoto->uuid)>10 && strlen($resPhoto->name)>5){
							$file = "./assets/upload/doc_c1/".$resPhoto->name;
							if (file_exists($file) )
							{
								 unlink($file);
							}
					}
			}


			$this->load->library('upload', $config);
			if($this->upload->do_upload("image"))
			{
				$data = array('status'=>'true','upload_data' => $this->upload->data());
				$res = $this->upload->data();

				if($row_foto>0){
						if(strlen($resPhoto->uuid)>10 && strlen($resPhoto->name)>5){
							$resUser = $this->Model_globalAndroid->update($resPhoto->id,$new_foto);
						}else{
							$resUser = $this->Model_globalAndroid->addLogFoto($uuid_awal,$new_foto);
						}
				}else{
					$resUser = $this->Model_globalAndroid->addLogFoto($uuid_awal,$new_foto);
				}




				$Data=json_encode($data);
				$this->ReturnReponse($Data);
			}
			else
			{
				$error = array('status'=>'false','error' => $this->upload->display_errors());
				echo 	json_encode($error);
			}


	}

}
