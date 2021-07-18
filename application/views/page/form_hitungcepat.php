<link link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

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
#map {
  height: 400px;
  border: 1px solid #000;
}
</style>

<!-- modal -->
<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama</label>
              <input type="text" class="form-control" id="name" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Username</label>
              <input type="text" class="form-control" id="username" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Password</label>
              <input type="password" class="form-control" id="password" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Phone</label>
              <input type="text" class="form-control" id="phone" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Upload foto</label>
                <div class="file-upload">
                  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Foto Pengguna</button>

                  <div class="image-upload-wrap">
                    <input class="file-upload-input" type='file' id="foto_user" onchange="readURL(this);" accept="image/*" />
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
            <div class="form-group">

              <label for="recipient-name" class="col-form-label">Type user</label>
              <select class="form-control" id="type_user" style="width:">
                <option value="">-Pilih-</option>
                <?php foreach ($this->db->query('select * from tb_type_user where status="Y"')->result_array() as $val) { ?>
                  <option value="<?=$val['id_type_user']?>"><?=$val['type_user']?></option>
                <?php } ?>
              </select>
            </div>
<!--             <div class="form-group">
              <label for="recipient-name" class="col-form-label">Lokasi</label>
              <div id="map"></div>
            </div> -->
            <!-- <div id="penampung"><div id="lokasi"></div></div> -->
            <input type="hidden" id="input_lat" name="" readonly="">
            <input type="hidden" id="input_lng" name="" readonly="">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="Insert()">Simpan</button>
      </div>
    </div>
  </div>
</div>
 <!-- modal -->



        <div class="content-header row" style="margin-top: ;">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title"><?=$page_name?></h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a>
                  </li>
                  <li class="breadcrumb-item active"><?=$page_name?>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

<div class="row match-height">
  <div class="col-xl-8 col-lg-8">
          <div class="card">
              <div class="card-header">
                  <input type="hidden" id="type_pemilihan" name="">
                  <h4 class="card-title" style="text-align: center;"><img src="<?=base_url()?>assets/img/logo-kotak-persegi.png" width="30px"> <b>FORM PENCARIAN DATA QUICKCOUNT</b></h4>
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


              <div class="card-body" id="form_step1">
                <p><b>Step 1 Of 2</b></p>
                <hr>
                <div class="row match-height">
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tgl pemilihan</label>
                            <select class="form-control" onchange="TrggerBTNstep1()" id="tgl_pemilihan">
                              <option value="">-Pilih-</option>
                              <?php
                                foreach ($this->model_global->getDataGlobal('tb_pemilihan',"status","Y")->result() as $rowTgl) {
                              ?>
                                <option value="<?=$rowTgl->tgl_pemilihan?>">
                                  <?=$this->model_global->tgl_indo($rowTgl->tgl_pemilihan);?>
                                </option>
                              <?php
                                }
                              ?>
                            </select>
                        </div>
                    </div>
                </div>
              </div>



              <div class="card-body" id="form_step2">
                <p><b>Step 2 Of 2</b></p>
                <hr>
                <div class="row match-height">
                  <div class="col-xl-6 col-lg-6" style="padding-left: 30px;">
                    <div class="form-group" id="Selecttion">
                    <label for="recipient-name" class="col-form-label" style="font-weight: bold;">Jenis Pemilihan</label>
                    <div class="row match-height">
                      <div class="col-xl-6 col-lg-6" style="">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="RadioPem1" name="radioJnsPemilihan" class="custom-control-input" checked>
                          <label class="custom-control-label" for="RadioPem1">PILGUB</label>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6" style="">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="RadioPem2" name="radioJnsPemilihan" class="custom-control-input">
                          <label class="custom-control-label" for="RadioPem2">PILBUB</label>
                        </div>
                      </div>
                  </div>
                </div>

                <div id="this_pilgub">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label" style="font-weight: bold;">Provinsi</label>
                      <select class="form-control" id="provPilgub">
                    </select>
                  </div>
                </div>

                <div id="this_pilbub">
                  <!-- <div class="form-group">
                    <label for="recipient-name" class="col-form-label" style="font-weight: bold;">Provinsi</label>
                      <select class="form-control" id="provPilbub" onchange="ProvinsiOnchange()">
                        <option value="">-Pilih-</option>
                        <?php
                          foreach ($this->model_global->getDataGlobal('tb_provinsi')->result() as $val) {
                        ?>
                          <option value="<?=$val->id_provinsi?>"><?=$val->name?></option>
                        <?php
                          }
                        ?>
                    </select>
                  </div> -->

                  <!-- <div class="form-group" id="form_kabupaten"> -->
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label" style="font-weight: bold;">kabupaten</label>
                      <select class="form-control" id="kabupaten">
                    </select>
                  </div>
                </div>

              </div>
             </div>

           </div>

           <div class="card-footer" id="card_footer1">
               <button class="btn btn-primary" type="button" style="display: none;" id="btnStep1" onclick="Step1Form()"> Next <i class="la la-arrow-circle-right"></i></button>
            </div>

            <div class="card-footer" id="card_footer2">
               <button class="btn btn-primary" type="button" onclick="GoLink()"> Next <i class="la la-arrow-circle-right"></i></button>
            </div>

          </div>
</div>

  <div class="col-xl-4 col-lg-4">
      <div class="card">
        <div class="card-body">
          <img src="<?=base_url()?>assets/img/logo-kotak-persegi.png" width="100%">
        </div>
      </div>
  </div>

    <div id="dataPerProv">

    </div>

</div>



<!-- modal update -->
  <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Pengguna</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Nama</label>
                <input type="text" class="form-control" value="" id="nama_update" style="">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Username</label>
                <input type="text" class="form-control" value="" id="username_update" style="">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Password</label>
                <input type="password" class="form-control" value="" id="password_update" style="">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Phone</label>
                <input type="text" class="form-control" value="" id="phone_update" style="">
              </div>
              <div class="form-group">
              <label for="recipient-name" class="col-form-label">Upload foto</label>
                <div class="file-upload2">
                  <button class="file-upload-btn2" type="button" onclick="$('.file-upload-input2').trigger( 'click' )">Foto Pengguna</button>

                  <div class="image-upload-wrap2">
                    <input class="file-upload-input2" type='file' id="foto_user_update" onchange="readURL2(this);" accept="image/*" />
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
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Type user</label>
                  <select class="form-control" id="type_user_update" style="width:">
                  <option>-Pilih-</option>
                    <?php foreach ($this->db->query('select * from tb_type_user where status="Y"')->result_array() as $val2) { ?>
                      <option value="<?=$val2['id_type_user']?>"><?=$val2['type_user']?></option>
                    <?php } ?>
                  </select>
              </div>

              <input type="hidden" id="id_pengguna" value="" name="">
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="AksiEditPengguna()">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="id_pemilihan_hide" name="">
<!-- end modal update -->
<!-- <script src="<?=base_url()?>theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script> -->
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- <script src="<?=base_url()?>theme-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script> -->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <!-- <script src="<?=base_url()?>theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script> -->
    <!-- <script src="<?=base_url()?>theme-assets/js/core/app-lite.js" type="text/javascript"></script> -->
    <script src="<?=base_url()?>assets/js/jquery-3.4.0.js"></script>


<!--/ Global settings -->

 <script>
  $(document).ready(function () {
  $.noConflict();
      $('.search-select').selectize({
          sortField: 'text'
      });
      $('#RadioPem1').prop('checked', true);
          $('#RadioPem2').prop('checked', false);
          $("#this_pilgub").show('slow');
          $("#this_pilbub").hide('slow');
          $("#type_pemilihan").val('pilgub');

     $("#form_prov").show();
     $("#form_kab").hide();
     $("#form_kab").hide();
     //$("#dataPerProv").hide();


     $("#form_step2").hide();
     $("#form_step1").show();
     $("#card_footer1").show();
     $("#card_footer2").hide();

     $("#Selecttion").hide();
     $("#this_pilgub").hide();
     $("#this_pilbub").hide();
     $("#form_kabupaten").hide();

     $('#RadioPem1').click(function() {
          $('#RadioPem1').prop('checked', true);
          $('#RadioPem2').prop('checked', false);
          $("#this_pilgub").show('slow');
          $("#this_pilbub").hide('slow');
          $("#type_pemilihan").val('pilgub');

      });
      $('#RadioPem2').click(function() {
          $('#RadioPem1').prop('checked', false);
          $('#RadioPem2').prop('checked', true);
          $("#this_pilbub").show('slow');
          $("#this_pilgub").hide('slow');
          $("#type_pemilihan").val('pilbub');
      });

  });

     function Step1Form(){
        if ($("#tgl_pemilihan").val()=='') {
          swal("Informasi","Masukkan Tanggal pemilihan" ,"error");
        } else {
          $("#pageloader").show();
          setTimeout(function() {
             var hps = new FormData();
            hps.append('tgl_pemilihan',$("#tgl_pemilihan").val());
            $.ajax({
                url   :'<?=base_url()?>Utility/step1FormPemilihan',
                method:'POST',
                contentType: false,
                processData:false,
                data  :hps,
                dataType:'json',
                success: function(data) {
                  console.log(data);
                  $("#pageloader").hide();
                  if (data.status=='gagal') {
                    swal("Informasi","Tidak ditemukan data pemilihan pada "+$("#tgl_pemilihan").val() ,"error");
                  } else {

                    $("#form_step2").show('slow');
                    $("#form_step1").hide('slow');
                    $("#card_footer1").hide();
                    $("#card_footer2").show();
                    $("#id_pemilihan_hide").val(data[0]['id_pemilihan']);
                    if (data[0]['is_pilgub']=='true' && data[0]['is_pilbub']=='false') {
                       $("#Selecttion").hide();
                       $("#this_pilgub").show();
                       $("#this_pilbub").hide();
                       $("#type_pemilihan").val('pilgub');
                       GetDataProvinsi('PILGUB');
                    } else if (data[0]['is_pilgub']=='false' && data[0]['is_pilbub']=='true') {
                       $("#Selecttion").hide();
                       $("#this_pilgub").hide();
                       $("#this_pilbub").show();
                       $("#type_pemilihan").val('pilbub');
                       GetDataProvinsi('PILBUB');
                    } else if (data[0]['is_pilgub']=='true' && data[0]['is_pilbub']=='true') {
                       $("#Selecttion").show();
                       $("#this_pilgub").show();
                       $("#this_pilbub").hide();
                       $("#type_pemilihan").val('pilgub');
                      GetDataProvinsi('ALL');
                    }
                  }

                },error: function(data){
                   console.log(data);
                   $("#pageloader").hide();
                   swal("Informasi","Gagal Terhubung Ke Server" ,"error");
                }
            });
          }, 300);

      }
    }


    function GetDataProvinsi(type){
      var hps = new FormData();
      hps.append('tgl_pemilihan',$("#tgl_pemilihan").val());
      hps.append('type',type);
      $.ajax({
          url   :'<?=base_url()?>Utility/GetdataProvinsi',
          method:'POST',
          contentType: false,
          processData:false,
          data  :hps,
          dataType:'json',
          cache:true,
          success: function(data) {
            console.log(data);
            if (type=='PILBUB') {
              $('#pi').empty();
              $('#kabupaten').append('<option value="">Pilih Kabupaten..</option>');
                for (i = 0; i < data.length; ++i) {
                    $('#kabupaten').append('<option value="'+data[i]['id_kabupaten']+'">'+data[i]['name']+'</option>');
                }
              } else if (type=='PILGUB') {
                $('#provPilgub').empty();
                $('#provPilgub').append('<option value="">Pilih Provinsi..</option>');
                  for (i = 0; i < data.length; ++i) {
                      $('#provPilgub').append('<option value="'+data[i]['id_provinsi']+'">'+data[i]['name']+'</option>');
                  }
              } else {
                //alert('123');
                getDataPilgub2();
                getDataPilbub2();
              }


          },error: function(data){
             console.log(data);
             swal("Informasi","Gagal Terhubung Ke Server" ,"error");
          }
      });
    }

    function getDataPilgub2(){
      GetDataProvinsi('PILGUB');
    }
    function getDataPilbub2(){
      GetDataProvinsi('PILBUB');
    }

    // function GetSuaraAndCart(){
    //   var hps = new FormData();
    //   hps.append('id_provinsi',$("#provPilgub").val());
    //   hps.append('id_pemilihan',$("#id_pemilihan_hide").val());
    //   $.ajax({
    //       url   :'<?=base_url()?>Pagging/GetDataSuaraPeilihan',
    //       method:'POST',
    //       contentType: false,
    //       processData:false,
    //       data  :hps,
    //       success: function(data) {
    //         console.log(data);
    //         $("#dataPerProv").html(data);
    //         ShowCart();
    //       },error: function(data){
    //          console.log(data);
    //          swal("Informasi","Gagal Terhubung Ke Server" ,"error");
    //       }
    //   });
    // }

  function ProvinsiOnchange(){
    if ($("#provPilbub").val()=='') {
        $("#form_kabupaten").hide('slow');
    } else {
      var hps = new FormData();
      hps.append('menu','kabupaten');
      hps.append('table','tb_kabupaten');
      hps.append('where','id_provinsi');
      hps.append('parameter',$("#provPilbub").val());
      $.ajax({
          url   :'<?=base_url()?>Utility/GetDataUpdate2',
          method:'POST',
          contentType: false,
          processData:false,
          data  :hps,
          dataType:'json',
          cache:true,
          success: function(data) {
            console.log(data);

            var i;
            $("#form_kabupaten").show('slow');
            $('#kabupaten').empty();
            $('#kabupaten').append('<option value="">Pilih Kabupaten..</option>');
              for (i = 0; i < data.length; ++i) {
                  $('#kabupaten').append('<option value="'+data[i]['id_kabupaten']+'">'+data[i]['name']+'</option>');
              }

          },error: function(data){
             console.log(data);
             swal("Informasi","Gagal Terhubung Ke Server" ,"error");
          }
      });
    }
  }

  function GoLink(){
    $("#pageloader").show();
    if ($("#type_pemilihan").val()=='pilgub') {
          if ($("#provPilgub").val()=='') {
            swal("Informasi","Tentukan Salah Satu Provinsi Pemilihan" ,"error");
          } else {
            window.location.href='<?=base_url()?>show_quickcount?start_form='+$("#type_pemilihan").val()+'&type_pemilihan='+$("#type_pemilihan").val()+'&id_provinsi='+$("#provPilgub").val()+'&id_pemilihan='+$("#id_pemilihan_hide").val();
          }
    } else {
           if ($("#kabupaten").val()=='') {
            swal("Informasi","Tentukan Salah Satu Kabupaten Pemilihan" ,"error");
          } else {
           window.location.href='<?=base_url()?>show_quickcount?start_form='+$("#type_pemilihan").val()+'&type_pemilihan='+$("#type_pemilihan").val()+'&id_kabupaten='+$("#kabupaten").val()+'&id_pemilihan='+$("#id_pemilihan_hide").val();;
          }
    }
  }

  function TrggerBTNstep1(){
  	$("#btnStep1").click();
  }


</script>



  <script type="text/javascript">

    $.noConflict();
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


<!--
<script type="text/javascript">
  function ShowCart(){

    // $.noConflict();

    //Get the context of the Chart canvas element we want to select
    var ctx = $("#simple-doughnut-chart");

    // Chart Options
    var chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        responsiveAnimationDuration:500,
    };

    // var jsonData1 = '<?=$resultDataQuick?>';
    // var DataSuara = JSON.parse(jsonData1);
    // console.log(DataSuara);

    // var jsonData2 = '<?=$NamaPaket?>';
    // var DataNamaPaket = JSON.parse(jsonData2);
    // console.log(DataNamaPaket);

    // for(var i = 0; i < json.length; i++) {
    //     var obj = json[i];
    // }


    // Chart Data
    var chartData = {
        labels: ['satu','dua','tiga'],
        datasets: [{
            label: "DATA QUICKCOUNT",
            data: [100,200,300],
            backgroundColor: ['#666EE8', '#28D094', '#FF4961'],
        }]
    };

    var config = {
        type: 'doughnut',

        // Chart Options
        options : chartOptions,

        data : chartData
    };

    // Create the chart
    var doughnutSimpleChart = new Chart(ctx, config);

};
</script>
 -->
