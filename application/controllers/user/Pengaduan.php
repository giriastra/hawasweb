<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Makassar");
		$this->events='';
		$this->load->model('Model_globalAndroid');
		$this->load->model('Model_user');
		$this->load->model('Model_pengaduan');
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
			$this->Model_globalAndroid->InsertAddLog($body,$this->events->Func,"IN","user/Pengaduan",@$this->events->id_user);


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
			$this->Model_globalAndroid->InsertAddLog($msg,@$this->events->Func,$type,"user/Pengaduan");
	}


	public function getDataForumByIdPetugas(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){

				$result_pengaduan = $this->Model_pengaduan->getForumByIdPetugas($this->events->id_user);

				if($result_pengaduan->num_rows()>0){
					$result_pengaduan_detail = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($result_pengaduan->row()->id_complaint);
					$Data=array('status'=>'true','message'=>'Ada Data','forum'=>$result_pengaduan->result(),'forum_detail'=>$result_pengaduan_detail->result());
				}else{
					$Data=array('status'=>'false','message'=>'Belum ada data forum');
				}
		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}

	public function getDataPengaduanByIdUser(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){

				$result_pengaduan = $this->Model_pengaduan->getPengaduanByIdUser($this->events->id_user);

				if($result_pengaduan->num_rows()>0){

							$data_=array();
							foreach($result_pengaduan->result() as $rows)
							{
									$result_pengaduan_detail[$rows->id_complaint] = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($rows->id_complaint);
									$data_[$rows->id_complaint] = $result_pengaduan_detail[$rows->id_complaint]->result();
							}

							$data_detail_forum=array( 'status'=>'true','message'=>'','data'=>$data_);
							$Data=array('status'=>'true','message'=>'Ada Data','pengaduan'=>$result_pengaduan->result(),'pengaduan_detail'=>$data_detail_forum);
				}else{
					$Data=array('status'=>'false','message'=>'Belum ada data pengaduan');
				}
		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}

	public function getDataPengaduanDetailByIdUserAndIdComplaint(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){


			$result_pengaduan_detail[$this->events->id_complaint] = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($this->events->id_complaint);
			$data_[$this->events->id_complaint] = $result_pengaduan_detail[$this->events->id_complaint]->result();

			$data_detail_forum=array( 'status'=>'true','message'=>'','data'=>$data_);
			$Data=array('status'=>'true','message'=>'Ada Data','pengaduan_detail'=>$data_detail_forum);

		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}


	public function getDataPengaduanByIdPetugas(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){

				$result_pengaduan = $this->Model_pengaduan->getPengaduanByIdPetugas($this->events->id_user,"'CLOSE','CANCEL','REJECTED'",'1000');

				if($result_pengaduan->num_rows()>0){

							$data_=array();
							foreach($result_pengaduan->result() as $rows)
							{
									$result_pengaduan_detail[$rows->id_complaint] = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($rows->id_complaint);
									$data_[$rows->id_complaint] = $result_pengaduan_detail[$rows->id_complaint]->result();
							}

							$data_detail_forum=array( 'status'=>'true','message'=>'','data'=>$data_);
							$Data=array('status'=>'true','message'=>'Ada Data','pengaduan'=>$result_pengaduan->result(),'pengaduan_detail'=>$data_detail_forum);
				}else{
					$Data=array('status'=>'false','message'=>'Belum ada data pengaduan');
				}
		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}

public function addNewRequestPengaduan(){

	$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
	if($result_token['status']==true){
			$data=array(
				'title'=>$this->events->title,
				'id_petugas'=>$this->events->id_petugas,
				'id_user'=>$this->events->id_user,
				'date_request'=>date('Y-m-d H:i:s'),
				'code'=>$this->Model_globalAndroid->generateRandomString().rand(1000,9999),
				'status'=>'OPEN'
			);
			$last_id = $this->Model_pengaduan->addNewRequestPengaduan($data);
			$this->Model_pengaduan->addTrackStatus($last_id);

			$data_detail=array(
				'id_complaint'=>$last_id,
				// 'id_petugas'=>$this->events->id_petugas,
				'id_petugas'=>"0",
				'id_user'=>$this->events->id_user,
				'message'=>$this->events->message,
				'unique_id'=>$this->events->unique_id,
				'date'=>date('Y-m-d H:i:s')
			);
			$Data = $this->Model_pengaduan->addNewPengaduanDetail($data_detail);

			if($Data['status']==true){

				$data = $this->Model_user->getUserByIdUser($this->events->id_petugas);
				$firebase_id=$data->firebase_id;
				$mdGlobal = $this->Model_globalAndroid->sendPushNotification("CHAT",$firebase_id,"Permintaan Pengaduan ",$this->events->title,"","");

						$result_pengaduan = $this->Model_pengaduan->getPengaduanByIdUser($this->events->id_user);
						if($result_pengaduan->num_rows()>0){

									$data_=array();
									foreach($result_pengaduan->result() as $rows)
									{
											$result_pengaduan_detail[$rows->id_complaint] = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($rows->id_complaint);
											$data_[$rows->id_complaint] = $result_pengaduan_detail[$rows->id_complaint]->result();
									}

									$data_detail_forum=array( 'status'=>'true','message'=>'','data'=>$data_);
									$Data=array('status'=>'true','message'=>'Anda Berhasil Submit Data, Mohon Menunggu Petugas Untuk Melakukan APPROVE','pengaduan'=>$result_pengaduan->result(),'pengaduan_detail'=>$data_detail_forum);
						}else{
							$Data=array('status'=>'false','message'=>'Request Petugas Gagal, Mohon coba beberapa saat lagi');
						}
			}

	}else{
		$Data=$result_token;
	}

	$this->ReturnReponse(json_encode($Data));

}



public function getDataPengaduanByIdComplaint(){

	$data_pengaduan = $this->Model_pengaduan->getDataPengaduanByIdComplaint($this->events->id_complaint);
	$data_=array();
	$result_pengaduan_detail[$this->events->id_complaint] = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($this->events->id_complaint);
	$data_[$this->events->id_complaint] = $result_pengaduan_detail[$this->events->id_complaint]->result();
	$data_detail_forum=array( 'status'=>'true','message'=>'','data'=>$data_);
	$Data=array('status'=>'true','message'=>'Berhasil Reload Data...','pengaduan_detail'=>$data_detail_forum);

	$this->ReturnReponse(json_encode($Data));



}
public function addNewPengaduanDetail(){


	if($this->events->type_user=="USER"){
			$id_user = $this->events->id_user;
			$id_petugas = "0";
			$id_user_param=$this->events->id_user;
			$id_user_firebase=$this->events->id_petugas;
	}else{
			$id_petugas  = $this->events->id_petugas;
			$id_user = "0";
			$id_user_param=$this->events->id_petugas;
			$id_user_firebase=$this->events->id_user;
	}

	$result_token = $this->Model_user->checkTokenLoginByIdUser($id_user_param,$this->events->token);

	$data_pengaduan = $this->Model_pengaduan->getDataPengaduanByIdComplaint($this->events->id_complaint);

	if($result_token['status']==true){

		if($data_pengaduan->status=="OPEN" || $data_pengaduan->status=="APPROVED"){

					$data_forum_detail=array(
							'id_complaint'=>$this->events->id_complaint,
							'id_petugas'=>$id_petugas,
							'id_user'=>$id_user,
							'message'=>$this->events->message,
							'unique_id'=>$this->events->unique_id,
							'date'=>date('Y-m-d H:i:s')
					);
					$Data = $this->Model_pengaduan->addNewPengaduanDetail($data_forum_detail);

					if($data_pengaduan->status=="OPEN"){
						//public function updateStatusPengaduan($id_forum,$status,$valrating="0",$message=""){
							$respon = $this->Model_pengaduan->updateStatusPengaduan($this->events->id_complaint,'APPROVED','','');
					}

					if($Data['status']=="true"){

							$data					= $this->Model_user->getUserByIdUser($id_user_firebase);
							$firebase_id	= $data->firebase_id;

							$data_pesan = array(
								'id_complaint'=>$this->events->id_complaint,
								'id_user'=>$this->events->id_user,
								'id_petugas'=>$this->events->id_petugas,
							);

							$mdGlobal 		= $this->Model_globalAndroid->sendPushNotification("CHAT",$firebase_id,"Pesan Baru Code ".$data_pengaduan->code,$this->events->message,"","",$data_pesan);
							//end send notif
							$data_=array();
							$result_pengaduan_detail[$this->events->id_complaint] = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($this->events->id_complaint);
							$data_[$this->events->id_complaint] = $result_pengaduan_detail[$this->events->id_complaint]->result();
							$data_detail_forum=array( 'status'=>'true','message'=>'','data'=>$data_);
							$Data=array('status'=>'true','message'=>'Data berhasil dikirim','pengaduan_detail'=>$data_detail_forum);
					}
		}else{
			$Data=array('status'=>'false','message'=>'Status pengaduan pada fase ['.$data_pengaduan->status.'], Anda tidak bisa mengirim pesan kembali.');
		}



	}else{
		$Data=$result_token;
	}
	$this->ReturnReponse(json_encode($Data));
}


public function updatePengaduan(){

	if($this->events->type_user=="USER"){
			$id_user=$this->events->id_user;
	}else{
			$id_user=$this->events->id_petugas;
	}

	$result_token = $this->Model_user->checkTokenLoginByIdUser($id_user,$this->events->token);
	if($result_token['status']==true){
			if($this->events->status=="OPEN"){
					$STATUS = "APPROVED";
			}else if($this->events->status=="APPROVED"){
					$STATUS = "CLOSE";
			}else if($this->events->status=="CANCEL"){
					$STATUS = "CANCEL";
			}else if($this->events->status=="REJECTED"){
					$STATUS = "REJECTED";
			}else{
					$STATUS = "ADD_RATING";

			}
			$Data = $this->Model_pengaduan->updateStatusPengaduan($this->events->id_complaint,$STATUS,$this->events->rating,$this->events->comment);

			$res_comp = $this->Model_pengaduan->getDataPengaduanByIdComplaint($this->events->id_complaint);

			if($this->events->type_user=="USER"){
					$data = $this->Model_user->getUserByIdUser($this->events->id_petugas);

					if($STATUS=="ADD_RATING"){
							$pesan="Pengaduan dengan KODE :".$res_comp->code." telah diberikan RATING dan KOMENTAR oleh USER. Silakan cek pada data HISTORY";
					}else{
							$pesan="Pengaduan dengan KODE :".$res_comp->code." statusnya telah di perbaharui menjadi ".$STATUS." oleh USER. Silakan cek pada data HISTORY";
					}

			}else{
					$data = $this->Model_user->getUserByIdUser($this->events->id_user);
					if($STATUS=="CLOSE"){
						$pesan="Pengaduan dengan KODE :".$res_comp->code." statusnya telah di perbaharui menjadi ".$STATUS." oleh PETUGAS. Silakan memberikan RATING dan KOMENTAR!";
					}else{
						$pesan="Pengaduan dengan KODE :".$res_comp->code." statusnya telah di perbaharui menjadi ".$STATUS." Silakan lihat pada menu PENGADUAN";
					}
			}


			$firebase_id=$data->firebase_id;
			$mdGlobal = $this->Model_globalAndroid->sendPushNotification("PENGADUAN",$firebase_id,"Pembaharuan Status Pengaduan : ".$res_comp->code,$pesan,"","");



	}else{
		$Data=$result_token;
	}

	$this->ReturnReponse(json_encode($Data));
}


public function getAllPetugasOnline(){
	$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
	if($result_token['status']==true){
			// $Data = $this->Model_pengaduan->getAllPetugasOnline($this->events->latitude,$this->events->longitude);
			$Data = $this->Model_pengaduan->getAllPetugasOnline();
			if($Data->num_rows()>0){
				$Data=array( 'status'=>'true','message'=>'','data'=>$Data->result());
			}else{
				$Data=array('status'=>'false','message'=>'Tidak ada petugas yang tersedia disekitar Anda');
			}
	}else{
		 $Data=$result_token;
	}

	$this->ReturnReponse(json_encode($Data));

}




public function approvePengaduanByRequest(){

	$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_petugas,$this->events->token);
	if($result_token['status']==true){

			// TB COMPLAINT UTAMA

			$data_req = $this->Model_pengaduan->manageRequestComplaint("select",$this->events->last_id_request,$this->events->uuid_request,"");
			if($data_req->num_rows()>0){


				$today = date('Y-m-d H:i:s');
				$data=array(
					'title'=>$this->events->title,
					'id_petugas'=>$this->events->id_petugas,
					'id_user'=>$this->events->id_user,
					'date_request'=>$today,
					'date_confirm'=>$today,
					'code'=>$this->Model_globalAndroid->generateRandomString().rand(1000,9999),
					'status'=>'APPROVED'
				);
				$last_id = $this->Model_pengaduan->addNewRequestPengaduan($data);
				$this->Model_pengaduan->addTrackStatus($last_id);

				// CHAT USER
				$data_detail=array(
					'id_complaint'=>$last_id,
					'id_petugas'=>"0",
					'id_user'=>$this->events->id_user,
					'message'=>$this->events->message,
					'unique_id'=>$this->events->unique_id,
					'date'=>$today
				);
				$Data = $this->Model_pengaduan->addNewPengaduanDetail($data_detail);

				// BALASAN CHAT PETUGAS
				$data_detail=array(
					'id_complaint'=>$last_id,
					'id_petugas'=>$this->events->id_petugas,
					'id_user'=>"0",
					'message'=>$this->events->balasan,
					'unique_id'=>$this->events->unique_id,
					'date'=>$today
				);
				$Data = $this->Model_pengaduan->addNewPengaduanDetail($data_detail);

				if($Data['status']==true){

					$res = $this->Model_pengaduan->manageRequestComplaint("update",$this->events->last_id_request,$this->events->uuid_request,"APPROVED");

					$data = $this->Model_user->getUserByIdUser($this->events->id_user);
					$firebase_id=$data->firebase_id;

					$data_pesan = array(
						'id_complaint'=>$last_id,
						'id_user'=>$this->events->id_user,
						'id_petugas'=>$this->events->id_petugas,
					);

					// send notif ke masyarakat
					$mdGlobal = $this->Model_globalAndroid->sendPushNotification("REQ_PENGADUAN_APPROVE",$firebase_id,"Status Pengaduan Anda DITERIMA","Pengaduan Anda pada Tanggal ".date("d-m-Y", strtotime($today))." sudah di TERIMA, Silakan buka aplikasi HAWAS","","",$data_pesan);

						$Data=array('status'=>'true','message'=>'Pesan sudah di kirim untuk di sampaikan.');
				}else{
					$Data=array('status'=>'false','message'=>'Request Petugas Gagal, Mohon coba beberapa saat lagi');
				}

			}else{
						$Data=array('status'=>'false','message'=>'Data Request Sudah Dibatalkan Oleh User');


			}


	}else{
		$Data=$result_token;
	}

	$this->ReturnReponse(json_encode($Data));

}

public function rejectPengaduanByRequest(){

	$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_petugas,$this->events->token);
	if($result_token['status']==true){

			$this->Model_pengaduan->manageRequestComplaint("update",$this->events->last_id_request,$this->events->uuid_request,"REJECTED");

			$data_user = $this->Model_user->getUserByIdUser($this->events->id_user);
			$mdGlobal = $this->Model_globalAndroid->sendPushNotification("REQ_PENGADUAN_REJECTED",$data_user->firebase_id,"Status Permintaan Pengaduan DITOLAK","Status Permintaan Pengaduan Anda\n\nJUDUL:  ".$this->events->title."\nPESAN:  ".$this->events->message."\nSTATUS:  DITOLAK\nALASAN:  ".$this->events->balasan."\n\nSilakan menunggu petugas lain atau lakukan request manual","","","0");

			$data_petugas = $this->Model_user->getUserByIdUser($this->events->id_petugas);

			$waktu_timeout = $this->Model_globalAndroid->getDataSetting("TIME_REQ_AUTO","TIME_REQ_AUTO");
			$waktu_timeout = $waktu_timeout->row()->value;

			$mdGlobal = $this->Model_globalAndroid->sendPushNotification("NOTIF",$data_petugas->firebase_id,"Permintaan Pengaduan EXPIRED!","Anda Menerima Permintaan Pengaduan Namun Tidak Anda Tanggapi.\n\nJUDUL:  ".$this->events->title."\nPESAN:  ".$this->events->message."\nSTATUS:  EXPIRED\nALASAN:Tidak Ada Tanggapan Dari Aplikasi (TIMEOUT)\n\nIngat, batas waktu menanggapi adalah ".$waktu_timeout." detik","","","0");
		  $Data=array('status'=>'true','message'=>'Permintaan Penolakan Berhasil dan Sudah di beritahukan kembali.');

	}else{
		$Data=$result_token;
	}

	$this->ReturnReponse(json_encode($Data));

}



public function requestPetugasOnline(){

			$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
			if($result_token['status']==true){

				$last_id = $this->Model_pengaduan->manageRequestComplaint("add","0",$this->events->uuid_request,"");
				//$id_petugas = 48;

				 $data_petugas_terdekat = $this->Model_user->getPetugasTerdekat($this->events->uuid_load);
	 			 if(count($data_petugas_terdekat)>0){


					 $is_ada_data=false;
	 							 // $radius = "1000";
	 							 $radius = $this->Model_globalAndroid->getDataSettingByKat("RADIUS_PETUGAS")->value;
	 							foreach ($data_petugas_terdekat as $row) {
	 									 $jarak = $this->Model_globalAndroid->getJarakKordinat($this->events->lat_user,$this->events->long_user,$row['latitude'],$row['longitude']);
	 									 $nilai[]=$jarak;

	 										if($jarak <= $radius ){
												$is_ada_data=true;
	 											$rows[]=array(
	 												'jarak'=>$jarak,
	 												'id_user'=>$row['id_user'],
	 												'latitude'=>$row['latitude'],
	 												'longitude'=>$row['longitude']
	 											);
	 										}
	 							}

								if($is_ada_data){

											$min_ = min($nilai);
				 							foreach ($rows as $row_data) {
				 								 if($min_==$row_data['jarak']){
				 									 $id_petugas = $row_data['id_user'];
				 								 }
				 							}

				 							$data=array(
				 									 'uuid'=>$this->events->uuid_load,
				 									 'id_user'=>$this->events->id_user,
				 									 'id_petugas'=>$id_petugas,
				 									 'create_date'=>date('Y-m-d H:i:s')
				 							 );
				 							$res = $this->Model_user->insertLogReqCompOnline($data);


											$data_petugas_terdekat = $this->Model_user->getPetugasTerdekat($this->events->lat_user,$this->events->long_user,$this->events->uuid_load);
											$data_petugas = $this->Model_user->getUserByIdUser($id_petugas);
											$firebase_id=$data_petugas->firebase_id;

											$data_user = $this->Model_user->getUserByIdUser($this->events->id_user);
											$data_pesan = array(
												'id_user'=>$data_user->id_user,
												'name'=>$data_user->name,
												'foto'=>$data_user->foto,
												'title_pengaduan'=>$this->events->title,
												'message_pengaduan'=>$this->events->message,
												'tgl_pengaduan'=>date('d-m-Y H:i'),
												'uuid_request'=>$this->events->uuid_request,
												'last_id_request'=>$last_id,
											);

											// send notif to petugas
											$mdGlobal = $this->Model_globalAndroid->sendPushNotification("REQ_PENGADUAN",$firebase_id,"Permintaan Pengaduan ".$this->events->title,"Ada Permintaan Pengaduan, Silakan buka aplikasi HAWAS untuk memproses lebih lanjut","","",$data_pesan);

											$Data=array(
												'status'=>'true',
												'pesan'=>'Petugas Ditemukan!, Menunggu Konfirmasi Petugas.',
												'title'=>$this->events->title,
												'message'=>$this->events->message,
												'id_user'=>$this->events->id_user,
												'image'=>$data_user->foto,
												'nama_user'=>$data_user->name
											);

								}else{
									$Data=array('status'=>'false','message'=>'Data Petugas Tidak ditemukan, GPS Anda tidak mengirim lokasi');
								}



	 			 }else{
	 				 			$Data=array('status'=>'false','message'=>'Data Petugas Tidak ditemukan!');
	 			 }

			}else{
				 $Data=$result_token;
			}

			$this->ReturnReponse(json_encode($Data));

}


public function getTrackingStatus(){
	$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
	if($result_token['status']==true){
			$Data = $this->Model_pengaduan->getTrackingStatus($this->events->id_complaint);
			if($Data->num_rows()>0){
				$Data=array( 'status'=>'true','message'=>'','data'=>$Data->result());
			}else{
				$Data=array('status'=>'false','message'=>'Tracking status tidak ditemukan');
			}
	}else{
		 $Data=$result_token;
	}

	$this->ReturnReponse(json_encode($Data));

}

















}
