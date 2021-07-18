<div class="table-responsive">
    <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
      <thead>
        <tr>
          <th scope="col" style="width: 20px">No</th>
          <th scope="col"style="width: 40px">Foto</th>
          <th scope="col"style="width: 150px">Nama</th>
          <th scope="col"style="width: 100px">Status</th>
          <th scope="col"style="width: 100px">Last Online</th>
          <th scope="col" style="width: 170px;"><center>Aksi</center></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no=0;
        foreach ($dataSql->result() as $ptgsOnline) {
        $no++;
        ?>
       <tr>
          <th scope="row"><?=$no?></th>
          <td><a href="<?=base_url()?>assets/upload/user/<?=$ptgsOnline->foto?>" target="_blank"><img src="<?=base_url()?>assets/upload/user/<?=$ptgsOnline->foto?>" width="32px"></a></td>
          <td><?=$ptgsOnline->name?></td>
          <td>
              <?php
                  if ($ptgsOnline->status_online=='Y') {
                      echo '<i class="la la-dot-circle-o success"></i> <span class="success">Online</span>';
                  } else {
                      echo '<i class="la la-dot-circle-o danger"></i> <span class="danger">Offline</span>';
                  }
              ?>
          </td>

          <td><?= $ptgsOnline->date_change?></td>
          <td style="width: 300px;">
            <center>
            <a href="<?=base_url()?>riwayat_lokasi_petugas/<?=$ptgsOnline->id_user?>"><button class="btn btn-success" data-toggle="modal"><i class="la la-map-marker"></i> Lokasi</button></a>
            <a href="<?=base_url()?>riwayat_pengaduan/<?=$ptgsOnline->id_user?>"><button class="btn btn-warning" data-toggle="modal">pengaduan</button></a>
          </center>
          </td>
          </tr>
    <?php } ?>

      </tbody>
    </table>
</div>