
<?php 
  if ($SQLfilterForum->num_rows()>0) {
?>
<table class="table table-bordered" id="myTable" style="table-layout: fixed;">
    <thead>
      <tr>
        <th scope="col" style="width: 100px">No</th>
        <th scope="col"style="width: 200px">Judul</th>
        <th scope="col"style="width: 200px">Tgl dibuat</th>
        <th scope="col"style="width: 200px">Tgl tutup</th>                        
        <th scope="col"style="width: 200px">Petugas</th>                        
        <th scope="col"style="width: 200px">Status</th>                        
        <th scope="col" style="width: 100px;"><center>Aksi</center></th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $no=0;
      foreach ($SQLfilterForum->result() as $row) {
      $no++;
      ?>
      <tr>
        <th scope="row"><?=$no?></th>
        <td><?=$row->title?></td>
        <td><?=$this->model_global->tgl_indo($row->date_create)?></td>
        <td><?=$this->model_global->tgl_indo($row->date_close)?></td>                        
        <td>
          <?php
            if ($row->id_petugas==0) {
              echo 'Belum Terverifikasi';
            } else {
              $name=@$this->model_global->getDataGlobal('tb_user','id_user',$row->id_petugas)->row()->name;
              if (strlen($name)>0) {
                echo $name;
              } else {
                echo 'Tidak Diketahui';
              }
            }
          ?>
         </td>                       
        <td style="font-weight:bold;color:
          <?php
            if ($row->status=='OPEN') {
              echo "#2196f3";
            } else if ($row->status=='APPROVED') {
              echo "#4caf50";
            } else if ($row->status=='REJECTED') {
              echo "#626e82";
            } else {
              echo "#f44336";
            }
          ?>
         "><?=$row->status?></td>                          
        <td style="width: 70px;">
          <center>
            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modal_update<?=$no?>"><i class="la la-edit"></i></button>
            <button class="btn btn-danger" onclick="alertdel('<?=$row->id_user?>')"><i class="la la-trash"></i></button> -->
            <a href="<?=base_url()?>chat_forum/<?=$row->id_forum?>?id_petugas=<?=$row->id_petugas?>&status=<?=$row->status?>"><button class="btn btn-success" onclick=""><i class="la la-eye"></i></button></a>
          </center>
        <!-- modal update -->
          <div class="modal fade" id="modal_update<?=$no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <input type="hidden" value="<?=$rowUsr['id_user']?>" id="id_user_update" name="">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama</label>
                        <input type="text" class="form-control" value="<?=$rowUsr['name']?>" id="name_update" style="">
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Username</label>
                        <input type="text" class="form-control" value="<?=$rowUsr['username']?>" id="username_update" style="">
                      </div>            
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Password</label>
                        <input type="password" class="form-control" value="<?=$rowUsr['pwd']?>" id="password_update" style="">
                      </div>            
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone</label>
                        <input type="text" class="form-control" value="<?=$rowUsr['phone']?>" id="phone_update" style="">
                      </div>            
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Type user</label>
                        <select id="type_user_update" class="form-control">
                               <?php foreach ($this->model_global->getTypeUser()->result_array() as $rowType) { ?>
                                  <option value="<?=$rowType['id_type_user']?>"><?=$rowType['type_user']?></option>
                               <?php } ?>                                   
                        </select>

                      </div>
                      <?php } ?>             
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="EditPengguna()">Simpan</button>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
         <!-- modal -->
        </td>
      </tr>                    
    </tbody>
  </table>
  <?php
  } else {
    echo "<center><p><i class='la la-ban' style='font-size:50px;color:#bebebe;'></i></p> <b style='font-size:20px;color:#bebebe;'>Tidak Ada Data</b></center>"; 
  }
  ?>
