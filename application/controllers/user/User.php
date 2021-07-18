<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Makassar");
		$this->events='';
		$this->load->model('Model_globalAndroid');
		$this->load->model('Model_user');
		$this->load->model('Model_mcrypt');
		$this->load->model('Model_pengaduan');
		$this->load->model('Model_pilkada');
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
			$this->Model_globalAndroid->InsertAddLog($body,$this->events->Func,"IN","user/User",@$this->events->id_user);


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
			$this->Model_globalAndroid->InsertAddLog($msg,@$this->events->Func,$type,"user/User");
	}


	public function enkripsi(){
		echo "en:".$this->Model_mcrypt->encrypt($this->events->enkripsi);
		echo " XXXX ";
		echo "dec:".$this->Model_mcrypt->decrypt($this->events->dekripsi);
	}


	public function registrasiAkun(){
			$result = $this->Model_user->registrasiAkun(
					$this->events->username,
					// $this->Model_mcrypt->encrypt($this->events->pwd),
					$this->events->pwd,
					$this->events->imei,
					$this->events->name,
					$this->events->phone,
					$this->events->firebase
			);
			$Data=json_encode($result);
			$this->ReturnReponse($Data);

	}

	public function loginAkun(){
			$tipe_user = @$this->events->tipe_user;
			$result = $this->Model_user->loginAkun(
					$this->events->firebase,
					$this->Model_mcrypt->decrypt($this->events->username),
					$this->Model_mcrypt->decrypt($this->events->pwd),
					$this->Model_mcrypt->decrypt($this->events->imei),
					$tipe_user
			);
			 $Data=json_encode($result);

			if(array_key_exists('token',$result)){
					$data=array('status'=>'true','message'=>'Anda berhasil login','token'=>$result['token'],'json'=>$this->Model_mcrypt->encrypt($Data));
			}else{
					$data=$result;
			}

			$this->ReturnReponse(json_encode($data));

	}

	public function loginAkunPetugas(){
			$result = $this->Model_user->loginAkun(
								$this->events->firebase,
								$this->Model_mcrypt->decrypt($this->events->username),
								$this->Model_mcrypt->decrypt($this->events->pwd),
								$this->Model_mcrypt->decrypt($this->events->imei)
			);

			$Data=json_encode($result);
			if(array_key_exists('token',$result)){
					$data_onprogress = $this->Model_pengaduan->getPengaduanByIdPetugas($result['id_user'],"'OPEN'");
					$data_history = $this->Model_pengaduan->getPengaduanByIdPetugas($result['id_user'],"'CLOSE','CANCEL','REJECTED'");

					if($data_onprogress->num_rows()>0){
								$data_=array();
								foreach($data_onprogress->result() as $rows)
								{
										$result_pengaduan_detail[$rows->id_complaint] = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($rows->id_complaint);
										$data_[$rows->id_complaint] = $result_pengaduan_detail[$rows->id_complaint]->result();
								}
								$data_detail_complaint=$data_;
					}else{
						$data_detail_complaint=array('status'=>'false','message'=>'Belum ada pekerjaan dalam fase onprogress');
					}

					if($data_history->num_rows()>0){
								$data_=array();
								foreach($data_history->result() as $rows)
								{
										$result_history[$rows->id_complaint] = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($rows->id_complaint);
										$data_[$rows->id_complaint] = $result_history[$rows->id_complaint]->result();
								}
								$result_detail_history=$data_;
					}else{
							$result_detail_history=array('status'=>'false','message'=>'Belum ada history');
					}


					$data=array(
						'status'=>'true',
						'message'=>'Anda berhasil login',
						'token'=>$result['token'],
						'data_dashboard'=>$this->Model_user->dataResumePetugas($result['id_user']),
						'data_onprogress'=>$data_onprogress->result(),
						'data_detail_onpgress'=>$data_detail_complaint,

						'data_history'=>$data_history->result(),
						'data_detail_history'=>$result_detail_history,
						'json'=>$this->Model_mcrypt->encrypt($Data),
					);
			}else{
					$data=$result;
			}

			$this->ReturnReponse(json_encode($data));

	}

	public function dashboardPetugas(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		// $result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,"6e7e3570964c2ed76539bb4a863b60d14b8c78270a3ec16ac68adf4bcc7c76ef");
		if($result_token['status']==true){

					$data_onprogress = $this->Model_pengaduan->getPengaduanByIdPetugas($this->events->id_user,"'OPEN','APPROVED'");
					$data_history = $this->Model_pengaduan->getPengaduanByIdPetugas($this->events->id_user,"'CLOSE','CANCEL','REJECTED'");

					$data_tps = $this->Model_pilkada->getDataTPSbyIdPetugasPemilihan($this->events->id_user);

					if($data_tps->num_rows()>0){
						$data_detail_tps=array('status'=>'true','message'=>'Ada Data','data'=>$data_tps->result());
					}else{
						$data_detail_tps=array('status'=>'false','message'=>'Anda Belum Memiliki Tempat Penugasan Di TPS Manapun');
					}

					if($data_onprogress->num_rows()>0){
								$data_=array();
								foreach($data_onprogress->result() as $rows)
								{
										$result_pengaduan_detail[$rows->id_complaint] = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($rows->id_complaint);
										$data_[$rows->id_complaint] = $result_pengaduan_detail[$rows->id_complaint]->result();
								}
								$data_detail_complaint=array( 'status'=>'true','message'=>'','data'=>$data_);
					}else{
								$data_detail_complaint=array('status'=>'false','message'=>'Belum ada pekerjaan dalam fase onprogress');
					}

					if($data_history->num_rows()>0){
								$data_=array();
								foreach($data_history->result() as $rows)
								{
										$result_history[$rows->id_complaint] = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($rows->id_complaint);
										$data_[$rows->id_complaint] = $result_history[$rows->id_complaint]->result();
								}
								// $result_detail_history=$data_;
								$result_detail_history=array( 'status'=>'true','message'=>'','data'=>$data_);
					}else{
							$result_detail_history=array('status'=>'false','message'=>'Belum ada history');
					}


					$data=array(
						'status'=>'true','message'=>'Ada Data',
						'data_dashboard'=>$this->Model_user->dataResumePetugas($this->events->id_user),
						'data_onprogress'=>$data_onprogress->result(),
						'data_detail_onpgress'=>$data_detail_complaint,
						'data_history'=>$data_history->result(),
						'data_detail_history'=>$result_detail_history,
						'data_detail_tps'=>$data_detail_tps
					);


		}else{
			 $data=$result_token;
		}
			$this->ReturnReponse(json_encode($data));

	}




	public function getDataHistoryByIdPetugas(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		// $result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,"6e7e3570964c2ed76539bb4a863b60d14b8c78270a3ec16ac68adf4bcc7c76ef");
		if($result_token['status']==true){


					$data_history = $this->Model_pengaduan->getPengaduanByIdPetugas($this->events->id_user,"'CLOSE','CANCEL','REJECTED'");

					$status="true";
					$msg='';
					if($data_history->num_rows()>0){
								$data_=array();
								foreach($data_history->result() as $rows)
								{
										$result_history[$rows->id_complaint] = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($rows->id_complaint);
										$data_[$rows->id_complaint] = $result_history[$rows->id_complaint]->result();
								}
								$result_detail_history=$data_;
					}else{
							$status="false";
							$msg='Belum ada pekerjaan yang terselesaikan';
							$result_detail_history=array('status'=>$status,'message'=>$msg);
					}


					$data=array(
						'status'=>$status,'message'=>$msg,
						'data_history'=>$data_history->result(),
						'data_detail_history'=>$result_detail_history
					);


		}else{
			 $data=$result_token;
		}
			$this->ReturnReponse(json_encode($data));

	}

	public function getDataOnprogressByIdPetugas(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		// $result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,"6e7e3570964c2ed76539bb4a863b60d14b8c78270a3ec16ac68adf4bcc7c76ef");
		if($result_token['status']==true){

					$data_onprogress = $this->Model_pengaduan->getPengaduanByIdPetugas($this->events->id_user,"'OPEN','APPROVED'");
					$status="true";
					$msg="";
					if($data_onprogress->num_rows()>0){
								$data_=array();
								foreach($data_onprogress->result() as $rows)
								{
										$result_pengaduan_detail[$rows->id_complaint] = $this->Model_pengaduan->getDataPengaduanDetailByIdComplaint($rows->id_complaint);
										$data_[$rows->id_complaint] = $result_pengaduan_detail[$rows->id_complaint]->result();
								}
								// $data_detail_complaint=$data_;
								$data_detail_complaint=array( 'status'=>'true','message'=>'','data'=>$data_);

					}else{
								$status="false";
								$msg='Belum ada pekerjaan dalam fase onprogress';
								$data_detail_complaint=array('status'=>$status,'message'=>$msg);
					}


					$data=array(
						'status'=>$status,'message'=>$msg,
						'data_onprogress'=>$data_onprogress->result(),
						'data_detail_onpgress'=>$data_detail_complaint
					);

		}else{
			 $data=$result_token;
		}
			$this->ReturnReponse(json_encode($data));

	}


	public function insertLogLokasi(){
			$result = $this->Model_user->insertLogLokasi($this->events->id_user,$this->events->lat,$this->events->longi);
			$Data=json_encode($result);
			$this->ReturnReponse($Data);

	}

	public function updateStatusPetugas(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){
			$result = $this->Model_user->updateStatusPetugas($this->events->id,$this->events->status);
			$Data=json_encode($result);
		}else{
			$Data=$result_token;
		}
			$this->ReturnReponse($Data);

	}
	public function logoutAkun(){
			$result = $this->Model_user->logoutAkun($this->events->id);
			$Data=json_encode($result);
			$this->ReturnReponse($Data);

	}


	public function gantiPasswordAkun(){
		$result = $this->Model_user->checkTokenLogin($this->events->username,$this->events->token);
			if($result['status']==true){
							$data_user = $this->Model_user->getUserByIdUser($result['id_user']);

							if(	$this->Model_mcrypt->decrypt($data_user->pwd)!=$this->Model_mcrypt->decrypt($this->events->pwd)){
									$Data_ = $this->Model_user->gantiPasswordAkun($this->events->pwd,$result['id_user']);
							}else{
									$Data_=array( 'status'=>'false','message'=>'Password baru Anda harus berbeda dengan password lama');
							}
			}else{
					$Data_=$result;
			}
			$Data=json_encode($Data_);
			$this->ReturnReponse($Data);

	}
	public function updateImei(){
			$data_user = $this->Model_user->updateImei($this->Model_mcrypt->decrypt($this->events->username),$this->Model_mcrypt->decrypt($this->events->pwd));
			$Data_=$data_user;
			$Data=json_encode($Data_);
			$this->ReturnReponse($Data);

	}



	public function forgotPassword(){
		 $result = $this->Model_user->checkUserIsExist($this->events->username,$this->events->phone);
			if($result['status']==true){
						$Data_=array( 'status'=>'false','message'=>'Data ditemukan','id_user'=>$result['id_user'],'token'=>$result['token']);
			}else{
					$Data_=$result;
			}

			$Data=json_encode($result);
			$this->ReturnReponse($Data);

	}

	public function savePasswordAkun(){
			$Data_ = $this->Model_user->gantiPasswordAkun($this->events->pwd,$this->events->id_user);
			$Data=json_encode($Data_);
			$this->ReturnReponse($Data);
	}

	public function gantiHPProfile(){
 		 $Data_ = $this->Model_user->gantiHP($this->events->hp,$this->events->id_user);
 		 $Data=json_encode($Data_);
 		 $this->ReturnReponse($Data);
  }






	public function insertComment(){

			$result = $this->Model_globalAndroid->insertComment(
					$this->input->post('id'),
					$this->input->post('iduser'),
					$this->input->post('msg'),
					$this->input->post('valrating')
			);

			if($result==true){
				$Data_=array( 'status'=>'true','message'=>'Data Berhasil Dikirim');
			}else{
				$Data_=array('news'=>array( 'status'=>'false','message'=>'Data Gagal Dikirim'));
			}

			$Data=json_encode($Data_);
			$this->ReturnReponse($Data);
	}


	public function ChangePhotoProfile(){


		$id_user=$this->Model_mcrypt->decrypt($this->input->post('id_user'));
		$uuid=$this->Model_mcrypt->decrypt($this->input->post('uuid'));
		$uuid_awal=$this->Model_mcrypt->decrypt($this->input->post('uuid_awal'));

		$config = array(
			'upload_path' => "./assets/upload/user/",
			'allowed_types' => "jpg|png|jpeg",
			'overwrite' => TRUE,
			'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
			// 'max_height' => "768",
			// 'max_width' => "1024"
			);

			$this->load->library('upload', $config);
			$resUser = $this->Model_user->getUserByIdUser($id_user);
			$file = "./assets/upload/user/".$resUser->foto;
			if (file_exists($file) )
			{
				if($resUser->foto=="noimage.png"||$resUser->foto=="no_image.png"||$resUser->foto=="noimage.jpg"){

				}else{
					unlink($file);
				}

			}

			if($this->upload->do_upload("image"))
			{
				$data = array('upload_data' => $this->upload->data());
				$res = $this->upload->data();
				$result = $this->Model_user->uploadFotoProfile($id_user,$res['file_name']);
				$resUser = $this->Model_globalAndroid->addLogFoto($uuid_awal,$res['file_name']);
				// echo json_encode($data);

				$Data=json_encode($data);
				$this->ReturnReponse($Data);


			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				echo 	json_encode($error);
			}


	}



	public function loginSmartbiz(){
		if($this->events->status=="0"){
			$Data_=array( 'status'=>500,'message'=>'Failed login');
			$Data=json_encode($Data_);
			echo $Data;
		}else{

			echo '{
							    "status": 200,
							    "message": "Logged1",
							    "data": {
							        "user": {
							            "id": 1,
							            "username": "satrya",
							            "email": "satrya@gmail.com",
							            "roles": [
							                {
							                    "id": 1,
							                    "name": "Super Admin",
							                    "slug": "super-admin",
							                    "permissions": [
							                        {
							                            "id": 1,
							                            "name": "Get Access System",
							                            "slug": "get-access-system"
							                        },
							                        {
							                            "id": 2,
							                            "name": "Get Access Company",
							                            "slug": "get-access-company"
							                        },
							                        {
							                            "id": 3,
							                            "name": "Get Access Human Resource",
							                            "slug": "get-access-human-resource"
							                        },
							                        {
							                            "id": 4,
							                            "name": "Get Access Employee Self Service",
							                            "slug": "get-access-employee-self-service"
							                        }
							                    ]
							                },
							                {
							                    "id": 8,
							                    "name": "Developer",
							                    "slug": "developer",
							                    "permissions": null
							                }
							            ],
							            "groups": [
							                {
							                    "id": 1,
							                    "name": "System",
							                    "slug": "system"
							                }
							            ],
							            "companies": null,
							            "application": [
							                {
							                    "id": 1,
							                    "name": "Human Resource",
							                    "slug": "human-resource"
							                }
							            ]
							        },
							        "token": {
							            "token_type": "Bearer",
							            "expires_in": 3600,
							            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJiZmQyZWQwMzMxMjg3MmE5NzdjZTk4MTFmZTEwYjU0N2E4Njk1YjhiNjAyMjBmZTkzYzdhZGY3ZGMzNmVjNTc0YmY1M2QzMTc2NzA5OGUyIn0.eyJhdWQiOiIyIiwianRpIjoiMmJmZDJlZDAzMzEyODcyYTk3N2NlOTgxMWZlMTBiNTQ3YTg2OTViOGI2MDIyMGZlOTNjN2FkZjdkYzM2ZWM1NzRiZjUzZDMxNzY3MDk4ZTIiLCJpYXQiOjE1ODkzNDMyNDksIm5iZiI6MTU4OTM0MzI0OSwiZXhwIjoxNTg5MzQ2ODQ5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.hjEbf0fBodGUDUKUvYJBOVvTWs8be5QNnWiTVR6PZmzAMSVKwBaYiObLp1ZGDWN727VpoCBpNsZjkjhaEW9ZL4eD8ljoaWuetrXPtY51GdbESyFIEenapzSYY7M-kj-iulqZ8Mp5aMv20E5i8tsf6Qw5BMNcOpEN1Xj2kN98FnipJwCJCwslVAdbb41U3kr_e75bIFJyArevn-s9xutnR8OW3LYQfjmW-7jS6ieuO1ZZq7yLFaUK0umjOo9W97y29eMZLZKoAPe_BxIb2wLpk42V_qjkuR56Jlvru121eMAHtR4ufWW31dC3yIdARco44s8TLAzctLtKXv4kvpHL4CZGjQ1x6zN6JHtzPfBHqZAuQfG3o417rQQPFnJ7wiqtUF44nwv-D3fS0p7SE2OXYIBoOpYva8v9xVgNDkdEVXnfyE1w9q_cZadOclHo5J78oKPhW5xmmpzNIPoiRIUUOEj0jHDTml9_-8xdCezKj61nqiGt4UO8V9x5nUl62CZszqeb4thxnQwLku1gHIFGXaKsm9a5RBGSp8eeJvG2Hl7i3ZAPs2tGdS3l1xQaqdx5ynwIGU2zjav9kzK2oJzvw6AaJYvRHBVNEf86gm9619S8KoduLT0Jb0KRMMBJyFIU09tiUNdhLFdpDGFblrLDcKCaGcqgr5QonGnKLe1xDKc",
							            "refresh_token": "def502009b2ed347f0cf8ec7d2e88af3715d1ebee25c550ecf08dc2f1240dc6ccc5d26156c8d3ec70e5eff0d7f90279cf326569b492aa160fd24b4f7a94b78669b877900f31b3a21fbe79e51535a007c6172a3f54507f9cb2ba3289b053230d64e4db3640f343c6c3815d4997f7af1c4158e8b946a74f53d32bfcf2d7d5a070155a59fbc3b7eec2526fc4c4e08e1119f67d2b7a89eb8693161a7f25c7d26395a3f07ed2efdd78c2eebe2b06edd575a1ab7ba707a5c20c6bf9af223dd52c4c52867709339747547b022a453683e757e79fa4d7994f2140c5753d753e297ee22c95ba873dde96eded31bc091ef451c465d99d585a821551307cf218ef8cabceae98bad71bdd54fe650f7f44917fb28a2824065e54c8989d867a74cfaef7d99b006c9295d3899145278f0642c29a8049a2fe8cb66a1da13a022ee662b4f350c3a28f58a95902e941b79c4454e583cb150cf4ed1aec66eeaacf00fc25fda5e73df934e"
							        }
							    }
							}';
		}


  }



	// PETUGAS













}
