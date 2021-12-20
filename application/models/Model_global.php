<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_global extends CI_Model{

	public function AksiLoginUser($username,$pwd){
		$queryChek=$this->db->query("select * from tb_user where username='$username'");
		if ($queryChek->num_rows()>0) {
			// $type=$queryChek->row()->id_type_user;
			// $pwdEnc=$queryChek->row()->pwd;
			// $pwdEnc2=$this->model_mcrypt->encrypt($pwd);
			// if ($pwdEnc==$pwdEnc2 && ($type=='1' || $type=='2' || $type=='4' || $type=='5')) {
			if ($queryChek->num_rows()>0) {
				$dataRow=$queryChek->row();
				$add_session=array(
					'username' => $dataRow->username,
					'level_akses' => $dataRow->id_type_user,
					'nama' => $dataRow->name,
					'id_user' => $dataRow->id_user,
					'phone' => $dataRow->phone,
					'status_online' => $dataRow->status_online,
					'id_provinsi' => $dataRow->id_provinsi,
					'id_kabupaten' => $dataRow->id_kabupaten,
					'islogin' => 'true'
				);
				$this->session->set_userdata($add_session); //add data session
				// $this->Online($dataRow->id_user); //make user online
				echo json_encode(array('status' => 'sukses','link' => base_url().'beranda'));
			} else {
				echo json_encode(array('status' => 'gagal','pesan' => 'Username atau Password Salah!'));
			}

		} else {
			echo json_encode(array('status' => 'gagal','pesan' => 'Username atau Password Salah!'));
		}

		return $queryChek;
	}

	public function tgl_indo($tgl){
			$newdate=$tgl;
			$jam = substr($newdate,11,10);
			$tgl = substr($newdate,0,10);
			$tanggal = substr($newdate,8,2);
			$bulan = $this->model_global->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;//.' '.$jam;
	}

	public function getBulan($bln){
		switch ($bln){
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}

	public function getHari($hari){
		switch ($hari){
			case 0:
				return "Minggu";
				break;
			case 1:
				return "Senin";
				break;
			case 2:
				return "Selasa";
				break;
			case 3:
				return "Rabu";
				break;
			case 4:
				return "Kamis";
				break;
			case 5:
				return "Jumat";
				break;
			case 6:
				return "Sabtu";
				break;
		}
	}

	public function TableSetting($kat){
		$q=$this->db->query("select * from tb_setting where kategori='$kat'");
		return $q;
	}

	public function getDataGlobal($tb,$where='',$param='',$order=''){

		if (strlen($where)>0 && strlen($param)>0) {
			$q=$this->db->get_where("".$tb."", array("".$where."" => $param));
		} else {
			$q=$this->db->get("".$tb."");
			// $q=$this->db->order_by('id', 'desc');
		}
		return $q;
	}

	public function getDataGlobal2($tb,$where='',$param=''){
		if (strlen($where)>0 && strlen($param)>0) {
			$q=$this->db->get_where("".$tb."", array("".$where."" => $param));
		} else {
			$q=$this->db->get("".$tb."");
		}
		return $q;
	}


	public function daftar_menu($andParam=''){
		if (strlen($andParam)>0) {
			$andStr="and link='".$andParam."'";
		} else {
			$andStr="";
		}

		if ($this->session->userdata('level_akses')=='1') {
			$q=$this->db->query("select * from daftar_menu where active_flag='Y' and urut_list is null  $andStr order by urut_menu asc");
		} else if ($this->session->userdata('level_akses')=='5'){
			$q=$this->db->query("select * from daftar_menu where active_flag='Y' and hak_akses=5 $andStr order by urut_menu asc");
		} else {
			$q=$this->db->query("select * from daftar_menu where active_flag='Y' and hak_akses=4 $andStr order by urut_menu asc");
		}

		return $q;
	}

	public function showMemberForum(){
		$q=$this->db->query("select * from tb_user");
		return $q;
	}

	public function getMember(){

		$this->db->select("tb_user.*,tb_type_user.type_user");
		$this->db->from('tb_user');
		$this->db->join('tb_type_user', 'tb_user.id_type_user = tb_type_user.id_type_user');

		if($this->session->userdata('level_akses')=="5"){
			$this->db->where('id_kabupaten',$this->session->userdata('id_kabupaten'));
		}

		$query = $this->db->get();
		return $query->result();
	}

	public function getPengguna($id_user){
		$q=$this->db->query("SELECT * FROM tb_user where id_user=".$id_user);
		return $q;
	}

	public function getTypeUser($id=''){
		if (strlen($id)>0) {
			$q=$this->db->query("SELECT * FROM tb_type_user where id_type_user=".$id);
		} else {
			$q=$this->db->query("SELECT * FROM tb_type_user");
		}

		return $q;
	}

	public function Online($id_user){
		$data=array(
			'status_online' => 'Y'
		);
		$this->db->where('id_user',$id_user);
		$this->db->update('tb_user',$data);
	}

	public function Offline(){
		$data=array(
			'status_online' => 'N'
		);
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$this->db->update('tb_user',$data);

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

	public function SendMessageForum($id_forum,$pesan){
		//// 'id_user' => $this->session->userdata('id_user'), // REMARK BY GIRI
		$data=array(
			'id_forum' => $id_forum,
			'id_petugas' => $this->session->userdata('id_user'),
			'id_user' => "0",
			'message' => $pesan,
			'date' => date('Y-m-d H:i:s'),
			'unique_id' => $this->generateRandomString()
		);
		$this->db->insert('tb_forum_detail',$data);
		$this->ChangeStatusForum($id_forum,'forum');
		$d['id_forum']=$id_forum;
		$this->load->view('utility/chat_forum',$d);
	}

	public function SendMessageComplaint($id_complaint,$pesan){
		$data=array(
			'id_complaint' => $id_complaint,
			'id_petugas' => $this->session->userdata('id_user'),
			'message' => $pesan,
			'date' => date('Y-m-d H:i:s'),
			'unique_id' => $this->generateRandomString()
		);
		$q=$this->db->insert('tb_complaint_detail',$data);
			$this->ChangeStatusForum($id_complaint,'complaint');
			$d['id_complaint']=$id_complaint;
			$this->load->view('utility/isi_complaint',$d);
	}


	// public function SendMessageForum($id_forum,$pesan){
	// 	$data=array(
	// 		'id_forum' => $id_forum,
	// 		'id_petugas' => $this->session->userdata('id_user'),
	// 		'id_user' => $this->session->userdata('id_user'),
	// 		'message' => $pesan,
	// 		'date' => date('Y-m-d H:i:s'),
	// 		'unique_id' => $this->generateRandomString()
	// 	);
	// 	$this->db->insert('tb_forum_detail',$data);
	// 	$this->ChangeStatusForum($id_forum);
	// 	$d['id_forum']=$id_forum;
	// 	$this->load->view('utility/chat_forum',$d);
	// }

	public function ChangeStatusForum($id,$from){
		$value=array(
			'status' => 'APPROVED',
			'id_petugas' => $this->session->userdata('id_user')
		);
		if ($from=='forum') {
			$q=$this->db->update('tb_forum',$value,array('id_forum' => $id));
		} else if ($from=='complaint') {
			$q=$this->db->update('tb_complaint',$value,array('id_complaint' => $id));
		}

	}

	public function getMessageForum($id_forum){
		 $this->db->select("tb_forum_detail.*,tb_user.name");
		 $this->db->from('tb_forum_detail');
		 $this->db->join('tb_user', 'tb_forum_detail.id_petugas = tb_user.id_user');
		 $this->db->order_by("date",'ASC');
		 $this->db->where('id_forum',$id_forum);
		 $query = $this->db->get();
		 return $query->result();
	}

	public function getComplaintDetail($id_complaint){
		 $this->db->select("tb_complaint_detail.*,tb_user.name");
		 $this->db->from('tb_complaint_detail');
		 $this->db->join('tb_user', 'tb_forum_detail.id_petugas = tb_user.id_petugas');
		 $this->db->order_by("date",'ASC');
		 $this->db->where('id_complaint',$id_forum);
		 $query = $this->db->get();
		 return $query->result();
	}

	public function InsertPengguna($data){
		$lat=$data['input_lat'];
		$lng=$data['input_lng'];
		$encrypt=$this->model_mcrypt->encrypt($data['password']);
		$data=array(
			'id_type_user' => $data['type_user'],
			'username' => $data['username'],
			'pwd' => $encrypt,
			'name' => $data['name'],
			'phone' => $data['phone'],
			'date_create' => date('Y-m-d H:i:s'),
			'foto' => $data['foto_user'],
			'id_provinsi' => $data['id_provinsi'],
			'id_kabupaten' => $data['id_kabupaten']
		);
		$this->db->insert('tb_user',$data);
		$newIduser=$this->db->insert_id();
		$this->insertLokasi($lat,$lng,$newIduser);
	}

	public function AksiUpdatePengguna($data){
		$value=array(
			'id_type_user' => $data['type_user'],
			'username' => $data['username'],
			'pwd' => $data['password'],
			'name' => $data['name'],
			'phone' => $data['phone'],
			'date_change' => date('Y-m-d H:i:s')
		);
		$q['where']=$this->db->where('id_user',$data['id_user']);
		$q['update']=$this->db->update('tb_user',$value);

		if ($q) {
			return $q;
			echo "sukses";
		} else {
			echo "gagal";
		}
	}

	public function insertLokasi($lat,$lang,$newIduser){
		$data=array(
			'id_user' => $newIduser,
			'latitude' => $lat,
			'longitude' => $lang,
			'date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('tb_log_location',$data);
		echo "sukses";
	}

	public function getCompanyProfile(){
		$q=$this->db->query("select * from tb_company");
		return $q;
	}

	public function getDataNews($id_news=''){

		if (strlen($id_news)>0) {
			$q=$this->db->query("select * from tb_news where id_news=".$id_news);
		} else {
			$q=$this->db->query("SELECT
			*,
			(SELECT COUNT(id_comment) FROM tb_news_comment WHERE id_news=a.id_news) AS jml_comment,
			IFNULL((SELECT ROUND(AVG(value_rating),1) FROM tb_news_rating WHERE id_news=a.id_news LIMIT 1),'0') AS val_rating,
			IFNULL((SELECT sum(value_rating) FROM tb_news_rating WHERE id_news=a.id_news LIMIT 1),'0') AS all_rating
			FROM tb_news a
			");
		}

		return $q;
	}

	public function getDaftarForum(){
		$query = $this->db->query('SELECT *
								FROM tb_forum
								WHERE DATE(date_create) >= DATE_ADD(NOW(), INTERVAL -3 MONTH)');
		return $query->result();
	}

	public function getDaftarComplaint($page='',$id=''){
		if ($page=='riwayat') {
			$query = $this->db->query('SELECT *
									FROM tb_complaint
									WHERE DATE(date_request) >= DATE_ADD(NOW(), INTERVAL -3 MONTH) and id_petugas='.$id);
		} else {
			$query = $this->db->query('SELECT *
									FROM tb_complaint
									WHERE DATE(date_request) >= DATE_ADD(NOW(), INTERVAL -3 MONTH)');
		}

		return $query;
	}

	public function getDataKabupaten(){
		$q=$this->db->get('tb_kabupaten');
		return $q;
	}

	public function getDataAnnouncement(){
		$q=$this->db->query("SELECT *,
		(SELECT COUNT(id) FROM tb_announcement_like WHERE id_announcement=a.id) as jml_like
		 FROM tb_announcement a");
		return $q;
	}

	public function CountGlobal($tb){
		$q=$this->db->count_all("".$tb."");

		return $q;
	}

	public function GetdataForDashboard($tb,$order,$limit=''){

			$this->db->order_by("".$order."", 'DESC');
			if (strlen($limit)>0) {
				$this->db->limit("".$limit."");
			}
		    $query = $this->db->get("".$tb."");
		    return $query;

		return $q;
	}

	public function GetdataForComplaintDash(){

		    $query = $this->db->query("SELECT * FROM tb_complaint order by id_complaint DESC LIMIT 5");
		    return $query;

	}
	public function GetdataForForumDash(){

		    $query = $this->db->query("SELECT * FROM tb_forum order by id_forum DESC LIMIT 5");
		    return $query;

	}

	public function GetDataDaerah($type,$id=''){
		if ($type=='provinsi') {
			$q=$this->db->query("SELECT *,
			(SELECT COUNT(id_kabupaten) FROM tb_kabupaten WHERE id_provinsi=a.id_provinsi) AS jml_kabupaten
			 FROM tb_provinsi a");
		} else if ($type=='kabupaten') {
			$q=$this->db->query("SELECT *,
			(SELECT COUNT(id_kecamatan) FROM tb_kecamatan WHERE id_kabupaten=a.id_kabupaten) AS jml_kecamatan
			 FROM tb_kabupaten a where id_provinsi=".$id);
		} else if ($type=='kecamatan') {
			$q=$this->db->query("SELECT *,
			(SELECT COUNT(id_kelurahan) FROM tb_kelurahan WHERE id_kecamatan=a.id_kecamatan) AS jml_kelurahan
			 FROM tb_kecamatan a where id_kabupaten=".$id);
		}

		return $q;

	}

	public function GetdataPetugasTPS($idTPS){
		$q=$this->db->query("SELECT * FROM tb_user WHERE id_type_user=2
				AND id_user NOT IN (SELECT id_petugas FROM tb_tps_petugas WHERE id_tps=$idTPS) AND id_provinsi = (SELECT id_provinsi FROM tb_tps WHERE id_tps=$idTPS) AND id_kabupaten = (SELECT id_kabupaten FROM tb_tps WHERE id_tps=$idTPS)");
		return $q;
	}

	public function getDataFormPemlihan1($tgl){
		 $q=$this->db->query("SELECT *,'sukses' as status FROM tb_pemilihan where tgl_pemilihan='".$tgl."'");
		 return $q;

	}

	public function GetdataQuickcount($id,$type){

		if ($type=='pilgub') {
			$whereSTR='tb_calon.id_provinsi';
		} else {
			$whereSTR='tb_calon.id_kabupaten';
		}

		 $this->db->select("tb_calon.id_kabupaten,id_provinsi,nama_calon_utama,nama_calon_wakil,jenis_pengusung,visi,misi,nama_paket,tb_hasil_live.*");
		 $this->db->from('tb_calon');
		 $this->db->join('tb_hasil_live', 'tb_hasil_live.id_calon = tb_calon.id_calon');
		 $this->db->where("".$whereSTR."",$id);
		 $query = $this->db->get();
		 return $query;
	}

	public function GetTotalSuara($id,$type){

		if ($type=='pilgub') {
			$whereSTR='tb_calon.id_provinsi';
		} else {
			$whereSTR='tb_calon.id_kabupaten';
		}

		 $this->db->select("tb_hasil_live.total_suara,tb_calon.nama_paket");
		 $this->db->from('tb_calon');
		 $this->db->join('tb_hasil_live', 'tb_hasil_live.id_calon = tb_calon.id_calon');
		 $this->db->where("".$whereSTR."",$id);
		 $query = $this->db->get();
		 return $query;
	}

	public function GetListGroup($id){
		if ($this->session->userdata('level_akses')=='5') {
			$q=$this->db->query("select * from daftar_menu where active_flag='Y' and hak_akses='5' and type_menu='LIST' and id_group=$id order by urut_menu asc");
		} else {
			$q=$this->db->query("select * from daftar_menu where active_flag='Y' and type_menu='LIST' and id_group=$id order by urut_menu asc");
		}
		return $q;
	}

	public function SyncDataBroadcast($jenis_broadcast,$judul_bc,$urlGambar_bc,$urlWeb_bc,$pesan_bc){

		if ($jenis_broadcast=='USER') {
			$whereStr='and id_type_user=3';
		} else if ($jenis_broadcast=='PETUGAS') {
			$whereStr='and id_type_user=2';
		} else {
			$whereStr='';
		}
		$q=$this->db->query("INSERT INTO tb_data_broadcast (
			jenis_broadcast,
			firebase_id,
			judul,
			pesan,
			STATUS,
			url_img,
			url_web,
			create_date,
			create_who)
			SELECT '$jenis_broadcast',firebase_id,'$judul_bc','$pesan_bc','P','$urlGambar_bc','$urlWeb_bc','".date('Y-m-d H:i:s')."','".$this->session->userdata('username')."'
			FROM tb_user WHERE LENGTH(firebase_id)>10 $whereStr");
		if ($q) {
			echo "sukses";
		} else {
			echo "gagal";
		}
	}

	public function ShowMessageBC($jenis_broadcast){
		$q=$this->db->query("SELECT * FROM tb_data_broadcast WHERE status='P' and jenis_broadcast='$jenis_broadcast' and date_format(create_date,'%Y-%m-%d')='".date('Y-m-d')."'");
		return $q;
	}

	public function CountBC($jenis_broadcast){
		$q=$this->db->query("SELECT * FROM tb_data_broadcast WHERE status='P' and jenis_broadcast='$jenis_broadcast' and date_format(create_date,'%Y-%m-%d')='".date('Y-m-d')."'")->num_rows();
		echo json_encode(array('row' => $q));
	}

	public function GetdataToSend($jenis_broadcast){
		$q=$this->db->query("SELECT * FROM tb_data_broadcast WHERE status='P' and jenis_broadcast='$jenis_broadcast' and date_format(create_date,'%Y-%m-%d')='".date('Y-m-d')."' LIMIT 1");
		return $q;
	}

	public function ShowPetugasOnline(){
		// add by giri
		$q=$this->db->query("

				select
					id_user,foto,name,phone,status_online,date_format(date_change,'%d-%m-%Y %h:%i') as date_change,
					ifnull( (select latitude from tb_log_location where id_user =a.id_user and latitude!=0  limit 1) ,0) as latitude,
					ifnull( (select longitude from tb_log_location where id_user =a.id_user and longitude!=0 limit 1) ,0) as longitude
				 from  tb_user a where id_type_user=2 and status_online ='Y'
				 having latitude!=0
				 -- LIMIT 5

		");
		return $q;
	}

	public function ShowDafatarSemuaPetugas(){
		// add by giri
		$q=$this->db->query("

				select
					id_user,foto,name,phone,status_online,date_format(date_change,'%d-%m-%Y %h:%i') as date_change,
					ifnull( (select latitude from tb_log_location where id_user =a.id_user  and latitude!=0  limit 1) ,0) as latitude,
					ifnull( (select longitude from tb_log_location where id_user =a.id_user and longitude!=0 limit 1) ,0) as longitude
				 from  tb_user a where id_type_user=2


		");
		return $q;
	}

	public function ShowPetugasOnlineForMaps(){
		// add by giri
		$q=$this->db->query("

				select
					name as nama_petugas,IF(status_online='Y','Online','Offline') as status_online,
					ifnull( (select latitude from tb_log_location where id_user =a.id_user  and latitude!=0 limit 1) ,0) as latitude,
					ifnull( (select longitude from tb_log_location where id_user =a.id_user and longitude!=0 limit 1) ,0) as longitude
				 from  tb_user a where id_type_user=2
				 having latitude!=0

		");
		return $q;
	}

	public function RiwayatLokasiPetugas($id_petugas){
		// add by giri
		$q=$this->db->query("

				SELECT date_format(date,'%d-%m-%Y %H:%s') as tgl,
				latitude,
				longitude
				from tb_log_location
				 where id_user=$id_petugas and  latitude is not null and  LENGTH(latitude)>4  GROUP BY latitude


		");
		return $q;
	}

	public function getFilteredForum($d){
		$tglStart=date("Y-m-d", strtotime($d['tgl_dibuat']));
		$tglClose=date("Y-m-d", strtotime($d['tgl_tutup']));
		if ($d['petugas']=='semua' && $d['status']=='semua') {
			$whereParam=array('DATE(date_create)>=' => $tglStart,'DATE(date_close)<=' => $tglClose);
		} else if ($d['petugas']=='semua') {
			$whereParam=array('DATE(date_create)>=' => $tglStart,'DATE(date_close)<=' => $tglClose,'status' => $d['status']);
		} else if ($d['status']=='semua') {
			$whereParam=array('DATE(date_create)>=' => $tglStart,'DATE(date_close)<=' => $tglClose,'id_petugas' => $d['petugas']);
		} else {
			$whereParam=array('DATE(date_create)>=' => $tglStart,'DATE(date_close)<=' => $tglClose,'id_petugas' => $d['petugas'],'status' => $d['status']);
		}
		//$q=$this->db->get_where('tb_forum', array('DATE(date_create)' => $tglStart,'DATE(date_close)' => $tglClose,'id_petugas' => $d['petugas'],'status' => $d['status'],));
		$q=$this->db->get_where('tb_forum', $whereParam);
		return $q;
	}
	public function getFilteredComplaint($d){
		$tglStart=date("Y-m-d", strtotime($d['tgl_dibuat']));
		$tglClose=date("Y-m-d", strtotime($d['tgl_tutup']));
		if ($d['petugas']=='semua' && $d['status']=='semua') {
			$whereParam=array('DATE(date_request)>=' => $tglStart,'DATE(date_finish)<=' => $tglClose);
		} else if ($d['petugas']=='semua') {
			$whereParam=array('DATE(date_request)>=' => $tglStart,'DATE(date_finish)<=' => $tglClose,'status' => $d['status']);
		} else if ($d['status']=='semua') {
			$whereParam=array('DATE(date_request)>=' => $tglStart,'DATE(date_finish)<=' => $tglClose,'id_petugas' => $d['petugas']);
		} else {
			$whereParam=array('DATE(date_request)>=' => $tglStart,'DATE(date_finish)<=' => $tglClose,'id_petugas' => $d['petugas'],'status' => $d['status']);
		}
		// $whereParam=array('DATE(date_request)' => $tglStart,'DATE(date_finish)' => $tglClose);
		$q=$this->db->get_where('tb_complaint', $whereParam);
		// $q=$this->db->query(" SELECT * from tb_complaint where date_request= '2020-' and  date_finish='".$tglClose."'");
		// $q=$this->db->query(" SELECT * from tb_complaint where date_request>= '".$tglStart."' and  date_finish<='".$tglClose."'");
		// $q=$this->db->query(" SELECT * from tb_complaint where date_request= '2020-01-03' date_finish='".$tglClose."'");
		return $q;
	}

	// public function ShowPetugasOnline(){
	// 	 $this->db->select("tb_user.*,tb_log_location.latitude,longitude");
	// 	 $this->db->from('tb_user');
	// 	 $this->db->join('tb_log_location', 'tb_user.id_user = tb_log_location.id_user');
	// 	 $this->db->where('id_type_user',2);
	// 	 $query = $this->db->get();
	// 	 return $query;
	// }

	public function GetProvORKabFromPemilihan($type,$tgl){
		if ($type=='PILGUB') {
			$q=$this->db->query("
			 SELECT
			 DISTINCT tb_calon.`id_provinsi`,
			 tb_pemilihan.`tgl_pemilihan`,
			 tb_provinsi.`id_provinsi`,name

			 FROM
			 tb_pemilihan
			 INNER JOIN tb_calon ON tb_calon.`id_pemilihan` = tb_pemilihan.`id_pemilihan`
			 INNER JOIN tb_provinsi ON tb_provinsi.`id_provinsi` = tb_calon.`id_provinsi`
			 WHERE tgl_pemilihan='".$tgl."'");
		} else {
			$q=$this->db->query(" SELECT
			 DISTINCT tb_calon.`id_kabupaten`,
			 tb_pemilihan.`tgl_pemilihan`,
			 tb_kabupaten.`id_kabupaten`,name
			 FROM
			 tb_pemilihan
			 INNER JOIN tb_calon ON tb_calon.`id_pemilihan` = tb_pemilihan.`id_pemilihan`
			 INNER JOIN tb_kabupaten ON tb_kabupaten.`id_kabupaten` = tb_calon.`id_kabupaten`
			 WHERE tgl_pemilihan='".$tgl."'");
		}


		return $q;
	}

	// public function GetDataSuaraPerProvinsi($id_prov){
	// 	$q=$this->db->query("SELECT DISTINCT tb_hasil_calon.id_calon,SUM(suara),
	// 		tb_calon.`nama_paket`
	// 		FROM tb_hasil_calon
	// 		INNER JOIN tb_calon ON	 tb_calon.`id_calon` = tb_hasil_calon.`id_calon`
	// 		WHERE id_tps IN
	// 		(
	// 			SELECT id_tps FROM tb_tps WHERE id_provinsi=$id_prov
	// 		)
	// 		GROUP BY id_calon ");
	// }

	public function GetDataSuaraPerProvinsi($start_form,$jenis,$id_pemilihan,$id_prov='',$id_kab='',$id_kec='',$id_kel=''){
			//untuk provinsi
			$andKabStr="";
			$andKecStr="";
			$andKelStr="";
			$andFilterCalon="";
			//end untuk provinsi
		if ($jenis=='get_kabupaten') {
			$andKabStr=" AND id_kabupaten=".$id_kab;
			$andKecStr="";
			$andKelStr="";
		} else if ($jenis=='get_kecamatan') {
			$andKabStr=" AND id_kabupaten=".$id_kab;
			$andKecStr=" AND id_kecamatan=".$id_kec;
			$andKelStr="";
		} else if ($jenis=='get_kelurahan') {
			$andKabStr=" AND id_kabupaten=".$id_kab;
			$andKecStr=" AND id_kecamatan=".$id_kec;
			$andKelStr=" AND id_kelurahan=".$id_kel;
		}

		if ($start_form=='pilgub') {
			$andFilterCalon=" AND  b.id_provinsi=".$id_prov;
		}else{
			$andFilterCalon=" AND  b.id_kabupaten=".$id_kab;
		}

		$query="SELECT
				distinct(a.id_calon) as id_calon,
				sum(suara) as jumlah_suara,
				concat(nama_calon_utama,' - ',nama_calon_wakil ) as nama_calon
			from tb_hasil_calon a, tb_calon b, tb_pemilihan c,tb_hasil_live d
			where a.id_calon=b.id_calon  and c.id_pemilihan=d.id_pemilihan and d.id_tps = a.id_tps
			and c.id_pemilihan=$id_pemilihan
			$andFilterCalon
			and a.id_tps in (
				select distinct(id_tps) from tb_tps where id_provinsi=$id_prov $andKabStr $andKecStr $andKelStr
			)
			group by a.id_calon;";

		$q=$this->db->query($query);

			// echo "  --> ".$jenis." --> ".$query;

		return $q;
	}

	public function GetDataTableSuara($start_form,$jenis,$id_pemilihan,$id_prov='',$id_kab='',$id_kec='',$id_kel=''){
			//untuk provinsi
			$andKabStr="";
			$andKecStr="";
			$andKelStr="";
			$andFilterCalon="";
			$table=" tb_kabupaten";
			$id_kolom=" id_kabupaten";
			//end untuk provinsi
		if ($jenis=='get_kabupaten') {
			$andKabStr="AND id_kabupaten=".$id_kab;
			$andKecStr="";
			$andKelStr="";
			$table=" tb_kecamatan";
			$id_kolom=" id_kecamatan";
		} else if ($jenis=='get_kecamatan') {
			$andKabStr="AND id_kabupaten=".$id_kab;
			$andKecStr="AND id_kecamatan=".$id_kec;
			$andKelStr="";
			$table=" tb_kelurahan";
			$id_kolom=" id_kelurahan";
		} else if ($jenis=='get_kelurahan') {
			$andKabStr="AND id_kabupaten=".$id_kab;
			$andKecStr="AND id_kecamatan=".$id_kec;
			$andKelStr="AND id_kelurahan=".$id_kel;
			$table=" tps....";
			$id_kolom=" tps....";
		}

		if ($start_form=='pilbub') {
			$andFilterCalon = "AND id_kabupaten=".$id_kab;
		}else{
			$andFilterCalon = "AND id_provinsi=".$id_prov;
		}

		//ketika jenis == get kelurahan maka yg ditampilkan adalah data table TPS makanya querynya berbeda
		if ($jenis=='get_kelurahan') {
			$query="SELECT
					a. id_tps,
					(select foto_c1 from tb_hasil_live where id_tps=a.id_tps) as foto_calon,
					no_tps as nama_wilayah,
					(
						select sum(suara) from tb_hasil_calon where id_calon in ( select id_calon from tb_calon where id_pemilihan=$id_pemilihan  $andFilterCalon ) and id_tps = a.id_tps
					) as tot_suara
					FROM tb_tps a, tb_hasil_calon b, tb_pemilihan c , tb_hasil_live d
					WHERE a.id_tps = b.id_tps and  id_provinsi=$id_prov $andKabStr $andKecStr $andKelStr
					and c.id_pemilihan=d.id_pemilihan and d.id_tps=a.id_tps
					and c.id_pemilihan=$id_pemilihan
					GROUP BY a.id_tps";
					// echo " !!! ".$query;
			$q=$this->db->query($query);
		} else {
		//selain jenis get kelurahan menggunakan query ini
		$query="SELECT  sum(jumlah_suara) as tot_suara,nama_wilayah,$id_kolom from (

					select
						distinct(a.id_tps) as id_tps,
						sum(suara) as jumlah_suara,
						(select name from $table where $id_kolom=b.$id_kolom) as nama_wilayah,
						".$id_kolom."
					from tb_hasil_calon a, tb_tps b, tb_pemilihan c,tb_hasil_live d
					where a.id_tps=b.id_tps  and c.id_pemilihan=d.id_pemilihan and d.id_tps = a.id_tps
					and c.id_pemilihan=$id_pemilihan
					and a. id_calon in (select id_calon from tb_calon where id_pemilihan=$id_pemilihan  $andFilterCalon )
						and a.id_tps in (
						select distinct(id_tps) from tb_tps where id_provinsi=$id_prov $andKabStr $andKecStr $andKelStr

					)
					group by a.id_tps

			)xx  GROUP BY ".$id_kolom;

			$q=$this->db->query($query);

				// echo "  ## ".$jenis."  --> ".$query;
		}

		return $q;
	}

	public function getFilteredPetugas($status){
	if ($status=='semua') {
		$q=$this->db->query("

				select
					id_user,foto,name,phone,status_online,date_format(date_change,'%d-%m-%Y %h:%i') as date_change,
					ifnull( (select latitude from tb_log_location where id_user =a.id_user and latitude!=0  limit 1) ,0) as latitude,
					ifnull( (select longitude from tb_log_location where id_user =a.id_user and longitude!=0  limit 1) ,0) as longitude
				 from  tb_user a where id_type_user=2


		");
	} else {
		$q=$this->db->query("

				select
					id_user,foto,name,phone,status_online,date_format(date_change,'%d-%m-%Y %h:%i') as date_change,
					ifnull( (select latitude from tb_log_location where id_user =a.id_user and latitude!=0 limit 1 ) ,0) as latitude,
					ifnull( (select longitude from tb_log_location where id_user =a.id_user and longitude!=0  limit 1) ,0) as longitude
				 from  tb_user a where id_type_user=2 and status_online='".$status."'


		");
	}

		return $q;
	}

	public function getFilteredTPS($d){

		if ($d['provinsi']=='semua') {
			$whereProv='id_provinsi = id_provinsi';
		} else {
			$whereProv='id_provinsi = '.$d['provinsi'];
		}
		if ($d['kabupaten']=='semua') {
			$whereKab='and id_kabupaten = id_kabupaten';
		} else {
			$whereKab='and id_kabupaten = '.$d['kabupaten'];
		}
		 if ($d['kecamatan']=='semua') {
			$whereKec='and id_kecamatan = id_kecamatan';
		} else {
			$whereKec='and id_kecamatan = '.$d['kecamatan'];
		}
		 if ($d['kelurahan']=='semua') {
			$whereKel='and id_kelurahan = id_kelurahan';
		} else {
			$whereKel='and id_kelurahan = '.$d['kelurahan'];
		}
		$q=$this->db->query("SELECT * FROM tb_tps where $whereProv $whereKab $whereKec $whereKel");
		return $q;
	}

	public function getTpsOperator(){
		$q=$this->db->get_where('tb_tps', array('id_kabupaten' => $this->session->userdata('id_kabupaten')));
		return $q;
	}

	public function getFilteredPengguna($data){
		if ($data['type_user']=='5' || $data['type_user']=='2'){
			if ($data['id_provinsi']=='semua') {
				$this->db->select("tb_user.*,tb_type_user.type_user");
				 $this->db->from('tb_user');
				 $this->db->join('tb_type_user', 'tb_user.id_type_user = tb_type_user.id_type_user');
				 $this->db->where('tb_user.id_type_user',$data['type_user']);

				 $query = $this->db->get();
				 return $query;
			} else if ($data['id_provinsi']!='semua' && $data['id_kabupaten']=='semua'){
				 $arrayWhere = array('tb_user.id_type_user' => $data['type_user'], 'id_provinsi' => $data['id_provinsi']);
				 $this->db->select("tb_user.*,tb_type_user.type_user");
				 $this->db->from('tb_user');
				 $this->db->join('tb_type_user', 'tb_user.id_type_user = tb_type_user.id_type_user');
				 $this->db->where($arrayWhere);

				 $query = $this->db->get();
				 return $query;
			} else if($data['id_provinsi']!='semua' && $data['id_kabupaten']!='semua'){
				$arrayWhere = array('tb_user.id_type_user' => $data['type_user'], 'id_provinsi' => $data['id_provinsi'],'id_kabupaten' => $data['id_kabupaten']);
				 $this->db->select("tb_user.*,tb_type_user.type_user");
				 $this->db->from('tb_user');
				 $this->db->join('tb_type_user', 'tb_user.id_type_user = tb_type_user.id_type_user');
				 $this->db->where($arrayWhere);

				 $query = $this->db->get();
				 return $query;
			}


		}else {
		 $this->db->select("tb_user.*,tb_type_user.type_user");
		 $this->db->from('tb_user');
		 $this->db->join('tb_type_user', 'tb_user.id_type_user = tb_type_user.id_type_user');
		 $this->db->where('tb_user.id_type_user',$data['type_user']);

		 $query = $this->db->get();
		 return $query;
		}
	}

	public function getIdProvAndKabInTPS(){

		$this->db->select("tb_provinsi.*,tb_tps.id_tps");
		$this->db->from('tb_provinsi');
		$this->db->join('tb_tps', 'tb_provinsi.id_provinsi = tb_tps.id_provinsi');
		 $this->db->group_by('tb_provinsi.id_provinsi');



		$query = $this->db->get();
		return $query;
	}
	public function getIdKabInTPS($id_provinsi){

		$this->db->select("tb_kabupaten.*,tb_tps.id_tps");
		$this->db->from('tb_kabupaten');
		$this->db->join('tb_tps', 'tb_kabupaten.id_kabupaten = tb_tps.id_kabupaten');
		$this->db->group_by('tb_kabupaten.id_kabupaten');
		$this->db->where('tb_kabupaten.id_provinsi',$id_provinsi);



		$query = $this->db->get();
		return $query;
	}

// 	SELECT DISTINCT tb_hasil_calon.id_calon,SUM(suara),
// tb_calon.`nama_paket`,
// tb_tps.`id_provinsi`
// FROM tb_hasil_calon
// INNER JOIN tb_calon ON tb_calon.`id_calon` = tb_hasil_calon.`id_calon`
// INNER JOIN tb_tps ON tb_hasil_calon.`id_tps` = tb_tps.`id_tps`
// WHERE id_tps IN
// (
// 	SELECT id_tps FROM tb_tps WHERE id_provinsi=1
// )
// GROUP BY id_calon


}
?>
