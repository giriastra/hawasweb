<link link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

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

.table td{
  padding:10px;
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
        <div class="col-xl-12 col-lg-12" style="float:left;">
                <div class="card">
                    <div class="card-body">
                        <div class="row col-xl-12 col-lg-12">

                          <div class="col-xl-6 col-lg-4">
                            <div class="form-group row">
                                    <label class="col-md-3 label-control"  >Kode Laporan</label>
                                    <label class="col-md-1 label-control"  >:</label>
                                    <label class="col-md-8 label-control"  ><?=$dt_complaint->code?></label>

                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 label-control"  >Nama Petugas</label>
                                    <label class="col-md-1 label-control"  >:</label>
                                    <label class="col-md-8 label-control"  ><?=$dt_complaint->nama_petugas?></label>

                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 label-control"  >Nama Pengguna</label>
                                    <label class="col-md-1 label-control"  >:</label>
                                    <label class="col-md-8 label-control"  ><?=$dt_complaint->nama_user?></label>

                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 label-control"  >Status</label>
                                    <label class="col-md-1 label-control"  >:</label>
                                    <label class="col-md-8 label-control"  ><?=$dt_complaint->status?></label>

                            </div>
                          </div>

                          <div class="col-xl-6 col-lg-8">

                            <div class="form-group row">
                                    <label class="col-md-3 label-control"  >Tgl. Melapor</label>
                                    <label class="col-md-1   label-control"  >:</label>
                                    <label class="col-md-8 label-control"  ><?=$dt_complaint->date_request?></label>

                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 label-control"  >Tgl. Ditanggapi</label>
                                    <label class="col-md-1   label-control"  >:</label>
                                    <label class="col-md-8 label-control"  ><?=$dt_complaint->date_confirm?></label>

                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 label-control"  >Tgl. Selesai</label>
                                    <label class="col-md-1   label-control"  >:</label>
                                    <label class="col-md-8 label-control"  ><?=$dt_complaint->date_finish?></label>

                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 label-control"  >Topik</label>
                                    <label class="col-md-1   label-control"  >:</label>
                                    <label class="col-md-8 label-control"  ><?=$dt_complaint->title?></label>

                            </div>

                          </div>

                        </div>

                    </div>


            </div>

        </div>

<div class="col-xl-12 col-lg-12" style="float:left">
        <div class="card">


            <div class="card-body">
              <div class="table-responsive" id="filtered_complaint">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" clas"text-center" style="width: 50px; ">No</th>

                        <th scope="col" clas"text-center" style="width: 250px">Keterangan</th>
                        <th scope="col" clas"text-center" style="width: 50px">Status</th>
                        <th scope="col" clas"text-center" style="width: 100px">Tgl. Diperbaharui</th>
                        <th scope="col" clas"text-center" style="width: 50px">Di Proses Oleh</th>
                        <th scope="col" clas"text-center" style="width: 50px">Aksi</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=0;
                      foreach ($this->Model_pengaduan->getTrackingStatus($this->uri->segment(2))->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <td style="text-align:center;"><?=$no?></td>

                        <td> <?=$row['keterangan']?></td>
                        <td style="text-align:center;"><?php
                          if($row['ischeked']=="Y"){?>
                            <i class="la la-check" style="color:green;"></i>
                            <?
                          }else{?>
                            <i class="la la-close" style="color:red;"></i><?
                          }

                         ?>
                       </td>


                        <td style="text-align:center;"> <?=$row['change_date']?></td>
                        <td style="text-align:center;"> <?=$row['change_who']?></td>


                        <td  style="text-align:center;">
                          <center>

                            <button type="button" class="btn btn-icon  mr-1" onclick="updateStatusTracking('<?=$row['id']?>','<?=$row['ischeked']?>')"><i class="la la-pencil-square-o"></i></button>
                          </center>
                        </td>

                          <?php } ?>


                      </tr>



                    </tbody>
                  </table>
              </div>
            </div>


        </div>
</div>
<!--/ Global settings -->
<script src="<?=base_url()?>assets/js/jquery-3.4.0.js"></script>

<script script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


<script type="text/javascript">

function updateStatusTracking(id,status){

    var text = status=='Y'?' Dari Y ke N ':'Dari N ke Y  ';
    var sts = status=='Y'?'N':'Y';
     swal({
          title: "Anda Yakin",
          text: "Ingin Melakukan Update "+text+"Pada Data Yang Dipilih?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
               AksiUpdate(id,sts)
          } else {
            return true;
          }
        });
    }

    function AksiUpdate(id,status) {
        var hps = new FormData();
        hps.append('id',id);
        hps.append('status',status);
        $.ajax({
            url   :'<?=base_url()?>Utility/updateTrackStatus',
            method:'POST',
            contentType: false,
            processData:false,
            data  :hps,
            success: function(data) {
              console.log(data);
              if (data=='sukses') {
                  swal("Informasi","Data Berhasil diperbaharui" ,"success");
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
