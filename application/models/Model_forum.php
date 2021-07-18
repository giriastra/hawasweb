<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_forum extends CI_Model {

	public function getForumByIdUser($id_user){
			$q = $this->db->query("select id_forum, title, date_format(date_create,'%d-%m-%Y %h:%i') as date_create, ifnull(date_format(date_close,'%d-%m-%Y %h:%i'),'') as date_close, id_user, status,
				ifnull( (SELECT message from tb_forum_detail a where a.id_forum=x.id_forum order by id_forum_detail desc limit 1),'-') as message
				from  tb_forum x where id_user=".$id_user." order by id_forum desc ");
			return $q;
	}

	public function getForumByIdPetugas($id_user){
			$q = $this->db->query("select * from  tb_forum where id_petugas=".$id_user);
			return $q;
	}
	public function getForumByIdForum($idforum){
			$q = $this->db->query("select * from  tb_forum where id_forum=".$idforum);
			return $q->row();
	}


	public function getDataForumDetailByIdForum($id_forum){
			$q = $this->db->query("select *,
								ifnull((select name from tb_user a where a.id_user=b.id_user ),'') as nama_user,
								ifnull((select name from tb_user a where a.id_user=b.id_petugas ),'') as nama_petugas
								from  tb_forum_detail b where id_forum=".$id_forum);
			return $q;
	}

	public function addNewForum($data_forum){
			$res = $this->db->insert('tb_forum',$data_forum);
			return $this->db->insert_id();
	}

	public function addNewForumDetail($data_forum){
			$res = $this->db->insert('tb_forum_detail',$data_forum);

			if($res){
					$data=array( 'status'=>"true",'message'=>'Berhasil dikirim');
			}else{
					$data=array( 'status'=>"false",'message'=>'Gagal dikirim');
			}
			return $data;

	}

	public function updateStatusForum($id_forum,$status){

			if($status=="CLOSE" || $status=="CANCEL" || $status=="REJECTED"){

				$data_forum=array( 'status'=>$status,'date_close'=>date('Y-m-d H:i:s') );
			}else{
				$data_forum=array( 'status'=>$status);
			}

			$this->db->where('id_forum', $id_forum);
			$res = $this->db->update('tb_forum', $data_forum);

			if($res){
					$data=array( 'status'=>"true",'message'=>'Berhasil dikirim','status_forum'=>$status);
			}else{
					$data=array( 'status'=>"false",'message'=>'Gagal dikirim');
			}
			return $data;
	}









}
