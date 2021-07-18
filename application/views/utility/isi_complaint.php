 <?php foreach ($this->model_global->getDataGlobal('tb_complaint_detail','id_complaint',$id_complaint)->result() as $rowChat) { 
      if ($rowChat->id_petugas==$this->session->userdata('id_user')) {
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
                  <?php
                    if ($rowChat->id_user==0) {
                        $IDparam=$rowChat->id_petugas;
                    } else {
                        $IDparam=$rowChat->id_user;
                    }
                  ?>
                  <?=@$this->model_global->getDataGlobal('tb_user','id_user',$IDparam)->row()->name?> ~
                </b>
                <br>
                <?=$rowChat->message?><span class="time_date">  <?=$this->model_global->tgl_indo($rowChat->date)?>&nbsp;<?=date("H:i:s", strtotime($rowChat->date))?></span>
              </p>
            </div>
          </div>
        </div>

      <?php 
    } 
  } 
  ?>