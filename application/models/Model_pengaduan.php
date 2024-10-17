<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_pengaduan extends CI_Model {

	public function getPengaduanByIdUser($id_user){
			$q = $this->db->query(" SELECT
          	`id_complaint`, `code`, `id_petugas`, `id_user`,
						(select name from tb_user y where y.id_user =x.id_user) as nama_user,
          	date_format(date_request,'%d-%m-%Y %H:%i')  as `date_request`,
          	ifnull(date_format(date_confirm,'%d-%m-%Y %H:%i'),'')  as `date_confirm`,
          	ifnull(date_format(date_finish,'%d-%m-%Y %H:%i'),'')  as `date_finish`,
          	`title`, `status`,
          	ifnull(`value_rating`,'0') as `value_rating`, ifnull(`message_rating`,'') as `message_rating`,
          	ifnull( (SELECT message from tb_complaint_detail a where a.id_complaint=x.id_complaint order by id_complaint_detail desc limit 1),'-') as message,
          	ifnull( (SELECT name from tb_user a where a.id_user=x.id_petugas ),'-') as nama_petugas
          from tb_complaint x WHERE id_user=".$id_user." order by id_complaint desc ");
			return $q;
	}

	public function getPengaduanByIdPetugas($id_petugas,$status,$limit='5'){
			$q = $this->db->query(" SELECT
          	`id_complaint`, `code`, `id_petugas`, `id_user`,
						(select name from tb_user y where y.id_user =x.id_user) as nama_user,
          	date_format(date_request,'%d-%m-%Y %H:%i')  as `date_request`,
          	ifnull(date_format(date_confirm,'%d-%m-%Y %H:%i'),'')  as `date_confirm`,
          	ifnull(date_format(date_finish,'%d-%m-%Y %H:%i'),'')  as `date_finish`,
          	`title`, `status`,
          	ifnull(`value_rating`,'0') as `value_rating`, ifnull(`message_rating`,'') as `message_rating`,
          	ifnull( (SELECT message from tb_complaint_detail a where a.id_complaint=x.id_complaint order by id_complaint_detail desc limit 1),'-') as message,
          	ifnull( (SELECT name from tb_user a where a.id_user=x.id_petugas ),'-') as nama_petugas
          from tb_complaint x WHERE id_petugas=".$id_petugas." and status in (".$status.") order by id_complaint desc limit ".$limit);
			return $q;
	}

	public function getPengaduanById($id){
			$q = $this->db->query(" SELECT
          	`id_complaint`, `code`, `id_petugas`, `id_user`,
						(select name from tb_user y where y.id_user =x.id_user) as nama_user,
          	date_format(date_request,'%d-%m-%Y %H:%i')  as `date_request`,
          	ifnull(date_format(date_confirm,'%d-%m-%Y %H:%i'),'')  as `date_confirm`,
          	ifnull(date_format(date_finish,'%d-%m-%Y %H:%i'),'')  as `date_finish`,
          	`title`, `status`,
          	ifnull( (SELECT name from tb_user a where a.id_user=x.id_petugas ),'-') as nama_petugas
          from tb_complaint x WHERE id_complaint=".$id);
			return $q->row();
	}

	public function getForumByIdPetugas($id_user){
			$q = $this->db->query("select * from  tb_forum where id_petugas=".$id_user);
			return $q;
	}


	public function getDataPengaduanDetailByIdComplaint($id_forum){
			$q = $this->db->query("select *,
								ifnull((select name from tb_user a where a.id_user=b.id_user ),'') as nama_user,
								ifnull((select name from tb_user a where a.id_user=b.id_petugas ),'') as nama_petugas
								from  tb_complaint_detail b where id_complaint=".$id_forum);
			return $q;
	}

	public function getDataPengaduanByIdComplaint($id){
			$q = $this->db->query("select * from  tb_complaint  where id_complaint=".$id)->row();
			return $q;
	}

	public function addNewRequestPengaduan($data_forum){
			$res = $this->db->insert('tb_complaint',$data_forum);
			return $this->db->insert_id();
	}

	public function addNewPengaduanDetail($data_forum){
			$res = $this->db->insert('tb_complaint_detail',$data_forum);

			if($res){
					$data=array( 'status'=>"true",'message'=>'Berhasil dikirim');
			}else{
					$data=array( 'status'=>"false",'message'=>'Gagal dikirim');
			}
			return $data;

	}


	public function getTrackingStatus($id_complaint){
			$q = $this->db->query("select * from  tb_complaint_track_status  where id_complaint=".$id_complaint);
			return $q;
	}

	public function addTrackStatus($id_complaint){
		$q = $this->db->query("
				INSERT into tb_complaint_track_status(id_complaint,keterangan,ischeked)
				select ".$id_complaint.",value,'N' from tb_setting WHERE  kategori='TRACE_STATUS' ");
		return $q;

	}
	public function updateTrackStatus($id,$user,$status){

			$data=array(
				'ischeked'=>$status,
				'change_date'=>date('Y-m-d h:i:s'),
				'change_who'=>$user,
			);
			$this->db->where('id', $id);
			$q = $this->db->update('tb_complaint_track_status',$data);
			if($q){
				echo 'sukses';
			}else{
				echo 'gagal';
			}

	}



	public function updateStatusPengaduan($id_forum,$status,$valrating="0",$message=""){

			if($status=="CLOSE" || $status=="CANCEL" || $status=="REJECTED"){

				$data_forum=array( 'status'=>$status,'date_finish'=>date('Y-m-d H:i:s'),'value_rating'=>$valrating,'message_rating'=>$message );
			}else if($status=="ADD_RATING"){
					$data_forum=array('value_rating'=>$valrating,'message_rating'=>$message );
			}else{
				$data_forum=array( 'status'=>$status);
			}

			$this->db->where('id_complaint', $id_forum);
			$res = $this->db->update('tb_complaint', $data_forum);

			if($res){
					$data=array( 'status'=>"true",'message'=>'Berhasil dikirim','status_pengaduan'=>$status);
			}else{
					$data=array( 'status'=>"false",'message'=>'Gagal dikirim');
			}
			return $data;
	}


	public function getAllPetugasOnline(){
			$q = $this->db->query("  SELECT XX.* FROM (
				SELECT
					id_user,name,phone,status_online,firebase_id,ifnull(foto,'no_avatar.png') as foto,
					ifnull((SELECT latitude from tb_log_location where id_user =a.id_user   and  latitude!='0' order by id desc limit 1),0) as latitude,
					ifnull( (SELECT longitude from tb_log_location where id_user =a.id_user  and  longitude!='0' order by id desc limit 1 ),0) as longitude
					from tb_user a where status_online='Y' AND id_type_user=2
				) XX WHERE latitude!=0");
			return $q;
	}


	public function getPetugasTerdekat($lat,$long){
			$q = $this->db->query("  SELECT XX.* FROM (
				SELECT
					id_user,name,
					ifnull((SELECT latitude from tb_log_location where id_user =a.id_user   and  latitude!='0' order by id desc limit 1),0) as latitude,
					ifnull( (SELECT longitude from tb_log_location where id_user =a.id_user  and  longitude!='0' order by id desc limit 1 ),0) as longitude
					from tb_user a where status_online='Y' AND id_type_user=2
				) XX WHERE latitude!=0");
			return $q;
	}

	public function manageRequestComplaint($mode,$id,$uuid,$status){

		if($mode=="add"){
				$data=array(
					'uuid'=>$uuid,
				);
				$this->db->insert('tb_complaint_request',$data);
				$q = $this->db->insert_id();

		}else if($mode=="update"){
				$data=array(
					'status'=>$status,
				);
				$this->db->where('uuid', $uuid);
				$q = $this->db->update('tb_complaint_request',$data);
		}else if($mode=="select"){
			$q = $this->db->query("select * from tb_complaint_request where id =".$id." AND uuid='".$uuid."' and status='OPEN' ");
		}

		return $q;

	}













}
