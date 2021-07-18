 <script src="<?=base_url()?>assets/js/jquery-3.4.0.js"></script>
<table class="table table-bordered" id="myTable" style="table-layout: fixed;">
  <thead>
    <tr>
      <th scope="col" style="width: 20px">No</th>
      <th scope="col"style="width: 100px">No TPS</th>
      <th scope="col"style="width: 200px">Ketua</th>
      <th scope="col"style="width: 150px">Provinsi</th>
      <th scope="col"style="width: 150px">Kabupaten</th>
      <th scope="col"style="width: 150px">Kecamatan</th>
      <th scope="col"style="width: 150px">Kelurahan</th>
      <th scope="col"style="width: 200px">Latitude</th>
      <th scope="col"style="width: 200px">Longitude</th>
      <th scope="col" style="width: 350px"><center>Aksi</center></th>
    </tr>
  </thead>
  <tbody>

    <?php
    $no=0;
    foreach ($dataSql->result_array() as $row) {
    $no++;
    ?>
    <tr>
      <th scope="row"><?=$no?></th>
      <td><?=$row['no_tps']?></td>
      <td><?=$row['ketua_tps']?></td>
      <td><?=$this->model_global->getDataGlobal('tb_provinsi','id_provinsi',$row['id_provinsi'])->row()->name?></td>
      <td><?=$this->model_global->getDataGlobal('tb_kabupaten','id_kabupaten',$row['id_kabupaten'])->row()->name?></td>
      <td><?=$this->model_global->getDataGlobal('tb_kecamatan','id_kecamatan',$row['id_kecamatan'])->row()->name?></td>
      <td><?=$this->model_global->getDataGlobal('tb_kelurahan','id_kelurahan',$row['id_kelurahan'])->row()->name?></td>
      <td><?=$row['latitude']?></td>
      <td><?=$row['longitude']?></td>
      <td>
        <center>
        <a href="<?=base_url()?>petugas/<?=$row['id_tps']?>"><button class="btn btn-success" data-toggle="modal">Petugas</button></a>
         <a href="<?=base_url()?>maps_tps/<?=$row['id_tps']?>"><button class="btn btn-warning"><i class="la la-map-marker"></i></button></a>
        <button class="btn btn-primary" onclick="getDataForUpdate('<?=$row['id_tps']?>')" data-toggle="modal" data-target="#modal_update"><i class="la la-edit"></i></button>
        <button class="btn btn-danger" onclick="alertdel('<?=$row['id_tps']?>')"><i class="la la-trash"></i></button>
      </center>
      </td>
      </tr>
        <?php } ?>

  </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function () {
      $.noConflict();
      $('.search-select').selectize({
          sortField: 'text'
      });
      var table = $('#myTable').DataTable();
  });

</script>
