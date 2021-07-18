<?php
  if ($dataSql->num_rows()>0) {
?>
<div class="table-responsive">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 20px">No</th>
                        <th scope="col"style="width: 60px">Foto</th>
                        <th scope="col"style="width: 100px">Nama</th>
                        <th scope="col"style="width: 100px">Username</th>
                        <th scope="col"style="width: 100px">Phone</th>
                        <th scope="col"style="width: 50px">Status</th>
                        <th scope="col"style="width: 60px">Tipe</th>
                        <th scope="col" style="width: 100px"><center>Aksi</center></th>


                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=0;
                      foreach ($dataSql->result() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td>
                          <a href="<?=base_url()?>assets/upload/user/<?=$row->foto?>" target="_blank">
                            <img src="<?=base_url()?>assets/upload/user/<?=$row->foto?>" width="50px">
                          </a>
                        </td>
                        <td><?=$row->name?></td>
                        <td><?=$row->username?></td>
                        <td><?=$row->phone?></td>

                        <td>
                          <?php
                              if ($row->status_online=='Y') {
                                  echo '  <span class="success">Online</span>';
                              } else {
                                  echo '<span class="danger">Offline</span>';
                              }
                          ?>
                        </td>
                        <td><?=$row->type_user?></td>
                        <td style="width: 500px;">
                          <center>
                          <button class="btn btn-primary" data-toggle="modal"  onclick="getDataForUpdate('<?=$row->id_user?>')"  data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" style="display: <?=($row->username=='admin') ? 'none' : 'block' ;?>"   onclick="alertdel('<?=$row->id_user?>')"><i class="la la-trash"></i></button>
                          </center>

                        <!-- modal update -->
                          <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Update Pengguna</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                  <div class="modal-body">
                                    <?php foreach ($this->model_global->getPengguna($row->id_user)->result_array() as $rowUsr) {?>
                                      <input type="hidden" value="<?=$rowUsr['id_user']?>" id="" name="">


                                      </div>
                                      <?php } ?>
                                  </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary" onclick="EditPengguna()">Simpan</button>
                                </div>
                              </div>
                            </div>

                          <?php } ?>
                         <!-- modal -->
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </div>
<?php
} else {
  echo "<center><b>Data Tidak Ditemukan</b></center>";
}
?>
