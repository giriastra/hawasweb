<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GlobalCon extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Makassar");
		$this->events='';
		$this->load->model('Model_globalAndroid');
		$this->load->model('Model_user');
		$this->load->model('model_crud');
	}


	public function index(){
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
				echo "You do not have authorization.";
				header('HTTP/1.1 400 Only POST method allowed');
				exit;
		}

		$body = file_get_contents('php://input');
		$this->events 	= json_decode($body);
		$this->Model_globalAndroid->InsertAddLog($body,$this->events->Func,"IN","GlobalCon",@$this->events->id_user);


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
			// $this->Model_globalAndroid->InsertAddLog($msg,@$this->events->Func,$type);
	}

	public function insertFirebaseID(){

		$this->Model_globalAndroid->InsertAddLog("imei:".$this->input->post('kode_imei')."#GCM:".$this->input->post('gcm_code'),"insertFirebaseID","IN");
		$Data = $this->Model_user->insertFirebaseID($this->input->post('kode_imei'),$this->input->post('gcm_code'));

			$Data=json_encode($Data);
			$this->ReturnReponse($Data);
	}


	public function inputBerita(){

			$judul=$this->events->judul;
			$desc=$this->events->desc;
			$link_gmbr=$this->events->link_gmbr;
			$link_web=$this->events->link_web;
			$status="Y";
			$respon = $this->Model_globalAndroid->AksiTambahBerita($judul,$desc,$link_gmbr,$link_web,$status);

			if($this->events->mode=="live"){
					if($respon){
						 $data=array( 'status'=>'true','message'=>'Input Berita Berhasil');
						 $mdGlobal 		= $this->Model_globalAndroid->sendPushNotification("BROADCAST","",$judul,$desc,$link_gmbr,$link_web);
					}else{
						 $data=array( 'status'=>'false','message'=>'Input Berita Gagal');
					}
			}else{
				$data=array( 'status'=>'true','message'=>'Input Berita Berhasil Dengan Mode TEST!');
			}
			$Data=json_encode($data);
			$this->ReturnReponse($Data);
	}

	public function loadDataSplashScreen(){

		$news = $this->Model_globalAndroid->getRecentNews();
		$lokasiKantor = $this->Model_globalAndroid->getDataLokasiKantor();
		$setting = $this->Model_globalAndroid->getDataSettingAll()->result();
		$setting_kat = $this->Model_globalAndroid->getDistinctKategori();
		$data_company = $this->Model_globalAndroid->getDataCompany()->result();

		if($news->num_rows()>0){
			$news = $news->result();
			$news=array( 'status'=>'true','message'=>'-','data'=>$news);
		}else{
			$news=array('news'=>array( 'status'=>'false','message'=>'Belum ada berita'));
		}
		$setting=array( 'status'=>'true','message'=>'','data'=>$setting);
		$lokasiKantor=array( 'status'=>'true','message'=>'','data'=>$lokasiKantor);
		$setting_kat=array( 'status'=>'true','message'=>'','data'=>$setting_kat);
		$data_company=array( 'status'=>'true','message'=>'','data'=>$data_company);

		$Data=array(
			'status'=>'true',
			'message'=>'',
			'news'=>$news,
			'distinct_kategori'=>$setting_kat,
			'setting'=>$setting,
			'lokasi_kantor'=>$lokasiKantor,
			'data_company'=>$data_company,
		);
		$Data=json_encode($Data);
		$this->ReturnReponse($Data);
	}
	public function loadDataSplashScreenPetugas(){

		// $news = $this->Model_globalAndroid->getRecentNews();
		// $lokasiKantor = $this->Model_globalAndroid->getDataLokasiKantor();
		$setting = $this->Model_globalAndroid->getDataSettingAll()->result();
		$setting_kat = $this->Model_globalAndroid->getDistinctKategori();
		$data_company = $this->Model_globalAndroid->getDataCompany()->result();

		if($news->num_rows()>0){
			$news = $news->result();
			$news=array( 'status'=>'true','message'=>'-','data'=>$news);
		}else{
			$news=array('news'=>array( 'status'=>'false','message'=>'Belum ada berita'));
		}
		$setting=array( 'status'=>'true','message'=>'','data'=>$setting);
		$lokasiKantor=array( 'status'=>'true','message'=>'','data'=>$lokasiKantor);
		$setting_kat=array( 'status'=>'true','message'=>'','data'=>$setting_kat);
		$data_company=array( 'status'=>'true','message'=>'','data'=>$data_company);

		$Data=array(
			'status'=>'true',
			'message'=>'',
			'news'=>$news,
			'distinct_kategori'=>$setting_kat,
			'setting'=>$setting,
			'lokasi_kantor'=>$lokasiKantor,
			'data_company'=>$data_company,
		);
		$Data=json_encode($Data);
		$this->ReturnReponse($Data);
	}


	public function loadNews(){
			$islimit = $this->input->get('limit');
			$news = $this->Model_globalAndroid->getAllNews($islimit);
			if($news->num_rows()>0){
				$news = $news->result();
				$news=array( 'status'=>'true','message'=>'-','data'=>$news);
			}else{
				$news=array('news'=>array( 'status'=>'false','message'=>'Belum ada berita'));
			}

			$Data=json_encode($news);
			$this->ReturnReponse($Data);
	}

	public function loadHimbauan(){
			$data = $this->Model_globalAndroid->loadHimbauan($this->events->id_user);
			if($data->num_rows()>0){
				$data = $data->result();
				$data=array( 'status'=>'true','message'=>'-','data'=>$data);
			}else{
				$data=array('news'=>array( 'status'=>'false','message'=>'Belum ada himbauan'));
			}

			$Data=json_encode($data);
			$this->ReturnReponse($Data);
	}

	public function managLikeHimbauan(){
			$result = $this->Model_user->checkTokenLogin($this->events->username,$this->events->token);
			if($result['status']==true){

				$jenis_like = $this->events->jenis_like;
					$data = $this->Model_globalAndroid->managLikeHimbauan($result['id_user'],$this->events->id_himbauan,$this->events->jenis_like);
					if($data){
							if($jenis_like!="0"){
									$data=array( 'status'=>'true','message'=>'Data berhasil disimpan, Terimakasih');
							}else{
									$data=array( 'status'=>'true','message'=>'Like Anda berhasil disimpan, Terimakasih');
							}

					}else{
							$data=array( 'status'=>'false','message'=>'Pemberian like gagal, coba berapa saat lagi');
					}

			}else{
				$data=$result;
			}

			$Data=json_encode($data);
			$this->ReturnReponse($Data);
	}


  public function getDataCompany(){
			$data = $this->Model_globalAndroid->getDataCompany();
			if($data->num_rows()>0){
				$data = $data->result();
				$data=array( 'status'=>'true','message'=>'-','data'=>$data);
			}else{
				$data=array('news'=>array( 'status'=>'false','message'=>'Belum ada berita'));
			}

			$Data=json_encode($data);
			$this->ReturnReponse($Data);
	}


	//FIREBASE API NOTIFICATION
		public function getPush($mode,$title,$msg,$url_img,$url_web) {
				$payload = array();
				$payload['team'] = 'Indonesia';
				$payload['score'] = '5.6';

				$res = array();
				$res['data']['mode'] = $mode;
				$res['data']['title'] = $title;
				$res['data']['is_background'] = "true";
				$res['data']['message'] = $msg;
				$res['data']['image'] = $url_img;
				$res['data']['payload'] = $payload;
				$res['data']['url_web'] = $url_web;
				$res['data']['timestamp'] = date('Y-m-d G:i:s');
				return $res;
		}

		public function sendNotifFirebaseLocal($mode,$id_user,$title,$msg,$url_img,$url_web) {

			$data = $this->Model_user->getUserByIdUser($id_user);
			$firebase_id=$data->firebase_id;

				$fields = array(
						'to' => $firebase_id,
						'data' => $this->getPush($mode,$title,$msg,$url_img,$url_web)
				);
				// echo json_encode($fields);
				$data = $this->sendPushNotification($fields);
				$response = $this->ReturnReponse($data);
				return $response;
		}


	// sending push message to single user by firebase reg id
	public function sendNotifFirebase() {

		if($this->events->mode=="id_user"){
				$data = $this->Model_user->getUserByIdUser($this->events->id_user);
				$firebase_id=$data->firebase_id;
		}else{
				$firebase_id=$this->events->firebase_id;
		}
			$fields = array(
					'to' => $firebase_id,
					'data' => $this->getPush("INBOX",$this->events->title,$this->events->msg,$this->events->url_img,$this->events->url_web)
			);
			// echo json_encode($fields);
			$data = $this->sendPushNotification($fields);
			$response = $this->ReturnReponse($data);
			return $response;
	}

	public function sendNotifFirebaseBroadcastAllDevice() {

			if(@$this->events->jenis_broadcast){
				$arrayFirebase = $this->Model_globalAndroid->getallUserFirebase(@$this->events->jenis_broadcast);
			}else{
				$arrayFirebase = $this->Model_globalAndroid->getallUserFirebase("UMUM");
			}

			$fields = array(
					'registration_ids' => $arrayFirebase,
					'data' => $this->getPush("INBOX",$this->events->title,$this->events->msg,$this->events->url_img,$this->events->url_web)
			);

			if(@$this->events->mode=="live"){
					$data = $this->sendPushNotification($fields);
					$data= json_decode($data);
					if($data->success=="1"){
						$data=array( 'status'=>'true','message'=>'Notif Berhasil Dikirim');
					}else{
						$data=array( 'status'=>'false','message'=>'Notif Gagal Dikirim');
					}

			}else{
				$data=array( 'status'=>'true','message'=>'Notif DEMO Berhasil Dikirim');
			}

			$data= json_encode($data);


				 $response = $this->ReturnReponse($data);
			return $response;
	}


	public function sendNotifFirebaseBroadcast() {


		 $firebase_id=$this->events->firebase_id;
			$fields = array(
					'to' => $firebase_id,
					'data' => $this->getPush("INBOX",$this->events->title,$this->events->msg,$this->events->url_img,$this->events->url_web)
			);

				$data_ = $this->sendPushNotification($fields);


				 // $data = '{"multicast_id":9020667533318178214,"success":1,"failure":0,"canonical_ids":0,"results":[{"message_id":"0:1583025767942039%52fcb14bf9fd7ecd"}]}';
			 	$data= json_decode($data_);


				if($data->success=="1"){
					$data=array( 'status'=>'true','message'=>'Notif Berhasil Dikirim');
				}else{
					$data=array( 'status'=>'false','message'=>'Notif Gagal Dikirim','res'=>$data);
				}
				 $data= json_encode($data);

			$response = $this->ReturnReponse($data);
			return $response;
	}


	// Sending message to a topic by topic name
	public function sendToTopic($to, $title,$msg,$url_img) {
			$fields = array(
					'to' => '/topics/' . $to,
					'data' => $this->getPush($this->events->title,$this->events->msg,$this->events->url_img,$this->events->url_web)
			);
			return $this->sendPushNotification($fields);
	}

	// sending push message to multiple users by firebase registration ids
	public function sendMultiple($registration_ids, $title,$msg,$url_img) {
			$fields = array(
					'to' => $registration_ids,
					'data' => $this->getPush($this->events->title,$this->events->msg,$this->events->url_img,$this->events->url_web)
			);

			return $this->sendPushNotification($fields);
	}


	// function makes curl request to firebase servers
	private function sendPushNotification($fields) {
			// Set POST variables
			$url = config_item('FIREBASE_URL');
			$headers = array(
					'Authorization: key='.config_item('FIREBASE_API_KEY'),
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
			return $result;
	}









}
