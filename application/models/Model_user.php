<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model {

	public function insertFirebaseID($imei,$gcm){

    $today = date('Y-m-d H:i:s');
    $q = $this->db->query("select * from tb_firebase_log where imei='".$imei."' ")->num_rows();
    if($q>0){
        $data=array(
          'firebase_id'=>$gcm,
          'change_date'=>$today
        );
        $this->db->where('imei', $imei);
				$res = $this->db->update('tb_firebase_log', $data);


				$data=array(
					'firebase_id'=>$gcm,
					'imei'=>$imei
				);
				$this->db->where('imei', $imei);
				$res_ = $this->db->update('tb_user', $data);


				if($res){
						$data=array( 'status'=>"true",'message'=>'Berhasil update firebase '.$gcm);
				}else{
					$data=array( 'status'=>"false",'message'=>'Gagal update firebase');
				}



    }else{
        $data=array(
    			'imei'=>$imei,
    			'firebase_id'=>$gcm,
    			'is_member'=>"false",
    			'create_date'=>$today
    		);
    	$res = 	$this->db->insert('tb_firebase_log',$data);


				$data=array(
					'firebase_id'=>$gcm,
					'imei'=>$imei
				);
				$this->db->where('imei', $imei);
				$res_ = $this->db->update('tb_user', $data);



				if($res){
						$data=array( 'status'=>"true",'message'=>'Berhasil insert firebase '.$gcm);
				}else{
					$data=array( 'status'=>"false",'message'=>'Gagal insert firebase');
				}
    }

		return $data;


	}

	public function checkTokenLogin($username,$token){
		    $q = $this->db->query("select * from tb_user where username=BINARY '".$username."' and  token='".$token."' ");
				$data=array( 'status'=>false,'message'=>'Sesi token login Anda tidak cocok, Silakan login ulang kembali');
		    if($q->num_rows()>0){
					foreach($q->result() as $row)
					{
						if ($token==$row->token){
								$data=array( 'status'=>true,'message'=>'Token berlaku','token'=>$row->token,'id_user'=>$row->id_user);
						}
					}
		    }
		return $data;
	}

	public function checkTokenLoginByIdUser($id_user,$token){
				$q = $this->db->query("select * from tb_user where id_user='".$id_user."' and  token='".$token."' ");
				$data=array( 'status'=>false,'message'=>'Sesi token login Anda tidak cocok, Silakan login ulang kembali');
				if($q->num_rows()>0){
					foreach($q->result() as $row)
					{
						if ($token==$row->token){
								$data=array( 'status'=>true,'message'=>'Token berlaku','token'=>$row->token,'id_user'=>$id_user);
						}
					}
				}
		return $data;
	}




	public function getUserByIdUser($iduser){
		    $q = $this->db->query("select * from tb_user where id_user='".$iduser."' ")->row();
		return $q;
	}

	public function getUserByForumId($forumid){
		    $q = $this->db->query(" select * from tb_user where id_user in (select id_user from tb_forum where id_forum=".$forumid.")")->row();
	return $q;
	}

	public function getUserByComplaintId($complaintID){
		    $q = $this->db->query(" select * from tb_user where id_user in (select id_user from tb_complaint where id_complaint=".$complaintID.")")->row();
	return $q;
	}
	public function getUserByIdTps($id){
		    $q = $this->db->query(" select * from tb_user where id_user in (select id_petugas from tb_tps_petugas where id_tps=(select id_tps from tb_hasil_temp where id_hasil_temp=".$id."))")->row();
	return $q;
	}







	public function registrasiAkun($username, $pwd, $imei, $name, $phone,$firebase){

		    $today = date('Y-m-d H:i:s');
		    $q = $this->db->query("select * from tb_user where username=BINARY '".$username."' ");
		    if($q->num_rows()<=0){
					$data=array(
						'id_type_user'=>"3",
						'username'=>$username,
						'pwd'=>md5($pwd),
						'imei'=>$imei,
						'name'=>$name,
						'phone'=>$phone,
						'firebase_id'=>$firebase,
						'status_online'=>'N',
						'date_create'=>date('Y-m-d h:i:s')
					);
					$res = $this->db->insert('tb_user',$data);

					$id_user = $this->db->insert_id();

					$data_=array(
		    			'imei'=>$imei,
		    			'firebase_id'=>$firebase,
		    			'is_member'=>"true",
		    			'id_user'=>$id_user,
		    			'create_date'=>date('Y-m-d h:i:s')
		    		);
		    	$res_ = 	$this->db->insert('tb_firebase_log',$data_);




					if($res){
								$data=array( 'status'=>'true','message'=>'Terimakasih, Anda berhasil melakukan pendaftaran.');
					}else{
								$data=array( 'status'=>'false','message'=>'Mohon maaf, sistem sedang mengalami gangguan. Mohon mencoba beberapa saat lagi');
					}
		    }else{
									$data=array( 'status'=>'false','message'=>'Username Sudah terdaftar, Mohon gunakan username lain');
		    }


		return $data;
	}


	public function gantiPasswordAkun($pwd, $id){

						$data=array(
							'status_online'=>'N',
							'token'=>"",
							'pwd'=>md5($pwd),
							'date_change'=>date('Y-m-d H:i:s')
						);
						$this->db->where('id_user', $id);
					$res = 	$this->db->update('tb_user', $data);

						if($res){
		 						 $data=array( 'status'=>'true','message'=>'Proses ganti password berhasil, silakan login ulang menggunakan password baru Anda');
		 			 }else{
		 						 $data=array( 'status'=>'false','message'=>'Proses ganti password gagal, silakan coba beberapa saat lagi');
		 			 }

		return $data;
	}


		public function gantiHP($hp, $id){

							$data=array(
								'phone'=>$hp,
								'date_change'=>date('Y-m-d H:i:s')
							);
							$this->db->where('id_user', $id);
						$res = 	$this->db->update('tb_user', $data);

							if($res){
			 						 $data=array( 'status'=>'true','message'=>'Proses ganti No. Handphone berhasil');
			 			 }else{
			 						 $data=array( 'status'=>'false','message'=>'Proses ganti No. Handphone Gagal, silakan coba beberapa saat lagi');
			 			 }

			return $data;
		}


	public function checkUserIsExist($username,$phone){
				$q = $this->db->query("select * from tb_user where username=BINARY '".$username."' and  phone='".$phone."' ");
				$data=array( 'status'=>false,'message'=>'Data akun Anda tidak ditemukan. Pastikan USERNAME dan NO. HP Anda benar');
				if($q->num_rows()>0){

							$row = $q->row();
							$today = date('Y-m-d H:i:s');
							$token = $this->Model_mcrypt->encrypt($today."!".$row->id_user."!".rand(00000,99999));
							$data_token=array(
								'token'=>$token,
								'date_change'=>$today,
								'status_online'=>"Y"
							);
							$this->db->where('id_user', $row->id_user);
							$this->db->update('tb_user', $data_token);
							$data=array( 'status'=>true,'message'=>'user','id_user'=>$row->id_user,'token'=>$token);
				}
		return $data;
	}


	public function updateImei($username,$pwd){

		$q = $this->db->query("select * from tb_user where username=BINARY '".$username."' ");
		if($q->num_rows()>0){

			foreach($q->result() as $row)
			{
				// $pwdDbDecrypt=$this->Model_mcrypt->decrypt($row->pwd);
				if (md5($pwd)==$row->pwd){
							$data=array(
									'imei'=>"",
								);
								$this->db->where('id_user', $row->id_user);
							$res = 	$this->db->update('tb_user', $data);

							if($res){
										 $data=array( 'status'=>'true','message'=>'Proses Aktivasi Berhasil, Silakan Login Kembali');
							 }else{
										 $data=array( 'status'=>'true','message'=>'Proses Aktivasi Gagal, Silakan Coba Kembali');
							 }
				}else{
					$data=array( 'status'=>'true','message'=>'Password yang anda masukkan salah');
				}
			}
		}else{
			$data=array( 'status'=>'true','message'=>'Username yang anda masukkan salah');
		}


		return $data;
	}


	public function loginAkun($firebase,$username, $pwd,$imei,$tipeuser){

		    $today = date('Y-m-d H:i:s');
				if($tipeuser=="USER" || $tipeuser=="PETUGAS"){
					$q = $this->db->query("select * from tb_user where username=BINARY '".$username."' and id_type_user in (
								select id_type_user from tb_type_user where type_user='".$tipeuser."'
						)");
				}else{
					$q = $this->db->query("select * from tb_user where username=BINARY '".$username."' ");
				}

		    if($q->num_rows()>0){
					$isvalidimei="false";


					foreach($q->result() as $row)
					{


						if(strlen($row->imei)>3){
								if($imei!=$row->imei){
									$isvalidimei="false";
								}else{
									$isvalidimei="true";
								}
						}else{
								$isvalidimei="true";
								$q = $this->db->query("update tb_user set imei='".$imei."' where id_user=".$row->id_user);
						}

						// if($isvalidimei=="true"){

									if(strlen($firebase)>10){
											$q = $this->db->query("update tb_user set firebase_id='".$firebase."' where id_user=".$row->id_user);
									}
									$token = md5($today."!".$row->id_user."!".rand(00000,99999));

									// echo $pwd." ".$pwdDbDecrypt;
									if (md5($pwd)==$row->pwd){
											$res=$this->insertHistoryOnline($row->id_user,'ONLINE');

											$data_token=array(
												'token'=>$token,
												'imei'=>$imei,
												'date_change'=>$today,
												'status_online'=>"Y"
											);
											$this->db->where('id_user', $row->id_user);
											$this->db->update('tb_user', $data_token);

											$q = $this->db->query(" select *,'".$pwd."' as token_user,(select type_user from tb_type_user where id_type_user=a.id_type_user ) as type_user from tb_user a where username='".$username."' ");
											$data=array( 'id_user'=>$row->id_user,'token'=>$token,'data'=>$q->result());
									}else{
											$data=array( 'status'=>'false','message'=>'Username dan Password Anda Salah.2');
									}
						// }else{
						// 	$data=array( 'status'=>'false','message'=>'Kode IMEI Anda Tidak COCOK! Silakan melakukan aktivasi akun');
						// }



					}

		    }else{
							$data=array( 'status'=>'false','message'=>'Username atau Password Anda Salah.1');
		    }


		return $data;
	}



	public function insertHistoryOnline($id_user,$value){

				$data=array(
					'id_user'=>$id_user,
					'type'=>$value,
					'date'=>date('Y-m-d H:i:s')
				);
				$res = 	$this->db->insert('tb_history_online',$data);
				if($res){
							 $data=array( 'status'=>'true','message'=>'');
				 }else{
							 $data=array( 'status'=>'false','message'=>'');
				 }

		return $data;
	}
	public function insertLogLokasi($id_user,$latitude,$longitude){

				$data=array(
					'id_user'=>$id_user,
					'latitude'=>$latitude,
					'longitude'=>$longitude,
					'date'=>date('Y-m-d H:i:s')
				);
				$res = 	$this->db->insert('tb_log_location',$data);


				if($res){
							 $data=array( 'status'=>'true','message'=>'');
				 }else{
							 $data=array( 'status'=>'false','message'=>'');
				 }

		return $data;
	}

	public function updateStatusPetugas($id,$status){

						$data=array(
							'status_online'=>$status,
							'date_change'=>date('Y-m-d H:i:s')
						);
						$this->db->where('id_user', $id);
					  $res = 	$this->db->update('tb_user', $data);

						if($res){
									if($status='Y'){
											$res=$this->insertHistoryOnline($id,'ONLINE');
									}else{
											$res=$this->insertHistoryOnline($id,'OFFLINE');
									}
								 $data=array( 'status'=>'true','message'=>'Proses pembaharuan berhasil,Terimakasih','status_online'=>$status);
					 }else{
								 $data=array( 'status'=>'false','message'=>'Proses pembaharuan gagal, Silakan coba beberapa saat lagi','status_online'=>$status);
					 }

		return $data;
	}

	public function logoutAkun($id){

						$data=array(
							'token'=>"",
							'status_online'=>"N",
							'date_change'=>date('Y-m-d H:i:s')
						);
						$this->db->where('id_user', $id);
					  $res = 	$this->db->update('tb_user', $data);

						if($res){
									$res=$this->insertHistoryOnline($id,'OFFLINE');
								 $data=array( 'status'=>'true','message'=>'Proses logout berhasil,Terimakasih');
					 }else{
								 $data=array( 'status'=>'false','message'=>'Proses logout gagal, Silakan coba beberapa saat lagi');
					 }

		return $data;
	}

	public function uploadFotoProfile($id,$filename){

						$data=array(
							'foto'=>$filename,
							'date_change'=>date('Y-m-d H:i:s')
						);
						$this->db->where('id_user', $id);
					  $res = 	$this->db->update('tb_user', $data);
						if($res){
								 $data=array( 'status'=>'true','message'=>'Proses update foto berhasil,Terimakasih');
					 }else{
								 $data=array( 'status'=>'false','message'=>'Proses update foto gagal, Silakan coba beberapa saat lagi');
					 }

		return $data;
	}


	// PETUGAS
	public function dataResumePetugas($iduser){

		    $q = $this->db->query(" SELECT
							(select count(id_user) from tb_complaint where id_petugas=a.id_user) as jml_pelanggan,
							(select count(id_user) from tb_complaint where id_petugas=a.id_user) as jml_konsultasi,
							(select concat(CAST(ifnull(sum(value_rating)/count(id_complaint),0) AS SIGNED)) from tb_complaint where id_petugas=a.id_user) as jml_rating,
							ifnull((select count(id_tps_petugas) from tb_tps_petugas where id_petugas=a.id_user),'0') as jml_value
							FROM tb_user a where id_user=".$iduser);
		return $q->result();
	}

	public function getPetugasTerdekat($uuid){
		    $q = $this->db->query("
				SELECT * FROM (
								select
									id_user,
									ifnull((select latitude from tb_log_location where  a.id_user=id_user  and LENGTH(latitude)>0 order by id  desc limit 1 ),0) as latitude,
									ifnull((select longitude from tb_log_location where   a.id_user=id_user and LENGTH(longitude)>0 order by id desc limit 1),0) as longitude
								from
								tb_user a where id_type_user=2 AND status_online='Y'
						)xx where latitude!=0
						and id_user not in (
									select id_petugas from tb_complaint_request_online where uuid='".$uuid."'
							)
				");
				$result = $q->result_array();
		return $result;
	}

	public function insertLogReqCompOnline($data){
			$res = 	$this->db->insert('tb_complaint_request_online',$data);
		return $res;
	}




}
