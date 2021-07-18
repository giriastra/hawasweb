<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/forum.css">
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
            <h3 class="content-header-title"><?=$page_name?></h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active"><?=$page_name?>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>


<div class="col-xl-12 col-lg-12" style="float:left; padding: ">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Chat room</h4>
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

        <div class="mesgs">
          <div class="msg_history">

            <?php foreach ($this->model_global->getDataGlobal('tb_forum_detail','id_forum',$this->uri->segment(2))->result() as $rowChat) { 
              if ($rowChat->id_petugas>0) {
            ?>
                <div class="outgoing_msg">
                  <div class="outgoing_msg_img"> <img src="<?=base_url()?>assets/img/user.png" alt="sunil"> </div>
                  <div class="sent_msg">
                    <p><?=$rowChat->message?><span class="time_date_sent"> <?=$this->model_global->tgl_indo($rowChat->date)?>&nbsp;<?=date("H:i:s", strtotime($rowChat->date))?></span></p>                     
                  </div>
                </div>
              <?php
              } else {
              ?>
                 <div class="incoming_msg">
                  <div class="incoming_msg_img"> <img src="<?=base_url()?>assets/img/user.png" alt="sunil"> </div>
                  <div class="received_msg">
                    <div class="received_withd_msg">
                      <p>
                        <b style="color: #fff">
                          <?=@$this->model_global->getDataGlobal('tb_user','id_user',$rowChat->id_user)->row()->name?> ~</b>
                        <br>
                        <?=$rowChat->message?><span class="time_date"> <?=$this->model_global->tgl_indo($rowChat->date)?>&nbsp;<?=date("H:i:s", strtotime($rowChat->date))?></span>
                      </p>
                    </div>
                  </div>
                </div>

              <?php 
            } 
          } 
          ?>
          </div>

        </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <div class="col-xl-11 col-lg-11" style="float:left; padding: 10px 10px 10px 10px">
                <input type="hidden" name="id_forum" value="<?=$this->uri->segment(2)?>">
                <textarea class="form-control" id="isi_pesan" placeholder="Tuliskan pesan anda disini..." rows="1" cols="6" style="width: 100%"></textarea>
              </div>
              <div class="col-xl-1 col-lg-1" style="float:left; padding: 10px 10px 10px 10px">
                <button class="btn btn-primary" onclick="SendMessage('<?=$this->uri->segment(2)?>')"><i class="la la-rocket"></i></button>
                  <!-- <button class="msg_send_btn" type="button"><i class="la la-paper-plane" onclick="SendMessage('<?=$rowForum['id_forum']?>')" aria-hidden="true"></i></button> -->
              </div>
            </div>
          </div>
      </div>

        </div>
<!--/ Global settings -->
<script type="text/javascript">
  function SendMessage(id_forum){
    $("#pageloader").fadeIn();
      setTimeout(function() {
        if ('<?=$_GET['status']?>'!='OPEN' && '<?=$_GET['id_petugas']?>'!='<?=$this->session->userdata('id_user')?>') {
            $("#pageloader").fadeOut();
            swal("Informasi","Anda tidak memiliki otorisasi untuk melakukan percakapan di forum ini!" ,"error");
          } else {
            var datasend = new FormData();
            datasend.append('id_forum',id_forum);
            datasend.append('pesan',$('#isi_pesan').val());
            $.ajax({
                url: '<?=base_url()?>Utility/SendMessage',
                method: 'POST',
                contentType: false,
                processData: false,
                data: datasend,
                success: function(data) {
                  console.log(data);
                  $("#pageloader").fadeOut();
                  $(".msg_history").html(data);
                  $("#isi_pesan").val('');
                  $("#mesgs").scrollTop($("#mesgs").height());                                     
                },
                error: function(data) {
                  console.log(data);
                  $("#pageloader").hide();               
                    swal("Informasi","Gagal Terhubung Ke Server" ,"error");
                }
            });             
          }
        
      }, 300);

  }
</script>