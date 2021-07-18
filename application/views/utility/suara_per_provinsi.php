<div class="col-xl-12 col-lg-12">
   <div class="card">
      <div class="card-body" id="">
        
        <table class="table table-bordered" id="myTable2" style="table-layout: fixed;">
          <tr>
            <th>Nama Calon</th>
            <th>Jumlah Suara</th>
          </tr>
          <?php foreach ($dataCartSuara->result() as $value) {  ?>
        	<tr>
        		<td><?=$value->nama_calon?></td>
            <td><?=$value->jumlah_suara?></td>

        	</tr>
        <?php } ?>
        </table>
      </div>
    </div>
</div>

<div class="col-md-12 col-sm-12">            
    <div class="card">
        <div class="card-body">
                <div style="height: 435px;">
            <canvas id="simple-doughnut-chart"></canvas>
            </div>
        </div>
    </div>
</div>

