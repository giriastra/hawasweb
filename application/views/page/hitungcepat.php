<style type="text/css">


body.vertical-layout[data-color=bg-chartbg] .navbar-container, body.vertical-layout[data-color=bg-chartbg] .content-wrapper-before {
    /*background-color: #000 !important;*/
    /*background-image: url('<?=base_url()?>assets/img/vector.png');*/
    background-image: linear-gradient(to right, #8BC34A, #00BCD4);
}

.active_hirarky {
  font-weight: bolder !important;
    font-size: 16px !important;
    color: #484848 !important;
}
}

.content-wrapper-before {

    height: 120px !important;

}

.pie-chart-value {
  fill: none;
  stroke-width: 75px;
}

</style>

<?php
  // if ($type_pemilihan_now=='In_kabupaten') {
  //   $hideProv='none';
  // }

  if (isset($id_provinsi)) {
    $prov=$this->model_global->getDataGlobal('tb_provinsi','id_provinsi',$id_provinsi)->row()->name;
     //$prov='Provinsi';
    $linkProv=$link=base_url()."show_quickcount?start_form=".$start_form."&type_pemilihan=pilgub&id_provinsi=".$id_provinsi."&id_kabupaten=".$id_kabupaten."&id_pemilihan=".$id_pemilihan;
  } else {
    $prov='Provinsi';
    $linkProv='';
  }

  if (isset($id_kabupaten)) {
    $kab=$this->model_global->getDataGlobal('tb_kabupaten','id_kabupaten',$id_kabupaten)->row()->name;
     // $kab='Kabupaten'.$id_provinsi." ".$kab;
     $linkKab=base_url()."show_quickcount?start_form=".$start_form."&type_pemilihan=pilbub&id_provinsi=".$id_provinsi."&id_kabupaten=".$id_kabupaten."&id_kecamatan=".$id_kecamatan."&id_pemilihan=".$id_pemilihan;
  } else {
    $kab='Kabupaten';
    $linkKab='';
  }

  if (isset($id_kecamatan)) {
    $kec=$this->model_global->getDataGlobal('tb_kecamatan','id_kecamatan',$id_kecamatan)->row()->name;
    //$kec='Kecamatan';
    $linkKec=base_url()."show_quickcount?start_form=".$start_form."&type_pemilihan=kecamatan&id_provinsi=".$id_provinsi."&id_kabupaten=".$id_kabupaten."&id_kecamatan=".$id_kecamatan."&id_kelurahan=".$id_kelurahan."&id_pemilihan=".$id_pemilihan;
  } else {
    $linkKec='';
    $kec='Kecamatan';
  }

  if (isset($id_kelurahan)) {
    $kel=$this->model_global->getDataGlobal('tb_kelurahan','id_kelurahan',$id_kelurahan)->row()->name;
    //$kel='Kelurahan';
  } else {
    $kel='Kelurahan';
  }

  if ($type_pemilihan_now=='In_provinsi') {
    $ShowProv='block';
    $ShowKab='none';
    $ShowKec='none';
    $ShowKel='none';

    $actProv='active_hirarky';
    $actKab='0';
    $actKec='0';
    $actKel='0';


  }else if ($type_pemilihan_now=='In_kabupaten') {
    $ShowProv='block';
    $ShowKab='block';
    $ShowKec='none';
    $ShowKel='none';

    $actProv='0';
    $actKab='active_hirarky';
    $actKec='0';
    $actKel='0';
  }else if ($type_pemilihan_now=='In_kecamatan') {
    $ShowProv='block';
    $ShowKab='block';
    $ShowKec='block';
    $ShowKel='none';

    $actProv='0';
    $actKab='0';
    $actKec='active_hirarky';
    $actKel='0';
  }else if ($type_pemilihan_now=='In_kelurahan') {
    $ShowProv='block';
    $ShowKab='block';
    $ShowKec='block';
    $ShowKel='block';

    $actProv='0';
    $actKab='0';
    $actKec='0';
    $actKel='active_hirarky';
  }
?>


        <div class="content-header row" style="margin-top: ;">
          <div class="content-header-left col-md-8 col-12">
            <div class="breadcrumbs-top float-md-left">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item " style="display: <?=@$ShowProv?>">
                    <a class="<?=$actProv?>" href="<?=$linkProv?>"><?=$prov?></a>
                  </li>
                  <li class="breadcrumb-item  <?=$actKab?>" style="display: <?=@$ShowKab?>">
                    <a class="<?=$actKab?>" href="<?=$linkKab?>"><?=$kab?></a>
                  </li>
                  <li class="breadcrumb-item <?=$actKec?>" style="display: <?=@$ShowKec?>">
                    <a class="<?=$actKec?>" href="<?=$linkKec?>"><?=$kec?></a>
                  </li>
                  <li class="breadcrumb-item <?=$actKel?>" style="display: <?=@$ShowKel?>">
                   <a class="<?=$actKel?>" href="javascript:void(0)"><?=$kel?></a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-4 col-12 mb-2">
            <h3 class="content-header-title">&nbsp;</h3>
          </div>

        </div>

<div class="row match-height">

<div class="col-xl-6 col-lg-12"  style="">
        <div class="card" style="min-height: 600px">
          <div class="card-header" style="border-bottom: 1px solid #ececec">
<!--                 <h4 class="card-title">Suara Temporary</h4>
-->
            <center><b id="text_header" style="font-size: 17px;"><?=$label_name?></b></center>
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

            <div class="col-md-12 col-sm-12">

                    <div class="card-content collapse show">

                        <div class="card-body">

                                <div style="height: 435px;">
                            <canvas id="simple-doughnut-chart"></canvas>
                            </div>
                        </div>
                    </div>
            </div>
      </div>
</div>


<div class="col-xl-6 col-lg-12" style="float:left">
        <div class="card" style="min-height: 600px">
            <div class="card-header" style="border-bottom: 1px solid #ececec">
                <b id="text_header" style="font-size: 17px;"><?=$label_tabel?></b>
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

            <style>
              table tr th {
                text-align: center;
              }
            </style>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-sm" id="myTable2" style="table-layout: fixed;">
                    <thead>
                      <tr style="background-image: linear-gradient(to right, #4CAF50, #00BCD4);color: #fff">
                        <th scope="col" style="width: 200px">Nama Wilayah</th>
                        <th scope="col"style="width: 100px">Suara</th>
                        <th scope="col"style="width: 100px">Persen</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $no=0;
                      $total ="";
                      foreach ($dataTabelSuara->result() as $row) {
                        $total+=$row->tot_suara;
                      }
                      foreach ($dataTabelSuara->result() as $row) {
                        $no++;
                        if ($type_pemilihan_now=='In_provinsi') {
                        	$link=base_url()."show_quickcount?start_form=".$start_form."&type_pemilihan=".$type_pemilihan_next."&id_provinsi=".$id_provinsi."&id_kabupaten=".$row->id_kabupaten."&id_pemilihan=".$id_pemilihan;
                        	$icon='<i class="la la-arrow-circle-right"></i>';
                          $fotoC1='';
                        } else if ($type_pemilihan_now=='In_kabupaten') {
                        	$link=base_url()."show_quickcount?start_form=".$start_form."&type_pemilihan=".$type_pemilihan_next."&id_provinsi=".$id_provinsi."&id_kabupaten=".$id_kabupaten."&id_kecamatan=".$row->id_kecamatan."&id_pemilihan=".$id_pemilihan;
                        	$icon='<i class="la la-arrow-circle-right"></i>';
                          $fotoC1='';
                        } else if ($type_pemilihan_now=='In_kecamatan') {
                        	$link=base_url()."show_quickcount?start_form=".$start_form."&type_pemilihan=".$type_pemilihan_next."&id_provinsi=".$id_provinsi."&id_kabupaten=".$id_kabupaten."&id_kecamatan=".$id_kecamatan."&id_kelurahan=".$row->id_kelurahan."&id_pemilihan=".$id_pemilihan;
                        	$icon='<i class="la la-arrow-circle-right"></i>';
                          $fotoC1='';
                        } else {
                        	$link="javascript:void(0)";
                          $fotoC1=$row->foto_calon;
                        	$icon='';
                        }
                      ?>
                      <tr>
                        <th scope="row" style="text-align: left;">
                        	<a href="<?=@$link?>">
                            <?php
                              if (strlen($fotoC1)>0) {

                                echo "<a href='".base_url()."assets/upload/doc_c1/".$fotoC1."'' target='_blank'> <img src='".base_url()."assets/upload/doc_c1/".$fotoC1."' width='60px;'></a> &nbsp";
                              }
                            ?>
                            <?=$row->nama_wilayah?> <?=$icon?>
                        	</a>
                        </th>
                        <th scope="row"><?=number_format($row->tot_suara,0,",",".") ?></th>
                        <th scope="row"><?=round( ((float) $row->tot_suara/$total)*100,2)?> %</th>

                      </tr>

                        <?php } ?>

                        <th scope="row">TOTAL</th>
                        <th scope="row"><?php if(strlen($total)<=0 ){echo '';}else{echo number_format($total,0,",","."); } ?> </th>
                        <th scope="row"><?php if(strlen($total)<=0){echo '';}else{echo '100%'; } ?> </th>
                        <!-- <th scope="row">100 % </th> -->

                    </tbody>
                  </table>
              </div>
            </div>


        </div>
</div>

</div>



<!-- BEGIN VENDOR JS-->
<!--     <script src="<?=base_url()?>theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
 -->    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?=base_url()?>theme-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
<!--     <script src="<?=base_url()?>theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>-->
 <!-- <script src="<?=base_url()?>theme-assets/js/core/app-lite.js" type="text/javascript"></script> -->
     <script src="<?=base_url()?>assets/js/jquery-3.4.0.js"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
<!--     <script src="<?=base_url()?>theme-assets/js/scripts/charts/chartjs/pie-doughnut/pie-simple.js" type="text/javascript"></script>
 -->
<!--  <script src="<?=base_url()?>theme-assets/js/scripts/charts/chartjs/pie-doughnut/doughnut-simple.js" type="text/javascript"></script>
 -->    <!-- END PAGE LEVEL JS-->
<!--/ Global settings -->
<!-- <script type="text/javascript">



      function AksiConfirm(id,status) {
        $("#pageloader").show();
        setTimeout(function() {
        var hps = new FormData();
        hps.append('id',id);
        hps.append('mode',status);
        $.ajax({
            url   :'<?=base_url()?>Utility/ConfirmQuickcount',
            method:'POST',
            contentType: false,
            processData:false,
            data  :hps,
            success: function(data) {
              $("#pageloader").hide();
              console.log(data);
              if (data=='sukses') {
                location.reload();
              } else {
                swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }

            },error: function(data){
              $("#pageloader").hide();
               console.log(data);
               swal("Informasi","Gagal Terhubung Ke Server" ,"error");
            }
        });
        }, 300);

    }

</script> -->

<script type="text/javascript">
  var data = [
  {
   "name": "Value 1",
   "color": "red",
    "value": 180
  }, {
   "name": "Value 2",
   "color": "rebeccapurple",
    "value": 100
  }, {
   "name": "Value 3",
   "color": "green",
    "value": 135
  }, {
   "name": "Value 4",
   "color": "pink",
    "value": 230
  }, {
   "name": "Value 5",
   "color": "blue",
    "value": 90
  }
];

// Setup global variables
var svg = document.getElementById('pie-chart'),
    list = document.getElementById('pie-values'),
    totalValue = 0,
    radius = 100,
    circleLength = Math.PI * (radius * 2), // Circumference = PI * Diameter
    spaceLeft = circleLength;

// Get total value of all data.
for (var i = 0; i < data.length; i++) {
  totalValue += data[i].value;
}

// Loop trough data to create pie
for (var c = 0; c < data.length; c++) {

  // Create circle
  var circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");

  // Set attributes (self explanatory)
  circle.setAttribute("class", "pie-chart-value");
  circle.setAttribute("cx", 150);
  circle.setAttribute("cy", 150);
  circle.setAttribute("r", radius);

  // Set dash on circle
  circle.style.strokeDasharray = (spaceLeft) + " " + circleLength;

  // Set Stroke color
  circle.style.stroke = data[c].color;

  // Append circle to svg.
  svg.appendChild(circle);

  // Subtract current value from spaceLeft
  spaceLeft -= (data[c].value / totalValue) * circleLength;

  // Add value to list.
  var listItem = document.createElement('li'),
      valuePct = parseFloat((data[c].value / totalValue) * 100).toFixed(1);

  // Add text to list item
  listItem.innerHTML = data[c].name + ' (' + valuePct + '%)';

  // Set color of value to create relation to pie.
  listItem.style.color = data[c].color;

  // Append to list.
  list.appendChild(listItem);
}
</script>

<script type="text/javascript">
  $(document).ready(function () {
      $.noConflict();
      var table2 = $('#myTable2').DataTable();
    });
</script>
<script type="text/javascript">
  $(window).on("load", function(){



    //Get the context of the Chart canvas element we want to select
    var ctx = $("#simple-doughnut-chart");

    // Chart Options
    var chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        responsiveAnimationDuration:500,
    };

    var jsonData1 = '<?=$resultDataQuick?>';
    var DataSuara = JSON.parse(jsonData1);

    var jsonData2 = '<?=$NamaPaket?>';
    var DataNamaPaket = JSON.parse(jsonData2);


    // for(var i = 0; i < json.length; i++) {
    //     var obj = json[i];
    // }


    // Chart Data
    var chartData = {
        labels: DataNamaPaket,
        datasets: [{
            label: "DATA QUICKCOUNT",
            data: DataSuara,
            backgroundColor: ['#00bcd4', '#fbad38','#28D094', '#FF4961','#1E9FF2', '#FF9149'],
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

});
</script>
