<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_globalAndroid extends CI_Model {

	public function InsertAddLog($data,$function,$type,$lokasi_file='-',$id_user='0'){

		$data=array(
			'data'=>$data,
			'function'=>$function,
			'type'=>$type,
			'lokasi_file'=>$lokasi_file,
			'id_user'=>$id_user,
			'date'=>date('Y-m-d H:i:s')
		);

		$this->db->insert('tb_log_api',$data);
	}

	public function GetIP(){

        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }



    private function GetTime(){
        date_default_timezone_set('Asia/Makassar');
        $time=explode('+',date('c'));
        $time= $time[0].'.'.date('B').'+'.$time[1];
        return $time;
    }

    public function ChekWaktu(){
        date_default_timezone_set("Asia/Makassar");
          /* This sets the $time variable to the current hour in the 24 hour clock format */
        $time = date("H");
        /* Set the $timezone variable to become the current timezone */
        $timezone = date("e");
        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            return "Pagi";
        } else
        /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
        if ($time >= "12" && $time < "17") {
            return "Siang";
        } else
        /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
        if ($time >= "17" && $time < "19") {
            return "Sore";
        } else
        /* Finally, show good night if the time is greater than or equal to 1900 hours */
        if ($time >= "19") {
            return "Malam";
        }
    }


    public function tgl_str($date){
        $exp = explode('-',$date);
        if(count($exp) == 3) {
          $tgl_waktu=$exp[2];
          $exp_tgl_waktu=explode(' ',$tgl_waktu);
          $tgl=$exp_tgl_waktu[0];
          $bln=$exp[1];
          $thn=$exp[0];
          $date = $tgl.'-'.$bln.'-'.$thn;
        }
        return $date;
    }


		public function get_sampledata(){

			// $query = $this->db->get('tb_log_api', 100);
			$query = $this->db->get_where('tb_log_api', array('id',100));
			return $query->result();
    }

		public function getRecentNews(){
				$q = $this->db->query("SELECT  *,
					(select concat(CAST(ifnull(sum(value_rating)/count(id_rating),0) AS SIGNED),'/5')    from tb_news_rating where a.id_news=id_news) as jml_rating,
					(select count(id_comment) from tb_news_comment where a.id_news=id_news) as jml_comment
					 FROM tb_news a where status='Y' order by create_date desc limit 3" );
				return $q;
		}

		public function getAllNews($islimit){

			$addquery="";
			if($islimit=="true"){
				$addquery = "limit 3";
			}
				$q = $this->db->query("SELECT
					*,
					(select  concat(CAST(ifnull(sum(value_rating)/count(id_rating),0) AS SIGNED),'/5')  from tb_news_rating where a.id_news=id_news) as jml_rating,
					(select count(id_comment) from tb_news_comment where a.id_news=id_news) as jml_comment

					 FROM tb_news a where status='Y' order by create_date desc ".$addquery );
				return $q;
		}

		public function loadHimbauan($id_user){

				$q = $this->db->query("SELECT
					*,
					(select count(id_announcement) from tb_announcement_like b where a.id=b.id_announcement) as jml_like,
					(select count(id_announcement) from tb_announcement_like b,tb_user y where b.id_user=y.id_user and  a.id=b.id_announcement and b.id_user=".$id_user.") as islike

					 FROM tb_announcement a where status='Y' order by date desc");
				return $q;
		}
		public function managLikeHimbauan($id_user,$id_himbauan,$jenis_like){

					if($jenis_like=="1"){
						$q = $this->db->delete('tb_announcement_like', array('id_announcement' => $id_himbauan,'id_user' => $id_user));
						// $q = $this->db->delete('tb_announcement_like', array('id' => $id_himbauan));
					}else{
							$q = $this->db->delete('tb_announcement_like', array('id_announcement' => $id_himbauan,'id_user' => $id_user));

							$data=array(
								'id_announcement'=>$id_himbauan,
								'id_user'=>$id_user,
								'date'=>date('Y-m-d H:i:s')
							);
							$q = $this->db->insert('tb_announcement_like',$data);
					}

				return $q;
		}



		public function getDataSetting($kat,$sub_kat){
				$q = $this->db->query("SELECT  * FROM tb_setting where kategori='$kat' and sub_kat='$sub_kat'" );
				return $q;
		}
		public function getDataSettingByKat($kat){
				$q = $this->db->query("SELECT  * FROM tb_setting where kategori='$kat' " );
				return $q->row();
		}

		public function getDataSettingAll(){
				$q = $this->db->query("SELECT  * FROM tb_setting");
				return $q;
		}

		public function getDataLokasiKantor(){
				$q = $this->db->query("SELECT  * FROM tb_lokasi_kantor where status='Y'");
				return $q->result();
		}

		public function getDistinctKategori(){
				$q = $this->db->query("SELECT  distinct(kategori) as kategori FROM tb_setting ");
				return $q->result();
		}

		public function getDataCompany(){
				$q = $this->db->query("SELECT  *  FROM tb_company ");
				return $q;
		}

		public function insertComment($id,$iduser,$msg,$valrating){

					$data=array(
						'id_news'=>$id,
						'id_user'=>$iduser,
						'comment'=>$msg,
						'date'=>date('Y-m-d H:i:s')
					);
					$this->db->insert('tb_news_comment',$data);


					$data=array(
						'id_news'=>$id,
						'id_user'=>$iduser,
						'value_rating'=>$valrating,
						'date'=>date('Y-m-d H:i:s')
					);
					$value = $this->db->insert('tb_news_rating',$data);

					if($value){
						return true;
					}else{
						return false;
					}

		}


		public function sendPushNotificationBroadcast($mode,$firebase_id,$title,$msg,$url_img,$url_web) {
				$data= "1";
				 if($data=="1"){
					 $data=array( 'status'=>'true','message'=>'Notif Berhasil Dikirim');
				 }else{
					 $data=array( 'status'=>'false','message'=>'Notif Gagal Dikirim');
				 }
					$data= json_encode($data);

			 	///$response = $this->ReturnReponse($data);
			 return $data;
		}


		public function getallUserFirebase($param="UMUM") {

			$addquery="";
			if($param!="UMUM"){
				$addquery=" and type_user like '%".$param."%' ";
			}

			$q = $this->db->query(" SELECT  firebase_id
				FROM tb_user a, tb_type_user b
				where
				a.id_type_user = b.id_type_user and
				firebase_id!=''
				and firebase_id is not null
				and LENGTH(firebase_id)>10
				".$addquery);

			$tokens = array();
			$data = json_encode($q->result());
			$result = json_decode($data, true);
				for ($i = 0; $i < count($q->result()); $i++) {
					array_push($tokens, $result[$i]['firebase_id']);

				}

			return $tokens;
		}

		public function getallUserFirebaseBackup() {
			$q = $this->db->query(" SELECT  firebase_id FROM tb_user
				 	where firebase_id!='' and firebase_id is not null
					and LENGTH(firebase_id)>10 ");

			$tokens = array();
			$data = json_encode($q->result());
			$result = json_decode($data, true);
				for ($i = 0; $i < count($q->result()); $i++) {
					array_push($tokens, $result[$i]['firebase_id']);

				}

			return $tokens;
		}

		public function AksiTambahBerita($judul,$desc,$link_gmbr,$link_web,$status){
			$value=array(
				'title' => $judul,
				'desc' => $desc,
				'date_publish' => date('Y-m-d H:i:s'),
				'url_website' => $link_web,
				'url_img_header' => $link_gmbr,
				'status' => $status,
				'create_date' => date('Y-m-d H:i:s')
			);
			$q=$this->db->insert('tb_news',$value);
			return $q;
		}


		public function sendPushNotification($mode,$firebase_id,$title,$msg,$url_img,$url_web,$data_pesan="0") {


			if($mode=="BROADCAST"){
					$arrayfirebase_id =  $this->getallUserFirebase();
					$mode="INBOX";
					$fields = array(
							 'registration_ids' => $arrayfirebase_id,
							 'data' => $this->getPush($mode,$title,$msg,$url_img,$url_web)
					 );
			}else{
				// $fields = array(
				// 		 'to' => $firebase_id,
				// 		 'data' => $this->getPush($mode,$title,$msg,$url_img,$url_web,$data_pesan)
				//  );


				 $fields = array(
						'message' => array(
							'topic'=>'chat',
							'notification'=>array(
								'title'=>$title,
								'body'=>$data_pesan['message_pengaduan'],
							),
							'data'=>array(
								'story_id'=>$this->getPush($mode,$title,$msg,$url_img,$url_web,$data_pesan)
							)
						),
						'data' => $this->getPush($mode,$title,$msg,$url_img,$url_web,$data_pesan)
				);
				
			}



				// Set POST variables
				$url = config_item('FIREBASE_URL');
				$headers = array(
						'Authorization: Bearer '.config_item('FIREBASE_API_KEY'),
						'Content-Type: application/json'
				);
				// Open connection
				$ch = curl_init();
				// Set the url, number of POST vars, POST data
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				// Disabling SSL Certificate support temporarly
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
				// Execute post
				$result = curl_exec($ch);
				if ($result === FALSE) {
						die('Curl failed: ' . curl_error($ch));
				}
				// Close connection
				curl_close($ch);

				$data=array(
					'firebase_id'=>$firebase_id,
					'pesan'=>json_encode($fields),
					'tipe'=>$mode,
					'respon_firebase'=>$result,
					'create_date'=>date('Y-m-d H:i:s')
				);
				$this->db->insert('tb_log_pesan_firebase',$data);

				return $result;
		}

		public function getPush($mode,$title,$msg,$url_img,$url_web,$data_pesan="0") {
				$payload = array();
				$payload['team'] = 'Indonesia';
				$payload['score'] = '5.6';

				$res = array();
				if($data_pesan!="0"){
					if($mode=="CHAT"){
						$res['data']['id_complaint'] = $data_pesan['id_complaint'];
						$res['data']['id_user'] = $data_pesan['id_user'];
						$res['data']['id_petugas'] = $data_pesan['id_petugas'];
						$res['data']['image'] = "";

					}else if($mode=="REQ_PENGADUAN"){
						$res['data']['id_user'] = $data_pesan['id_user'];
						$res['data']['nama_user'] = $data_pesan['name'];
						$res['data']['image'] = $data_pesan['foto'];
						$res['data']['title_pengaduan'] = $data_pesan['title_pengaduan'];
						$res['data']['message_pengaduan'] = $data_pesan['message_pengaduan'];
						$res['data']['tgl_pengaduan'] = $data_pesan['tgl_pengaduan'];
						$res['data']['uuid_request'] = $data_pesan['uuid_request'];
						$res['data']['last_id_request'] = $data_pesan['last_id_request'];

					}else if($mode=="REQ_PENGADUAN_APPROVE"){
						$res['data']['id_complaint'] = $data_pesan['id_complaint'];
						$res['data']['id_user'] = $data_pesan['id_user'];
						$res['data']['id_petugas'] = $data_pesan['id_petugas'];
						$res['data']['image'] = "";
					}

				}else{
					$res['data']['image'] = $url_img;
				}



				$res['data']['mode'] = $mode;
				$res['data']['title'] = $title;
				$res['data']['is_background'] = "true";
				$res['data']['message'] = $msg;
				$res['data']['payload'] = $payload;
				$res['data']['url_web'] = $url_web;
				$res['data']['timestamp'] = date('Y-m-d G:i:s');
				return $res;
		}



			function generateRandomString($length = 3) {
					//$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < $length; $i++) {
							$randomString .= $characters[rand(0, $charactersLength - 1)];
					}
					return $randomString;
			}


			function generateRandomString2($length = 32) {
					$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < $length; $i++) {
							$randomString .= $characters[rand(0, $charactersLength - 1)];
					}
					return $randomString;
			}


			public function getPhotoNameFromLogPhoto($uuid){
				    $q = $this->db->query("select * from tb_log_foto where uuid='".$uuid."' ");
				return $q;
			}


			public function update($id,$name){
				$data=array(
					'name'=>$name,
					'date'=>date('Y-m-d h:i:s')
				);
				$this->db->where('id', $id);
				$res = 	$this->db->update('tb_log_foto', $data);

				return $res;

			}
			public function addLogFoto($uuid,$name){
				$data=array(
					'uuid'=>$uuid,
					'name'=>$name,
					'date'=>date('Y-m-d h:i:s')
				);
				$res = 	$this->db->insert('tb_log_foto',$data);

				return $res;

			}





			function getJarakKordinat($latitudeUser, $longitudeUser, $latitudeOutlet, $longitudeOutlet)
				{
					//-8.669104531289598 | 115.16402360146117 | -8.595456 | 115.2748058
					//-8.669104531289598 | 115.16402360146117 | -8.595456 | 115.2748058
					$latitudeUser=(float)$latitudeUser;
					$longitudeUser=(float)$longitudeUser;
					$latitudeOutlet=(float)$latitudeOutlet;
					$longitudeOutlet=(float)$longitudeOutlet;

					$theta = $longitudeUser - $longitudeOutlet;
					$distance = (sin(deg2rad($latitudeUser)) * sin(deg2rad($latitudeOutlet)))  + (cos(deg2rad($latitudeUser)) * cos(deg2rad($latitudeOutlet)) * cos(deg2rad($theta)));
					$distance = acos($distance);
					$distance = rad2deg($distance);
					$distance = $distance * 60 * 1.1515;
					$distance = $distance * 1.609344;

					//echo $distance;

					return (round($distance,2));
				}

				function distance($lat1, $lon1, $lat2, $lon2, $unit) {

				  $theta = $lon1 - $lon2;
				  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
				  $dist = acos($dist);
				  $dist = rad2deg($dist);
				  $miles = $dist * 60 * 1.1515;
				  $unit = strtoupper($unit);

					  if ($unit == "K") {
					    return ($miles * 1.609344);
					  } else if ($unit == "N") {
				      return ($miles * 0.8684);
				    } else {
				        return $miles;
				    }

					// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
					// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";
					// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";

			}






}
