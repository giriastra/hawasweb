<!--   <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css"> -->
<link link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
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
                        <th scope="col" style="width: 10px">No</th>
                        <th scope="col"style="width: 100px">Tgl pemilihan</th>                        
                        <th scope="col"style="width: 50px">Pilgub</th>                        
                        <th scope="col"style="width: 50px">Pilbub</th>                        
                        <th scope="col"style="width: 50px">Status</th>                        
                        <th scope="col" style="width: 140px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php 
                      $no=0;
                      foreach ($this->model_global->getDataGlobal('tb_pemilihan')->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><?=$this->model_global->tgl_indo($row['tgl_pemilihan'])?></td>                       
                        <td><?=($row['is_pilgub']=='false') ? '<i class="la la-close danger"></i>' : '<i class="la la-check success"></i>' ;?></td>                       
                        <td><?=($row['is_pilbub']=='false') ? '<i class="la la-close danger"></i>' : '<i class="la la-check success"></i>' ;?></td>                       
                        <td><?=($row['status']=='Y') ? '<b class="success">Aktif</b>' : '<b class="danger">Tidak Aktif</b>' ;?></td>                       
                        <td style="width: 300px;">
                          <center>
                          <a href="<?=base_url()?>calon/<?=$row['id_pemilihan']?>"><button class="btn btn-success" data-toggle="modal"><i class="la la-eye"></i></button></a>
                          <button class="btn btn-primary" onclick="GetDataUpdate('<?=$row['id_pemilihan']?>')" data-toggle="modal" data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" onclick="alertdel('<?=$row['id_pemilihan']?>')"><i class="la la-trash"></i></button>
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
      <h5 class="modal-title" id="exampleModalLabel">Tambah Pemilihan</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tgl pemilihan</label>              
            <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
              <input class="form-control" id="tgl_pemilihan" type="text"/>
              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>  
        </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Status</label>   
            <select class="form-control" id="status">
              <option value="">-Pilih-</option>
              <option value="Y">Aktif</option>
              <option value="N">Tidak aktif</option>
            </select>
          </div>  
          <div class="form-check form-check-inline custom-control custom-checkbox" style="float: left; cursor: pointer;">
            <input type="checkbox" class="custom-control-input" id="mode_pulbub" name="cek_mode">
            <label class="custom-control-label" for="mode_pulbub">Pilbub</label>
          </div>         
          <div class="form-check form-check-inline custom-control custom-checkbox" style="float: left; cursor: pointer;">
            <input type="checkbox" class="custom-control-input" id="mode_pilgub" name="cek_mode">
            <label class="custom-control-label" for="mode_pilgub">Pilgub</label>
          </div>             
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="tambahPemilihan()">Simpan</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Ubah Pemilihan</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tgl pemilihan</label>              
            <div id="datepicker2" class="input-group date" data-date-format="dd-mm-yyyy">
              <input class="form-control" id="tgl_pemilihan_update" type="text"/>
              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>  
        </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Status</label>   
            <select class="form-control" id="status_update">
              <option value="Y">Aktif</option>
              <option value="N">Tidak aktif</option>
            </select>
          </div>  
          <div class="form-check form-check-inline custom-control custom-checkbox" style="float: left; cursor: pointer;">
            <input type="checkbox" class="custom-control-input" id="mode_pulbub_update" name="cek_mode_update">
            <label class="custom-control-label" for="mode_pulbub_update">Pilbub</label>
          </div>         
          <div class="form-check form-check-inline custom-control custom-checkbox" style="float: left; cursor: pointer;">
            <input type="checkbox" class="custom-control-input" id="mode_pilgub_update" name="cek_mode_update">
            <label class="custom-control-label" for="mode_pilgub_update">Pilgub</label>
          </div>   
          <input type="hidden" id="id_pemilihan" name="">          
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="EditPemilihan()">Simpan</button>
    </div>
  </div>
</div>
</div>
<!--/ Global settings -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#mode_pulbub').val('false');
    $('#mode_pilgub').val('false');

    $('#mode_pulbub').click(function() {
        if ($(this).is(':checked')) {
          $("#mode_pulbub").val('true');
        } else if (!$(this).is(':checked')) {
            $("#mode_pulbub").val('false');
        }
    });  

    $('#mode_pilgub').click(function() {
        if ($(this).is(':checked')) {
          $("#mode_pilgub").val('true');
        } else if (!$(this).is(':checked')) {
            $("#mode_pilgub").val('false');
        }
    });       

    $('#mode_pulbub_update').val('false');
    $('#mode_pilgub_update').val('false');

    $('#mode_pulbub_update').click(function() {
        if ($(this).is(':checked')) {
          $("#mode_pulbub_update").val('true');
        } else if (!$(this).is(':checked')) {
            $("#mode_pulbub_update").val('false');
        }
    });  

    $('#mode_pilgub_update').click(function() {
        if ($(this).is(':checked')) {
          $("#mode_pilgub_update").val('true');
        } else if (!$(this).is(':checked')) {
            $("#mode_pilgub_update").val('false');
        }
    });   

// $('#checkbox_id').is(":checked");
// $('#checkbox_id:checked').val();
  });


  function tambahPemilihan(){
    if ($("#tgl_pemilihan").val()=='') {
      swal("Informasi","Tentukan Tanggal Pemilihan" ,"error");
    }else if ($("#status").val()=='') {
      swal("Informasi","Tentukan Status Pemilihan" ,"error");
    }else if ($("#mode_pulbub").val()=='false' && $("#mode_pilgub").val()=='false') {
      swal("Informasi","Tentukan salah satu mode pemilihan" ,"error");
    }  else {
    $("#pageloader").fadeIn();
        setTimeout(function() {
        var datasend = new FormData();
            datasend.append('is_pilbub',$('#mode_pulbub').val());         
            datasend.append('is_pilgub',$('#mode_pilgub').val());         
            datasend.append('status',$('#status').val());         
            datasend.append('tgl_pemilihan',$('#tgl_pemilihan').val());         
            $.ajax({
                url: '<?=base_url()?>Utility/InsertPemilihan',
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
            hps.append('menu','pemilihan');
            hps.append('table','tb_pemilihan');
            hps.append('where','id_pemilihan');
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
                  $("#pageloader").hide();
                  $("#tgl_pemilihan_update").val(data.tgl_pem);
                  // $("#is_pilgub_update").val(data.is_pilgub);
                  // $("#is_pilbub_update").val(data.is_pilbub);
                  $("#status_update").val(data.status);
                  $("#id_pemilihan").val(id);

                  if (data.is_pilbub=='true') {
                    $( "#mode_pulbub_update" ).prop( "checked", true );
                    $( "#mode_pulbub_update" ).val('true');
                  } else {
                    $( "#mode_pulbub_update" ).prop( "checked", false );
                    $( "#mode_pulbub_update" ).val('false');
                  }

                  if (data.is_pilgub=='true') {
                    $( "#mode_pilgub_update" ).prop( "checked", true );
                    $( "#mode_pilgub_update" ).val('true');
                  } else {
                    $( "#mode_pilgub_update" ).prop( "checked", false );
                    $( "#mode_pilgub_update" ).val('false');
                  }

                    
                },error: function(data){
                   console.log(data);
                   swal("Informasi","Gagal Terhubung Ke Server" ,"error");
                }
            });
        }, 300);
  }

  function EditPemilihan(){
  if ($('#tgl_pemilihan_update').val()=='') {
    swal("Informasi","Pilih Tanggal Pemilihan" ,"error");
  } else if ($('#status_update').val()=='') {
    swal("Informasi","Tentukan Status Pemilihan" ,"error");
  } else if ($('#mode_pulbub_update').prop( "checked")==false && $('#mode_pilgub_update').prop( "checked")==false) {
    swal("Informasi","Tentukan Mode Pemilihan " ,"error");
  } else {
  $("#pageloader").fadeIn();
      setTimeout(function() {
            var datasend = new FormData();            
           datasend.append('is_pilbub',$('#mode_pulbub_update').val());         
           datasend.append('is_pilgub',$('#mode_pilgub_update').val());         
           datasend.append('status',$('#status_update').val());         
           datasend.append('tgl_pemilihan',$('#tgl_pemilihan_update').val()); 
           datasend.append('id_pemilihan',$('#id_pemilihan').val()); 
            $.ajax({
                url: '<?=base_url()?>Utility/EditPemilihan',
                method: 'POST',
                contentType: false,
                processData: false,
                data: datasend,
                success: function(data) {
                  console.log(data);
                  $("#pageloader").fadeOut();
                  if (data=='sukses') {
                    swal("Informasi","Data Berhasil Diubah" ,"success")
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
        hps.append('tb','tb_pemilihan');
        hps.append('where','id_pemilihan');
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
</script>






 <script>$(document).ready(function () {
    $.noConflict();
    var table = $('#myTable').DataTable();
});</script>

<script type="text/javascript">
$(function () {
  $("#datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
});

$(function () {
  $("#datepicker2").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
});


  new Vue ({
  el: '#main',
  data: {
    newDate: '',
    dates: [
      {text: ''}
    ]
  },
  methods: {
    addDate: function(){
      var text = this.newDate.trim()
      if (text){
        this.dates.push({text: text})
        this.newDate = ''
      }
    },
    deleteDate(){
      
    }
  }
});
</script>