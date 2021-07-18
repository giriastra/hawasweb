          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Nota bulanan</h1>
          </div>


          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Buat nota</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <input type="text" class="form-control form-control-user" id="namaVilla" placeholder="Nama Villa">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <select class="form-control" id="BulanNota" onchange="selectBulan()">
                          <option>-Pilih-</option>
                          <?php
                            foreach ($this->model_global->data_value('BULAN','BULAN_NOTA')->result_array() as $row) {
                          ?>
                            <option value="<?=$row['value']?>"><?=$row['remark']?></option>
                          <?php
                            }
                          ?>                          
                        </select>
                      </div>

                      <div class="col-sm-6">
                        <select class="form-control" id="tahunNota">
                          <option value="<?=date('Y')?>"><?=date('Y')?></option>                          
                        </select>
                      </div>                      

                      <div class="col-sm-6" id="col_kabisat" style="padding-top: 10px;">
                         <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="cekKabisat" name="example1">
                          <label class="custom-control-label" for="cekKabisat">Kabisat</label>
                        </div>
                      </div>

                      <div class="col-sm-12" style="margin-top: 10px;">
                        <button class="btn btn-primary" style="width: 100%" onclick="CreateNota()">Buat Nota</button>
                      </div>



                    </div>
                  </div>
                </div>

                <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Nota</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body" id="hasil_nota">
                    
                </div>
                </div>
              </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referral
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>


<script type="text/javascript">
    
    $(document).ready(function(){
      $("#cekKabisat").val('no');
      $("#col_kabisat").hide();
      $("#hasil_nota").hide();

      $("#cekKabisat").click(function(){
        if ($("#cekKabisat").is(':checked')) {
          $("#cekKabisat").val('yes');
        } else {
          $("#cekKabisat").val('no');
        }
      });

    });

    function selectBulan(){
      if ($('#BulanNota option:selected').val()=='2') {
           $("#col_kabisat").show('slow');
      } else {
          $("#col_kabisat").hide('slow');
      }
    }

    function CreateNota(){
      var datatf = new FormData();
      datatf.append('namaVilla',$("#namaVilla").val());
      datatf.append('bulan',$("#BulanNota").val());
      datatf.append('tahun',$("#tahunNota").val());
      datatf.append('kabisat',$("#cekKabisat").val());
      $.ajax({
          url: '<?=base_url()?>Notabulanan/BuatNota',
          method: 'POST',
          contentType: false,
          processData: false,
          dataType:'json',
          data: datatf,
          success: function(data) {                
              console.log(data);
              $("#hasil_nota").show();
              $("#notaBulanan").html(data);
          },
          error: function(data) {
              console.log(data);
          }
      });
    }

</script>