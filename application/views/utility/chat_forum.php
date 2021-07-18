<?php foreach ($this->model_global->getDataGlobal('tb_forum_detail','id_forum',$id_forum)->result() as $rowChat) { 
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