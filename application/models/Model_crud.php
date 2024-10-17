<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_crud extends CI_Model{

	//global query
	public function DeleteGlobal($tb,$param,$val_param){
		$q=$this->db->delete($tb, array($param => $val_param));
		if ($q) {
			echo "sukses";
		} else {
			echo "gagal";
		}


	}
	//end global query

	//query pengguna
	public function AksiUpdatePengguna($data){
		$id_user=$data['id_user'];
		$encPwd=$this->model_mcrypt->encrypt($data['password']);
		if ($data['foto_user']=='false_upload') {
			$value=array(
				'id_type_user' => $data['type_user'],
				'username' => $data['username'],
				'pwd' => $encPwd,
				'name' => $data['name'],
				'phone' => $data['phone'],
				'id_provinsi' => $data['id_provinsi'],
				'id_kabupaten' => $data['id_kabupaten'],
				'date_change' => date('Y-m-d H:i:s')
			);
		} else {
			$fotoLama=$this->db->get_where('tb_user', array('id_user' => $id_user))->row()->foto;
			$path=config_item('link_foto_user').'/'.$fotoLama;

			if($fotoLama=="noimage.png" || $fotoLama=="noimage.jpg" || $fotoLama=="no_image.png"){

			}else{
				if(file_exists($path)){
						unlink($path);
				}
			}


			$value=array(
			 'id_type_user' => $data['type_user'],
			 'username' => $data['username'],
			 'pwd' => $data['password'],
			 'name' => $data['name'],
			 'phone' => $data['phone'],
			 'foto' => $data['foto_user'],
			 'id_provinsi' => $data['id_provinsi'],
			 'id_kabupaten' => $data['id_kabupaten'],
			 'date_change' => date('Y-m-d H:i:s')
		 );

		}
		$this->db->update('tb_user', $value, array('id_user' => $id_user));
		echo "sukses";

	}

	public function HapusPengguna($id){
		if ($this->db->delete('tb_user', array('id_user' => $id))){
			echo "sukses";
		} else {
			echo "gagal";
		}


	}
	//end query pengguna

	//query company
	public function UpdateDataPerusahaan($id_company,$namaPerusahaan,$email,$website,$visi,$misi,$lat,$long,$phone,$phone2,$pc_name,$alamat){
		$value=array(
			'company_name' => $namaPerusahaan,
			'address' => $alamat,
			'pc_name' => $pc_name,
			'phone' => $phone,
			'phone2' => $phone2,
			'website' => $website,
			'latitude' => $lat,
			'longitude' => $long,
			'visi' => $visi,
			'email' => $email,
			'misi' => $misi,
		);
		$aksi=$this->db->update('tb_company', $value, array('id_company' => $id_company));
		if ($aksi) {
			echo "sukses";
		} else {
			echo "gagal";
		}
	}
	//end query company

	//query news
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

		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
	}

	public function AksiEditBerita($judul,$desc,$link_gmbr,$link_web,$status,$id_news){
		$value=array(
			'title' => $judul,
			'desc' => $desc,
			'url_website' => $link_web,
			'url_img_header' => $link_gmbr,
			'status' => $status,
			'change_date' => date('Y-m-d H:i:s')
		);
		$q=$this->db->update('tb_news',$value,array('id_news' => $id_news));
		if ($q) {
			echo "sukses";
		} else {
			echo "gagal";
		}
	}

	public function DeleteBerita($id) {
		$q=$this->db->query("delete from tb_news where id_news=".$id);
		if ($q) {
			echo "sukses";
		} else {
			echo "gagal";
		}

	}
	//end query news

	//query daerah
	public function InsertProvinsi($prov) {
		$value=array(
			'name' => $prov
		);
		$q=$this->db->insert('tb_provinsi',$value);

		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
	}

	public function InsertKabupaten($kab,$id_prov) {
		$value=array(
			'id_provinsi' => $id_prov,
			'name' => $kab
		);
		$q=$this->db->insert('tb_kabupaten',$value);

		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
	}

	public function InsertKecamatan($kec,$id_kab) {
		$value=array(
			'id_kabupaten' => $id_kab,
			'name' => $kec
		);
		$q=$this->db->insert('tb_kecamatan',$value);

		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
	}

	public function InsertKelurahan($kel,$id_kec) {
		$value=array(
			'id_kecamatan' => $id_kec,
			'name' => $kel
		);
		$q=$this->db->insert('tb_kelurahan',$value);

		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
	}

	public function EditProvinsi($prov,$id_prov) {
		$value=array(
			'name' => $prov
		);
		$q=$this->db->update('tb_provinsi',$value,array('id_provinsi' => $id_prov));

		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
	}

	public function EditKabupaten($kab,$id_kab) {
		$value=array(
			'name' => $kab
		);
		$q=$this->db->update('tb_kabupaten',$value,array('id_kabupaten' => $id_kab));

		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
	}

	public function EditKecamatan($kec,$id_kec) {
		$value=array(
			'name' => $kec
		);
		$q=$this->db->update('tb_kecamatan',$value,array('id_kecamatan' => $id_kec));

		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
	}

	public function EditKelurahan($kel,$id_kel) {
		$value=array(
			'name' => $kel
		);
		$q=$this->db->update('tb_kelurahan',$value,array('id_kelurahan' => $id_kel));

		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
	}
	//end query daerah

    // query pemilihan
    public function InsertPemilihan($is_pilbub,$is_pilgub,$status,$tgl_pemilihan){
    	$date = $tgl_pemilihan;
		$result=date("Y-m-d", strtotime($date));
    	$value=array(
			'tgl_pemilihan' => $result,
			'is_pilgub' => $is_pilgub,
			'is_pilbub' => $is_pilbub,
			'status' => $status
		);
		$q=$this->db->insert('tb_pemilihan',$value);

		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }

    public function EditPemilihan($is_pilbub,$is_pilgub,$status,$tgl_pemilihan,$id_pemilihan) {
    	$date = $tgl_pemilihan;
		$result=date("Y-m-d", strtotime($date));
		$value=array(
			'tgl_pemilihan' => $result,
			'is_pilgub' => $is_pilgub,
			'is_pilbub' => $is_pilbub,
			'status' => $status
		);
		$q=$this->db->update('tb_pemilihan',$value,array('id_pemilihan' => $id_pemilihan));

		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
	}

    public function insertCalon($c_utama,$c_wakil,$tipe_pengusung,$partai,$provinsi,$kabupaten,$visi,$misi,$nama_paket,$foto_utama,$foto_wakil,$id_pemilihan){
    	$value=array(
			'nama_calon_utama' => $c_utama,
			'nama_calon_wakil' => $c_wakil,
			'foto_utama' => $foto_utama,
			'foto_wakil' => $foto_wakil,
			'jenis_pengusung' => $tipe_pengusung,
			'visi' => $visi,
			'misi' => $misi,
			'nama_paket' => $nama_paket,
			'id_provinsi' => $provinsi,
			'id_kabupaten' => $kabupaten,
			'id_pemilihan' => $id_pemilihan,
		);
		$q=$this->db->insert('tb_calon',$value);
		$id_calon=$this->db->insert_id();

		if ($q){
			$this->InsertPartaiPengusung($id_calon,$partai);
		} else {
			echo "gagal";
		}
    }
    public function UpdateCalon($c_utama,$c_wakil,$tipe_pengusung,$partai,$provinsi,$kabupaten,$visi,$misi,$nama_paket,$foto_utama,$foto_wakil,$id_pemilihan,$id_calon){
    	$fotoLamaUtama=$this->db->get_where('tb_calon', array('id_calon' => $id_calon))->row()->foto_utama;
    	$fotoLamaWakil=$this->db->get_where('tb_calon', array('id_calon' => $id_calon))->row()->foto_wakil;
		$path1=config_item('link_foto_calon').'/'.$fotoLamaUtama;
		$path2=config_item('link_foto_calon').'/'.$fotoLamaWakil;
    	if ($foto_utama=='false_file' && $foto_wakil !='false_file') {
    		unlink($path1);
			unlink($path2);
    		$value=array(
				'nama_calon_utama' => $c_utama,
				'nama_calon_wakil' => $c_wakil,
				// 'foto_utama' => $foto_utama,
				'foto_wakil' => $foto_wakil,
				'jenis_pengusung' => $tipe_pengusung,
				'visi' => $visi,
				'misi' => $misi,
				'nama_paket' => $nama_paket,
				'id_provinsi' => $provinsi,
				'id_kabupaten' => $kabupaten,
			);
    	} else if ($foto_utama !='false_file' && $foto_wakil =='false_file') {
    		unlink($path1);
			unlink($path2);
    		$value=array(
				'nama_calon_utama' => $c_utama,
				'nama_calon_wakil' => $c_wakil,
				'foto_utama' => $foto_utama,
				//'foto_wakil' => $foto_wakil,
				'jenis_pengusung' => $tipe_pengusung,
				'visi' => $visi,
				'misi' => $misi,
				'nama_paket' => $nama_paket,
				'id_provinsi' => $provinsi,
				'id_kabupaten' => $kabupaten,
			);
    	} else if ($foto_utama =='false_file' && $foto_wakil =='false_file') {
    		$value=array(
				'nama_calon_utama' => $c_utama,
				'nama_calon_wakil' => $c_wakil,
				//'foto_utama' => $foto_utama,
				//'foto_wakil' => $foto_wakil,
				'jenis_pengusung' => $tipe_pengusung,
				'visi' => $visi,
				'misi' => $misi,
				'nama_paket' => $nama_paket,
				'id_provinsi' => $provinsi,
				'id_kabupaten' => $kabupaten,
			);
    	} else {
    		unlink($path1);
			unlink($path2);
    		$value=array(
				'nama_calon_utama' => $c_utama,
				'nama_calon_wakil' => $c_wakil,
				'foto_utama' => $foto_utama,
				'foto_wakil' => $foto_wakil,
				'jenis_pengusung' => $tipe_pengusung,
				'visi' => $visi,
				'misi' => $misi,
				'nama_paket' => $nama_paket,
				'id_provinsi' => $provinsi,
				'id_kabupaten' => $kabupaten,
			);
    	}

		$q=$this->db->update('tb_calon',$value,array('id_calon' => $id_calon));

		if ($q){
			echo "sukses";
		} else {
			echo "gagal";
		}
    }

    public function InsertPartaiPengusung($id_calon,$partai){
    	$string = $partai;
		$tags = explode(',',$string);
		$count =count($tags);

    	for ($i=0; $i < $count ; $i++) {
    		$this->db->query("insert into tb_partai_pengusung values ('','$id_calon','".$tags[$i]."')");
    	}
    	echo 'sukses';
    }

    public function GetPartaiPengusung($id_calon){
    	$q=$this->db->get_where('tb_partai_pengusung', array('id_calon' => $id_calon));
    	return $q;
    }
    // end query pemilihan

    // query quickcount
    public function MoveQuickcountToLive($id){

			$delete=$this->db->query("delete from tb_hasil_live where id_hasil_temp=".$id);

    	$query = $this->db->query('INSERT
    		tb_hasil_live (
    		id_hasil_temp,
    		id_tps,
    		id_pemilihan,
    		suara_valid,
    		suara_invalid,
    		total_suara,
    		foto_c1,
    		date_create,
    		date_confirm,
    		confirm_who,
    		note,kode_input)

	        SELECT
	        id_hasil_temp,
	        id_tps,
	        id_pemilihan,
	        suara_valid,
	        suara_invalid,
	        total_suara,
	        foto_c1,
	        "'.date("Y-m-d H:i:s").'",
	        "'.date("Y-m-d H:i:s").'",
	        '.$this->session->userdata('id_user').',
	        note,kode_input
           FROM tb_hasil_temp
           WHERE id_hasil_temp = '.$id);
    	if ($query){

			$value=array(
				'status' => 'CONFIRM',
				'date_confirm' => date('Y-m-d H:i:s'),
				'confirm_who' => $this->session->userdata('id_user'),
			);
			$query2=$this->db->update('tb_hasil_temp',$value,array('id_hasil_temp' => $id));

			if ($query2){
				echo "sukses";
			} else {
				echo "gagal ";
			}
		} else {
			echo "gagal ";
		}
    }

    public function RejectQuickCount($id){
    	$value=array(
			'status' => 'REJECT',
			'date_confirm' => date('Y-m-d H:i:s')
		);
		$q=$this->db->update('tb_hasil_temp',$value,array('id_hasil_temp' => $id));
		if ($q){
			 // add by GA. untuk menyatakan Penginputan di batalkan.
			 $q=$this->db->query('delete from tb_hasil_calon where id_tps in (select id_tps from tb_hasil_temp where id_hasil_temp='.$id.')');
			echo "sukses";
		} else {
			echo "gagal ";
		}

    }
    // end query quickcount

    //  query partai
    public function TambahPartai($nama_partai,$img){
    	$value=array(
			'nama_partai' => $nama_partai,
			'img_logo' => $img
		);
		$q=$this->db->insert('tb_partai',$value);

		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }

    public function EditPartai($nama_partai,$img,$id){
    	if ($img=='no_upload') {
    		$value=array(
				'nama_partai' => $nama_partai,
			);
    	} else {
    		$Fotolama=$this->db->get_where('tb_partai', array('id_partai' => $id))->row()->img_logo;
			$path1=config_item('link_foto_partai').'/'.$Fotolama;
			unlink($path1);
	    	$value=array(
				'nama_partai' => $nama_partai,
				'img_logo' => $img,
			);
    	}

		$q=$this->db->update('tb_partai',$value,array('id_partai' => $id));
		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }
    //  endquery partai

    //query sertting
    public function InsertSetting($kategori,$sub_kategori,$value,$value2,$val2_type,$isDelete){
    	$value=array(
			'kategori' => $kategori,
			'sub_kat' => $sub_kategori,
			'value' => $value,
			'value2' => $value2,
			'val2_type' => $val2_type,
			'isdeleted' => $isDelete
		);
		$q=$this->db->insert('tb_setting',$value);
		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }

    public function EditSetting($id_setting,$kategori,$sub_kategori,$value,$value2,$val2_type){
    	if ($val2_type=='IMAGE' && $value2=='false_image') {
	    	$value=array(
				'kategori' => $kategori,
				'sub_kat' => $sub_kategori,
				'value' => $value,
				'val2_type' => $val2_type,
			);
    	} else {
					$Fotolama=$this->db->get_where('tb_setting', array('id' => $id_setting))->row()->value2;

				if($kategori=="SLIDE_HOME"){
					$path1=config_item('link_foto_himbauan').'/'.$Fotolama;
				}else {
					$path1=config_item('link_foto_setting').'/'.$Fotolama;
				}

				unlink($path1);

	    	$value=array(
				'kategori' => $kategori,
				'sub_kat' => $sub_kategori,
				'value' => $value,
				'value2' => $value2,
				'val2_type' => $val2_type,
			);
		}
    	$q=$this->db->update('tb_setting',$value,array('id' => $id_setting));
    	if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }
    //end setting

    //query himbauan
    public function TambahHimbauan($judul,$desc,$link_gambar,$link_website,$status){
    	$value=array(
			'title' => $judul,
			'desc' => $desc,
			'url_img' => $link_gambar,
			'url_website' => $link_website,
			'status' => $status,
			'date' => date('Y-m-d H:i:s')
		);
		$q=$this->db->insert('tb_announcement',$value);
		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }

    public function EditHimbauan($id,$judul,$desc,$link_gambar,$link_website,$status){

    	if ($link_gambar=='false_upload') {
    		$value=array(
			'title' => $judul,
			'desc' => $desc,
			'url_website' => $link_website,
			'status' => $status
		);
    	} else {
    	$Fotolama=$this->db->get_where('tb_announcement', array('id' => $id))->row()->url_img;
		$path1=config_item('link_foto_himbauan').'/'.$Fotolama;
		unlink($path1);
	    	$value=array(
				'title' => $judul,
				'desc' => $desc,
				'url_img' => $link_gambar,
				'url_website' => $link_website,
				'status' => $status
			);
		}
		$q=$this->db->update('tb_announcement',$value,array('id' => $id));
		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }
    //end query himbauan

    //query TPS
    public function TambahTps($data){
    	$value=array(
			'no_tps' => $data['no_tps'],
			'ketua_tps' => $data['ketua_tps'],
			'id_provinsi' => $data['provinsi'],
			'id_kabupaten' => $data['kabupaten'],
			'id_kecamatan' => $data['kecamatan'],
			'id_kelurahan' => $data['kelurahan'],
			'latitude' => $data['latitude'],
			'longitude' => $data['longitude'],
			'create_date' => date('Y-m-d H:i:s'),
			'id_pemilihan' => $data['tgl_pemilihan']
		);
		$q=$this->db->insert('tb_tps',$value);
		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }

    public function UpdateTps($data){
    	$id_tps=$data['id_tps'];
    	$value=array(
			'no_tps' => $data['no_tps'],
			'ketua_tps' => $data['ketua_tps'],
			'id_provinsi' => $data['provinsi'],
			'id_kabupaten' => $data['kabupaten'],
			'id_kecamatan' => $data['kecamatan'],
			'id_kelurahan' => $data['kelurahan'],
			'latitude' => $data['latitude'],
			'longitude' => $data['longitude'],
			'id_pemilihan' => $data['tgl_pemilihan'],
			'change_date' => date('Y-m-d H:i:s')
		);
		$q=$this->db->update('tb_tps',$value,array('id_tps' => $id_tps));
		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }

    public function InsertPetugas($petugas,$id_tps){
    	$id_pemilihan=$this->db->get_where('tb_tps', array('id_tps' => $id_tps))->row()->id_pemilihan;
    	$value=array(
			'id_tps' => $id_tps,
			'id_petugas' => $petugas,
			'id_pemilihan' => $id_pemilihan,
			'create_date' => date('Y-m-d H:i:s')
		);
		$q=$this->db->insert('tb_tps_petugas',$value);
		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }

    public function UpdatePetugas($petugas,$id_petugas_tps){
    	$value=array(
			'id_petugas' => $petugas,
			'change_date' => date('Y-m-d H:i:s')
		);
		$q=$this->db->update('tb_tps_petugas',$value,array('id_tps_petugas' => $id_petugas_tps));
		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }
    //end query TPS

	//query lokasi kantor

    public function InsertLokasiKantor($nama_kantor,$alamat_kantor,$telp,$status,$input_lat,$input_lng,$jenis_kantor){
    	$value=array(
			'jenis_kantor' => $jenis_kantor,
			'nama_kantor' => $nama_kantor,
			'alamat' => $alamat_kantor,
			'telp' => $telp,
			'latitude' => $input_lat,
			'longitude' => $input_lng,
			'status' => $status
		);
		$q=$this->db->insert('tb_lokasi_kantor',$value);
		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }

    public function UpdateLokasiKantor($nama_kantor,$alamat_kantor,$telp,$status,$input_lat,$input_lng,$jenis_kantor,$id_kantor){
    	$value=array(
			'jenis_kantor' => $jenis_kantor,
			'nama_kantor' => $nama_kantor,
			'alamat' => $alamat_kantor,
			'telp' => $telp,
			'latitude' => $input_lat,
			'longitude' => $input_lng,
			'status' => $status
		);
		$q=$this->db->update('tb_lokasi_kantor',$value,array('id' => $id_kantor));
		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }

	//end query lokasi kantor

    public function UpdatePemilihanGlobal($id_provinsi,$id_kabupaten,$id_pemilihan){
    	$value=array(
			'id_pemilihan' => $id_pemilihan
		);
		if ($id_provinsi=='semua'){
			$q=$this->db->update('tb_tps',$value);
		} else if($id_provinsi!='semua' && $id_kabupaten=='semua') {
			$q=$this->db->update('tb_tps',$value,array('id_provinsi' => $id_provinsi));
		}else if($id_provinsi!='semua' && $id_kabupaten!='semua') {
			$q=$this->db->update('tb_tps',$value,array('id_provinsi' => $id_provinsi,'id_kabupaten' => $id_kabupaten));
		}


		if ($q){
			echo "sukses";
		} else {
			echo "gagal ";
		}
    }

    public function InsertLogBroadcast($pesan,$tipe,$respons){
    	$value=array(
			'pesan' => $pesan,
			'tipe' => $tipe,
			'respon_firebase' => $respons,
			'create_date' => date('Y-m-d H:i:s')
		);
		$q=$this->db->insert('tb_log_pesan_firebase',$value);

		return $q;
    }

    public function InsertDataBroatcast($jenis_bc,$judul,$pesan,$url_img,$url_web,$status){
    	$value=array(
			'jenis_broadcast' => $jenis_bc,
			'judul' => $judul,
			'pesan' => $pesan,
			'url_img' => $url_img,
			'url_web' => $url_web,
			'status' => 'Y',
			'create_who' => $this->session->userdata('username'),
			'create_date' => date('Y-m-d H:i:s')
		);
		$q=$this->db->insert('tb_data_broadcast',$value);

		return $q;
    }
}
?>
