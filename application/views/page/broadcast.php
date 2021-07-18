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
            <h3 class="content-header-title">Forum</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Forum
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>


<div class="col-xl-12 col-lg-12" style="float:left">
        <div class="card">
            <div class="card-header">
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
              <div class="row match-height">
                  <div class="col-xl-6 col-lg-6">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label" style="font-weight: bold;"><i class="la la-sliders"></i> Jenis Broadcast</label>
                        <select class="form-control" id="jenis_broadcast">
                          <option value="">-Pilih-</option>
                          <option value="USER">BroadCast Users</option>
                          <option value="PETUGAS">BroadCast Petugas</option>
                          <option value="UMUM">BroadCast Umum</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label" style="font-weight: bold;"><i class="la la-behance"></i> Judul</label>
                      <input type="text" class="form-control" id="judul_bc" placeholder="Masukkan judul pesan" style="width:">
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label" style="font-weight: bold;"><i class="la la-image"></i> URL Gambar (opsional)</label>
                      <input type="text" class="form-control" value="" id="urlGambar_bc" style="width:">
                    </div> 
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label" style="font-weight: bold;"><i class="la la-link"></i> URL Website (opsional)</label>
                      <input type="text" class="form-control" value="" id="urlWeb_bc" style="width:">
                    </div> 
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label" style="font-weight: bold;"><i class="la la-envelope"></i> Pesan</label>
                      <textarea class="form-control" id="pesan_bc" rows="5" placeholder="Tuliskan pesan broadcast disini..."></textarea>
                    </div> 
                  </div>
                </div>
              </div>    
              <div class="card-footer">
                  <button class="btn btn-primary" onclick="SyncData()" id="btn_sync"><i class="la la-refresh"></i> Sync data</button>
                  <span id="loadersync"><b><i class="la la-spinner la-spin" style="color: #6b9ffe"></i> Sedang Sinkronasi Data Mohon Tunggu..</b></span>
              </div>              
             </div>

</div>

<div class="col-xl-12 col-lg-12" style="float:left" id="card_data_bc">
        <div class="card">
              <div class="card-body">
                  <center>
                    <button class="btn btn-success" style="min-width: 100px">Terkirim : <span id="countSukses">0</span></button>
                    <button class="btn btn-danger" style="min-width: 100px">Gagal : <span id="countgagal">0</span></button>
                  </center>
              </div>                    
         </div>
        <div class="card">
              <div class="card-body" id="data_bc">
                  
              </div>    
              <div class="card-footer">
                  <button class="btn btn-success" onclick="CountBC('animation_true','none')" id="btn_sendBC"><i class="la la-rocket"></i> Kirim BroadCast</button>
              </div>     
         </div>

</div>
<input type="hidden" id="jenis_bc_terpilih" name="">
<!--/ Global settings -->
 <script>
  $(document).ready(function () {
      $.noConflict();
      var table = $('#myTable_commnets').DataTable();
      $("#loadersync").hide();
      $("#card_data_bc").hide();
  });

  function SyncData(){
     if ($("#jenis_broadcast").val()=='') {
      swal("Informasi","Tentukan Salah Satu Jenis BroadCast" ,"error");
    } else if ($("#judul_bc").val()=='') {
      swal("Informasi","Masukkan Judul BroadCast" ,"error");
    } else if ($("#pesan_bc").val()=='') {
      swal("Informasi","Pesan BroadCast Tidak Boleh Kosong" ,"error");
    } else {
      $("#btn_sync").hide();
      $("#loadersync").show();
      setTimeout(function() {
        var hps = new FormData();
        hps.append('jenis_broadcast',$("#jenis_broadcast").val());
        hps.append('judul_bc',$("#judul_bc").val());
        hps.append('urlGambar_bc',$("#urlGambar_bc").val());
        hps.append('urlWeb_bc',$("#urlWeb_bc").val());
        hps.append('pesan_bc',$("#pesan_bc").val());
        $.ajax({
            url   :'<?=base_url()?>Utility/SyncDataBC',
            method:'POST',
            contentType: false,      
            processData:false, 
            data  :hps,
            success: function(data) {
              console.log(data);
              if (data=='sukses') {
                 $("#btn_sync").show();
                 $("#loadersync").hide();
                 ShowDataBC($("#jenis_broadcast").val())
              } else {
                $("#btn_sync").hide();
                 $("#loadersync").show();
                swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }
                
            },error: function(data){
              $("#btn_sync").hide();
                 $("#loadersync").show();
               console.log(data);
               swal("Informasi","Gagal Terhubung Ke Server" ,"error");
            }
        });
      }, 500);
    }
  }

  function ShowDataBC(jenis_broadcast) {
        var hps = new FormData();
        hps.append('jenis_broadcast',jenis_broadcast);
        $.ajax({
            url   :'<?=base_url()?>Utility/ShowdataBc',
            method:'POST',
            contentType: false,      
            processData:false, 
            data  :hps,
            success: function(data) {
              console.log(data);
              $("#data_bc").html(data);
              $("#card_data_bc").show();
              $("#jenis_bc_terpilih").val(jenis_broadcast);              
            },error: function(data){
               console.log(data);
               swal("Informasi","Gagal Terhubung Ke Server" ,"error");
            }
        });
    }

    function CountBC(animation,status){
      if (animation=='animation_true') {
        $(".pending").addClass('la-spin');
        $(".txtpending").html('Mengirim');
      }
      if (status=='true') {
          var iSsukses=parseInt($("#countSukses").html());
          var mathSukses=iSsukses+1;   
          $("#countSukses").html(mathSukses);
      } else if (status=='false') {
          var iSgagal=parseInt($("#countgagal").html());
          var mathGagal=iSgagal+1; 
          $("#countgagal").html(mathGagal);
      }
      var hps = new FormData();
        hps.append('jenis_broadcast',$("#jenis_bc_terpilih").val());
        $.ajax({
            url   :'<?=base_url()?>Utility/CountBC',
            method:'POST',
            contentType: false,      
            processData:false, 
            data  :hps,
            dataType:'json',
            success: function(data) {
              console.log(data);
              if (data.row==0) {
               
                 swal("Informasi","Proses Pengiriman Broadcast Telah Berakhir" ,"warning");
              } else {                
                var row = data.row;
                SendBC(row);
              }            
            },error: function(data){
               console.log(data);
               swal("Informasi","Gagal Terhubung Ke Server" ,"error");
            }
        });
    }

    function SendBC(row){
     
        setTimeout(function() {
           var hps = new FormData();
            hps.append('jenis_broadcast',$("#jenis_bc_terpilih").val());
            $.ajax({
                url   :'<?=base_url()?>Utility/SendBroadCast',
                method:'POST',
                contentType: false,      
                processData:false, 
                data  :hps,
                dataType:'json',
                success: function(data) {
                  console.log(data);                  
                  var status=data.status;
                  CountBC('animation_false',status);
                  $("#icon"+data.id_bc).removeClass('la-spinner');         
                  $("#icon"+data.id_bc).removeClass('la-spin');         
                  $("#btn"+data.id_bc).removeClass('btn-primary');  

                  if (data.status=='true') {
                    $("#icon"+data.id_bc).addClass('la-check-circle'); 
                    $("#btn"+data.id_bc).addClass('btn-success');          
                    $("#txtpending"+data.id_bc).html('Terkirim');                    

                  } else {
                    $("#icon"+data.id_bc).addClass('la-times-circle'); 
                    $("#btn"+data.id_bc).addClass('btn-danger');          
                    $("#txtpending"+data.id_bc).html('Gagal');                    
                  }
                         
                },error: function(data){
                   console.log(data);
                   swal("Informasi","Gagal Terhubung Ke Server" ,"error");
                }
            });
        }, 1000);
      
    }
</script>