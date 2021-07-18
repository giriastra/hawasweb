<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/img_upload.css">
<style type="text/css">


body.vertical-layout[data-color=bg-chartbg] .navbar-container, body.vertical-layout[data-color=bg-chartbg] .content-wrapper-before {
    /*background-color: #000 !important;*/
    /*background-image: url('<?=base_url()?>assets/img/vector.png');*/
    background-image: linear-gradient(to right, #9f78ff, #32cafe);    
}

.content-wrapper-before {

    height: 120px !important;

}

</style>

<?php 
  $id_pemilihan=$id_parent;
  $dataPemilihan=$this->model_global->getDataGlobal('tb_pemilihan','id_pemilihan',$id_pemilihan)->row();              
?>

 
        <div class="content-header row" style="margin-top: ;">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title"><?=$page_name?></h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active"><?=$page_name?>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>


<div class="col-xl-12 col-lg-12" style="float:left">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal_insert">+ Tambah</button>
                <a class="heading-elements-toggle">
                    <i class="fa fa-ellipsis-v font-medium-3"></i>
                </a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="reload">
                                <i class="ft-rotate-cw"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 30px">No</th>
                        <th scope="col"style="width: 80px">Provinsi</th>                        
                        <th scope="col"style="width: 80px">Kabupaten</th> 
                        <th scope="col"style="width: 200px">Nama calon utama</th>                        
                        <th scope="col"style="width: 200px">Nama calon wakil</th>                        
                        <th scope="col"style="width: 200px">Jenis pengusung</th>                        
                        <th scope="col"style="width: 200px">Foto utama</th>                        
                        <th scope="col"style="width: 200px">Foto wakil</th>                        
                        <th scope="col"style="width: 200px">Visi</th>                        
                        <th scope="col"style="width: 200px">Misi</th>                        
                        <th scope="col"style="width: 200px">Nama paket</th>                        
                                              
                        <th scope="col" style="width: 170px;"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php 
                      $no=0;                     
                      foreach ($this->model_global->getDataGlobal('tb_calon','id_pemilihan',$id_pemilihan)->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                         <td><?=@$this->model_global->getDataGlobal('tb_provinsi','id_provinsi',$row['id_provinsi'])->row()->name?></td>                       
                        <td><?=@$this->model_global->getDataGlobal('tb_kabupaten','id_kabupaten',$row['id_kabupaten'])->row()->name?></td>
                        <td><?=$row['nama_calon_utama']?></td>                       
                        <td><?=$row['nama_calon_wakil']?></td>                       
                        <td><?=$row['jenis_pengusung']?></td>                       
                        <td>
                          <center>
                            <a href="<?=base_url()?>assets/upload/calon/<?=$row['foto_utama']?>" target="_blank">
                              <img src="<?=base_url()?>assets/upload/calon/<?=$row['foto_utama']?>" width="100px">
                            </a>
                          </center>
                        </td>                      
                        <td>
                          <center>
                            <a href="<?=base_url()?>assets/upload/calon/<?=$row['foto_wakil']?>" target="_blank">
                              <img src="<?=base_url()?>assets/upload/calon/<?=$row['foto_wakil']?>" width="100px">
                            </a>
                          </center>
                        </td>                       
                        <td><?=$row['visi']?></td>                       
                        <td><?=$row['misi']?></td>                       
                        <td><?=$row['nama_paket']?></td>                       
                       
                        <td style="width: 300px;">
                          <center>
                          <button class="btn btn-primary" onclick="GetDataUpdate('<?=$row['id_calon']?>')" data-toggle="modal" data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" onclick="alertdel('<?=$row['id_calon']?>')"><i class="la la-trash"></i></button>
                        </center>
                        </td>
                        </tr>
                          <?php } ?>                        
                                          
                    </tbody>
                  </table>
              </div>
            </div>
                    

        </div>
</div>

<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Calon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">          
            <div class="form-group form_type_pemilihan" id="form_type_pemilihan">
                <label for="recipient-name"  class="col-form-label">Tipe pemilihan</label>              
                <select class="form-control" onchange="TypePemilihan()" id="type_pemilihan">
                  <option value="">-Pilih-</option>
                  <option value="pilbub">PILBUB</option>
                  <option value="pilgub">PILGUB</option>
                </select>
            </div>
            <div class="form-group select_prov" id="select_prov">
              <label for="recipient-name" class="col-form-label">Provinsi</label>   
              <select class="form-control" id="provinsi">
                <option value="">-Pilih-</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_provinsi')->result_array() as $prov) { ?>
                  <option value="<?=$prov['id_provinsi']?>"><?=$prov['name']?></option>
                <?php } ?>
              </select>
            </div>             
            <div class="form-group select_kab" id="select_kab">
              <label for="recipient-name" class="col-form-label">Kabupaten</label>   
              <select class="form-control" id="kabupaten">
                <option value="">-Pilih-</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_kabupaten')->result_array() as $kab) { ?>
                  <option value="<?=$kab['id_kabupaten']?>"><?=$kab['name']?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Tipe pengusung</label>              
                <select class="form-control" onchange="isPartai()" id="tipe_pengusung">
                  <option value="">-Pilih-</option>
                  <option value="PARTAI">Partai</option>
                  <option value="INDEPENDEN">Independen</option>
                </select>
            </div>   

            <div class="form-group partaiOrIndie" id="partaiOrIndie" style="display: none;">
              <label for="recipient-name" class="col-form-label">Daftar partai</label> 
              <div class="row match-height">
                <?php 
                $no=0;
                foreach ($this->model_global->getDataGlobal('tb_partai')->result_array() as $rowPartai) { 
                $no++;
                ?>                
                  <div class="col-xl-4 col-lg-12">                
                    <div class="form-check form-check-inline custom-control custom-checkbox" style="float: ; cursor: pointer;">
                      <input type="checkbox" class="custom-control-input daftar_partai" value="<?=$rowPartai['id_partai']?>" id="partai<?=$no?>" name="daftar_partai">
                      <label class="custom-control-label" style="font-size: 11px;" for="partai<?=$no?>"><?=$rowPartai['nama_partai']?></label>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>             
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Calon utama</label>              
                <input type="text" class="form-control" id="nama_calon_utama" name="nama_calon_utama">
            </div>

            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Wakil</label>              
                <input type="text" class="form-control" id="nama_calon_wakil" name="nama_calon_wakil">
            </div>                
         
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Nama paket</label>              
                <input type="text" class="form-control" id="nama_paket" name="">
            </div>

            <div class="row match-height">
              <div class="col-xl-6 col-lg-12">
              <div class="form-group">
                <div class="file-upload">
                  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Foto Utama</button>

                  <div class="image-upload-wrap">
                    <input class="file-upload-input" type='file' id="foto_utama" onchange="readURL(this);" accept="image/*" />
                    <div class="drag-text">
                      <h3>Drag and drop a file or select add Image</h3>
                    </div>
                  </div>
                  <div class="file-upload-content">
                    <img class="file-upload-image" src="#" alt="your image" />
                    <div class="image-title-wrap">
                      <button type="button" onclick="removeUpload()" class="remove-image">Hapus</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>            

            <div class="col-xl-6 col-lg-12">
              <div class="form-group">
                <div class="file-upload2">
                  <button class="file-upload-btn2" type="button" onclick="$('.file-upload-input2').trigger( 'click' )">Foto Wakil</button>

                  <div class="image-upload-wrap2">
                    <input class="file-upload-input2" type='file' id="foto_wakil" onchange="readURL2(this);" accept="image/*" />
                    <div class="drag-text2">
                      <h3>Drag and drop a file or select add Image</h3>
                    </div>
                  </div>
                  <div class="file-upload-content2">
                    <img class="file-upload-image2" src="#" alt="your image" />
                    <div class="image-title-wrap2">
                      <button type="button" onclick="removeUpload2()" class="remove-image2">Hapus</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                        
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Visi</label>              
                <textarea id="visi" class="form-control"></textarea>
            </div>             
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Misi</label>              
                <textarea id="misi" class="form-control"></textarea>
            </div> 
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="TambahCalon()" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>


<!-- model upddate -->
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Calon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">   
        <input type="hidden" id="id_calon" name="">       
            <div class="form-group form_type_pemilihan" id="form_type_pemilihan">

                <label for="recipient-name"  class="col-form-label">Tipe pemilihan</label>              
                <select class="form-control" onchange="TypePemilihan()" id="type_pemilihan_update">
                  <option value="">-Pilih-</option>
                  <option value="pilbub">PILBUB</option>
                  <option value="pilgub">PILGUB</option>
                </select>
            </div>
            <div class="form-group select_prov" id="select_prov">
              <label for="recipient-name" class="col-form-label">Provinsi</label>   
              <select class="form-control" id="provinsi_update">
                <option value="">-Pilih-</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_provinsi')->result_array() as $prov) { ?>
                  <option value="<?=$prov['id_provinsi']?>"><?=$prov['name']?></option>
                <?php } ?>
              </select>
            </div>             
            <div class="form-group select_kab" id="select_kab">
              <label for="recipient-name" class="col-form-label">Kabupaten</label>   
              <select class="form-control" id="kabupaten_update">
                <option value="">-Pilih-</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_kabupaten')->result_array() as $kab) { ?>
                  <option value="<?=$kab['id_kabupaten']?>"><?=$kab['name']?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Tipe pengusung</label>              
                <select class="form-control" onchange="isPartai()" id="tipe_pengusung_update">
                  <option value="">-Pilih-</option>
                  <option value="PARTAI">Partai</option>
                  <option value="INDEPENDEN">Independen</option>
                </select>
            </div>   

            <div class="form-group partaiOrIndie" id="partaiOrIndie" style="display: none;">
              <label for="recipient-name" class="col-form-label">Daftar partai</label> 
              <div class="row match-height">
                <?php 
                $no=0;
                foreach ($this->model_global->getDataGlobal('tb_partai')->result_array() as $rowPartai) { 
                $no++;
                ?>                
                  <div class="col-xl-4 col-lg-12">                
                    <div class="form-check form-check-inline custom-control custom-checkbox" style="float: ; cursor: pointer;">
                      <input type="checkbox" class="custom-control-input daftar_partai_update" value="<?=$rowPartai['id_partai']?>" id="partai_update<?=$no?>" name="daftar_partai_update">
                      <label class="custom-control-label" style="font-size: 11px;" for="partai_update<?=$no?>"><?=$rowPartai['nama_partai']?></label>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>             
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Calon utama</label>              
                <input type="text" class="form-control" id="nama_calon_utama_update" name="nama_calon_utama">
            </div>

            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Wakil</label>              
                <input type="text" class="form-control" id="nama_calon_wakil_update" name="nama_calon_wakil">
            </div>                
         
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Nama paket</label>              
                <input type="text" class="form-control" id="nama_paket_update" name="">
            </div>

            <div class="row match-height">
              <div class="col-xl-6 col-lg-12">
              <div class="form-group">
                <div class="file-upload3">
                  <button class="file-upload-btn3" type="button" onclick="$('.file-upload-input3').trigger( 'click' )">Foto Utama</button>

                  <div class="image-upload-wrap3">
                    <input class="file-upload-input3" type='file' id="foto_utama_update" onchange="readURL3(this);" accept="image/*" />
                    <div class="drag-text3">
                      <h3>Drag and drop a file or select add Image</h3>
                    </div>
                  </div>
                  <div class="file-upload-content3">
                    <img class="file-upload-image3" src="#" alt="your image" />
                    <div class="image-title-wrap3">
                      <button type="button" onclick="removeUpload3()" class="remove-image3">Hapus</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>            

            <div class="col-xl-6 col-lg-12">
              <div class="form-group">
                <div class="file-upload4">
                  <button class="file-upload-btn4" type="button" onclick="$('.file-upload-input4').trigger( 'click' )">Foto Wakil</button>

                  <div class="image-upload-wrap4">
                    <input class="file-upload-input4" type='file' id="foto_wakil_update" onchange="readURL4(this);" accept="image/*" />
                    <div class="drag-text4">
                      <h3>Drag and drop a file or select add Image</h3>
                    </div>
                  </div>
                  <div class="file-upload-content4">
                    <img class="file-upload-image4" src="#" alt="your image" />
                    <div class="image-title-wrap4">
                      <button type="button" onclick="removeUpload4()" class="remove-image4">Hapus</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                        
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Visi</label>              
                <textarea id="visi_update" class="form-control"></textarea>
            </div>             
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Misi</label>              
                <textarea id="misi_update" class="form-control"></textarea>
            </div> 
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="EditCalon()" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
<!--/ Global settings -->
 <script>
  $(document).ready(function () {
    $.noConflict();
    var table = $('#myTable').DataTable();

    $(".select_prov").hide();
    $(".select_kab").hide();
    $(".form_type_pemilihan").hide();

    if ('<?=$dataPemilihan->is_pilgub?>'=='true' && '<?=$dataPemilihan->is_pilbub?>'=='true') {
        $(".form_type_pemilihan").show();
        $(".select_prov").hide();
        $(".select_kab").hide();
    } else if ('<?=$dataPemilihan->is_pilgub?>'=='true' && '<?=$dataPemilihan->is_pilbub?>'=='false') {
        $(".select_prov").show();
        $(".select_kab").hide();
    } else if ('<?=$dataPemilihan->is_pilgub?>'=='false' && '<?=$dataPemilihan->is_pilbub?>'=='true') {
        $(".select_prov").hide();
        $(".select_kab").show();
    } else {
        $(".select_prov").hide();
        $(".select_kab").hide();
    }
  });

  function TambahCalon(){
    if ($('#nama_calon_utama').val()=='') {
       swal("Informasi","Masukkan Nama Calon Utama" ,"error");
    } else if ($('#nama_calon_wakil').val()=='') {
      swal("Informasi","Masukkan Nama Wakil Calon" ,"error");
    }else if ($('#nama_paket').val()=='') {
      swal("Informasi","Masukkan Nama Paket" ,"error");
    }else if ($('.file-upload-content').is(":hidden")) {
      swal("Informasi","Masukkan Foto Calon Utama" ,"error");
    } else if ($('.file-upload-content2').is(":hidden")) {
      swal("Informasi","Masukkan Foto Wakil Calon" ,"error");
    } else if ($('#visi').val()=='') {
      swal("Informasi","Masukkan Visi Calon" ,"error");
    } else if ($('#misi').val()=='') {
      swal("Informasi","Masukkan Misi Calon" ,"error");
    } else {
        $("#pageloader").fadeIn();
        var partai=[];
        var foto_utama=$('#foto_utama')[0].files[0];
        var foto_wakil=$('#foto_wakil')[0].files[0];

        $("input[name='daftar_partai']:checked").each(function(){
            partai.push(this.value);
        });
        setTimeout(function() {
          var datasend = new FormData();
            datasend.append('c_utama',$('#nama_calon_utama').val());           
            datasend.append('c_wakil',$('#nama_calon_wakil').val());           
            datasend.append('tipe_pengusung',$('#tipe_pengusung').val());           
            datasend.append('partai',partai);           
            datasend.append('provinsi',$('#provinsi').val());           
            datasend.append('kabupaten',$('#kabupaten').val());           
            datasend.append('visi',$('#visi').val());           
            datasend.append('misi',$('#misi').val());           
            datasend.append('nama_paket',$('#nama_paket').val());           
            datasend.append('foto_utama',foto_utama);           
            datasend.append('foto_wakil',foto_wakil);           
            datasend.append('id_pemilihan','<?=$id_pemilihan?>');           
            $.ajax({
                url: '<?=base_url()?>Utility/InsertCalon',
                method: 'POST',
                contentType: false,
                processData: false,
                data: datasend,
                success: function(data) {
                  console.log(data);
                   $("#pageloader").fadeOut();
                  if (data=='sukses') {
                    swal("Informasi","Data Berhasil Ditambahkan" ,"success")
                    .then((value) => {
                      window.location.reload();
                    });
                  } else {
                    swal("Informasi","Terjadi Kesalahan Mohon Coba Beberapa Saat Lagi" ,"error");
                  }                   
                },
                error: function(data) {
                  console.log(data);
                  $("#pageloader").hide();               
                    swal("Informasi","Gagal Terhubung Ke Server" ,"error");
                }
            }); 
      }, 300);
    }
  }

  function GetDataUpdate(id) {
     $("#pageloader").fadeIn();
      setTimeout(function() {
        var hps = new FormData();
            hps.append('menu','calon');
            hps.append('table','tb_calon');
            hps.append('where','id_calon');
            hps.append('parameter',id);
            $.ajax({
                url   :'<?=base_url()?>Utility/GetDataUpdate',
                method:'POST',
                contentType: false,      
                processData:false, 
                data  :hps,
                dataType:'json',
                cache:true,
                success: function(data) {
                  console.log(data);
                  $("#type_pemilihan_update").val(data.judul);

                  $("#provinsi_update").val(data.id_provinsi);                  
                  $("#kabupaten_update").val(data.id_kabupaten);
                  $("#tipe_pengusung_update").val(data.jenis_pengusung);
                  $("#nama_calon_utama_update").val(data.nama_calon_utama);
                  $("#nama_calon_wakil_update").val(data.nama_calon_wakil);
                  $("#nama_paket_update").val(data.nama_paket);
                  $("#visi_update").val(data.visi);
                  $("#misi_update").val(data.misi);
                  $("#id_calon").val(id);  

                  $('.file-upload-image3').attr('src', "<?=base_url()?>assets/upload/calon/"+data.foto_utama);       
                  $('.image-upload-wrap3').hide();
                  $('.file-upload-content3').show();                   

                  $('.file-upload-image4').attr('src', "<?=base_url()?>assets/upload/calon/"+data.foto_wakil);       
                  $('.image-upload-wrap4').hide();
                  $('.file-upload-content4').show(); 

                  if ('<?=$dataPemilihan->is_pilgub?>'=='true' && '<?=$dataPemilihan->is_pilbub?>'=='true') {
                      $(".form_type_pemilihan").show();
                      $(".select_prov").hide();
                      $(".select_kab").hide();
                      var valTipe;
                      var prov=data.id_provinsi;
                      var kab=data.id_kabupaten;
                      if (prov != 0) {
                        valTipe='pilgub';
                      } else if (kab != 0) {
                        valTipe='pilbub';
                      }
                      $("#type_pemilihan_update").val(valTipe);
                      TypePemilihan(valTipe);
                  } else if ('<?=$dataPemilihan->is_pilgub?>'=='true' && '<?=$dataPemilihan->is_pilbub?>'=='false') {
                      $(".select_prov").show();
                      $(".select_kab").hide();
                      $(".form_type_pemilihan").hide();
                  } else if ('<?=$dataPemilihan->is_pilgub?>'=='false' && '<?=$dataPemilihan->is_pilbub?>'=='true') {
                      $(".select_prov").hide();
                      $(".select_kab").show();
                      $(".form_type_pemilihan").hide();
                  } else {
                      $(".select_prov").hide();
                      $(".form_type_pemilihan").hide();
                      $(".select_kab").hide();
                  }

                  var IsPartai=data.jenis_pengusung;
                  if (IsPartai=='PARTAI') {
                      $(".partaiOrIndie").show('slow');
                  } else {
                    $(".partaiOrIndie").hide('slow');
                  }

                  PartaiChecked(id);

                },error: function(data){
                   console.log(data);
                   $("#pageloader").fadeOut();
                   swal("Informasi","Gagal Terhubung Ke Server" ,"error");
                }
            });
        }, 300);
  }

  function PartaiChecked(id){
    var hps = new FormData();
    hps.append('id_calon',id);
    $.ajax({
        url   :'<?=base_url()?>Utility/GetPartaiChecked',
        method:'POST',
        contentType: false,      
        processData:false, 
        data  :hps,
        dataType:'json',
        cache:true,
        success: function(data) {
          console.log(data);
          for (var i = 0; i < data.length; i++) {
            $(".daftar_partai_update[value="+data[i]['id_partai']+"]").prop('checked', true);
          }
          $("#pageloader").fadeOut(); 
                  
            
        },error: function(data){
          $("#pageloader").fadeOut();
           console.log(data);
           swal("Informasi","Gagal Terhubung Ke Server" ,"error");
        }
    });
}

function EditCalon(){
  var partai=[];
  var foto_utama=$('#foto_utama_update')[0].files[0];
  var foto_wakil=$('#foto_wakil_update')[0].files[0];

  $("input[name='daftar_partai_update']:checked").each(function(){
      partai.push(this.value);
  });
  if ($('#judul_update').val()=='') {
    swal("Informasi","Masukkan Judul Berita" ,"error");
  } else {
  $("#pageloader").fadeIn();
      setTimeout(function() {
          var datasend = new FormData();            
          datasend.append('id_calon',$('#id_calon').val());           
          datasend.append('c_utama',$('#nama_calon_utama_update').val());           
          datasend.append('c_wakil',$('#nama_calon_wakil_update').val());           
          datasend.append('tipe_pengusung',$('#tipe_pengusung_update').val());           
          datasend.append('partai',partai);           
          datasend.append('provinsi',$('#provinsi_update').val());           
          datasend.append('kabupaten',$('#kabupaten_update').val());           
          datasend.append('visi',$('#visi_update').val());           
          datasend.append('misi',$('#misi_update').val());           
          datasend.append('nama_paket',$('#nama_paket_update').val());           
          datasend.append('foto_utama',foto_utama);           
          datasend.append('foto_wakil',foto_wakil);           
          datasend.append('id_pemilihan','<?=$id_pemilihan?>');          
            $.ajax({
                url: '<?=base_url()?>Utility/AksiEditCalon',
                method: 'POST',
                contentType: false,
                processData: false,
                data: datasend,
                success: function(data) {
                  console.log(data);
                  $("#pageloader").fadeOut();
                  if (data=='sukses') {
                    swal("Informasi","Pengguna Berhasil Diubah" ,"success")
                    .then((value) => {
                      window.location.reload();
                    });
                  } else {
                    swal("Informasi","Terjadi Kesalahan Mohon Coba Beberapa Saat Lagi" ,"error");
                  }                                     
                },
                error: function(data) {
                  console.log(data);
                  $("#pageloader").hide();               
                    swal("Informasi","Gagal Terhubung Ke Server" ,"error");
                }
            }); 
      }, 300);
    }
}

  function alertdel(id){
     swal({
          title: "Anda Yakin",
          text: "Ingin Menghapus Data Yang Dipilih?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
               AksiHapus(id)
          } else {
            return true;
          }
        });
    }

    function AksiHapus(id) {
        var hps = new FormData();
        hps.append('id',id);
        hps.append('tb','tb_calon');
        hps.append('where','id_calon');
        $.ajax({
            url   :'<?=base_url()?>Utility/DeleteGlobal',
            method:'POST',
            contentType: false,      
            processData:false, 
            data  :hps,
            success: function(data) {
              console.log(data);
              if (data=='sukses') {
                location.reload();
              } else {
                swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }
                
            },error: function(data){
               console.log(data);
               swal("Informasi","Gagal Terhubung Ke Server" ,"error");
            }
        });
    }

  function isPartai(){
    if ($("#tipe_pengusung").val()=='PARTAI') {
        $(".partaiOrIndie").show('slow');
    } else {
       $(".partaiOrIndie").hide('slow');
    }
  }

  function TypePemilihan(type=''){
    if ($("#type_pemilihan").val()=='pilbub' || type=='pilbub') {
       $(".select_prov").hide('slow');
       $(".select_kab").show('slow');
    } else if ($("#type_pemilihan").val()=='pilgub' || type=='pilgub') {
      $(".select_prov").show('slow');
      $(".select_kab").hide('slow');
    } else {
      $(".select_prov").hide('slow');
      $(".select_kab").hide('slow');
    }
  }
  </script>


  <script type="text/javascript">
  function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});

  </script>  

  <script type="text/javascript">
    function readURL2(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap2').hide();

      $('.file-upload-image2').attr('src', e.target.result);
      $('.file-upload-content2').show();

      $('.image-title2').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload2();
  }
}

function removeUpload2() {
  $('.file-upload-input2').replaceWith($('.file-upload-input2').clone());
  $('.file-upload-content2').hide();
  $('.image-upload-wrap2').show();
}
$('.image-upload-wrap2').bind('dragover', function () {
    $('.image-upload-wrap2').addClass('image-dropping2');
  });
  $('.image-upload-wrap2').bind('dragleave', function () {
    $('.image-upload-wrap2').removeClass('image-dropping2');
});

  </script>

  <script type="text/javascript">
    function readURL3(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap3').hide();

      $('.file-upload-image3').attr('src', e.target.result);
      $('.file-upload-content3').show();

      $('.image-title3').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload3();
  }
}

function removeUpload3() {
  $('.file-upload-input3').replaceWith($('.file-upload-input3').clone());
  $('.file-upload-content3').hide();
  $('.image-upload-wrap3').show();
}
$('.image-upload-wrap3').bind('dragover', function () {
    $('.image-upload-wrap3').addClass('image-dropping3');
  });
  $('.image-upload-wrap3').bind('dragleave', function () {
    $('.image-upload-wrap3').removeClass('image-dropping3');
});

  </script>

  <script type="text/javascript">
    function readURL4(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap4').hide();

      $('.file-upload-image4').attr('src', e.target.result);
      $('.file-upload-content4').show();

      $('.image-title4').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload4();
  }
}

function removeUpload4() {
  $('.file-upload-input4').replaceWith($('.file-upload-input4').clone());
  $('.file-upload-content4').hide();
  $('.image-upload-wrap4').show();
}
$('.image-upload-wrap4').bind('dragover', function () {
    $('.image-upload-wrap4').addClass('image-dropping4');
  });
  $('.image-upload-wrap4').bind('dragleave', function () {
    $('.image-upload-wrap4').removeClass('image-dropping4');
});

  </script>