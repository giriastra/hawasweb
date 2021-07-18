<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_pilkada extends CI_Model {

	public function getMainEventPilkada(){
			$q = $this->db->query("select id_pemilihan,date_format(tgl_pemilihan,'%d-%m-%Y') as tgl_pemilihan,is_pilgub,is_pilbub from tb_pemilihan where status='Y'");
			return $q;
	}


	public function getMainCalon($id_pemilihan){
			$q = $this->db->query("select *,
					ifnull( (select name from tb_provinsi where id_provinsi=a.id_provinsi),'') as provinsi,
					ifnull( (select name from tb_kabupaten where id_kabupaten=a.id_kabupaten),'') as kabupaten
					from  tb_calon a  where id_pemilihan=".$id_pemilihan);
			return $q;
	}

	public function getMainCalonByLokasi($id_pemilihan,$idLokasi,$jenis){


			if($jenis=="PILBUB"){
					$jenis_=" AND id_kabupaten=".$idLokasi;
			}else{
					$jenis_=" AND id_provinsi=".$idLokasi;
			}
			$q = $this->db->query("select *,
					ifnull( (select name from tb_provinsi where id_provinsi=a.id_provinsi),'') as provinsi,
					ifnull( (select name from tb_kabupaten where id_kabupaten=a.id_kabupaten),'') as kabupaten
					from  tb_calon a  where id_pemilihan=".$id_pemilihan."  ".$jenis_);
			return $q;
	}

	public function getPartaiPengusung($id_calon){
			$q = $this->db->query("select nama_partai,img_logo from tb_partai_pengusung a, tb_partai b where a.id_partai=b.id_partai and  id_calon=".$id_calon);
			return $q;
	}

	public function getDataTPSByID($id){
			$q = $this->db->query("select * from tb_tps where id_tps =".$id);
			return $q->row();
	}

	public function getDataHasilTemp($id){
			$q = $this->db->query("select * from tb_hasil_temp where id_hasil_temp =".$id);
			return $q->row();
	}


	public function getCalonPersebaranWilayah($id_pemilihan){
			$q = $this->db->query("SELECT  xx.*,
														concat('',(select name from tb_provinsi where id_provinsi=xx.id_lokasi)) as nama_kab,
														(select DATE_FORMAT(tgl_pemilihan,'%d-%m-%Y') from tb_pemilihan where id_pemilihan=xx.id_pemilihan) as tgl_pemilihan,
														concat( (select count(id_calon) from tb_calon where id_pemilihan=xx.id_pemilihan and jenis_pengusung='PARTAI' AND id_provinsi=xx.id_lokasi),' Pasang PARTAI') as pengusung_partai,
		concat( ifnull((select count(id_calon) from tb_calon where id_pemilihan=xx.id_pemilihan and jenis_pengusung='INDEPENDEN' AND id_provinsi=xx.id_lokasi ),0),' Pasang INDEPENDEN') as pengusung_independen,
														'PILGUB' AS jenis_pemilihan
													from (
														select
															distinct(id_provinsi) as id_lokasi,
															count(id_provinsi) jml_calon,
															id_pemilihan
														from tb_calon where
														id_provinsi>0
														and id_pemilihan=".$id_pemilihan."
														GROUP BY id_lokasi
													) xx

													UNION

													select xx.*,
														concat('',(select name from tb_kabupaten where id_kabupaten=xx.id_lokasi)) as nama_kab,
														(select DATE_FORMAT(tgl_pemilihan,'%d-%m-%Y') from tb_pemilihan where id_pemilihan=xx.id_pemilihan) as tgl_pemilihan,
														concat( (select count(id_calon) from tb_calon where id_pemilihan=xx.id_pemilihan and jenis_pengusung='PARTAI' AND id_kabupaten=xx.id_lokasi),' Pasang PARTAI') as pengusung_partai,
		concat( ifnull((select count(id_calon) from tb_calon where id_pemilihan=xx.id_pemilihan and jenis_pengusung='INDEPENDEN' AND id_kabupaten=xx.id_lokasi ),0),' Pasang INDEPENDEN') as pengusung_independen,
														'PILBUB' AS jenis_pemilihan
													from (
														select
															distinct(id_kabupaten) as id_lokasi,
															count(id_kabupaten) jml_calon,
															id_pemilihan
														from tb_calon where
														id_kabupaten>0
														and id_pemilihan=".$id_pemilihan."
														GROUP BY id_lokasi
													) xx");
			return $q;
	}


	public function getDataTPSbyIdPetugas($id){
			$q = $this->db->query(" SELECT
										a.id_tps,
										ifnull((select name from tb_provinsi where id_provinsi=a.id_provinsi),'') as provinsi,
										ifnull((select name from tb_kabupaten where id_kabupaten=a.id_kabupaten),'') as kabupaten,
										ifnull((select name from tb_kecamatan where id_kecamatan=a.id_kecamatan),'') as kecamatan,
										ifnull((select name from tb_kelurahan where id_kelurahan=a.id_kelurahan),'') as kelurahan,
										latitude,longitude,concat('No. TPS: ',no_tps) as no_tps,ketua_tps
										from tb_tps a, tb_tps_petugas b
										where a.id_tps=b.id_tps
										and id_petugas=".$id);
			return $q;
	}
	public function getDataTPSbyIdPetugasPemilihan($id){
			$q = $this->db->query(" SELECT  xx.*,
											case when  LENGTH(jml_suara)>0 then 'Sudah Terinput' else 'Belum Terinput' end as status_suara
									from (
										SELECT
											a.id_tps,
											ifnull((select name from tb_provinsi where id_provinsi=a.id_provinsi),'') as provinsi,
											ifnull((select name from tb_kabupaten where id_kabupaten=a.id_kabupaten),'') as kabupaten,
											ifnull((select name from tb_kecamatan where id_kecamatan=a.id_kecamatan),'') as kecamatan,
											ifnull((select name from tb_kelurahan where id_kelurahan=a.id_kelurahan),'') as kelurahan,
											ifnull(latitude,0)as latitude,ifnull(longitude,0)as longitude,concat('No. TPS: ',no_tps) as no_tps,ketua_tps,
											ifnull( (SELECT SUM(suara) from tb_hasil_calon where id_tps=a.id_tps),'') as jml_suara
											from tb_tps a, tb_tps_petugas b , tb_pemilihan c
											where a.id_tps=b.id_tps and a.id_pemilihan =c.id_pemilihan and c.`status`='Y'
											and id_petugas=".$id."
									)xx ");
			return $q;
	}

	public function getDataC1TempbyIdPetugas($id){
			$q = $this->db->query(" SELECT  xx.*,
			concat (kab,' # ',kec,' # ',kel)as lokasi
			from (

				SELECT
							id_hasil_temp,
							c.id_pemilihan,
							suara_valid,suara_invalid,
							total_suara,
							ifnull(DATE_FORMAT(c.date_create,'%d-%m-%Y %h:%i'),'') as date_create,
							ifnull(DATE_FORMAT(c.date_confirm,'%d-%m-%Y %h:%i'),'') as date_confirm,
							ifnull((select name from tb_user where id_user=c.confirm_who),'') as confirm_who,
							note,c.status,foto_c1,
							a.id_tps,
							case when d.is_pilgub='true' and d.is_pilbub='true' then 'PILGUB & PILBUB'
							 when d.is_pilgub='true' and d.is_pilbub='false' then (select value2 from tb_setting where kategori='TIPE_PEMILIHAN' and sub_kat='PILGUB' LIMIT 1)
							ELSE (select value2 from tb_setting where kategori='TIPE_PEMILIHAN' and sub_kat='PILBUB' LIMIT 1)
							END AS jenis_pemilihan,

							(select name from tb_kabupaten where id_kabupaten=a.id_kabupaten) as kab,
							(select name from tb_kecamatan where id_kecamatan=a.id_kecamatan) as kec,
							(select name from tb_kelurahan where id_kelurahan=a.id_kelurahan) as kel,

							latitude,longitude,concat('No. TPS: ',no_tps) as no_tps,ketua_tps
							from tb_tps a, tb_hasil_temp c, tb_pemilihan d
							where  a.id_tps=c.id_tps and d.id_pemilihan=c.id_pemilihan AND c.status!='CONFIRM'
							and d.status='Y'
							and a.id_tps in (
									select id_tps from tb_tps_petugas  where id_petugas=".$id."
							)

					) xx
			");
			return $q;
	}
	public function getDataC1LivebyIdPetugas($id){
			$q = $this->db->query(" SELECT  xx.*,
			concat (kab,' # ',kec,' # ',kel)as lokasi
			from (

			SELECT
							id_hasil_temp,
							c.id_pemilihan,
							suara_valid,suara_invalid,
							total_suara,
							ifnull(DATE_FORMAT(c.date_create,'%d-%m-%Y %h:%i'),'') as date_create,
							ifnull(DATE_FORMAT(c.date_confirm,'%d-%m-%Y %h:%i'),'') as date_confirm,
							ifnull( (select name from tb_user where id_user=c.confirm_who),'') as confirm_who,
							note,'CONFIRM' AS status ,foto_c1,
							a.id_tps,
							case when d.is_pilgub='true' and d.is_pilbub='true' then 'PILGUB & PILBUB'
							 when d.is_pilgub='true' and d.is_pilbub='false' then (select value2 from tb_setting where kategori='TIPE_PEMILIHAN' and sub_kat='PILGUB' LIMIT 1)
							ELSE (select value2 from tb_setting where kategori='TIPE_PEMILIHAN' and sub_kat='PILBUB' LIMIT 1)
							END AS jenis_pemilihan,

							(select name from tb_kabupaten where id_kabupaten=a.id_kabupaten) as kab,
							(select name from tb_kecamatan where id_kecamatan=a.id_kecamatan) as kec,
							(select name from tb_kelurahan where id_kelurahan=a.id_kelurahan) as kel,

							latitude,longitude,concat('No. TPS: ',no_tps) as no_tps,ketua_tps
							from tb_tps a, tb_hasil_live c, tb_pemilihan d
							where  a.id_tps=c.id_tps and d.id_pemilihan=c.id_pemilihan
							and d.status='Y'
							and a.id_tps in (
									select id_tps from tb_tps_petugas  where id_petugas=".$id."
							)
				) xx
		");
			return $q;
	}


	public function getCalonByIdTpsAndPetugas($idtps,$idpetugas){
			$q = $this->db->query("
					SELECT  xx.*,
					case when  xx.id_provinsi>0  then 'PILGUB'  when  xx.id_kabupaten>0  then 'PILBUB/WALKOT'  end  jenis
					from (
							select  id_calon,nama_calon_utama,nama_calon_wakil,foto_utama,foto_wakil,nama_paket, ifnull(id_provinsi,'0') as id_provinsi,ifnull(id_kabupaten,'0') as id_kabupaten,
							ifnull( (select sum(suara) from tb_hasil_calon where id_calon = a.id_calon  and id_tps=".$idtps." limit 1),0) as status_suara_calon,
							ifnull( (select id_tps from tb_hasil_calon where id_calon = a.id_calon  and id_tps=".$idtps."  limit 1),0) as id_tps
							from tb_calon a, tb_pemilihan b  where  status='Y' and  a.id_pemilihan =  b.id_pemilihan  and b.id_pemilihan in (
									select aa.id_pemilihan from  tb_tps_petugas aa,tb_tps bb  where  aa.id_tps=bb.id_tps AND bb.id_tps=".$idtps." and  id_petugas=".$idpetugas."
							)
					)xx

			");
			return $q;
	}


	public function inputHasilTemp($data){
			$res = 	$this->db->insert('tb_hasil_temp',$data);
			return $res;
	}

	public function inputHasilCalon($data){
			$res = 	$this->db->insert('tb_hasil_calon',$data);
			return $res;
	}














}
