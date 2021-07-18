<?php
  if ($SQLfilterComplaint->num_rows()>0) {
?>
<table class="table table-bordered" id="myTable" style="table-layout: fixed;">
  <thead>
    <tr>
      <th scope="col" style="width: 50px;">No</th>
      <th scope="col"style="width: 100px">Code</th>
      <th scope="col"style="width: 200px">Petugas</th>
      <th scope="col"style="width: 200px">Pengguna</th>
      <th scope="col"style="width: 150px">Request</th>
      <th scope="col"style="width: 150px">Konfirmasi</th>
      <th scope="col"style="width: 150px">Selesai</th>
      <th scope="col"style="width: 130px">Durasi</th>
      <th scope="col"style="width: 200px">Topik</th>
      <th scope="col"style="width: 150px">Status</th>
      <th scope="col"style="width: 150px">Rating</th>
      <th scope="col"style="width: 200px">Komentar</th>
      <th scope="col" style="width: 140px"><center>Aksi</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=0;
    foreach ($SQLfilterComplaint->result_array() as $row) {
    $no++;
    ?>
    <tr>
      <td><?=$no?></td>
      <td><?=$row['code']?></td>
      <td>
        <?php
          if ($row['id_petugas']==0) {
            echo 'Belum Terverifikasi';
          } else {
            $name=@$this->model_global->getDataGlobal('tb_user','id_user',$row['id_petugas'])->row()->name;
            if (strlen($name)>0) {
              echo $name;
            } else {
              echo 'Tidak Diketahui';
            }
          }
        ?>

      </td>
      <td>
        <?php
          if ($row['id_user']==0) {
            echo 'Tidak Diketahui';
          } else {
            $name=@$this->model_global->getDataGlobal('tb_user','id_user',$row['id_user'])->row()->name;
            if (strlen($name)>0) {
              echo $name;
            } else {
              echo 'Tidak Diketahui';
            }
          }
        ?>
      </td>
      <td><?php if(strlen($row['date_request'])>5){echo date("d-m-Y H:i", strtotime($row['date_request']));}else {echo "";}?></td>
      <td><?php if(strlen($row['date_confirm'])>5){echo date("d-m-Y H:i", strtotime($row['date_confirm']));}else {echo "";}?></td>
      <td><?php if(strlen($row['date_finish'])>5){echo date("d-m-Y H:i", strtotime($row['date_finish']));}else {echo "";}?></td>
      <td><?php

            if(strlen($row['date_finish'])>3 && strlen($row['date_confirm'])>3 ){
                $to_time = strtotime($row['date_confirm']);
                $from_time = strtotime($row['date_finish']);
                $duration =  round(abs($to_time - $from_time) / 60,0);

                if($duration>60){
                  $jam = round($duration/60,0);
                  if($jam>24){
                    $hari  =round($jam/24,0)."d -";
                    $jam = round($jam%24,0);
                  }
                  $menit = $duration%60;
                  $waktu = @$hari." ".$jam."h - ".$menit."m";
                }else{
                  $waktu = $duration." menit";
                }

                echo $waktu;
            }

      ?></td>
      <td><?=$row['title']?></td>
      <td style="font-weight:bold;color:
        <?php
          if ($row['status']=='OPEN') {
            echo "#2196f3";
          } else if ($row['status']=='APPROVED') {
            echo "#4caf50";
          } else if ($row['status']=='REJECTED') {
            echo "#626e82";
          } else {
            echo "#f44336";
          }
        ?>
      ">
      <?=$row['status']?>
      </td>

      <td> <?php
          if(strlen($row['message_rating'])>0 ){
            for ($x = 0; $x <= $row['value_rating']-1; $x++) {
              echo ' <span><i class="la la-star warning" style="font-size: 15px"></i></span>';
            }
          }
      ?> </td>
      <td><?=$row['message_rating']?></td>
      <td style="width: 300px;">
      <center>
        <a href="<?=base_url()?>detail_complaint/<?=$row['id_complaint']?>?id_petugas=<?=$row['id_petugas']?>&status=<?=$row['status']?>"><button class="btn btn-success" onclick=""><i class="la la-eye"></i></button></a>
      </center>

        <?php } ?>
       <!-- modal -->
      </td>
    </tr>
  </tbody>
</table>
<?php } else {
     echo "<center><p><i class='la la-ban' style='font-size:50px;color:#bebebe;'></i></p> <b style='font-size:20px;color:#bebebe;'>Tidak Ada Data</b></center>";
 }?>
