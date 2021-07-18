<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Makassar");
		$this->events='';
		$this->load->model('Model_globalAndroid');
		$this->load->model('Model_user');
		$this->load->model('Model_forum');
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
			$this->Model_globalAndroid->InsertAddLog($body,$this->events->Func,"IN","user/Forum",@$this->events->id_user);


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
			$this->Model_globalAndroid->InsertAddLog($msg,@$this->events->Func,$type,"user/Forum");
	}


	public function getDataForumByIdPetugas(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){

				$result_forum = $this->Model_forum->getForumByIdPetugas($this->events->id_user);

				if($result_forum->num_rows()>0){
					$result_forum_detail = $this->Model_forum->getDataForumDetailByIdForum($result_forum->row()->id_forum);
					$Data=array('status'=>'true','message'=>'Ada Data','forum'=>$result_forum->result(),'forum_detail'=>$result_forum_detail->result());
				}else{
					$Data=array('status'=>'false','message'=>'Belum ada data forum');
				}
		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}

	public function getDataForumByIdUser(){
		$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
		if($result_token['status']==true){

				$result_forum = $this->Model_forum->getForumByIdUser($this->events->id_user);

				if($result_forum->num_rows()>0){

							$data_=array();
							foreach($result_forum->result() as $rows)
							{
									$result_forum_detail[$rows->id_forum] = $this->Model_forum->getDataForumDetailByIdForum($rows->id_forum);
									$data_[$rows->id_forum] = $result_forum_detail[$rows->id_forum]->result();
							}

							$data_detail_forum=array( 'status'=>'true','message'=>'','data'=>$data_);
							$Data=array('status'=>'true','message'=>'Ada Data','forum'=>$result_forum->result(),'forum_detail'=>$data_detail_forum);
				}else{
					$Data=array('status'=>'false','message'=>'Belum ada data forum');
				}
		}else{
			 $Data=$result_token;
		}

		$this->ReturnReponse(json_encode($Data));

	}



public function addNewForum(){

	$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
	if($result_token['status']==true){
			$data_forum=array(
				'title'=>$this->events->title,
				'id_petugas'=>$this->events->id_petugas,
				'id_user'=>$this->events->id_user,
				'date_create'=>date('Y-m-d H:i:s'),
				'status'=>'OPEN'
			);
			$last_id = $this->Model_forum->addNewForum($data_forum);

			$data_forum_detail=array(
				'id_forum'=>$last_id,
				'id_petugas'=>$this->events->id_petugas,
				'id_user'=>$this->events->id_user,
				'message'=>$this->events->message,
				'unique_id'=>$this->events->uuid,
				'date'=>date('Y-m-d H:i:s')
			);
			$Data = $this->Model_forum->addNewForumDetail($data_forum_detail);

			if($Data['status']==true){


						$result_forum = $this->Model_forum->getForumByIdUser($this->events->id_user);
						if($result_forum->num_rows()>0){

									$data_=array();
									foreach($result_forum->result() as $rows)
									{
											$result_forum_detail[$rows->id_forum] = $this->Model_forum->getDataForumDetailByIdForum($rows->id_forum);
											$data_[$rows->id_forum] = $result_forum_detail[$rows->id_forum]->result();
									}

									$data_detail_forum=array( 'status'=>'true','message'=>'','data'=>$data_);
									$Data=array('status'=>'true','message'=>'Ada Data','forum'=>$result_forum->result(),'forum_detail'=>$data_detail_forum);
						}else{
							$Data=array('status'=>'false','message'=>'Belum ada data forum');
						}
			}

	}else{
		$Data=$result_token;
	}

	$this->ReturnReponse(json_encode($Data));

}

public function addNewForumDetail(){

	$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
	if($result_token['status']==true){

			$data_forum_detail=array(
				'id_forum'=>$this->events->id_forum,
				'id_petugas'=>"0",
				'id_user'=>$this->events->id_user,
				'message'=>$this->events->message,
				'unique_id'=>$this->events->unique_id,
				'date'=>date('Y-m-d H:i:s')
			);
			$Data = $this->Model_forum->addNewForumDetail($data_forum_detail);

			if($Data['status']=="true"){

					// $data = $this->Model_user->getUserByIdUser($this->events->id_petugas);
					// $firebase_id=$data->firebase_id;
					// $mdGlobal = $this->Model_globalAndroid->sendPushNotification("CHAT",$firebase_id,"Pesan Baru",$this->events->message,"","");

					$data_=array();
					$result_forum_detail[$this->events->id_forum] = $this->Model_forum->getDataForumDetailByIdForum($this->events->id_forum);
					$data_[$this->events->id_forum] = $result_forum_detail[$this->events->id_forum]->result();

					$data_detail_forum=array( 'status'=>'true','message'=>'','data'=>$data_);
					$Data=array('status'=>'true','message'=>'Data berhasil dikirim','forum_detail'=>$data_detail_forum);


			}

	}else{
		$Data=$result_token;
	}
	$this->ReturnReponse(json_encode($Data));
}


public function updateForum(){

	$result_token = $this->Model_user->checkTokenLoginByIdUser($this->events->id_user,$this->events->token);
	if($result_token['status']==true){
			if($this->events->status=="OPEN"){
					$STATUS = "APPROVED";
			}else if($this->events->status=="APPROVED"){
					$STATUS = "CLOSE";
			}else if($this->events->status=="CANCEL"){
					$STATUS = "CANCEL";
			}else if($this->events->status=="REJECTED"){
					$STATUS = "REJECTED";
			}
			$Data = $this->Model_forum->updateStatusForum($this->events->id_forum,$STATUS);
	}else{
		$Data=$result_token;
	}

	$this->ReturnReponse(json_encode($Data));
}








}
