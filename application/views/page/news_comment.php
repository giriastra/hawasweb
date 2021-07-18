<style type="text/css">


body.vertical-layout[data-color=bg-chartbg] .navbar-container, body.vertical-layout[data-color=bg-chartbg] .content-wrapper-before {
    /*background-color: #000 !important;*/
    /*background-image: url('<?=base_url()?>assets/img/vector.png');*/
    background-image: linear-gradient(to right, #9f78ff, #32cafe);    
}

.content-wrapper-before {

    height: 120px !important;

}

</style>

 
        <div class="content-header row" style="margin-top: ;">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Comments</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Comments
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>


<div class="col-xl-12 col-lg-12" style="float:left">
        <div class="card">
            <div class="card-header">
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

            <div class="card-body">
              <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading"><i class="la la-newspaper-o"></i> Berita</h4>
                <p>"<?=$this->model_global->getDataGlobal('tb_news','id_news',$this->uri->segment(2))->row()->title?>"</p>              
              </div>
              <div class="table-responsive">
                  <table class="table table-bordered" id="myTable_commnets" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 5px">No</th>
                        <th scope="col" style="width: 40px;">Pengguna</th>
                        <th scope="col" style="width: 250px;">Comment</th>
                        <th scope="col" style="width: 30px;">Tgl</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $id_news=$this->uri->segment(2);
                        $no=0;
                        foreach ($this->model_global->getDataGlobal('tb_news_comment','id_news',$id_news)->result_array() as $row) {
                        $no++; 
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><?=$this->model_global->getDataGlobal('tb_user','id_user',$row['id_user'])->row()->name?></td>
                        <td><?=substr($row['comment'], 0,200)?></td>         
                        <td><?=$row['date']?></td>         
                      </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
              </div>
            </div>
                    

        </div>
</div>
<!--/ Global settings -->
 <script>
  $(document).ready(function () {
      $.noConflict();
      var table = $('#myTable_commnets').DataTable();
  });
</script>