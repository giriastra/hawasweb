    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>
<div class="table-responsive"> 
<table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 100px">No</th>
                        <th scope="col"style="width: 150px">Status</th>                        
                        <th scope="col"style="width: 150px">Jenis BroadCast</th>                        
                        <th scope="col"style="width: 150px">Judul</th>                        
                        <th scope="col"style="width: 150px">Pesan</th>                        
                        <th scope="col"style="width: 150px">Link Gambar</th>                        
                        <th scope="col"style="width: 150px">Link Website</th>                        
                        <th scope="col"style="width: 150px">Operator</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php 
                      $no=0;                     
                      foreach ($dataSql->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>                              
                        <td><?=$no?></td> 
                        <td>
                          <?php
                            if ($row['status']=='P') {
                            ?>
                              <button class="btn btn-primary" id="btn<?=$row['id_broadcast']?>"><i class="la la-spinner pending" id="icon<?=$row['id_broadcast']?>"></i> <span class="txtpending" id="txtpending<?=$row['id_broadcast']?>">Pending</span></button>
                            <?php
                            } else if ($row['status']=='Y') {
                            ?>
                              <button class="btn btn-success"><i class="la la-check-circle"></i> Terkirim</button>
                            <?php
                            } else if ($row['status']=='N') {
                            ?>
                              <button class="btn btn-danger"><i class="la la-times-circle"></i> Gagal</button>
                            <?php
                            }
                          ?>
                            
                          </td>                           
                        <td><?=$row['jenis_broadcast']?></td>                       
                        <td><?=$row['judul']?></td>                       
                        <td><?=$row['pesan']?></td>                       

                        <td><?=$row['url_img']?></td>                                     
                        <td><?=$row['url_web']?></td>                                     
                        <td><?=$row['create_who']?></td>                                     
                        </tr>
                          <?php } ?>                        
                                          
                    </tbody>
                  </table>
            </div>
    <script src="<?=base_url()?>assets/js/jquery-3.4.0.js"></script>
 
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
 <script>$(document).ready(function () {
    $.noConflict();
    var table = $('#myTable').DataTable();
});</script>